<?php
$username = $_SESSION['username'];
$get_products = "SELECT * FROM `products`"; // Added backticks [cite: 60, 61]
$result = $conn->query($get_products);
if ($result->num_rows > 0) {
    echo "
    <h3 class='text-success text-center mx-5'>All Products</h3>
    <table class='table table-bordered mt-3 mx-5'>
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Product Cost Price</th>
                <th>Product Price</th>
                <th>Supplier</th>
                <th>Stock</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        $s_id = $row['supplier_id'];
        $pro_id = $row['pro_id'];
        $admin_id = $row['admin_id'];
        $pro_name = $row['pro_name'];
        $pro_image = $row['pro_image'];
        $pro_quantity = $row['pro_quantity'];
        $pro_cost_price = $row['pro_cost_price'];
        $pro_price = $row['pro_price'];
        $stock = $row['stock'];
        ?>

        <tr class='text-center'>
            <td><?php echo $pro_id ?></td>
            <td><?php echo $pro_name ?></td>
            <td><img src='<?php echo $pro_image ?>' class='prod_image' alt='<?php echo $pro_name ?>'></td>
            <td><?php echo $pro_quantity ?></td>
            <td><?php echo $pro_cost_price ?></td>
            <td><?php echo $pro_price ?></td>
            <td>
                <?php
                $get_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$s_id'";  // Added backticks [cite: 61, 62, 63, 64]
                $result_supplier = $conn->query($get_supplier);
                if ($result_supplier) {
                    $row_supplier = $result_supplier->fetch_assoc();
                    echo $row_supplier['supplier_name'];
                }
                ?>
            </td>
            <td><?php echo $stock ?></td>
            <td><a href='admin_home.php?edit_products=<?php echo $pro_id; ?>'><i
                        class='fa-solid fa-pen-to-square text-dark'></i></a></td>
            <td><a href='admin_home.php?trash_products=<?php echo $pro_id; ?>'><i
                        class='fa-solid fa-trash-can text-dark'></i></a></td>
        </tr>

    <?php
    }
} else {
    echo "<h3 class='text-danger text-center'>No Suppliers Added Yet</h3>";  // Corrected typo [cite: 64]
}
?>
</tbody>
</table>
</body>