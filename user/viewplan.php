<?php

$sql = "SELECT plan.*, 
    products1.pro_name AS pro1_name, 
    products2.pro_name AS pro2_name, 
    products3.pro_name AS pro3_name, 
    plan.plan_price
FROM plan
LEFT JOIN products AS products1 ON plan.pro1_id = products1.pro_id
LEFT JOIN products AS products2 ON plan.pro2_id = products2.pro_id
LEFT JOIN products AS products3 ON plan.pro3_id = products3.pro_id";
$result = $conn->query($sql);

?>

<html>

<head>
    <style>
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .spaced-element {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="centered-container">
        <section id="header" class="bg-light p-3 spaced-element">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
            </div>
        </section>

        <section id="product1" class="section-p1 mt-4 spaced-element">
            <div class="container">
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-md-4 col-sm-6 mb-4'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h4>Plan: " . $row["plan_id"] . "</h4>
                                            <h4>" . $row["plan_name"] . "</h4>";
                            if (isset($row["pro1_name"])) {
                                echo "<h5>Product 1: " . $row["pro1_name"] . "</h5>";
                            }
                            if (isset($row["pro2_name"])) {
                                echo "<h5>Product 2: " . $row["pro2_name"] . "</h5>";
                            }
                            if (isset($row["pro3_name"])) {
                                echo "<h5>Product 3: " . $row["pro3_name"] . "</h5>";
                            }
                            echo "<h4>Price = Rs. " . $row["plan_price"] . "/-</h4>
                                            <a href='checkout_plan.php?plan_id=" . $row['plan_id'] . "' class='btn btn-success'>BUY NOW</a>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<p class='text-center text-danger'>No plans found</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</body>

</html>