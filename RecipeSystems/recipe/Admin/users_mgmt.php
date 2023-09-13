<title>Recipick | Customer info</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
      $sql = mysqli_query($conn, "SELECT * FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE id='$page'");
      $row = mysqli_fetch_array($sql);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- UPDATE -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3>Update Customer</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customer info</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="user_Id" required value="<?php echo $row['id']; ?>">
            <div class="card">
              <div class="card-body">
                  <div class="row">

                      <div class="col-lg-12 mt-1 mb-2">
                        <a class="h5 text-primary"><b>Basic information</b></a>
                        <div class="dropdown-divider"></div>
                      </div>
                      <div class="col-lg-6 col col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>First name</b></span>
                            <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['fname']; ?>">
                          </div>
                      </div>
                      <div class="col-lg-6 col col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Last name</b></span>
                            <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lname']; ?>">
                          </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Diet type</b></span>
                            <select class="form-control" name="diet" required>
                              <option selected disabled value="">Select diet</option>
                              <?php 
                                  $fetch = mysqli_query($conn, "SELECT * FROM diet");
                                  if(mysqli_num_rows($fetch) > 0) {
                                    while ($dietrow = mysqli_fetch_array($fetch)) {
                              ?>
                                  <option value="<?php echo $dietrow['diet_Id']; ?>" <?php if($dietrow['diet_Id'] == $row['select_meal_plan_history']) { echo 'selected'; } ?>><?php echo $dietrow['diet_name']; ?></option>
                              <?php        
                                    }
                                  } else {
                              ?>
                                    <option value="No club available">No diet available</option>
                              <?php
                                  }
                              ?>
                              
                            </select>
                          </div>
                        </div>

                      <div class="col-lg-6 col col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Cuisine type</b></span>
                            <input type="text" class="form-control"  placeholder="Cuisine type" name="cuisine_type" required onkeyup="lettersOnly(this)" value="<?php echo $row['cuisine_type']; ?>">
                          </div>
                      </div>

                      <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                        <a class="h5 text-primary"><b>Contact details</b></a>
                        <div class="dropdown-divider"></div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Email</b></span>
                            <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?php echo $row['email']; ?>">
                            <small id="text" style="font-style: italic;"></small>
                          </div>
                      </div>

                      <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                        <a class="h5 text-primary"><b>Security</b></a>
                        <div class="dropdown-divider"></div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Password</b></span>
                            <input type="text" class="form-control" placeholder="Enter password" name="password" required value="<?php echo $row['password']; ?>">
                          </div>
                      </div>
                     



                  </div>
                  <!-- END ROW -->
              </div>
              <div class="card-footer">
                <div class="float-right">
                  <a href="users.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                  <button type="submit" class="btn bg-primary" name="update_user"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END UPDATE -->








  </div>

<?php } else { include '404.php'; } ?>


<?php include 'footer.php';  ?>

