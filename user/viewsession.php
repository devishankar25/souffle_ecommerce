<?php
include('../includes/db.php'); // Include database connection
include('../includes/functions.php'); // Ensure functions.php is included only once
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions - Souffle Bakery</title>
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

    <!-- Header Section -->
    <section id="header" class="text-center py-4">
        <div class="container">
            <h2 class="text-success">SESSIONS</h2>
        </div>
    </section>

    <!-- Sessions Section -->
    <section id="product1" class="section-p1 py-4">
        <div class="container">
            <div class="row">
                <?php
                $sql = "SELECT * FROM session";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-4'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'><strong>Session Id: " . $row["sess_id"] . "</strong></h5>";
                        echo "<p class='card-text'>Name: " . $row["sess_name"] . "</p>";
                        echo "<p class='card-text'>Time: " . $row["start_sess"] . " to " . $row["end_sess"] . "</p>";
                        echo "<p class='card-text'>Description: " . $row["sess_des"] . "</p>";
                        echo "<a href='" . $row['url'] . "' class='btn btn-success'>JOIN</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12 text-center'>";
                    echo "<h4 class='text-danger'>No Sessions found</h4>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-light py-3">
        <div class="container text-center">
            <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>