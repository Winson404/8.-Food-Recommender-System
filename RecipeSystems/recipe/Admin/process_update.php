<?php 
	include '../config.php';


	if(isset($_POST['update_diet'])) {
		$diet_Id = $_POST['diet_Id'];
		$diet    = $_POST['diet'];
		$file    = basename($_FILES["fileToUpload"]["name"]);


		if(empty($file)) {
			$save = mysqli_query($conn, "UPDATE diet SET diet_name='$diet' WHERE diet_Id='$diet_Id'");
            if($save) {
              $_SESSION['success']  = "Diet has been updated!";
              header("Location: diet.php");                                
            } else {
              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
              header("Location: diet.php");
            }
		} else {
			// Check if image file is a actual image or fake image
          $target_dir = "../images-diet/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
          header("Location: diet.php");
          $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
          $_SESSION['error']  = "Your file was not uploaded.";
          header("Location: diet.php");
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             	
              	$save = mysqli_query($conn, "UPDATE diet SET diet_name='$diet', diet_image='$file' WHERE diet_Id='$diet_Id'");

                    if($save) {
                      $_SESSION['success']  = "Diet has been updated!";
                      header("Location: diet.php");                                
                    } else {
                      $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                      header("Location: diet.php");
                    }
              } else {
                    $_SESSION['exists'] = "There was an error uploading your file.";
                    header("Location: diet.php");
              }
		  }

		}

		  
	}






/*

  if(isset($_POST['update_recipe'])) {
    $recipe_Id    = $_POST['recipe_Id'];
    $diet_Id      = $_POST['diet_Id'];
    $recipe_name  = $_POST['recipe_name'];
    $recipe_name  = str_replace("'", "\'", $recipe_name);
    $description  = $_POST['description'];
    $tags         = $_POST['tags'];
    $directions   = $_POST['directions'];
    $ingredients  = $_POST['ingredients'];
    $ingredients  = str_replace("'", "\'", $ingredients);
    $file    = basename($_FILES["fileToUpload"]["name"]);



    if(empty($file)) {
      $save = mysqli_query($conn, "UPDATE recipe SET recipe_diet_Id='$diet_Id', recipe_name ='$recipe_name', recipe_description='$description', tags='$tags', directions='$directions', ingredients='$ingredients' WHERE recipe_Id ='$recipe_Id' ");
            if($save) {
              $_SESSION['success']  = "Recipe has been updated!";
              header("Location: recipe.php");                                
            } else {
              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
              header("Location: recipe.php");
            }
    } else {
      // Check if image file is a actual image or fake image
          $target_dir = "../images-recipe/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
          header("Location: recipe.php");
          $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
          $_SESSION['error']  = "Your file was not uploaded.";
          header("Location: recipe.php");
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              
                $save = mysqli_query($conn, "UPDATE recipe SET recipe_diet_Id='$diet_Id', recipe_name ='$recipe_name', recipe_description='$description', tags='$tags', directions='$directions', ingredients='$ingredients', recipe_image='$file' WHERE recipe_Id ='$recipe_Id' ");

                    if($save) {
                      $_SESSION['success']  = "Recipe has been successfully saved!";
                      header("Location: recipe.php");                                
                    } else {
                      $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                      header("Location: recipe.php");
                    }
              } else {
                    $_SESSION['exists'] = "There was an error uploading your file.";
                    header("Location: recipe.php");
              }
      }

    }

      
  }

*/

  // APPROVE RECIPE - RECIPE_DELETE.PHP
  if(isset($_POST['approve_recipe'])) {
    $recipe_Id = $_POST['recipe_Id'];

    $approve = mysqli_query($conn, "UPDATE recipe SET recipe_status=1 WHERE recipe_Id='$recipe_Id'");
    if($approve) {
        $_SESSION['message']  = "Recipe has been approved!";
        $_SESSION['text'] = "Approval successful";
        $_SESSION['status'] = "success";
        header("Location: recipe.php");
    } else {
        $_SESSION['message'] = "Something went wrong while updating the record.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe.php");
    }
  }




  // DISAPPROVE RECIPE - RECIPE_DELETE.PHP
  if(isset($_POST['disapprove_recipe'])) {
    $recipe_Id      = $_POST['recipe_Id'];
    $decline_reason = $_POST['decline_reason'];
    $approve = mysqli_query($conn, "UPDATE recipe SET recipe_status=2, decline_reason='$decline_reason' WHERE recipe_Id='$recipe_Id'");
    if($approve) {
       $_SESSION['message']  = "Recipe has been disapproved!";
        $_SESSION['text'] = "Disapproved";
        $_SESSION['status'] = "success";
        header("Location: recipe.php");
    } else {
        $_SESSION['message'] = "Something went wrong while updating the record.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe.php");
    }
  }








   // APPROVE RECIPE - RECIPE_USER_UPLOADS_DELETE.PHP
  if(isset($_POST['approve_recipe_user_upload'])) {
    $recipe_Id = $_POST['recipe_Id'];

    $approve = mysqli_query($conn, "UPDATE recipe SET recipe_status=1 WHERE recipe_Id='$recipe_Id'");
    if($approve) {
        $_SESSION['message']  = "Recipe has been approved!";
        $_SESSION['text'] = "Approval successful";
        $_SESSION['status'] = "success";
        header("Location: recipe_user_uploads.php");
    } else {
        $_SESSION['message'] = "Something went wrong while updating the record.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe_user_uploads.php");
    }
  }




  // DISAPPROVE RECIPE - RECIPE_USER_UPLOADS_DELETE.PHP
  if(isset($_POST['disapprove_recipe_user_upload'])) {
    $recipe_Id      = $_POST['recipe_Id'];
    $decline_reason = $_POST['decline_reason'];
    $approve = mysqli_query($conn, "UPDATE recipe SET recipe_status=2, decline_reason='$decline_reason' WHERE recipe_Id='$recipe_Id'");
    if($approve) {
       $_SESSION['message']  = "Recipe has been disapproved!";
        $_SESSION['text'] = "Disapproved";
        $_SESSION['status'] = "success";
        header("Location: recipe_user_uploads.php");
    } else {
        $_SESSION['message'] = "Something went wrong while updating the record.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe_user_uploads.php");
    }
  }





  // UPDATE RECIPE - RECIPE_UPDATE.PHP
    if (isset($_POST['update_recipe'])) {

      $user_Id            = mysqli_real_escape_string($conn, $_POST['user_Id']);
      $recipe_Id          = mysqli_real_escape_string($conn, $_POST['recipe_Id']);
      $file               = basename($_FILES["image"]["name"]);
      $steps              = $_POST['steps'];
      $implode_steps      = implode(',', $steps);
      $meal_type          = mysqli_real_escape_string($conn, $_POST['meal_type']);
      $cuisine_type       = mysqli_real_escape_string($conn, $_POST['cuisine_type']);
      $recipe_name        = mysqli_real_escape_string($conn, $_POST['recipe_name']);
      $link               = mysqli_real_escape_string($conn, $_POST['link']);
      $recipe_desc        = mysqli_real_escape_string($conn, $_POST['recipe_desc']);
      $Yields             = mysqli_real_escape_string($conn, $_POST['Yields']);
      $Calories           = mysqli_real_escape_string($conn, $_POST['Calories']);
      $ingredient         = $_POST['ingredient'];
      $implode_ingredient = implode(',', $ingredient);
      $diet_type          = mysqli_real_escape_string($conn, $_POST['diet_type']);

      $fetch = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_Id='$recipe_Id'");
      $row = mysqli_fetch_array($fetch);

      $r_name        = $row['recipe_name'];
      $r_recipe_desc = $row['recipe_description'];
      $r_link        = $row['link'];

      if(!empty($file)) {
        if($recipe_name==$r_name AND $recipe_desc==$r_recipe_desc AND $link==$r_link) {
          // Check if image file is a actual image or fake image
          $target_dir = "../images-recipe/";
          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
              $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
              $_SESSION['text'] = "Please try again.";
              $_SESSION['status'] = "error";
              header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
              $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $_SESSION['message'] = "Your file was not uploaded.";
              $_SESSION['text'] = "Please try again.";
              $_SESSION['status'] = "error";
              header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_image='$file', yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                if($update) {
                  $_SESSION['message']  = "Recipe has been updated.";
                  $_SESSION['text'] = "Success";
                  $_SESSION['status'] = "success";
                  header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                } else {
                  $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                  $_SESSION['text'] = "Please try again.";
                  $_SESSION['status'] = "error";
                  header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                }
              } else {
                    $_SESSION['message'] = "There was an error uploading your file.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
              }
          }
        } else { 
           $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE (recipe_name='$recipe_name' || recipe_name!='$recipe_name') AND (recipe_description!='$recipe_desc' || recipe_description='$recipe_desc') AND (link!='$link' || link='$link')");
           if(mysqli_num_rows($exist) > 0) {
             $_SESSION['message'] = "This recipe already exists.";
             $_SESSION['text'] = "Please try again.";
             $_SESSION['status'] = "error";
             header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
           } else { 
              // Check if image file is a actual image or fake image
              $target_dir = "../images-recipe/";
              $target_file = $target_dir . basename($_FILES["image"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
              // Allow certain file formats
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  $_SESSION['text'] = "Please try again.";
                  $_SESSION['status'] = "error";
                  header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                  $uploadOk = 0;
              }

              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                  $_SESSION['message'] = "Your file was not uploaded.";
                  $_SESSION['text'] = "Please try again.";
                  $_SESSION['status'] = "error";
                  header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
              // if everything is ok, try to upload file
              } else {

                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    
                    $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_image='$file', yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                    if($update) {
                      $_SESSION['message']  = "Recipe has been updated.";
                      $_SESSION['text'] = "Success";
                      $_SESSION['status'] = "success";
                      header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                    } else {
                      $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                      $_SESSION['text'] = "Please try again.";
                      $_SESSION['status'] = "error";
                      header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                    }
                  } else {
                        $_SESSION['message'] = "There was an error uploading your file.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                       header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                  }
              }
           }
        }
      } else {
            if($recipe_name==$r_name AND $recipe_desc==$r_recipe_desc AND $link==$r_link) {
              $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
              if($update) {
                $_SESSION['message']  = "Recipe has been updated.";
                $_SESSION['text'] = "Success";
                $_SESSION['status'] = "success";
                header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
              } else {
                $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
              }
            } else {

               // $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE (recipe_name!='$recipe_name' || recipe_name='$recipe_name') AND (recipe_description!='$recipe_desc' || recipe_description='$recipe_desc') AND (link!='$link' || link='$link')");
               // if(mysqli_num_rows($exist) > 0) {
               //   $_SESSION['message'] = "This recipe already exists2.";
               //   $_SESSION['text'] = "Please try again.";
               //   $_SESSION['status'] = "error";
               //   header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
               // } else { 
                  $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                  if($update) {
                    $_SESSION['message']  = "Recipe has been updated.";
                    $_SESSION['text'] = "Success";
                    $_SESSION['status'] = "success";
                    header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                  } else {
                    $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: recipe_update.php?recipe_Id=".$recipe_Id);
                  }
               // }
              
            }
      }
    }







if(isset($_POST['update_user'])) {
  $user_Id       = $_POST['user_Id'];
  $firstname     = $_POST['firstname'];
  $lastname      = $_POST['lastname'];
  $diet          = $_POST['diet'];
  $cuisine_type  = $_POST['cuisine_type'];
  $email         = $_POST['email'];
  $password      = $_POST['password'];

  $update = mysqli_query($conn, "UPDATE users_account SET fname='$firstname', lname='$lastname', email='$email', password='$password', select_meal_plan_history='$diet', cuisine_type='$cuisine_type' WHERE id='$user_Id'");
  if($update) {
    $_SESSION['message']  = "Customer record has been updated.";
    $_SESSION['text'] = "Success";
    $_SESSION['status'] = "success";
    header("Location: users_mgmt.php?page=".$user_Id);
  } else {
    $_SESSION['message'] = "Something went wrong while updating the information. Please try again.";
    $_SESSION['text'] = "Please try again.";
    $_SESSION['status'] = "error";
    header("Location: users_mgmt.php?page=".$user_Id);
  }

}



// DEACTIVATE USER'S ACCOUNT - ACTIVITY_DELETE.PHP
if(isset($_POST['deactivate_user'])) {
  $user_Id = $_POST['user_Id'];

  $update = mysqli_query($conn, "UPDATE users_account SET deactivate=1 WHERE id='$user_Id'");
  if($update) {
    $_SESSION['message']  = "Customer account has been deactivated.";
    $_SESSION['text'] = "Success";
    $_SESSION['status'] = "success";
    header("Location: activity.php");
  } else {
    $_SESSION['message'] = "Something went wrong while deactivating users account";
    $_SESSION['text'] = "Please try again.";
    $_SESSION['status'] = "error";
    header("Location: activity.php");
  }

}


?>