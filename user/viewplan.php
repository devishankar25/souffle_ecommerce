<?php

$sql = "SELECT plan.*, products1.pro_name AS pro1_name, products2.pro_name AS
pro2_name, products3.pro_name AS pro3_name, plan_price

FROM plan

LEFT JOIN products AS products1 ON plan.pro1_id = products1.pro_id

LEFT JOIN products AS products2 ON plan.pro2_id = products2.pro_id

LEFT JOIN products AS products3 ON plan.pro3_id = products3.pro_id";
$result = $conn->query($sql);

?>

<html>

<body>

<section id="product1" class="section-p1">

    <div class="pro-container">

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo "<div class='pro'>";

                echo "<div class='des'>";

                echo "<h4>Plan: " . $row["plan_id"] . "</h4>";

                echo "<h4>" . $row["plan_name"] . "</h4>";

                if (isset($row["pro1_name"])) {

                    echo "<h5>Product 1: " . $row["pro1_name"] . "</h5>";
                }

                if (isset($row["pro2_name"])) {

                    echo "<h5>Product 2: " . $row["pro2_name"] . "</h5>";
                }

                if (isset($row["pro3_name"])) {

                    echo "<h5>Product 3: " . $row["pro3_name"] . "</h5>";
                }

                echo "<h4>Price = Rs. " . $row["plan_price"] . "/-</h4>";

                echo "<a href='checkout_plan.php?plan_id=" . $row['plan_id'] . "'>BUY NOW</a>";

                echo "</div>";

                echo "</div>";
            }
        } else {

            echo "<p>No plans found</p>";
        }

        ?>
    </div>
</section>

</body>

</html>