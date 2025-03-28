<?php
session_start();
include './config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Assuming user is logged in
    $total_price = $_POST['total_price'];
    $status = "Pending"; 
    $order_date = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status, order_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $user_id, $total_price, $status, $order_date);

    if ($stmt->execute()) {
        header("Location: user_orders.php?message=Order placed successfully");
        exit();
    } else {
        echo "Error placing order.";
    }
}
?>
