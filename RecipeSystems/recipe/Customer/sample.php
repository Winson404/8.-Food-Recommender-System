<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
<?php 
      include('navbar.php');
      
      if(isset($_GET['single'])) 
      $single = $_GET['single'];
      $fetch = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_Id='$single'");
      $row = mysqli_fetch_array($fetch);
      $id = $_SESSION['role_as'];
?>

    <main class="page">
      <div class="recipe-page">
        <section class="recipe-hero">
          <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img recipe-hero-img" />
          <article class="recipe-info">
            <h2><?php echo $row['recipe_name']; ?></h2>
            <p>
              Shabby chic humblebrag banh mi bushwick, banjo kale chips
              meggings. Cred selfies sartorial, cloud bread disrupt blue bottle
              seitan. Dreamcatcher tousled bitters, health goth vegan venmo
              whatever street art lyft shabby chic pitchfork beard. Drinking
              vinegar poke tbh, iPhone coloring book polaroid truffaut tousled
              ramps pug trust fund letterpress. Portland four loko austin
              chicharrones bitters single-origin coffee. Leggings letterpress
              occupy pour-over.
            </p>
            <div class="recipe-icons">
              <article>
                <i class="fas fa-clock"></i>
                <h5>prep time</h5>
                <p>30 min.</p>
              </article>
              <article>
                <i class="far fa-clock"></i>
                <h5>cook time</h5>
                <p>15 min.</p>
              </article>
              <article>
                <i class="fas fa-user-friends"></i>
                <h5>serving</h5>
                <p>6 servings</p>
              </article>
            </div>
            <p class="recipe-tags">
              Tags : <a href="tag-template.html">beef</a>
              <a href="tag-template.html">breakfast</a>
              <a href="tag-template.html">pancakes</a>
              <a href="tag-template.html">food</a>
            </p>
            <p class="recipe-tags">
              Ratings : <a href="rating.php?id=<?php echo $row['recipe_Id']; ?>&user_Id=<?php echo $id; ?>" type="button" style="color: white; background-color: orange;">Rate now!</a>
            </p>
          </article>
        </section>
        <!-- content -->
        <section class="recipe-content">
          <article>
            <h4>instructions</h4>
            <!-- single instruction -->
            <div class="single-instruction">
              <header>
                <p>step 1</p>
                <div></div>
              </header>
              <p>
                I'm baby mustache man braid fingerstache small batch venmo
                succulents shoreditch.
              </p>
            </div>
            <!-- end of single instruction -->
            <!-- single instruction -->
            <div class="single-instruction">
              <header>
                <p>step 2</p>
                <div></div>
              </header>
              <p>
                Pabst pitchfork you probably haven't heard of them, asymmetrical
                seitan tousled succulents wolf banh mi man bun bespoke selfies
                freegan ethical hexagon.
              </p>
            </div>
            <!-- end of single instruction -->
            <!-- single instruction -->
            <div class="single-instruction">
              <header>
                <p>step 3</p>
                <div></div>
              </header>
              <p>
                Polaroid iPhone bitters chambray. Cornhole swag kombucha
                live-edge.
              </p>
            </div>
            <!-- end of single instruction -->
          </article>
          <article class="second-column">
            <div>
              <h4>ingredients</h4>
              <p class="single-ingredient">1 1/2 cups dry pancake mix</p>
              <p class="single-ingredient">1/2 cup flax seed meal</p>
              <p class="single-ingredient">1 cup skim milk</p>
            </div>
            <div>
              <h4>tools</h4>
              <p class="single-tool">Hand Blender</p>
              <p class="single-tool">Large Heavy Pot With Lid</p>
              <p class="single-tool">Measuring Spoons</p>
              <p class="single-tool">Measuring Cups</p>
            </div>
          </article>
        </section>
      </div>
    </main>


<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>


    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });

</script>  
<?php include 'footer.php'; ?>
