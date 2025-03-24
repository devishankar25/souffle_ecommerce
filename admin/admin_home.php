<html>

<body>
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <div id="dashboardContainer">
        <div class="dashboard_slidebar bg-secondary mt-0" id="dashboard_slidebar">
            <div class="image text-center mt-2 m-auto">
                <h3 class="dashboard_logo" id="dashboard_logo">
                    <img src="logo.png" alt="" class="logo text-center $mt-0" />
                </h3>
                <span class="dashboard_text text-center text-success" id="dashboard_text">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                        <a href='#' class='nav-link'>Welcome Guest</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item'>
                        <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                        </li>";
                    }
                    ?>
                </span>
            </div>

            <div class="dashboard_slidebar_menu">
                <ul class="dashboard_list text-light text-decoration-none">
                    <li class="li_menu show_hidden_submenu">
                        <a href="admin_home.php?dashboard" class="show_hidden_submenu text-decoration-none">
                            <i class="fa fa-dashboard text-light mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Dashboard</span>
                        </a>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa fa-user-tie text-light mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menu Text show_hidden_submenu">Trainer</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?add_trainer"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Trainer</span></a>
                            <a href="admin_home.php?trainers_list"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">View Trainer</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-layer-group mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menu Text show_hidden_submenu">Plans</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?add_bplan"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Plan</span></a>
                            <a href="admin_home.php?view_bplan"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">View Plans</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-layer-group mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menu Text show_hidden_submenu">Sessions</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?addsession"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Session</span></a>
                            <a href="admin_home.php?view_session"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">View Sessions</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-brands fa-product-hunt mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menu Text show_hidden_submenu">Products</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?add_products"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Products</span></a>
                            <a href="admin_home.php?view_products"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">View Products</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-truck mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Supplier</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin home.php?add_supplier"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">Add Supplier</span></a>
                            <a href="admin_home.php?suppliers_list"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">View Suppliers</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-user mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">User</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu 
                            show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?all_users"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">User List</span></a>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa-solid fa-layer-group mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Category</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?add_category"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Category</span></a>
                            <a href="admin_home.php?view_category"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">View Categories</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-layer-group mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menu Text show_hidden_submenu">Delivery Brands</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?add_brand"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">Add Delivery Brand</span></a>
                            <a href="admin_home.php?view_brand"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">View Delivery Brand</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-bag-shopping mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Order</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?all_orders"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">View All Orders</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-store mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Purchase Order</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?order_from_supplier"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Create Order</span></a>
                            <a href="admin_home.php?view_order_from_supplier"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">View Orders</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa-solid fa-money-bill mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Payments</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?all_payments"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menu Text">All Payment Details</span></a>
                        </ul>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="admin_home.php?invoice_gen" class="show_hidden_submenu text-decoration-none">
                            <i class="fa fa-dashboard text-light mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Invoice</span>
                        </a>
                    </li>

                    <li class="li_menu show_hidden_submenu">
                        <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                            <i class="fa fa-check mx-2 menulcons show_hidden_submenu"></i>
                            <span class="menuText show_hidden_submenu">Attendance</span>
                            <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                        </a>
                        <ul class="subMenus">
                            <a href="admin_home.php?attendance"><i class="fa-solid fa-toggle-on mx-2 menulcons"></i><span class="menuText">Add Attendance</span></a>
                            <a href="admin_home.php?btn-print"><i class="fa-solid fa-print mx-2 menulcons"></i><span class="menu Text  Print Attendance</span></a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <div class="dashboard_topnav">
                <a href="" class="text-decoration-none" id="toggleBitr">
                    <i class="fa-solid fa-bars  -3"></i>
                </a>
            </div>

            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <?php
                    if (isset($_GET['add_category'])) {
                        include('add_category.php');
                    }

                    if (isset($_GET['add_brand'])) {
                        include('add_brand.php');
                    }

                    if (isset($_GET['add_products'])) {
                        include('add_products.php');
                    }

                    if (isset($_GET['view_products'])) {
                        include('view_products.php');
                    }

                    if (isset($_GET['edit_products'])) {
                        include('edit_products.php');
                    }

                    if (isset($_GET['trash_products'])) {
                        include('trash_products.php');
                    }

                    if (isset($_GET['trash_category'])) {
                        include('trash_category.php');
                    }

                    if (isset($_GET['edit_trainer'])) {
                        include('edit_trainer php');  // Added missing quote
                    }

                    if (isset($_GET['trash_brands'])) {
                        include('trash_brands.php');
                    }

                    if (isset($_GET['trash_orders'])) {
                        include('trash_orders.php');
                    }

                    if (isset($_GET['view_category'])) {
                        include('view_category.php');
                    }

                    if (isset($_GET['view_brand'])) {
                        include('view_brand.php');
                    }

                    if (isset($_GET['edit_category'])) {
                        include('edit_category.php');
                    }

                    if (isset($_GET['edit_brands'])) {
                        include('edit_brands.php');
                    }

                    if (isset($_GET['all_orders'])) {
                        include('all_orders.php');
                    }

                    if (isset($_GET['all_payments'])) {
                        include('all_payments.php');
                    }

                    if (isset($_GET['all_users'])) {
                        include('all_users.php');
                    }

                    if (isset($_GET['add_trainer'])) {
                        include('add_trainer.php');
                    }

                    if (isset($_GET['trainers_list'])) {
                        include('trainers_list.php');
                    }

                    if (isset($_GET['add_bplan'])) {
                        include('add_bplan.php');
                    }

                    if (isset($_GET['view_bplan'])) {
                        include('view_bplan.php');
                    }

                    if (isset($_GET['edit_plans'])) {
                        include('edit_plans.php');
                    }

                    if (isset($_GET['trash_plans'])) {
                        include(' trash_plans.php'); // Added missing quote
                    }

                    if (isset($_GET['suppliers_list'])) {
                        include('suppliers_list.php');
                    }

                    if (isset($_GET['edit_suppliers'])) {
                        include('edit_suppliers.php');
                    }

                    if (isset($_GET['trash_suppliers'])) {
                        include("trash_suppliers.php"); // Added missing quote
                    }

                    if (isset($_GET['order_from_supplier'])) {
                        include('order_from_supplier.php');
                    }

                    if (isset($_GET['view_order_from_supplier'])) {
                        include('view_order_from_supplier.php');
                    }

                    if (isset($_GET['update_p_order'])) {
                        include('update_p_order.php');
                    }

                    if (isset($_GET['dashboard'])) {
                        include('dashboard.php');
                    }

                    if (isset($_GET['invoice_gen'])) {
                        include('invoice_gen.php');
                    }

                    if (isset($_GET['attendance'])) {
                        include('getattendance.php');
                    }

                    if (isset($_GET['btn-print'])) {
                        include('printreport.php');
                    }

                    if (isset($_GET['addsession'])) {
                        include('addsession.php');
                    }

                    if (isset($_GET['view_session'])) {
                        include('view_session.php');
                    }

                    if (isset($_GET['add_supplier'])) {
                        include('add_supplier.php');
                    }

                    if (isset($_GET['stock'])) {
                        include('stock.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        var sideBarlsOpen = true;
        toggleBtn.addEventListener('click', (event) => {
            event.preventDefault();

            if (sideBarlsOpen) {
                dashboard_slidebar.style.width = '8%';
                dashboard_slidebar.style.transition = '0.8s  all';  // This line likely has errors
                dashboard_content_container.style.width='90%';
                dashboard_logo.fontSize ='30%';
                dashboard_text.fontSize ='10px';
                menulcons = document.getElementsByClassName('menuText');
                for(var i=0; i<menulcons.length; i++){
                    menulcons[i].style.display='none';
                }
                document.getElementsByClassName('dashboard_list')[0].style.textAlign = 'center';
                sideBarlsOpen = false;
            }else{
                    dashboard_slidebar.style.width ='20%';
                    dashboard_content_container.style.width ='80%';
                    dashboard_logo.fontSize ='50%';
                    menulcons = document.getElementsByClassName('menu Text');
                    for(var i=0; i<menulcons.length; i++){
                        menulcons[i].style.display='inline-block';
                    }
                    document.getElementsByClassName('dashboard_list')[0].style.textAlign = "left" 
                    sideBarlsOpen = true;
                }
            });
            document.addEventListener('click', function(e){
                let clickedE1 = e. target;
                if(clickedE1.classList.contains('show_hidden_submenu')){
                    let subMenu = clickedE1.closest('li').querySelector('.subMenus');
                    let menulcons = clickedE1.closest('li').querySelector('.angle');
                    let subMenus = document.querySelectorAll('.subMenus');
                    subMenus.forEach((sub)=>{
                        if(subMenu !==sub){
                            sub.style.display='none';}});
                            show_hidden_submenu(subMenu, menulcons);
                        }
                    });
                    function show_hidden_submenu(subMenu, menulcons){
                        if(subMenu.style.display === 'block'){
                            subMenu.style.display = 'none';
                            menulcons.classList.remove('fa-angle-up');
                        } else{
                            subMenu.style.display = 'block';
                            menulcons.classList.remove('fa-angle-down');
                            menulcons.classList.add('fa-angle-up');
                        }
                    }
    </script>
</body>


