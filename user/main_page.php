<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
            integrity="sha384-KJ3o2DKtlkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGIRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYI"
            crossorigin="anonymous"></script>
    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }

        button.btn {
            font-size: 30px;
            font-weight: 500;
            margin-left: 20px;
            border: none;
        }

        button.btn:hover {
            background: rgb(152, 194, 194);
            color: darkblue;
            font-weight: 900;
        }

        .container {
            display: flex;
            flex-direction: row; /* corrected typo */
            align-items: center;
            justify-content: center;
            margin-top: 200px;
            height: auto;
            width: 400px;
            border-radius: 5px;
            padding: 20px;
        }

        .container-fluid img.logo {
            width: 10vh;
            height: 10vh;
            object-fit: contain;
        }

        .container-fluid {
            font-size: 20px;
            font-weight: 700;
        }

        a.a {
            text-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <img src="logo.png" alt="Logo" class="logo d-inline-block align-text-top"/>
            <span class="text-success">Welcome to Souffle</span>
        </div>
    </nav>
    <div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <a href="../admin/admin.php">
            <button type="button" class="btn btn-success btn-lg">ADMIN</button>
        </a>
        <a href="user.php">
            <button type="button" class="btn btn-danger btn-lg">USER</button>
        </a>
    </div>
</body>
</html>