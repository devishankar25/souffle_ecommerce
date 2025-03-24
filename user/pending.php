<?php

get_user_order_details();

$username = $_SESSION['username'];

$get_user = "SELECT * FROM `user` WHERE username = '$username'";
$result = $conn->query($get_user);
$row = mysqli_fetch_assoc($result);

$user_id = $row['user_id'];

?>