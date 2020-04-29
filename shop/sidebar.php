<!-- Main Sidebar Container -->
<?php
  include('dbconn.php');
  $username = $_SESSION['user'];
  $sql="select * from login_user l, shop s where l.username='$username'";
  $query=mysqli_query($db,$sql);
  $fetch=mysqli_fetch_array($query);
  $_SESSION['cid'] = $fetch['uid'];
?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/cart.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Go Khareedo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">
            Hi <?php echo $fetch['name']; ?>!
              
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Place an order
                
              </p>
            </a>
            
          </li>
          
          <li class="nav-item">
            <a href="orders.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-bag"></i>
              <p>My Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="changepass.php" class="nav-link">
              <i class="nav-icon fa fa-key"></i>
              <p class="text">Change Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>