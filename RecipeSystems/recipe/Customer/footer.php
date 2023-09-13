<style>
#myBtn {
  scroll-behavior: smooth;
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 10px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: #92A742; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 7px; /* Some padding */
  border-radius: 12px; /* Rounded corners */
  text-align: center;
  font-size: 28px;  /*  Increase font size */
}

#myBtn:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
@media screen and (max-width: 768px){
  #logs{
    width: 100px;
  }
  #feet{
    width: 240px;
    margin-right: 10px;
  }
  #con{
    margin-right: 410px;
  }
}
@media screen and (max-width: 370px) {
  #feet{
    margin-left: 100px;
  }
  }
  @media screen and (max-width: 1224px) {
  #feet{
    margin-left: -10px;
  }
  }
  @media screen and (max-width: 1164px) {
  #feet{
    width: 165px;
  }
  }
  @media screen and (max-width: 1089px) {
  #feet{
    width: 150px;
    margin-left: 10px;
    font-size: 15px;
  }
  #con{
    width: 190px;
    margin-right: 150px;
  }

  }
  @media screen and (max-width: 1074px) {
  #feet{
    margin-left: 10px;
  }
  #con{
    width: 180px;
    margin-right: 150px;
  }

  }
  @media screen and (max-width: 1057px) {
    #feet{
    width: 180px;
    margin-left: 10px;
  }
  #con{
    width: 190px;  
    margin-left: -110px;
  }


  }
  @media screen and (max-width: 1001px) {
  #feet{
    width: 180px;
    margin-left: 10px;
  }
  #con{
    width: 190px;  
    margin-left: -110px;
  }

  }
  @media screen and (max-width: 954px) {
  #feet{
    width: 180px;
    margin-left: 10px;
  }
  #con{
    width: 190px;  
    margin-left: -150px;
  }

  }
  @media screen and (max-width: 871px) {
  #feet{
    width: 320px;
    margin-right: -110px;
  }
  #con{
    width: 200px;  
    margin-left: -170px;
  }

  }
  @media screen and (max-width: 734px) {
  #feet{
    width: 250px;
    margin-left: 130px;
  }
  #con{
    width: 200px;  
    margin-left: 30px;
  }

  }




</style>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i> </button>
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered p-3">
    <div class="modal-content">
       <div class="modal-headert" style="background-color: #DFD683;">
          <img src="../assets/logoo.png" alt="" style="width:200px;" class="d-block m-auto">
      </div>
      <div class="modal-body p-5">
          <h6 class="text-center">Your session has timed out. Please login again</h6>
      </div>
      <div class="modal-footer alert-light">
        <a href="../logout.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>
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

    <!-- footer -->
    <footer class="p-1" style="background-color: #DFD683;">
      <!-- <p>
        &copy; <span id="date"></span>
        <span class="footer-logo">2022 Recipick</span> Built by
        <a href>CTRL INTELLEGENCE</a>
      </p> -->
      <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-md-4 col-sm-4 col-8 p-3" style="margin-right: 200px;" id="feet">
                <img src="../assets/logoo.png" class="d-block m-auto" alt="" style="width:150px;">
                <p>We are young company providing a personalized and preference-based recipes for your everyday needs. <br><a href="about.php" class="text-red" style="color:red; text-decoration:none;">Read more...</a></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 p-3" id="con">
                <h4 class="mt-3">CONTACT US</h4>
                <p>
                  <i class="fa-solid fa-location-dot"></i> Makati City <br>
                  <i class="fa-solid fa-phone"></i> +639-396-152-128 <br>
                  <i class="fa-solid fa-envelope"></i> recipick@gmail.com</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 p-3" id="recipickcontact">
              <form action="#" method="POST">
                <h4 class="mt-3"><b>GET IN TOUCH</b></h4>
                <textarea type="message" class="form-control" placeholder="Enter message here..." rows="3" cols="30" name="message" required></textarea>
                <button class="btn mt-2" type="submit" name="submit" style="width: auto; height: auto; background-color:#92A742; color:white;">Submit</button>
              </form>
            </div>
          </div>
    </footer>
    <script src="../js/app.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap5.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <script>
      // Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
    </script>
  </body>
</html>

<?php include 'sweetalert_messages.php'; ?>

<?php include 'sweetalert_messages.php'; ?>

<script>
  setInterval(function() {
    var lastActive = <?php echo $_SESSION['last_active']; ?>;
    var currentTime = new Date().getTime() / 1000;
    var inactiveTime = currentTime - lastActive;
    if (inactiveTime > 300) { // inactivity period is 10 seconds
        
        $('#logout').modal({
          backdrop: 'static',
          keyboard: false
        }).modal('show');

        setTimeout(function() {
          window.location.href = '../logout.php';
        }, 15000); 

    }
  }, 1000); // check every second
</script>