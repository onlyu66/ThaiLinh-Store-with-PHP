<?php
    ob_start();
    include_once "../../database/config.php";
    include_once "../../untils/utility.php";
    include_once "../../database/dbhelper.php";
    session_start();
    // session_destroy();
    
    if (isset($_SERVER['HTTP_REFERER'])) {
        // Lấy địa chỉ URL của trang trước đó
        $currentURL = $_SERVER['HTTP_REFERER'];
    } else {
        $currentURL = "";
    }
    // if(isset($_SESSION['id'])){
    //     $idUser = strval(getSession('id'));
    // }else{
    //     $idUser = "";
    // }
    $idUser = getSession('id');
    
    $action=(isset($_GET['action']))?$_GET['action']:"add"; 
    // Thêm sản phẩm
    if($action=='add'){
        $id = getGet('id');
        if(isset($_POST['color'])){
            $colorId=$_POST['color'];
        }else{
            $colorId=1;
        }
        $colorSql="select * from colors where id='$colorId'";
        $colorArr = select($colorSql,true);
        $color=$colorArr['color'];
        // echo $color;
        // die();
        $sql="select 
        products.id as id, products.thumbnail as thumbnail, products.model as model,
        versions.ram as ram, versions.rom as rom, 
        products.price as price, products.discount as discount, products.stockQuantity as stockQuantity
        from products 
        join versions on products.versionId=versions.id
        where products.id = $id";
        $product=select($sql,true);

        $item= [
            'id'=>$product['id'],
            'image'=>$product['thumbnail'],
            'model'=>$product['model'],
            'version' => $product['ram']."/".$product['rom'],
            'color'=> 'Đen',
            'priceOld'=>$product['price'],
            'price'=>($product['discount']>0)?((1-$product['discount'])*$product['price']):$product['price'],
            'quantity'=>1
        ];
        if(isset($_SESSION['cart'][$idUser][$id]) ){
            if($_SESSION['cart'][$idUser][$id]['quantity']<$product['stockQuantity']){
                $_SESSION['cart'][$idUser][$id]['quantity']+=1;
            }
        }else{
            $_SESSION['cart'][$idUser][$id]=$item;
        }
    }
    
    
    // Thêm số lượng
    if($action=='tang'){
        $id = getGet('id');
        $sql="select 
        products.id as id, products.thumbnail as thumbnail, products.model as model,
        versions.ram as ram, versions.rom as rom, 
        products.price as price, products.discount as discount, products.stockQuantity as stockQuantity
        from products 
        join versions on products.versionId=versions.id
        where products.id = $id";
        $product=select($sql,true);

        $item= [
            'id'=>$product['id'],
            'image'=>$product['thumbnail'],
            'model'=>$product['model'],
            'version' => $product['ram']."/".$product['rom'],
            'color'=> 'Đen',
            'priceOld'=>$product['price'],
            'price'=>($product['discount']>0)?((1-$product['discount'])*$product['price']):$product['price'],
            'quantity'=>1
        ];
        if(isset($_SESSION['cart'][$idUser][$id])){
            if($_SESSION['cart'][$idUser][$id]['quantity']<$product['stockQuantity']){
                $_SESSION['cart'][$idUser][$id]['quantity']+=1;
            }
        }
    }

    // Trừ số lượng
    if($action=='giam'){
        $id = getGet('id');
        $sql="select 
        products.id as id, products.thumbnail as thumbnail, products.model as model,
        versions.ram as ram, versions.rom as rom, 
        products.price as price, products.discount as discount, products.stockQuantity as stockQuantity
        from products 
        join versions on products.versionId=versions.id
        where products.id = $id";
        $product=select($sql,true);

        $item= [
            'id'=>$product['id'],
            'image'=>$product['thumbnail'],
            'model'=>$product['model'],
            'version' => $product['ram']."/".$product['rom'],
            'color'=> 'Đen',
            'priceOld'=>$product['price'],
            'price'=>($product['discount']>0)?((1-$product['discount'])*$product['price']):$product['price'],
            'quantity'=>1
        ];
        if(isset($_SESSION['cart'][$idUser][$id])){
            if($_SESSION['cart'][$idUser][$id]['quantity']>1){
                $_SESSION['cart'][$idUser][$id]['quantity']-=1;
            }else{
                $_SESSION['cart'][$idUser][$id]=$item;
            }
        }
    }
    
    // Xoá tất cả
    if($action=='xoacart'){
        if(isset($_SESSION['cart'][$idUser])){
            unset($_SESSION['cart'][$idUser]);
            // $_SESSION['cart'][$idUser]=[];
        }
    }

    // Xoá
    if($action=='xoa'){
        $id = getGet('id');
        $sql="select 
        products.id as id, products.thumbnail as thumbnail, products.model as model,
        versions.ram as ram, versions.rom as rom, 
        products.price as price, products.discount as discount, products.stockQuantity as stockQuantity
        from products 
        join versions on products.versionId=versions.id
        where products.id = $id";
        $product=select($sql,true);

        $item= [
            'id'=>$product['id'],
            'image'=>$product['thumbnail'],
            'model'=>$product['model'],
            'version' => $product['ram']."/".$product['rom'],
            'color'=> 'Đen',
            'priceOld'=>$product['price'],
            'price'=>($product['discount']>0)?((1-$product['discount'])*$product['price']):$product['price'],
            'quantity'=>1
        ];
        if(isset($_SESSION['cart'][$idUser][$id])){
            unset($_SESSION['cart'][$idUser][$id]);
        }
    }
    // echo "<pre>";
    // var_dump($_SESSION['cart']);
    // echo "</pre>";
    
    header("location: $currentURL");
    ob_end_flush();
?>