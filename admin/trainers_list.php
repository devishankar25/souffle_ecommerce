<?php
include('../includes/db.php'); // Include database connection
$username = $_SESSION['username'];
$get_trainers = "SELECT * FROM `trainer_details`"; // Added backticks
$result_trainers = $conn->query($get_trainers);
$sr_no = 0;

if ($result_trainers->num_rows > 0) {
    echo "<h3 class='text-success text-center mb-2'>Trainers List</h3>
          <table class='table table-bordered mt-3 mx-5'>
              <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Added By</th>
                      <th>Trainer Id</th>
                      <th>First name</th>
                      <th>Last Name</th>
                      <th>Trainer Contact</th>
                      <th>Qualification</th>
                      <th>Work</th>
                      <th>Joining Date</th>
                      <th>Edit</th>
                  </tr>
              </thead>
              <tbody>";

    while ($row = mysqli_fetch_assoc($result_trainers)) {
        $trainer_id = $row['trainer_id'];
        $admin_id = $row['admin_id'];
        $trainer_fname = $row['trainer_fname'];
        $trainer_lname = $row['trainer_lname'];  // Corrected variable name
        $trainer_contact = $row['trainer_contact'];
        $trainer_qual = $row['trainer_qual'];
        $trainer_work = $row['trainer_work'];
        $join_date = $row['join_date'];
        $sr_no++;
?>

        <tr class='text-center'>
            <td><?php echo $sr_no ?></td>
            <td>
                <?php
                $get_name = "SELECT * FROM `admin_signup` WHERE `admin_id` = '$admin_id'"; // Added backticks
                $result_name = $conn->query($get_name);

                if ($result_name) {
                    $row_name = $result_name->fetch_assoc();
                    echo $row_name['username'];
                }
                ?>
            </td>
            <td><?php echo $trainer_id ?></td>
            <td><?php echo $trainer_fname ?></td>
            <td><?php echo $trainer_lname ?></td> // Corrected variable name
            <td><?php echo $trainer_contact ?></td>
            <td><?php echo $trainer_qual ?></td>
            <td><?php echo $trainer_work ?></td>
            <td><?php echo $join_date ?></td>
            <td><a href='admin_home.php?edit_trainer=<?php echo $trainer_id; ?>'><i
                        class='fa-solid fa-pen text-dark'></i></a></td>
        </tr>

<?php
    }
} else {
    echo "<h3 class='text-center text-danger'>No Trainers yet</h3>";
}
?>

</tbody>
</table>
</body>

</html>