<?php
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

    if (isset($_POST['login'])) {
        header("Location: user.php");
    }
}
?>

<body>
    <form action="reset_pass.php" method="POST">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body shadow">
                    <h5 class="text-danger">Reset Password</h5>
                    <hr>
                    <input type="text" name="email" placeholder="Enter your email" class="form-control mb-5" required>
                    <input type="password" name="new_password" placeholder="Enter new password"
                        class="form-control mb-3" required>
                    <input type="password" name="confirm_password" placeholder="Confirm new password"
                        class="form-control mb-5" required>
                    <button type="submit" name="reset" class="btn btn-success">Reset Password</button>
                    <a href="user.php" class="btn btn-warning mx-5">Login Now</a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>