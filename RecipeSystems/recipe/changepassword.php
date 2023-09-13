<title>Set new password</title>
<?php include 'header.php'; ?>

<body>
    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        ?>

            <form action="processes.php" method="POST" class="login-email">
                <input type="hidden" class="form-control mb-3" name="id" value="<?php echo $id; ?>">
                <img src="images/logo.png" class="logo" alt="logo">
                <p class="login-text" style="font-size: 1rem; font-weight: 800;">Create new password</p>
                <div class="input-group">
                    <input type="password" placeholder="Enter new password" name="password" id="mynewpassword" required>
                </div>
                    <p id="password-message" class="text-warning" style="font-size: 12px;"></p>
                <div class="input-group">
                    <input type="password" placeholder="Enter new password" name="cpassword" id="cpassword" onkeyup="validate_password()" required>
                </div>
                    <p id="wrong_pass_alert" class="text-warning" style="font-size: 12px;"></p>

                <div class="input-group mt-3">
                    <button type="submit" name="changepassword" class="btn" id="changepassword">Continue</button>
                </div>
                <p class="login-register-text">
                    <a href="SignIn.php" class="mt-1">Back to Login</a>
                </p>
            </form>

        <?php } else { ?>

            <img src="images/logo.png" class="logo" alt="logo">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">404 Page Not Found</p>
            <p class="login-register-text" style="margin-left: 5px;"><a href="SignIn.php">Back to Login</a></p>
        <?php } ?>
    </div>
</body>

</html>

<?php include 'sweetalert_messages.php'; ?>

<script>
    // VALIDATE - MATCHED OR NOT MATCHED PASSWORDS
    function validate_password() {
        var pass = document.getElementById('mynewpassword').value;
        var confirm_pass = document.getElementById('cpassword').value;
        if (pass == "") {
            confirm_pass.disabled = true;
        } else if (pass != confirm_pass) {
            document.getElementById('wrong_pass_alert').style.color = 'orange';
            document.getElementById('wrong_pass_alert').innerHTML = 'X Password did not matched!';
            document.getElementById('changepassword').disabled = true;
            document.getElementById('changepassword').style.opacity = (0.4);
        } else {
            document.getElementById('wrong_pass_alert').style.color = 'green';
            document.getElementById('wrong_pass_alert').style.display = 'none';
            document.getElementById('changepassword').disabled = false;
            document.getElementById('changepassword').style.opacity = (1);
        }
    }


    const passwordField = document.getElementById('mynewpassword');
    const passwordMessage = document.getElementById('password-message');

    passwordField.addEventListener('input', () => {
      const password = passwordField.value;
      let errors = [];

      // Check password length
      if (password.length < 8) {
        errors.push('Password must be at least 8 characters long.');
        document.getElementById('changepassword').disabled = true;
      }

      // Check if password contains a special character
      if (!/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password)) {
        errors.push('Password must contain at least one special character.');
        document.getElementById('changepassword').disabled = true;
      }

      // Display error messages if any
      if (errors.length > 0) {
        passwordMessage.innerText = errors.join(' ');
        passwordMessage.classList.add('error');
        document.getElementById('changepassword').disabled = true;
      } else {
        passwordMessage.innerText = '';
        passwordMessage.classList.remove('error');
        document.getElementById('changepassword').disabled = false;
      }
    });
</script>