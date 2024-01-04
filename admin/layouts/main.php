<div class="content">
    <?php
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
        }else{
            $action = '';
        }
        if($action=='dashboard'){
            include_once "pages/dashboard/dashboard.php";
        }elseif($action== "products"){
            include_once "pages/products/products.php";
        }elseif($action== "orders"){
            include_once "pages/orders/orders.php";
        }elseif($action== "users"){
            include_once "pages/users/users.php";
        }elseif($action== "admin/profile"){
            include_once "pages/admin/admin.php";
        }elseif($action== "admin/change_password"){
            include_once "pages/admin/change_password.php";
        }else {
            include_once "pages/dashboard/dashboard.php";
        }
    ?>
</div>