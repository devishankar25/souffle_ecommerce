<?php

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "SELECT * FROM user WHERE email = ? AND contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['reset_email'] = $email;
        header("Location: reset_pass.php");
        exit();
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Email and contact do not belong to the same user.</div>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title> </head>
<body>
    <form action="forgot_pass.php" method="POST">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body shadow">
                    <h5 class="text-danger">Check Account</h5>
                    <hr>
                    <input type="text" name="email" placeholder="Enter recovery email" class="form-control mb-5"
                           required>
                    <input type="tel" name="contact" placeholder="Enter your contact" class="form-control mb-5"
                           required>
                    <button type="submit" name="verify" class="btn btn-success">Verify</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>