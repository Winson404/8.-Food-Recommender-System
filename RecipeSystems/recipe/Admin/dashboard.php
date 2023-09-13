<title>Dashboard | Recipick</title>

<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row d-flex justify-content-around ">
          <div class="col-md-5 card">
              <div class="card-header">
                <canvas id="users" style="min-height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer">
                <h5 class="text-center">Registered Users</h5>
              </div>
          </div>

         <!--  <div class="col-md-5 card">
              <div class="card-header">
                <canvas id="diet_types" style="min-height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer">
                <h5 class="text-center">Type of Diets</h5>
              </div>
          </div> -->

          <div class="col-md-5 card">
              <div class="card-header">
                <canvas id="recipe_types" style="min-height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer">
                <h5 class="text-center">Type of Recipes</h5>
              </div>
          </div>

          <div class="col-md-5 card">
              <div class="card-header">
                <canvas id="vegan_recipe" style="min-height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer">
                <h5 class="text-center">Top recipe for each diet</h5>
              </div>
          </div>
          
        </div>

        <!-- <div class="row d-flex justify-content-center">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  $customer = mysqli_query($conn, "SELECT id from users_account WHERE role_as='0'");
                  $row_customer = mysqli_num_rows($customer);
                 ?>
                <h3><?php echo $row_customer; ?></h3>

                <p>Registered Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                  $diet = mysqli_query($conn, "SELECT diet_Id from diet");
                  $row_diet = mysqli_num_rows($diet);
                ?>
                <h3><?php echo $row_diet; ?></h3>

                <p>Diet</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  $recipe = mysqli_query($conn, "SELECT recipe_Id from recipe");
                  $row_recipe = mysqli_num_rows($recipe);
                ?>
                <h3><?php echo $row_recipe; ?></h3>

                <p>Recipe</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div> -->
     
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
 <?php include 'footer.php'; ?>

 <script>
  $(function () {

   // REGISTERED USERS ****************************
    var donutChartCanvas = $('#users').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Vegan Users', 'Keto Users', 'Dash Users', 'Mediterranean Users',],
     <?php 
      $sql = mysqli_query($conn, "SELECT count(id) as vegan FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE diet.diet_name='Vegan'");
      $row = mysqli_fetch_array($sql);

      $sql2 = mysqli_query($conn, "SELECT count(id) as Keto FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE diet.diet_name='Keto'");
      $row2 = mysqli_fetch_array($sql2);

      $sql3 = mysqli_query($conn, "SELECT count(id) as Dash FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE diet.diet_name='Dash'");
      $row3 = mysqli_fetch_array($sql3);

      $sql4 = mysqli_query($conn, "SELECT count(id) as Mediterranean FROM users_account JOIN diet ON users_account.select_meal_plan_history=diet.diet_Id WHERE diet.diet_name='Mediterranean'");
      $row4 = mysqli_fetch_array($sql4);

      echo " datasets: [ 
              { 
                data: [".$row['vegan'].", ".$row2['Keto'].", ".$row3['Dash'].", ".$row4['Mediterranean']."], 
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],

              } 
             ] ";
      ?>
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      // type: 'pie',
      data: donutData,
      options: donutOptions
    })



    // TYPE OF DIETS ****************************
    var donutChartCanvas = $('#vegan_recipe').get(0).getContext('2d')
    var donutData        = {
      <?php 
        $sql5 = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet_name ='Vegan' AND num_clicks = ( SELECT MAX(num_clicks) FROM recipe ) ORDER BY RAND(), recipe_id");
        $row5 = mysqli_fetch_array($sql5);
        $r_recipe_name = "";
        if(mysqli_num_rows($sql5) > 0) {
          $r_recipe_name = $row5['recipe_name'];
        } else {
          $r_recipe_name = "NA";
        }

        $sql6 = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet_name ='Dash' AND num_clicks = ( SELECT MAX(num_clicks) FROM recipe ) ORDER BY RAND(), recipe_id");
        $row6 = mysqli_fetch_array($sql6);  
        $r_recipe_name2 = "";
        if(mysqli_num_rows($sql6) > 0) {
          $r_recipe_name2 = $row6['recipe_name'];
        } else {
          $r_recipe_name2 = "NA";
        }


        $sql77 = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet_name ='Keto' AND num_clicks = ( SELECT MAX(num_clicks) FROM recipe ) ORDER BY RAND(), recipe_id");
        $row78 = mysqli_fetch_array($sql77);  
        $r_recipe_name3 = "";
        if(mysqli_num_rows($sql77) > 0) {
          $r_recipe_name3 = $row78['recipe_name'];
        } else {
          $r_recipe_name3 = "NA";
        }


        $sql88 = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet_name ='Keto' AND num_clicks = ( SELECT MAX(num_clicks) FROM recipe ) ORDER BY RAND(), recipe_id");
        $row88 = mysqli_fetch_array($sql88);  
        $r_recipe_name4 = "";
        if(mysqli_num_rows($sql88) > 0) {
          $r_recipe_name4 = $row88['recipe_name'];
        } else {
          $r_recipe_name4 = "NA";
        }



      
      
      ?>

    labels: ["<?php echo $row5['diet_name']; ?> - <?php echo $r_recipe_name; ?>", "<?php echo $row6['diet_name']; ?> - <?php echo $r_recipe_name2; ?>", "<?php echo $row78['diet_name']; ?> - <?php echo $r_recipe_name3; ?>", "<?php echo $row88['diet_name']; ?> - <?php echo $r_recipe_name4; ?>"],
    datasets: [
        {
            data: [
                <?php echo $row5['num_clicks']; ?>, <?php echo $row6['num_clicks']; ?>, <?php echo $row78['num_clicks']; ?>, <?php echo $row88['num_clicks']; ?>
            ],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }
    ]
     
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      // type: 'pie',
      data: donutData,
      options: donutOptions
    })





    // TYPE OF DIETS ****************************
    var donutChartCanvas = $('#recipe_types').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Vegan recipes', 'Keto recipes', 'Dash recipes', 'Mediterranean recipes',],
     <?php 
      $sql5 = mysqli_query($conn, "SELECT count(recipe_Id) as vegan FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet.diet_name='Vegan' ");
      $row5 = mysqli_fetch_array($sql5);

      $sql6 = mysqli_query($conn, "SELECT count(recipe_Id) as Keto FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet.diet_name='Keto' ");
      $row6 = mysqli_fetch_array($sql6);

      $sql7 = mysqli_query($conn, "SELECT count(recipe_Id) as Dash FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet.diet_name='Dash' ");
      $row7 = mysqli_fetch_array($sql7);

      $sql8 = mysqli_query($conn, "SELECT count(recipe_Id) as Mediterranean FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE diet.diet_name='Mediterranean' ");
      $row8 = mysqli_fetch_array($sql8);

      echo " datasets: [ 
              { 
                data: [".$row5['vegan'].", ".$row6['Keto'].", ".$row7['Dash'].", ".$row8['Mediterranean']."], 
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],

              } 
             ] ";
      ?>
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      // type: 'pie',
      data: donutData,
      options: donutOptions
    })

 


    // // TYPE OF CUISINE ****************************
    // var donutChartCanvas = $('#cuisine_types').get(0).getContext('2d')
    // var donutData        = {

    // labels: ['American', 'Asian', 'British', 'Chinese', 'French', 'Indian', 'AmericaItaliann', 'Mediterranean', 'Mexican', 'Middle Eastern', 'Nordic', 'South American', 'Southeast Asian', 'World', ],
    //  <?php 
    //   $sql5 = mysqli_query($conn, "SELECT count(cuisine_type_id) as American FROM cuisine_type WHERE cuisine_type_name='American' ");
    //   $row5 = mysqli_fetch_array($sql5);

    //   $sql6 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Asian FROM cuisine_type WHERE cuisine_type_name='Asian' ");
    //   $row6 = mysqli_fetch_array($sql6);

    //   $sql7 = mysqli_query($conn, "SELECT count(cuisine_type_id) as British FROM cuisine_type WHERE cuisine_type_name='British' ");
    //   $row7 = mysqli_fetch_array($sql7);

    //   $sql8 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Chinese FROM cuisine_type WHERE cuisine_type_name='Chinese' ");
    //   $row8 = mysqli_fetch_array($sql8);


    //   $sql9 = mysqli_query($conn, "SELECT count(cuisine_type_id) as French FROM cuisine_type WHERE cuisine_type_name='French' ");
    //   $row9 = mysqli_fetch_array($sql9);

    //   $sql10 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Indian FROM cuisine_type WHERE cuisine_type_name='Indian' ");
    //   $row10 = mysqli_fetch_array($sql10);

    //   $sql11 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Italian FROM cuisine_type WHERE cuisine_type_name='Italian' ");
    //   $row11 = mysqli_fetch_array($sql11);

    //   $sql12 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Mediterranean FROM cuisine_type WHERE cuisine_type_name='Mediterranean' ");
    //   $row12 = mysqli_fetch_array($sql12);


    //   $sql13 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Mexican FROM cuisine_type WHERE cuisine_type_name='Mexican' ");
    //   $row13 = mysqli_fetch_array($sql13);

    //   $sql14 = mysqli_query($conn, "SELECT count(cuisine_type_id) as MiddleEastern FROM cuisine_type WHERE cuisine_type_name='Middle Eastern' ");
    //   $row14 = mysqli_fetch_array($sql14);

    //   $sql15 = mysqli_query($conn, "SELECT count(cuisine_type_id) as Nordic FROM cuisine_type WHERE cuisine_type_name='Nordic' ");
    //   $row15 = mysqli_fetch_array($sql15);

    //   $sql16 = mysqli_query($conn, "SELECT count(cuisine_type_id) as SouthAmerican FROM cuisine_type WHERE cuisine_type_name='South American' ");
    //   $row16 = mysqli_fetch_array($sql16);

    //   $sql17 = mysqli_query($conn, "SELECT count(cuisine_type_id) as SoutheastAsian FROM cuisine_type WHERE cuisine_type_name='Southeast Asian' ");
    //   $row17 = mysqli_fetch_array($sql17);

    //   $sql18 = mysqli_query($conn, "SELECT count(cuisine_type_id) as World FROM cuisine_type WHERE cuisine_type_name='World' ");
    //   $row18 = mysqli_fetch_array($sql18);

    //   echo " datasets: [ 
    //           { 
    //             data: [".$row5['American'].", ".$row6['Asian'].", ".$row7['British'].", ".$row8['Chinese'].", ".$row9['French'].", ".$row10['Indian'].", ".$row11['Italian'].", ".$row12['Mediterranean'].", ".$row13['Mexican'].", ".$row14['MiddleEastern'].", ".$row15['Nordic'].", ".$row16['SouthAmerican'].", ".$row17['SoutheastAsian'].", ".$row18['World']."], 
    //             backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#ff9999', '#990000', '#cc0066', '#4ce600', '#006600', '#008040', '#ccffcc', '#00131a', '#262626', '#e67300'],

    //           } 
    //          ] ";
    //   ?>
    // }

    // var donutOptions     = {
    //   maintainAspectRatio : false,
    //   responsive : true,
    // }
    // //Create pie or douhnut chart
    // // You can switch between pie and douhnut using the method below.
    // new Chart(donutChartCanvas, {
    //   type: 'doughnut',
    //   // type: 'pie',
    //   data: donutData,
    //   options: donutOptions
    // })







  })
</script>
