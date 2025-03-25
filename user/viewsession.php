<?php
include('../includes/db.php'); // Include database connection
include('./functions.php/functions.php');
?>

<body>

    <section id="header text-center">
        <div class="container">
            <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
            <h2 class="text-success text-center m-4">SESSIONS</h2>
        </div>
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

                    echo "<h3><strong> Session Id: " . $row["sess_id"] . "</strong></h5>";  // Corrected array key

                    echo "<h5>Name: " . $row["sess_name"] . "</h5>";  // Corrected array key

                    echo "<h5>Time: " . $row["start_sess"] . " to " . $row["end_sess"] . "</h5>";

                    echo "<h5>Description: " . $row["sess_des"] . "</h5>"; // Corrected array key

                    echo "<a href='" . $row['url'] . "' class='btn'>JOIN</a>";

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