<?php

session_start();

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "souffle_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $select = mysqli_query($conn, "SELECT * FROM admin_signup WHERE email = '$email' AND password = '$pass'") or die('Query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['username'] = $row['username'];

        echo "<script>alert('Login successful')</script>";
        echo "<script>window.open('admin_home.php?dashboard','_self')</script>";
        //header('location: profile.php'); // Note: corrected header location
    } else {
        echo "<script>alert('Incorrect Email or Password')</script>";
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souffle</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="userlogin.css">
    <link rel="shortcut icon" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
            crossorigin="anonymous"></script>

    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }

        section {
            background: url("Herbalife.jpg");
            background-position: center;
            background-size: cover;
            position: fixed;
        }

        .admin_no {
            font-size: 20px;
            font-weight: 700;
            margin-top: 10px;
            margin-left: 30px;
            border-radius: 20px;
        }

        a.admin:hover {
            color: green;
        }

        input.btn {
            font-weight: 700;
            margin-left: 85px;
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
            margin-top: 10px;
            margin-left: 55px;
        }

        a {
            color: darkgreen;
            margin-left: 65px;
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
                <form action="admin.php" method="post">
                    <h2>Admin Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" 
                               onkeydown="return /[a-zA-Z0-9@.]/i.test(event.key)" 
                               autocomplete="off" required>
                        <label>Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" minlength="8" maxlength="15" required><br>
                        <label>Password</label>
                    </div>
                    <div class="forget">
                        <label><input type="checkbox">Remember Me <a href="#">Forgot Password</a></label>
                    </div>
                    <div class="form-outline">
                        <input type="submit" value="Login Now" name="login" class="btn">
                    </div>
                    <div class="admin_no text-danger bg-light">
                        <a href="user/main_page.php" class="admin text-danger">I am a User</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>