<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.clickable:hover {
  opacity: .6;
}
</style>
<?php 
      if(isset($_GET['meal_plan'])) 
      $meal_plan = $_GET['meal_plan'];

      include('navbar.php');

      $save = mysqli_query($conn, "UPDATE users_account SET select_meal_plan_history='$meal_plan' WHERE id='$id'");

      $meal = mysqli_query($conn, "SELECT * FROM diet WHERE diet_Id='$meal_plan'");
      $row_meal = mysqli_fetch_array($meal);
      $diet_name = $row_meal['diet_name'];


      $name = $row['fname'].' '.$row['lname'];
      $firstChar = substr($name, 0, 1); // get the first character
      $lastChar = substr($name, -1); // get the last character
      $middleChars = str_repeat("*", strlen($name) - 2); // repeat "*" for the middle characters
      $anonymousName = $firstChar . $middleChars . $lastChar;
?>
    
   <!-- main -->
   <main class="page" onload="myFunction()">
        <header class="hero">
          <div class="hero-container">
            <div class="hero-text">
              <h2 style=" font-family: Times New Roman, Times, serif;">WELCOME TO RECIPICK COMMUNITY</h2>
              <h1><span style="text-transform: uppercase;"><?php echo $diet_name; ?></span> CORNER</h1>
            </div>
          </div>
        </header>


        <div class="card p-5 mb-5 shadow-sm" id="community">
          <form action="process_save.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $meal_plan; ?>" name="meal_plan">
            <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_Id">
            <div class="row">
              <div class="col-2">
                <img src="../images/user.png" class="d-block m-auto" alt="" style="width: 60px;">
                <p class="text-center"><?php echo $row['fname'].' '.$row['lname']; ?></p>
              </div>
              <div class="col-10">
                <textarea rows="3" type="text" class="form-control" name="message" placeholder="Post something in the group..."></textarea>
                <div class="form-group mt-2">
                  <div class="text-center">
                      <input type="file" class="form-control-file d-none" id="image" name="fileToUpload">
                      <div id="image-preview" class="clickable" style="float: right;">
                        <img src="https://t4.ftcdn.net/jpg/04/81/13/43/360_F_481134373_0W4kg2yKeBRHNEklk4F9UXtGHdub3tYk.jpg" class="img-fluid rounded" style="width:50px;height:50px;">
                      </div>
                  </div>
                </div>
               
                <div class="form-group mt-3 d-flex">
                  <div>
                    <label class="switch">
                      <input type="checkbox" id="myCheckbox" name="anonymous">
                      <span class="slider round"></span> 
                    </label>
                  </div>
                  <div>
                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;Leave your comment anonymously</h6>
                    <p class="text-muted" style="margin-top: -5px">&nbsp;&nbsp;&nbsp;&nbsp;Your name will be displayed as <span style="font-style: italic;"><?php echo $anonymousName; ?></span></p>
                  </div>
                </div>  
                <hr>
                <button class="btn btn-primary float-right" type="submit" name="PostCommunity" style="width: auto;height: auto;">Post</button>
              </div>
            </div>
          </form>
        </div>






        <?php 
          $fetch_All = mysqli_query($conn, "SELECT * FROM community JOIN users_account ON community.user_Id=users_account.id WHERE users_account.select_meal_plan_history='$meal_plan' ORDER BY com_Id DESC ");
          function filter_bad_words($text, $forbidden_words) {
              $vowels = array('a', 'e', 'i', 'o', 'u');
              $pattern = '/\b(' . implode('|', $forbidden_words) . ')\b/i';
              $filtered_text = preg_replace_callback($pattern, function ($matches) use ($vowels) {
                $word = $matches[1];
                $filtered_word = str_replace($vowels, '*', strtolower($word));
                return str_replace($word, $filtered_word, $matches[0]);
              }, $text);
              return $filtered_text;
            }
          while ($row = mysqli_fetch_array($fetch_All)) {
            $text = $row['message'];
            $forbidden_words = array('Walang hiya', 'Tae', 'Punyeta', 'Gago','Tangina','Bobo', 'Pakshet', 'Bwisit', 'Leche', 'Hayop', 'Lintik', 'Ulol', 'pepe', 'tite', 'dede', 'letse', 'tae', 'hesusmaryosep', 'lintik', 'hinayupak', 'punyeta', 'susmaryosep', 'buwisit', 'baliw', 'Pota',  'mamatay ka na',  'tanga', 'idiot', 'tae', 'shit', 'panget', 'ugly', 'pek pek', 'pussy', 'titi', 'penis', 'puwit', 'butt', 'Anak ka ng puta', 'Son of a bitch', 'Gago', 'Dumb', 'Kantotero', 'Fucker', 'Tanga', 'Idiot', 'Ulol', 'Idiot', 'Tarantado', 'Bastard', 'Ang bobo mo', 'You are stupid', 'Sira ulo', 'Crazy', 'Kainin mo tae ko', 'Eat my shit', 'Ang panget ng mukha mo', 'Your face is ugly', 'Sipsipin mo ang titi ko', 'Suck my dick', 'Walang hiya', 'Shameless', 'Hayop ka', 'You’re a thoughtless animal', 'bollocks', 'turd', 'crap', 'brotherfucker', 'arsehole', 'wanker', 'bastard', 'spastic', 'Son of a bitch', 'Piss off' , 'Shit', 'Dick head', 'bollocks', 'turd', 'crap', 'brotherfucker', 'arsehole', 'wanker', 'bastard', 'spastic', 'kike', 'dyke','bobo', 'bastard', 'bitch', 'bloody', 'bollocks', 'brotherfucker', 'bugger', 'bullshit', 'child-fucker', 'Christ on a bike', 'Christ on a cracker', 'cock', 'cocksucker', 'crap', 'cuntdamn', 'damn it', 'dick', 'dickhead', 'dyke', 'fatherfucker', 'frigger', 'fuck', 'shit', 'shit ass', 'shite', 'sisterfucker', 'slut', 'son of a bitch', 'son of a whore', 'spastic', 'sweet Jesus', 'turd', 'twat', 'wanker','putangina','tanga');
            $filtered_text = filter_bad_words($text, $forbidden_words);
            $community_Id = $row['com_Id'];
        ?>

        <div class="card p-5 mb-3 bg-light shadow-sm" id="community">
          <form action="process_save.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $meal_plan; ?>" name="meal_plan">
            <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_Id">
            <div class="row">
              <div class="col-2">
                <img src="../images/user.png" class="d-block m-auto" alt="" style="width: 40px;">
                <p class="text-center" style="font-size: 13px"><?php echo $row['name']; ?></p>
              </div>
              <div class="col-7">
                <p style="text-align: justify;font-size: 13px"><?php echo $filtered_text; ?>
                  <br>
                  <span class="text-muted" style="font-size: 12px;">Posted On:</span> 
                  <span class="text-muted" style="font-style: italic; font-size: 12px;"><?php echo date("F d, Y  H:i:s", strtotime($row['date_posted'])); ?></span>
                </p>
                
              </div>
              <div class="col-3">
                <?php if($row['image'] != NULL) :?>
                  <img src="../images-community/<?php echo $row['image'] ?>" class="d-block m-auto" alt="" style="width: 70px;">
                  <p class="text-center" style="font-size: 12px;">Uploaded image</p>
                <?php endif; ?>
              </div>
              
              <div class="col-12 bg-white d-flex">
                  <h6 class="m-2">
                    <?php 
                      $heartN = mysqli_query($conn, "SELECT react_Id FROM reaction WHERE com_Id='$community_Id' ");
                      $c = mysqli_num_rows($heartN);
                      $ako = $_SESSION['user_id'];
                      $getHeart = mysqli_query($conn, "SELECT * FROM reaction WHERE user_Id='$ako' AND com_Id='$community_Id'");
                      if(mysqli_num_rows($getHeart) > 0) :
                    ?>
                    <span class="clickable" data-id="<?php echo $row['com_Id'] ?>" data-userid="<?php echo $_SESSION['user_id'] ?>"><i class="fa-solid fa-heart text-danger"></i> <?php if($c != 0) { echo $c; } ?> </span> 
                    <?php else: ?>
                    <span class="clickable" data-id="<?php echo $row['com_Id'] ?>" data-userid="<?php echo $_SESSION['user_id'] ?>"><i class="fa-regular fa-heart"></i> <?php if($c != 0) { echo $c; } ?></span> 
                    <?php endif ;?>
                    
                  </h6>
                  <?php 
                    $comment = mysqli_query($conn, "SELECT comment_Id FROM comment WHERE com_Id='$community_Id' ");
                    $com = mysqli_num_rows($comment);
                  ?>
                  <h6 class="m-2"><i class="fa-solid fa-message" id="myIcon"></i> <?php if($com != 0 && $com > 1) { echo $com.' Comments'; } elseif($com == 1) { echo $com.' Comment'; }?></h6>
              </div>
              <div class="col-12">
                
              </div>
              <hr>
              <?php 
                $comment = mysqli_query($conn, "SELECT comment_Id FROM comment WHERE com_Id='$community_Id' ");
                $com = mysqli_num_rows($comment);
              ?>
              <div class="col-12">
                <p style="font-size: 13px;"><?php if($com != 0 && $com > 1) { echo $com.' Comments'; } elseif($com == 1) { echo $com.' Comment'; }?></p>
              </div>



              <?php 
                $getcomment = mysqli_query($conn, "SELECT * FROM comment JOIN users_account ON comment.user_Id=users_account.id WHERE comment.com_Id='$community_Id' ORDER BY comment.comment_Id DESC LIMIT 5");
                while ($row_c = mysqli_fetch_array($getcomment)) {
                  $comment_Id = $row_c['comment_Id'];
                  $com_Ids = $row_c['com_Id'];
              ?>
              <div class="col-2 mb-3">
                <img src="../images/user.png" class="d-block m-auto" alt="" style="width: 30px;">
                <p class="text-center" style="font-size:12px;"><?php echo $row_c['fname'].' '.$row_c['lname']; ?></p>
              </div>
              <div class="col-10 mb-3">
                <p class="text-sm" style="text-align: justify;font-size: 13px"><?php echo $row_c['comment'] ?></p>
                <div class="d-flex" style="margin-top: -20px">
                  <?php 
                    $heartN2 = mysqli_query($conn, "SELECT react_Id FROM reaction2 WHERE comment_Id='$comment_Id' ");
                    $c2 = mysqli_num_rows($heartN2);
                    $ako = $_SESSION['user_id'];
                    $getHeart2 = mysqli_query($conn, "SELECT * FROM reaction2 WHERE user_Id='$ako' AND com_Id='$com_Ids' AND comment_Id='$comment_Id'");
                    if(mysqli_num_rows($getHeart2) > 0) :
                  ?>
                  <span class="clickables" data-commentid="<?php echo $comment_Id ?>" data-communityid="<?php echo $com_Ids ?>" data-userid="<?php echo $_SESSION['user_id'] ?>"><i class="fa-solid fa-heart text-danger"></i> <?php if($c2 != 0) { echo $c2; } ?> </span>  
                  <?php else: ?>
                  <span class="clickables" data-commentid="<?php echo $comment_Id ?>" data-communityid="<?php echo $com_Ids ?>" data-userid="<?php echo $_SESSION['user_id'] ?>"><i class="fa-regular fa-heart"></i> <?php if($c2 != 0) { echo $c2; } ?> </span> 
                  <?php endif ;?>
                </div>
              </div>
              <?php } ?>




              <div class="col-12"><hr></div>
              <div class="col-2 mt-3">
                <img src="../images/user.png" class="d-block m-auto" alt="" style="width: 30px;">
                <p class="text-center text-sm text-muted"><?php echo $name; ?></p>
              </div>
              <div class="col-10" id="commenting">
                <form action="process_save.php" method="POST">
                  <input type="hidden" value="<?php echo $row['com_Id']; ?>" name="com_Id">
                  <input type="hidden" value="<?php echo $meal_plan; ?>" name="meal_plan">
                  <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_Id">
                  <div class="input-group mt-4">
                    <input type="text" class="form-control" placeholder="Enter comment here..." required name="comment" style="height: auto;" id="commenthere">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" style="width: auto;height: 25px;" name="postComment"><i class="fas fa-paper-plane"></i></button>
                    </div>
                  </div>
                </form>
              </div>



            </div>
          </form>
        </div>

        <?php } ?>









    </main>
    <!-- end of main -->



<?php include 'footer.php'; ?>

<script>

  $(document).ready(function() {
    $('#myIcon').click(function() {
      $('#commenthere').focus();
    });
  });

  $(document).ready(function() {
    $('#myIcon2').click(function() {
      $('#commenthere').focus();
    });
  });




  $('.clickable').on('click', function() {
    var heartId = $(this).data('id');
    var userid  = $(this).data('userid');
    saveIdfirst(heartId, userid);
  });
  function saveIdfirst(heartId, userid) {
    $.ajax({
      url: 'process_save.php',
      type: 'POST',
      data: {heartId: heartId, userid:userid},
      success: function(response) {
        console.log('Saved');
        location.reload(); // refresh the page
      },
      error: function() {
        console.log('Reaction error.');
        location.reload(); // refresh the page
      }
    });
  }




  $('.clickables').on('click', function() {
    var commentid = $(this).data('commentid');
    var communityid = $(this).data('communityid');
    var userid = $(this).data('userid');
    saveId(commentid, communityid, userid);
  });
  function saveId(commentid, communityid, userid) {
    $.ajax({
      url: 'process_save.php',
      type: 'POST',
      data: {commentid: commentid, communityid: communityid, userid: userid},
      success: function(response) {
        console.log(commentid, communityid, userid);
        location.reload(); // refresh the page
      },
      error: function() {
        console.log('Reaction error.');
        location.reload(); // refresh the page
      }
    });
  }







  const checkbox = document.getElementById("myCheckbox");
  checkbox.addEventListener("change", function() {
    if (checkbox.checked) {
      checkbox.value = "ON";
    } else {
      checkbox.value = "OFF";
    }
  });






  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }





  $("#image-preview").click(function() {
    $("#image").click();
  });

  $("#image").change(function(){
    var file = this.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      $("#image-preview img").attr("src", reader.result);
    }
    if (file) {
      reader.readAsDataURL(file);
    } else {
      $("#image-preview img").attr("src", "");
    }
  });
</script>

