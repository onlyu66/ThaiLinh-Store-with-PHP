<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./CSS/inforUser.css">
</head>
<body>
    <?php
        $idUser=getSession('id');
        $sql="select * from users where id=$idUser";
        $user=select($sql,true);
    ?>
    <div class="inforUserContainer">
        <div class="inforUserSideBar p-4">
            <div class="flex w-1/2">
                <img src="<?php echo $user['avatar'];?>" width="40px" alt="" class="rounded-full">
                <div class="pl-1">
                    <p class="my-auto mx-0 text-sm font-bold"><?php echo $user['username'];?></p>
                    <p id="edit" class="cl leading-tight text-sm text-slate-600 cursor-pointer hover:text-teal-600"><a href="?quanly=user/account/profile"><i class="fas fa-edit"></i> Sửa hồ sơ</a></p>

                </div>
            </div>
            <p id="myAcc" class="myAcc cl cursor-pointer text-base mt-3 hover:text-teal-600">
                <a href="?quanly=user/account/profile">
                    <i class="far fa-user"></i> Tài khoản của tôi
                </a>
            </p>
            <ul id="myAccSub" class="text-sm ml-6">
                <a href="?quanly=user/account/profile" class="cursor-pointer liAcc hover:text-teal-600 "><li >Hồ sơ</li></a>
                <a href="?quanly=user/account/payment" class="cursor-pointer liAcc hover:text-teal-600 active"><li>Ngân hàng</li></a>
                <a href="?quanly=user/account/address" class="cursor-pointer liAcc hover:text-teal-600 "><li>Địa chỉ</li></a>
                <a href="?quanly=user/account/change_password" class="cursor-pointer liAcc hover:text-teal-600"><li>Đổi mật khẩu</li></a>
                <a href="?quanly=user/account/setting/notification" class="cursor-pointer liAcc hover:text-teal-600"><li>Cài đặt thông báo</li></a>
            </ul>
            <p class="cl cursor-pointer text-base mt-3 hover:text-teal-600 myAcc" >
                <a href="?quanly=user/purchase">
                    <i class="fa-regular fa-rectangle-list"></i> <span>Đơn mua</span>
                </a>
            </p>
            <p class="cl cursor-pointer text-base mt-3 hover:text-teal-600 myAcc" >
                <a href="?quanly=user/notifications">
                    <i class="fa-regular fa-bell"></i> <span>Thông báo</span>
                </a>
            </p>
        </div>
        <div class="inforUserArticle shadow-sm bg-white my-3 rounded ">
        <?php
            
        ?>
        </div>
    </div>
    <script>
        let myAcc=document.getElementsByClassName('myAcc');
        var myAccSub = document.getElementById('myAccSub');
        myAccSub.style.display='none';
        for (var i = 0; i < myAcc.length; i++) {
            myAccSub.style.display=(myAccSub.style.display === 'none') ? 'block' : 'none';
            
            myAcc[i].addEventListener('click', function() {
                for (var j = 0; j < myAcc.length; j++) {
                    myAcc[j].classList.remove('active');
                }
                this.classList.add('active');
                myAccSub.style.display=(myAccSub.style.display === 'none') ? 'block' : 'none';
            });
            for (let k = 1; k < myAcc.length; k++) {
                myAcc[k].addEventListener('click', function() {
                    myAccSub.style.display='none';
                });
            }
        }

        var liList = document.getElementsByClassName('liAcc');
        for (var i = 0; i < liList.length; i++) {
            liList[i].addEventListener('click', function() {
                // Loại bỏ lớp 'active' từ tất cả các li
                for (var j = 0; j < liList.length; j++) {
                    liList[j].classList.remove('active');
                }

                // Thêm lớp 'active' cho li được click
                this.classList.add('active');
            });
        }
        
        let edit = document.getElementById('edit');
        // edit.addEventListener('click', function(){
        //     myAcc[0].classList.add('active');
        //     myAccSub.style.display='block';
        //     // liList[0].classList.add('active');
        // });

        let cl = document.getElementsByClassName('cl');
        for (var i = 0; i < cl.length; i++) {

            cl[0].addEventListener('click', function() {
                for (var j = 0; j < cl.length; j++) {
                    cl[j].classList.remove('active');
                }
                // this.classList.add('active');
                cl[1].classList.add('active');
                myAccSub.style.display='block';
            });
            cl[1].classList.add('active');

            cl[1].addEventListener('click', function() {
                for (var j = 0; j < cl.length; j++) {
                    cl[j].classList.remove('active');
                }
                this.classList.add('active');
                myAccSub.style.display=(myAccSub.style.display === 'none') ? 'block' : 'none';
            });
            cl[2].addEventListener('click', function() {
                for (var j = 0; j < cl.length; j++) {
                    cl[j].classList.remove('active');
                }
                this.classList.add('active');
                myAccSub.style.display='block';

            });
            cl[3].addEventListener('click', function() {
                for (var j = 0; j < cl.length; j++) {
                    cl[j].classList.remove('active');
                }
                this.classList.add('active');
                myAccSub.style.display='block';

            });
            for (let k = 2; k < cl.length; k++) {
                cl[k].addEventListener('click', function() {
                    myAccSub.style.display='none';
                });
            }
        }
    </script>
</body>
</html>