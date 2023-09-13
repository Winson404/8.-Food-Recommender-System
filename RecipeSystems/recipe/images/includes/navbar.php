<nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #DFD683;">
    <div class="container">
    <a href="homepage.php" class="logo">
            <img src="assets/logoo.png" alt="">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('homepage.php'); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="service" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Myappointment.php">Upload Recipe</a>
                </li>
                <?php if (isset($_SESSION['authenticated'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['user']['user_fname'] . " " . $_SESSION['user']['user_lname'] ?></a>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                            <li>
                                <form action="" method="POST">
                                    <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>