<body>
<?php
$get_orders = "SELECT * FROM `user_order`";  // Corrected query
$result = $conn->query($get_orders);

if($result){
    echo"
    <h3 class='text-center text-success mt-3 mb-3 mx-5 m-auto'>All Orders</h3>
    <table class='table table-bordered mt-3 mb-3 mx-5 m-auto'>
        <thead class='text-center'>
            <tr>
                <th>Sr. No.</th>
                <th>User Id</th>
                <th>Due Amount</th>
                <th>Invoice No</th>  
                <th>Total Products</th>
                <th>Order date</th>
                <th>Order Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='text-center'>";

    if($result->num_rows>0){
        $sr_no = 0;
        while($row = mysqli_fetch_assoc($result)){
            $order_id = $row['order_id'];
            $user_id = $row['user_id'];
            $due_amount = $row['due_amount'];
            $invoice_no = $row['invoice_no'];
            $total_products = $row['total_products'];
            $order_date = $row['order_date'];
            $order_status = $row['order_status'];
            $sr_no++;
            echo "
            <tr class='text-center'>
                <td>$sr_no</td>
                <td>$user_id</td>
                <td>$due_amount</td>
                <td>$invoice_no</td>
                <td>$total_products</td>
                <td>$order_date</td>
                <td>$order_status</td>
                <td>
                    <a href='admin_home.php?trash_all_orders=$order_id'>
                        <i class='fa-solid fa-trash-can text-dark'></i>
                    </a>
                </td>
            </tr>";
        }
        echo "
        </tbody>
    </table>";
    }
    else{
        echo "<h3 class='text-danger mt-3'>No orders yet</h3>";
    }
}
?>
</body>