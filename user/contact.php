<?php
include('../includes/db.php');
include('../includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Souffle Bakery</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('../includes/navbar.php'); ?>

    <!-- Contact Section -->
    <div class="container my-5">
        <footer class="row g-4">
            <div class="col-md-3 text-center">
                <a href="../index.php">
                    <img src="../images/logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 50px;">
                </a>
                <h4><strong>Contact</strong></h4>
                <p>Address: Shop No. 4, Modi Bhavan, Gamdevi, Grant Road (W)</p>
                <p>Phone: 7410702111</p>
                <p>Open: 10am - 12pm</p>
                <div class="follow mt-3">
                    <h5><strong>Follow Us</strong></h5>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-dark"><i class "fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <h4><strong>About</strong></h4>
                <ul class="list-unstyled mt-3">
                    <li><a href="#" class="text-dark">About Us</a></li>
                    <li><a href="#" class="text-dark">Delivery Information</a></li>
                    <li><a href="#" class="text-dark">Terms & Conditions</a></li>
                    <li><a href="#" class="text-dark">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3 text-center">
                <h4><strong>My Account</strong></h4>
                <ul class="list-unstyled mt-3">
                    <li><a href="#" class="text-dark">Sign In</a></li>
                    <li><a href="cart.php" class="text-dark">View Cart</a></li>
                </ul>
            </div>
            <div class="col-md-3 text-center">
                <h4><strong>Install App</strong></h4>
                <p class="mt-3">From App Store or Google Play</p>
                <div class="d-flex justify-content-center gap-3">
                    <img src="../images/app.png" alt="App Store" class="img-fluid" style="max-height: 40px;">
                    <img src="../images/play.png" alt="Google Play" class="img-fluid" style="max-height: 40px;">
                </div>
                <h6 class="mt-4"><strong>Payment</strong></h6>
                <div class="d-flex justify-content-center gap-3 mt-2">
                    <img src="../images/card1.png" alt="Card 1" class="img-fluid" style="max-height: 30px;">
                    <img src="../images/card2.png" alt="Card 2" class="img-fluid" style="max-height: 30px;">
                    <img src="../images/scan.png" alt="Scan" class="img-fluid" style="max-height: 30px;">
                </div>
            </div>
        </footer>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>