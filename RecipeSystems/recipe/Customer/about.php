<?php
      include 'navbar.php';
      if(isset($_GET['recipe'])) 
      $recipe = $_GET['recipe'];

 ?> 

    <!-- end of nav -->
    <main class="page">
      <section class="about-page">
        <article>
          <h2>About Recipick</h2>
          <p>
            Recipick is a preference-based recipe recommender it  allows users to pick recipes based on their own preferences. Recipick consists of different recipes on a different classification of diets. Recipes from Vegan to Low Fodmap diets. Perfect for those looking for their prescribed food choices. Recipick even let users to upload their own recipes. From the vast information of food rcipes online, Recipick is the best choice.</p>
          <a href="#recipickcontact" class="btn"> contact </a>
        </article>
        <!-- needs fixes -->
        <img src="../assets/vvv.png" alt="Person Pouring Salt in Bowl" class="img about-img"/>
      </section>
      <section class="featured-recipes">
        <h5 class="featured-title">Look At This Awesomesouce!</h5>
        <div class="recipes-list">
          <!-- single recipe -->
          <a href="single-recipe.html" class="recipe">
            <img src="../assets/recipes/recipe-1.jpeg" class="img recipe-img" alt="" />
            <h5>Carne Asada</h5>
            <p>Prep : 15min | Cook : 5min</p>
          </a>
          <!-- end of single recipe -->
          <!-- single recipe -->
          <a href="single-recipe.html" class="recipe">
            <img src="../assets/recipes/recipe-2.jpeg" class="img recipe-img" alt="" />
            <h5>Greek Ribs</h5>
            <p>Prep : 15min | Cook : 5min</p>
          </a>
          <!-- end of single recipe -->
          <!-- single recipe -->
          <a href="single-recipe.html" class="recipe">
            <img src="../assets/recipes/recipe-3.jpeg" class="img recipe-img" alt=""/>
            <h5>Vegetable Soup</h5>
            <p>Prep : 15min | Cook : 5min</p>
          </a>
          <!-- end of single recipe -->
        </div>
      </section>
    </main>
<?php include 'footer.php'; ?>