<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if not already started
}

if (!isset($_SESSION['username'])) {
    echo "<h3 class='text-danger mt-3'>Please log in to view your orders.</h3>";
    exit; // Stop further execution if username is not set
}

$username = $_SESSION['username'];

// Debugging: Check if $conn is initialized
if (!isset($conn) || !$conn) {
    echo "<h3 class='text-danger mt-3'>Database connection error. Please contact support.</h3>";
    exit;
}

// Debugging: Check the value of $username
if (empty($username)) {
    echo "<h3 class='text-danger mt-3'>Session username is empty. Please log in again.</h3>";
    exit;
}

$get_user = "SELECT * FROM `user` WHERE username = '$username'";
$result = $conn->query($get_user);

// Debugging: Check if the query executed successfully
if (!$result) {
    echo "<h3 class='text-danger mt-3'>Error executing query: " . $conn->error . "</h3>";
    exit;
}

if ($result->num_rows === 0) {
    echo "<h3 class='text-danger mt-3'>User not found. Please check your account details.</h3>";
    exit; // Stop further execution if user is not found
}

$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

?>

<html>

<body>
    <div class="centered-container">
        <h3 class="text-success text-center spaced-element">
            <strong>-- My Orders --</strong>
        </h3>

        <table class="table table-bordered mt-3 m-auto spaced-element">

            <thead class="bg-info">

                <?php

                $get_order_details = "SELECT * FROM `user_order` WHERE user_id = '$user_id'";
                $result_orders = $conn->query($get_order_details);

                if ($result_orders && $result_orders->num_rows > 0) {
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
                        $total_products = $row['total_products'];
                        $invoice_no = $row['invoice_no'];
                        $order_date = $row['order_date'];
                        $order_status = $row['order_status'];

                        $sr_no++;

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
                            echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td></tr>";
                        }
                    }
                } else {
                    echo "<h3 class='text-danger mt-3'>No orders yet</h3>";
                }

                ?>
                </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>