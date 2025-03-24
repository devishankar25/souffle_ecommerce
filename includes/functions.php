<?php
// filepath: c:\xampp\htdocs\souffle_ecommerce\includes\functions.php

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function cart_item() {
    // Count the number of items in the cart
    echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

function total() {
    // Calculate the total price of items in the cart
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    echo $total;
}

function get_user_order_details() {
    global $conn;

    if (!isset($_SESSION['username'])) {
        echo "No user is logged in.";
        return;
    }

    $username = $conn->real_escape_string($_SESSION['username']);
    $query = "SELECT * FROM orders WHERE username = '$username' AND status = 'pending'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Order ID: " . htmlspecialchars($row['order_id']) . "<br>";
            echo "Product: " . htmlspecialchars($row['product_name']) . "<br>";
            echo "Status: " . htmlspecialchars($row['status']) . "<br><br>";
        }
    } else {
        echo "No pending orders.";
    }
}

function cart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize an empty cart if it doesn't exist
    }

    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];

        if (!in_array($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $product_id;
            echo "<script>alert('Product added to cart!');</script>";
        } else {
            echo "<script>alert('Product is already in the cart!');</script>";
        }
    }
}

function add_to_wishlist($username, $product_id) {
    global $conn;

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
    return $conn->query($insert_query) ? true : false;
}
?>
