<?php
session_start();
include 'config.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soufflé Bakery - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Soufflé Bakery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="user/main_page.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="user/product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="user/contact.php">Contact</a></li>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="user/profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="user/logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="user/signup.php">Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" href="user/login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <h1>Welcome to Soufflé Bakery</h1>
        <p class="lead">Delicious pastries and baked goods, made fresh daily!</p>
        <a href="user/product.php" class="btn btn-primary">Shop Now</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
