<?php
include('../includes/functions.php'); // Correct path to the functions.php file
include('../includes/db.php'); // Ensure database connection is included

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $cpassword = htmlspecialchars(trim($_POST["cpassword"]));
    $user_ip = getClientIP();

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM user WHERE email=?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else if ($password != $cpassword) {
        echo "<script>alert('Password does not match with Confirm Password');</script>";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $sql = "INSERT INTO user (username, email, password, user_ip) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_ip);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!');</script>";
            echo "<script>window.location.href = 'user.php';</script>"; // Redirect to login page
        } else {
            echo "<script>alert('Error: Could not register user.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
    <style>
        section {
            background: url("Herbalife.jpg");
            background-position: center;
            background-size: cover;
            position: fixed;
        }

        input.btn {
            font-weight: 700;
            margin-left: 120px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: seagreen;
            color: darkgreen;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            background-color: azure;
        }

        input.btn:hover {
            background-color: rgb(20, 67, 41);
            color: azure;
        }

        p {
            font-weight: 700;
        }

        a {
            margin-top: 10px;
            margin-left: 40px;
            color: darkgreen;
            margin-left: 130px;
            text-decoration: none;
        }

        a:hover {
            color: darkblue;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <div class="popup">
                    <form action="signup.php" method="post">
                        <h2>Register</h2>
                        <div class="inputbox">
                            <ion-icon name="user-outline"></ion-icon>
                            <input type="text" name="username" autocomplete="off" required>
                            <label>Username</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" name="email" autocomplete="off" required>
                            <label>Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="password" minlength="8" maxlength="15" autocomplete="off"
                                required>
                            <label>Password</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="cpassword" minlength="8" maxlength="15" autocomplete="off"
                                required>
                            <label>Confirm Password</label>
                        </div>
                        <div class="form-outline">
                            <input type="submit" value="Create" name="submit" class="btn">
                            <p>Already have an account?</p>
                            <a href="user.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>