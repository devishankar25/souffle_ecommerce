<?php
// filepath: c:\xampp\htdocs\souffle_ecommerce\includes\functions.php

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the client's IP address
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Count the number of items in the cart
function cart_item() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

// Calculate the total price of items in the cart
function total() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

// Get user order details
function get_user_order_details($conn) {
    if (!isset($_SESSION['username'])) {
        return "No user is logged in.";
    }

    $username = $conn->real_escape_string($_SESSION['username']);
    $query = "SELECT * FROM orders WHERE username = '$username' AND status = 'pending'";
    $result = $conn->query($query);

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
function cart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize an empty cart if it doesn't exist
    }

    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];

        if (!in_array($product_id, array_column($_SESSION['cart'], 'id'))) {
            $_SESSION['cart'][] = ['id' => $product_id, 'quantity' => 1];
            echo "<script>alert('Product added to cart!');</script>";
        } else {
            echo "<script>alert('Product is already in the cart!');</script>";
        }
    }
}

// Add a product to the wishlist
function add_to_wishlist($conn, $username, $product_id) {
    $username = $conn->real_escape_string($username);
    $product_id = $conn->real_escape_string($product_id);

    // Check if the product is already in the wishlist
    $check_query = "SELECT * FROM wishlist WHERE username = '$username' AND product_id = '$product_id'";
    $check_result = $conn->query($check_query);

    if ($check_result && $check_result->num_rows > 0) {
        return false; // Product is already in the wishlist
    }

    // Add the product to the wishlist
    $insert_query = "INSERT INTO wishlist (username, product_id) VALUES ('$username', '$product_id')";
    return $conn->query($insert_query);
}
?>
