<?php
// Include database connection
include '../includes/db.php';

// Check if product_id is set in URL
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Invalid Product ID");
}

// Sanitize the input
$product_id = intval($_GET['product_id']);

// Fetch product details
$result = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");

// Check if product exists
if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Product</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" name="category" value="<?php echo $product['category']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" required><?php echo $product['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="view_products.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
