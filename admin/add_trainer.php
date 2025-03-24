<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $get_admin = "SELECT * FROM `admin_signup` WHERE username = '$username'";
    $result = $conn->query($get_admin);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admin_id = $row['admin_id'];

        if (isset($_POST['add_trainer'])) {
            $trainer_id = $_POST['trainer_id'];
            $trainer_fname = $_POST['trainer_fname'];
            $trainer_lname = $_POST['trainer_lname'];  // Corrected variable name
            $trainer_contact = $_POST['trainer_contact']; // Added missing semicolon
            $trainer_qual = $_POST['trainer_qual'];
            $trainer_work = $_POST['trainer_work'];
            $trainer_start_time = $_POST['trainer_start_time'];
            $trainer_end_time = $_POST['trainer_end_time'];

            // Validate time (assuming this is the intended logic)
            if (strtotime($trainer_start_time) < strtotime("05:00:00") || strtotime($trainer_end_time) > strtotime("07:00:00")) {  //Corrected time format and comparison
                echo "<script>alert('Select time between 5am to 7am')</script>";
            } else {
                $check = "SELECT * FROM `trainer_details` WHERE trainer_id = '$trainer_id'"; // Added missing backticks
                $result_check = $conn->query($check);

                if ($result_check->num_rows > 0) {
                    echo "<script>alert('Trainer already present')</script>";
                } else {
                    $insert = "INSERT INTO `trainer_details` (trainer_id, admin_id, trainer_fname, trainer_lname, trainer_contact, trainer_qual, trainer_work, join_date, start_time, end_time) 
                               VALUES ('$trainer_id', '$admin_id', '$trainer_fname', '$trainer_lname', '$trainer_contact', '$trainer_qual', '$trainer_work', NOW(), '$trainer_start_time', '$trainer_end_time')"; // Added missing backticks and corrected variable names

                    $result_insert = $conn->query($insert);

                    if ($result_insert) {
                        echo "<script>alert('Trainer added successfully')</script>";
                        echo "<script>window.open('admin_home.php?trainers_list','_self')</script>";
                    } else {
                        echo "Error: " . $insert . "<br>" . $conn->error;  // Corrected variable name $sql_insert to $insert
                    }
                }
            }
        }
    } else {
        echo "<script>alert('Admin not found')</script>";
    }
} else {
    echo "<script>alert('Session not set')</script>";
}
?>

<html>

<head>
    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }

        button:hover {
            background-color: black;
            color: azure;
        }

        .container {
            width: 500px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        label {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success mt-5">Add New Trainers</h3>

    <form action="" method="post" class="mb-2">
        <div class="container mt-3 bg-light text-center m-auto">
            <div class="input-group mb-2 m-auto mt-3">
                <span class="input-group-text bg-light mt-3" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control mt-3" placeholder="Trainer Id" name="trainer_id"
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9]/i.test(event.key)" autocomplete="off"
                    required>
            </div>

            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" placeholder="First Name" name="trainer_fname"
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z]/i.test(event.key)" autocomplete="off"
                    required>
            </div>

            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Last Name" name="trainer_lname"  // corrected name
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z]/i.test(event.key)" autocomplete="off"
                    required>
            </div>

            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                <input type="tel" class="form-control" placeholder="Contact" name="trainer_contact"
                    aria-describedby="basic-addon1" onkeydown="return //i.test(event.key)" autocomplete="off"
                    minlength="10" maxlength="10" required>
            </div>

            <div class="row">
                <div class="input-group mb-2 m-auto w-50">
                    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-clock"></i><label
                            class="m-1"> Start</label></span>
                    <input type="time" class="form-control" placeholder="Start Time" name="trainer_start_time"
                        aria-describedby="basic-addon1" required>
                </div>

                <div class="input-group mb-2 m-auto w-50">
                    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-clock"></i><label
                            class="m-1"> End</label></span>
                    <input type="time" class="form-control" placeholder="End Time" name="trainer_end_time"
                        aria-describedby="basic-addon1" required>
                </div>
            </div>

            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i
                        class="fa-solid fa-building-columns"></i></i></span>
                <input type="text" class="form-control" placeholder="Qualification" name="trainer_qual"
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 -,.\\/]/i.test(event.key)"  //Added escape character for backslash
                    autocomplete="off" required>
            </div>

            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i
                        class="fa-solid fa-book-journal-whills"></i></span>
                <textarea type="text" class="form-control" placeholder="Work Experience" name="trainer_work"
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 \-,.\\/]/i.test(event.key)"  //Added escape character for backslash
                    autocomplete="off" required></textarea>
            </div>

            <div class="input-group text-center w-10 mb-2 m-auto">
                <button type="submit" class="p-2 my-2 m-auto text-center" name="add_trainer">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>