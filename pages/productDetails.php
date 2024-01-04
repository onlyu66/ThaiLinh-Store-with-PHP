<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $id=$_GET['id'];
        $detailSql = "
    SELECT 
        products.id as id, 
        products.model as model, 
        products.price as price,
        products.thumbnail as thumbnail, 
        categories.name as category, 
        brands.brand as brand,
        galleries.thumbnail as images,
        products.discount as discount,
        products.colors as colorId
    FROM 
        products
    JOIN 
        categories ON products.categoryId = categories.id
    JOIN 
        brands ON products.brandId = brands.id
    LEFT JOIN 
        galleries ON products.id = galleries.productId
    WHERE 
        products.id='$id'
    ORDER BY 
        products.createAt DESC";

        // $detailQuery=mysqli_query($conn,$detailSql); 
        // $product_ = mysqli_fetch_assoc($detailQuery);
        $product_ = select($detailSql,true);
    
    ?>
    <title><?php echo $product_['model'];?></title>
    <link rel="stylesheet" href="./CSS/productDetails.css">
</head>
<body>
    <?php
        if($product_["brand"]!="Apple"&& $product_["category"]=="phone"){
            $a= "Điện thoại";
            $b="phone";
        }else if($product_["brand"]== "Apple"&& $product_["category"]=="phone"){
            $a= "Apple";
            $b= "apple";
        }else if($product_["category"]== "headphone"){
            $a= "Tai nghe";
            $b="headphone";
        }else if($product_["category"]== "speaker"){
            $a= "Loa";
            $b= "speaker";
        }else if($product_["category"]== "pin"){
            $a= "Pin";
            $b= "pin";
        }else if($product_["category"]== "monitor"){
            $a= "Màn hình điện thoại";
            $b= "monitor";
        }else if($product_["category"]== "fan"){
            $a= "Quạt";
            $b= "fan";
        }else if($product_["category"]== "charger-cable"){
            $a= "Củ sạc - Dây cáp";
            $b= "charger-cable";
        }else if($product_["category"]== "storage-usb"){
            $a= "Thẻ nhớ - USB";
            $b= "storage-usb";
        }else if($product_["category"]== "phoneCase"){
            $a= "Ốp lưng điện thoại";
            $b= "phoneCase";
        }else if($product_["category"]== "backupCharger"){
            $a= "Sạc dự phòng";
            $b= "backupCharger";
        }else if($product_["category"]== "screenProtector"){
            $a= "Miếng dán cường lực";
            $b= "screenProtector";
        }else{
            $a= "Phụ kiện khác";
            $b=  "otherAccessory";
        }
    ?>
    <div class="">
        <div class="mt-2 ">
            <span>
                <a href="http://localhost/ThaiLinhStore/?quanly=home" class="no-underline">
                <i class="fa-solid fa-house mr-1"></i>Home
                </a>
            </span>
            >
            <span>
                <a href="http://localhost/ThaiLinhStore/?quanly=<?php echo $b;?>">
                    <?php echo $a;?>
                </a>
            </span>
            >
            <span class="text-teal-700 font-bold">
                <?php
                    echo $product_["model"];?><?
                ?>
            </span>
        </div>

        <p class="text-lg font-bold text-slate-600 mt-3">
            <?php 
                if($product_["category"]=="phone"){
                    echo "Điện thoại ";
                }else{
                    echo "";
                }
                echo $product_['model'];
            ?>
        </p>

        <div class="containerDetail mt-2">
            <div class="colImg max-w-80 max-h-96 h-5/6 mx-auto my-0 shadow-sm rounded pt-3">
                <?php
                    $gallerySql = "
                    SELECT 
                        thumbnail
                    FROM 
                        galleries
                    WHERE 
                        productId = '$id'";
                
                    $galleryResult = mysqli_query($conn, $gallerySql);
                    
                    $galleryImages = [];
                    $i=0;
                    while ($row = mysqli_fetch_assoc($galleryResult)) {
                        $galleryImages[] = $row['thumbnail'];
                        $i++;
                
                ?>
                        <img src="<?php echo $galleryImages[$i-1];?>" width="250px" class="mx-auto my-0" alt="This is a image"/>
                <?php
                    }
                ?>
            </div>
            <form class="colContent" action="./pages/cart/workWithCart.php?id=<?php echo $product_['id'];?>" method="post">
                <span class="text-red-600 text-2xl font-bold"><?php echo number_format($product_['price']*(1-$product_['discount']));?> ₫</span>
                <span class="text-lg line-through" <?php echo ($product_['discount']>0)?"":"hidden"?>><?php echo number_format($product_['price']);?> ₫</span>
                <span class="italic"> |Giá đã bao gồm VAT</span>
                <div class="flex justify-center text-sm freeShip mt-2">
                    <img src="./assets/images/icons/free-delivery.png" width="40px" alt="">
                    <div class="mx-0 my-auto pl-2 text-white">MIỄN PHÍ VẬN CHUYỂN TOÀN QUỐC</div>
                </div>

                <div class="mt-2">
                    <p class="font-bold mb-1">Chọn màu: </p>
                    <div class="flex flex-wrap">

                    <?php
                        // $sqlColors="select * from colors";
                        // $colors=select($sqlColors);

                        // $colorIds=json_decode($product_['colorId']);
                        if(isset($product_['colorId'])){
                            $selectedColors=json_decode($product_['colorId']);
                        }else{
                            $selectedColors=[];
                        }
                        $color="select * from colors";
                        $colorIds = select($color,false);
                        
                        foreach ($colorIds as $val) {
                            $checked = in_array($val['id'], $selectedColors) ? '' : 'hidden';

                            $colorClass = $val['colorCode'];
                        // echo "<pre>";
                        // var_dump($colorIds);
                        // foreach($colorIds as $colorId){

                    ?>  
                        <label for="<?php echo $val['id'];?>" class="ml-1 w-1/4 cursor-pointer border rounded p-2 bg-gray-500 flex" <?php echo $checked;?>>
                            <input type="radio" name="color" class="mr-1 w-5" <?php echo $checked;?> id="<?php echo $val['id'];?>" value="<?php echo $val['id'];?>">
                            <p class="<?php echo $colorClass;?> font-semibold" <?php echo $checked;?>><?php echo $val['color'];?></p>
                        </label>
                        
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="mgt mt-3">
                    <div class="pt-2 pb-2 shadow">
                        <p class="font-bold">MUA NGAY</p>
                        <p class="text-sm">Giao tận nhà (COD)</p>
                        <p class="text-sm">Hoặc Nhận tại cửa hàng</p>
                    </div>
                    <div class="pt-2 pb-2 shadow">
                        <p class="font-bold">TRẢ GÓP</p>
                        <p class="text-sm">Công ty Tài chính</p>
                        <p class="text-sm">Hoặc 0% qua thẻ tín dụng</p>
                    </div>
                    <button type="submit" name="addToCartBtn" class="pt-2 shadow-sm button_">
                        <!-- <a href="http://localhost/ThaiLinh%20Store/?quanly=cart&id=<?php /*echo $product_['id']*/?>"> -->
                            <img src="./assets/images/icons/cart.png" width="30px" alt="" class="mx-auto my-0 mt-1">
                            <p class="text-sm">Thêm giỏ hàng</p>
                        <!-- </a> -->
                    </button>
                </div>
                <div class="mt-3 bg-white rounded p-2 shadow">
                    <h3 class="font-bold">ƯU ĐÃI THANH TOÁN</h3>
                    <ul class="mt-1">
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1">VNPAY - Giảm thêm tới 200.000đ khi thanh toán qua VNPAY.</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1">Home PayLater - Trả góp qua Home PayLater giảm tới 1.000.000đ</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1"> VPBank - Mở thẻ VPBank, Ưu đãi tới 250.000đ.</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1"> ZaloPay - Ưu đãi tới 300.000đ khi thanh toán qua ZaloPay.</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1"> VIB - Nhận Voucher 250.000đ khi mở thẻ tín dụng VIB thành công.</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1">  Kredivo - Ưu đãi tới 200.000đ khi mua trước trả sau qua Kredivo.</p>
                        </li>
                        <li class="flex">
                            <img src="./assets/images/icons/check-mark.png" width="15px" alt="">
                            <p class="text-sm pl-1">  Shinhan Finance - Ưu đãi trả góp 0% qua Shinhan Finance.</p>
                        </li>
                        
                    </ul>
                </div>     
            </form>
            <div class="colContent_ border p-2 ml-2 rounded">
                <h4 class="font-bold text-sm text-center">THÔNG TIN BẢO HÀNH</h4>
                <ul>
                    <li class="flex mt-1">
                        <img src="./assets/images/icons/security.png" width="15px" class="max-h-4 " alt="">
                        <p class="text-xs pl-1 font-bold">Bảo hành 18 tháng chính hãng</p>
                    </li>
                    <li class="flex mt-1">
                        <img src="./assets/images/icons/security.png" width="15px" class="max-h-4" alt="">
                        <p class="text-xs pl-1 font-bold text-justify">Bảo hành 18 tháng chính hãng 1 đổi 1 trong 30 ngày đầu nếu có lỗi phần cứng do nhà sản xuất.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>