<?php
// Start session
session_start();

// Include database connection
include '../includes/db.php';

// Check if order ID is provided
if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = $_GET['order_id'];

// Fetch order details
$order_query = "SELECT * FROM user_order WHERE order_id = '$order_id'";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    die("Order not found.");
}

// Fetch user details
$user_query = "SELECT * FROM user WHERE user_id = '{$order['user_id']}'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Fetch ordered products
$product_query = "SELECT * FROM products WHERE product_id IN (SELECT product_id FROM pending_orders WHERE order_id = '$order_id')";
$product_result = mysqli_query($conn, $product_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h3>Invoice</h3>
            </div>
            <div class="card-body">
                <h5>Order ID: <?php echo $order['order_id']; ?></h5>
                <p><strong>Customer:</strong> <?php echo $user['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = mysqli_fetch_assoc($product_result)) { ?>
                            <tr>
                                <td><?php echo $product['product_name']; ?></td>
                                <td>$<?php echo $product['price']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button onclick="window.print()" class="btn btn-success"><i class="fas fa-print"></i> Print Invoice</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
