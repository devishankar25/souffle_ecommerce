<?php
session_start();
include './config.php'; // Database connection
if (!isset($_GET['token']) || empty($_GET['token'])) {
    die("Invalid request.");
}
$token = $_GET['token'];
$sql = "SELECT id FROM users WHERE reset_token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Invalid or expired token.");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $update_sql = "UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ss", $new_password, $token);
    $update_stmt->execute();
    if ($update_stmt->affected_rows > 0) {
        echo "<div class='alert alert-success'>Password reset successful! <a href='login.php'>Login</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong. Try again.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8f9fa; }
        .reset-container { max-width: 400px; margin: 100px auto; }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-container bg-white p-4 shadow rounded">
            <h3 class="text-center">Reset Password</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
