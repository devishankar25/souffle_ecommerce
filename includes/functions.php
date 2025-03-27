    <!-- USER FUNCTIONS -->
<?php
include_once('db.php'); // Avoid multiple inclusions

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
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'UNKNOWN'; // Fallback if no IP is found
}

// Count the number of items in the cart
function cart_item($conn)
{
    $ip_address = getClientIP();
    $query = $conn->prepare("SELECT COUNT(*) AS item_count FROM cart WHERE ip_address = ?");
    $query->bind_param("s", $ip_address);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    return $result['item_count'] ?? 0;
}

// Calculate the total price of items in the cart
function total($conn)
{
    $ip_address = getClientIP();
    $query = $conn->prepare("SELECT SUM(p.pro_price * c.quantity) AS total_price 
                             FROM cart c 
                             JOIN products p ON c.pro_id = p.pro_id 
                             WHERE c.ip_address = ?");
    $query->bind_param("s", $ip_address);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    return $result['total_price'] ?? 0;
}

// Get user order details
function get_user_order_details($conn)
{
    if (!isset($_SESSION['username'])) {
        return "No user is logged in.";
    }

    $username = $_SESSION['username'];

    // Adjusted query to use the correct table and column names
    $query = $conn->prepare("
        SELECT po.order_id, po.Pro_id, po.quantity, po.Order_status, p.Pro_name 
        FROM pending_orders po
        JOIN products p ON po.Pro_id = p.Pro_id
        WHERE po.user_id = (SELECT user_id FROM user WHERE username = ?) 
          AND po.Order_status = 'pending'
    ");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    $orders = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = [
                'order_id' => htmlspecialchars($row['order_id']),
                'product_name' => htmlspecialchars($row['Pro_name']),
                'quantity' => htmlspecialchars($row['quantity']),
                'status' => htmlspecialchars($row['Order_status']),
            ];
        }
    }
    return $orders ?: "No pending orders.";
}

// Manage cart functionality
function cart($conn)
{
    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        $ip_address = getClientIP();

        $query = $conn->prepare("INSERT INTO cart (pro_id, ip_address, quantity) 
                                 SELECT ?, ?, 1 
                                 WHERE NOT EXISTS (SELECT 1 FROM cart WHERE pro_id = ? AND ip_address = ?)");
        $query->bind_param("isis", $product_id, $ip_address, $product_id, $ip_address);
        $query->execute();
        echo "<script>alert('Product added to cart!');</script>";
    }
}

function add_to_wishlist($conn, $user_id, $product_id)
{
    // Check if the product is already in the wishlist
    $query = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND pro_id = ?"); // Fixed column name
    $query->bind_param("ii", $user_id, $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        return false; // Product already in wishlist
    }

    // Insert product into wishlist
    $insert_query = $conn->prepare("INSERT INTO wishlist (user_id, pro_id) VALUES (?, ?)"); // Fixed column name
    $insert_query->bind_param("ii", $user_id, $product_id);
    return $insert_query->execute();
}

function get_user_id($conn, $username)
{
    $query = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['user_id'];
    }
    return null; // Return null if user not found
}
// USER FUNCTIONS

