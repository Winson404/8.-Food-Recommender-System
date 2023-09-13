<title>Register</title>
<?php include 'header.php'; ?>

<body style="overflow: scroll;">
    <div class="container" style="width: 400px;">
        <form action="processes.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Sign-Up</p>
            <div class="input-group">
                <input type="text" placeholder="First Name" name="fname" required onkeyup="lettersOnly(this)">
            </div>
            <div class="input-group">
                <input type="text" placeholder="Last Name" name="lname" required onkeyup="lettersOnly(this)">
            </div>
            <div class="input-group">
                <input type="email" placeholder="Enter Email Address" name="email" pattern=".+@gmail.com" size="30" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Enter new password" id="mynewpassword" required>
            </div>
                <p id="password-message" class="text-warning" style="font-size: 12px;"></p>

            <div class="input-group">
                <input type="password" placeholder="Confirm new password" name="cpassword" id="cpassword" onkeyup="validate_password()" required>
            </div>
            <div id="wrong_pass_alert" style="margin-bottom: 20px;font-size: 12px;"></div>
            <div class="input-group">
                <button type="submit" name="register" class="btn" id="newpass">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="SignIn.php">Sign In Here</a>.</p>
            <p class="login-register-text"><a href="Home.php">Home</a></p>
        </form>
    </div>
    </div>
    </div>
    </div>
    </dlv>
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
            document.getElementById('newpass').disabled = true;
            document.getElementById('newpass').style.opacity = (0.4);
        } else {
            document.getElementById('wrong_pass_alert').style.color = 'green';
            document.getElementById('wrong_pass_alert').style.display = 'none';
            document.getElementById('newpass').disabled = false;
            document.getElementById('newpass').style.opacity = (1);
        }
    }


    function lettersOnly(input) {
        var regex = /[^a-z ]/gi;
        input.value = input.value.replace(regex, "");
    }





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