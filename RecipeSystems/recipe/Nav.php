<?php
    include 'config.php';   
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
    
      <link rel="stylesheet" href="style1.css">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      

  <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
      <title>Recipick</title>
      <link rel="icon" type="image/x-icon" href="images/logo.png">
        <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
  <!-- Font Awesome -->
  <script src="assets/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   </head>
   <body>
      <nav>
         <div class="menu-icon">
            <span class="fas fa-bars"></span>
         </div>
         <div class="logo" img>
            <img style="max-width:150px; margin-top: -7px;"
            src="assets/logoo.png">
         </div>
         <div class="nav-items">
            <li><a href="Home.php">Home </a></li>
            <li><a href="SignIn.php">Login</a></li>
            <!-- <li><a href="#">Blogs</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Feedback</a></li> -->
         </div>
         <div class="search-icon">
            <span class="fas fa-search"></span>
         </div>
         <div class="cancel-icon">
            <span class="fas fa-times"></span>
         </div>
         <form role="search" id="form" action="" method="POST">
                  <input type="search" id="query" name="search" placeholder="Search..." aria-label="Search through site content">
                  <button class="search" type="submit" name="Search">
                    <svg viewBox="0 0 1024 1024">
                        <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
                              55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
                              312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
                              263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
                              455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z">
                        </path>
                    </svg>
                   </button>
                </form>
      </nav>
   </div>
      <script>
         const menuBtn = document.querySelector(".menu-icon span");
         const searchBtn = document.querySelector(".search-icon");
         const cancelBtn = document.querySelector(".cancel-icon");
         const items = document.querySelector(".nav-items");
         const form = document.querySelector("form");
         menuBtn.onclick = ()=>{
           items.classList.add("active");
           menuBtn.classList.add("hide");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
         cancelBtn.onclick = ()=>{
           items.classList.remove("active");
           menuBtn.classList.remove("hide");
           searchBtn.classList.remove("hide");
           cancelBtn.classList.remove("show");
           form.classList.remove("active");
           cancelBtn.style.color = "#ff3d00";
         }
         searchBtn.onclick = ()=>{
           form.classList.add("active");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
      </script>