<?php
include('../includes/db.php'); // Include database connection
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products']; //this will display id in the url
    $get_data = "SELECT * FROM `products` WHERE pro_id = $edit_id";
    $result_edit = $conn->query($get_data);

    $row = mysqli_fetch_assoc($result_edit);
    $pro_id = $row['pro_id'];
    $pro_name = $row['pro_name'];
    $pro_des = $row['pro_des'];
    $pro_keyword = $row['pro_keyword'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $supplier_id = $row['supplier_id'];
    $pro_image = $row['pro_image'];
    $pro_image2 = $row['pro_image2'];
    $pro_image3 = $row['pro_image3'];
    $pro_price = $row['pro_price'];
    $pro_cost = $row['pro_cost_price'];

    $select_category = "SELECT * FROM `category` WHERE `category_id` = '$category_id'";
    $result_category = $conn->query($select_category);
    $row_cat = mysqli_fetch_assoc($result_category);
    $category_title = $row_cat['category_title'];

    $select_brand = "SELECT * FROM `brand` WHERE `brand_id` = '$brand_id'";
    $result_brand = $conn->query($select_brand);
    $row_cat = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_cat['brand_title'];

    $select_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplier_id'";
    $result_supplier = $conn->query($select_supplier);
    $row_supplier = mysqli_fetch_assoc($result_supplier);
    $supplier_name = $row_supplier['supplier_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Spartan', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center"><strong>Edit Product</strong></h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <label for="pro_id" class="form-label mt-3">Product ID</label>: <?php echo $pro_id; ?>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_name" class="form-label mt-3">Product Name</label>
                <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php echo $pro_name; ?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_des" class="form-label mt-3">Product Description</label>
                <input type="text" class="form-control" id="pro_des" name="pro_des" value="<?php echo $pro_des ?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_keyword" class="form-label mt-3">Product Keywords</label>
                <input type="text" class="form-control" id="pro_keyword" name="pro_keyword" value="<?php echo $pro_keyword; ?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_category" class="form-label mt-3">Product Category</label>
                <select name="pro_category" class="form-select" value="<?php echo $category_id ?>">
                    <option value="<?php echo $category_title ?>"><?php echo $category_title; ?></option>
                    <?php
                    $select_category_all = "SELECT * FROM `category`";
                    $result_category_all = $conn->query($select_category_all);
                    while ($row_cat_all = mysqli_fetch_assoc($result_category_all)) {
                        $category_title = $row_cat_all['category_title'];
                        $category_id = $row_cat_all['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_brands" class="form-label mt-3">Product Brand</label>
                <select name="pro_brands" class="form-select" value="<?php echo $brand_id ?>">
                    <option value="<?php echo $brand_title; ?>"><?php echo $brand_title; ?></option>
                    <?php
                    $select_brand_all = "SELECT * FROM `brand`";
                    $result_brand_all = $conn->query($select_brand_all);
                    while ($row_brand_all = mysqli_fetch_assoc($result_brand_all)) {
                        $brand_title = $row_brand_all['brand_title'];
                        $brand_id = $row_brand_all['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_supplier" class="form-label mt-3">Supplier</label>
                <select name="pro_supplier" id="pro_supplier" class="form-select" value="<?php echo $supplier_id; ?>">
                    <option value="<?php echo $supplier_name; ?>"><?php echo $supplier_name; ?></option>
                    <?php
                    $select_supplier = "SELECT * FROM `supplier`";
                    $result_supplier = $conn->query($select_supplier);
                    while ($row_supplier = mysqli_fetch_assoc($result_supplier)) {
                        $supplier_name = $row_supplier['supplier_name'];
                        $supplier_id = $row_supplier['supplier_id'];
                        echo "<option value='$supplier_id'>$supplier_id: $supplier_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_image" class="form-label mt-3">Product Image</label>
                <div class="d-flex">
                    <input type="file" class="form-control w-90 mb-auto" id="pro_image" name="pro_image" value="<?php echo $pro_image ?>" required>
                    <img src="./product_images/<?php echo $pro_image ?>" alt="" class="edit_image">
                </div>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_image2" class="form-label mt-3">Product Image 2</label>
                <input type="file" class="form-control" id="pro_image2" name="pro_image2" value="<?php echo $pro_image2 ?>">
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_image3" class="form-label mt-3">Product Image 3</label>
                <input type="file" class="form-control" id="pro_image3" name="pro_image3" value="<?php echo $pro_image3 ?>">
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_price" class="form-label mt-3">Product Price</label>
                <input type="number" class="form-control" id="pro_price" name="pro_price" value="<?php echo $pro_price ?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="pro_cost" class="form-label mt-3">Product Cost</label>
                <input type="number" class="form-control" id="pro_cost" name="pro_cost" value="<?php echo $pro_cost ?>" required>
            </div>
            <div class="text-center">
                <input type="submit" name="edit_product" value="Update Product" class="btn btn-info mb-3 px-3 mt-3">
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['edit_product'])) {
        $pro_name = $_POST['pro_name'];
        $pro_des = $_POST['pro_des'];
        $pro_keyword = $_POST['pro_keyword'];
        $pro_category = $_POST['pro_category'];
        $pro_brands = $_POST['pro_brands'];
        $pro_cost = $_POST['pro_cost'];
        $pro_price = $_POST['pro_price'];
        $pro_supplier = $_POST['pro_supplier'];
        $margin = $pro_price - $pro_cost;
        $pro_image = $_FILES['pro_image']['name'];
        $pro_image2 = $_FILES['pro_image2']['name'];
        $pro_image3 = $_FILES['pro_image3']['name'];
        $temp_image = $_FILES['pro_image']['tmp_name'];
        $temp_image2 = $_FILES['pro_image2']['tmp_name'];
        $temp_image3 = $_FILES['pro_image3']['tmp_name'];

        move_uploaded_file($temp_image, "./product_images/$pro_image");
        move_uploaded_file($temp_image2, "./product_images/$pro_image2");
        move_uploaded_file($temp_image3, "./product_images/$pro_image3");

        $update_query = "UPDATE `products` SET 
                         pro_name = '$pro_name',
                         pro_des = '$pro_des',
                         pro_keyword = '$pro_keyword',
                         category_id = '$pro_category',
                         brand_id = '$pro_brands',
                         supplier_id = '$pro_supplier',
                         pro_image = '$pro_image',
                         pro_image2 = '$pro_image2',
                         pro_image3 = '$pro_image3',
                         pro_cost_price = '$pro_cost',
                         pro_price = '$pro_price',
                         margin = '$margin'
                         WHERE pro_id = $pro_id"; // pro_id will get updated

        $result_update = $conn->query($update_query);

        if ($result_update) {
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('admin_home.php?view_products', '_self')</script>";
        } else {
            echo "<script>alert('Error updating product')</script>";
        }
    }
    ?>
</body>

</html>