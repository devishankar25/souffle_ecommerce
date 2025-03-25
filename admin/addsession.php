<?php
include('../includes/db.php'); // Include database connection
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sess_name = $_POST['sess_name'];
    $start_sess = $_POST['start_sess'];
    $end_sess = $_POST['end_sess'];
    $des = $_POST['des'];
    $url = $_POST['url'];
    $trainer_id = $_POST['trainer'];
    $select_admin = "SELECT admin_id FROM `trainer_details` WHERE trainer_id = '$trainer_id'";  // Added backticks
    $result_admin = $conn->query($select_admin);
    $row_admin = $result_admin->fetch_assoc();
    $admin_id = $row_admin['admin_id'];
    $stmt = $conn->prepare("INSERT INTO `session` (`sess_name`, `trainer_id`, `admin_id`, `start_sess`, `end_sess`, `des`, `url`) VALUES (?, ?, ?, ?, ?, ?, ?)");  // Added backticks
    $stmt->bind_param("ssissss", $sess_name, $trainer_id, $admin_id, $start_sess, $end_sess, $des, $url);
    if ($stmt->execute()) {
        echo "<script>alert('New session added successfully!')</script>";
        echo "<script>window.open('admin_home.php?addsession','_self')</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Session</title>
    <style>
        #add-session-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <section id="add-session-form">
        <form action="addsession.php" method="post">
            <label for="sess_name">Session Name:</label>
            <input type="text" id="sess_name" name="sess_name" required>

            <label for="trainer_name">Trainer Name:</label>
            <select name="trainer" id="trainer" class="form-select"> // Added id
                <option value="">Select Trainer</option>
                <?php
                $select = "SELECT * FROM `trainer_details`";  // Added backticks
                $result = $conn->query($select);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $trainer_fname = $row['trainer_fname'];
                        $trainer_id = $row['trainer_id'];
                        echo "<option value='$trainer_id'>$trainer_fname</option>";  // Corrected value
                    }
                }
                ?>
            </select>

            <label for="start_sess">Start Time:</label>
            <input type="time" id="start_sess" name="start_sess" required>

            <label for="end_sess">End Time:</label>
            <input type="time" id="end_sess" name="end_sess" required>

            <label for="des">Description:</label>
            <textarea id="des" name="des" rows="4" required></textarea>

            <label for="url">URL:</label>
            <input type="text" id="url" name="url" required>

            <input type="submit" value="Add Session">
        </form>
    </section>
</body>

</html>