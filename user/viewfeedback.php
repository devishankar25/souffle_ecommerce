<?php 
session_start();
include 'config.php'; // Ensure database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user feedback securely
$sql = "SELECT f.id, f.feedback_text, f.created_at, u.full_name FROM feedback f 
        JOIN users u ON f.user_id = u.id 
        ORDER BY f.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - Soufflé Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Customer Feedback</h2>

        <?php if ($result->num_rows > 0) { ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-6 mb-4">
                        <div class="card p-3">
                            <h5><?php echo htmlspecialchars($row['full_name']); ?></h5>
                            <p><?php echo nl2br(htmlspecialchars($row['feedback_text'])); ?></p>
                            <small class="text-muted">Posted on <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></small>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-info text-center">No feedback available yet.</div>
        <?php } ?>

        <div class="text-center mt-3">
            <a href="main_page.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Main Page</a>
            <a href="add_feedback.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Feedback</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
