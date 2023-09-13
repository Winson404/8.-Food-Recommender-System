<title>Recipick | Deactivated customer records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Deactivated customer records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Deactivated customer records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <!-- <a href="users_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Customer</a> -->

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                 <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>SELECTED DIET</th>
                   <!-- <th>CUISINE TYPE</th>-->
                    <th>USER TYPE</th>
                    <th>DATE REGISTERED</th>
                  <!--  <th>TOOLS</th>-->
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE role_as=0 AND deactivate=1 ORDER BY date_created ASC");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {

                      ?>
                    
                    <tr>
                        <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['diet_name']; ?></td>
                      <!--  <td><?php echo $row['cuisine_type']; ?></td>-->
                        <td>
                          <?php if($row['role_as'] == 0): ?>
                          <span class="badge badge-info">Customer</span>
                          <?php else: ?>
                          <span class="badge badge-success">Admin</span>
                          <?php endif; ?>
                        </td> 
                        <td><?php echo date("Y-m-d", strtotime($row['date_created'])); ?></td>
                      <!--  <td>
                          <a class="btn btn-info btn-sm" href="users_mgmt.php?page=<?php echo $row['id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                          <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></button>
                        </td> -->
                    </tr>

                    <?php include 'users_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
                      </tr>
                    <?php }?>

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->