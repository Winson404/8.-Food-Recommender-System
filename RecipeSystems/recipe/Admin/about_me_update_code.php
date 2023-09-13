<?php 
	include '../config.php';

  // UPDATE ADMIN
	if(isset($_POST['update_admin'])) {

		$admin_Id   = $_POST['admin_Id'];
		$firstname  = $_POST['firstname'];
		$lastname   = $_POST['lastname'];
		$email      = $_POST['email'];
		$date       = $_POST['date'];

			
		$save = mysqli_query($conn, "UPDATE users_account SET fname='$firstname', lname='$lastname', email='$email', date_created='$date' WHERE id='$admin_Id'");
    if($save) {
          $_SESSION['success']  = "You have updated your information!";
          header("Location: about_me_update.php");                                
    } else {
          $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
          header("Location: about_me_update.php");
    }		


  }
	




	// CHANGE ADMIN PASSWORD
	if(isset($_POST['password_admin'])) {

    	$admin_Id    = $_POST['admin_Id'];	
    	$OldPassword = $_POST['OldPassword'];
    	$password    = $_POST['password'];
    	$cpassword   = $_POST['cpassword'];

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users_account WHERE password='$OldPassword' AND id='$admin_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          	header("Location: changepassword.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE users_account SET password='$password' WHERE id='$admin_Id' ");
			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          			header("Location: changepassword.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          		header("Location: changepassword.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: changepassword.php");
    	}

    }







?>