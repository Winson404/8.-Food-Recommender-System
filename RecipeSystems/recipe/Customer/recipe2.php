<style>
  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: start;
  }
  .item {
    width: calc(33.33% - 10px);
    margin: 10px 10px 40px 0px;
    display: flex; /* Add display flex */
    flex-direction: column; /* Add column flex direction */
  }
  .item img {
    width: 100%;
    height: auto;
    max-height: 200px; /* Add max-height */
    object-fit: cover; /* Add object-fit to maintain aspect ratio */
  }
  .item h5 {
    margin-top: 10px;
    margin-bottom: 5px;
    flex-grow: 1; /* Add flex-grow to make it take up remaining space */
  }
  .item p {
    margin-top: 5px;
    margin-bottom: 5px;
  }
  .item small {
    margin-top: 5px;
    margin-bottom: 10px;
  }
</style>

<?php 

  

      if(isset($_GET['meal_plan'])) 
      $meal_plan = $_GET['meal_plan'];

      include('navbar.php');

      $save = mysqli_query($conn, "UPDATE users_account SET select_meal_plan_history='$meal_plan' WHERE id='$id'");
      
      $fetch = mysqli_query($conn, "SELECT * FROM recipe LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_diet_Id='$meal_plan' AND recipe_status='1' ORDER BY avg_rate.avg_rate DESC");

      // $fetch = mysqli_query($conn, "SELECT * FROM recipe LEFT JOIN ratings ON recipe.recipe_Id=ratings.ratings_recipe_Id WHERE recipe_diet_Id='$recipe' ORDER BY ratings.rate DESC");

      if(isset($_POST['Search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $find = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_name LIKE '%".$search."%' AND recipe_diet_Id='$meal_plan' ORDER BY avg_rate.avg_rate DESC");



        if(mysqli_num_rows($find) > 0) {
        ?>

         <!-- main -->
         <main class="page">
              <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>
              <!-- header -->
              <header class="hero">
                <div class="hero-container">
                  <div class="hero-text">
                    <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
                    <h4>Let's Personalize your experience</h4>
                  </div>
                </div>
              </header>

              <br>
              <!-- end of header -->
              <!--  <section class="recipes-container">
               tag container 
               <div class="tags-container">
                  <h4></h4>-->
                <!-- <div class="tags-list">-->
                   <!-- 
                    <?php /*
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } */?>
                   
                  <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>-->
                  <!--</div>
                </div>-->

              
                <div class="container">
                  <?php while ($found =mysqli_fetch_array($find)) { ?>
                    <div class="item">
                      <form action="process_save.php" method="POST">
                        <img src="../images-recipe/<?php echo $found['recipe_image']; ?>" alt="Image 1">
                        <h6 class="mt-2">
                          <?php 
                            if (strlen($found['recipe_name']) > 60) { echo substr($found['recipe_name'], 0, 60) . '...'; } 
                            else { echo $found['recipe_name']; }
                          ?>
                        </h6>
                        <p>Prep : 15min | Cook : 5min</p>
                        <small><b>Ratings:</b> <?php echo number_format((float)$found['avg_rate'], 2, '.', ''); ?></small>
                        <br>
                        <input type="hidden" class="form-control" value="<?php echo $found['recipe_Id']; ?>" name="recipe_Id">
                        <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">
                        <button type="submit" class="btn btn-warning btn-sm" name="view_recipe" style="width: auto; height: auto;"><b>View recipe</b></button>
                      </form>
                    </div>
                  <?php } ?>
                </div>

                <!-- end of recipes list -->
              </section>
          </main>
          <!-- end of main -->




    <?php

    } else { ?>




            <!-- main -->
         <main class="page">
              <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>
              <!-- header -->
              <header class="hero">
                <div class="hero-container">
                  <div class="hero-text">
                    <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
                    <h4>Let's Personalize your experience</h4>
                  </div>
                </div>
              </header>

              <br>
              <!-- end of header -->
              <!--  <section class="recipes-container">
               tag container 
               <div class="tags-container">
                  <h4></h4>-->
                <!-- <div class="tags-list">-->
                   <!-- 
                    <?php /*
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } */?>
                   
                  <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>-->
                  <!--</div>
                </div>-->
                <div class="recipes-list">
                <h3>No recipe found.</h3>

                </div>
                <!-- end of recipes list -->
              </section>
          </main>
          <!-- end of main -->




<?php
           }
    } else {
?>

         <!-- main -->
         <main class="page">
              <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>
              <!-- header -->
              <header class="hero">
                <div class="hero-container">
                  <div class="hero-text">
                    <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
                    <h4>Let's Personalize your experience</h4>
                  </div>
                </div>
              </header>

              <?php if( isset($meal_plan) && !empty($meal_plan) ) { 

                    $diets_query = mysqli_query($conn, "SELECT * FROM diet  where diet_Id = '$meal_plan' ");
                    $diets = mysqli_fetch_array($diets_query);
             ?>
              <h6>Based on your inputs, we have found recipes of diet type <b style="font-size: 23px; "><?= $diets['diet_name'] ?></b>   that may suit you.  </h6>

            <?php } ?>
<br>
              <!-- end of header -->
              <!--  <section class="recipes-container">
               tag container 
               <div class="tags-container">
                  <h4></h4>-->
                <!-- <div class="tags-list">-->
                   <!-- 
                    <?php /*
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } */?>
                   
                  <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>-->
                  <!--</div>
                </div>-->
                <div class="container">
                  <?php while ($row =mysqli_fetch_array($fetch)) { ?>
                    <div class="item">
                      <form action="process_save.php" method="POST">
                        <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" alt="Image 1">
                        <h6 class="mt-2">
                          <?php 
                            if (strlen($row['recipe_name']) > 60) { echo substr($row['recipe_name'], 0, 60) . '...'; } 
                            else { echo $row['recipe_name']; }
                          ?>
                        </h6>
                        <p>Prep : 15min | Cook : 5min</p>
                        <small><b>Ratings:</b> <?php echo number_format((float)$row['avg_rate'], 2, '.', ''); ?></small>
                        <br>
                        <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
                        <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">
                        <button type="submit" class="btn btn-warning btn-sm" name="view_recipe" style="width: auto; height: auto;"><b>View recipe</b></button>
                      </form>
                    </div>
                  <?php } ?>
                </div>

              
                <!-- end of recipes list -->
              </section>
            </main>
            <!-- end of main -->


 <button class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#approve" id="myButton"><i class="fa-sharp fa-solid fa-square-plus"></i> New Customer</button>



<?php } ?>

            <div class="modal fade" id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered p-3">
    <div class="modal-content">
       <div class="modal-headert" style="background-color: #DFD683;">
          <img src="../assets/logoo.png" alt="" style="width:200px;" class="d-block m-auto">
      </div>
      <div class="modal-body p-5">
          <h6 class="text-center">Your session has timed out. Please login again</h6>
      </div>
      <div class="modal-footer alert-light">
        <a href="../logout.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>

    <?php include 'footer.php';



    if (isset($_SESSION['settingDiet']) && $_SESSION['settingDiet'] == $meal_plan && !$_SESSION['modalShown']) {
    // check if the session is set and has the expected value, and if the modal has not been shown yet
    // if true, show the modal with id "approve" using jQuery
    echo '<script>
        $(window).on("load", function() {
            $("#approve").modal("show");
        });
    </script>';
    // set the flag to indicate that the modal has been shown
    $_SESSION['modalShown'] = true;
} 

?>

<script>

    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>