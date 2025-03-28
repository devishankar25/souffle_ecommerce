<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

include './config.php'; // Database connection

// Validate Product ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_products.php?error=Invalid product ID");
    exit();
}

$product_id = intval($_GET['id']);

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize Inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $price = floatval($_POST['price']);
    $category = htmlspecialchars(trim($_POST['category']));
    $description = htmlspecialchars(trim($_POST['description']));
    
    // Handle Image Upload
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target = "uploads/" . $image;

        // Validate image type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            $message = "Invalid image format. Use JPG, PNG, or GIF.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $new_image = $image;
            } else {
                $message = "Image upload failed.";
            }
        }
    } else {
        $new_image = $product['image']; // Keep old image if no new one
    }

    if (!isset($message)) {
        // Update product in database
        $sql = "UPDATE products SET name=?, price=?, category=?, description=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsssi", $name, $price, $category, $description, $new_image, $product_id);
        
        if ($stmt->execute()) {
            header("Location: view_products.php?message=Product updated successfully");
            exit();
        } else {
            $message = "Error updating product.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Product</h2>
        <?php if (isset($message)) echo "<div class='alert alert-danger'>$message</div>"; ?>
        <form method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
            
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" step="0.01" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
                <p class="mt-2">Current Image: <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" width="100"></p>
            </div>
            
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Product</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
