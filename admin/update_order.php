<?php 
if (isset($_GET['update_p_order'])) {
    $edit_id = $_GET['update_p_order'];
}

$get_data = "SELECT * FROM `product_orders` WHERE batch = '$edit_id'";  //corrected query
$result_edit = $conn->query($get_data);

if (isset($_POST['edit_product'])) {
    foreach($_POST['quantity_received'] as $index => $received_quantity) {
        $status = $_POST['status'][$index];
        $p_s_id = $_POST['p_s_id'][$index];

        $select = "SELECT * FROM `product_orders` WHERE batch = $edit_id AND p_s_id = $p_s_id"; //corrected query
        $result_select = $conn->query($select);
        $row_select = $result_select->fetch_assoc();

        if($result_select && $row_select) {
            $p_id = $row_select['p_s_id'];
            $quantity_ordered = $row_select['quantity_ordered'];
            $quantity_remaining = $quantity_ordered - $received_quantity;

            $update = "UPDATE `product_orders` SET `quantity_remaining` = '$quantity_remaining' WHERE p_s_id='$p_id'"; //corrected query
            $conn->query($update);

            $stock_query = "SELECT `stock` FROM `products` WHERE `pro_id` = '$p_id'"; //corrected query
            $stock_result = $conn->query($stock_query);
            $row_stock = $stock_result->fetch_assoc();

            if($row_stock) {
                $current_stock = $row_stock['stock'];
                $updated_stock = $current_stock + $received_quantity;

                $stock_update_query = "UPDATE `products` SET `stock` = $updated_stock WHERE pro_id = '$p_id'"; //corrected query
                $conn->query($stock_update_query);
            }

            $update_query = "UPDATE `product_orders` SET 
                             quantity_recieved='$received_quantity', 
                             quantity_remaining='$quantity_remaining',
                             status='$status', 
                             created_at = NOW() 
                             WHERE p_s_id='$p_s_id'"; //corrected query

            $conn->query($update_query);

            echo "<script>alert('Successfully updated Purchase info')</script>";
            echo "<script>alert('Quantity Remaining Updated')</script>";
            echo "<script>window.open('admin_home.php?view_order_from_supplier','_self')</script>";
        }
    }
}
?>

<body>
    <h3 class="text-success text-center">Update Purchase Order</h3>
    <div class="container mt-5">
        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if($result_edit->num_rows > 0) {
                echo '<table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>P_ID</th>
                                <th>Pro_ID</th>
                                <th>Product Name</th>
                                <th>Quantity Ordered</th>
                                <th>Quantity Received</th>
                                <th>Supplier Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';

                while($row = mysqli_fetch_assoc($result_edit)) {
                    $p_id = $row['p_s_id'];
                    $pro_id = $row['pro_id'];
                    $quantity_ordered = $row['quantity_ordered'];
                    $quantity_received = $row['quantity_recieved'];
                    $supplier_id = $row['supplier_id'];

                    $select_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplier_id'"; //corrected query
                    $result_supplier = $conn->query($select_supplier);
                    $row_supplier = mysqli_fetch_assoc($result_supplier);
                    $supplier_name = $row_supplier['supplier_name'];

                    $select_products = "SELECT * FROM `products` WHERE `pro_id` = '$pro_id'";  //corrected query
                    $result_products = $conn->query($select_products);
                    $row_products = mysqli_fetch_assoc($result_products);
                    $pro_name = $row_products['pro_name'];

                    echo "<tr>";
                    echo "<td>$p_id</td>";
                    echo "<td>$pro_id</td>";
                    echo "<td>$pro_name</td>";
                    echo "<td>$quantity_ordered</td>";
                    echo "<td><input type='number' name='quantity_received' id='quantity_received' value='$quantity_received'></td>";
                    echo "<td>$supplier_name</td>";
                    echo "<td>
                            <select name='status' id='status' class='p-2'>
                                <option value='ORDERED' ".($row['status'] == 'ORDERED' ? 'selected' : "").">ORDERED</option>
                                <option value='ARRIVED' ".($row['status'] == 'ARRIVED' ? 'selected' : "").">ARRIVED</option>
                                <option value='INCOMPLETE'".($row['status'] == 'INCOMPLETE' ? 'selected' : "").">INCOMPLETE</option>
                            </select>
                          </td>";
                    echo "<input type='hidden' name='p_s_id' value='$p_id'>";
                    echo "</tr>";
                }
                echo '</tbody></table>';
            } else {
                echo "No matching records found.";
            }
            ?>
            <div class="text-center">
                <input type="submit" name="edit_product" value="Update" class="btn px-3 mt-3">
            </div>
        </form>
    </div>
</body>