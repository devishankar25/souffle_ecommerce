<?php
// Start session if needed
session_start();

// Simulate an admin login session (Remove if using real authentication)
$_SESSION['admin_username'] = "Admin";

// Page Title
$title = "Admin Home";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: 0.3s;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_home.php"><i class="fa-solid fa-user-shield"></i> Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_products.php"><i class="fa-solid fa-box"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order_list.php"><i class="fa-solid fa-list"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Section -->
<div class="container my-4">
    <h2 class="text-center">Welcome, <?php echo $_SESSION['admin_username']; ?>!</h2>
    
    <div class="row mt-4">
        <!-- Products -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-box fa-3x text-primary"></i>
                    <h5 class="card-title mt-2">Manage Products</h5>
                    <a href="view_products.php" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-receipt fa-3x text-success"></i>
                    <h5 class="card-title mt-2">View Orders</h5>
                    <a href="order_list.php" class="btn btn-success">Orders</a>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-users fa-3x text-warning"></i>
                    <h5 class="card-title mt-2">User Management</h5>
                    <a href="user_list.php" class="btn btn-warning">View Users</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
