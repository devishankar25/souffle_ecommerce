<?php

session_start();
include('../includes/functions.php');

$get_ip = getClientIP();
$total = 0;

$query = $conn->prepare("SELECT c.pro_id, c.quantity, p.pro_name, p.pro_price, p.pro_image 
                         FROM cart c 
                         JOIN products p ON c.pro_id = p.pro_id 
                         WHERE c.ip_address = ?");
$query->bind_param("s", $get_ip);
$query->execute();
$result = $query->get_result();
?>

<html>

<head>
    <title>My Cart</title>
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
                    <li><a href="product.php">Products</a></li>
                    <li><a href="viewplan.php">Plans</a></li>
                    <li><a href="viewsession.php">Sessions</a></li>
                    <li><a href="viewfeedback.php">Reviews</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag">
                        <a href="cart.php"><i class="fa-solid fa-cart-plus"></i>
                            <sup><?php echo cart_item($conn); ?></sup>
                        </a>
                    </li>
                    <li><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                    <li><a href="#">Total: <?php echo total($conn); ?> /-</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i></a></li>
                </ul>
            </div>
        </section>

        <section id="cart" class="mt-4 spaced-element">
            <div class="container">
                <h4>My Cart</h4>
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $total += $row['pro_price'] * $row['quantity'];
                            echo "<div class='col-md-4 mb-4'>
                                    <div class='card'>
                                        <img src='" . $row['pro_image'] . "' class='card-img-top' alt='" . htmlspecialchars($row['pro_name']) . "'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" . $row['pro_name'] . "</h5>
                                            <p class='card-text'>Price: Rs. " . $row['pro_price'] . "/-</p>
                                            <p class='card-text'>Quantity: " . $row['quantity'] . "</p>
                                        </div>
                                    </div>
                                  </div>";
                        }
                        echo "<h5 class='text-end'>Total: Rs. $total /-</h5>";
                    } else {
                        echo "<h4 class='text-center text-danger'>Your cart is empty.</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>