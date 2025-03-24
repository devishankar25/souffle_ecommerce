<?php
include('../includes/functions.php'); // Include the functions file

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<h3 class='text-danger mt-3'>Please log in to view your orders.</h3>";
    exit();
}

$username = $_SESSION['username'];

// Fetch user details
$get_user = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($get_user);

if ($result && $result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
} else {
    echo "<h3 class='text-danger mt-3'>User not found.</h3>";
    exit();
}
?>

<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="../path/to/your/css/bootstrap.min.css">
</head>
<body>
    <h3 class="text-success text-center"><strong>-- My Orders --</strong></h3>

    <table class="table table-bordered mt-3 m-auto">
        <thead class="bg-info">
            <?php
            // Fetch order details
            $get_order_details = "SELECT * FROM user_order WHERE user_id = '$user_id'";
            $result_orders = $conn->query($get_order_details);

            if ($result_orders && $result_orders->num_rows > 0) {
                $sr_no = 1;

                echo "<tr>
                        <th>Sr. no.</th>
                        <th>Order Number</th>
                        <th>Due Amount</th>
                        <th>Total Products</th>
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
                    $total_products = $row['total_products'];
                    $invoice_no = $row['invoice_no'];
                    $order_date = $row['order_date'];
                    $order_status = $row['order_status'];

                    if ($order_status == 'pending') {
                        $order_status = 'incomplete';
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
                        echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td>";
                    }

                    echo "</tr>";
                    $sr_no++;
                }
            } else {
                echo "</thead><tbody>";
                echo "<tr><td colspan='8' class='text-center text-danger'>No orders yet</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
