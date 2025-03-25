<?php

$username = $_SESSION['username'];

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

                <div class="prod-container">
                    <div class="pro-container">

                        <span><strong>First Name:</strong></span>
                        <input type="text" name="update_fname"
                            value="<?php echo isset($fetch['fname']) ? $fetch['fname'] : ""; ?>"
                            class="box"> [cite: 4, 5]

                        <span>Last Name:</span>
                        <input type="text" name="update_lname"
                            value="<?php echo isset($fetch['lname']) ? $fetch['lname'] : ""; ?>"
                            class="box"> [cite: 5]

                        <span>Gender:</span>
                        <input type="text" name="update_gender"
                            value="<?php echo isset($fetch['gender']) ? $fetch['gender'] : ""; ?>"
                            list="genders" class="box"> [cite: 5, 6]
                        <datalist id="genders">
                            <option value="Male">
                            <option value="Female">
                            <option value="Others">
                        </datalist>

                        <span>Age:</span>
                        <input type="number" name="update_age"
                            value="<?php echo isset($fetch['age']) ? $fetch['age'] : ""; ?>"
                            class="box" min="18"> [cite: 6, 7]

                        <span>Height (in cms):</span>
                        <input type="number" name="update_height"
                            value="<?php echo isset($fetch['height']) ? $fetch['height'] : ""; ?>"
                            class="box" min="0"> [cite: 7, 8]

                        <span>Weight (in kgs):</span>
                        <input type="number" name="update_weight"
                            value="<?php echo isset($fetch['weight']) ? $fetch['weight'] : ""; ?>"
                            class="box" min="0"> [cite: 8, 9]

                    </div>
                </div>

                <input type="submit" value="Update Profile" name="update_profile"
                    style="padding: 10px 20px; border: none; border-radius: 5px; background-color: seagreen; color: azure; cursor: pointer; text-decoration: none; font-size: 16px; background-color: seagreen;"
                    onmouseover="this.style.backgroundColor='rgb(20, 67, 41)'"
                    onmouseout="this.style.backgroundColor='seagreen'"> [cite: 9, 10]

                <?php
                if (isset($_POST['update_profile'])) {
                    echo "<script>alert('Profile updated successfully!')</script>";
                    echo "<script>window.open('profile.php?delivery_details','_self')</script>";
                }
                ?>

                <a href="profile.php" class="delete-btn">Go Back</a>
            </form>
        </div>
    </div>
</body>

</html>