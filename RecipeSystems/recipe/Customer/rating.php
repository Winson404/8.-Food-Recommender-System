<?php 
      include '../config.php';

      if(isset($_GET['recipe_Id']) && isset($_GET['user_Id']) && isset($_GET['meal_plan'])) 
      $recipe_Id      = $_GET['recipe_Id'];
      $user_Id = $_GET['user_Id'];
      $meal_plan = $_GET['meal_plan'];
      $fetch = mysqli_query($conn, "SELECT * FROM recipe WHERE recipe_Id='$recipe_Id'");
      $row = mysqli_fetch_array($fetch);
?>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!-- Font Awesome -->
    <script src="../assets/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
</head>

    <body class="p-5">
        <div class="container p-5 mt-3 card-light">

            <form action="process_save.php" method="post">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9">
                       <?php if(isset($_SESSION['success'])) { ?> 
                        <h6 class="alert card-title bg-success text-white text-center" role="alert"><?php echo $_SESSION['success']; ?></h6>
                    <?php unset($_SESSION['success']); } ?>


                    <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                        <h6 class="alert card-title bg-danger text-white " role="alert"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></h6>
                    <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                    <?php  if(isset($_SESSION['exists'])) { ?>
                        <h6 class="alert card-title bg-danger text-white" role="alert"><?php echo $_SESSION['exists']; ?></h6>
                    <?php unset($_SESSION['exists']); } ?>
                   </div>
                   
                   <input type="hidden" class="form-control" value="<?php echo $user_Id; ?>" name="user_Id" id="logged_in_User_Id">
                   <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
                   <input type="hidden" class="form-control" value="<?php echo $meal_plan; ?>" name="meal_plan">
                   <div class="col-lg-9">

                       <a class="btn btn-sm btn-success mb-2" href="single-recipe.php?recipe_Id=<?php echo $recipe_Id; ?>&&meal_plan=<?php echo $meal_plan; ?>"><i class="fa-solid fa-arrow-left"></i> Back</a>
                   </div>
                   <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-muted">Product image</h5>
                            </div>
                            <div class="card-body">
                                <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img-fluid d-block m-auto">
                            </div>
                            <div class="card-footer mt-5">
                                <?php 
                                    $recId = $row['recipe_Id'];
                                    $rate = mysqli_query($conn, "SELECT * FROM ratings WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recId'");
                                    if(mysqli_num_rows($rate) > 0) {
                                        $rec = $row['recipe_Id'];
                                        $color = mysqli_query($conn, "SELECT * FROM favorites WHERE recipe_id='$rec' AND user_id='$user_Id'");
                                        if(mysqli_num_rows($color) > 0): 
                                ?>
                                    <button type="button" class="btn btn-sm btn-dark"><span class="text-warning"><i class="fa-solid fa-heart"></i></span> Added to Favorites</button>
                                <?php else: ?>
                                    <button type="button" class="heart-icon btn btn-sm btn-dark" data-product-id="<?php echo $row['recipe_Id']; ?>"><i class="fa-solid fa-heart"></i> Add to Favorites</button>
                                <?php endif; } ?>
                            </div>
                        </div>
                   </div>
                   <div class="col-lg-5">
                        <div class="card shadow-sm">
                           <div class="card-header">
                               <h5 class="text-muted">Rate product</h5>
                           </div>
                           <div class="card-body">
                               <h5><b>Recipe:</b> <?php echo $row['recipe_name']; ?></h5>
                               <h5><b>Description:</b></h5>
                               <p style="text-align: justify;"><?php echo $row['recipe_description']; ?></p>
                               <?php 
                                    $rate = mysqli_query($conn, "SELECT * FROM ratings WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recId'");
                                    if(mysqli_num_rows($rate) > 0) :
                               ?>
                               <div class="rateyo mt-4 mb-2" id= "rating"
                                 data-rateyo-rating="0"
                                 data-rateyo-num-stars="5"
                                 data-rateyo-score="3" style="pointer-events: none; opacity: .5;">
                               </div>
                               <?php else: ?>
                                <div class="rateyo mt-4 mb-2" id= "rating"
                                 data-rateyo-rating="0"
                                 data-rateyo-num-stars="5"
                                 data-rateyo-score="3">
                               </div>
                               <?php endif; ?>
                               <span class="result" style="margin-left: 5px;">0</span>
                               <input type="hidden" name="rating" >
                                <?php 
                                    $rate = mysqli_query($conn, "SELECT * FROM ratings WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recId'");
                                    if(mysqli_num_rows($rate) > 0) :
                               ?>
                                <textarea name="review" class="form-control mt-3 mb-4" placeholder="Describe your experience (Optional)" cols="30" rows="2" readonly></textarea>
                               <?php else: ?>
                                <textarea name="review" class="form-control mt-3 mb-4" placeholder="Describe your experience (Optional)" cols="30" rows="2"></textarea>
                               <?php endif; ?>
                              
                               
                           </div>
                           <div class="card-footer">
                                <?php 
                                    $rate = mysqli_query($conn, "SELECT * FROM ratings WHERE ratings_user_Id='$user_Id' AND ratings_recipe_Id='$recId'");
                                    if(mysqli_num_rows($rate) > 0) :
                               ?>
                                <button type="submit" class="btn btn-sm btn-warning" name="add_rate" disabled><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-sm btn-warning" name="add_rate"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            <?php endif; ?>
                           </div>
                        </div>
                   </div>
                   <div class="col-lg-10 mt-3">
                    <hr>
                       <div class="row d-flex justify-content-around">
                        <?php 
                             $rate = mysqli_query($conn, "SELECT * FROM ratings JOIN users_account ON ratings.ratings_user_Id=users_account.id WHERE ratings.ratings_recipe_Id='$recId'");
                             if(mysqli_num_rows($rate) > 0) {
                                while($r_rate = mysqli_fetch_array($rate)) {
                        ?>
                           <div class="col-lg-4 card bg-light">                                
                                <p>
                                    <b>Review:</b>
                                    <br>
                                    <small><?php echo $r_rate['review']; ?></small>
                                </p>
                                <p>
                                    <!--<b><?php echo $r_rate['fname'].' '.$r_rate['lname']; ?></b>-->
                                    <br>
                                    <small><?php echo date("F d, Y H:i:s", strtotime($r_rate['date_reviewed'])) ?></small>
                                </p>

                           </div>
                       <?php } } else { ?>
                            <h4>No ratings yet.</h4>
                       <?php } ?>
                       </div>
                   </div>
                   


                </div>
            </form>
        </div>
<script src="../assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('Rating: '+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });


    // ADD TO FAVORITES
    $(document).on('click', '.heart-icon', function(e){
        e.preventDefault();
        var recipe_id = $(this).data('product-id');
        var user_id = document.getElementById("logged_in_User_Id").value;
        $.ajax({
            type: "POST",
            url: "process_save.php",
            data: {recipe_id: recipe_id, user_id: user_id},
            success: function(data){
              alert(data);
              location.reload();
            }
        });


    });


//-----------------------------ALERT TIMEOUT-------------------------//
  $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,5000);
  }
  );
//-----------------------------END ALERT TIMEOUT---------------------//
</script>
</body>

</html>
