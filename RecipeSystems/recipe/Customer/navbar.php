<?php
    
    include '../config.php';   
    if(isset($_SESSION['role_as'])) {
        
        // RECORD TIME LOGGED IN
        $_SESSION['last_active'] = time();


        $id = $_SESSION['role_as'];
        $fetch = mysqli_query($conn, "SELECT * FROM users_account WHERE id='$id'");
        $row = mysqli_fetch_array($fetch);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['recipe'] = $row['select_meal_plan_history'];

        if(isset($_GET['meal_plan'])) 
        $meal_plan = $_GET['meal_plan'];

 ?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">



  <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
  <!-- <link rel="stylesheet" href="../https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/themify-icons.css"> -->
  <!-- <link rel="stylesheet" href="../css/owl.carousel.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/jquery.fancybox.min.css"> -->
  <link rel="stylesheet" href="../style.css">
  <title>Recipick</title>
  <link rel="icon" type="image/x-icon" href="../images/logo.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <!-- Font Awesome -->
  <script src="../assets/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #FCF49D;">
    <div class="container ">
    <a href="#" class="logo" id="logo">
            <img src="../assets/logoo.png" alt="">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form role="search" id="form" action="" method="POST" style="width: 180px; margin-left: 10px; margin-top: 25px; background-color: #B48C59;">
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
    </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="recipe.php?meal_plan=<?php echo $_GET['meal_plan']?>">Home </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Cuisines</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="nav-link" aria-current="page" href="cuisine_type.php?meal_plan=<?php echo $_GET['meal_plan']?>&&cuisine_type=American">American</a>
                        </li>
                        <li>
                            <a class="nav-link" aria-current="page" href="cuisine_type.php?meal_plan=<?php echo $_GET['meal_plan']?>&&cuisine_type=Asian">Asian</a>
                        </li>
                        <li>
                            <a class="nav-link" aria-current="page" href="cuisine_type.php?meal_plan=<?php echo $_GET['meal_plan']?>&&cuisine_type=European">European</a>
                        </li>
                        <li>
                            <a class="nav-link" aria-current="page" href="cuisine_type.php?meal_plan=<?php echo $_GET['meal_plan']?>&&cuisine_type=World">World</a>
                        </li>
                    </ul>
                </li>
              <!--   <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="about.php?meal_plan=<?php echo $_GET['meal_plan']?>">About</a>
                </li> -->
                <!--
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="recipe.php?recipe=<?/*php echo $_GET['recipe']*/?>">Recipe</a>
                </li>-->
               <!--  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="contact.php?meal_plan=<?php echo $_GET['meal_plan']?>">Contact</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="community.php?meal_plan=<?php echo $_GET['meal_plan']?>">Community</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="favorites.php?meal_plan=<?php echo $_GET['meal_plan']?>">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="meal_organizer.php?meal_plan=<?php echo $_GET['meal_plan']?>">Meal organizer</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Meal Management</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link active" aria-current="page" id="service" href="">Meal organizer</a></li>
                        <li><a class="nav-link" aria-current="page" href="meal_breakfast.php?meal_plan=<?php echo $_GET['meal_plan']?>">Add Breakfast</a></li>
                        <li><a class="nav-link" aria-current="page" href="HistoryRecipe.php?meal_plan=<?php echo $_GET['meal_plan']?>">Add Lunch</a></li>
                        <li><a class="nav-link" aria-current="page" href="HistoryRecipe.php?meal_plan=<?php echo $_GET['meal_plan']?>">Add Dinner</a></li>
                    </ul>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     My Recipe</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link" aria-current="page" href="uploadingRecipe.php?meal_plan=<?php echo $_GET['meal_plan']?>">Upload Recipe</a></li>
                        <li><a class="nav-link" aria-current="page" href="HistoryRecipe.php?meal_plan=<?php echo $_GET['meal_plan']?>">Uploaded Recipe</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <?php  echo $row['fname']; ?> </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="my-profile.php?meal_plan=<?php echo $meal_plan; ?>">My Profile</a></li>
                        <li>
                            <form action="" method="POST">
                                <a href="../logout.php" class="dropdown-item">Logout</a>
                                <!-- <button type="submit" name="logout" class="dropdown-item">Logout</button> -->
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php

    } else {
        header ('Location: ../SignIn.php');
    }

?>