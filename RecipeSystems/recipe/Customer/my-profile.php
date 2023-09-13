<link rel="stylesheet" href="../css/myprofile.css">
<?php
      include 'navbar.php';
      if(isset($_GET['meal_plan'])) 
      $meal_plan = $_GET['meal_plan'];

      $id = $_SESSION['role_as'];
 ?>

    <main class="page">
        <div class="container">
            <div class="jumbotron">
                
                <form class="form-style-7">
                    <div class="form-group" style="margin-left: 40px;">
                    <?php if(isset($_SESSION['success'])) { ?> 
                        <p class="alert card-title" role="alert" style="right: 20px;color: green; background-color: white; text-align: center; "><?php echo $_SESSION['success']; ?></p>
                    <?php unset($_SESSION['success']); } ?>


                    <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                        <p class="alert card-title" role="alert" style="right: 20px; color: red; background-color: white; padding: 2px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></p>
                    <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                    <?php  if(isset($_SESSION['exists'])) { ?>
                        <p class="alert card-title" role="alert" style="right: 20px; color: red;background-color: white; padding: 2px;"><?php echo $_SESSION['exists']; ?></p>
                    <?php unset($_SESSION['exists']); } ?>
                    </div>
                    <ul>

                        <li>
                            <input type="text" maxlength="100" value="<?php echo $row['fname']; ?>" class="text-dark" disabled>
                            <span>Your full name </span>
                        </li>
                        <li>
                            <input type="email" maxlength="100" value="<?php echo $row['lname']; ?>" class="text-dark" disabled>
                            <span>Your Email address</span>
                        </li>
                        <li>
                            <input type="password" maxlength="100" value="<?php echo $row['password']; ?>" class="text-dark" disabled>
                            <span>Password</span> 
                        </li>
                        <li>
                            <div class="card-body">
                                <button type="button" class="btn text-light" data-bs-toggle="modal" data-bs-target="#editmodal" style="width: auto; background-color: #b3b3b3;">Update Profile</button>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
   



    <!-- Modal -->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Updating Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="process_save.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" placeholder="Enter your Firstname" name="user_Id" value="<?php echo $id; ?>" required style="width: 94%;">
                        <input type="hidden" class="form-control" placeholder="Enter your Firstname" name="meal_plan" value="<?php echo $meal_plan; ?>" required style="width: 94%;">
                        <div class="form-group mb-3">
                            <label><b>First Name</b></label>
                            <input type="text" class="form-control" placeholder="Enter your Firstname" name="fname" value="<?php echo $row['fname']; ?>" required style="width: 94%;">
                        </div>
                        <div class="form-group mb-3">
                            <label><b>Last Name</b></label>
                            <input type="text" class="form-control" placeholder="Enter your lastname" name="lname" value="<?php echo $row['lname']; ?>" required style="width: 94%;">
                        </div>
                        <div class="form-group mb-3">
                            <label><b>Email</b></label>
                            <input type="email" class="form-control" placeholder="Enter your Email" name="email" value="<?php echo $row['email']; ?>" required style="width: 94%;">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password"><b>Password</b></label>
                            <input class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo $row['password']; ?>" type="text" required minlength="4" maxlength="21" data-toggle="password" style="width: 94%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="height: auto;">Close</button>
                        <button type="submit" name="update_profile" class="btn btn-primary" style="height: auto;">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
 </main>
<?php include 'footer.php'; ?>



 <script>
   //-----------------------------ALERT TIMEOUT-------------------------//
  $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,5000);
  }
  );
//-----------------------------END ALERT TIMEOUT---------------------//
</script>