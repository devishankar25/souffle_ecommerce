<?php
include('../includes/functions.php'); // Include the functions file
session_start();

// Assuming $conn is your database connection
// include 'db_connection.php'; // Include your database connection file

$username = $_SESSION['username'];

// Assuming add_to_wishlist is defined in functions.php
include 'functions.php';

if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['pro_id'];
    if (add_to_wishlist($username, $product_id)) {
        echo "<script>alert('Product added to wishlist');</script>";
    } else {
        echo "<script>alert('Failed to add product to wishlist');</script>";
    }
}

cart(); // Assuming cart() function is defined in functions.php
?>

<html>

<head>
    <title>Products</title>
    <style>
        nav.navbar a {
            color: azure;
            font-weight: 700;
        }

        button {
            border-radius: 10px;
        }

        button:hover {
            background-color: seagreen;
            color: azure;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<section id="header">
    <a href="index.php"><img src="logo.png" alt="Logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="profile.php"><i class="far fa-user"></i></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="product.php">Product</a></li>
            <li><a href="viewplan.php">Plans</a></li>
            <li><a href="viewsession.php">Sessions</a></li>
            <li><a href="viewfeedback.php">Reviews</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-plus"></i>
                    <sup><?php cart_item(); ?></sup></a></li>
            <li><a href="view_wishlist.php"><i class="far fa-heart"></i></a></li>
            <li><a href="#">Total: <?php total(); ?>/-</a></li>
            <?php
            if (!isset($_SESSION['username'])) {
                echo '<li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>';
            } else {
                echo '<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>';
            }
            ?>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="profile.php"><i class="far fa-user"></i></a>
        <a href="cart.php"><i class="far fa-cart-plus"></i></a>
        <i id="bar" class="fa fa-outdent"></i>
    </div>
</section>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a href='#' class='nav-link'>Welcome Guest</a></li>";
        } else {
            echo "<li class='nav-item'><a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a></li>";
        }
        ?>
    </ul>
</nav>

<section id="page-header">
    <h2>#health_is_here</h2>
    <h5>Maintain your health with Herbalife products</h5>
</section>

<section id="product1" class="section-p1">
    <h4>Products</h4>
    <h5>Which can change your Life</h5>
    <form class="d-flex" method="get">
        <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="search_data">
        <button type="submit" name="search_data_product">SEARCH</button>
    </form>
    <div class="pro-container">
        <?php
        $sql = "SELECT * FROM products";

        if (isset($_GET['category'])) {
            $category_id = $_GET['category'];
            $sql = "SELECT * FROM products WHERE category_id = $category_id";
        }

        if (isset($_GET['brand'])) {
            $brand_id = $_GET['brand'];
            $sql = "SELECT * FROM products WHERE brand_id = $brand_id";
        }

        if (isset($_GET['search_data_product'])) {
            $search_value = $_GET['search_data'];
            $sql = "SELECT * FROM products WHERE pro_keyword LIKE '%$search_value%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='pro'>";
                echo "<img src='" . $row["pro_image"] . "' alt='" . $row["pro_name"] . "'>";
                echo "<div class='des'>";
                echo "<h5>Product Id: " . $row["pro_id"] . "</h5>";
                echo "<h5>" . $row["pro_name"] . ":" . $row["pro_quantity"] . "gm</h5>";
                echo "<h5>" . $row["pro_des"] . "</h5>";
                echo "<div class='star'>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "</div>";
                echo "<h4>Rs. " . $row["pro_price"] . "/-</h4>";
                echo "<a href='wishlist.php?prod_id=" . $row["pro_id"] . "' class='btn btn-success pull-left'><i class='fa-regular fa-heart'></i></a>";
                echo "<form method='post' action='add_to_cart.php'>";
                echo "<input type='hidden' name='pro_id' value='" . $row["pro_id"] . "'>";
                echo "<input type='hidden' name='price' value='" . $row["pro_price"] . "'>";
                echo "<button type='submit' class='btn'>Add to Cart</button>";
                echo "<a href='product_details.php?prod_id=" . $row["pro_id"] . "' class='btn'>View More</a>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<h4 class='m-2 text-danger'>No Products found</h4>";
        }
        ?>
    </div>

    <div class="col-md-2 bg-secondary p-0">
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light">
                    <h5>Delivery Brands</h5>
                </a>
            </li>
            <?php
            $select = "SELECT * FROM brand";
            $result_select = $conn->query($select);
            while ($row = mysqli_fetch_assoc($result_select)) {
                $brand_title = $row['brand_title'];
                $brand_id = $row['brand_id'];
                echo "<li class='nav-item'>
                    <a href='product.php?brand=$brand_id' class='nav-link text-light'>" . $row['brand_title'] . "</a>
                </li>";
            }
            ?>
        </ul>
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light">
                    <h5>Categories</h5>
                </a>
            </li>
            <?php
            $select = "SELECT * FROM category";
            $result_select = $conn->query($select);
            while ($row = mysqli_fetch_assoc($result_select)) {
                $category_title = $row['category_title'];
                $category_id = $row['category_id'];
                echo "<li class='nav-item'>
                    <a href='product.php?category=$category_id' class='nav-link text-light'>" . $row['category_title'] . "</a>
                </li>";
            }
            ?>
        </ul>
    </div>
</section>

</body>

</html>
