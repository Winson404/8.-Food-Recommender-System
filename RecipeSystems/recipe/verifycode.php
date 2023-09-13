<title>Verify code</title>
<?php include 'header.php'; ?>

<body>
    <div class="container">
        <?php
        if (isset($_GET['id']) && isset($_GET['email'])) {
            $id = $_GET['id'];
            $email = $_GET['email'];
        ?>

            <form action="processes.php" method="POST" class="login-email">
                <input type="hidden" class="form-control mb-3" name="email" value="<?php echo $email; ?>">
                <input type="hidden" class="form-control mb-3" name="id" value="<?php echo $id; ?>">
                <img src="images/logo.png" class="logo" alt="logo">
                <p class="login-text" style="font-size: 1rem; font-weight: 800;">Please check your email for a message with your code. Your code is 6 numbers long.</p>
                <div class="input-group">
                    <input type="number" placeholder="Enter code" name="code" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="verify_code" class="btn">Continue</button>
                </div>
                <p class="login-register-text">
                    <a href="sendcode.php?user_Id=<?php echo $user_Id; ?>" class="mt-1">Didn't get a code?</a>
                    <br>
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