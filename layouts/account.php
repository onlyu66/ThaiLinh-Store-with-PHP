<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./CSS/account.css">
</head>
<body>
<?php 
    // session_start();
    // session_destroy();
    if(isset($_SESSION['id'])){
        $id=getSession('id');
        $sqlBlock="select * from users where id='$id'";
        $user=select($sqlBlock,true);
        if($user['status']==3){
            unset($_SESSION['id']);
            header("location: ?quanly=home");
        }
    }
    if(isset($_POST['logout'])){
        $id=getSession('id');
        $logOut=date("Y-m-d H:i:s");
        $sql="update users set logOutAt='$logOut', status='2' where id='$id'";
        iud($sql);
        unset($_SESSION['id']);
        header("location: ?quanly=home");
    }
    if(isset($_SESSION['id'])){
        $id=getSession('id');
        $sql="select * from users where id='$id'";
        $user=select($sql,true);
?>
        
    <form class="logoutForm float-right w-36" action="" method="post">
        <div class="flex relative w-1/3">
            <a href="?quanly=user/purchase">
                <img src="<?php echo $user['avatar'];?>" width="30px" height="30px" alt="" class="rounded-full shadow-lg hover:shadow-xl">
            </a>
            <i class="cursor-pointer fa-solid fa-sort-down mx-0 my-auto pl-1 shadow-lg hover:shadow-xl" id="nut"></i>
        </div>
        <div class="absolute top-9 bg-white border-2 p-2 rounded shadow-sm z-10" id="sub">
            <p class="mx-0 my-auto text-sm">Xin chào <?php echo $user['username'];?>!</p>
            <a href="?quanly=user/account/profile" class="text-sm ml-1 hover:font-medium">Sửa thông tin</a><br>
            <a href="?quanly=user/purchase" class="text-sm ml-1 hover:font-medium">Xem đơn hàng</a><br>
            <input type="submit" class="mx-0 my-auto text-sm pl-1 hover:font-medium" name="logout" value="Đăng xuất"/>
        </div>
    </form>
    


<?php
    }else{
        if(!isset($_SESSION['id'])){
            // unset($_SESSION['cart']);
        }
        // $_SESSION['cart']=array(array(),0);

        // header("location: http://localhost/ThaiLinhStore/?quanly=home");
?>
        <div class="flex justify-end text-sm">
        <a href="./admin/authen/login.php" class="login" >Đăng nhập</a>
        </div>
<?php

    }
?>
<script>
    let nut=document.getElementById('nut');
    let sub=document.getElementById('sub');
    if(sub!=null && nut!=null){
        sub.style.display='none';
        nut.addEventListener('click',function () {
            sub.style.display=(sub.style.display=='block')?'none':'block';
        });
    }
    
</script>
</body>
</html>