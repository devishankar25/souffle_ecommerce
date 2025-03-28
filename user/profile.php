<?php
session_start();
include './config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT full_name, email, phone, address, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<div class='alert alert-danger'>User not found.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">My Profile</h2>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body text-center">
                <img src="uploads/<?php echo htmlspecialchars($user['profile_image'] ?: 'default.png'); ?>" class="rounded-circle" width="100" height="100" alt="Profile Picture">
                <h4 class="mt-3"><?php echo htmlspecialchars($user['full_name']); ?></h4>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($user['phone'] ?: 'N/A'); ?></p>
                <p>Address: <?php echo nl2br(htmlspecialchars($user['address'] ?: 'N/A')); ?></p>
                <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                <a href="main_page.php" class="btn btn-secondary">Back to Main Page</a>
                <hr>
                <a href="wishlist.php" class="btn btn-info">My Wishlist</a>
                <a href="viewfeedback.php" class="btn btn-warning">View Feedback</a>
                <a href="add_feedback.php" class="btn btn-success">Add Feedback</a>
                <a href="confirm_payment.php" class="btn btn-dark">Confirm Payment</a>
                <a href="delete_account.php" class="btn btn-danger">Delete Account</a>
                <hr>
                <a href="product.php" class="btn btn-outline-primary">View Products</a>
                <a href="cart.php" class="btn btn-outline-secondary">View Cart</a>
                <a href="checkout.php" class="btn btn-outline-success">Proceed to Checkout</a>
                <a href="my_orders.php" class="btn btn-outline-info">My Orders</a>
                <a href="pending.php" class="btn btn-outline-warning">Pending Orders</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
