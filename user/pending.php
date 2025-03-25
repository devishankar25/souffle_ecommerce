<?php
session_start();
include('../includes/db.php');
include('../includes/functions.php'); // Ensure functions.php is included

$order_details = get_user_order_details($con);

$username = $_SESSION['username'];

$get_user = "SELECT * FROM `user` WHERE username = '$username'";
$result = $con->query($get_user); // Use $con consistently
$row = mysqli_fetch_assoc($result);

$user_id = $row['user_id'];
