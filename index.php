<?php
    include_once "./database/dbhelper.php";
    include_once "./database/config.php";
    include_once "./untils/utility.php";
    include_once "./pages/cart/cart_function.php";
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thái Linh Store</title>
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" 
    integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" 
    integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" 
    integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" 
    integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="containerIndex">
        
        <?php 

            ob_start();
            session_start();
            // session_destroy();
            
            
        
            if(isset($_GET['quanly'])){
                $quanly = getGet('quanly');
            }else{
                $quanly = '';
            }
            
            if (isset($_SERVER['HTTP_REFERER'])) {
                // Lấy địa chỉ URL của trang trước đó
                $currentURL = $_SERVER['HTTP_REFERER'];
            } else {
                $currentURL = "?quanly=home";
            }
        ?>
        <div class="account">
            <?php include_once "./layouts/account.php"; ?>
        </div>
        <div class="header">
            <?php include_once "./layouts/header.php"; ?>
        </div>
        <div class="menu">
            <?php include_once "./layouts/menu.php"; ?>
        </div>
        <div class="article">
            <?php 
                if($quanly=='home'){
                    include_once "./pages/home.php";
                }elseif ($quanly=='phone'){
                    include_once './pages/phone.php';
                }elseif ($quanly=='apple'){
                    include_once './pages/apple.php';
                }elseif ($quanly=='phukien'){
                    include_once './pages/accessory.php';
                }elseif ($quanly=='maytroi'){
                    include_once './pages/oldPhone.php';
                }elseif ($quanly=='suachua'){
                    include_once './pages/repairPhone.php';
                }elseif ($quanly=='dichvu'){
                    include_once './pages/service.php';
                }elseif ($quanly=='tinhot'){
                    include_once './pages/hotNews.php';
                }elseif ($quanly=='uudai'){
                    include_once './pages/deals.php';
                }elseif ($quanly=='productDetails'){
                    include_once './pages/productDetails.php';
                }else if ($quanly=='cart'){
                    include_once './pages/cart/cart.php';
                }else if ($quanly=='search'){
                    include_once './pages/search.php';
                }else if ($quanly=='order'){
                    include_once './pages/order/order.php';
                }else if ($quanly=='checkOut'){
                    include_once './pages/order/checkOut.php';
                }else if ($quanly=='checkOrder'){
                    include_once './pages/order/checkOrder_.php';
                }else if ($quanly=='user/purchase'){
                    include_once './pages/user/purchase.php';
                }elseif($quanly=='user/account/profile'){
                    include_once "./pages/user/profile.php";
                }elseif($quanly=='user/account/payment'){
                    include_once "./pages/user/payment.php";
                }elseif($quanly=='user/account/address'){
                    include_once "./pages/user/address.php";
                }elseif($quanly=='user/account/change_password'){
                    include_once "./pages/user/changePassword.php";
                }elseif($quanly=='user/account/setting/notification'){
                    include_once "./pages/user/notification.php";
                }elseif($quanly=='user/notifications'){
                    include_once "./pages/user/notifications.php";
                }elseif($quanly=="order_details"){
                    include_once "./pages/order/orderDetails.php";
                }elseif($quanly=="editOrder"){
                    include_once "./pages/order/editOrder.php";
                }else{
                    header("location: $currentURL");
                }

            ?>
        </div>
        <div class="asideLeft">
            <?php include_once "./layouts/asideLeft.php"; ?>
        </div>
        <div class="asideRight">
            <?php include_once "./layouts/asideRight.php"; ?>
        </div>
        <div class="footer">
            <?php 
                include_once "./layouts/footer.php"; 
                ob_end_flush();
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('.mayBeLike').slick({
                // centerPadding:20,
                // centerMode:true,
                useCSS: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.carouselPhone').slick({
                slidesToShow: 8,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        });

        $(document).ready(function(){
            $('.colImg').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            });
        });
        $(document).ready(function(){
            $('.goiy').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            });
        });
    </script>
    
    

    
    <script>
        // JavaScript để ẩn div sau 3 giây
        setTimeout(function(){
            // Lấy tham chiếu đến div
            var error = document.getElementById("error");
            if (error) {
                // Kiểm tra xem classList có tồn tại không trước khi thao tác
                if (error.classList) {
                    // Thêm class 'hidden' để ẩn div
                    error.classList.add("hiddenD");
                }
            }
        }, 6000);
    </script>
    
    
</body>
</html>