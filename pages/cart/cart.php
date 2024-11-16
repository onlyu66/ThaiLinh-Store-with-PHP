<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="./CSS/cart.css">
</head>
<body>
    <div>
            <?php
                // if(isset($_SESSION['id'])){
                //     $idUser = strval(getSession('id'));
                // }else{
                //     $idUser = "";
                // }
                $idUser = getSession('id');
                
                if(isset($_SESSION['cart'][""])){
                    $cart_=$_SESSION['cart'][""];
                }else{
                    $cart_=[];
                }
                // echo "<pre>";
                //     var_dump($_SESSION['cart']);
                //     echo "</pre>";
                    // die();
                if(isset($_SESSION['id'])){
                    if(isset($_SESSION['cart'][$idUser])){
                        foreach ($cart_ as $key => $value) {
                            if(isset($_SESSION['cart'][$idUser][$key])){
                                $_SESSION['cart'][$idUser][$key]['quantity']+=1;
                            }else{
                                $_SESSION['cart'][$idUser][$key]=$value;
                            }
                        }
                        unset($_SESSION['cart'][""]);
                        $cart=$_SESSION['cart'][$idUser];
                    }else{
                        $cart=[];
                    }
                    
                    
                }else{
                    $cart=$cart_;
                }
                // if(isset($cart)){
                    if(count($cart)>0){
                    
            ?>
                        <ul class="headC">
                            <li>Ảnh</li>
                            <li>Tên sản phẩm</li>
                            <li>Đơn giá</li>
                            <li>Số lượng</li>
                            <li>Tổng giá</li>
                        </ul>
                        <ul class="ulC p-0 m-0 relative" style="overflow: auto">
            <?php
                        $totalPrices=0;
                        foreach($cart as $key => $cartItem){

                            $totalPrice=$cartItem['price']*$cartItem['quantity'];
                            $totalPrices+=$totalPrice;
            ?>
                            <li class="flex justify-evenly p-0 m-0 rounded">
                                <img src="<?php echo $cartItem['image'];?>"/>
                                <div class="relative">
                                    <div><?php echo $cartItem['model'];?></div>
                                    <button class="rounded">
                                        <a href="./pages/cart/workWithCart.php?action=xoa&id=<?php echo $cartItem['id']; ?>">Xoá</a>
                                    </button>
                                </div>
                                <div><?php echo number_format($cartItem['price']);?> đ</div>
                                <div class="flex flex-col">
                                    <span><a href="./pages/cart/workWithCart.php?action=tang&id=<?php echo $cartItem['id']; ?>" >+</a></span>
                                    <span><?php echo $cartItem['quantity'];?></span>
                                    <span><a href="./pages/cart/workWithCart.php?action=giam&id=<?php echo $cartItem['id']; ?>">-</a></span>
                                </div>
                                <div><?php echo number_format($totalPrice);?> đ</div>
                            </li>
            <?php
                        }
            ?>
                            <li class="totalPrice" style="padding: 20px 0 20px 10px; borderTop: 2px solid #208f89;">
                                <span class="font-semibold text-base">Tổng tiền:</span>
                                <span class="text-lg text-red-600 font-bold" style="marginLeft: 140px">
                                    <?php echo number_format($totalPrices); ?> đ
                                </span>
                            </li>
                    </ul>
            <?php
                    }else{
            ?>
                            <div class="text-center mt-11">
                            <p class="text-slate-700">Giỏ hàng của bạn trống T^T</p>
                            <button
                                type="button"
                                class="text-stone-600 text-lg hover:text-slate-400 hover:font-semibold"
                                data-bs-dismiss="offcanvas"
                            >
                                Shopping thôi nào!
                            </button>
                            </div>
            <?php
                    }
            ?>
            
            
        
    </div>

    <!-- <script>
        $('.tang').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
        let id = $(this).closest('li').find('.tang').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/products/editProduct.php', {id: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            $('#editProduct').html(data);
        });
        return false;
    });
    </script> -->
</body>
</html>