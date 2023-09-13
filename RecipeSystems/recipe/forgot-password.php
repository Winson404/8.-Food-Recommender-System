<title>Forgot password</title>
<?php include 'header.php'; ?>

<body>
    <div class="container">
        <form action="processes.php" method="POST" class="login-email">
            <img src="images/logo.png" class="logo" alt="logo">
            <?php if(isset($_SESSION['success'])) { ?> 
            <h3 class="alert card-title login-text" role="alert" style=";color: white; padding: 2px; "><?php echo $_SESSION['success']; ?></h3>
            <?php unset($_SESSION['success']); } ?>
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Find your account</p>
            <div class="input-group">
                <input type="text" placeholder="Enter Email" name="email">
            </div>
            <div class="input-group">
                <button type="submit" name="search" class="btn">Search</button>
            </div>
            <p class="login-register-text"><a href="SignIn.php">Sign In Here</a></p>
        </form>
    </div>
</body>
</html>

<?php include 'sweetalert_messages.php'; ?>