<?php
include('../includes/db.php');
include('../includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Feedback - Souffle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Spartan', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar .navbar-brand img {
            max-height: 50px;
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #d1ecf1;
        }

        .page-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .btn-add-feedback {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 15px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-add-feedback:hover {
            background-color: #357a38;
        }

        .feedback-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feedback-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .feedback-heading h2 {
            color: #4CAF50;
            font-size: 1.5rem;
        }

        .feedback-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .feedback-card {
            flex: 0 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 15px;
        }

        .feedback-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .feedback-card h5 {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .feedback-card p {
            font-size: 0.9rem;
            color: #555;
        }

        @media (max-width: 768px) {
            .feedback-card {
                flex: 0 0 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .feedback-card {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

<?php include('../includes/navbar.php'); ?>

    
    <div class="page-header">
        <h1>Client Feedback</h1>
    </div>

    <div class="feedback-container">
        <div class="feedback-heading">
            <h2>What Our Clients Say</h2>
            <a href="add_feedback.php" class="btn btn-add-feedback"><i class="fa fa-plus"></i> Add Feedback</a>
        </div>
        <div class="feedback-list">
            <?php
            $result = $conn->query("SELECT * FROM feedbacks");

            while ($row = $result->fetch_assoc()) {
                echo '<div class="feedback-card">
                        <img src="' . htmlspecialchars($row["image"]) . '" alt="Client Image">
                        <h5>' . htmlspecialchars($row["name"]) . '</h5>
                        <p>' . htmlspecialchars($row["feedback"]) . '</p>
                      </div>';
            }

            if ($result->num_rows === 0) {
                echo "<p class='text-center text-danger'>No feedback available yet.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz" crossorigin="anonymous"></script>
</body>

</html>