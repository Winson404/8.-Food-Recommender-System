<?php 
    include '../config.php';
    date_default_timezone_set('Asia/Manila');

        // SAVE RECIPE
    if(isset($_POST['create_recipe'])) {

        $diet_Id      = $_POST['diet_Id'];
        $recipe_name  = $_POST['recipe_name'];
        $recipe_name  = str_replace("'", "\'", $recipe_name);
        $description  = $_POST['description'];
        $tags         = $_POST['tags'];
        $directions   = $_POST['directions'];
        $ingredients  = $_POST['ingredients'];
        $ingredients  = str_replace("'", "\'", $ingredients);
        $file         = basename($_FILES["fileToUpload"]["name"]);

        $check_email = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_name='$recipe_name'");
        if(mysqli_num_rows($check_email)>0) {
                  $_SESSION['exists']  = "Recipe name already exists.";
            header("Location: uploadingRecipe.php");
        } else {

                // Check if image file is a actual image or fake image
          $target_dir = "../images-recipe/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
          header("Location: uploadingRecipe.php");
          $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
          $_SESSION['error']  = "Your file was not uploaded.";
          header("Location: uploadingRecipe.php");
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                
                $save = mysqli_query($conn, "INSERT INTO recipe (recipe_diet_Id, recipe_name, recipe_description, tags, directions, ingredients, recipe_image) VALUES ('$diet_Id', '$recipe_name', '$description', '$tags', '$directions', '$ingredients', '$file')");

                    if($save) {
                      $_SESSION['success']  = "Recipe has been successfully saved!";
                      header("Location: uploadingRecipe.php");                                
                    } else {
                      $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                      header("Location: uploadingRecipe.php");
                    }
              } else {
                    $_SESSION['exists'] = "There was an error uploading your file.";
                    header("Location: uploadingRecipe.php");
              }
                 }
            }
        }



    if(isset($_POST['update_profile'])) {

      $meal_plan= $_POST['meal_plan'];
      $user_Id  = $_POST['user_Id'];
      $fname    = $_POST['fname'];
      $lname    = $_POST['lname'];
      $email    = $_POST['email'];
      $password = $_POST['password'];
      $update = mysqli_query($conn, "UPDATE users_account SET fname='$fname', lname='$lname', email='$email', password='$password' WHERE id='$user_Id'");
      if($update) {
        $_SESSION['success']  = "You have successfully updated your information!";
        header("Location: my-profile.php?meal_plan=".$meal_plan);
      } else {
         $_SESSION['exists'] = "Something went wrong.";
         header("Location: my-profile.php?meal_plan=".$meal_plan);
      }
    }



    if(isset($_POST['add_rate'])) {

      $user_Id   = $_POST['user_Id'];
      $recipe_Id = $_POST['recipe_Id'];
      $meal_plan = $_POST['meal_plan'];
      $rating    = $_POST['rating'];
      $review    = $_POST['review'];

      $select = mysqli_query($conn, "SELECT * FROM ratings WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recipe_Id'");
      if(mysqli_num_rows($select) > 0) {
         $update = mysqli_query($conn, "UPDATE ratings SET rate='$rating', review='$review' WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recipe_Id'");
         if($update) {

                $select = mysqli_query($conn, "SELECT * FROM avg_rate WHERE avg_recipe_Id='$recipe_Id'");
                if(mysqli_num_rows($select) > 0 ) {

                       $avg = mysqli_query($conn, "SELECT AVG(rate) AS ar FROM ratings WHERE ratings_recipe_Id='$recipe_Id' ");
                       $row = mysqli_fetch_array($avg);
                       $avg_rates = $row['ar'];

                       $update_rate = mysqli_query($conn, "UPDATE avg_rate SET avg_rate='$avg_rates' WHERE avg_recipe_Id='$recipe_Id' ");
                       if($update_rate) {
                          $_SESSION['success']  = "You have rated the recipe successfully.";
                          header("Location: rating.php?recipe_Id=$recipe_Id&&user_Id=$user_Id&&meal_plan=$meal_plan");  
                       } else {
                          echo 'Something went wrong.';
                       } 

                } else {

                       $avg = mysqli_query($conn, "SELECT AVG(rate) AS ar FROM ratings WHERE ratings_recipe_Id='$recipe_Id' ");
                       $row = mysqli_fetch_array($avg);
                       $avg_rates = $row['ar'];

                       $avg_save = mysqli_query($conn, "INSERT INTO avg_rate (avg_recipe_Id, avg_rate) VALUES ('$recipe_Id', '$avg_rates')");
                       if($avg_save) {
                          $_SESSION['success']  = "You have rated the recipe successfully.";
                          header("Location: rating.php?recipe_Id=$recipe_Id&&user_Id=$user_Id&&meal_plan=$meal_plan");  
                       } else {
                          echo 'Something went wrong.';
                       } 
                }

         } else {
            echo 'Something went wrong.';
         }

      } else {
          $save = mysqli_query($conn, "INSERT INTO ratings (ratings_user_Id, ratings_recipe_Id, rate, review) VALUES ('$user_Id', '$recipe_Id', '$rating', '$review')");
          if($save) {

                $select = mysqli_query($conn, "SELECT * FROM avg_rate WHERE avg_recipe_Id='$recipe_Id'");
                if(mysqli_num_rows($select) > 0 ) {

                       $avg = mysqli_query($conn, "SELECT AVG(rate) AS ar FROM ratings WHERE ratings_recipe_Id='$recipe_Id' ");
                       $row = mysqli_fetch_array($avg);
                       $avg_rates = $row['ar'];

                       $update_rate = mysqli_query($conn, "UPDATE avg_rate SET avg_rate='$avg_rates' WHERE avg_recipe_Id='$recipe_Id' ");
                       if($update_rate) {
                          $_SESSION['success']  = "You have rated the recipe successfully.";
                          header("Location: rating.php?recipe_Id=$recipe_Id&&user_Id=$user_Id&&meal_plan=$meal_plan");  
                       } else {
                          echo 'Something went wrong.';
                       } 

                } else {

                       $avg = mysqli_query($conn, "SELECT AVG(rate) AS ar FROM ratings WHERE ratings_recipe_Id='$recipe_Id' ");
                       $row = mysqli_fetch_array($avg);
                       $avg_rates = $row['ar'];

                       $avg_save = mysqli_query($conn, "INSERT INTO avg_rate (avg_recipe_Id, avg_rate) VALUES ('$recipe_Id', '$avg_rates')");
                       if($avg_save) {
                          $_SESSION['success']  = "You have rated the recipe successfully.";
                          header("Location: rating.php?recipe_Id=$recipe_Id&&user_Id=$user_Id&&meal_plan=$meal_plan");  
                       } else {
                          echo 'Something went wrong.';
                       } 
                }

          } else {
             echo 'Something went wrong rating the recipe.';
          }
      }
    }



    if(isset($_POST['view_recipe'])) {
      $recipe_Id = $_POST['recipe_Id'];
      $meal_plan = $_POST['meal_plan'];
      $click_num = 1;
      $update = mysqli_query($conn, "UPDATE recipe SET num_clicks=num_clicks+1 WHERE recipe_Id='$recipe_Id' ");
      if($update) {
        header("Location: single-recipe.php?recipe_Id=".$recipe_Id."&&meal_plan=".$meal_plan." ");
      } else {
        $_SESSION['message'] = "Something went wrong.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: recipe.php?meal_plan=".$meal_plan);
      }
      
    }



    if(isset($_POST['recipe_id']) && isset($_POST['user_id'])) {
        $user_id    = $_POST['user_id'];
        $recipe_id = $_POST['recipe_id'];
        $date_added = date('Y-m-d');

        $check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id='$user_id' AND recipe_id='$recipe_id'");
        if(mysqli_num_rows($check) > 0) {
            $response = 'You have already added this recipe to your favorites lists.';
            echo json_encode($response);
        } else {
            $check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id='$user_id'");
            if(mysqli_num_rows($check) === 15) {
                $response = 'You have reached the limit of added favorites!';
                echo json_encode($response);
            } else {
                $save = mysqli_query($conn, "INSERT INTO favorites (user_id, recipe_id, date_added) VALUES ('$user_id', '$recipe_id', '$date_added') ");
                if($save) {
                    $response = 'Recipe added to favorites lists.';
                    echo json_encode($response);
                } else {
                    $response = 'Something went wrong while adding this recipe to your favorites.';
                    echo json_encode($response);
                }
            }
        }
    }






    // UPLOAD RECIPE - UPLOADINGRECIPE.PHP
    if (isset($_POST['add_recipe'])) {
      $user_Id            = mysqli_real_escape_string($conn, $_POST['user_Id']);
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

      $exist = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_name='$recipe_name' AND recipe_description='$recipe_desc' AND link='$link'");
      if(mysqli_num_rows($exist) > 0) {
        $_SESSION['message'] = "This recipe already exists.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
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
              header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
              $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $_SESSION['message'] = "Your file was not uploaded.";
              $_SESSION['text'] = "Please try again.";
              $_SESSION['status'] = "error";
              header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                $save = mysqli_query($conn, "INSERT INTO recipe (meal_type, cuisine_type, recipe_diet_Id, recipe_name, recipe_description, link, directions, ingredients, recipe_image, recipe_uploaded_by, yields, calories) VALUES ('$meal_type', '$cuisine_type', '$diet_type', '$recipe_name', '$recipe_desc', '$link', '$implode_steps', '$implode_ingredient', '$file', '$user_Id', '$Yields', '$Calories')");

                    if($save) {

                        $c_exist = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_diet_Id='$diet_type' AND recipe_name='$recipe_name' AND recipe_description='$recipe_desc' AND link='$link' AND directions='$implode_steps' AND ingredients='$implode_ingredient' AND recipe_uploaded_by='$user_Id' ");
                        $aaa = mysqli_fetch_array($c_exist);
                        $c_recipe = $aaa['recipe_Id'];
                        $c_avg_rate = 0;

                        $save2 = mysqli_query($conn, "INSERT INTO avg_rate (avg_recipe_Id, avg_rate) VALUES ('$c_recipe', '$c_avg_rate') ");
                        if($save2) {
                              $_SESSION['message']  = "Thank you for submitting your recipe!";
                              $_SESSION['message']  = "We are pleased to have you as a member of our Recipick Community! To find out if your recipe has been accepted, keep visiting your Upload Recipe.";
                              $_SESSION['text'] = "Success";
                              $_SESSION['status'] = "success";
                              header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
                        } else {
                            $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                            $_SESSION['text'] = "Please try again.";
                            $_SESSION['status'] = "error";
                            header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
                        }

                      
                    } else {
                      $_SESSION['message'] = "Something went wrong while saving the information. Please try again.";
                      $_SESSION['text'] = "Please try again.";
                      $_SESSION['status'] = "error";
                      header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
                    }
              } else {
                    $_SESSION['message'] = "There was an error uploading your file.";
                    $_SESSION['text'] = "Please try again.";
                    $_SESSION['status'] = "error";
                    header("Location: uploadingRecipe.php?meal_plan=".$meal_plan);
              }
          }

      }

    }





    // ADD MEAL TO MEAL ORGANIZER
    if(isset($_POST['add_Meal'])) {
        $user_id   = $_POST['user_id'];
        $recipe_Id = $_POST['recipe_Id'];
        $meal_plan = $_POST['meal_plan'];
        $day       = $_POST['day'];
        $meal_time = $_POST['meal_time'];

        if($day == 'MONDAY') {

            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Monday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Monday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Monday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Monday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Monday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Monday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }

        } elseif($day == 'TUESDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Tuesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Tuesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Tuesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Tuesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Tuesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Tuesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } elseif($day == 'WEDNESDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Wednesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Wednesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Wednesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Wednesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Wednesday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Wednesday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } elseif($day == 'THURSDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Thursday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Thursday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Thursday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Thursday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Thursday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Thursday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } elseif($day == 'FRIDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Friday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Friday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Friday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Friday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Friday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Friday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } elseif($day == 'SATURDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Saturday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Saturday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Saturday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Saturday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Saturday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Saturday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } elseif($day == 'SUNDAY') {
            if($meal_time == 'Breakfast') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Sunday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Sunday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Lunch') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Sunday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Sunday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } elseif($meal_time == 'Dinner') {
                $check = mysqli_query($conn, "SELECT * FROM meal_organizer WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id'");
                if(mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($conn, "UPDATE meal_organizer SET org_recipe_Id='$recipe_Id', org_user_Id='$user_id', org_meal_day='$day', org_meal_time='$meal_time' WHERE org_meal_day='$day' AND org_meal_time='$meal_time' AND org_user_Id='$user_id' ");
                    if($update) {
                      $_SESSION['message'] = "Sunday meal has been updated.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrong.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                } else {
                    $save = mysqli_query($conn, "INSERT INTO meal_organizer (org_recipe_Id, org_user_Id, org_meal_day, org_meal_time) VALUES ('$recipe_Id', '$user_id', '$day', '$meal_time')");
                    if($save) {
                      $_SESSION['message'] = "Sunday meal has been saved.";
                      $_SESSION['text'] = "Successfully updated";
                      $_SESSION['status'] = "success";
                      header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    } else {
                        $_SESSION['message'] = "Something went wrosng.";
                        $_SESSION['text'] = "Please try again.";
                        $_SESSION['status'] = "error";
                        header("Location: meal_organizer.php?meal_plan=".$meal_plan);
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['text'] = "Please try again.";
                $_SESSION['status'] = "error";
                header("Location: meal_organizer.php?meal_plan=".$meal_plan);
            }
        } else {    
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['text'] = "Please try again.";
            $_SESSION['status'] = "error";
            header("Location: meal_organizer.php?meal_plan=".$meal_plan);
        }

    }




    


    // POST TO COMMUNITY - COMMUNITY.PHP
    if(isset($_POST['PostCommunity'])) {
        $meal_plan = $_POST['meal_plan'];
        $user_Id   = $_POST['user_Id'];
        $message   = mysqli_real_escape_string($conn, $_POST['message']);
        $file      = basename($_FILES["fileToUpload"]["name"]);
        $anonymous = $_POST['anonymous'];

        $select = mysqli_query($conn, "SELECT * FROM users_account WHERE id='$user_Id'");
        $row = mysqli_fetch_array($select);

        $name = $row['fname'].' '.$row['lname'];
        $firstChar = substr($name, 0, 1); // get the first character
        $lastChar = substr($name, -1); // get the last character
        $middleChars = str_repeat("*", strlen($name) - 2); // repeat "*" for the middle characters
        $anonymousName = $firstChar . $middleChars . $lastChar;

        $as_is_Name = "";
        if($anonymous == "ON") {
            $as_is_Name = $anonymousName;
        } else {
            $as_is_Name = $name;
        }


        if(empty($file)) {
            $save = mysqli_query($conn, "INSERT INTO community (user_Id, name, message) VALUES ('$user_Id', '$as_is_Name', '$message') ");
            if($save) {
              header("Location: community.php?meal_plan=".$meal_plan."&&#community");
            } else {
              $_SESSION['exists'] = "Something went wrong while submitting the form.";
              header("Location: community.php?meal_plan=".$meal_plan."&&#community");
            }
        } else {
              // Check if image file is a actual image or fake image
              $target_dir = "../images-community/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
              // Allow certain file formats
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
              $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
              header("Location: community.php?meal_plan=".$meal_plan."&&#community");
              $uploadOk = 0;
              }

              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
              $_SESSION['error']  = "Your file was not uploaded.";
              header("Location: community.php?meal_plan=".$meal_plan."&&#community");
              // if everything is ok, try to upload file
              } else {

                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    
                        $save = mysqli_query($conn, "INSERT INTO community (user_Id, name, message, image) VALUES ('$user_Id', '$as_is_Name', '$message', '$file') ");
                        if($save) {
                          header("Location: community.php?meal_plan=".$meal_plan."&&#community");        
                        } else {
                          $_SESSION['exists'] = "Something went wrong while submitting the form.";
                          header("Location: community.php?meal_plan=".$meal_plan."&&#community");
                        }
                  } else {
                        $_SESSION['exists'] = "There was an error uploading your file.";
                        header("Location: community.php?meal_plan=".$meal_plan."&&#community");
                  }
             }
        }
    }


    if(isset($_POST['heartId']) && isset($_POST['userid'])) {
        $com_Id = $_POST['heartId'];
        $userid = $_POST['userid'];
        $sql = mysqli_query($conn, "SELECT * FROM reaction WHERE user_Id='$userid' AND com_Id='$com_Id'");
        if(mysqli_num_rows($sql) > 0) {
            $delete = mysqli_query($conn, "DELETE FROM reaction WHERE user_Id='$userid' AND com_Id='$com_Id'");
        } else {
            $on = 1;
            $save = mysqli_query($conn, "INSERT INTO reaction (user_Id, com_Id, heartNo) VALUES ('$userid', '$com_Id', '$on')");
        }
    }



    if(isset($_POST['postComment'])) {
        $com_Id    = $_POST['com_Id'];
        $meal_plan = $_POST['meal_plan'];
        $user_Id   = $_POST['user_Id'];
        $comment   = mysqli_real_escape_string($conn, $_POST['comment']);
        $sql = mysqli_query($conn, "INSERT INTO comment (user_Id, com_Id, comment) VALUES ('$user_Id', '$com_Id', '$comment')");
        if($sql) {
            header("Location: community.php?meal_plan=".$meal_plan."&&#commenting");
        } else {
            header("Location: community.php?meal_plan=".$meal_plan."&&#commenting");
        }
    }




    if(isset($_POST['commentid']) && isset($_POST['communityid']) && isset($_POST['userid'])) {

        $commentid = $_POST['commentid'];
        $communityid   = $_POST['communityid'];
        $userid    = $_POST['userid'];
        $sql = mysqli_query($conn, "SELECT * FROM reaction2 WHERE user_Id='$userid' AND com_Id='$communityid' AND comment_Id='$commentid'");
        if(mysqli_num_rows($sql) > 0) {
            $delete = mysqli_query($conn, "DELETE FROM reaction2 WHERE user_Id='$userid' AND com_Id='$communityid' AND comment_Id='$commentid'");
        } else {
            $on = 1;    
            $save = mysqli_query($conn, "INSERT INTO reaction2 (user_Id, com_Id, comment_Id, heartNo) VALUES ('$userid', '$communityid', '$commentid', '$on')");
        }
    }

    





?>