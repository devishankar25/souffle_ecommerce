<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pro_name = $_POST['pro_name'];
    $pro_image = $_FILES['pro_image']['name'];
    $pro_image_tmp = $_FILES['pro_image']['tmp_name'];
    $pro_image2 = $_FILES['pro_image2']['name'];
    $pro_image2_tmp = $_FILES['pro_image2']['tmp_name'];
    $pro_image3 = $_FILES['pro_image3']['name'];
    $pro_image3_tmp = $_FILES['pro_image3']['tmp_name'];
    $pro_quantity = $_POST['pro_quantity'];
    $pro_des = $_POST['pro_des'];
    $pro_keyword = $_POST['pro_keyword'];
    $pro_cost_price = $_POST['pro_cost_price'];
    $pro_price = $_POST['pro_price'];
    $pro_category = $_POST['pro_category'];
    $pro_brand = $_POST['pro_brand'];
    $supplier = $_POST['supplier'];

    move_uploaded_file($pro_image_tmp, "product_images/$pro_image");  // Assuming "product_images" is the directory
    move_uploaded_file($pro_image2_tmp, "product_images/$pro_image2"); // Assuming "product_images" is the directory
    move_uploaded_file($pro_image3_tmp, "product_images/$pro_image3"); // Assuming "product_images" is the directory

    $insert_products = "INSERT INTO `products` (pro_name, pro_image, pro_image2, pro_image3, pro_quantity, pro_des, pro_keyword, pro_cost_price, pro_price, pro_category, pro_brand, supplier_id, date) 
                        VALUES ('$pro_name', '$pro_image', '$pro_image2', '$pro_image3', '$pro_quantity', '$pro_des', '$pro_keyword', '$pro_cost_price', '$pro_price', '$pro_category', '$pro_brand', '$supplier', NOW())";  // Added backticks

    $result_query = $conn->query($insert_products);

    if ($result_query) {
        echo "<script>alert('Successfully added products')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    </head>

<body class="bg-light">
    <section id="container">
        <div class="container text-center m-auto">
            <p>Add Products</p>
            <div class="popup text-center m-auto">
                <form action="add_products.php" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_name" class="form-label text-left m-2 mt-2">Product
                            Name</label><br>
                        <input type="text" placeholder="Enter Product Name" name="pro_name"
                            onkeydown="return /[a-zA-Z -]/i.test(event.key)" required autocomplete="off"><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_image" class="form-label m-2 mt-2">Product
                            Image</label><br>
                        <input type="file" name="pro_image" placeholder="Choose File" required><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_image2" class="form-label m-2 mt-2">Product Image
                            2</label><br>
                        <input type="file" name="pro_image2" placeholder="Choose File" required><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_image3" class="form-label m-2 mt-2">Product Image
                            3</label><br>
                        <input type="file" name="pro_image3" placeholder="Choose File" required><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_quantity" class="form-label m-2 mt-2">Quantity</label><br>
                        <input type="text" placeholder="Enter Quantity in gm" name="pro_quantity"
                            onkeydown="return //i.test(event.key)" required autocomplete="off"><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_des" class="form-label m-2 mt-2">Product
                            Description</label><br>
                        <input type="text" placeholder="Enter Description" name="pro_des"
                            onkeydown="return /[a-zA-Z0-9]/i.test(event.key)" required autocomplete="off"><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_keyword" class="form-label m-2 mt-2">Product
                            Keyword</label><br>
                        <input type="text" placeholder="Enter Keywords" name="pro_keyword"
                            onkeydown="return /[a-zA-Z-]/i.test(event.key)" required> <br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_cost_price" class="form-label m-2 mt-2">Cost
                            Price</label><br>
                        <input type="text" placeholder="Enter Cost Price" name="pro_cost_price"
                            onkeydown="return //i.test(event.key)" required autocomplete="off"><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_price" class="form-label m-2 mt-2">Price</label><br>
                        <input type="text" placeholder="Enter Price" name="pro_price"
                            onkeydown="return //i.test(event.key)" required autocomplete="off"><br>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_category" class="form-label text-left m-2 mt-2">Product
                            category</label>
                        <select name="pro_category" id="pro_category" class="form-select m-2 mb-2 my-3 w-50">  // Added id
                            <option value="">Select Category</option>
                            <?php
                            $select = "SELECT * FROM `category`";  // Added backticks
                            $result = $conn->query($select);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_title = $row['category_title'];
                                    $category_id = $row['category_id'];
                                    echo "<option value='$category_id'>$category_title</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="pro_brand" class="form-label text-left m-2 mt-2">Delivery Brands</label>
                        <select name="pro_brand" id="pro_brand" class="form-select m-2 mb-2 my-3 w-50">  // Added id
                            <option value="">Select brand</option>
                            <?php
                            $select = "SELECT * FROM `brand`";  // Added backticks
                            $result = $conn->query($select);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $brand_title = $row['brand_title'];
                                    $brand_id = $row['brand_id'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-outline mb-4 w-80 m-auto">
                        <label for="supplier" class="form-label text-left m-2 mt-2">Supplier</label>
                        <select name="supplier" id="supplier" class="form-select m-2 mb-2 my-3 w-50">
                            <option value="">Select Supplier</option>
                            <?php
                            $select = "SELECT * FROM `supplier`";  // Added backticks
                            $result = $conn->query($select);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $supplier_name = $row['supplier_name'];
                                    $supplier_id = $row['supplier_id'];
                                    echo "<option value='$supplier_id'>$supplier_name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="add_product" class="mb-2">Add Product</button>
                    <a href="admin_home.php?view_products" class="mb-2">
                        View Products</a>
                </form>
            </div>
        </div>
    </section>
</body>

</html>