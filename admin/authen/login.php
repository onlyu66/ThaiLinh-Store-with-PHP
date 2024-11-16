
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hidden{
            visibility: hidden;
        }
    </style>
    <?php
        include_once "../../database/dbhelper.php";
        include_once "../../database/config.php";
        $errors = array();
        if(isset($_POST['loginBtn'])){
            $username = htmlspecialchars($_POST["userName"]);
            $password = htmlspecialchars($_POST["password"]);
        
    ?>
</head>
<body>
    <?php
            // Kiểm tra tên người dùng
            if (empty($username)) {
                $errors['username'] = "Tên người dùng không được để trống";
            }
        
            // Kiểm tra mật khẩu
            if (empty($password)) {
                $errors['password'] = "Mật khẩu không được để trống";
            }
        
            // Nếu không có lỗi, thực hiện các hành động đăng nhập
            if (empty($errors)) {
                if($username=="admin"){
                    $sqlAdmin = "SELECT * FROM users  WHERE (username LIKE '$username' OR email LIKE '$username') and roleId = 1 ";
                    $admin = select($sqlAdmin,true);
                    // Kiểm tra xác thực đăng nhập
                    if ($admin) {
                        if(password_verify($password, $admin['password'])){
                            $successLogin = "Đăng nhập thành công!";
                            $status=1;
                            $id=$admin['id'];
                            $sqlStatus="update users set status = '$status' where id = '$id'";
                            iud($sqlStatus);
                            session_start();
                            $_SESSION['admin'] = $id;
                            header("location:../../admin/?action=dashboard");
                        }else {
                        $errorLogin = "Đăng nhập thất bại! Mật khẩu không đúng.";
                        }
                    } else {
                        $errorLogin = "Đăng nhập thất bại! Tên người dùng hoặc email không đúng.";
                    }
                }else{
                    $sqlUser = "SELECT * FROM users WHERE (username LIKE '$username' OR email LIKE '$username') and roleId = 2";
                    $user = select($sqlUser,true);
                        // Kiểm tra xác thực đăng nhập
                    if ($user) {
                        if(password_verify($password, $user['password'])){
                            if($user['active']==1){
                                $successLogin = "Đăng nhập thành công!";
                                $status=1;
                                $id=$user['id'];
                                $sqlStatus="update users set status = '$status' where id = '$id'";
                                iud($sqlStatus);
                                session_start();
                                $_SESSION['id'] = $id;
                                header("location:../../?quanly=home");
                            }else{
                                $errorLogin = "Đăng nhập thất bại! Tài khoản của bạn đã bị khoá.";
                            }
                        }else {
                        $errorLogin = "Đăng nhập thất bại! Mật khẩu không đúng.";
                        }
                    } else {
                        $errorLogin = "Đăng nhập thất bại! Tên người dùng hoặc email không đúng.";
                    }
                }
                

                
            }
        // if (headers_sent()) {
        //     echo "Các header đã được gửi.";
        // } else {
        //     echo "Các header chưa được gửi.";
        // }
        // ob_end_flush();
        }
    ?>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <div class="body relative">
        <div id="error" class="alert alert-danger d-flex p-0 fixed top-0 right-0 max-h-12 max-w-base m-0<?php echo ($errorLogin||$successLogin)?'':'invisible';?>" role="alert">
            <svg class="w-5 ml-2 mr-2" role="img" aria-label="<?php if($errorLogin){echo "Danger:";}elseif($successLogin){echo "Success:";}?>"><use xlink:href="<?php if($errorLogin){echo "#exclamation-triangle-fill";}elseif($successLogin){echo "#check-circle-fill";}?>"/></svg>
            <div class="mx-0 my-auto pr-2"><?php echo $errorLogin?$errorLogin:$successLogin;?></div>
        </div>
        <img src="../../assets/images/icons/back.png" width="40px" alt="">
        <a href="http://localhost/ThaiLinhStore/?quanly=home" class="text-white ml-1 hover:font-medium cursor-pointer">Trở về trang chủ</a>
        <div class="container">
            <h2></h2>
            <div class="items">
            <div class="rItem">
                <img src="../../assets/images/logos/Logo.png" alt="This is a image" class="image" />
                <p>
                    <a  
                        href="./register.php"
                        class="text-sky-500 dark:text-sky-400 p"
                    >
                        Chưa có tài khoản
                    </a>
                </p>
            </div>
            <form class="form" autocomplete="off" action="" method="post">
                <div class="item">
                    <div class="mb-3 mb3">
                        <label
                        htmlFor="username"
                        class="form-label formLabel"
                        >
                        Tên đăng nhập:
                        </label>
                        <input
                        type="text"
                        class="form-control formControl"
                        name="userName"
                        value=""
                        />
                    </div>
                    <?php 
                        if(isset($errors['username'])){ ?>
                            <div class="alert" style="color: red">
                                <?php echo $errors['username']?>
                            </div>
                    <?php
                        }
                    ?>
                
                </div>
                <div class="item">
                    <div class="mb-3 mb3">
                        <label
                        htmlFor="password"
                        class="form-label formLabel"
                        >
                        Mật khẩu:
                        </label>
                        <input
                        type="password"
                        class="form-control formControl"
                        name="password"
                        value=""
                        />
                    </div>
                    <?php 
                        if(isset($errors['password'])){ ?>
                            <div class="alert" style="color: red">
                                <?php echo $errors['password']?>
                            </div>
                    <?php
                        }
                    ?>
                </div>

                <input
                type="submit"
                class="btn"
                name="loginBtn"
                value="Đăng nhập"
                />
                
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous">
    </script>
    <script>
        // JavaScript để ẩn div sau 3 giây
        setTimeout(function(){
            // Lấy tham chiếu đến div
            var error = document.getElementById("error");

            // Thêm class 'hidden' để ẩn div
            error.classList.add("hidden");
        }, 6000); // 3 giây
    </script>
</body>
</html>