<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include '../config.php'; // Database connection

// Validate order_id
// Debugging: Check if order_id is received correctly
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid request. Order ID missing.");
}

$order_id = $_GET['order_id'];

// Debugging: Print order_id to confirm
echo "Received Order ID: " . htmlspecialchars($order_id) . "<br>";

// Fetch order details
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

// Debugging: Check if query returns data
if (!$order) {
    die("Order not found. Check if order ID exists in the database.");
}


// Handle form submission to update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = $_POST['status'];
    
    $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $order_id);
    
    if ($update_stmt->execute()) {
        header("Location: orders_list.php?success=Order updated successfully");
        exit();
    } else {
        echo "Error updating order.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Order</h2>
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Order ID:</label>
                <input type="text" class="form-control" value="<?php echo $order['id']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">User ID:</label>
                <input type="text" class="form-control" value="<?php echo $order['user_id']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Price:</label>
                <input type="text" class="form-control" value="$<?php echo $order['total_price']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Date:</label>
                <input type="text" class="form-control" value="<?php echo $order['created_at']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="orders_list.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
