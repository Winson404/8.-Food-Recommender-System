<title>Activity | Recipick</title>


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
            <h1>Activity</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Activity</li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example111" class="table table-bordered table-striped table-sm text-sm">
                  <thead>
                  <tr>
                    <th>Customer name</th>
                    <th>Message</th>
                    <th>Comment</th>
                    <th>Diet type</th>
                    <th>Date posted</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM community JOIN users_account ON community.user_Id=users_account.id JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id LEFT JOIN comment ON community.com_Id=comment.com_Id WHERE users_account.deactivate=0");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td><?php echo $row['diet_name']; ?></td>
                        <td><?php echo date("F d, Y h:i A", strtotime($row['date_posted']));?></td>
                        <td>
                            <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#deactivate<?php echo $row['user_Id']; ?>">Deactivate user</button>
                        </td> 
                    </tr>

                    <?php include 'activity_delete.php';  }  ?>

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>Customer name</th>
                        <th>Diet type</th>
                        <th>Message</th>
                        <th>Comment</th>
                        <th>Date posted</th>
                        <th>Tools</th>
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




 <?php include 'footer.php'; ?>
 





