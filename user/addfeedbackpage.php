<?php
include('../includes/db.php'); // Include database connection
session_start();

$username = $_SESSION['username'];

$query = "SELECT user_id FROM `user` WHERE username = '$username'"; // Corrected SQL syntax [cite: 1]

$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

$user_id = $user['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $rating = isset($_POST['rating']) ? $_POST['rating'] : null; // Check if rating is set [cite: 2]
    $image = $_FILES['image']['name'];
    $feedback = $_POST['feedback'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"],  $target_file);

    $select_name = "SELECT * FROM `user`";  // Corrected SQL syntax and added missing backtick [cite: 2]
    $result_name = $conn->query($select_name);
    $row = mysqli_fetch_assoc($result_name);

    $fullName = $row['fname'] . ' ' . $row['lname'];  // Assuming 'lname' is the last name field [cite: 2]

    $sql = "INSERT INTO feedbacks (user_id, name, rating, image, feedback) VALUES ('$user_id', '$fullName', '$rating', '$image', '$feedback')";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
