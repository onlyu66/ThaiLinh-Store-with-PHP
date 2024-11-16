<div class="sideBar bg-neutral-900 text-white">
      
      <!-- {/* <div class={styles.sidebarTitle}>
        <div class='sidebar-brand'>
          <BsCart3  class='icon_header'/> SHOP
      </div> 
        <h3>THAILINH STORE</h3>
        <span class={styles.close_icon} onClick={OpenSidebar}>
          X
        </span>
      </div> */} -->
      <div>
        <div class="sidebarTitle">
          <!-- {/* <div class="sidebar-brand">
            <BsCart3 class="icon_header" /> SHOP
          </div> */} -->
          <h3>THAILINH STORE</h3>
          <!-- <span class={styles.close_icon} onClick={OpenSidebar}>
            X
          </span> -->
        </div>
        <ul class="list-none m-0 p-0 mt-5 text-slate-400">
          <a href="?action=dashboard" class="link text-slate-400">
            <li>
              <i class="fa-solid fa-gauge mr-1"></i>Dashboard
            </li>
          </a>

          <a href="?action=products" class="link text-slate-400">
            <li>
              <i class="fa-brands fa-uncharted mr-1"></i>Products
            </li>
          </a>

          <a href="?action=orders" class="link text-slate-400">
            <li>
              <i class="fa-solid fa-border-top-left mr-1"></i>Orders
            </li>
          </a>
          <a href="?action=users" class="link text-slate-400">
            <li>
              <i class="fa-solid fa-users-rays mr-1"></i>Users
            </li>
          </a>
        </ul>
      </div>
      <?php
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
      ?>

      <form action="" method="post">
        <ul class="list-none m-0 p-0 text-slate-400">
          <a href="?action=admin/profile">
            <li>Admin</li>
          </a>
          <li>Help</li>
          <li>Contact us</li>
        </ul>
        <button
          type="submit"
          name="logout"
          class="flex no-underline text-white hover:font-semibold mt-4"
        >
          <i class="fa-solid fa-right-to-bracket mr-1 mt-1.5"></i>
          <div>Log out</div>
        </button>
      </form>
    </div>