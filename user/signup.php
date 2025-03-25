<?php
include('../includes/db.php');
include('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if ($password !== $cpassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $stmt = $conn->prepare("SELECT 1 FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists. Please use a different email.');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $user_ip = getClientIp();
            $stmt = $conn->prepare("INSERT INTO user (username, email, password, user_ip) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_ip);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
                echo "<script>window.location.href='user.php';</script>";
            } else {
                echo "<script>alert('Error: Unable to register.');</script>";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Souffle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url("Herbalife.jpg") no-repeat center center/cover;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-box img {
            max-height: 50px;
            margin-bottom: 20px;
        }

        .form-box h2 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-box .form-control {
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .form-box .btn {
            font-weight: 700;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: seagreen;
            color: white;
            cursor: pointer;
            width: 100%;
        }

        .form-box .btn:hover {
            background-color: rgb(20, 67, 41);
        }

        .form-box p {
            font-weight: 700;
            margin-top: 15px;
            text-align: center;
        }

        .form-box a {
            color: darkgreen;
            text-decoration: none;
        }

        .form-box a:hover {
            color: darkblue;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="form-box shadow-lg p-4 bg-light rounded centered-container">
                <div class="text-center mb-4">
                    <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
                </div>
                <form action="signup.php" method="POST">
                    <h2 class="text-center mb-4">Register</h2>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-3">Register Now</button>
                    <p class="text-center mt-3">Already have an account? <a href="user.php" class="text-decoration-none"><i class="fa fa-user"></i> Login</a></p>
                </form>
            </div>
        </div>
    </section>
</body>

</html>