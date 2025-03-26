<?php
session_start();

include('../includes/db.php');
include('../includes/functions.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: user.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$invoice_no = "INV" . strtoupper(uniqid());
$amount = $_GET['amount'] ?? 0;
$payment_mode = $_GET['payment_mode'] ?? 'N/A';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_payment = $conn->prepare("
        INSERT INTO payments (user_id, invoice_no, amount, payment_mode, payment_date) 
        VALUES (?, ?, ?, ?, NOW())
    ");
    $insert_payment->bind_param("isds", $user_id, $invoice_no, $amount, $payment_mode);
    $insert_payment->execute();

    header('Location: profile.php?my_orders');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment - Souffle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-4">
        <h4 class="text-center text-primary mb-4">Confirm Payment</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Invoice No:</strong> <?php echo $invoice_no; ?></p>
                <p><strong>Amount:</strong> Rs. <?php echo $amount; ?>/-</p>
                <p><strong>Payment Mode:</strong> <?php echo ucfirst($payment_mode); ?></p>
                <form method="POST">
                    <button type="submit" class="btn btn-success w-100">Confirm Payment</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>