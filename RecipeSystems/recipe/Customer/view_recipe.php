<?php 
      include 'navbar.php';
      
      if(isset($_GET['diet_Id']) && isset($_GET['recipe']))
      $diet_Id = $_GET['diet_Id'];
      $recipe  = $_GET['recipe'];

      $fetch = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_diet_Id='$diet_Id' ORDER BY avg_rate.avg_rate DESC");
      
      // $fetch = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN ratings ON recipe.recipe_Id=ratings.ratings_recipe_Id WHERE recipe_diet_Id='$diet_Id' ORDER BY ratings.rate DESC");
      $title = mysqli_fetch_array($fetch);


      if(isset($_POST['Search'])) {
        $search = $_POST['search'];
        $find = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_name LIKE '%".$search."%' AND recipe_diet_Id='$diet_Id' ORDER BY avg_rate.avg_rate DESC");



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

              <!-- end of header -->
              <section class="recipes-container">
                <!-- tag container -->
                <div class="tags-container">
                  <h4>Diets</h4>
                  <div class="tags-list">
                    <?php
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="another_view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } ?>
                   
                    <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>
                  </div>
                </div>

                <div class="recipes-list">
                 <?php while ($found =mysqli_fetch_array($find)) { ?>
                  <form action="process_save.php" method="POST">
                    <img src="../images-recipe/<?php echo $found['recipe_image']; ?>" class="img recipe-img" alt="" />
                      <h5><?php echo $found['recipe_name']; ?></h5> 
                      <p>Prep : 15min | Cook : 5min</p>
                      <small style="color: gray;"><b>Ratings:</b> <?php echo number_format((float)$found['avg_rate'], 2, '.', ''); ?></small>
                      <br>
                      <input type="hidden" class="form-control" value="<?php echo $found['recipe_Id']; ?>" name="recipe_Id">
                      <input type="hidden" class="form-control" value="<?php echo $recipe; ?>" name="meal_plan">
                      <button class="btn btn-warning" type="submit" name="view_recipe" style="font-size: 12px; width:auto;height: auto;padding: 2px;"><b>View recipe</b></button>
                  </form>
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

              <!-- end of header -->
              <section class="recipes-container">
                <!-- tag container -->
                <div class="tags-container">
                  <h4>Diets</h4>
                  <div class="tags-list">
                    <?php
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="another_view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } ?>
                   
                    <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>
                  </div>
                </div>

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

              <!-- end of header -->
              <section class="recipes-container">
                <!-- tag container -->
                <div class="tags-container">
                  <h4>Diets</h4>
                  <div class="tags-list">
                    <?php
                      $fetchs = mysqli_query($conn, "SELECT * FROM diet");
                      while ($rows = mysqli_fetch_array($fetchs)) { 
                    ?>
                    <a href="another_view_recipe.php?diet_Id=<?php echo $rows['diet_Id']; ?>&&recipe=<?php echo $recipe; ?>"><?php echo $rows['diet_name']; ?> </a>
                    <?php } ?>
                   
                    <a href="index.php" class="btn btn-primary text-light" style="width: 130px;height: auto;font-size: 13px; ">Change Meal</a>
                  </div>
                </div>

                <div class="recipes-list">
                 <?php while ($row =mysqli_fetch_array($fetch)) { ?>
                  <form action="process_save.php" method="POST">
                    <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img recipe-img" alt="" />
                      <h5><?php echo $row['recipe_name']; ?></h5> 
                      <p>Prep : 15min | Cook : 5min</p>
                      <small style="color: gray;"><b>Ratings:</b> <?php echo number_format((float)$row['avg_rate'], 2, '.', ''); ?></small>
                      <br>
                      <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
                      <input type="hidden" class="form-control" value="<?php echo $recipe; ?>" name="meal_plan">
                      <button class="btn btn-warning" type="submit" name="view_recipe" style="font-size: 12px; width:auto;height: auto;padding: 2px;"><b>View recipe</b></button>
                  </form>
                 <?php } ?>

                </div>
                <!-- end of recipes list -->
              </section>
            </main>
            <!-- end of main -->
<?php } ?>



    <?php include 'footer.php'; ?>
<script>

    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>