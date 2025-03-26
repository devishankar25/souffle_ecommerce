<?php
include('../includes/db.php');
include('../includes/functions.php');

if (isset($_POST['reset'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        $email = $_POST['email'];
        $sql = "UPDATE user SET password = '$new_password' WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result) {
            echo '<div class="alert alert-success mt-3" role="alert">Password reset successfully!</div>';
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">Failed to reset password. Please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Passwords do not match.</div>';
    }
}

if (isset($_POST['login'])) {
    header("Location: user.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            /* Light blue background */
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            /* White card background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-success {
            background-color: #28a745;
            /* Cool green */
            border-color: #28a745;
        }

        .btn-warning {
            background-color: #ffc107;
            /* Cool yellow */
            border-color: #ffc107;
        }

        h5 {
            color: #dc3545;
            /* Cool red for heading */
        }
    </style>
</head>

<body>
    <form action="reset_pass.php" method="POST">
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card p-4" style="width: 30rem;">
                <div class="card-body">
                    <h5 class="text-center">Reset Password</h5>
                    <hr>
                    <input type="text" name="email" placeholder="Enter your email" class="form-control mb-4"
                        required>
                    <input type="password" name="new_password" placeholder="Enter new password"
                        class="form-control mb-3" required>
                    <input type="password" name="confirm_password" placeholder="Confirm new password"
                        class="form-control mb-4" required>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="reset" class="btn btn-success">Reset Password</button>
                        <a href="user.php" class="btn btn-warning">Login Now</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>