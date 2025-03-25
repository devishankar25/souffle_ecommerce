<?php

session_start();

include('../includes/functions.php');

$username = $_SESSION['username'];

if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['pro_id'];

    if (add_to_wishlist($conn, $username, $product_id)) {
        echo "<script>alert('Product added to wishlist');</script>";
    } else {
        echo "<script>alert('Failed to add product to wishlist');</script>";
    }
}
?>

<html>

<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="centered-container">
        <section id="header" class="bg-light p-3 spaced-element">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
                <ul id="navbar" class="d-flex align-items-center">
                    <li><a href="profile.php"><i class="far fa-user"></i></a></li>
                    <li><a href="../index.php">Home</a></li>
                    <li><a class="active" href="product.php">Products</a></li>
                    <li><a href="viewplan.php">Plans</a></li>
                    <li><a href="viewsession.php">Sessions</a></li>
                    <li><a href="viewfeedback.php">Reviews</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag">
                        <a href="cart.php"><i class="fa-solid fa-cart-plus"></i>
                            <sup><?php echo cart_item($conn); ?></sup>
                        </a>
                    </li>
                    <li><a href="view_wishlist.php"><i class="far fa-heart"></i></a></li>
                    <li><a href="#">Total: <?php echo total($conn); ?> /-</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i></a></li>
                </ul>
            </div>
        </section>

        <section id="product1" class="section-p1 mt-4 spaced-element">
            <div class="container">
                <h4>Products</h4>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-md-4 mb-4'>
                                    <div class='card'>
                                        <img src='" . $row['pro_image'] . "' class='card-img-top' alt='" . htmlspecialchars($row['pro_name']) . "'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" . $row['pro_name'] . "</h5>
                                            <p class='card-text'>Price: Rs. " . $row['pro_price'] . "/-</p>
                                            <form method='post'>
                                                <input type='hidden' name='pro_id' value='" . $row['pro_id'] . "'>
                                                <button type='submit' name='add_to_wishlist' class='btn btn-primary'>Add to Wishlist</button>
                                            </form>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<h4 class='text-center text-danger'>No Products Found</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>