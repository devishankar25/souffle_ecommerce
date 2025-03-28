<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success_message = "";
$error_message = "";

// Handle feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback_text = trim($_POST['feedback_text']);

    if (!empty($feedback_text)) {
        $sql = "INSERT INTO feedback (user_id, feedback_text, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $feedback_text);

        if ($stmt->execute()) {
            $success_message = "Thank you for your feedback!";
        } else {
            $error_message = "Error submitting feedback. Please try again.";
        }
    } else {
        $error_message = "Feedback cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Feedback</h2>

        <?php if ($success_message) { ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php } elseif ($error_message) { ?>
            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST" action="add_feedback.php" class="mx-auto mt-4" style="max-width: 500px;">
            <div class="mb-3">
                <label for="feedback_text" class="form-label">Your Feedback</label>
                <textarea name="feedback_text" id="feedback_text" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
            <a href="viewfeedback.php" class="btn btn-warning">View Feedback</a>
            <a href="main_page.php" class="btn btn-secondary">Back to Main Page</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
