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
  @media screen and (max-width: 768px) {
    .container .repic{
      width: 130px;
      height: 100px;
      
    }
    p.prep{
      margin-top: 40px;
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


  }
  @media screen and (max-width: 653px) {
    .container .repic{
      width: 70px;
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
  @media screen and (max-width: 1399px) {
    .navbar{
  display: flex;
  position: relative;
}
.navbar img{
  width: 150px;

}
.navbar li{
  font-size: 18px;
  margin-right: -10px;
}
.navbar img{
  width: 100px;
}
    
  }
  @media screen and (max-width: 1317px) {
    .navbar{
  display: flex;
  position: relative;
}
.navbar img{
  width: 150px;

}
.navbar li{
  font-size: 19px;
  margin-right: 0px;
}
.navbar img{
  width: 150px;
}
.navbar-collapse{
  margin-left: -100px;

}
    
  }
  @media screen and (max-width: 1251px) {
    .navbar{
  display: flex;
  position: relative;
}
.navbar img{
  width: 150px;

}
.navbar li{
  font-size: 19px;
  margin-right: 0px;
}
.navbar img{
  width: 150px;
}
.navbar-collapse{
  margin-left: -150px;

}
    
  }
  @media screen and (max-width: 1196px) {
    .navbar{
  display: flex;
  position: relative;
}
.navbar img{
  width: 150px;

}
.navbar li{
  font-size: 19px;
  margin-right: 0px;
}
.navbar img{
  width: 150px;
}
.navbar-collapse{
  margin-left: -200px;

}
    
  }
  @media screen and (max-width: 1050px) {
    .navbar{
  display: flex;
  position: relative;
}
.navbar img{
  width: 150px;

}
.navbar li{
  font-size: 19px;
  margin-right: 0px;
}
.navbar img{
  width: 150px;
}
.navbar-collapse{
  margin-left: -250px;
  z-index: 3;

}
    
  }
</style>

<?php
include('Nav.php');

$fetch = mysqli_query($conn, "SELECT * FROM recipe LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_status='1' ORDER BY avg_rate.avg_rate DESC LIMIT 50");
if (isset($_POST['Search'])) {
  $search = mysqli_real_escape_string($conn, $_POST['search']);
  $find = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id LEFT JOIN avg_rate ON recipe.recipe_Id=avg_rate.avg_recipe_Id WHERE recipe_name LIKE '%" . $search . "%' AND recipe_status = 1 ORDER BY avg_rate.avg_rate DESC" );

  if (mysqli_num_rows($find) > 0) {
?>
    <main class="page">
     <!-- <form role="search" id="form" action="" method="POST">
        <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
        <button class="search" type="submit" name="Search">
          <svg viewBox="0 0 1024 1024">
            <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                  55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                  312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                  263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                  455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
          </svg>
        </button>
      </form>-->
      <header class="hero">
        <div class="hero-container">
          <div class="hero-text">
            <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
            <h4>Let's Personalize your experience</h4>
          </div>
        </div>
      </header>
      
      <div class="container">
        <?php while ($found = mysqli_fetch_array($find)) { ?>
          <div class="item">
            <img src="images-recipe/<?php echo $found['recipe_image']; ?>" alt="Image 1" class="repic">
            <div class="row" style="height:60px;" >
            <h5 class="mt-2" id="recipeName" style=" font-family:sans-serif"> <?php echo $found['recipe_name']; ?></h5>
            </div>
            <p class="prep">Prep : 15min | Cook : 5min</p>
            <small class="rate"><b>Ratings:</b> <?php echo number_format((float)$found['avg_rate'], 2, '.', ''); ?></small>
          <!--  <a href="SignIn.php" class="btn" style="width: 35%; padding: 1; background-color:#92A742; color:white;"><b>View recipe</b></a>-->
          </div>
        <?php } ?>
        <div class="row col-12">
                    <hr>
                    <p class="text-center">You've reached the end of the list</p>
                  </div>
      </div>

    </main>

  <?php } else { ?>

    <main class="page">
    <!--  <form role="search" id="form" action="" method="POST">
        <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
        <button class="search" type="submit" name="Search">
          <svg viewBox="0 0 1024 1024">
            <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                  55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                  312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                  263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                  455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
          </svg>
        </button>
      </form>-->
      <header class="hero">
        <div class="hero-container">
          <div class="hero-text">
            <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
            <h4>Let's Personalize your experience</h4>
          </div>
        </div>
      </header>
      <br>
      <div class="recipes-list">
        <h3>No recipe found.</h3>
      </div>
    </main>

  <?php }
} else { ?>

  <main class="page">
  <!--  <form role="search" id="form" action="" method="POST">
      <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
      <button class="search" type="submit" name="Search">
        <svg viewBox="0 0 1024 1024">
          <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                  55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                  312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                  263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                  455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
        </svg>
      </button>
    </form>-->
    <header class="hero">
      <div class="hero-container">
        <div class="hero-text">
          <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
          <h4>Let's Personalize your experience</h4>
        </div>
      </div>
    </header>
    <?php if (isset($recipe) && !empty($recipe)) {
      $diets_query = mysqli_query($conn, "SELECT * FROM diet  where diet_Id = '$recipe' ");
      $diets = mysqli_fetch_array($diets_query);
    ?>
      <h6>Based on your inputs, we have found recipes of diet type <b style="font-size: 23px; "><?= $diets['diet_name'] ?></b> that may suit you. </h6>
    <?php } ?>

    <div class="container">
      <?php while ($row = mysqli_fetch_array($fetch)) { ?>
        <div class="item">
          <img src="images-recipe/<?php echo $row['recipe_image']; ?>" alt="Image 1" class="repic">
          <div class="row" style="height:60px;">
                        <h5 class="mt-2" style="font-family:sans-serif" id="recipeName">
                          <?php 
                            if (strlen($row['recipe_name']) > 60) { echo substr($row['recipe_name'], 0, 60) . '...'; } 
                            else { echo $row['recipe_name']; }
                          ?>
                        </h5>
                      </div>
     <!--     <h6 class="mt-2">
            <?php
            if (strlen($row['recipe_name']) > 60) {
              echo substr($row['recipe_name'], 0, 60) . '...';
            } else {
              echo $row['recipe_name'];
            }
            ?>
          </h6>-->
          <p class="prep">Prep : 15min | Cook : 5min</p>
          <small class="rate"><b >Ratings:</b> <?php echo number_format((float)$row['avg_rate'], 2, '.', ''); ?></small>
        <!--  <a href="SignIn.php" class="btn btn-warning btn-sm" style="width: 35%; padding: 1;"><b>View recipe</b></a>-->
        </div>
      <?php } ?>
      <div class="row col-12">
                    <hr>
                    <p class="text-center">You've reached the end of the list</p>
                  </div>
    </div>

  </main>

<?php } ?>

<?php include 'footer.php'; ?>

<script>
  
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>