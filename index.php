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
        nav.navbar a {
            color: azure;
            font-weight: 700;
            background-color: transparent;
            color: darkblue;
        }

        nav.navbar a:hover {
            color: blue;
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
            color: black;
        }

        #header ul li a:hover {
            color: blue;
        }
    </style>
</head>

<body>

    <section id="header" class="bg-light p-3">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <a href="index.php"><img src="logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
            <ul id="navbar" class="d-flex align-items-center flex-wrap">
                <li><a href="user/profile.php"><i class="far fa-user"></i></a></li>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="user/product.php">Products</a></li>
                <li><a href="user/viewplan.php">Plans</a></li>
                <li><a href="user/viewsession.php">Sessions</a></li>
                <li><a href="user/viewfeedback.php">Reviews</a></li>
                <li><a href="user/contact.php">Contact</a></li>
                <li id="lg-bag">
                    <a href="user/cart.php"><i class="fa-solid fa-cart-plus"></i>
                        <sup><?php echo cart_item($conn); ?></sup>
                    </a>
                </li>
                <li><a href="#">Total: <?php echo total($conn); ?> /-</a></li>
                <li><a href="user/logout.php"><i class="fa fa-sign-out"></i></a></li>
            </ul>
        </div>
    </section>

    <?php cart($conn); ?> <!-- Pass $conn to the cart function -->

    <section id="hero" class="mt-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto">
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                                <a href='#' class='nav-link'>Welcome Guest</a>
                            </li>";
                            echo "<li class='nav-item'>
                                <a href='user/login.php' class='nav-link'>Login</a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                                <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                            </li>";
                            echo "<li class='nav-item'>
                                <a href='user/logout.php' class='nav-link'>Logout</a>
                            </li>";
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>