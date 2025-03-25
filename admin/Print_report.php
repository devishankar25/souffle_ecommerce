<style>
    @import url('http://fonts.googleapis.com/css?family=Spartan.wght@100,200,300,400,500,600,700,800,9 00&display=swap');

    body {
        font-family: 'Spartan', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: azure;
    }

    h2,
    h3 {
        color: #333;
    }

    .btn {
        background-color: #20B2AA;
        /* Aqua shade */
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 10px;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }

    .btn:hover {
        background-color: #0d4848;
        /* Darker Aqua shade */
    }

    .btn-submit {
        background-color: #8FBC8F;
        /* DarkSeaGreen shade */
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-weight: 600;
    }

    .btn-submit:hover {
        background-color: #173625;
        /* Darker shade */
    }

    .search-container {
        margin-bottom: 20px;
        text-align: center;
    }

    #search_term {
        padding: 10px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
</style>

<?php
include('../includes/db.php'); // Include database connection
include_once('config.php');
include_once('function.php');

$get_dates = "SELECT DISTINCT `date` FROM `attendance` ORDER BY date";
$result_dates = $conn->query($get_dates);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
</head>

<body>
    <div class="container">
        <h1 align="center">Attendance Report</h1>
        <div class="search-container">
            <form method="post" action="">
                <input type="text" name="search_term" id="search_term" placeholder="Enter User ID, Username or Name">
                <input type="submit" name="btnsearch" value="Search" class="btn">
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <?php
                    if ($result_dates->num_rows > 0) {
                        while ($row = $result_dates->fetch_assoc()) {
                            $date = $row['date'];
                            echo "<th>$date</th>";
                        }
                    }
                    ?>
                    <th>Total Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST["btnsearch"])) {
                    $search_term = $_POST["search_term"];
                    $query = "SELECT * FROM `user` WHERE user_id = '$search_term' OR username LIKE '%$search_term%' OR fname LIKE '%$search_term%'";
                } else {
                    $query = "SELECT * FROM `user`";
                }
                $result = $conn->query($query) or die("select error error");
                while ($rec = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $rec["user_id"] . '</td>';
                    echo '<td>' . $rec["username"] . '</td>';

                    $query1 = "SELECT * FROM `attendance` WHERE `user_id` = " . $rec["user_id"] . " ORDER BY date";
                    $result1 = $conn->query($query1) or die("select error error");
                    $total_attendance = 0; // Initialize total attendance variable

                    while ($rec1 = $result1->fetch_assoc()) {
                        echo '<td>';
                        echo $rec1["attendance"] == 0 ? "Absent" : "Present";
                        echo '</td>';
                        $total_attendance += $rec1["attendance"]; // Summing up attendances
                    }
                    echo '<td>' . $total_attendance . '</td>'; // Display total attendance for the user
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <form method="post">
            <div class="text-center">
                <button type="submit" class="btn btn-print" name="btn-print">Print Report</button>
            </div>
        </form>
        <?php
        if (isset($_POST["btn-print"])) {
            header("Location: printreport.php");
        }
        ?>
    </div>
</body>

</html>