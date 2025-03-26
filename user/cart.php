<?php
session_start();

include('../includes/db.php');
include('../includes/functions.php');

$get_ip = getClientIP();
$total = 0;

$query = $conn->prepare("SELECT c.cart_id, c.pro_id, c.quantity, p.pro_name, p.pro_price, p.pro_image 
                         FROM cart c 
                         JOIN products p ON c.pro_id = p.pro_id 
                         WHERE c.ip_address = ?");
$query->bind_param("s", $get_ip);
$query->execute();
$result = $query->get_result();

// Handle update and delete operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];
        $update_query = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
        $update_query->bind_param("ii", $quantity, $cart_id);
        $update_query->execute();
        header("Location: cart.php");
    } elseif (isset($_POST['delete_cart'])) {
        $cart_id = $_POST['cart_id'];
        $delete_query = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
        $delete_query->bind_param("i", $cart_id);
        $delete_query->execute();
        header("Location: cart.php");
    }
}
?>

<html>

<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->

</head>

<body>
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-4">
        <h4 class="text-center">My Cart</h4>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total += $row['pro_price'] * $row['quantity'];
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card shadow-sm'>
                                <img src='" . $row['pro_image'] . "' class='card-img-top' alt='" . htmlspecialchars($row['pro_name']) . "'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row['pro_name'] . "</h5>
                                    <p class='card-text'>Price: Rs. " . $row['pro_price'] . "/-</p>
                                    <form method='POST'>
                                        <input type='hidden' name='cart_id' value='" . $row['cart_id'] . "'>
                                        <div class='mb-2'>
                                            <label for='quantity' class='form-label'>Quantity:</label>
                                            <input type='number' name='quantity' value='" . $row['quantity'] . "' min='1' class='form-control'>
                                        </div>
                                        <button type='submit' name='update_cart' class='btn btn-primary btn-sm'>Update</button>
                                        <button type='submit' name='delete_cart' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                </div>
                            </div>
                          </div>";
                }
                echo "<h5 class='text-end'>Total: Rs. $total /-</h5>";
                echo "<div class='text-end mt-3'>
                        <a href='product.php' class='btn btn-secondary'>Continue Shopping</a>
                        <a href='checkout.php' class='btn btn-success'>Checkout</a>";
            } else {
                echo "<h4 class='text-center text-danger'>Your cart is empty.</h4>";
            }
            ?>
        </div>
    </div>

    <footer class="footer mt-4">
        <p>&copy; 2025 Souffle Bakery. All rights reserved. <a href="contact.php">Contact Us</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>