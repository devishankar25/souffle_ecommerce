<?php
session_start();
include '../config.php'; // Database connection file
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-3" href="dashboard.php">Admin Panel</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </nav>

    <div class="container mt-4">
        <h2>Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <a href="orders_list.php" class="btn btn-primary w-100">Manage Orders</a>
            </div>
            <div class="col-md-4">
                <a href="view_products.php" class="btn btn-success w-100">Manage Products</a>
            </div>
            <div class="col-md-4">
                <a href="add_products.php" class="btn btn-info w-100">Add New Product</a>
            </div>
        </div>
    </div>
</body>
</html>
