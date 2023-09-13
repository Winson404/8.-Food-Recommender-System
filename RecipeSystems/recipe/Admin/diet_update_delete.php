<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['diet_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel">Create Diet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['diet_Id']; ?>" class="form-control" name="diet_Id">
            <div class="col-lg-12 mb-2">
              <div class="form-group" id="update_preview">
              </div>
            </div>
            <div class="form-group">
                <label>Diet name</label>
                <input type="text" class="form-control"  placeholder="Diet name" name="diet" required value="<?php echo $row['diet_name']; ?>">
            </div>
            <div class="form-group">
              <label>Diet image</label>
              <input type="file" class="form-control-file form-control-sm" name="fileToUpload" onchange="update_getImagePreview(events)">
            </div>
           
         
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="update_diet" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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
<div class="modal fade" id="delete<?php echo $row['diet_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel">Delete diet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['diet_Id']; ?>" name="diet_Id">
          <h6 class="text-center">Delete diet record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_diet_Id"><i class="fa-solid fa-circle-check"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->





