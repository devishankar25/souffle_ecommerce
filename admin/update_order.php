<?php
// Start session
session_start();
include '../includes/db.php'; // Database connection

// Validate order_id is passed and is a number
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Order ID is required.");
}

$order_id = intval($_GET['order_id']); // Convert to integer for safety

// Fetch order details
$order_query = "SELECT * FROM user_order WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_query);

// Check if order exists
if (!$order_result || mysqli_num_rows($order_result) == 0) {
    die("Order not found.");
}

$order = mysqli_fetch_assoc($order_result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = mysqli_real_escape_string($conn, $_POST['order_status']);
    $update_query = "UPDATE user_order SET Order_status = '$new_status' WHERE order_id = $order_id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Order updated successfully!'); window.location.href='order_list.php';</script>";
        exit;
    } else {
        die("Error updating order: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Order Status</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Order ID:</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($order['order_id']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">User ID:</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($order['user_id']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Due Amount:</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($order['Due_amount']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Invoice No:</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($order['Invoice_no']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Products:</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($order['Total_products']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Status:</label>
                <select class="form-control" name="order_status">
                    <option value="Pending" <?php if ($order['Order_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Processing" <?php if ($order['Order_status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                    <option value="Shipped" <?php if ($order['Order_status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option value="Delivered" <?php if ($order['Order_status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="order_list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
