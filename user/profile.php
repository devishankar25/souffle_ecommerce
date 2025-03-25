<?php
session_start();
include('../includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Souffle Bakery</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->

</head>

<body>
    <!-- Header -->
    <?php include('../includes/navbar.php'); ?>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <h4>My Profile</h4>
                    <ul class="list-unstyled">
                        <li><a href="profile.php?pending"><i class="fas fa-clock"></i> Pending Orders</a></li>
                        <li><a href="profile.php?edit_profile"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                        <li><a href="profile.php?my_orders"><i class="fas fa-box"></i> My Orders</a></li>
                        <li><a href="profile.php?delete_account"><i class="fas fa-user-times"></i> Delete Account</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-9">
                <div class="profile-content">
                    <?php
                    if (isset($_GET['pending'])) {
                        include('pending.php');
                    } elseif (isset($_GET['edit_profile'])) {
                        include('edit_profile.php');
                    } elseif (isset($_GET['my_orders'])) {
                        include('my_orders.php');
                    } elseif (isset($_GET['delete_account'])) {
                        include('delete_account.php');
                    } else {
                        echo "<h3>Welcome to your profile!</h3>";
                        echo "<p>Use the menu on the left to navigate through your profile options.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>