<!-- filepath: c:\xampp\htdocs\souffle_ecommerce\user\cart.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS for better maintainability -->
</head>
<body>
    <section id="page">
        <h2>My Cart</h2>
    </section>

    <section id="product1" class="section-p1">
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered">
                        <?php
                        $get_ip = getClientIP();
                        $total = 0;

                        // Fetch cart items for the current user
                        $stmt = $conn->prepare("SELECT * FROM `cart` WHERE ip_address = ?");
                        $stmt->bind_param("s", $get_ip);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $result_count = $result->num_rows;

                        if ($result_count > 0) {
                            echo "<h4>Products</h4>
                            <h5>Items you selected</h5>
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Product Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>";

                            while ($row = $result->fetch_assoc()) {
                                $pro_id = $row['pro_id'];

                                // Fetch product details
                                $stmt_product = $conn->prepare("SELECT * FROM `products` WHERE pro_id = ?");
                                $stmt_product->bind_param("i", $pro_id);
                                $stmt_product->execute();
                                $product_result = $stmt_product->get_result();

                                while ($product = $product_result->fetch_assoc()) {
                                    $pro_price = $product['pro_price'];
                                    $pro_name = $product['pro_name'];
                                    $pro_image = $product['pro_image'];
                                    $quantity = $row['quantity'];
                                    $total += $pro_price * $quantity;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pro_id); ?></td>
                            <td><img src="./product_images/<?php echo htmlspecialchars($pro_image); ?>" alt="" class="cart_img"></td>
                            <td><?php echo htmlspecialchars($pro_name); ?></td>
                            <td>
                                <input type="number" name="qty[<?php echo $pro_id; ?>]" value="<?php echo htmlspecialchars($quantity); ?>" min="1">
                            </td>
                            <td><?php echo htmlspecialchars($pro_price); ?></td>
                            <td>
                                <input type="checkbox" name="remove_item[]" value="<?php echo $pro_id; ?>">
                            </td>
                        </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<h4 class='text-center text-danger'>No products in Cart</h4>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php if ($result_count > 0): ?>
                    <div class="total d-flex">
                        <h4>Total: <?php echo $total; ?> /-</h4>
                        <input type="submit" value="Update Cart" class="btn" name="update_cart">
                        <input type="submit" value="Continue Shopping" class="btn" name="continue_shopping">
                        <button class="btn"><a href="checkout.php">Checkout</a></button>
                    </div>
                <?php endif; ?>

                <?php
                // Handle cart updates
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['update_cart'])) {
                        if (!empty($_POST['qty'])) {
                            foreach ($_POST['qty'] as $pro_id => $quantity) {
                                $stmt_update = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE ip_address = ? AND pro_id = ?");
                                $stmt_update->bind_param("isi", $quantity, $get_ip, $pro_id);
                                $stmt_update->execute();
                            }
                        }

                        if (!empty($_POST['remove_item'])) {
                            foreach ($_POST['remove_item'] as $pro_id) {
                                $stmt_remove = $conn->prepare("DELETE FROM `cart` WHERE ip_address = ? AND pro_id = ?");
                                $stmt_remove->bind_param("si", $get_ip, $pro_id);
                                $stmt_remove->execute();
                            }
                        }

                        echo "<script>window.location.reload();</script>";
                    }

                    // Handle continue shopping
                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.open('product.php', '_self');</script>";
                    }
                }
                ?>
            </form>
        </div>
    </section>

    <style>
        img.cart_img {
            width: 80px;
            height: 80px;
        }
        .btn {
            margin-left: 10px;
            font-size: 20px;
            background-color: #6aa6a2;
            padding: 5px;
            border-radius: 5px;
            border: none;
            font-weight: 700;
            width: auto;
        }
        .btn:hover {
            background-color: azure;
        }
    </style>
</body>
</html>