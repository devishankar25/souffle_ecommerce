<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            /* Simplified font */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: #f8f9fa;
            /* Neutral background color */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            max-width: 400px;
            border-radius: 5px;
            padding: 20px;
            background-color: #ffffff;
            /* Simple white background */
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        button.btn {
            font-size: 1.25rem;
            /* Reduced font size */
            font-weight: 500;
            margin: 10px;
            border: 1px solid #6c757d;
            /* Neutral border */
            background-color: #ffffff;
            /* White background for buttons */
            color: #6c757d;
            /* Neutral text color */
            border-radius: 5px;
        }

        button.btn:hover {
            background: #e9ecef;
            /* Light gray hover effect */
            color: #495057;
            /* Slightly darker text on hover */
            font-weight: 600;
        }

        .container-fluid img.logo {
            width: 8vh;
            height: 8vh;
            object-fit: contain;
        }

        .container-fluid {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            color: #495057;
            /* Neutral text color */
        }

        .fa {
            margin-right: 10px;
        }

        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .spaced-element {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="centered-container">
        <nav class="navbar navbar-light bg-light w-100 spaced-element">
            <div class="container-fluid d-flex flex-column align-items-center">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="logo d-inline-block align-text-top" /></a>
                <span class="text-success" style="color: #495057;"><i class="fa fa-leaf"></i>Welcome to Souffle</span>
            </div>
        </nav>

        <div class="container shadow-sm p-3 mb-5 bg-light rounded spaced-element">
            <a href="admin.php">
                <button type="button" class="btn btn-lg w-100"><i class="fa fa-user-shield"></i> ADMIN</button>
            </a>
            <a href="user.php">
                <button type="button" class="btn btn-lg w-100"><i class="fa fa-user"></i> USER</button>
            </a>
        </div>
    </div>
</body>

</html>