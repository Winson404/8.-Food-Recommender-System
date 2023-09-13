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
  @media screen and (max-width: 763px) {
    .container .repic{
      width: 130px;
      height: 100px;
      
    }
    p.prep{
      margin-top: 30px;
    }
    h5#recipeName {
      font-size: 15px;
      font-weight: 500;

    }



  }  
  @media screen and (max-width: 439px) {
    .container .repic{
      width: 80px;
      height: 100px;
      
    }
    p.prep{
      margin-top: 65px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 15px;
      font-weight: 500;

    }


  }
   @media screen and (max-width: 1041px) {
    .container .repic{
      width: 200px;
      height: 170px;
      
    }
 /*   p.prep{
      margin-top: 65px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 15px;
      font-weight: 500;

    }*/


  }
 @media screen and (max-width: 767px) {
  .container .repic{
      width: 135px;
      height: 120px;
      
    }
    p.prep{
      margin-top: 50px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 15px;
      font-weight: 500;

    }
  
}
@media screen and (max-width: 475px) {
  .container .repic{
      width: 125px;
      height: 120px;
      
    }
    p.prep{
      margin-top: 50px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 15px;
      font-weight: 500;

    }
  
}
@media screen and (max-width: 280px) {
    .container .repic{
      width: 50px;
      height: 80px;
      
    }
    p.prep{
      margin-top: 30px;
      font-size: 12px;
    }
    #recipeName{
      font-size: 11px;
    }
    .rate{
      font-size: 10px;
    }

  }
@media screen and (max-width: 475px) {
  .container .repic{
      width: 115px;
      height: 120px;
      
    }
    p.prep{
      margin-top: 40px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 13px;
      font-weight: 500;

    }
    #views{
      width: 30px;
      height: 50px;
      font-size: 10px;
    }
  
}
@media screen and (max-width: 408px) {
  .container .repic{
      width: 100px;
      height: 110px;
      
    }
    p.prep{
      margin-top: 40px;
      font-size: 12px;
    }
    h5#recipeName {
      font-size: 13px;
      font-weight: 500;

    }
    #views{
      width: 20px;
      height: 50px;
      font-size: 10px;
    }
  
}
@media screen and (max-width: 357px) {
  .container .repic{
      width: 60px;
      height: 80px;
      
    }
    #views{
      width: 20px;
      height: 20px;
      font-size: 10px;
    }
    p.prep{
      margin-top: 30px;
      font-size: 12px;
    }
    #recipeName{
      font-size: 11px;
    }
    .rate{
      font-size: 10px;
    }
  
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
        $find = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_name LIKE '%".$search."%' AND recipe_diet_Id='$meal_plan' AND recipe_status = 1 ORDER BY avg_rate.avg_rate DESC");



        if(mysqli_num_rows($find) > 0) {
        ?>

         <!-- main -->
         <main class="page">
           <!--   <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>-->
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
                      <div class="row">
                      <form action="process_save.php" method="POST">
                        <img src="../images-recipe/<?php echo $found['recipe_image']; ?>" alt="Image 1" class="repic">
                        <div class="row" style="height:50px;">
                        <h5 class="mt-2" id="recipeName">
                          <?php 
                            if (strlen($found['recipe_name']) > 60) { echo substr($found['recipe_name'], 0, 60) . '...'; } 
                            else { echo $found['recipe_name']; }
                          ?>
                        </h5>
                  </div>
                  <div class="mt-4">
                        <p class="prep">Prep : 15min | Cook : 5min</p>
                        <small><b>Ratings:</b> <?php echo number_format((float)$found['avg_rate'], 2, '.', ''); ?></small>
                        <br></div>
                        <input type="hidden" class="form-control" value="<?php echo $found['recipe_Id']; ?>" name="recipe_Id">
                        <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">
                        <div class="mt-2" id="views">
                        <button type="submit" class="btn" name="view_recipe" style="width: auto; height: auto; background-color:#92A742;"><b>View recipe</b></button>
                      
                        </div></form>
                    </div>
                    </div>
                  <?php } ?>
                  <div class="row col-12">
                    <hr>
                    <p class="text-center">You've reached the end of the list</p>
                  </div>
                </div>

                <!-- end of recipes list -->
              </section>
          </main>
          <!-- end of main -->




    <?php

    } else { ?>

            <!-- main -->
         <main class="page">
           <!--   <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>-->
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
          <!--    <form role="search" id="form" action="" method="POST">
                <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                <button class="search" type="submit" name="Search">
                  <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                    55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                    312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                    263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                    455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
              </form>-->
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
                    <div class="row">
                      <form action="process_save.php" method="POST">
                        <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="repic" alt="Image 1">
                        <div class="row" style="height:50px;">
                        <h5 class="mt-2" id="recipeName">
                          <?php 
                            if (strlen($row['recipe_name']) > 60) { echo substr($row['recipe_name'], 0, 60) . '...'; } 
                            else { echo $row['recipe_name']; }
                          ?>
                        </h5>
                      </div>
                      <div class="mt-4">
                        <p class="prep">Prep : 15min | Cook : 5min</p>
                        <small><b>Ratings:</b> <?php echo number_format((float)$row['avg_rate'], 2, '.', ''); ?></small>
                        <br></div>
                        <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
                        <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">
                        <div class="mt-2" id="views">
                        <button type="submit" class="btn btn-warning btn-sm" name="view_recipe" style="width: auto; height: auto;"><b>View recipe</b></button>
                      </div></form>
                    </div>
                    </div>
                  <?php } ?>
                  <div class="row col-12">
                    <hr>
                    <p class="text-center">You've reached the end of the list</p>
                  </div>
                </div>

              
                <!-- end of recipes list -->
              </section>
            </main>
            <!-- end of main -->



            <div class="modal fade" id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered p-3">
                <div class="modal-content">
                   <div class="modal-headert" style="background-color: #DFD683;">
                      <img src="../assets/logoo.png" alt="" style="width:200px;" class="d-block m-auto">
                  </div>
                  <div class="modal-body p-2">
                    <?php 
                      if (isset($_SESSION['protein']) && isset($_SESSION['carbs']) && isset($_SESSION['fat']) && isset($_SESSION['settingDiet'])) {
                        $dietType = $_SESSION['settingDiet'];
                        $protein = $_SESSION['protein'];
                        $carbs = $_SESSION['carbs'];
                        $fat = $_SESSION['fat'];

                        $diets_query2 = mysqli_query($conn, "SELECT * FROM diet  where diet_Id = '$dietType' ");
                        $diets2 = mysqli_fetch_array($diets_query2);
                        $dietName = $diets2['diet_name'];

                      
                    ?>
                      <h6 class="text-center">Based on your input <?php echo $protein; ?>(g) of Protein, <?php echo $carbs; ?>(g) of Carbs and <?php echo $fat; ?>(g) of Fats your resulting diet type is <span style="font-style: italic;"><b><?php echo strtoupper($dietName); ?></b></span></h6>
                    <?php if($dietName == 'Vegan'): ?>
                      <h6><span style="font-style: italic;"><b>What Is It?</b></span></h6>
                      <br>
                      <br>
                      <h6><b>A vegan diet is based on plants (such as vegetables, grains, nuts and fruits) and foods made from plants.</b></h6>
                      <br>
                      <h6><b>You can get the nutrients you need from eating a varied and balanced vegan diet including fortified foods and supplements.</b></h6>
                    <?php elseif($dietName == 'Keto'): ?>
                      <h6><span style="font-style: italic;"><b>What Is It?</b></span></h6>
                      <br>
                      <h6><b><span style="text-decoration: underline;">“Ketogenic”</span> is a term for a low-carb diet . The idea is for you to get more calories from protein and fat and less from carbohydrates.</b></h6>
                      <br>
                      <h6><b>On a keto diet, you cut way back on carbohydrates, also known as carbs, in order to burn fat for fuel.</b></h6>
                    <?php elseif($dietName == 'Dash'): ?>
                      <h6><span style="font-style: italic;"><b>What Is It?</b></span></h6>
                      <br>
                      <h6><b>Dietary Approaches to Stop Hypertension (DASH) is an eating plan to lower or control high blood pressure.</b></h6>
                      <br>
                      <h6><b>The DASH diet features menus with plenty of vegetables, fruits and low-fat dairy products, as well as whole grains, fish, poultry and nuts. It offers limited portions of red meats, sweets and sugary beverages.</b></h6>
                    <?php else: ?>
                      <h6><span style="font-style: italic;"><b>What Is It?</b></span></h6>
                      <br>
                      <h6><b>The Mediterranean Diet emphasizes plant-based foods and healthy fats. You eat mostly veggies, fruits and whole grains.</b></h6>
                      <br>
                      <h6><b>Research shows the Mediterranean Diet can lower your risk of cardiovascular disease and many other chronic conditions.</b></h6>
                    <?php endif; ?>
                    <?php } ?>
                  </div>
                  <div class="modal-footer alert-light">
                    <a href="recipe.php?meal_plan=<?php echo $meal_plan; ?>" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                  </div>
                </div>
              </div>
            </div>



<?php } ?>



<?php 
    include 'footer.php';

    if (isset($_SESSION['settingDiet']) && $_SESSION['settingDiet'] == $meal_plan && !$_SESSION['modalShown']) {
        // check if the session is set and has the expected value, and if the modal has not been shown yet
        // if true, show the modal with id "approve" using jQuery
        echo '<script>
            $(window).on("load", function() {
                $("#approve").modal({
                  backdrop: "static",
                  keyboard: false
        }).modal("show");
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
