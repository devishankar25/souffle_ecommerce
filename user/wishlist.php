<?php
include('../includes/db.php');
include('../includes/functions.php'); // Include functions.php

session_start();

$username = $_SESSION['username'];
$pro_id = $_GET['prod_id'];

$get_userid = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($get_userid);

if ($result) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    if (add_to_wishlist($conn, $username, $pro_id)) {
        echo "<script>alert('Product added to wishlist')</script>";
        echo "<script>window.open('view_wishlist.php','_self')</script>";
    } else {
        echo "<script>alert('Product already added in wishlist')</script>";
        echo "<script>window.open('product.php','_self')</script>";
    }
}

$conn->close();
?>

<?php

session_start();
include('../includes/functions.php');

$username = $_SESSION['username'];

if (!$username) {
    echo "<script>alert('Please log in to view your wishlist.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$query = $conn->prepare("SELECT w.product_id, p.pro_name, p.pro_price, p.pro_image 
                         FROM wishlist w 
                         JOIN products p ON w.product_id = p.pro_id 
                         WHERE w.username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
?>

<html>

<head>
    <title>My Wishlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .spaced-element {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="centered-container">
        <section id="header" class="bg-light p-3 spaced-element">
            <div class="container d-flex justify-content-between align-items-center flex-wrap">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
                <ul id="navbar" class="d-flex align-items-center flex-wrap">
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

        <section id="wishlist" class="mt-4 spaced-element">
            <div class="container">
                <h4 class="text-center">My Wishlist</h4>
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-md-4 col-sm-6 mb-4'>
                                    <div class='card'>
                                        <img src='" . $row['pro_image'] . "' class='card-img-top' alt='" . htmlspecialchars($row['pro_name']) . "'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" . $row['pro_name'] . "</h5>
                                            <p class='card-text'>Price: Rs. " . $row['pro_price'] . "/-</p>
                                            <a href='product_details.php?prod_id=" . $row['product_id'] . "' class='btn btn-primary'>View Product</a>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<h4 class='text-center text-danger'>Your wishlist is empty.</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>