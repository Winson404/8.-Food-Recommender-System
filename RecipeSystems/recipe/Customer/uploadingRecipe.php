<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php include('navbar.php'); if(isset($_GET['meal_plan'])) $meal_plan = $_GET['meal_plan']; ?>

<body onload="myFunction()">
    <main class="page p-4">
      <div class="recipe-page card p-5">
            <form action="process_save.php" method="POST" enctype="multipart/form-data" autocomplete="off">

              <!-- USER ID -->
              <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="user_Id">

              <!-- GET MEAL PLAN TO BE PASSED ON PROCESS_SAVE.PHP -->
              <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">

              <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="form-group">
                      <label for="image"></label>
                      <div class="text-center">
                        <center>
                          <input type="file" class="form-control-file d-none" id="image" name="image" required>
                          <div id="image-preview" class="clickable" style="border: 1px solid black;">
                            <img src="https://t4.ftcdn.net/jpg/04/81/13/43/360_F_481134373_0W4kg2yKeBRHNEklk4F9UXtGHdub3tYk.jpg" class="img-fluid rounded" style="width:250px;height:250px;">
                            <div class="overlay">
                              <div class="text"><b>Click to select an image</b></div>
                            </div>
                          </div>
                        </center>
                      </div>
                      <hr>
                    </div>

                    <div class="mt-3">
                        <h4 class="text-center text-muted"><b>Steps</b></h4>
                        <button type="button" id="add-input2" class="btn mb-1" style="width: auto; height: auto; float:right; background-color: #0066fff;">Add</button>
                        <div id="input-container2">
                          <div class="input-group2">
                            <input type="text" name="steps[]" value="" placeholder="Step 1" class="form-control" required style="width:95%;height:auto;"/>
                            <button type="button" class="btn remove-input2 mt-1" style="width: auto; height: auto; background-color: #ff0000f;">Remove</button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <article class="recipe-info">
                      <div class="d-flex flex-wrap">
                        <div class="recipe-info flex-grow-1">
                          <div class="mb-3">
                            <label for="recipe-name"><b>Type of Meal</b></label>
                            <select name="meal_type" id="" class="form-control form-select" required>
                              <option value="" selected disabled>Select meal type</option>
                              <option value="Breakfast">Breakfast</option>
                              <option value="Lunch">Lunch</option>
                              <option value="Dinner">Dinner</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="recipe-name"><b>Cuisine type</b></label>
                            <select name="cuisine_type" id="" class="form-control form-select" required>
                              <option value="" selected disabled>Select cuisine type</option>
                              <option value="American">American</option>
                              <option value="Asian">Asian</option>
                              <option value="European">European</option>
                              <option value="World">World</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="recipe-name"><b>Recipe Title</b></label>
                            <input type="text" id="recipe-name" name="recipe_name" placeholder="Recipe name" class="form-control" style="height:auto; width: 95%;" required>
                          </div>

                          <style>
                            .error-message {
                              color: red;
                              font-size: 14px;
                            }
                          </style>
                         <div class="mb-3">
                            <label for="video-url" ><b>Youtube URL</b></label>
                            <input id="video-url" name="link" class="form-control" size="30" style="height:auto;"oninput="validateURL()"></input>
                            <span id="error-message" class="error-message" style="font-style: italic;font-weight: bold;"></span>
                          </div>

                          <script>
                            function validateURL() {
                              var url = document.getElementById("video-url").value;
                              var regex = /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/
                              var errorMessage = document.getElementById("error-message");

                              if (url === "") {
                                errorMessage.textContent = ""; // Clear error message when input is empty
                                document.getElementById('recipeButton').disabled = false;
                              } else if (regex.test(url)) {
                                errorMessage.textContent = "";
                                document.getElementById('recipeButton').disabled = false;
                              } else {
                                errorMessage.textContent = "Please enter a valid YouTube URL.";
                                document.getElementById('recipeButton').disabled = true;
                              }
                            }
                          </script>

                          <div class="mb-3">
                            <label for="recipe-description"><b>Recipe Description</b></label>
                            <textarea id="recipe-description" name="recipe_desc" class="form-control" style="height:auto;" required></textarea>
                          </div>
                          <div class="mb-3">
                            <label><b>Yields</b></label>
                            <input type="number" name="Yields" placeholder="Enter yields" class="form-control" required style="width:95%;height:auto;"/>
                          </div>
                          <div class="mb-3">
                            <label><b>Calories</b></label>
                            <input type="number" name="Calories" placeholder="Enter Calories" class="form-control" style="width:95%;height:auto;" required>
                          </div>

                          <hr>
                          <div class="mb-3">
                            <h4 class="text-center text-muted"><b>Ingredients</b></h4>
                            <button type="button" id="add-input1" class="btn mb-1" style="width: auto; height: auto; float:right; background-color: #0066fff;">Add</button>
                            <div id="input-container1">
                              <div class="input-group1" >
                                <input type="text" name="ingredient[]" value="" placeholder="Ingredient 1" class="form-control" required style="width:95%;height:auto;"/>
                                <button type="button" class="btn remove-input1 mt-1 mb-3" style="width: auto; height: auto; background-color: #ff0000f;">Remove</button>
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="diet-type"><b>Diet Type</b></label>
                            <select class="form-control" style="height:35px; pointer-events: none;" name="diet_type" >
                              <option selected disabled value="">Select Diet Type</option>
                              <?php
                                $selected_diet = $row['select_meal_plan_history'];
                                $q_e = $conn->query("SELECT * FROM `diet`");
                                while($f_e = $q_e->fetch_array()) {
                              ?>
                              <option value="<?php echo $f_e['diet_Id'];?>" <?php if($f_e['diet_Id'] == $selected_diet) { echo 'selected'; } ?>><?php echo $f_e['diet_name'];?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <input type="submit" class="btn" value="Post recipe" id="recipeButton" style="height:auto; width: auto; float: right; background-color: #29a329f;" name="add_recipe">
                          </div>
                        </div>
                      </div>
                    </article>
                </div>
              </div>
            </form>
      </div>
    </main>
</body>

<?php include 'footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
   $(document).ready(function() {


      var index1 = 1; // set the initial index
      $("#add-input1").click(function() {
        index1++; // increment the index
        $("#input-container1").append("<div><input type='text' name='ingredient[]' placeholder='Ingredient " + index1 + "' class='form-control' style='width:95%;height:auto;' /><button type='button' class='remove-input1 btn mt-1 mb-3' style='width: auto; height: auto; background-color: #ff0000f;'>Remove</button></div>");
      });
      $(document).on("click", ".remove-input1", function() {
        $(this).closest("div").remove();
        index1--; // decrement the index when removing an element
      });




      var index2 = 1; // set the initial index
      $("#add-input2").click(function() {
        index2++; // increment the index
        $("#input-container2").append("<div><input type='text' name='steps[]' placeholder='Step " + index2 + "' class='form-control mt-3' style='width:95%;height:auto;' /><button type='button' class='remove-input2 btn btn-primary mt-1' style='width: auto; height: auto; background-color: #ff0000f;'>Remove</button></div>");
      });

      $(document).on("click", ".remove-input2", function() {
        $(this).closest("div").remove();
        index2--; // decrement the index when removing an element
      });



      $("#image-preview").click(function(){
        $("#image").click();
      });
      $("#image").change(function(){
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          $("#image-preview img").attr("src", reader.result);
        }
        if (file) {
          reader.readAsDataURL(file);
        } else {
          $("#image-preview img").attr("src", "");
        }
      });


  });
</script>  
