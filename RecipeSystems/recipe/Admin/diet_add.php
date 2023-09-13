<!-- ****************************************************CREATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="add_fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel">Create Diet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
            <div class="col-lg-12 mb-2">
              <div class="form-group" id="preview">
              </div>
            </div>
            <div class="form-group">
                <label>Diet name</label>
                <input type="text" class="form-control"  placeholder="Diet name" name="diet" required>
            </div>
            <div class="form-group">
                <label>Diet image</label>
                <input type="file" class="form-control-file form-control-sm" name="fileToUpload" onchange="getImagePreview(event)" required>
            </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="create_diet" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
   function getImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="175px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
    imagediv.appendChild(text);
  }

</script>
