<?php
session_start();
include './config.php'; // Database connection
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_proof = $_FILES['payment_proof']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($payment_proof);
    if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $target_file)) {
        $update_sql = "UPDATE orders SET payment_status = 'Confirmed', payment_proof = ? WHERE id = ? AND user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sii", $payment_proof, $order_id, $user_id);
        $update_stmt->execute();
        $_SESSION['message'] = "Payment confirmed successfully!";
        header("Location: my_orders.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to upload payment proof. Please try again.";
    }
}
$sql = "SELECT id, total_price, status FROM orders WHERE user_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Confirm Payment</h2>
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-success"> <?php echo $_SESSION['message']; unset($_SESSION['message']); ?> </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger"> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?> </div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="order_id" class="form-label">Select Order</label>
                <select class="form-select" name="order_id" required>
                    <?php foreach ($orders as $order) { ?>
                        <option value="<?php echo $order['id']; ?>">Order #<?php echo $order['id']; ?> - $<?php echo number_format($order['total_price'], 2); ?> (<?php echo $order['status']; ?>)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="payment_proof" class="form-label">Upload Payment Proof</label>
                <input type="file" class="form-control" name="payment_proof" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirm Payment</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>