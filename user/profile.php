<?php
if (isset($_SESSION['username'])) {
    echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome Guest</a>
</li>";
} else {
    echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
</li>";
}

if (isset($_SESSION['username'])) {
    echo "<li class='nav-item'>
<a href='user.php' class='nav-link'>Login</a>
</li>";
} else {
    echo "<li class='nav-item'>
<a href='logout.php' class='nav-link'>Logout</a>
</li>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title> <style>
        nav.navbar a {
            color: azure;
            font-weight: 700;
        }
    </style>
</head>
<body>
<section id="header">
    <a href=""><img src="logo.png" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a class="active" href="profile.php"><i class="fa fa-user"></i></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="viewplan.php">Plans</a></li>
            <li><a href="viewsession.php">Sessions</a></li>
            <li><a href="viewfeedback.php">Reviews</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup><?php
                    cart_item(); ?></sup></a></li>
            <li><a href="#">Total: <?php
                    total(); ?> /-</a></li>
            <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="profile.php"><i class="far fa-user"></i></a>
        <a href="cart.php"><i class="far fa-cart-plus"></i></a>
        <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
        <i id="bar" class="fa fa-outdent"></i>
    </div>
</section>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome Guest</a>
</li>";
        } else {
            echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
</li>";
        }

        if (isset($_SESSION['username'])) {
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

<div class="row m-auto mt-3">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height: auto">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>My Profile</h4></a>
            </li>
            <li class="nav-item">
                <a href="profile.php?pending" class="nav-link text-light">
                    Pending Orders</a>  </li>
            <li class="nav-item">
                <a href="profile.php?edit_profile" class="nav-link text-light">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?my_orders" class="nav-link text-light">My Orders</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-light">Logout</a>
            </li>
        </ul>
    </div>
    <div class="col-md-10">
        <?php
        if (isset($_GET['pending'])) {
            include('pending.php');
        }

        if (isset($_GET['edit_profile'])) {
            include('edit_profile.php');
        }

        if (isset($_GET['my_orders'])) {
            include('my_orders.php');
        }

        if (isset($_GET['delete_account'])) {
            include('delete_account.php');
        }

        if (isset($_GET['my_plans'])) {
            include('my_plans.php');
        }
        ?>
    </div>
</div>
</body>
</html>