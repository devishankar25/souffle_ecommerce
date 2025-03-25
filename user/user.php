<?php
include('../includes/db.php'); // Include database connection
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user already exists
    $check_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($check_user) == 0) {
        // Insert the user into the database if not found
        $insert_user = mysqli_query($conn, "INSERT INTO `user` (email, password, username) VALUES ('$email', '$pass', 'New User')") or die('Insert failed: ' . mysqli_error($conn));
        echo "<script>alert('User added to the database. Login successful.')</script>";
    } else {
        echo "<script>alert('Login successful')</script>";
    }

    // Set session and redirect
    $_SESSION['username'] = $email; // Using email as username for simplicity
    echo "<script>window.open('profile.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souffle</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="userlogin.css">
    <link rel="shortcut icon" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
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

        .form-box .d-flex {
            width: 100%;
            justify-content: space-between;
            align-items: center;
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
                <form action="user.php" method="post">
                    <h2 class="text-center mb-4">Login</h2>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe">Remember Me</label>
                        </div>
                        <a href="forgot_pass.php" class="text-decoration-none"><i class="fa fa-key"></i> Forgot Password?</a>
                    </div>
                    <button type="submit" name="login" class="btn btn-success w-100 mt-3">Login Now</button>
                    <p class="text-center mt-3">Don't have an account? <a href="signup.php" class="text-decoration-none"><i class="fa fa-user-plus"></i> Register now</a></p>
                </form>
            </div>
        </div>
    </section>
</body>

</html>