<?php
include('../includes/db.php'); // Include database connection
session_start();

$username = $_SESSION['username'];

$query = "SELECT user_id, fname, lname FROM `user` WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: User not found.");
}

$user_id = $user['user_id'];
$fullName = $user['fname'] . ' ' . $user['lname'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rating = intval($_POST['rating'] ?? 0);
    $feedback = trim($_POST['feedback'] ?? '');
    $image = $_FILES['image']['name'] ?? '';

    if (!$rating || !$feedback || !$image) {
        die("All fields are required.");
    }

    $target_file = "uploads/" . basename($image);
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Failed to upload image.");
    }

    $sql = "INSERT INTO feedbacks (user_id, name, rating, image, feedback) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiss", $user_id, $fullName, $rating, $image, $feedback);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
