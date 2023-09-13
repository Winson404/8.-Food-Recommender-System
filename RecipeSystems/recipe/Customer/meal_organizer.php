<style>
    @media screen and (max-width: 767px) {
#mond{

}
  
}
</style>

<?php 
      if(isset($_GET['meal_plan'])) 
      $meal_plan = $_GET['meal_plan'];

      include('navbar.php');
      $logged_in_user = $_SESSION['user_id'];

      $fetch = mysqli_query($conn, "SELECT * FROM favorites JOIN recipe ON favorites.recipe_id=recipe.recipe_Id JOIN avg_rate ON favorites.recipe_id=avg_rate.avg_recipe_Id WHERE favorites.user_id='$logged_in_user'");
      
      // $fetch = mysqli_query($conn, "SELECT * FROM favorites JOIN recipe ON favorites.recipe_id=recipe.recipe_Id JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id RIGHT JOIN avg_rate ON favorites.recipe_id=avg_rate.avg_recipe_Id WHERE favorites.user_id='$logged_in_user'");
?>
        <input type="hidden" class="form-control" value="<?php echo $logged_in_user; ?>" name="user_Id" id="logged_in_User_Id">
         <main class="page">
              <div class="row d-flex justify-content-center">
                <h3 >Meal Organizer <i class="fa-solid fa-calendar-days"></i></h3>
                <hr>
                 <div class="bg-white p-5" style="border: 5px solid #EAE4B3;">
                   <h4>My Meal</h4>
                   
                    <!--  <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>MONDAY</h5>
                       </div>

                       <?php 
                        $monday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='MONDAY'");
                        if(mysqli_num_rows($monday) > 0):
                          $row1 = mysqli_fetch_array($monday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row1['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row1['recipe_name']; ?></h4>

                       </div>
                      <div class="col-lg-4 col-6">
                        <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $found['recipe_id']; ?>&&meal_plan=<?php echo $meal_plan; ?>"><i class="fa-solid fa-eye"></i> View details</a>
                       </div>
                       
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div> -->

                    
                    <div class="card p-2 mb-3" style="border: 5px solid #755406;border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>MONDAY</h5>
                      <table class="table" style="border:1px solid  #755406; background-color: #ffffff;" >
                        <tbody>
                          <?php 
                            $monday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='MONDAY'");
                            if(mysqli_num_rows($monday) > 0):
                
                          ?>
                          <tr style="border-bottom: 1px solid #755406; " id="mond">
                            <?php 
                              $monday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='MONDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($monday_br) > 0): $monday_br_row = mysqli_fetch_array($monday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $monday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $monday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $monday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div></td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                      
                            <?php  endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406; background-color: #ffffff;">
                            <?php 
                              $monday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='MONDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($monday_lunch) > 0): $monday_lunch_row = mysqli_fetch_array($monday_lunch); ?>
                            <td >
                             <div class="d-flex">
                                <img src="../images-recipe/<?php echo $monday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                                <h5 class="p-2"><?php echo $monday_lunch_row['recipe_name']; ?></h5>
                             </div>
                            </td>
                            <td>
                            <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $monday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a> 
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div></td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $monday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='MONDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($monday_dinner) > 0): $monday_dinner_row = mysqli_fetch_array($monday_dinner); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $monday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $monday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $monday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a> 
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div></td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=MONDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>

                    </div>










                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>TUESDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $tuesday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='TUESDAY'");
                            if(mysqli_num_rows($tuesday) > 0):
                          ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <?php 
                              $tuesday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='TUESDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($tuesday_br) > 0): $tuesday_br_row = mysqli_fetch_array($tuesday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $tuesday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $tuesday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                          <td>
                            <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $tuesday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                          </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr  style="border-bottom: 1px solid #755406;">
                            <?php 
                              $tuesday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='TUESDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($tuesday_lunch) > 0): $tuesday_lunch_row = mysqli_fetch_array($tuesday_lunch); ?>
                            <td >
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $tuesday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $tuesday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                            <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $tuesday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $tuesday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='TUESDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($tuesday_dinner) > 0): $tuesday_dinner_row = mysqli_fetch_array($tuesday_dinner); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $tuesday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $tuesday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                            <div class="d-flex p-2 justify-content-end">                            
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $tuesday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>





                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>WEDNESDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $wednesday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='WEDNESDAY'");
                            if(mysqli_num_rows($wednesday) > 0):
                          ?>
                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $wednesday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='WEDNESDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($wednesday_br) > 0): $wednesday_br_row = mysqli_fetch_array($wednesday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $wednesday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $wednesday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                          <td>
                            <div class="d-flex p-2 justify-content-end"> 
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $wednesday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                          </td>
                            
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $wednesday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='WEDNESDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($wednesday_lunch) > 0): $wednesday_lunch_row = mysqli_fetch_array($wednesday_lunch); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $wednesday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $wednesday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                            <div class="d-flex p-2 justify-content-end"> 
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $wednesday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                          </td>
                            
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $wednesday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='WEDNESDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($wednesday_dinner) > 0): $wednesday_dinner_row = mysqli_fetch_array($wednesday_dinner); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $wednesday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $wednesday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                            <div class="d-flex p-2 justify-content-end"> 
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $wednesday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right:10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                            </div>
                          </td>
                            
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>






                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>THURSDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $thursday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='THURSDAY'");
                            if(mysqli_num_rows($thursday) > 0):
                          ?>
                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $thursday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='THURSDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($thursday_br) > 0): $thursday_br_row = mysqli_fetch_array($thursday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $thursday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $thursday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                          <td>
                          <div class="d-flex p-2 justify-content-end"> 
                            <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $thursday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                          </div>
                          </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $thursday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='THURSDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($thursday_lunch) > 0): $thursday_lunch_row = mysqli_fetch_array($thursday_lunch); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $thursday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                                <h5 class="p-2"><?php echo $thursday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end"> 
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $thursday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $thursday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='THURSDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($thursday_dinner) > 0): $thursday_dinner_row = mysqli_fetch_array($thursday_dinner); ?>
                            <td >
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $thursday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $thursday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end"> 
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $thursday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>






                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>FRIDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $friday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='FRIDAY'");
                            if(mysqli_num_rows($friday) > 0):
                          ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <?php 
                              $friday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='FRIDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($friday_br) > 0): $friday_br_row = mysqli_fetch_array($friday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $friday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $friday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $friday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c; ">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr  style="border-bottom: 1px solid #755406;">
                            <?php 
                              $friday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='FRIDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($friday_lunch) > 0): $friday_lunch_row = mysqli_fetch_array($friday_lunch); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $friday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $friday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $friday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c; ">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $friday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='FRIDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($friday_dinner) > 0): $friday_dinner_row = mysqli_fetch_array($friday_dinner); ?>
                            <td>
                             <div class="d-flex">
                                <img src="../images-recipe/<?php echo $friday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $friday_dinner_row['recipe_name']; ?></h5>
                             </div>
                            </td>
                            <td>                              
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $friday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c; ">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>





                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>SATURDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $saturday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SATURDAY'");
                            if(mysqli_num_rows($saturday) > 0):
                          ?>
                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $saturday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SATURDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($saturday_br) > 0): $saturday_br_row = mysqli_fetch_array($saturday_br); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $saturday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $saturday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">  
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $saturday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $saturday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SATURDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($saturday_lunch) > 0): $saturday_lunch_row = mysqli_fetch_array($saturday_lunch); ?>
                            <td >
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $saturday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $saturday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">  
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $saturday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $saturday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SATURDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($saturday_dinner) > 0): $saturday_dinner_row = mysqli_fetch_array($saturday_dinner); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $saturday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $saturday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">  
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $saturday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr>
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>






                    <div class="card p-2 mb-3" style="border: 5px solid #755406; border-radius: 15px 50px 30px; background-color: #EAE4B3;">
                      <h5>SUNDAY</h5>
                      <table class="table" style="border: 1px solid  #755406; background-color: #ffffff;">
                        <tbody>
                          <?php 
                            $sunday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SUNDAY'");
                            if(mysqli_num_rows($sunday) > 0):
                          ?>
                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $sunday_br = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SUNDAY' AND org_meal_time='Breakfast'");
                            ?>
                            <td>Breakfast</td> 
                            <?php if(mysqli_num_rows($sunday_br) > 0): $sunday_br_row = mysqli_fetch_array($sunday_br); ?>
                            <td >
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $sunday_br_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $sunday_br_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $sunday_br_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Breakfast" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr style="border-bottom: 1px solid #755406;">
                            <?php 
                              $sunday_lunch = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SUNDAY' AND org_meal_time='Lunch'");
                            ?>
                            <td>Lunch</td> 
                            <?php if(mysqli_num_rows($sunday_lunch) > 0): $sunday_lunch_row = mysqli_fetch_array($sunday_lunch); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $sunday_lunch_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $sunday_lunch_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $sunday_lunch_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Lunch" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>                            
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <tr>
                            <?php 
                              $sunday_dinner = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SUNDAY' AND org_meal_time='Dinner'");
                            ?>
                            <td>Dinner</td> 
                            <?php if(mysqli_num_rows($sunday_dinner) > 0): $sunday_dinner_row = mysqli_fetch_array($sunday_dinner); ?>
                            <td>
                              <div class="d-flex">
                                <img src="../images-recipe/<?php echo $sunday_dinner_row['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                              <h5 class="p-2"><?php echo $sunday_dinner_row['recipe_name']; ?></h5>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex p-2 justify-content-end">                                
                                <a class="btn btn-warning btn-sm" href="single-recipe.php?recipe_Id=<?php echo $sunday_dinner_row['org_recipe_Id']; ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style="width: auto;height: auto; margin-right: 10px;"><i class="fa-solid fa-eye"></i> View details</a>
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Dinner" class="btn" style="width: auto;height: auto; background-color: #00b33c; float: right;">Change <i class="fa-solid fa-rotate"></i></a>
                              </div>
                            </td>
                            <?php else: ?>
                              <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                            <?php endif; ?>
                          </tr>


                          <?php else: ?>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td >Breakfast</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Breakfast" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                            </td>
                          </tr>
                          <tr  style="border-bottom: 1px solid #755406;">
                            <td>Lunch</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Lunch" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <tr >
                            <td>Dinner</td>
                            <td class="text-center" colspan="2">
                                <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY&&meal_time=Dinner" class="btn btn-primary" style="width: auto;height: auto; float: right;">Add <i class="fa-solid fa-plus"></i></a>
                              </td>
                          </tr>
                          <?php endif; ?>
                         
                        </tbody>
                      </table>
                    </div>







                   </div>

                   <!-- <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>TUESDAY</h5>
                       </div>
                       <?php 
                        $tuesday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='TUESDAY'");
                        if(mysqli_num_rows($tuesday) > 0):
                          $row2 = mysqli_fetch_array($tuesday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row2['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row2['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=TUESDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div>

                   <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>WEDNESDAY</h5>
                       </div>
                       <?php 
                        $wednesday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='WEDNESDAY'");
                        if(mysqli_num_rows($wednesday) > 0):
                          $row3 = mysqli_fetch_array($wednesday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row3['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row3['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY"  class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=WEDNESDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div>

                   <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>THURSDAY</h5>
                       </div>
                       <?php 
                        $thursday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='THURSDAY'");
                        if(mysqli_num_rows($thursday) > 0):
                          $row4 = mysqli_fetch_array($thursday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row4['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row4['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=THURSDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div>

                   <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>FRIDAY</h5>
                       </div>
                       <?php 
                        $friday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='FRIDAY'");
                        if(mysqli_num_rows($friday) > 0):
                          $row5 = mysqli_fetch_array($friday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row5['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row5['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY"  class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=FRIDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div>

                   <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>SATURDAY</h5>
                       </div>
                       <?php 
                        $saturday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SATURDAY'");
                        if(mysqli_num_rows($saturday) > 0):
                          $row6 = mysqli_fetch_array($saturday);
                       ?>
                       <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row6['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row6['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SATURDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div>

                   <div class="card p-2 mb-3">
                     <div class="row d-flex justify-content-center text-center">
                       <div class="col-lg-4 col-6">
                         <h5>SUNDAY</h5>
                       </div>
                       <?php 
                        $sunday = mysqli_query($conn, "SELECT * FROM meal_organizer JOIN recipe ON meal_organizer.org_recipe_Id=recipe.recipe_Id WHERE org_user_Id='$logged_in_user' AND org_meal_day='SUNDAY'");
                        if(mysqli_num_rows($sunday) > 0):
                          $row7 = mysqli_fetch_array($sunday);
                       ?>
                        <div class="col-lg-4 col-6 d-flex justify-content-center">
                         <img src="../images-recipe/<?php echo $row7['recipe_image']; ?>" alt="" style="width: 50px; height: 50px;">
                         <h4><?php echo $row7['recipe_name']; ?></h4>
                       </div>
                       <div class="col-lg-4 col-6">
                         <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY" class="btn" style="width: auto;height: auto; background-color: #00b33c;">Change <i class="fa-solid fa-rotate"></i></a>
                       </div>
                       <?php else: ?>
                        <div class="col-8 d-flex justify-content-center">
                            <a href="meal_organizer_selection.php?meal_plan=<?php echo $meal_plan; ?>&&day=SUNDAY" class="btn btn-primary" style="width: auto;height: auto;">Add <i class="fa-solid fa-plus"></i></a>
                        </div>
                       <?php endif; ?>
                     </div>
                   </div> -->




              </div>
         </main>


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
  // ADD TO FAVORITES
  $(document).on('click', '.heart-icon', function(e){
      e.preventDefault();
      var recipe_id = $(this).data('product-id');
      var user_id = document.getElementById("logged_in_User_Id").value;
      $.ajax({
          type: "POST",
          url: "process_delete.php",
          data: {recipe_id: recipe_id, user_id: user_id},
          success: function(data){
            alert(data);
            location.reload();
          }
      });
  });


</script>
