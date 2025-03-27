<?php
// Sample optimized and fixed code for "dashboard.php"

session_start();
include('../config/db.php'); // Ensure the correct database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetching required counts
$products_count = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$users_count = $conn->query("SELECT COUNT(*) FROM user")->fetchColumn();
$orders_count = $conn->query("SELECT COUNT(*) FROM user_order")->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
    <?php include('admin_navbar.php'); ?>
    
    <div class="container mt-4">
        <h2 class="text-center">Admin Dashboard</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    <h4><i class="fas fa-box"></i> Products</h4>
                    <p><?php echo $products_count; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h4><i class="fas fa-users"></i> Users</h4>
                    <p><?php echo $users_count; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white p-3">
                    <h4><i class="fas fa-shopping-cart"></i> Orders</h4>
                    <p><?php echo $orders_count; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
