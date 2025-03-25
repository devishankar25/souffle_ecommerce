<?php
include('../includes/db.php');
include('../includes/functions.php');

// Ensure session is started only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: user.php");
    exit();
}

$username = $_SESSION['username'];

// Add product to wishlist
if (isset($_GET['prod_id'])) {
    $pro_id = $_GET['prod_id'];
    $user_id = get_user_id($conn, $username);

    if ($user_id && add_to_wishlist($conn, $user_id, $pro_id)) {
        echo "<script>alert('Product added to wishlist');</script>";
    } else {
        echo "<script>alert('Product already in wishlist');</script>";
    }
}

// Delete product from wishlist
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $user_id = get_user_id($conn, $username);

    $delete_query = $conn->prepare("DELETE FROM wishlist WHERE pro_id = ? AND user_id = ?");
    $delete_query->bind_param("ii", $delete_id, $user_id);
    $delete_query->execute();
    header("Location: wishlist.php");
    exit();
}

// Fetch wishlist items
$query = $conn->prepare("SELECT w.pro_id AS product_id, p.pro_name, p.pro_price, p.pro_image 
                         FROM wishlist w 
                         JOIN products p ON w.pro_id = p.pro_id 
                         WHERE w.user_id = (SELECT user_id FROM user WHERE username = ?)");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('../includes/navbar.php'); ?>

    <div class="container py-4">
        <h4 class="text-center text-primary mb-4">My Wishlist</h4>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?= $row['pro_image'] ?>" alt="<?= htmlspecialchars($row['pro_name']) ?>" style="width: 100px;"></td>
                            <td><?= $row['pro_name'] ?></td>
                            <td>Rs. <?= $row['pro_price'] ?>/-</td>
                            <td>
                                <a href="wishlist.php?delete_id=<?= $row['product_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="product_details.php?prod_id=<?= $row['product_id'] ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        <?php else: ?>
            <h4 class="text-center text-danger">Your wishlist is empty.</h4>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>