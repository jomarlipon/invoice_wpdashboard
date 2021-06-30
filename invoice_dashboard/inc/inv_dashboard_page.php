<div class="wrap inv-dashadmin">
    <header>
        <div class="container-fluid">
            <nav class="navadmin_inv navbar navbar-expand-lg"> 
                <div class="header-wrap">
                    <div class="siteadmin_logo">
                        Logoo
                    </div>
                    <div class="siteadmin_menu">
                        <ul class="invul-menu navbar-nav">
                            <li class="invmenu_item">Dashboard</li>
                            <li class="invmenu_item"><a href="admin.php?page=inv-admin-dashboard&subpage=coupons">Coupons</a></li>
                            <li class="invmenu_item"><a href="admin.php?page=inv-admin-dashboard&subpage=invoices">Invoices</a></li>
                            <li class="invmenu_item">Restaurants</li>
                            <li class="invmenu_item">Users</li>
                            <li class="invmenu_item">Orders</li>
                        </ul>
                    </div>
                    <div class="siteadmin_profile">
                        profile
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="content-wrapinv">
        <div class="container">
            <div class="row">
                <?php 
                    $pageTab = $_GET['subpage'];
                    if($pageTab == 'invoices') {
                        include 'inv_invoice_page.php';
                    }
                    else {
                        include 'inv_sub_page.php';
                    }
                
                ?>
            </div>
        </div>
    </div>
</div>