<?php
include('../includes/db.php'); // Connect to the database
?>

<body>
    <h3 class="text-success text-center">Purchased Products</h3>
    <?php
    $username = $_SESSION['username'];
    $get_batches = "SELECT DISTINCT `batch` FROM `product_orders`";
    $result_batches = $conn->query($get_batches);
    if ($result_batches->num_rows > 0) {
        while ($row_batch = $result_batches->fetch_assoc()) {
            $batch_number = $row_batch['batch'];
            $get_orders = "SELECT * FROM `product_orders` WHERE `batch` = '$batch_number'"; //corrected query
            $result = $conn->query($get_orders);
            if ($result->num_rows > 0) {
                echo "<div class='polist mx-5' id='$batch_number'>
            <p class='text-danger'>Batch #: $batch_number</p>
            <a href='admin_home.php?update_p_order=$batch_number'>
                <i class='fa-solid fa-pen text-dark float-end mb-2'></i>
            </a>
            <table class='table table-bordered mt-3'>
                <thead>
                    <tr>
                        <th>P_Id</th>
                        <th>Product</th>
                        <th>Qnty Ordered</th>
                        <th>Qnty Recieved</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Ordered By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>";
                while ($row = $result->fetch_assoc()) {
                    $purchase_id = $row['p_s_id'];
                    $supplier_id = $row['supplier_id'];
                    $admin_id = $row['admin_id'];
                    $pro_id = $row['pro_id'];
                    $qnty_ordered = $row['quantity_ordered'];
                    $qnty_recieved = $row['quantity_recieved'];
                    $status = $row['status'];
                    $date = $row['created_at'];
    ?>
                    <tr class='text-center'>
                        <td><?php echo $purchase_id ?></td>
                        <td>
                            <?php
                            $get_product = "SELECT * FROM `products` WHERE `pro_id` = '$pro_id'"; //corrected query
                            $result_product = $conn->query($get_product);
                            if ($result_product) {
                                $row_product = $result_product->fetch_assoc();
                                echo $row_product['pro_name'];
                            }
                            ?>
                        </td>
                        <td><?php echo $qnty_ordered ?></td>
                        <td><?php echo $qnty_recieved ?></td>
                        <td>
                            <?php
                            $get_supplier = "SELECT * FROM `supplier` WHERE supplier_id = '$supplier_id'"; //corrected query
                            $result_supplier = $conn->query($get_supplier);
                            if ($result_supplier) {
                                $row_supplier = $result_supplier->fetch_assoc();
                                echo $row_supplier['supplier_name'];
                            }
                            ?>
                        </td>
                        <td>
                            <span class="status status-<?= $status ?>">
                                <?php echo $status ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $get_name = "SELECT * FROM `admin_signup` WHERE admin_id = '$admin_id'"; //corrected query
                            $result_name = $conn->query($get_name);
                            if ($result_name) {
                                $row_name = $result_name->fetch_assoc();
                                echo $row_name['username'];
                            }
                            ?>
                        </td>
                        <td><?php echo $date ?>
                            <input type="hidden" class="purchase_id" value="<?php $purchase_id ?>">
                            <input type="hidden" class="pro_id" value="<?php $pro_id ?>">
                        </td>
                    </tr>
    <?php
                }
                echo "
            </tbody>
            </table>
            </div>";
            } else {
                echo "<h3 class='text-danger text-center'>No Products Found for Batch # $batch_number</h3>";
            }
        }
    } else {
        echo "<h3 class='text-danger text-center'>No Batches Found</h3>";
    }
    ?>
</body>