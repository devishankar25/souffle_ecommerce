<?php
session_start();
include 'config.php'; // Database connection
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-card { border: 1px solid #ddd; border-radius: 10px; padding: 15px; text-align: center; }
        .product-card img { width: 100%; height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="main_page.php">Soufflé Bakery</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-address-book"></i> Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="checkout.php"><i class="fas fa-credit-card"></i> Checkout</a></li>   
                <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="text-center">Our Products</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                        <p><?php echo substr(htmlspecialchars($row['description']), 0, 50) . '...'; ?></p>
                        <h5>$<?php echo number_format($row['price'], 2); ?></h5>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Read More</a>
                        <form action="cart.php" method="POST" class="mt-2">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
