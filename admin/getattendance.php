<?php
include('../includes/db.php'); // Include database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Spartan', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #007bff;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Attendance Records</h3>
        <?php
        $query = "SELECT a.date, u.username, a.attendance 
                  FROM `attendance` a 
                  JOIN `user` u ON a.user_id = u.user_id 
                  ORDER BY a.date DESC, u.username ASC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead class='table-dark'>
                        <tr>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['date']}</td>
                        <td>{$row['username']}</td>
                        <td>" . ($row['attendance'] == 1 ? "Present" : "Absent") . "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<h4 class='text-center text-danger'>No attendance records found.</h4>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>