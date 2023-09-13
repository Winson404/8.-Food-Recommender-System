<?php include('navbar.php'); ?>


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

              <br>
                <!-- end of recipes list -->
              </section>
          </main>

    <?php include 'footer.php'; ?>
<script>

    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>