<?php
include('db.php'); // Include database connection

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the client's IP address
function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Count the number of items in the cart
function cart_item($conn)
{
    $user_id = $_SESSION['user_id'] ?? 0; // Ensure user ID is set
    $query = "SELECT COUNT(*) AS item_count FROM cart WHERE user_id = $user_id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['item_count'] ?? 0;
}

// Calculate the total price of items in the cart
function total($conn)
{
    $user_id = $_SESSION['user_id'] ?? 0; // Ensure user ID is set
    $query = "SELECT SUM(price * quantity) AS total_price FROM cart WHERE user_id = $user_id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total_price'] ?? 0;
}

// Get user order details
function get_user_order_details($conn)
{
    if (!isset($_SESSION['username'])) {
        return "No user is logged in.";
    }

    $username = $_SESSION['username'];
    $query = $conn->prepare("SELECT * FROM orders WHERE username = ? AND status = 'pending'");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    $orders = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = [
                'order_id' => htmlspecialchars($row['order_id']),
                'product_name' => htmlspecialchars($row['product_name']),
                'status' => htmlspecialchars($row['status']),
            ];
        }
    }
    return $orders ?: "No pending orders.";
}

// Manage cart functionality
function cart($conn)
{ // Ensure $conn is passed
    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        $ip_address = getClientIP();

        $query = $conn->prepare("SELECT * FROM cart WHERE pro_id = ? AND ip_address = ?");
        $query->bind_param("is", $product_id, $ip_address);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 0) {
            $insert_query = $conn->prepare("INSERT INTO cart (pro_id, ip_address, quantity) VALUES (?, ?, 1)");
            $insert_query->bind_param("is", $product_id, $ip_address);
            $insert_query->execute();
            echo "<script>alert('Product added to cart!');</script>";
        } else {
            echo "<script>alert('Product is already in the cart!');</script>";
        }
    }
}

function add_to_wishlist($conn, $username, $product_id)
{
    $query = $conn->prepare("SELECT * FROM wishlist WHERE username = ? AND product_id = ?");
    $query->bind_param("si", $username, $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        return false; // Product already in wishlist
    }

    $insert_query = $conn->prepare("INSERT INTO wishlist (username, product_id) VALUES (?, ?)");
    $insert_query->bind_param("si", $username, $product_id);
    return $insert_query->execute();
}
