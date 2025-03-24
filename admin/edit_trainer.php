<?php
if (isset($_GET['edit_trainer'])) {
    $edit_id = $_GET['edit_trainer'];  //this will display id in the url [cite: 1]
    $get_data = "SELECT * FROM `trainer_details` WHERE `trainer_id` = '$edit_id'"; [cite: 1]
    $result_edit = $conn->query($get_data); [cite: 2]
    $row = mysqli_fetch_assoc($result_edit); [cite: 2]
    $trainer_id = $row['trainer_id']; [cite: 2]
    $trainer_fname = $row['trainer_fname']; [cite: 2]
    $trainer_lname = $row['trainer_lname'];  // Corrected variable name [cite: 2]
    $trainer_contact = $row['trainer_contact']; [cite: 2]
    $trainer_qual = $row['trainer_qual']; [cite: 2]
    $trainer_work = $row['trainer_work']; [cite: 2]
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trainer</title>
</head>

<body>
    <div class="container mt-3 bg-light">
        <h3 class="text-success text-center mt-5">
            <strong>Edit Trainer Details</strong>
        </h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline m-auto">
                <label for="trainer_id" class="form-label mt-3">Trainer ID:
                    <?php echo $trainer_id; ?></label>  </div>
            <div class="form-outline m-auto">
                <label for="trainer_fname" class="form-label mt-3">Trainer First Name</label>
                <input type="text" class="form-control" id="trainer_fname" name="trainer_fname"
                    value="<?php echo $trainer_fname; ?>" required
                    onkeydown="return /[A-Za-z\s]/i.test(event.key)" autocomplete="off">  </div>
            <div class="form-outline m-auto">
                <label for="trainer_lname" class="form-label mt-3">Trainer Last Name</label>  <input type="text" class="form-control" id="trainer_lname" name="trainer_lname"  value="<?php echo $trainer_lname; ?>" required
                    onkeydown="return /[A-Za-z\s]/i.test(event.key)" autocomplete="off">  </div>
            <div class="form-outline m-auto">
                <label for="trainer_contact" class="form-label mt-3">Trainer Contact</label>
                <input type="tel" class="form-control" id="trainer_contact" name="trainer_contact"  value="<?php echo $trainer_contact; ?>"
                    onkeydown="return //i.test(event.key)" autocomplete="off" minlength="10"
                    maxlength="10" required>
            </div>
            <div class="form-outline m-auto">
                <label for="trainer_qual" class="form-label mt-3">Trainer Qualification</label>
                <input type="text" class="form-control" id="trainer_qual" name="trainer_qual"
                    value="<?php echo $trainer_qual; ?>" required
                    onkeydown="return /[a-zA-Z0-9\s\-,\.]/i.test(event.key)" autocomplete="off">  </div>
            <div class="form-outline m-auto">
                <label for="trainer_work" class="form-label mt-3">Trainer Work Experience</label>
                <textarea class="form-control w-90 mb-auto" id="trainer_work" name="trainer_work" required
                    onkeydown="return /[a-zA-Z0-9\s\-,\.]/i.test(event.key)"><?php echo $trainer_work; ?></textarea>  </div>
            <div class="text-center mb-5">
                <input type="submit" name="edit_product" value="Update" class="btn px-3 mt-3 mb-5">  </div>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['edit_product'])) {  // Changed name attribute
    $trainer_fname = $_POST['trainer_fname']; [cite: 5]
    $trainer_lname = $_POST['trainer_lname'];  // Corrected variable name [cite: 5]
    $trainer_contact = $_POST['trainer_contact']; [cite: 5]
    $trainer_qual = $_POST['trainer_qual']; [cite: 5]

    $update_query = "UPDATE `trainer_details` SET 
        trainer_fname = '$trainer_fname', 
        trainer_qual = '$trainer_qual', 
        trainer_lname = '$trainer_lname',  // Corrected variable name
        trainer_contact = '$trainer_contact' 
        WHERE trainer_id='$edit_id'"; [cite: 5]

    $result_update = $conn->query($update_query); [cite: 6]

    if ($result_update) {
        echo "<script>alert('Successfully updated trainer info')</script>"; [cite: 6]
        echo "<script>window.open('admin_home.php?trainers_list','_self')</script>"; [cite: 6]
    }
}
?>