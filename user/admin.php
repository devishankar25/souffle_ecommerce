<?php
include('../includes/db.php'); // Include database connection
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the admin already exists
    $check_admin = mysqli_query($conn, "SELECT * FROM `admin_signup` WHERE email = '$email'") or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($check_admin) == 0) {
        // Insert the admin into the database if not found
        $insert_admin = mysqli_query($conn, "INSERT INTO `admin_signup` (email, password, username) VALUES ('$email', '$pass', 'New Admin')") or die('Insert failed: ' . mysqli_error($conn));
        echo "<script>alert('Admin added to the database. Login successful.')</script>";
    } else {
        echo "<script>alert('Login successful')</script>";
    }

    // Set session and redirect
    $_SESSION['username'] = $email; // Using email as username for simplicity
    echo "<script>window.open('../admin/admin_home.php?dashboard','_self')</script>";
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url("Herbalife.jpg") center/cover no-repeat;
        }

        section {
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            /* Increased padding for better spacing */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 100%;
        }

        .spaced-element {
            margin: 15px 0;
            /* Increased margin for better spacing */
        }

        .admin_no {
            font-size: 18px;
            font-weight: 700;
            margin-top: 20px;
            /* Adjusted margin for better alignment */
        }

        input.btn {
            font-weight: 700;
            padding: 12px 25px;
            /* Adjusted padding for better button size */
            border: none;
            border-radius: 5px;
            background-color: seagreen;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        input.btn:hover {
            background-color: rgb(20, 67, 41);
        }

        a {
            color: darkgreen;
            text-decoration: none;
        }

        a:hover {
            color: darkblue;
            text-decoration: underline;
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
            /* Added spacing between input fields */
            width: 100%;
        }

        .inputbox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .inputbox label {
            position: absolute;
            top: -10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.95);
            padding: 0 5px;
            font-size: 14px;
            color: #555;
        }

        .forget {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
            /* Added spacing below */
        }
    </style>
</head>

<body>
    <section>
        <div class="form-box shadow-lg p-4 bg-light rounded spaced-element">
            <div class="form-value">
                <div class="popup text-center">
                    <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 50px;"></a>
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
                            <a href="main_page.php" class="admin text-danger"><i class="fa fa-arrow-left"></i> I am a User</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>