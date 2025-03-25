<?php
include('../includes/db.php'); // Include database connection
include('includes/functions.php');  // Added semicolon

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = ($_POST["cpassword"]);

    $user_ip = getClientIp();

    $checkEmailQuery = "SELECT * FROM user WHERE email='$email'"; // Added * to select all columns [cite: 2]
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>"; // Corrected the missing closing tag for script [cite: 3]
    } else if ($password != $cpassword) {
        echo "<script>alert('Password does not match with Confirm Password')</script>"; // Corrected the spelling of "does not" [cite: 4]
    } else {
        $sql = "INSERT INTO user(username, email, password, user_ip) VALUES ('$username', '$email', '$password', '$user_ip')";
        $sql_execute = $conn->query($sql);
    }
}

?>

<?php
getClientIP();  // This function call seems out of place, might belong elsewhere
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        section {
            background: url("Herbalife.jpg");
            background-position: center;
            background-size: cover;
            position: fixed;
        }
    </style>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <div class="popup text-center">
                    <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 50px;"></a>
                    <form action="user_signup.php" method="post">
                        <h2>Register</h2>
                        <div class="inputbox">
                            <ion-icon name="user-outline"></ion-icon>
                            <input type="text" name="username"
                                onkeydown="return /^[a-zA-Z0-9@.]+$/i.test(event.key)" // corrected regex and added return [cite: 7]
                                autocomplete="off" required>
                            <label>Username</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" name="email"
                                onkeydown="return /^[a-zA-Z0-9@.]+$/i.test(event.key)" // corrected regex and added return [cite: 7]
                                autocomplete="off" required>
                            <label>Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="password" minlength="8"
                                maxlength="15"
                                autocomplete="off" required><br>
                            <label>Password</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="cpassword" minlength="8" maxlength="15"
                                autocomplete="off" required><br>
                            <label>Confirm Password</label>
                        </div>
                        <div class="form-outline">
                            <input type="submit" value="Create" name="submit" class="btn">
                            <style>
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
                                    margin-top: 10px;
                                }

                                a {
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
                            <p>Already have an account?</p>
                            <a href="user.php">login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>