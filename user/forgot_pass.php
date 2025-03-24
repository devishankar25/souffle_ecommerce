<?php
session_start();

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "souffle_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['verify'])) {
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email = ? AND contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['reset_email'] = $email;
        header("Location: reset_pass.php");
        exit();
    } else {
        $error_message = "Email and contact do not belong to the same user.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <form action="forgot_pass.php" method="POST">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body shadow">
                    <h5 class="text-danger">Check Account</h5>
                    <hr>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>
                    <input type="email" name="email" placeholder="Enter recovery email" class="form-control mb-5"
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