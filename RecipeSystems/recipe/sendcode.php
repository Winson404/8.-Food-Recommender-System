<title>Request verification code</title>
<?php include 'header.php'; ?>

<body>
    <div class="container">
        <?php  
            if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $fetch = mysqli_query($conn, "SELECT * FROM users_account WHERE id='$id'");
            $row = mysqli_fetch_array($fetch);
        ?>

        <form action="processes.php" method="POST" class="login-email">
            <input type="hidden" class="form-control mb-3" name="email" value="<?php echo $row['email']; ?>">
            <input type="hidden" class="form-control mb-3" name="id" value="<?php echo $id; ?>">
            <img src="images/logo.png" class="logo" alt="logo">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Request code</p>
            <div class="input-group">
              <p class="login-register-text">Send code to your email <b><?php echo $row['email']; ?></b>?</p>
            </div>
            <div class="input-group">
                <button type="submit" name="sendcode" class="btn">Continue</button>
            </div>
            <p class="login-register-text"><a href="forgot-password.php">Not you?</a></p>
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