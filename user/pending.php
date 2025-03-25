<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('../includes/db.php');
include_once('../includes/functions.php'); // Ensure functions.php is included only once

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    die("Error: No username found in session. Please log in.");
}

$username = $_SESSION['username'];

// Debugging: Uncomment the line below to check the username value
// echo "Debug: Username from session is $username";

$get_user = "SELECT * FROM `user` WHERE username = '$username'";
$result = $conn->query($get_user); // Use $conn consistently

if ($result && $result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
} else {
    die("Error: User not found in the database. Please check the username in the session.");
}

$order_details = get_user_order_details($conn); // Use $conn consistently
