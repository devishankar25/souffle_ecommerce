<?php
session_start();
include('../includes/functions.php');

$get_ip = getClientIP();
$total = 0;

// Fetch cart items
$query = $conn->prepare("
    SELECT c.pro_id, c.quantity, p.pro_name, p.pro_price, p.pro_image 
    FROM cart c 
    JOIN products p ON c.pro_id = p.pro_id 
    WHERE c.ip_address = ?
");
$query->bind_param("s", $get_ip);
$query->execute();
$result = $query->get_result();

// Handle order confirmation
if (isset($_POST['confirm_order'])) {
    $user_id = $_SESSION['user_id'] ?? null; // Ensure user is logged in
    if (!$user_id) {
        echo "<script>alert('Please log in to confirm your order.');</script>";
        echo "<script>window.location.href='user.php';</script>";
        exit();
    }

    $payment_method = $_POST['payment_method'] ?? null;
    if (!$payment_method) {
        echo "<script>alert('Please select a payment method.');</script>";
        echo "<script>window.location.href='checkout.php';</script>";
        exit();
    }

    // Insert order details into the orders table
    while ($row = $result->fetch_assoc()) {
        $pro_id = $row['pro_id'];
        $quantity = $row['quantity'];
        $subtotal = $row['pro_price'] * $quantity;

        $insert_order = $conn->prepare("
            INSERT INTO orders (user_id, pro_id, quantity, total_price, payment_method, order_date) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $insert_order->bind_param("iiids", $user_id, $pro_id, $quantity, $subtotal, $payment_method);
        $insert_order->execute();
    }

    // Clear the cart
    $clear_cart = $conn->prepare("DELETE FROM cart WHERE ip_address = ?");
    $clear_cart->bind_param("s", $get_ip);
    $clear_cart->execute();

    echo "<script>alert('Order confirmed!');</script>";
    echo "<script>window.location.href='profile.php?my_orders';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Souffle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->

</head>

<body>
    <!-- Navbar -->
    <?php include('../includes/navbar.php'); ?>

    <!-- Checkout Section -->
    <div class="container py-4">
        <h4 class="text-center text-primary mb-4">Checkout</h4>
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result->data_seek(0); // Reset result pointer
                        while ($row = $result->fetch_assoc()):
                            $subtotal = $row['pro_price'] * $row['quantity'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo $row['pro_name']; ?></td>
                                <td><img src="<?php echo $row['pro_image']; ?>" alt="<?php echo $row['pro_name']; ?>" style="max-height: 50px;"></td>
                                <td>Rs. <?php echo $row['pro_price']; ?>/-</td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>Rs. <?php echo $subtotal; ?>/-</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <h5 class="text-end">Total: Rs. <?php echo $total; ?>/-</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="payment_method" class="form-label">Select Payment Method:</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="" disabled selected>Choose...</option>
                            <option value="online">Pay Online</option>
                            <option value="offline">Pay Offline</option>
                        </select>
                    </div>
                    <button type="submit" name="confirm_order" class="btn btn-success w-100 mt-3">Confirm Order</button>
                </form>
            <?php else: ?>
                <h4 class="text-center text-danger">Your cart is empty.</h4>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>