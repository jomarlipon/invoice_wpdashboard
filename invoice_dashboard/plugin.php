<?php
/**
 * Plugin Name: Invoice Dashboard
 * Plugin URI: http://www.facebook.com/jomarliponko
 * Description: This plugin will display the dashboard according to the eats folder
 * Author: Jomar Lipon
 * Version: 1.0.0
 * Text Domain: inv-dashboard
 * Author URI: http://www.facebook.com/jomarliponko
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

register_activation_hook( __FILE__, "register_plugin_activation" );
register_deactivation_hook( __FILE__, "deregister_deactivate_plugin" );

/* This function will fire when the plugin is activated
    * Create a table to store invoices and details
    * Add role 'Shop Manager'
*/
function register_plugin_activation() {


    /*
         add new user role when activate
    */
    add_role(
        'inv_shop_manager',
        __('Shop Manager', 'inv-dashboard'), //use for translation
        array(
            'read'         => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
        )
    );
}


/* This function call when the plugin is deactivated
    * Drop the table
    * Remove the role 'Shop Manager'
*/
function deregister_deactivate_plugin() {

    global $wpdb;

    /* remove created user role */
    remove_role( 'inv_shop_manager' );

    //unregister custom post type eat_invoice
    unregister_post_type('eat_invoice');
}


//remove admin bar if user is not administrator
add_action('init', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}


//redirect shop manager user role to new admin dashboard page
function my_login_redirect( $redirect_to, $request, $user ) {
     // is there a user ?
     if ( is_array( $user->roles ) ) {
        
        if ( in_array( 'inv_shop_manager', $user->roles ) ) {
            //redirect to invoice-dashboard page
            return get_bloginfo('url'). '/invoice-dashboard';
        } else {
            return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/* create new page
    Create Shop Manager Dashboard page
    slug_url is invoice-dashboard
    content is inv_usershop_dashboard shortcode
*/
function create_dashboard_page() {
    $wordpress_post = array(
        'post_title'    => 'Shop Manager Dashboard',
        'post_content'  => '[inv_usershop_dashboard]',
        'post_status'   => 'publish',
        'post_type' => 'page',
        'post_name'     => 'invoice-dashboard'
         );
    wp_insert_post( $wordpress_post );
}

/* Add new custom post type
* Invoice (eat_invoice)
*/
function invoice_custompost_type() {
    $labels = array(
      'name'               => __( 'Invoice', 'inv-dashboard' ),
      'singular_name'      => __( 'Invoice', 'inv-dashboard' ),
      'add_new'            => __( 'Add Invoice', 'inv-dashboard' ),
      'add_new_item'       => __( 'Add New Invoice','inv-dashboard' ),
      'edit_item'          => __( 'Edit Invoice','inv-dashboard' ),
      'new_item'           => __( 'New Invoice','inv-dashboard' ),
      'all_items'          => __( 'All Invoices','inv-dashboard' ),
      'view_item'          => __( 'View Invoice','inv-dashboard' ),
      'search_items'       => __( 'Search Invoice','inv-dashboard' ),
      'not_found'          => __( 'No Invoice found','inv-dashboard' ),
      'not_found_in_trash' => __( 'No Invoice found in the trash','inv-dashboard' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'Invoice'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Add New Invoice',
      'public'        => true,
      'rewrite'       => array('slug' => 'invoice'),
      'show_in_rest'  => true,
      'show_in_menu'  => 'edit.php?post_type=eat_invoice',
      'supports'      => array(''),
      'has_archive'   => false,
      'capability_type' => 'post',
      'capabilities' => array(
          'create_posts' => false, 
          ),
      'map_meta_cap' => true,
    );
    register_post_type( 'eat_invoice', $args );
}
add_action( 'init', 'invoice_custompost_type' );


/* Add new custom post type
* Invoice (eat_restaurant)
*/
function inv_restaurantorder() {
    $labels = array(
      'name'               => __( 'Restaurant', 'inv-dashboard' ),
      'singular_name'      => __( 'Restaurant', 'inv-dashboard' ),
      'add_new'            => __( 'Add Restaurant', 'inv-dashboard' ),
      'add_new_item'       => __( 'Add New Restaurant','inv-dashboard' ),
      'edit_item'          => __( 'Edit Restaurant','inv-dashboard' ),
      'new_item'           => __( 'New Restaurant','inv-dashboard' ),
      'all_items'          => __( 'All Restaurants','inv-dashboard' ),
      'view_item'          => __( 'View Restaurant','inv-dashboard' ),
      'search_items'       => __( 'Search Restaurants','inv-dashboard' ),
      'not_found'          => __( 'No Restaurant found','inv-dashboard' ),
      'not_found_in_trash' => __( 'No Restaurant found in the trash','inv-dashboard' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'Restaurant'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Add New Restaurant',
      'public'        => true,
      'rewrite'       => array('slug' => 'restaurant'),
      'show_in_rest'  => true,
      'menu_position' => 6,
      'show_in_menu'  => 'edit.php?post_type=eat_restaurant',
      'supports'      => array( 'title', 'editor', 'excerpt','custom-fields'),
      'has_archive'   => false,
      'capability_type' => 'post',
      'capabilities' => array(
          'create_posts' => true, 
          ),
      'map_meta_cap' => true,
    );
    register_post_type( 'eat_restaurant', $args );

    $olabels = array(
        'name'               => __( 'Order', 'inv-dashboard' ),
        'singular_name'      => __( 'Order', 'inv-dashboard' ),
        'add_new'            => __( 'Add Order', 'inv-dashboard' ),
        'add_new_item'       => __( 'New Order','inv-dashboard' ),
        'new_item'           => __( 'New Order','inv-dashboard' ),
        'all_items'          => __( 'All Orders','inv-dashboard' ),
        'view_item'          => __( 'View Order','inv-dashboard' ),
        'search_items'       => __( 'Search Order','inv-dashboard' ),
        'not_found'          => __( 'No Order found','inv-dashboard' ),
        'not_found_in_trash' => __( 'No Order found in the trash','inv-dashboard' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Order'
      );
      $oargs = array(
        'labels'        => $olabels,
        'description'   => 'Add New Order',
        'public'        => true,
        'rewrite'       => array('slug' => 'order'),
        'show_in_rest'  => true,
        'menu_position' => 6,
        'show_in_menu'  => 'edit.php?post_type=eat_order',
        'supports'      => array( 'custom-fields'),
        'has_archive'   => false,
        );
      register_post_type( 'eat_order', $oargs );
}
add_action( 'init', 'inv_restaurantorder' );


// function to load the script in admin dashboard
function load_scripts ()
{
  add_action( 'admin_enqueue_scripts', 'enqueue_adminscripts_style',10,1 );
}

// function to enque the bootstrap or custom css
function enqueue_adminscripts_style($hook)
{
    global $post, $post_type;

    // css
    $bootstrapadmin = plugins_url( 'invoice_dashboard/assets/css/bootstrap.min.css' ); //use your path of course
    $dependencies = array(); //add any depencdencies in array
    $admincss = plugins_url( 'invoice_dashboard/assets/css/admin.css' ); //use your path of course
    wp_enqueue_style( 'admin-inv-bootstrap', $bootstrapadmin, $dependencies );
    wp_enqueue_style( 'admin-inv-css', $admincss);
    wp_enqueue_style( 'poppins_gfont', 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap');
    wp_enqueue_style( 'fontawsomecss', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    
    wp_enqueue_style( 'inv-datatablecss', 'https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css');
    wp_enqueue_style( 'inv-selectDatatable', 'https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css');

    //js
    $bootstrapadminjs = plugins_url( 'invoice_dashboard/assets/js/bootstrap.min.js' ); //use your path of course
    $invadminjs = plugins_url( 'invoice_dashboard/assets/js/inv-admin.js' ); //use your path of course
    $jqueryui = plugins_url( 'invoice_dashboard/assets/js/jquery-ui.js' );

    wp_enqueue_script( 'admin-jquery-inv', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script( 'admin-invdatatables', 'https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js' );
    wp_enqueue_script( 'admin-inv-bootstrap', $bootstrapadminjs);
    wp_enqueue_script( 'admin-inv-admin', $invadminjs,array('admin-jquery-inv'));
    wp_localize_script( 'admin-inv-admin', 'invdash_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('admin-inv-admin', 'getPHPvariable', array(
        'pluginsUrl' => plugin_dir_url(__FILE__),
    ));

    $eatorder_js = plugins_url( 'invoice_dashboard/assets/js/jquery-ui.js' );

    if($hook == 'post-new.php' || $hook == 'post.php') {
        if($post->post_type == 'eat_order') {
            wp_enqueue_script(  'jqueryui_eatorder', $jqueryui );
            wp_enqueue_script(  'eatorder_js',$eatorder_js );
        }
    }
}




/* Register metabox for some details of invoice using custom field
*  @package custom post type Invoice
*/
function register_metaboxes_inv() {
    add_meta_box( 'inv_detailsdiv', __( 'Invoice Details', 'inv-dashboard' ), 'eat_invoicedetails', 'eat_invoice');
}
add_action( 'add_meta_boxes', 'register_metaboxes_inv' );

//content to be display in meta box "Invoice Details"
function eat_invoicedetails( $posttype ) {
    include plugin_dir_path( __FILE__ ) . 'inc/invoice_details.php';
}


/* Register metabox for some details of restaurant through custom field
*  @package custom post type Restaurant
*/
function register_metaboxes_restaurant() {
    add_meta_box( 'inv_restaurantdetails', __( 'Restaurant Details', 'inv-dashboard' ), 'restaurant_details_func', 'eat_restaurant');
}
add_action( 'add_meta_boxes', 'register_metaboxes_restaurant' );


//function display other restaurant details.
function restaurant_details_func($posttype) {

    global $post;

    echo '<div>';

        echo '<label for="resto_transacfee">Transaction Fee<span class="resto-subdesc">(per transaction in percent)<span></label>';
        echo '<input type="text" class="transact_fee" name="resto_fee">';


    echo '</div>';
    
}

/* Register metabox for some details of restaurant through custom field
*  @package custom post type Order
*/
function register_metaboxes_order() {
    add_meta_box( 'inv_orderdetails', __( 'Order Details', 'inv-dashboard' ), 'order_details_func', 'eat_order', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'register_metaboxes_order' );


//function display other eat_order details.
function order_details_func($posttype) {
    global $post;

    wp_nonce_field(basename(__FILE__), "ordermeta-box-nonce");

    echo '<div>';
            echo '<label for="inv-box-ordernumber">Order Number</label>: ';
            echo '<input name="inv-box-ordernumber" disabled type="text" placeholder="Generated Order No." value="'.get_the_title(). '">';
    echo '</div>';
    echo '<div class="resto-list">';
        echo '<label for="inv-box-restolist">Restaurant: </label>';
        $resto_selected = get_post_meta( $post->ID, 'resto_selected', true );
        $restolist = get_posts( array(
            'post_type'      => 'eat_restaurant',
            'post_status'    => 'publish',
            'posts_per_page' => -1
        ) );
        echo '<select id="resto_selected" name="resto_selected">';
            echo '<option value="">Select Restaurant: </option>';
            foreach ( $restolist as $rList ) :
                echo '<option value="'.esc_attr($rList->ID).'" '.selected( $resto_selected, esc_attr($rList->ID) ).' >'.esc_html($rList->post_title).'</option>';
            endforeach;
        echo '</select>';
    echo '</div>';

    $order_startdate = get_post_meta( $post->ID, 'orderstart_date', true );
    $orderend_date = get_post_meta( $post->ID, 'orderend_date', true );
    echo '<div class="orderstart_date">';
            echo '<label for="orderstart_date">Start Date: </label>';
            echo '<input class="datepicker type="text" name="orderstart_date" value="'.$order_startdate.'">';
    echo '</div>';
    echo '<div class="orderend_date">';
        echo '<label for="orderend_date">End Date: </label>';
        echo '<input class="datepicker type="text" name="orderend_date" value="'.$orderend_date.'">';
    echo '</div>';
}

add_action( 'save_post', 'save_order_metafield', 10, 2 );
function save_order_metafield() {

    global $post;
    if(isset($_POST['resto_selected'])) {
        $restoselected= $_POST['resto_selected'];
        $orderstart_date= $_POST['orderstart_date'];
        $orderend_date= $_POST['orderend_date'];

        update_post_meta($post->ID, 'resto_selected',$restoselected);
        update_post_meta($post->ID, 'orderstart_date',$orderstart_date);
        update_post_meta($post->ID, 'orderend_date',$orderend_date);
    }

}


/* Custom Admin Menu
* Add Plugin Menu
* Add Submenu (Custom Post Type: Invoice, Order, Restaurant)
* Load a custom css file from plugin folder when the Plugin Menu is being called.
*/
function invoice_dashboard_menupage() {
    $invpage = add_menu_page(
        __('Invoice Admin', 'inv-dashboard'),
        __('Invoice Admin', 'inv-dashboard'),
        'manage_options',
        'inv-admin-dashboard',
        'inv_admin_page_content',
        'dashicons-text-page',
        5

    );
    add_action( 'load-'.$invpage, 'load_scripts' ); // load a custom css (bootstrap and other) if admin Invoice Admin Dashboard is being displayed.

    add_submenu_page('inv-admin-dashboard', 'Invoice', 'Invoice', 'manage_options','edit.php?post_type=eat_invoice');
    add_submenu_page('inv-admin-dashboard', 'Order', 'Order', 'manage_options','edit.php?post_type=eat_order');
    add_submenu_page('inv-admin-dashboard', 'Restaurant', 'Restaurant', 'manage_options','edit.php?post_type=eat_restaurant');
    
}
add_action('admin_menu', 'invoice_dashboard_menupage');

// Display the admin page content invoice_dashboard_menupage
function inv_admin_page_content() {
    include plugin_dir_path( __FILE__ ) . 'inc/inv_dashboard_page.php';
}


// shortcode to display the dashboard on front-end on shop-manager dashboard
function inv_usershop_dashboard_func() {

    $inv = '';
    
    return $inv;

}
add_shortcode('inv_usershop_dashboard', 'inv_usershop_dashboard_func');

//ajax filter status
function inv_status_get() {

    // $html = '';
    // $html .= '<tr class="inv-item">';
    //     $html .= '<td><input type="checkbox" class="inv-select"></td>';
    //     $html .= '<td>#2023</td>';
    //     $html .= '<td><span class="inv-restaurant">Restaurant Name 1</span></td>';
    //     $html .= '<td><span class="inv-status verified">Verified</span></td>';
    //     $html .= '<td><span class="inv-start">21/02/2021</span></td>';
    //     $html .= '<td><span class="inv-end">26/02/2021</span></td>';
    //     $html .= '<td><span class="inv-total">$20.00</td>';
    //     $html .= '<td><span class="inv-fee">$10.00</span></td>';
    //     $html .= '<td><span class="inv-transfer">$30.00</span></td>';
    //     $html .= '<td><span class="inv-orders">20</span></td>';
    //     $html .= '<td><img class="downloadinvoice" src="'. plugins_url().'/invoice_dashboard/assets/images/download-cloud.svg" alt="download invoice"></td>';
    // $html .= '</tr>';
    $data = array();
    $datas = array();
    if($_GET['status'] === 'all') {
    $data['invoiceid'] = '#233244';
    $data['restaurant'] = 'Restaurant';
    $data['invoicestatus'] = 'verifed';
    $data['invstartdate'] = '2021/20/04';
    $data['invenddate'] = '2021/22/04';
    $data['invtotal'] = '343';
    $data['invfee'] = '23';
    $data['invtransfer'] = '343';
    $data['invorders'] = '32';
    $datas[]= $data;
    } else {
        $data['invoiceid'] = '#233244';
        $data['restaurant'] = 'Restaurant B';
        $data['invoicestatus'] = $_GET['status'];
        $data['invstartdate'] = '2021/20/04';
        $data['invenddate'] = '2021/22/04';
        $data['invtotal'] = '343';
        $data['invfee'] = '23';
        $data['invtransfer'] = '343';
        $data['invorders'] = '32';
        $datas[0]= $data;
        $data['invoiceid'] = '#658504';
        $data['restaurant'] = 'Restaurant C';
        $data['invoicestatus'] = $_GET['status'];
        $data['invstartdate'] = '2021/20/04';
        $data['invenddate'] = '2021/22/04';
        $data['invtotal'] = '687';
        $data['invfee'] = '23';
        $data['invtransfer'] = '343';
        $data['invorders'] = '32';
       $datas[1]= $data;
    }
    
   

    echo json_encode(array('data' => $datas));
    wp_die();
}
add_action("wp_ajax_get_invdash", "inv_status_get");
add_action("wp_ajax_nopriv_get_invdash", "inv_status_get");


add_filter( 'wp_insert_post_data' , 'modify_post_title' , '99', 1 ); // Grabs the inserted post data so you can modify it.

function modify_post_title( $data )
{
  
  $countOrder = wp_count_posts('eat_order')->publish;
  
  if( $data['post_type'] == 'eat_order') { 

    if($countOrder == 0) {
        $neworderID = 1;
        $title = '#INV-000'.$neworderID;
    } else {
       
        if($data->guid == NULL) {
            $title = '#INV-000'.++$countOrder;
        
        } else {
            $title = get_the_title();
        }
    }
       
    $data['post_title'] =  $title; //Updates the post title to your new title.
    

  }
  return $data; // Returns the modified data.
}