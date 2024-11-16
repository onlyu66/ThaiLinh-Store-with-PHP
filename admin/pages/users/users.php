<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="styles/users.css">
    
</head>

<body>
<form action="" method="post" class="relative">
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
    <?php
      include_once "../untils/utility.php";
      // session_start();
      $sort = isset($_SESSION["sort"]) ? $_SESSION["sort"] : "id";
      // echo $sort;
    ?>
      <div class="sortAdd flex justify-between">
        <form class="sort" method="post" action="">
          <select name="sort" id="selectSort">
            <option value="id" <?php if ($sort == "id") echo "selected"; ?>>Lastest</option>
            <option value="username" <?php if ($sort == "username") echo "selected"; ?>>Name</option>
            <option value="age" <?php if ($sort == "age") echo "selected"; ?>>Price</option>
            <option value="deliveryMethod" <?php if ($sort == "deliveryMethod") echo "selected"; ?>>Quantity</option>
          </select>
        </form>
        <div>
            <!-- {selectProduct ? "Update Product" : "Add Product"} -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary button !bg-neutral-900 !text-white" data-bs-toggle="modal" data-bs-target="#addUser" >
            Add User
            </button>

            <!-- Modal -->
            <?php
    $errors = array();
    // echo password_hash($_POST["password"],PASSWORD_DEFAULT) . "<br>";
    // echo password_hash($_POST["confirmPassword"],PASSWORD_DEFAULT);
    if(isset($_POST['addUserBtn'])){
        $roleId=$_POST['role'];
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
        // session_start();
        // $_SESSION['errAddUser']=$errors;
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
              $active=1;
              $sqlRegister="INSERT INTO users(avatar, username, email, password,roleId, createAt, active) VALUES ('$avatar','$username','$email','$passwordHash', '$roleId', '$createAt', '$active') ";
              iud($sqlRegister);
              $successRegister="Đăng ký thành công!";
              // header("location: ./login.php");
          }

          
        }
    }
?>
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
              <?php include_once "addUser.php";?>
            </div>
            <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUserLabel" aria-hidden="true">
                <?php include_once "viewUser.php";?>
            </div>



        </div>
      </div>
      <div style ="overflow: auto; max-height: 750px ">
        <table
          class="table table-striped table-hover text-center"
          style="width: 80%;  margin: 20px auto 10px auto"
        >
          <thead class="table-dark" >
            <tr>
              <th class="bg-neutral-900 text-white">                    
                <input type="checkbox" name="comfirmUser" id="selectAll"/>
                </th>
              <th class="bg-neutral-900 text-white">User ID</th>
              <th class="bg-neutral-900 text-white">Username</th>
              <th class="bg-neutral-900 text-white">Age</th>
              <th class="bg-neutral-900 text-white">Phone Number</th>
              <th class="bg-neutral-900 text-white">Role</th>
              <th class="bg-neutral-900 text-white">Status</th>
              <th class="bg-neutral-900 text-white" colspan="3">
                Action
              </th>
            </tr>
          </thead>
          
          <?php
            if($sort=="username"){
              $usersSql="
              SELECT 
              users.id as id, users.username as username, users.age as age, users.phoneNumber,
              role.role as role, statusUser.name as status, users.active as active
              FROM users 
              join statusUser on users.status=statusUser.id
              join role on users.roleId=role.id 
              ORDER BY users.username";
            }else if($sort== "age"){
              $usersSql="
              SELECT 
              users.id as id, users.username as username, users.age as age, users.phoneNumber,
              role.role as role, statusUser.name as status, users.active as active
              FROM users 
              join statusUser on users.status=statusUser.id
              join role on users.roleId=role.id
              ORDER BY users.age";
            }else if($sort== "deliveryMethod"){
              $usersSql="
              SELECT 
              users.id as id, users.username as username, users.age as age, users.phoneNumber,
              role.role as role, statusUser.name as status, users.active as active
              FROM users 
              join statusUser on users.status=statusUser.id
              join role on users.roleId=role.id
              ORDER BY users.role DESC";
            }else{
              $usersSql="
              SELECT 
              users.id as id, users.username as username, users.age as age, users.phoneNumber,
              role.role as role, statusUser.name as status, users.active as active, users.status as statusId
              FROM users
              join statusUser on users.status=statusUser.id
              join role on users.roleId=role.id
              ORDER BY users.id DESC";
            }
            // $queryProducts=mysqli_query($conn, $usersSql);
            $users = select($usersSql,false);
            // $_SESSION['users'][]=array('id'=>$users['id'],'categoryId'=>$users['categoryId'],'brandId'=>$users['brandId'],'username'=>$users['username'],'age'=>$users['age'],'status'=>$users['status'],'orderCode'=>$users['orderCode'],'description'=>$users['description'],'createAt'=>$users['createAt'],'updateAt'=>$users['updateAt'],'deliveryMethod'=>$users['deliveryMethod'],'deleted'=>$users['deleted']);
            // $_SESSION['users']=$users;
            // $arr=getSession('users');
            // unset($_SESSION['users'])
            
          ?>
            <tbody>
              <?php
                // if(isset($_SESSION['users'])){
                // $id=0;
                if(count($users)>0){
                foreach ($users as $user) {
              ?>
              <form action="" method="post">

              <tr id="<?php echo $user['id'];?>">
                <td>
                    <input type="checkbox" name="comfirmUser" class="checkbox">
                </td>
                <td class="text-sm"><?php echo $user['id'];?></td>
                <td class="text-sm"><?php echo $user['username'];?></td>
                <td class="text-sm"><?php echo $user['age'];?></td>
                <td class="text-sm"><?php echo $user['phoneNumber'];?></td>
                <td class="text-sm"><?php echo $user['role'];?></td>
                <td class="text-sm">
                    <i class="fa-solid fa-circle <?php echo ($user['statusId'] == 1) ? 'text-green-500' : (($user['statusId'] == 2) ? 'text-red-600' : 'text-orange-500'); ?> pr-2 text-xs"></i>
                    <?php echo $user['status'];?>
                </td>

                <td >
                  <button 
                    type="button"
                    class="btn btn-outline-info viewU text-sm "
                    data-bs-toggle="modal" data-bs-target="#viewUser"
                  >
                    View
                  </button>
                </td>
                <input type="hidden" value="<?php echo $user['id'] ;?>" class="idUser">
                <input type="hidden" value="<?php echo $user['active'] ;?>" class="activeUser">
                <td >
                    <button
                      type="button"
                      class="btn <?php echo $user['active']==1?"btn-outline-danger":"btn-outline-success";?> text-sm blockBtn"
                      name="delete"
                      <?php echo ($user['role']=="admin")?"disabled":"";?>
                    >
                    <?php echo $user['active']==1?"Block":"Active";?>
                    </button>
                </td>
              </tr>
            <?php
                  }
                }else{

            ?>
                  <!-- <div>trống</div> -->

            <?php
                } 

            ?>
            
            <!-- if(isset($_POST['deleted'])){
              $deleted=$_POST['an'];
              if($deleted=='on'){
                $a=0;
              }else{
                $a=1;
              }
              // echo $deleted;
              $sqlDel="update users set deleted = '$a' where id='$user[id]'";
              iud($sqlDel);
            } -->
            </form>
            </tbody>
          <tfoot>
            <!-- <tr>
              <td colSpan={8}>
                <Pagination style={{ display: "flex", justifyContent: "center" }}>
                  <Pagination.Prev onClick={handlePrev} />
                  {pages.map((_p) => (
                    <Pagination.Item
                      key={_p}
                      active={_p === currentPage}
                      onClick={() => handleCurrentPage(_p)}
                    >
                      {_p}
                    </Pagination.Item>
                  ))}

                  <Pagination.Next onClick={handleNext} />
                </Pagination>
              </td>
            </tr> -->
          </tfoot>
        </table>
        <div style="margin-left:125px;">
        <button class="btn btn-outline-danger text-sm">Block Selected Users</button>
        </div>
</form>
      
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    
    $('.viewU').click(function(){
        // Lấy giá trị của phần tử có lớp '.id'
    let id = $(this).closest('tr').find('.idUser').val();

        // Gửi yêu cầu AJAX để lấy dữ liệu từ editProduct.php
        $.post('./pages/users/viewUser.php', {id: id}, function(data){
            // Hiển thị dữ liệu trả về trong modal hoặc nơi bạn muốn
            $('#viewUser').html(data);
        });
        return false;
    });
    $('.blockBtn').click(function(){
    // Lấy giá trị của phần tử có lớp '.id'
    let id = $(this).closest('tr').find('.idUser').val();
    let active = $(this).closest('tr').find('.activeUser').val();

    // Gửi yêu cầu AJAX để xóa dữ liệu
    $.post('./pages/users/handleUser.php', {block: id, active: active}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần
        // alert(data);
        // Tải lại trang sau khi xóa thành công
        location.reload();
    });

    // Ngăn chặn các hành động mặc định của nút hoặc liên kết
    return false;
  });

  $('#selectSort').change(function(){
    let sort=$(this).val();
    $.post('./pages/users/handleProduct.php', {sort: sort}, function(data){
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu cần
        // alert(sort);
        $('#divP').html(data);
        // Tải lại trang sau khi xóa thành công
        location.reload();
    });
    return false;
  })

  $(document).ready(function() {
    $('#selectAll').change(function() {
        $('.checkbox').prop('checked', this.checked);
    });

});
    
    document.addEventListener('DOMContentLoaded', function() {
    let buttonPairs = document.querySelectorAll('.button-pair');

    buttonPairs.forEach(function(pair) {
      let blockBtn = pair.querySelector('.blockBtn');

      blockBtn.addEventListener('click', function() {
        if(blockBtn.classList.contains("btn-outline-danger")){
            blockBtn.classList.remove("btn-outline-danger");
            blockBtn.classList.add("btn-outline-success");
            blockBtn.textContent="Active";
        }else{
            blockBtn.classList.remove("btn-outline-success");
            blockBtn.classList.add("btn-outline-danger");
            blockBtn.textContent="Block";
        }
      });

    });
  });

</script>



    
</body>
</html>