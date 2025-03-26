<?php

session_start();

include('includes/functions.php'); // Include functions
include('includes/db.php'); // Include database connection
?>

<html>

<head>
    <title>Souffle E-Commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd;
            /* Cool light blue */
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #0288d1;
        }

        .navbar .nav-link {
            color: white !important;
        }

        nav.navbar a {
            color: #ffffff;
            /* Bootstrap primary color */
            font-weight: 700;
        }

        nav.navbar a:hover {
            color: #6610f2;
            /* Bootstrap purple */
            text-decoration: underline;
        }

        #header ul {
            list-style: none;
            padding: 0;
        }

        #header ul li {
            display: inline-block;
            margin: 0 10px;
        }

        #header ul li a {
            text-decoration: none;
            color: #0d6efd;
        }

        #header ul li a:hover {
            color: #6610f2;
        }

        #hero {
            position: relative;
            background: url('images/hero-bg.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 150px 0;
        }

        #hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        #hero .container {
            position: relative;
            z-index: 2;
        }

        #hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        #hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        #hero .btn {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 30px;
        }

        footer {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        footer a {
            color: #6610f2;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            #hero h1 {
                font-size: 2rem;
            }

            #hero p {
                font-size: 1rem;
            }

            #header ul li {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>

    <section id="header" class="bg-light p-3">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <a href="index.php"><img src="images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
            <ul id="navbar" class="d-flex align-items-center flex-wrap">
                <li><a href="user/profile.php"><i class="far fa-user"></i></a></li>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="user/product.php">Products</a></li>
                <li><a href="user/viewplan.php">Plans</a></li>
                <li><a href="user/viewfeedback.php">Reviews</a></li>
                <li><a href="user/contact.php">Contact</a></li>
                <li id="lg-bag" class="ms-3">
                    <a href="user/cart.php">
                        <i class="fas fa-shopping-cart"></i> <!-- Corrected FontAwesome icon class -->
                        <sup><?php echo cart_item($conn); ?></sup>
                    </a>
                </li>
                <li class="ms-3"><a href="#">Total: <?php echo total($conn); ?> /-</a></li>
                <li class="ms-3">
                    <a href="user/logout.php">
                        <i class="fas fa-sign-out-alt"></i> <!-- Added logout icon -->
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <?php cart($conn); ?> <!-- Pass $conn to the cart function -->

    <section id="hero" class="mt-4">
        <div class="container">
            <h1>Welcome to Souffle Bakery</h1>
            <p>Delicious baked goods delivered to your doorstep.</p>
            <a href="user/product.php" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Souffle Bakery. All rights reserved. | <a href="user/contact.php">Contact Us</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>