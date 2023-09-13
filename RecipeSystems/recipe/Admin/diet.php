<title>Diet | Recipick</title>


<?php 

  include 'navbar.php'; 
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Diet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Diet</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex">
                 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_fee"><i class="bi bi-plus-circle"></i> Add</button>

                  <?php if(isset($_SESSION['success'])) { ?> 
                      <h3 class="alert card-title position-absolute py-2 alert-success rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['success']; ?></h3>
                  <?php unset($_SESSION['success']); } ?>


                  <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></h3>
                  <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                  <?php  if(isset($_SESSION['exists'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['exists']; ?></h3>
                  <?php unset($_SESSION['exists']); } ?>
              
                </div>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Diet image</th>
                    <th>Diet name</th>
                 <!--   <th>Tools</th>-->
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM diet");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td>
                          <img src="../images-diet/<?php echo $row['diet_image']; ?>" alt="" style="height: 70px; width: 100px;">
                        </td>
                        <td><?php echo $row['diet_name']; ?></td>
                        <td>
                    <!--        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<?php echo $row['diet_Id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['diet_Id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                        </td> -->
                    </tr>

                    <?php include 'diet_update_delete.php'; } ?>

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>Diet image</th>
                        <th>Diet name</th>
                   <!--     <th>Tools</th>-->
                      </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


 <?php include 'diet_add.php'; ?>


 <?php include 'footer.php'; ?>
 





