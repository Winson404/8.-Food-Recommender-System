<?php include '../config.php'; ?>

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
  <link rel="stylesheet" href="../css/carousel.css">
  <link rel="stylesheet" href="../css/form.css">
  <link rel="stylesheet" href="../assets/css/owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/css/owlcarousel/owl.theme.default.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


  <title>Recipick</title>
  <link rel="icon" type="image/x-icon" href="images/logo.png">

  <!-- main -->
 <!-- <main class="page">
      <form role="search" id="form">
        <input type="search" id="query" name="q" placeholder="Search..." aria-label="Search through site content">
        <button class="search">
          <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 
            55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 
            312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 
            263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.
            455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
        </button>
      </form>
      <header class="hero">
        <div class="hero-container">
          <div class="hero-text">
            <h1 style=" font-family: Times New Roman, Times, serif;">Recipick</h1>
            <h4>Let's Personalize your experience</h4>
          </div>
        </div>
      </header>

      <section class="recipes-container">
        <div class="tags-container">
          <h4>Diets</h4>
          <div class="tags-list">
            <a href="404.php">Vegan </a>
            <a href="404.php">Vegetarian </a>
            <a href="404.php">Pescetarian </a>
            <a href="404.php">Ketogenic </a>
            <a href="404.php">Paleo </a>
            <a href="404.php">Low FodMap </a>
          </div>
        </div>

        <div class="recipes-list"> -->
    </div>
</nav>
    <div class="row d-flex justify-content-center">
     <div class="title text-center">
     <h3 style="color: black;">Meal Plans</h3>
       <h6 style="color: black;" class="seek">
         Before starting any nutrition software, seek advice with a medical or nutrition professional to ensure that it is appropriate for your needs.
       </h6>
       <div class="inputss">
       <div class="row d-flex justify-content-around mt-5" style="background-color:#FCF49D;  width: 90%; margin-left:100px;">


        <div class="col-lg-12 d-flex justify-content-around ">

          <form id="msform" method="POST" action="process_diet_type_inputs.php">
            <fieldset>
              <div class="">
                <div class="col-lg-12 mb-4">
                  <div class="form-group">
                    <label>Enter preferred Protein (grams)</label>
                    <input type="number" name="protein" class="form-control form-control-md" min="0" step="0.01" required>
                  </div>
                </div>

                <div class="col-lg-12 mb-4">
                  <div class="form-group">
                    <label>Enter preferred Carbohydrate (grams)</label>
                    <input type="number" name="carbs" class="form-control form-control-md" min="0" step="0.01" required>
                  </div>
                </div>
                <div class="col-lg-12 mb-4">
                  <div class="form-group">
                    <label>Enter preferred Fats (grams)</label>
                    <input type="number" name="fat" class="form-control form-control-md" min="0" step="0.01" required>
                  </div>
                </div>

                <div class="col-lg-12 mb-4">
                  <div class="input-group">

                  </div>
                </div>
              </div>
             <!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>-->
              <input type="submit" name="predict_diet" class="submit action-button" value="Submit"/>
            </fieldset>
          </form>
</div>

        </div>
      </div>
      <br>
      <br>
      <div class="row d-flex justify-content-around mt-3" style=" width: 90%; margin-left:90px;" >
      <div class="advice">
          <h3 style="text-align: justify;"><span class="border-bottom border-danger border-3">Medical Advice Disclaimer</span></h3>
          <h4 style="text-align: justify;">
          DISCLAIMER: THIS WEBSITE DOES NOT PROVIDE MEDICAL ADVICE
          </h4>
				  <h6 style="text-align:justify;">The information, including but not limited to text, graphics, images and other material contained on this website are for informational purposes only, No material on this site is intended to be subsitute for professional medical advice, diagnosis or treatment.Always seek advice of your Dietician or other qualified health care regimen, and never disregard professional medical advice or delay in seeking it because of something you have read on this website."</h6>
      </div>
    </div>
       </div>
		</div>
      </div>
  </div>     
    </div>
  </div>







  <?php //include 'footer.php'; ?>
  <script src="../js/app.js"></script>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.fancybox.min.js"></script>
  <script src="../js/scripts.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap5.bundle.min.js"></script>
  <script src="../assets/js/scripts.js"></script>

  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

  <script src="../assets/js/owl.carousel.min.js"></script>


  <script type="text/javascript">
    $(window).on('load', function() {
      $('#exampleModal').modal('show');


      var current_fs, next_fs, previous_fs; //fieldsets
      var opacity;
      var current = 1;
      var steps = $("fieldset").length;

      setProgressBar(current);

      $(".next").click(function(){

        if( $('#cuisine_type_text').val() == '' ) {
          alert('Please choose a cuisine type.');
          return;
        }

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 500
      });



        setProgressBar(++current);
      });

      $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();


        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
      },
      duration: 500
    });
        setProgressBar(--current);
      });

      $('.carousel-main').owlCarousel({
        items: 6,
        loop: false,
        autoplay: false,
        autoplayTimeout: 1500,
        margin: 10,
        nav: true,
        dots: false,
        navText: ['<span class="fas fa-chevron-left fa-2x"></span>','<span class="fas fa-chevron-right fa-2x"></span>'],
      })

      

      // $(".submit").click(function(){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
      //   return true;
      // })

    /*  function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
      }

      var previousClickedDiv = null;
      var previousClickedImg = null;

      $(".cuisine-type-box").click(function() {
        // cuisine_type_divs = document.getElementsByClassName("cuisine_type_div");

        // Array.prototype.forEach.call(cuisine_type_divs, function(el) {
        //   // Do stuff here
        //   el.style.backgroundColor = 'transparent';
        // });

        cuisine_type_value = $(this).attr("data-value");
        cuisine_type_id = $(this).attr("data-id");

        $('#cuisine_type_outer_div_' + cuisine_type_id).addClass('clicked-icon');
        $('#cuisine_type_img' + cuisine_type_id).addClass('clicked-icon-img');

        if( previousClickedDiv && previousClickedImg) {
          $(previousClickedDiv).removeClass('clicked-icon');
          $(previousClickedImg).removeClass('clicked-icon-img');
        }

        previousClickedDiv = '#cuisine_type_outer_div_' + cuisine_type_id;
        previousClickedImg = '#cuisine_type_img' + cuisine_type_id;

        $('#cuisine_type_text').val(cuisine_type_value);

        // console.log(cuisine_type_value);

        // document.getElementById('cuisine_type_text').value = cuisine_type_value;

        //alert('hello');

        return false;
      });*/
    });
  </script>
  <style>
     @media screen and (max-width: 768px) {
  .inputss {
    width: 350px;
    margin-right: 250px;
  }
  .advice{
    
    margin-right: 170px;
  }
}
  </style>