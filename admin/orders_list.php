<?php
// Start the session
session_start();

// Include database connection
include '../includes/db.php';

// Fetch orders from the database
$query = "SELECT * FROM user_order ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Order List</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td>$<?php echo $row['Due_amount']; ?></td>
                        <td><?php echo ucfirst($row['Order_status']); ?></td>
                        <td><?php echo $row['Order_date']; ?></td>
                        <td>
                            <a href="update_order.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Update
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
