<?php
include('../includes/functions.php'); // Include the functions file
session_start(); // Start the session

get_user_order_details();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($get_user);

    if ($result && $result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        // Fetch pending orders for the user
        $get_orders = "SELECT * FROM orders WHERE user_id = '$user_id' AND status = 'pending'";
        $orders_result = $conn->query($get_orders);

        if ($orders_result && $orders_result->num_rows > 0) {
            echo "<h3>Pending Orders:</h3>";
            while ($order = mysqli_fetch_assoc($orders_result)) {
                echo "<p>Order ID: " . $order['order_id'] . " - Total: $" . $order['total'] . "</p>";
            }
        } else {
            echo "<p>No pending orders found.</p>";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No user is logged in.";
}
?>