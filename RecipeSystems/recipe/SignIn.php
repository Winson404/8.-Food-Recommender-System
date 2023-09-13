<title>Sign-in</title>

<?php
    include 'header.php';
    if(isset($_SESSION['role_as'])) {
        header('Location: Customer/index.php');
    } elseif(isset($_SESSION['role_as_admin'])) {
        header('Location: Admin/dashboard.php');
    } else {

    
?>
<style>
    
    @media screen and (max-width: 653px) {
    .logo{
      width: 250px;
      height: 250px;
      
    }
    .container
    {
        
    }
}
</style>
<body>
    <div class="container">
        <form action="processes.php" method="POST" class="login-email">
            <img src="images/logo.png" class="logo" alt="logo">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Sign-In</p>
            <div class="input-group">
                <input type="text" placeholder="Enter Email" name="email">
            </div>
            <div class="input-group">
                <input type="password" placeholder="Enter Password" name="password" id="mynewpassword">
            </div>
                <p id="password-message" class="text-warning" style="font-size: 12px;"></p>
            <div class="input-group">
                <button type="submit" name="login" class="btn" id="newpass">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="SignUp.php">Sign Up Here</a>.</p>
            <p class="login-register-text"><a href="forgot-password.php">Forgot password?</a> | <a href="Home.php">Home</a></p>
        </form>
    </div>
</body>
</html>


<?php } ?>

<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,3000);
  }
);

/*

const passwordField = document.getElementById('mynewpassword');
const passwordMessage = document.getElementById('password-message');

passwordField.addEventListener('input', () => {
  const password = passwordField.value;
  let errors = [];

  // Check password length
  if (password.length < 8) {
    errors.push('Password must be at least 8 characters long.');
    document.getElementById('newpass').disabled = true;
  }

  // Check if password contains a special character
  if (!/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password)) {
    errors.push('Password must contain at least one special character.');
    document.getElementById('newpass').disabled = true;
  }

  // Display error messages if any
  if (errors.length > 0) {
    passwordMessage.innerText = errors.join(' ');
    passwordMessage.classList.add('error');
    document.getElementById('newpass').disabled = true;
  } else {
    passwordMessage.innerText = '';
    passwordMessage.classList.remove('error');
    document.getElementById('newpass').disabled = false;
  }
});

</script>

<?php include 'sweetalert_messages.php'; ?>