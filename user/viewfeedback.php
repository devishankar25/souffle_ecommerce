<?php
include('../includes/db.php');
include('../includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Feedback - Souffle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100,200,300,400,500,600,700,800,900&display=swap');

    body {
        font-family: 'Spartan', sans-serif;
        background-color: #e3f2fd;
        color: #333;
        line-height: 1.6;
    }

    .navbar {
        background-color: #0288d1;
    }

    .navbar .nav-link {
            color: white !important;
        }

    .navbar .nav-link:hover {
            color: #b3e5fc !important;
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
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="../index.php" class="navbar-brand">
            <img src="../images/logo.png" alt="Logo" style="max-height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="profile.php" class="nav-link"><i class="far fa-user"></i></a></li>
                <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="product.php" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="viewplan.php" class="nav-link">Plans</a></li>
                <li class="nav-item"><a href="viewfeedback.php" class="nav-link">Reviews</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link d-flex align-items-center">
                        <i class="fas fa-shopping-cart me-1"></i>
                        <sup><?php echo cart_item($conn); ?></sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wishlist.php" class="nav-link"><i class="far fa-heart"></i></a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Total: <?php echo total($conn); ?> /-</a></li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
<section id="feedbacks" class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <span class="text-primary fw-bold">What People Say?</span>
            <h1 class="fw-bold text-dark">Clients Say</h1>
        </div>
        <div class="text-center mb-4">
            <a href="add_feedback.php" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle"></i> Add Feedback
            </a>
        </div>
        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM feedbacks";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6 col-lg-4">';
                    echo '<div class="card shadow-sm border-0">';
                    echo '<img src="' . htmlspecialchars($row["image"]) . '" class="card-img-top rounded-top" alt="Client Image">';
                    echo '<div class="card-body text-center">';
                    echo '<h5 class="card-title fw-bold text-primary">' . htmlspecialchars($row["name"]) . '</h5>';
                    echo '<div class="reviews mb-2">';
                    for ($i = 0; $i < 5; $i++) {
                        echo '<i class="fas fa-star' . ($row["rating"] > $i ? ' text-warning' : ' text-muted') . '"></i>';
                    }
                    echo '</div>';
                    echo '<p class="card-text text-muted">' . htmlspecialchars($row["feedback"]) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<h4 class='text-center text-danger'>No Reviews Yet</h4>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>