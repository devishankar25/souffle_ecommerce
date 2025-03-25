<?php

include('../includes/db.php'); // Include database connection
include('../includes/functions.php'); // Ensure functions.php is included only once

$sql = "SELECT plan.*, products1.pro_name AS pro1_name, products2.pro_name AS pro2_name, products3.pro_name AS pro3_name, plan_price
        FROM plan
        LEFT JOIN products AS products1 ON plan.pro1_id = products1.pro_id
        LEFT JOIN products AS products2 ON plan.pro2_id = products2.pro_id
        LEFT JOIN products AS products3 ON plan.pro3_id = products3.pro_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Plans</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the external CSS file -->

</head>

<body>
    <!-- Navbar -->
    <?php include('../includes/navbar.php'); ?>

    <div class="container my-5">
        <div class="header text-center">
            <h1><i class="fas fa-bread-slice"></i> Souffle Bakery Plans</h1>
            <p>Choose the perfect plan for your bakery needs</p>
        </div>
        <section id="product1" class="section-p1">
            <div class="row justify-content-center">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-6 col-lg-4 mb-4'>";
                        echo "<div class='pro'>";
                        echo "<div class='des'>";
                        echo "<h4><i class='fas fa-layer-group'></i> Plan: " . $row["plan_id"] . "</h4>";
                        echo "<h4>" . $row["plan_name"] . "</h4>";
                        echo "<h5><i class='fas fa-box'></i> Product 1: " . ($row["pro1_name"] ?? "N/A") . "</h5>";
                        echo "<h5><i class='fas fa-box'></i> Product 2: " . ($row["pro2_name"] ?? "N/A") . "</h5>";
                        echo "<h5><i class='fas fa-box'></i> Product 3: " . ($row["pro3_name"] ?? "N/A") . "</h5>";
                        echo "<h4><i class='fas fa-tag'></i> Price = Rs. " . $row["plan_price"] . "/-</h4>";
                        echo "<a href='checkout_plan.php?plan_id=" . $row['plan_id'] . "' class='btn btn-primary'><i class='fas fa-shopping-cart'></i> BUY NOW</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='text-center'>No plans found</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>