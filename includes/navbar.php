<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="../index.php" class="navbar-brand">
            <img src="../images/logo.png" alt="Logo" style="max-height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="profile.php" class="nav-link"><i class="far fa-user"></i></a></li>
                <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="product.php" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="viewplan.php" class="nav-link">Plans</a></li>
                <li class="nav-item"><a href="viewfeedback.php" class="nav-link">Reviews</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link d-flex align-items-center">
                        <i class="fas fa-shopping-cart me-1"></i>
                        <sup><?php echo cart_item($conn); ?></sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wishlist.php" class="nav-link"><i class="far fa-heart"></i></a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Total: <?php echo total($conn); ?> /-</a></li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>