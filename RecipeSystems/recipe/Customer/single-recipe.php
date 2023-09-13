<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

<?php 
      include('navbar.php');
      
      $id = $_SESSION['role_as'];
      $Cust_name = $row['fname'].' '.$row['lname'];

      if(isset($_GET['recipe_Id']) && isset($_GET['meal_plan'])) 
      $recipe_Id = $_GET['recipe_Id'];
      $meal_plan = $_GET['meal_plan'];
      $fetch = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_Id='$recipe_Id'");
      $row = mysqli_fetch_array($fetch);
      $uploadedBy = $row['recipe_uploaded_by'];

      $video_id = "";
      if(!empty($row['link'])) {
        $video_id = explode("v=", $row['link'])[1];
      } else {
        $video_id = "";
      }

      
      // GET NAME WHO ADDS THE RECIPE
      $namename = mysqli_query($conn, "SELECT * FROM users_account WHERE id='$uploadedBy'");
      $nameFinal = mysqli_fetch_array($namename);
      $recipeOwner = $nameFinal['fname'].' '.$nameFinal['lname'];


      $steps = $row['directions'];
      $steps_e = explode(',', $steps);

      $ingredients = $row['ingredients'];
      $ingredients_e = explode(',', $ingredients);

     
?>

    <main class="page" >
      <div class="recipe-page" id="testid">
        <section class="recipe-hero">
          
          <div>
            <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img recipe-hero-img" />
            <a href="recipe_to_pdf.php?recipe_Id=<?php echo $recipe_Id; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn btn-primary float-right mt-3" style="width: auto;height: auto;" onclick="download()"><i class="fa-solid fa-print"></i> Print/Download</a>
          </div>
          <article class="recipe-info">
            <h2><?php echo $row['recipe_name']; ?></h2>
            <p style="margin-top: -20px;"><b>By: <?php echo ucwords($recipeOwner); ?></b></p>
              <p class=""><?php echo $row['recipe_description']; ?></p>
            <p class="recipe-tags">
              Ratings : <a href="rating.php?recipe_Id=<?php echo $row['recipe_Id']; ?>&&user_Id=<?php echo $id; ?>&&meal_plan=<?php echo $meal_plan; ?>" type="button" style="color: white; background-color: orange;">Rate now!</a>
            </p>
          </article>
        </section>
        <!-- content -->
        <section class="recipe-content">

          
          <article>
            <h4>Instructions </h4>
            <!-- single instruction -->
            <?php
             if($steps != NULL) {
             $i = 1;
             foreach ($steps_e as $item) { ?>
            <div class="single-instruction">
              <header>
              <p>step <?php echo $i++; ?></p>
                <div></div>
              </header>
              <p style="text-align:justify">
                <?php echo $item; ?>
              </p>
            </div>
            <?php } } else { ?>
              <div class="single-instruction">
                <header>
                  <p>Steps unavailable</p>
                  <div></div>
                </header>
              </div>
            <?php }?>
            <!-- end of single instruction -->


          </article>


          <article class="second-column">
            <!-- single instruction -->
            <h4>Ingredients</h4>
            <?php
             if($ingredients != NULL) { 
             $ii = 1;
             foreach ($ingredients_e as $ingred) {
            ?>
            <p style="text-align:justify"><?php echo '<b>'.$ii++.'</b>'.'. '.$ingred; ?></p>
            <?php } } else { ?>
            <p style="text-align:justify">Ingredients unavailable</p>
            <?php } ?>
            <!-- end of single instruction -->
        <!--    <div>
              <h4>Description</h4>
              <p class="single-ingredient"><?php echo $row['recipe_description']; ?></p>
            </div>-->

            


            
          </article>

            <div class="col-6 p-0">
                <?php if(empty($row['link'])) : ?>
                  <div class=" d-block m-auto">
                    <hr>
                    <h4 class="text-center d-block m-auto">Video unavailable</h4>
                    <hr>
                  </div>
                <?php else: ?>
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
                <?php endif; ?>
            </div>
            <div class="col-6 p-0">
                <hr>
                <h5 class="mb-0"><b>YIELDS:</b><p class="mt-1" style="font-size: 15px;"><?php echo $row['yields']; ?></p> </h5>
                
                <h6>Amount per serving</h6>
                <h5><b>Calories: </b><?php echo $row['calories']; ?></h5><p></p>
                <hr>
            </div>
         

          
        </section>
      </div>
    </main>
 
<?php include 'footer.php'; ?>

