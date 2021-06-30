<?php 
    wp_nonce_field( basename( __FILE__ ), 'invoice_start_date_nonce' );
    wp_nonce_field( basename( __FILE__ ), 'invoice_end_date_nonce' );
?>
  <p>
    <label for="invoice-id"><?php _e( "Invoice ID", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" disabled name="invoice-id-class" id="invoice-id-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_id', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-start-date"><?php _e( "Invoice Start Date", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-start-date-class" id="invoice-start-date-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_start_date', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-end-date"><?php _e( "Invoice End Date", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-end-date-class" id="invoice-end-date-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_end_date', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-transfer"><?php _e( "Invoice Transfer", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-transfer-class" id="invoice-transfer-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_transfer', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-orders"><?php _e( "Invoice Orders", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-orders-class" id="invoice-orders-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_orders', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-fee"><?php _e( "Invoice Fees", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-fee-class" id="invoice-fee-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_fee', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-total"><?php _e( "Invoice Total", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-total-class" id="invoice-total-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_total', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-status"><?php _e( "Invoice Status", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-status-class" id="invoice-status-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_status', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="invoice-status"><?php _e( "Invoice Status", 'inv_dashboard' ); ?></label>
    <br />
    <input class="widefat" type="text" name="invoice-status-class" id="invoice-status-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'invoice_status', true ) ); ?>" size="30" />
  </p>