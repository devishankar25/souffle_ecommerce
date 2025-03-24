<?php

session_start();

include('includes/functions.php');  // Added semicolon
?>

<html>

<body>

<section id="header">

    <a href=""><img src="logo.png" alt=""></a>  <div>
        <ul id="navbar">

            <li><a href="user/profile.php"><i class="far fa-user"></i></a></li>

            <li><a class="active" href="index.php">Home</a></li>

            <li><a href="user/product.php">Product</a></li>

            <li><a href="user/viewplan.php">Plans</a></li>

            <li><a href="user/viewsession.php">Sessions</a></li>

            <li><a href="user/viewfeedback.php">Reviews</a></li>

            <li><a href="user/contact.php">Contact</a></li>

            <li id="lg-bag"><a href="user/cart.php"><i class="fa-solid fa-cart-plus"></i>
                    <sup><?php cart_item(); ?></sup></a></li>

            <li><a href="#">Total: <?php total(); ?> /-</a></li>

            <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>

            <a href="#" id="close"><i class="far fa-times"></i></a>

        </ul>
    </div>

    <div id="mobile">

        <a href="user/profile.php"><i class="far fa-user"></i></a>


        <a href="user/cart.php"><i class="far fa-cart-plus"></i></a>

        <i id="bar" class="fa fa-outdent"></i>

    </div>

</section>

<?php

cart();
?>

<section id="hero">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <style>nav.navbar a {
                color: azure;
                font-weight: 700;
                background-color: transparent;
                color: darkblue
            }

            nav.navbar a:hover {
                color: blue;
                text-decoration: underline;
            }</style>

        <ul class="navbar-nav me-auto">

            <?php

            if (!isset($_SESSION['username'])) {  // Corrected `$_SESSION`

                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome Guest</a>
                </li>";
            } else {

                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>  </li>";
            }
            ?>

            <?php

            if (!isset($_SESSION['username'])) {  // Corrected `$_SESSION`

                echo "<li class='nav-item'>
                    <a href='user/user.php' class='nav-link'>Login</a>
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