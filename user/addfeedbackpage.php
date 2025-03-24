<?php
session_start();
require_once 'db.php'; // Ensure you include your database connection file

if (!isset($_SESSION['username'])) {
    die("User not logged in.");
}

$username = $_SESSION['username'];

// Fetch user_id for the logged-in user
$query = "SELECT user_id, fname, lname FROM `user` WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id'];
$fullName = $user['fname'] . ' ' . $user['lname'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : '';

    // Handle file upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            die("Failed to upload image.");
        }
    }

    // Insert feedback into the database
    $sql = "INSERT INTO feedbacks (user_id, name, rating, image, feedback) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiss", $user_id, $fullName, $rating, $image, $feedback);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>