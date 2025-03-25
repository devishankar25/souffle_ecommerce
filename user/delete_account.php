<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../includes/db.php');

if (!isset($_SESSION['username'])) {
    echo "<script>alert('You must be logged in to delete your account.');</script>";
    echo "<script>window.location.href = 'profile.php';</script>";
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $conn->prepare("DELETE FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    if ($query->execute()) {
        session_destroy();
        echo "<script>alert('Your account has been deleted successfully.');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete your account. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center text-danger">Delete Account</h2>
        <p class="text-center">Are you sure you want to delete your account? This action cannot be undone.</p>
        <form method="POST" class="text-center">
            <button type="submit" class="btn btn-danger">Yes, Delete My Account</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>