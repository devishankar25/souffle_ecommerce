<?php
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $sql = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_id);
    if ($stmt->execute()) {
        header('Location: cart.php'); // Redirect to cart page after removal
    } else {
        // Handle error
        echo "Error removing item from cart.";
    }
}
?>
