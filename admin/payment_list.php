<?php
include('../includes/db.php'); // Include database connection

$get_payments = "SELECT * FROM `user_payments`"; // Corrected query [cite: 79, 80, 81]
$result = $conn->query($get_payments);

echo "
<h3 class='text-center text-success mx-5'>All Payments</h3>
<table class='table table-bordered mt-3 mx-5 m-auto'>
    <thead class='text-center'>
        <tr>
            <th>Sr. No.</th>
            <th>Order Id</th>
            <th>Payment Id</th>
            <th>Invoice No</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Payment date</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='text-center'>";

if ($result->num_rows > 0) {
    $sr_no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $payment_id = $row['payment_id'];
        $order_id = $row['order_id'];
        $invoice_no = $row['invoice_no'];
        $amount = $row['amount'];
        $payment_mode = $row['payment_mode'];
        $date = $row['date'];
        $sr_no++;

        echo "<tr class='text-center'>
                <td>$sr_no</td>
                <td>$order_id</td>
                <td>$payment_id</td>
                <td>$invoice_no</td>
                <td>$amount</td>
                <td>$payment_mode</td>
                <td>$date</td>
                <td>
                    <a href='admin_home.php?trash_all_payments=$payment_id'>
                        <i class='fa-solid fa-trash-can text-dark'></i>
                    </a>
                </td>
              </tr>";
    }
}
echo "
    </tbody>
</table>";
