<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" type="text/css" href="../styles/register.css">
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
</head>
<body>
<?php
    include_once "../../database/dbhelper.php";
    include_once "../../database/config.php";
    $errors = array();
    // echo password_hash($_POST["password"],PASSWORD_DEFAULT) . "<br>";
    // echo password_hash($_POST["confirmPassword"],PASSWORD_DEFAULT);
    if(isset($_POST['registerBtn'])){
        $username=htmlspecialchars($_POST["userName"]);
        $email=htmlspecialchars($_POST["email"]);
        $password=htmlspecialchars($_POST["password"]);
        $confirmPassword=htmlspecialchars($_POST["confirmPassword"]);
        $avatar="./assets/images/users/1 - Copy - Copy - Copy - Copy.jpg";
        
        // Kiểm tra tên người dùng
        if (empty($username)) {
            $errors['username'] = "Tên người dùng không được để trống";
        }

        // Kiểm tra địa chỉ email
        if (empty($email)) {
            $errors['email'] = "Email không được để trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không hợp lệ";
        }

        // Kiểm tra mật khẩu
        if (empty($password)) {
            $errors['password'] = "Mật khẩu không được để trống";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Mật khẩu phải chứa ít nhất 6 ký tự";
        }

        // Kiểm tra xác nhận mật khẩu
        if (empty($confirmPassword)) {
            $errors['confirm_password'] = "Vui lòng xác nhận mật khẩu";
        } elseif ($password != $confirmPassword) {
            $errors['confirm_password'] = "Mật khẩu xác nhận không trùng khớp";
        }

        // Nếu không có lỗi, thực hiện các hành động đăng ký tài khoản
        if (empty($errors)) {
          $sqlUsers = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
          $stmt = mysqli_prepare($conn, $sqlUsers);

          // Kiểm tra lỗi prepare
          if ($stmt === false) {
              die(mysqli_error($conn));
          }

          // Gắn giá trị vào tham số và thực thi truy vấn
          mysqli_stmt_bind_param($stmt, "ss", $username, $email);
          mysqli_stmt_execute($stmt);

          // Lấy kết quả
          $result = mysqli_stmt_get_result($stmt);
          // Đóng câu lệnh prepare
          mysqli_stmt_close($stmt);
          // Kiểm tra số lượng bản ghi
          if (mysqli_num_rows($result) > 0) {
              $errorRegister = "Tên đăng nhập hoặc email đã tồn tại!";
          } else {
              // Tiếp tục quá trình đăng ký
              $createAt = date("Y-m-d H:i:s");
              $passwordHash=password_hash($_POST["password"],PASSWORD_DEFAULT);
              $roleId = 2;
              $active=1;
              $sqlRegister="INSERT INTO users(avatar, username, email, password,roleId, createAt, active) VALUES ('$avatar','$username','$email','$passwordHash', '$roleId', '$createAt', '$active') ";
              iud($sqlRegister);
              $successRegister="Đăng ký thành công!";
              header("location: ./login.php");
          }

          
        }
    }
?>
  <div class="body relative">
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
    <div id="error" class="alert alert-warning d-flex p-0 fixed top-0 right-0 max-h-12 max-w-base m-0<?php echo $errorRegister?'':'invisible';?>" role="alert">
      <svg class="w-5 ml-2 mr-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div class="mx-0 my-auto pr-2"><?php echo $errorRegister;?></div>
    </div>
    <div class="container">
          
          <h2></h2>
          <div class="items">
            <form class="form" action="" method="post">
              <div class="item">
                <div class="mb-3 mb3">
                  <label
                    htmlFor="username"
                    class="form-label formLabel"
                  >
                    Tên tài khoản:
                  </label>
                  <input
                    type="text"
                    class="form-control formControl"
                    placeholder="thailinh66"
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
                    htmlFor="email"
                    class="form-label formLabel"
                  >
                    Email:
                  </label>
                  <input
                    type="email"
                    class="form-control formControl"
                    placeholder="ngoclinhthai8@gmail.com"
                    name="email"
                    value=""
                  />
                </div>
                <?php 
                if(isset($errors['email'])){ ?>
                  <div class="alert" style="color: red">
                    <?php echo $errors['email']?>
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
                    placeholder="linh662002"
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
              <div class="item">
                <div class="mb-3 mb3">
                  <label
                    htmlFor="confirmPassword"
                    class="form-label formLabel"
                  >
                    Xác nhận mật khẩu:
                  </label>
                  <input
                    type="password"
                    class="form-control formControl"
                    placeholder="linh662002"
                    name="confirmPassword"
                    value=""
                    
                  />
                </div>
                <?php 
                  if(isset($errors['confirm_password'])){ ?>
                    <div class="alert" style="color: red">
                      <?php echo $errors['confirm_password']?>
                    </div>
                <?php
                  }
                ?>
                  
              </div>
              <input
                type="submit"
                class="btn"
                name="registerBtn"
                value="Đăng ký"
              />
            </form>
            <div class="rItem">
              <img src="../../assets/images/logos/Logo.png" alt="This is a image" class="image" />
              <p>
                <a
                  href="./login.php"
                  class="text-sky-500 dark:text-sky-400 p"
                >
                  Đã có tài khoản
                </a>
              </p>
            </div>
          </div>
    </div>
  </div>
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