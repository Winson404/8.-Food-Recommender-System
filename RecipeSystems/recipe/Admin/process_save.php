<?php 
	include '../config.php';

	// SAVE DIET
	if(isset($_POST['create_diet'])) {

		$diet  = $_POST['diet'];
		$file  = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM diet WHERE diet_name='$diet'");
		if(mysqli_num_rows($check_email)>0) {
			      $_SESSION['exists']  = "Diet name already exists.";
            header("Location: diet.php");
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
             	
              	$save = mysqli_query($conn, "INSERT INTO diet (diet_name, diet_image) VALUES ('$diet', '$file')");

                    if($save) {
                      $_SESSION['success']  = "Diet has been successfully saved!";
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





	// UPLOAD RECIPE - RECIPE_ADD.PHP
    if (isset($_POST['add_recipe'])) {
      $user_Id            = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
      $recipe_status      = 1;

      $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_name='$recipe_name'");
      if(mysqli_num_rows($exist) > 0) {
        $_SESSION['message'] = "This recipe already exists.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe_add.php");
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
              header("Location: recipe_add.php");
              $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $_SESSION['message'] = "Your file was not uploaded.";
              $_SESSION['text'] = "Please try again.";
              $_SESSION['status'] = "error";
              header("Location: recipe_add.php");
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                $save = mysqli_query($conn, "INSERT INTO recipe (meal_type, cuisine_type, recipe_diet_Id, recipe_name, recipe_description, link, directions, ingredients, recipe_image, recipe_status, recipe_uploaded_by, yields, calories) VALUES ('$meal_type', '$cuisine_type', '$diet_type', '$recipe_name', '$recipe_desc', '$link', '$implode_steps', '$implode_ingredient', '$file', '$recipe_status', '$user_Id', '$Yields', '$Calories')");

                    if($save) {
                      $_SESSION['message']  = "Recipe has been uploaded.";
                      $_SESSION['text'] = "Success";
                      $_SESSION['status'] = "success";
                      header("Location: recipe_add.php");
                    } else {
                      $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                      $_SESSION['text'] = "Please try again.";
                      $_SESSION['status'] = "error";
                      header("Location: recipe_add.php");
                    }
              } else {
                    $_SESSION['message'] = "There was an error uploading your file.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: recipe_add.php");
              }
          }

      }

    }











?>