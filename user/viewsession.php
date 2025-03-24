<?php
include('../includes/functions.php'); // Include the functions file
include('../includes/db.php'); // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Add your CSS file -->
</head>
<body>

<section id="header" class="text-center">
    <h2 class="text-success text-center m-4">SESSIONS</h2>
</section>

<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php
        $sql = "SELECT * FROM session";

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if there are any sessions
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display session information
                echo "<div class='pro'>";
                echo "<div class='des'>";
                echo "<h3><strong>Session Id: " . htmlspecialchars($row["sess_id"]) . "</strong></h3>";
                echo "<h5>Name: " . htmlspecialchars($row["sess_name"]) . "</h5>";
                echo "<h5>Time: " . htmlspecialchars($row["start_sess"]) . " to " . htmlspecialchars($row["end_sess"]) . "</h5>";
                echo "<h5>Description: " . htmlspecialchars($row["des"]) . "</h5>";
                echo "<a href='" . htmlspecialchars($row['url']) . "' class='btn'>JOIN</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<center><h4 class='m-2 text-danger text-center'>No Sessions found</h4></center>";
        }
        ?>
    </div>
</section>

</body>
</html>
