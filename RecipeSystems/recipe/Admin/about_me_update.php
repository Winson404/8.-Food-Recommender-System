<title>Profile update | Recipick</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Update info</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Information</h3>
              </div>
                <?php if(isset($_SESSION['success'])) { ?> 
                    <p class="alert alert-success position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['success']; ?></p> 
                <?php unset($_SESSION['success']); } ?>

                <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                <?php  if(isset($_SESSION['exists'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['exists']; ?></p>
                <?php unset($_SESSION['exists']); } ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="about_me_update_code.php" method="POST" enctype="multipart/form-data">
                     <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="admin_Id">
                     <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-4 d-flex justify-content-center">
                                <img src="../images/logo1.png" alt="" width="100" style="height: 100px; border-radius: 50%;">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label>First name</label>
                                  <input type="text" class="form-control form-control-sm" value="<?php echo $row['fname']; ?>" name="firstname">
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label>Last name</label>
                                  <input type="text" class="form-control form-control-sm" value="<?php echo $row['lname']; ?>" name="lastname">
                                </div>
                            </div>
                         
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label>Email address</label>
                                  <input type="email" class="form-control form-control-sm" value="<?php echo $row['email']; ?>" name="email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label>Date</label>
                                  <input type="date" class="form-control form-control-sm" value="<?php echo $row['date_created']; ?>" name="date">
                                </div>
                            </div>
                        </div>
                   </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update_admin"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
         </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <?php include 'footer.php'; ?>
 
</body>
</html>
