<?php 
    include '../config.php';
    date_default_timezone_set('Asia/Manila');


    // UPLOAD RECIPE - UPLOADINGRECIPE_UPDATE.PHP
    if (isset($_POST['add_recipe'])) {

      $user_Id            = mysqli_real_escape_string($conn, $_POST['user_Id']);
      $recipe_Id          = mysqli_real_escape_string($conn, $_POST['recipe_Id']);
      $meal_plan          = mysqli_real_escape_string($conn, $_POST['meal_plan']);
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
      $recipe_status      = 0;

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
              header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
              $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $_SESSION['message'] = "Your file was not uploaded.";
              $_SESSION['text'] = "Please try again.";
              $_SESSION['status'] = "error";
              header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_image='$file', recipe_status=0, yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                if($update) {
                  $_SESSION['message']  = "Recipe has been updated.";
                  $_SESSION['text'] = "Success";
                  $_SESSION['status'] = "success";
                  header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                } else {
                  $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                  $_SESSION['text'] = "Please try again.";
                  $_SESSION['status'] = "error";
                  header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                }
              } else {
                    $_SESSION['message'] = "There was an error uploading your file.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
              }
          }
        } else { 
           $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_name='$recipe_name' AND recipe_description='$recipe_desc' AND link='$link'");
           if(mysqli_num_rows($exist) > 0) {
             $_SESSION['message'] = "This recipe already exists.";
             $_SESSION['text'] = "Please try again.";
             $_SESSION['status'] = "error";
             header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
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
                  header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                  $uploadOk = 0;
              }

              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                  $_SESSION['message'] = "Your file was not uploaded.";
                  $_SESSION['text'] = "Please try again.";
                  $_SESSION['status'] = "error";
                  header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
              // if everything is ok, try to upload file
              } else {

                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    
                    $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_image='$file', recipe_status=0, yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                    if($update) {
                      $_SESSION['message']  = "Recipe has been updated.";
                      $_SESSION['text'] = "Success";
                      $_SESSION['status'] = "success";
                      header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                    } else {
                      $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                      $_SESSION['text'] = "Please try again.";
                      $_SESSION['status'] = "error";
                      header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                    }
                  } else {
                        $_SESSION['message'] = "There was an error uploading your file.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                  }
              }
           }
        }
      } else {
            if($recipe_name==$r_name AND $recipe_desc==$r_recipe_desc AND $link==$r_link) {
              $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_status=0, yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
              if($update) {
                $_SESSION['message']  = "Recipe has been updated.";
                $_SESSION['text'] = "Success";
                $_SESSION['status'] = "success";
                header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
              } else {
                $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
              }
            } else {

               $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_name='$recipe_name' AND recipe_description='$recipe_desc' AND link='$link'");
               if(mysqli_num_rows($exist) > 0) {
                 $_SESSION['message'] = "This recipe already exists.";
                 $_SESSION['text'] = "Please try again.";
                 $_SESSION['status'] = "error";
                 header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
               } else { 
                  $update = mysqli_query($conn, "UPDATE recipe SET meal_type='$meal_type', cuisine_type='$cuisine_type', recipe_diet_Id='$diet_type', recipe_name='$recipe_name', recipe_description='$recipe_desc', link='$link', directions='$implode_steps', ingredients='$implode_ingredient', recipe_status=0, yields='$Yields', calories='$Calories' WHERE recipe_Id='$recipe_Id'");
                  if($update) {
                    $_SESSION['message']  = "Recipe has been updated.";
                    $_SESSION['text'] = "Success";
                    $_SESSION['status'] = "success";
                    header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                  } else {
                    $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: uploadingRecipe_update.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan);
                  }
               }
              
            }
      }


        



    }











?>