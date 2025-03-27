<?php
// Include database connection
include '../includes/db.php';

// Check if product_id is set in URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Invalid Product ID");
}

// Sanitize input
$product_id = intval($_GET['product_id']);

// Check if product exists
$result = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");

if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

// Delete the product
mysqli_query($conn, "DELETE FROM products WHERE product_id = $product_id");

echo "Product deleted successfully!";
?>
