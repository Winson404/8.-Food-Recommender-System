<?php
    include '../config.php';
    
    if(isset($_SESSION['role_as_admin'])) {
        $id = $_SESSION['role_as_admin'];
        
        // RECORD TIME LOGGED IN
        $_SESSION['last_active'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recipick</title>

  <!---FAVICON ICON FOR WEBSITE--->
  <link rel="shortcut icon" type="image/png" href="../images/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="../css/fontawesome-free/css/all.min.css"> -->
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/ba6fe04144.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="css/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="css/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="css/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="css/summernote-bs4.min.css">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <!-- TOASTER -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
  

  <!-- DataTables -->
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="css/buttons.bootstrap4.min.css">

  <script src="js/bootstrap5-downloaded-ni-erwin/bootstrap.bundle.min.js" type="text/javascript"></script>

<style>
  .modal-content{
    -webkit-box-shadow: 0 5px 15px rgba(0,0,0,0);
    -moz-box-shadow: 0 5px 15px rgba(0,0,0,0);
    -o-box-shadow: 0 5px 15px rgba(0,0,0,0);
    box-shadow: 0 5px 15px rgba(0,0,0,0);
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  
<div class="wrapper">

  <!-- Preloader -->
 <!--  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <!--  <a href="admin.php" class="nav-link">Administrators</a>-->
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- FULL SCREEN -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- FULL SCREEN -->
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Recipick</span>
    </a>

    <?php 
        $admin = mysqli_query($conn, "SELECT * FROM users_account WHERE id='$id'");
        $row = mysqli_fetch_array($admin);
    ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/logo1.png" alt="User Image" style="height: 34px; width: 34px; border-radius: 50%;">
        </div>
        <div class="info">
          <a href="about_me.php" class="d-block"><?php echo ' '.$row['fname'].' '.$row['lname'].' '; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">DIET</li>
          <?php
            $diet = mysqli_query($conn, "SELECT diet_Id from diet");
            $row_diet = mysqli_num_rows($diet);
          ?>
          <li class="nav-item">
            <a href="diet.php" class="nav-link">
              <i class="fa-solid fa-calendar-check"></i>
              <p>
                &nbsp; Diet list
                <span class="badge badge-danger right"><?php echo $row_diet;  ?></span>
              </p>
            </a>
          </li>


          <?php
            $recipe = mysqli_query($conn, "SELECT recipe_Id from recipe");
            $row_recipe = mysqli_num_rows($recipe);
          ?>
          <li class="nav-item">
            <a href="recipe.php" class="nav-link">
              <i class="fa-solid fa-calendar-check"></i>
              <p>
                &nbsp; Recipe list
                <span class="badge badge-secondary right"><?php echo $row_recipe;  ?></span>
              </p>
            </a>
          </li>


          <?php
            $user_uploads = mysqli_query($conn, "SELECT recipe_Id from recipe WHERE recipe_uploaded_by != '$id' AND recipe_status != 1  ");
            $row_user_uploads = mysqli_num_rows($user_uploads);
          ?>
          <li class="nav-item">
            <a href="recipe_user_uploads.php" class="nav-link">
              <i class="fa-solid fa-calendar-check"></i>
              <p>
                &nbsp; Recipe user uploads
                <span class="badge badge-warning right"><?php echo $row_user_uploads;  ?></span>
              </p>
            </a>
          </li>


          
          <li class="nav-header">CUSTOMERS</li>
           <?php
            $customer = mysqli_query($conn, "SELECT id from users_account WHERE role_as='0' AND deactivate=0");
            $row_customer = mysqli_num_rows($customer);
           ?>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="fa-solid fa-users"></i>
              <p>
                &nbsp;&nbsp; Customers
                <span class="badge badge-primary right"><?php echo $row_customer;  ?></span>
              </p>
            </a>
          </li>

          <?php
            $deactivate = mysqli_query($conn, "SELECT id from users_account WHERE role_as='0' AND deactivate=1");
            $row_deactivate = mysqli_num_rows($deactivate);
           ?>
          <li class="nav-item">
            <a href="users_deactivated.php" class="nav-link">
              <i class="fa-solid fa-users"></i>
              <p>
                &nbsp;&nbsp; Deactivated customers
                <span class="badge badge-primary right"><?php echo $row_deactivate;  ?></span>
              </p>
            </a>
          </li>



          <li class="nav-header">COMMUNITY ACTIVITIES</li>
          <li class="nav-item">
            <a href="activity.php" class="nav-link">
              <i class="fa-solid fa-puzzle-piece"></i>
              <p> &nbsp;&nbsp; Activities </p>
            </a>
          </li>



          <li class="nav-header">SECURITY</li>
          <li class="nav-item">
            <a href="changepassword.php" class="nav-link">
              <i class="fa-solid fa-key"></i>
              <p>
                &nbsp;&nbsp; Change password
              </p>
            </a>
          </li>


          <li class="nav-header">PROFILE</li>
          <li class="nav-item">
            <a href="about_me.php" class="nav-link">
              <i class="fa-solid fa-user"></i>
              <p>
                &nbsp;&nbsp; About me
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="" data-toggle="modal" data-target="#logoutmodal" class="nav-link">
              <i class="fa-solid fa-power-off"></i>
              <p>
                &nbsp; Logout
              </p>
            </a>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <!-------------------------------LOGOUT MODAL------------------------------------>
      <div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
             <div class="modal-header alert-light">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Admin logout</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
              </button>
            </div>
            <div class="modal-body">
              <form action="../logout.php" method="POST">
                <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" name="user_Id">
                <h6>Mr./ Ma'am <?php echo $row['fname'];?>, are you sure you want to logout?</h6>
            </div>
            <div class="modal-footer alert-light">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
              <button type="submit" class="btn btn-primary" name="delete_user"><i class="fa-solid fa-circle-check"></i> Confirm</button>
            </div>
              </form>
          </div>
        </div>
      </div>
  <!-------------------------------END LOGOUT MODAL-------------------------------->


<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
    } else {
     header('Location: ../SignIn.php');
    }
?>
