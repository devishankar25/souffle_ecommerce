<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "souffle_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if session username is set
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in first.')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
    exit();
}

$username = $_SESSION['username'];

// Validate and sanitize prod_id
if (!isset($_GET['prod_id']) || !is_numeric($_GET['prod_id'])) {
    echo "<script>alert('Invalid product ID.')</script>";
    echo "<script>window.open('product.php', '_self')</script>";
    exit();
}

$pro_id = intval($_GET['prod_id']);

// Get user ID using prepared statement
$stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    // Check if product is already in wishlist
    $stmt = $conn->prepare("SELECT * FROM wishlist WHERE pro_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $pro_id, $user_id);
    $stmt->execute();
    $result_sel = $stmt->get_result();

    if ($result_sel->num_rows > 0) {
        echo "<script>alert('Product already added in wishlist')</script>";
        echo "<script>window.open('product.php', '_self')</script>";
    } else {
        // Insert product into wishlist
        $stmt = $conn->prepare("INSERT INTO wishlist (user_id, pro_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $pro_id);

        if ($stmt->execute()) {
            echo "<script>alert('Product added to wishlist')</script>";
            echo "<script>window.open('view_wishlist.php', '_self')</script>";
        } else {
            echo "<script>alert('Failed to add product to wishlist')</script>";
            echo "<script>window.open('product.php', '_self')</script>";
        }
    }
} else {
    echo "<script>alert('User not found')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
}

$stmt->close();
$conn->close();

?>