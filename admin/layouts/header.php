<!-- <link rel="stylesheet" href="../styles/index.css"> -->
<div class="header flex justify-between p-3">
      <!-- <div class="menuIcon">
        <BsJustify class="icon" onClick={OpenSidebar} />
      </div> -->
      <!-- {selectItem === "dashboard" ? (
        <p>Welcome to ThaiLinh Store</p>
      ) : selectItem === "products" ? (
        <p>PRODUCTS</p>
      ) : selectItem === "users" ? (
        <p>USERS</p>
      ) : (
        <p>ORDERS</p>
      )} -->
      <?php 
        $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if($currentURL=="http://localhost/ThaiLinhStore/admin/?action=dashboard"){
          echo"<p>Welcome to ThaiLinh Store</p>";
        }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=products"){
          echo "<p>PRODUCTS</p>";
        }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=orders"){
          echo "<p>ORDERS</p>";
        }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=users"){
          echo "<p>USERS</p>";
        }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=admin/profile"){
          echo "<p>ADMIN</p>";
        }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=admin/change_password"){
          echo "<p>ADMIN</p>";
        }else {
          echo"<p>Welcome to ThaiLinh Store</p>";
        }
      ?>
      <form action="" method="get" class="formFilter">
        <input
          placeholder="Search"
          class="inputSearch h-10"
          type="text"
        />
        <button type="submit" class="<?php 
          if($currentURL=="http://localhost/ThaiLinhStore/admin/?action=dashboard"){
            echo"searchIcon";
          }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=products"){
            echo"searchIcon3";
          }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=orders"){
            echo"searchIcon1";
          }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=users"){
            echo"searchIcon1";
          }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=admin/profile"){
            echo"searchIcon1";
          }elseif($currentURL=="http://localhost/ThaiLinhStore/admin/?action=admin/change_password"){
            echo"searchIcon1";
          }
          ?>">
          <i class="fa-solid fa-magnifying-glass"></i>  
        </button>
      </form>
      <!-- {isAdmin ? ( -->
        <?php
          // session_start();
          if(isset($_POST['logout'])){
            $id=$_SESSION['admin'];
            $logOut=date("Y-m-d H:i:s");
            $sql="update users set logOutAt='$logOut' where id='$id'";
            iud($sql);
            if(isset($_SESSION['admin'])){
              unset($_SESSION['admin']);
              header("Location: ./authen/login.php");
              exit;
            }
          }
          $id=$_SESSION['admin'];
          $sql="select * from users where id = '$id'";
          $admin=select($sql,true);
        ?>
        <form class="logoutForm float-right group w-28" action="" method="post">
        <div class="flex cursor-pointer relative inline">
            <img src="<?php echo $admin['avatar'];?>" width="40px" height="40px" alt="" class="rounded-full shadow-lg hover:shadow-xl">
            <i class="fa-solid fa-sort-down mx-0 my-auto pl-1 shadow-lg hover:shadow-xl"></i>
        </div>
        <div class="z-55 absolute top-12 bg-white border-2 p-2 hidden rounded shadow-sm group-hover:block ">
            <p class="mx-0 my-auto text-sm">Xin chào <?php echo $admin['username'];?>!</p>
            <a href="?action=admin/profile" class="text-sm ml-1 hover:font-medium">Sửa thông tin</a><br>
            <input type="submit" class="mx-0 my-auto text-sm pl-1 hover:font-medium" name="logout" value="Đăng xuất"/>
        </div>
    </form>

</div>