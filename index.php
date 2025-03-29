<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soufflé Bakery - Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        .btn-custom {
            width: 250px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Soufflé Bakery</h1>
        <p>Choose an option to proceed:</p>
        
        <a href="admin/admin_login.php" class="btn btn-primary btn-lg btn-custom">
            <i class="fas fa-user-shield"></i> Admin Login
        </a>
        <br>
        <a href="user/login.php" class="btn btn-success btn-lg btn-custom">
            <i class="fas fa-sign-in-alt"></i> User Login
        </a>
        <br>
        <a href="user/signup.php" class="btn btn-warning btn-lg btn-custom">
            <i class="fas fa-user-plus"></i> Register
        </a>
    </div>
</body>
</html>
