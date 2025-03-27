<?php
// Start session
session_start();

// Include database connection
include '../includes/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['pro_name'];
    $price = $_POST['Pro_price'];
    $stock = $_POST['stock'];
    
    $insert_query = "INSERT INTO products (pro_name, Pro_price, stock) VALUES ('$name', '$price', '$stock')";
    
    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Product added successfully!'); window.location.href='view_products.php';</script>";
    } else {
        echo "<script>alert('Error adding product!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Add Product</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" name="pro_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" name="Pro_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <a href="view_products.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
