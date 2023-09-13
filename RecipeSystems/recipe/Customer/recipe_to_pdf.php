<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

<?php 
      include('navbar.php');
      
      $id = $_SESSION['role_as'];

      if(isset($_GET['recipe_Id']) && isset($_GET['meal_plan'])) 
      $recipe_Id = $_GET['recipe_Id'];
      $meal_plan = $_GET['meal_plan'];
      $fetch = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_Id='$recipe_Id'");
      $row = mysqli_fetch_array($fetch);
      $steps = $row['directions'];
      $steps_e = explode(',', $steps);

      $ingredients = $row['ingredients'];
      $ingredients_e = explode(',', $ingredients);
     
?>
  
    <main class="page" onload="myFunction()">
      <div class="recipe-page" id="printElement" onload="myFunction()">
        <div class="row d-flex justify-content-center">
          <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img recipe-hero-img d-block m-auto" style="width: 40%; height: 20%;"/>
          <h3 class="text-center mt-2"><?php echo $row['recipe_name']; ?></h3>
                <p style="font-size: 12px;margin-bottom: 10px; margin-top: -25px"><?php echo $row['recipe_description']; ?></p>

          <div class="col-6 mt-4">
              <p  style="margin-bottom: 0px;"><b>Instructions</b> </p>
              <!-- single instruction -->
              <?php
               if($steps != NULL) {
               $i = 1;
               foreach ($steps_e as $item) { ?>
              <div class="single-instruction">
                <header>
                  <p style="font-size: 12px;margin-bottom: 0px">step <?php echo $i++; ?></p>
                  <div></div>
                </header>
                <p>
                  <?php echo $item; ?>
                </p>
              </div>
              <?php } } else { ?>
                <div class="single-instruction">
                  <header>
                    <p style="font-size: 12px;"> - Steps unavailable</p>
                    <div></div>
                  </header>
                </div>
              <?php } ?>
          </div>
          <div class="col-6 mt-4">
              <p style="margin-bottom: 0px;"><b>Ingredients</b></p>
              <?php
               if($ingredients != NULL) { 
               $ii = 1;
               foreach ($ingredients_e as $ingred) {
              ?>
              <p style="text-align:justify; font-size: 12px; margin-bottom: 0px"><?php echo '<b>'.$ii++.'</b>'.'.  '.$ingred; ?></p>
              <?php } } else { ?>
              <p style="text-align:justify">Ingredients unavailable</p>
              <?php } ?>
              <!-- end of single instruction -->
              <div class="mt-2">
             <!--     <p><b>Description</b></p>
                <p style="font-size: 12px;margin-bottom: 10px; margin-top: -25px"><?php echo $row['recipe_description']; ?></p>
              <p><b>Links</b></p>
                <p style="font-size: 12px;margin-bottom: 10px; margin-top: -25px"><?php echo $row['link']; ?></p>-->
              </div>
          </div>
        </div>
      </div>
      <div class="col-12 p-0 mt-5">
        <hr>
        <button onclick="window.history.back()" class="btn float-right ml-2" style="width: auto;height: auto;background-color: grey;"><i class="fa-solid fa-backward"></i> Back</button>
        <button class="btn float-right" id="printButton" style="width: auto;height: auto;" ><i class="fa-solid fa-print"></i> Print/Download</button>

      </div>
    </main>


<script src="print.js"> </script>
<?php include 'footer.php'; ?>

<script>
  window.onload = function() {
    document.getElementById("printButton").click();
  };
</script>