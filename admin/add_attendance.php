<?php
include('../includes/db.php'); // Include database connection

if (isset($_POST["btnsubmit"])) {
    $date = $_POST["cyear"] . "-" . $_POST["cmonth"] . "-" . $_POST["cdate"];

    $query = "SELECT * FROM `user`";
    $result = mysqli_query($conn, $query) or die("Select error");

    while ($rec = mysqli_fetch_array($result)) {
        $mno = $rec["user_id"];

        if (isset($_POST[$mno])) {
            $query1 = "INSERT INTO `attendance` (`user_id`, `date`, `attendance`) VALUES ('$mno', '$date', '1')";
        } else {
            $query1 = "INSERT INTO `attendance` (`user_id`, `date`, `attendance`) VALUES ('$mno', '$date', '0')";
        }

        mysqli_query($conn, $query1) or die("Insert error for user ID: $mno");
    }

    echo "<script>alert('Attendance recorded successfully.');</script>";
    echo "<script>window.location.href='printreport.php';</script>";
}
?>

<body>
    <div class="container">
        <h1><span class="style1">Add Attendance</span></h1>
        <form action="" method="post">
            <table>
                <tr>
                    <th>Select date: </th>
                    <td>
                        <?php
                        $dt = getdate();
                        $day = $dt["mday"];
                        $month = date("m");
                        $year = $dt["year"];

                        echo "<select name='cdate'>";
                        for ($a = 1; $a <= 31; $a++) {
                            echo "<option value='$a'" . ($day == $a ? " selected='selected'" : "") . ">$a</option>";
                        }
                        echo "</select>";

                        echo "<select name='cmonth'>";
                        for ($a = 1; $a <= 12; $a++) {
                            echo "<option value='$a'" . ($month == $a ? " selected='selected'" : "") . ">$a</option>";
                        }
                        echo "</select>";

                        echo "<select name='cyear'>";
                        for ($a = 2010; $a <= $year; $a++) {
                            echo "<option value='$a'" . ($year == $a ? " selected='selected'" : "") . ">$a</option>";
                        }
                        echo "</select>";
                        ?>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th colspan="2"><span class="style2">Get Attendance</span></th>
                </tr>
                <tr>
                    <th><span class="style7">Name</span></th>
                    <th><span class="style7">Tick if Present</span></th>
                </tr>
                <?php
                $query = "SELECT * FROM `user` ORDER BY `user_id`";
                $result = mysqli_query($conn, $query) or die("Select error");

                while ($rec = mysqli_fetch_array($result)) {
                    echo '<tr>
                        <td>' . $rec["username"] . '</td>
                        <td><input type="checkbox" name="' . $rec["user_id"] . '" /></td>
                    </tr>';
                }
                ?>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Get Attendance" name="btnsubmit" class="btn-submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>