<?php

session_start(); // Add missing session start

$username = $_SESSION['username'];

$get_user = "SELECT * FROM `user` WHERE username = '$username'"; // Corrected SQL syntax [cite: 1]
$result = $conn->query($get_user);
$row = mysqli_fetch_assoc($result);

$user_id = $row['user_id'];

?>

<html>

<body>

<h3 class="text-success text-center">
    <strong>-- My Orders --</strong>
</h3>

<table class="table table-bordered mt-3 m-auto">

    <thead class="bg-info">

    <?php

    $get_order_details = "SELECT * FROM `user_order` WHERE user_id = '$user_id'";  // Corrected SQL syntax [cite: 2]
    $result_orders = $conn->query($get_order_details);

    if ($result_orders->num_rows > 0) {
        $sr_no = 1;

        echo "<tr>
            <th>Sr. no.</th>
            <th>Order Number</th>
            <th>Due Amount</th>
            <th>Total products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>";

        while ($row = mysqli_fetch_assoc($result_orders)) {
            $order_id = $row['order_id'];
            $due_amount = $row['due_amount'];
            $total_products = $row['total_products'];  // Added missing semicolon [cite: 4]
            $invoice_no = $row['invoice_no'];
            $order_date = $row['order_date'];
            $order_status = $row['order_status'];

            $sr_no++;

            if ($order_status == 'pending') {
                $order_status = 'incomplete';  // Corrected assignment [cite: 4]
            } else {
                $order_status = 'complete';
            }

            echo "<tr>
            <td>$sr_no</td>
            <td>$order_id</td>
            <td>$due_amount</td>
            <td>$total_products</td>
            <td>$invoice_no</td>
            <td>$order_date</td>
            <td>$order_status</td>";
            if ($order_status == 'complete') {
                echo "<td>Paid</td>";
            } else {
                echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td></tr>";  // Added missing closing tag for 'tr' [cite: 5]
            }
        }
    } else {
        echo "<h3 class='text-danger mt-3'>No orders yet</h3>";  // Corrected heading tag [cite: 5]
    }

    ?>
    </tbody>
</table>

</body>

</html>