<!-- APPROVE -->
<div class="modal fade" id="approve<?php echo $row['recipe_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Approve recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
          <h6 class="text-center">Approve recipe?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="approve_recipe_user_upload"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- DISAPPROVE -->
<div class="modal fade" id="disapprove<?php echo $row['recipe_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Reject recipe? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="recipe_Id">
          <!-- <h6>Reject recipe?</h6> -->
          <label for="">Enter your reason below why you want to reject the recipe</label>
          <textarea name="decline_reason" id="" cols="30" rows="3" class="form-control" required placeholder="Reason here..."></textarea>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-gradient-primary" name="disapprove_recipe_user_upload"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['recipe_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel">Update Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['recipe_Id']; ?>" class="form-control" name="recipe_Id">
            <div class="col-lg-12 mb-2">
              <div class="form-group" id="update_preview">
              </div>
            </div>
            <div class="form-group">
               <?php                           
                $recipe  = mysqli_query($conn, "SELECT DISTINCT recipe_diet_Id, diet_name FROM recipe LEFT JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id");
                $id = $row['recipe_diet_Id'];
                $all_recipe_Id = mysqli_query($conn, "SELECT * FROM diet  where diet_Id = '$id' ");
                $row_all_recipe_Id = mysqli_fetch_array($all_recipe_Id);
                ?>
                <label>Diet category</label>
                <select class="form-control form-control-sm" name="diet_Id" required>
                    <?php foreach($recipe as $recipe_Id):?>
                          <option value="<?php echo $recipe_Id['recipe_diet_Id']; ?>"  
                              <?php if($row_all_recipe_Id['diet_Id'] == $recipe_Id['recipe_diet_Id']) echo 'selected="selected"'; ?> 
                               > <!--/////   CLOSING OPTION TAG  -->
                              <?php echo $recipe_Id['diet_name']; ?>                                          
                          </option>
                   <?php endforeach;?>
                 </select>
            </div>
            <div class="form-group">
                <label>Recipe name</label>
                <input type="text" class="form-control form-control-sm" name="recipe_name" value="<?php echo $row['recipe_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Recipe description</label>
                <input type="text" class="form-control form-control-sm" name="description" value="<?php echo $row['recipe_description']; ?>" >
            </div>
            <div class="form-group">
                <label>Recipe directions</label>
                <input type="text" class="form-control form-control-sm" name="directions" value="<?php echo $row['directions']; ?>" >
            </div>
            <div class="form-group">
                <label>Recipe ingredients</label>
                <input type="text" class="form-control form-control-sm" name="ingredients" value="<?php echo $row['ingredients']; ?>" required>
            </div>
            <div class="form-group">
                <label>Recipe image</label>
                <input type="file" class="form-control-file form-control-sm" name="fileToUpload" onchange="getImagePreview(event)">
            </div>
           
         
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="update_recipe" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
   function update_getImagePreview(events)
  {
    var update_image=URL.createObjectURL(event.target.files[0]);
    var update_imagediv= document.getElementById('update_preview');
    var update_newimg=document.createElement('img');
    var update_text=document.createElement('p');
    update_text.innerHTML='Image preview';
    update_text.style['position']="relative";
    update_text.style['margin-left']="175px";
    update_text.style['margin-top']="10px";
    update_text.style['font-weight']="bold";
    update_imagediv.innerHTML='';
    update_newimg.src=image;
    update_newimg.width="90";
    update_newimg.height="90";
    update_newimg.style['border-radius']="50%";
    update_newimg.style['display']="block";
    update_newimg.style['margin-left']="auto";
    update_newimg.style['margin-right']="auto";
    update_newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    update_imagediv.appendChild(update_newimg);
    update_imagediv.appendChild(update_text);
  }

</script>


<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['recipe_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel">Delete recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['recipe_Id']; ?>" name="Id">
          <h6 class="text-center">Delete recipe record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="recipe_Id_user_upload"><i class="fa-solid fa-trash-can"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->





