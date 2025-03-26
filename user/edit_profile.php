<?php

include('../includes/db.php');
include('../includes/functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if not already active
}
include_once('../includes/db.php'); // Include the database connection

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if (!$username) {
    die('Error: User is not logged in.');
}

if (isset($_POST['update_profile'])) {

    // Update first name, last name, gender, age, height, weight

    $update_fname = isset($_POST['update_fname']) ?
        mysqli_real_escape_string($conn, $_POST['update_fname']) : "";

    $update_lname = isset($_POST['update_lname']) ?
        mysqli_real_escape_string($conn, $_POST['update_lname']) : "";

    $update_gender = isset($_POST['update_gender']) ?
        mysqli_real_escape_string($conn, $_POST['update_gender']) : "";

    $update_age = isset($_POST['update_age']) ?
        mysqli_real_escape_string($conn, $_POST['update_age']) : "";

    $update_height = isset($_POST['update_height']) ?
        mysqli_real_escape_string($conn, $_POST['update_height']) : "";

    $update_weight = isset($_POST['update_weight']) ?
        mysqli_real_escape_string($conn, $_POST['update_weight']) : "";

    $update_query = "UPDATE `user` SET fname = '$update_fname', lname = '$update_lname', gender = '$update_gender', age = '$update_age', height = '$update_height', weight = '$update_weight' WHERE username = '$username'";

    $result_update = mysqli_query($conn, $update_query);

    if (!$result_update) {
        die('Query failed: ' . mysqli_error($conn));
    }
}

?>

<style>
    .centered-container {
        margin: 20px auto;
        max-width: 800px;
    }

    .update-profile {
        width: 100%;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .update-profile form {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px 30px;
    }

    .update-profile label {
        font-weight: bold;
        align-self: center;
    }

    .update-profile input,
    .update-profile datalist {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
    }

    .form-actions {
        grid-column: span 2;
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        /* Space between buttons */
        margin-top: 20px;
    }

    .form-actions input[type="submit"],
    .form-actions a {
        padding: 8px 15px;
        /* Smaller padding for smaller buttons */
        border: 1px solid seagreen;
        border-radius: 5px;
        font-size: 14px;
        /* Smaller font size */
        text-align: center;
        cursor: pointer;
    }

    .form-actions input[type="submit"] {
        background-color: seagreen;
        color: white;
        border: none;
    }

    .form-actions input[type="submit"]:hover {
        background-color: rgb(20, 67, 41);
    }

    .form-actions a {
        text-decoration: none;
        color: seagreen;
        background-color: white;
    }

    .form-actions a:hover {
        background-color: seagreen;
        color: white;
    }
</style>

<body>
    <div class="centered-container">
        <h4 class="text-center text-success mt-3 spaced-element">
            <strong>Update Profile</strong>
        </h4>

        <div class="update-profile spaced-element">

            <?php

            $select = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$username'")
                or die('Query failed');

            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }

            ?>

            <form action="profile.php?edit_profile" method="post"
                enctype="multipart/form-data">
                <label for="update_fname">First Name:</label>
                <input type="text" id="update_fname" name="update_fname"
                    value="<?php echo isset($fetch['fname']) ? $fetch['fname'] : ""; ?>">

                <label for="update_lname">Last Name:</label>
                <input type="text" id="update_lname" name="update_lname"
                    value="<?php echo isset($fetch['lname']) ? $fetch['lname'] : ""; ?>">

                <label for="update_gender">Gender:</label>
                <input type="text" id="update_gender" name="update_gender"
                    value="<?php echo isset($fetch['gender']) ? $fetch['gender'] : ""; ?>" list="genders">
                <datalist id="genders">
                    <option value="Male">
                    <option value="Female">
                    <option value="Others">
                </datalist>

                <label for="update_age">Age:</label>
                <input type="number" id="update_age" name="update_age"
                    value="<?php echo isset($fetch['age']) ? $fetch['age'] : ""; ?>" min="18">

                <label for="update_height">Height (in cms):</label>
                <input type="number" id="update_height" name="update_height"
                    value="<?php echo isset($fetch['height']) ? $fetch['height'] : ""; ?>" min="0">

                <label for="update_weight">Weight (in kgs):</label>
                <input type="number" id="update_weight" name="update_weight"
                    value="<?php echo isset($fetch['weight']) ? $fetch['weight'] : ""; ?>" min="0">

                <div class="form-actions">
                    <input type="submit" value="Update Profile" name="update_profile">
                    <a href="profile.php">Go Back</a>
                </div>

                <?php
                if (isset($_POST['update_profile'])) {
                    echo "<script>alert('Profile updated successfully!')</script>";
                    echo "<script>window.open('profile.php?delivery_details','_self')</script>";
                }
                ?>

            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Souffle Bakery. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>