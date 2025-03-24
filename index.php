<?php
session_start();
include('includes/functions.php'); // Include the functions file
?>

<html><body>

    <!-- Header Section -->
    <section id="header">
        <a href=""><img src="logo.png" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="profile.php"><i class="far fa-user"></i></a></li>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="viewplan.php">Plans</a></li>
                <li><a href="viewsession.php">Sessions</a></li>
                <li><a href="viewfeedback.php">Reviews</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="fas fa-cart-plus"></i><sup><?php cart_item(); ?></sup></a>
                </li>
                <li><a href="#">Total: <?php total(); ?> /-</a></li>
                <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="profile.php"><i class="far fa-user"></i></a>
            <a href="cart.php"><i class="fas fa-cart-plus"></i></a>
            <i id="bar" class="fa fa-outdent"></i>
        </div>
    </section>

    <?php cart(); ?>

    <!-- Hero Section -->
    <section id="hero">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <style>
                nav.navbar a {
                    color: darkblue;
                    font-weight: 700;
                    background-color: transparent;
                }

                nav.navbar a:hover {
                    color: blue;
                    text-decoration: underline;
                }
            </style>
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                        <a href='#' class='nav-link'>Welcome Guest</a>
                    </li>";
                } else {
                    echo "<li class='nav-item'>
                        <a href='#' class='nav-link'>Welcome ".$_SESSION['username']."</a>
                    </li>";
                }
                ?>
                
                <?php

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                        <a href='user.php' class='nav-link'>Login</a>
                    </li>";
                } else {
                    echo "<li class='nav-item'>
                        <a href='logout.php' class='nav-link'>Logout</a>
                    </li>";
                }
                ?>
            </ul>
        </nav>
    </section>

</body>

</html>
