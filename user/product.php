<?php
session_start();
include('../includes/functions.php');
$username = $_SESSION['username'] ?? null;

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['pro_id'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Souffle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->

</head>

<body>
    <!-- Navbar -->
    <?php include('../includes/navbar.php'); ?>

    <!-- Search Bar -->
    <div class="container search-bar">
        <form method="GET" action="product.php">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search for products..." value="<?php echo $_GET['search'] ?? ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>
    </div>

    <!-- Products Section -->
    <div class="container py-4">
        <h4 class="text-center text-primary mb-4">Our Products</h4>
        <div class="row">
            <?php
            $search = $_GET['search'] ?? '';
            $sql = "SELECT * FROM products WHERE pro_name LIKE ?";
            $stmt = $conn->prepare($sql);
            $search_param = "%$search%";
            $stmt->bind_param("s", $search_param);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 col-sm-6 mb-4'>
                            <div class='card'>
                                <img src='" . $row['Pro_image'] . "' class='card-img-top' alt='" . htmlspecialchars($row['pro_name']) . "'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row['pro_name'] . "</h5>
                                    <p class='card-text'>" . $row['Pro_des'] . "</p>
                                    <p class='card-text'>Price: Rs. " . $row['Pro_price'] . "/-</p>
                                    <form method='post'>
                                        <input type='hidden' name='pro_id' value='" . $row['Pro_id'] . "'>
                                        <button type='submit' name='add_to_cart' class='btn btn-primary mb-2'>Add to Cart</button>
                                    </form>
                                    <a href='product_details.php?prod_id=" . $row['Pro_id'] . "' class='btn btn-secondary'>View More</a>
                                </div>
                            </div>
                          </div>";
                }
            } else {
                echo "<h4 class='text-center text-danger'>No Products Found</h4>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>