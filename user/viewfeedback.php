<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souffle</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAlftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style1.css?v=<?= time(); ?>">
    <link rel="shortcut icon" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYI"
        crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        img.logoimg {
            width: 30%;
            height: 30%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        #feedbacks {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            padding: 40px 0;
        }

        .feedbacks-heading {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 0px;
        }

        .feedbacks-heading h1 {
            font-size: 30px;
            font-weight: 600;
            background-color: #357872;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .feedbacks-heading h1:hover {
            background-color: #153431;
            color: azure;
        }

        .feedbacks-heading span {
            font-size: 16px;
            ;
            color: #555;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .feedbacks-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            width: 100%;
            max-width: 1200px;
        }

        .feedbacks-box {
            width: 300px;
            height: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin: 15px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .feedbacks-box:hover {
            transform: translateY(-10px);
        }

        img {
            width: 100%;
            height: 50%;
            object-fit: cover;
            display: block;
        }

        .profile {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .name-user {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .name-user strong {
            font-size: 1.5rem;
            color: #333;
        }

        .reviews {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }

        .reviews i {
            color: #ffae00;
            font-size: 20px;
        }

        .client-comment {
            padding: 20px;
            text-align: left;
            font-size: 1.2rem;
            color: #555;
            height: auto;
            overflow: hidden;
        }

        /* Feedback Button Styles */
        #feedbackBtn {
            margin: 5px auto;
            padding: 15px 30px;
            background-color: #357872;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
            transition: background-color 0.3s ease-in-out;
        }

        #feedbackBtn:hover {
            background-color: #153431;
            color: azure
        }

        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .spaced-element {
            margin: 10px 0;
        }
    </style>
</head>

<body>

    <div class="centered-container">
        <section id="header" class="bg-light p-3 spaced-element">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="../index.php"><img src="../images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;"></a>
            </div>
        </section>

        <section id="feedbacks" class="mt-4 spaced-element">
            <div class="container">
                <div class="feedbacks-heading text-center">
                    <span>What People Say?</span>
                    <h1>Clients Say</h1>
                </div>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM feedbacks";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-4 col-sm-6 mb-4">
                                <div class="card">
                                    <img src="' . $row["image"] . '" class="card-img-top" alt="Client Image">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row["name"] . '</h5>
                                        <p class="card-text">' . $row["feedback"] . '</p>
                                    </div>
                                </div>
                              </div>';
                        }
                    } else {
                        echo "<h4 class='text-center text-danger'>No Reviews Yet</h4>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <center>
        <button id="feedbackBtn"><a href="add_feedback.php"><i class="fa fa-plus"></i> Add Feedback</a></button>
    </center>

</body>

</html>