<body>
    <div class="centered-container">
        <section id="page-header" class="spaced-element">
            <div class="container text-center">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 50px;"></a>
                <h2>#health_is_here</h2>
                <h5>Maintain your health with Herbalife products</h5>
            </div>
        </section>

        <section id="product1" class="section-p1 spaced-element">

            <h4>Products</h4>

            <h5>Which can change your Life</h5>

            <form class="d-flex">

                <input type="search" class="form-control me-2" placeholder="search" aria-label="search"
                    name="search_data">

                <button type="submit" name="search_data_product">SEARCH</button>
                <style>
                    button {

                        border-radius: 10px;

                    }

                    button:hover {

                        background-color: SEAGREEN;

                        color: azure;

                        border-radius: 5px;

                    }
                </style>
            </form>

            <?php

            $sql = "SELECT * FROM products";

            if (isset($_GET['category'])) {

                $category_id = $_GET['category'];
                $sql = "SELECT * FROM products WHERE category_id=$category_id";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "<div class='pro'>";

                        echo "<img src='" . $row["pro_image"] . "' alt='" . $row["pro_name"] . "'>";

                        echo "<div class='des'>";

                        echo "<h5> Product Id: ", $row["pro_id"] . "</h5>";

                        echo "<h5>" . $row["pro_name"] . ":" . $row["pro_quantity"] . "gm</h5>";

                        echo "<h5>" . $row["pro_des"] . "</h5>";

                        echo "<div class='star'>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "</div>";

                        echo "<h4>Rs." . $row["pro_price"] . "/-</h4>";

                        echo "<form method='post' action='add_to_cart.php'>";

                        echo "<input type='hidden' name='pro_id' value='" . $row["pro_id"] . "'>";
                        echo "<input type='hidden' name='price' value='" . $row["pro_price"] . "'>"; // Add price Input field

                        echo "<a href='product.php?add_to_cart=" . $row["pro_id"] . "' class='btn'>Add to Cart</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600; margin-
    left: 10px;}a.btn:hover{background-color:seagreen; color:azure; font-weight:600;}</style>";

                        echo "<a href='product_details.php?pro_id=" . $row["pro_id"] . "' class='btn'>View More</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600; margin-
    left: 10px;}a.btn:hover{background-color:seagreen; color:azure; font-weight:600;}</style>";

                        echo "</form>";

                        echo "</div>";

                        echo "</div>";
                    }
                } else {

                    echo "<h4 class='m-2 text-danger'>No Products found</h4>";
                }
            }

            if (isset($_GET['brand'])) {

                $brand_id = $_GET['brand'];

                $sql = "SELECT * FROM products WHERE brand_id=$brand_id"; // Corrected SQL query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "<div class='pro'>";
                        echo "<img src='" . $row["pro_image"] . '"alt="' . $row["pro_name"] . '">';

                        echo "<div class='des'>";

                        echo "<h5> Product Id: " . $row["pro_id"] . "</h5>";

                        echo "<h5>" . $row["pro_name"] . ":" . $row["pro_quantity"] . " gm</h5>";

                        echo "<h5>" . $row["pro_des"] . "</h5>";

                        echo "<div class='star'>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "</div>";

                        echo "<h4>Rs." . $row["pro_price"] . "/-</h4>";

                        echo "<form method='post' action='add_to_cart.php'>";

                        echo "<input type='hidden' name='pro_id' value='" . $row["pro_id"] . "'>"; // Add product id

                        echo "<input type='hidden' name='price' value='", $row["pro_price"] . "'>"; // Add price input

                        echo "<a href='product.php?add_to_cart=" . $row["pro_id"] . "' class='btn'>Add to Cart</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600 margin-
    left: 10px;}a.btn:hover{background-color:seagreen;color: azure; font-weight:600;}</style>";

                        echo "<a href='product_details.php?pro_id=" . $row["pro_id"] . "' class='btn'>View More</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600; margin-
    left: 10px; a.btn.hover{background-color:seagreen;color azure;font-weight:600;}</style>";

                        echo "</form>";

                        echo "</div>";
                    }
                } else {



                    echo "<h4 class='m-2 text-danger'>No Products found</h4>";
                }
            }

            if (isset($_GET['search_data_product'])) {

                $search_value = $_GET['search_data'];

                $sql = "SELECT * FROM products WHERE pro_keyword LIKE '%$search_value%'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "<div class='pro'>";

                        echo "<img src='" . $row["pro_image"] . "'alt='" . $row["pro_name"] . "'>";

                        echo "<div class='des'>";

                        echo "<h5> Product Id: " . $row["pro_id"] . "</h5>";
                        echo "<h5>" . $row["pro_name"] . ":" . $row["pro_quantity"] . "gm</h5>";

                        echo "<h5>" . $row["pro_des"] . "</h5>";

                        echo "<div class='star'>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";

                        echo "<i class='fas fa-star'></i>";
                        echo "<i class='fas fa-star'></i>";

                        echo "</div>";

                        echo "<h4>Rs. " . $row["pro_price"] . "/-</h4>";
                        echo "<form method='post' action='add_to_cart.php'>";
                        echo "<input type='hidden' name='pro_id' value='"  . $row["pro_id"] . "'>"; // Add product id
                        echo "<input type='hidden' name='price' value='" . $row["pro_price"] . "'>"; // Add price

                        echo "<a href='product.php?add_to_cart=" . $row["pro_id"] . "' class='btn'>Add to Cart</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600 margin-
    left: 10px;}a.btn:hover{background-color:seagreen;color: azure; font-weight:600;}</style>";

                        echo "<a href='product_details.php?pro_id=" . $row["pro_id"] . "' class='btn'>View More</a>
    <style>a.btn{background-color:darkseagreen; color:black; font-weight:600; margin-
    left: 10px; a.btn.hover{background-color:seagreen;color azure;font-weight:600;}</style>";

                        echo "</form>";

                        echo "</div>";
                    }
                } else {

                    echo "<h4 class='m-2

    text-danger'>No Products found</h4>";
                }
            }

            if (isset($_GET['prod_id'])) {

                // Fetch related products

                $prod_id = $_GET['prod_id'];

                $stmt = "SELECT * FROM products WHERE pro_id=$prod_id";

                $result = $conn->query($stmt);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "<div class='row'>";

                        echo "<div class='col-md-12 mt-3'>";

                        echo "<h4 class='m-2 text-danger'>Related Products</h4>";

                        echo "</div>";

                        echo "<div class='col-md-3'>";

                        echo "<br><br><img src='./product_images/" . $row['pro_image2'] . "
    class='w-

    auto'><style>img{width:50%;height:50%;}</style>";

                        echo "</div>";

                        echo "<div class='col-md-3'>";

                        echo "<br><br><img src='./product_images/" . $row['pro_image3'] . "' class='w-
    auto'><style>img{width:50%;height:50%;}</style>";

                        echo "</div>";
                    }
                } else {

                    echo "<h4 class='m-2 text-danger'>No Related Products found</h4>";
                }
            }

            ?>
            <div class="col-md-3 bg-secondary p-0 position:fixed m-5">

                <ul class="navbar-nav me-auto text-center">

                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h5>Delivery Brands</h5>
                        </a>

                    </li>

                    <?php
                    $select = "SELECT * FROM `brand ";

                    $result_select = $conn->query($select);

                    while ($row = mysqli_fetch_assoc($result_select)) {

                        $brand_title = $row['brand_title'];

                        $brand_id = $row['brand_id'];
                        echo "<li class='nav-item '>

    <a href='product.php?brand=$brand_id' class='nav-link text-

    light'>" . $row['brand_title'] . "</a>

    </li>";
                    }

                    ?>

                </ul>

                <ul class="navbar-nav me-auto text-center">

                    <li class="nav-item bg-info">

                        <a href="#" class="nav-link text-light">
                            <h5>Categories</h5>
                        </a>

                    </li>

                    <?php

                    $select = "SELECT * FROM `category`";
                    $result_select = $conn->query($select);

                    while ($row = mysqli_fetch_assoc($result_select)) {

                        $category_title = $row['category_title'];

                        $category_id = $row['category_id'];

                        echo "<li class='nav-item '>

    <a href='product.php?category=$category_id' class='nav-link text-

    light'>" . $row['category_title'] . "</a>

    </li>";
                    }

                    ?>
                </ul>
            </div>
    </div>
    </section>
    </div>
</body>

</html>