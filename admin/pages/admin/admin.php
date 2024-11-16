<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../CSS/inforUser.css">
    <style>
        .active{
            color: rgb(26, 26, 26);
        }
    </style>
</head>
<body>
    <?php
        $idUser=getSession('admin');
        $sql="select * from users where id=$idUser";
        $user=select($sql,true);
        $error=array();
        if(isset($_POST['saveBtn'])){
            $username=$_POST['username'];
            $fullName=getPost('fullName');
            $email=$_POST['email'];
            $phoneNumber=getPost('phoneNumber');
            $sex=getPost('sex');
            $updateAt = date("Y-m-d H:i:s");
            if($_FILES["avatar"]["name"]!=""){
                $avatar = basename($_FILES["avatar"]["name"]);
                $tempAvatar = basename($_FILES["avatar"]["tmp_name"]);
            }else{
                $avatar=$user['avatar'];
            }
            $idUser=getSession('id');
            
            $sqlUsers="select * from users";
            $users= select($sqlUsers,false);

            if(empty($username)){
                $error['usernameEmpty']="Vui lòng không để trống Tên đăng nhập!";
            }
            if(empty($email)){
                $error['emailEmpty']="Vui lòng không để trống Email!";
            }
            foreach($users as $value){
                if($username==$value['username'] && $idUser!=$value['id']){
                    $error['usernameIsset']="Tên đăng nhập đã tồn tại!";
                }
                if($email==$value['email'] && $idUser!=$value['id']){
                    $error['emailIsset']="Email đã tồn tại!";
                }
                if($phoneNumber==$value['phoneNumber'] && $idUser!=$value['id'] && $phoneNumber!=""){
                    $error['phoneNumIsset']="Số điện thoại đã tồn tại!";
                }
            }
            if(empty($error)){
                $targetDirectory = "../assets/images/users/"; // Thư mục lưu trữ tệp tin đã tải lên
                $targetFile = $targetDirectory . $avatar; // Đường dẫn đầy đủ đến tệp tin trên server

                // Kiểm tra xem tệp tin đã tồn tại chưa
                if (file_exists($targetFile)) {
                    // echo "Tệp tin đã tồn tại.";
                    $sqlAvatar="update users set avatar='$targetFile' WHERE id=$idUser";
                    iud($sqlAvatar);
                } else {
                    // Thực hiện tải lên tệp tin
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                        // echo "Tải lên thành công. Đường dẫn tệp tin: " . $targetFile;
                        $sqlAvatar="update users set avatar='$targetFile' WHERE id=$idUser";
                        iud($sqlAvatar);
                    } else {
                        // echo "Có lỗi khi tải lên tệp tin.";
                    }
                }

                $sqlUpdate="UPDATE users SET fullName='$fullName',
                username='$username',email='$email',phoneNumber='$phoneNumber',
                sex='$sex', updateAt='$updateAt' WHERE id=$idUser";
                iud($sqlUpdate);
            }
            // echo "<pre>";
            // var_dump($error);
            // var_dump($avatar);
            // // var_dump($tempAvatar);
            // echo "</pre>";
        }
        
    ?>

    <div class="inforUserContainer" style="max-width: 1200px">
        <?php
            if(count($error)>0){
        ?>
                <div id="errorU" class="alert alert-danger p-0 fixed top-8 right-0 max-w-base m-0 z-50 <?php echo (count($error)>0)?'':'invisible';?>" role="alert">
                    <div class="mx-0 my-auto p-2 ">
                        
                            <p class="font-semibold ml-2">Bạn cần kiểm tra lại thông tin</p>
                            <?php
                                foreach($error as $value){
                                    if(isset($value)){
                            ?>
                                        <p class="text-sm ml-1"><?php echo $value;?></p>
                            <?php
                                    }
                                }
                            ?>
                        
                    </div>
                </div>
        <?php
            }
        ?>
        <div class="inforUserSideBar p-4">
            <div class="flex w-1/2">
                <img src="<?php echo $user['avatar'];?>" width="40px" alt="" class="rounded-full">
                <div class="pl-1">
                    <p class="my-auto mx-0 text-sm font-bold"><?php echo $user['username'];?></p>
                    <p id="edit" class="cl leading-tight text-sm text-slate-600 cursor-pointer hover:text-slate-800"><a href="?action=admin/profile"><i class="fas fa-edit"></i> Sửa hồ sơ</a></p>

                </div>
            </div>
            <p id="myAcc" class="myAcc cl cursor-pointer text-base mt-3 text-slate-800">
                <a href="?action=admin/profile">
                    <i class="far fa-user"></i> Tài khoản của tôi
                </a>
            </p>
            <ul id="myAccSub" class="text-sm ml-6">
                <a href="?action=admin/profile" class="cursor-pointer liAcc text-slate-800 active"><li >Hồ sơ</li></a>
                <a href="?quanly=user/account/payment" class="cursor-pointer liAcc hover:text-slate-500 hidden"><li>Ngân hàng</li></a>
                <a href="?quanly=user/account/address" class="cursor-pointer liAcc hover:text-slate-500 hidden"><li>Địa chỉ</li></a>
                <a href="?action=admin/change_password" class="cursor-pointer liAcc hover:text-slate-500"><li>Đổi mật khẩu</li></a>
                <a href="?action=admin/profile" class="cursor-pointer liAcc hover:text-slate-500"><li>Cài đặt thông báo</li></a>
            </ul>
            <p class="cl cursor-pointer text-base mt-3 hover:text-slate-500  myAcc hidden" >
                <a href="?quanly=user/purchase">
                    <i class="fa-regular fa-rectangle-list"></i> <span>Đơn mua</span>
                </a>
            </p>
            <p class="cl cursor-pointer text-base mt-3 hover:text-slate-500 myAcc" >
                <a href="?action=admin/profile">
                    <i class="fa-regular fa-bell"></i> <span>Thông báo</span>
                </a>
            </p>
        </div>
        <div class="inforUserArticle shadow-sm bg-white my-3 rounded p-2">
            <div class="border-b p-2" style="margin-bottom: 50px;">
                <h2 class="text-lg">Hồ sơ của tôi</h2>
                <p class="text-sm">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            </div>
            <form action="" method="post" style="width: 90%; padding: 10px;" enctype="multipart/form-data">
                <div class="flex" style="width: 100%;">
                    <div style="width: 80%;" class="flex-initial">
                        <div class="flex mb-2">
                            <label class="flex-initial w-1/4 my-auto mx-0" for="">Tên đăng nhập</label>
                            <input name="username" class="w-3/4 flex-initial mx-4 border-1 p-2 rounded focus:outline-none indent-2" type="text" value="<?php echo $user['username'];?>">
                        </div>
                        <div class="flex mb-2">
                            <label class="flex-initial w-1/4 my-auto mx-0" for="">Họ và tên</label>
                            <input name="fullName" class="w-3/4 flex-initial mx-4 border-1 p-2 rounded focus:outline-none indent-2" type="text" value="<?php echo $user['fullName'];?>">
                        </div>
                        <div class="flex mb-2">
                            <label class="flex-initial w-1/4 my-auto mx-0">Email</label>
                            <input name="email" class="w-3/4 flex-initial mx-4 border-1 p-2 rounded focus:outline-none indent-2" type="text" value="<?php 
                                    echo $user['email'];
                                ?>">
                        </div>
                        <div class="flex mb-2">
                            <label class="flex-initial w-1/4 my-auto mx-0">Số điện thoại</label>
                            <input name="phoneNumber" class="w-3/4 flex-initial mx-4 border-1 p-2 rounded focus:outline-none indent-2" type="text" value="<?php echo $user['phoneNumber'];?>">
                        </div>
                        <div class="flex mb-2 mt-3">
                            <p class="flex-initial w-1/4 my-auto mx-0">Giới tính</p>
                            <div class="w-3/4 flex-initial mx-4 ">
                                <input class="cursor-pointer w-4 h-4" type="radio" name="sex" value="1" id="nam" <?php echo ($user['sex']==1)?"checked":"";?>><label class="cursor-pointer mx-0 my-auto pl-1 pr-4" for="nam">Nam</label>
                                <input class="cursor-pointer w-4 h-4" type="radio" name="sex" value="0" id="nu" <?php echo ($user['sex']==0)?"checked":"";?>><label class="cursor-pointer mx-0 my-auto pl-1 pr-4" for="nu">Nữ</label>
                                <input class="cursor-pointer w-4 h-4" type="radio" name="sex" value="2" id="khac" <?php echo ($user['sex']==2)?"checked":"";?>><label class="cursor-pointer mx-0 my-auto pl-1 pr-4" for="khac">Khác</label>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" name="saveBtn" class="border rounded py-1 px-3 border-teal-700 bg-neutral-50 hover:bg-teal-600 hover:text-white" >Lưu</button>
                        </div>
                    </div>
                    <div style="width: 20%;" class="flex-initial">
                        <img src="<?php echo $user['avatar']?>" class="rounded-full ml-9" id="image" alt="">
                        <input type="file" name="avatar" class="ml-5 mt-3 cursor-pointer" id="btn" onchange="displayImage()">
                    </div>
                </div>
                
            </form>
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
    <script>
        function displayImage() {
            // Lấy thẻ input file và thẻ img
            var input = document.getElementById('btn');
            var image = document.getElementById('image');

            // Kiểm tra xem đã chọn tệp ảnh chưa
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // Đọc nội dung tệp ảnh và đặt nó làm nguồn ảnh của thẻ img
                reader.onload = function (e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // JavaScript để ẩn div sau 3 giây
        setTimeout(function(){
            // Lấy tham chiếu đến div
            var error = document.getElementById("errorU");
            if (error) {
                // Kiểm tra xem classList có tồn tại không trước khi thao tác
                if (error.classList) {
                    // Thêm class 'hidden' để ẩn div
                    error.classList.add("hiddenU");
                }
            }
        }, 6000);
    </script>
</body>
</html>