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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
            /* Light blue background */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #ffffff;
            /* White card background */
            border-radius: 10px;
        }

        h5 {
            color: #007bff;
            /* Cool blue heading */
        }

        .btn-success {
            background-color: #28a745;
            /* Green button */
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        .form-control {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <form action="forgot_pass.php" method="POST">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body shadow">
                    <h5 class="text-center">Account Recovery</h5>
                    <hr>
                    <input type="text" name="email" placeholder="Enter recovery email" class="form-control mb-4" required>
                    <input type="tel" name="contact" placeholder="Enter your contact" class="form-control mb-4" required>
                    <button type="submit" name="verify" class="btn btn-success w-100">Verify</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>