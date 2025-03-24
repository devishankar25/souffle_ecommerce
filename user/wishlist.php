<?php

$servername = "localhost:3307";
$username = "root";
$password = "";  // Assuming the password was empty, it's a common practice for local development.
$dbname = "souffle_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$username = $_SESSION['username'];
$pro_id = $_GET['prod_id'];

$get_userid = "SELECT * FROM user WHERE username='$username'";  // Corrected SQL syntax

$result = $conn->query($get_userid);

if ($result) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    $select = "SELECT * FROM wishlist WHERE pro_id ='$pro_id' AND user_id ='$user_id'"; // Corrected SQL syntax

    $result_sel = $conn->query($select);

    if ($result_sel->num_rows == 1) {
        echo "<script>alert('Product already added in wishlist')</script>";
        echo "<script>window.open('product.php','_self')</script>";
    } else {
        // Missing curly brace here. Added below
        $insert = "INSERT INTO wishlist (user_id, pro_id) VALUES ('$user_id','$pro_id')"; // Corrected SQL syntax and table name

        $result = $conn->query($insert);

        if ($result == TRUE) {
            echo "<script>alert('Product added in wishlist')</script>";
            echo "<script>window.open('view_wishlist.php','_self')</script>";
        }
    }

}

$conn->close();  //Added to close the connection
?>