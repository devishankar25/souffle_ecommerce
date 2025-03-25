<?php
include('../includes/db.php'); // Connect to the database
?>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_suppliers = "SELECT * FROM `supplier`";
    $result = $conn->query($get_suppliers);

    if ($result->num_rows > 0) {
        echo "
    <h3 class='text-success text-center mx-5'>All Products</h3>
    <table class='table table-bordered mt-3 mx-5'>
        <thead>
            <tr>
                <th>Supplier Id</th>
                <th>Added By</th>
                <th>Supplier name</th>
                <th>Email</th>
                <th>Added At</th>
                <th>Updated At</th>
                <th>Products</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $supplier_id = $row['supplier_id'];
            $admin_id = $row['admin_id'];
            $supplier_name = $row['supplier_name'];
            $email = $row['email'];
            $added_at = $row['added_at'];
            $updated_at = $row['updated_at'];
    ?>
            <tr class='text-center'>
                <td><?php echo $supplier_id ?></td>
                <td>
                    <?php
                    $get_name = "SELECT * FROM `admin_signup` WHERE `admin_id` = '$admin_id'";  //corrected query
                    $result_name = $conn->query($get_name);
                    if ($result_name) {
                        $row_name = $result_name->fetch_assoc();
                        echo $row_name['username'];
                    }
                    ?>
                </td>
                <td><?php echo $supplier_name ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $added_at ?></td>
                <td><?php echo $updated_at ?></td>
                <td>
                    <?php
                    $select = "SELECT * FROM `products` WHERE `supplier_id` ='$supplier_id'"; //corrected query
                    $result_select = $conn->query($select);
                    while ($row_fetch = mysqli_fetch_assoc($result_select)) {
                        echo $row_fetch['pro_name'] . " ";
                    ?>
                        <br>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <a href='admin_home.php?edit_suppliers=<?php echo $supplier_id; ?>'>
                        <i class='fa-solid fa-pen-to-square text-dark'></i>
                    </a>
                </td>
                <td>
                    <a href='admin_home.php?trash_suppliers=<?php echo $supplier_id; ?>'>
                        <i class='fa-solid fa-trash-can text-dark'></i>
                    </a>
                </td>
            </tr>
    <?php
        }
        echo "</tbody></table>";
    } else {
        echo "<h3 class='text-danger text-center'>No Suppliers Added Yet</h3>";
    }
    ?>
</body>