<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in as an admin to access this page.');</script>";
    echo "<script>window.location.href = 'admin.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3IHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcldsIK1eN7N6jleHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard_slidebar {
            width: 20%;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            color: white;
            overflow-y: auto;
        }

        .dashboard_content_container {
            margin-left: 20%;
            width: 80%;
            padding: 20px;
        }

        .dashboard_slidebar_menu ul {
            list-style: none;
            padding: 0;
        }

        .dashboard_slidebar_menu ul li {
            padding: 10px;
            cursor: pointer;
        }

        .dashboard_slidebar_menu ul li a {
            color: white;
            text-decoration: none;
        }

        .dashboard_slidebar_menu ul li a:hover {
            color: #17a2b8;
        }

        .subMenus {
            display: none;
            padding-left: 20px;
        }

        .subMenus a {
            display: block;
            padding: 5px 0;
        }

        .dashboard_topnav {
            background-color: #343a40;
            color: white;
            padding: 10px;
        }

        .dashboard_topnav a {
            color: white;
            text-decoration: none;
        }

        .dashboard_topnav a:hover {
            color: #17a2b8;
        }
    </style>
</head>

<body>
    <div class="bg-light">
        <h3 class="text-center p-2">Admin Dashboard</h3>
    </div>

    <div id="dashboardContainer">
        <!-- Sidebar -->
        <div class="dashboard_slidebar bg-secondary" id="dashboard_slidebar">
            <div class="image text-center mt-2">
                <h3 class="dashboard_logo">
                    <img src="logo.png" alt="Logo" class="logo">
                </h3>
                <span class="dashboard_text text-center text-success">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<p>Welcome Guest</p>";
                    } else {
                        echo "<p>Welcome " . htmlspecialchars($_SESSION['username']) . "</p>";
                    }
                    ?>
                </span>
            </div>

            <div class="dashboard_slidebar_menu">
                <ul class="dashboard_list">
                    <li>
                        <a href="admin_home.php?dashboard">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?add_trainer">
                            <i class="fa fa-user-tie"></i> Add Trainer
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?trainers_list">
                            <i class="fa fa-users"></i> View Trainers
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?add_products">
                            <i class="fa fa-box"></i> Add Products
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?view_products">
                            <i class="fa fa-boxes"></i> View Products
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?all_orders">
                            <i class="fa fa-shopping-cart"></i> View Orders
                        </a>
                    </li>
                    <li>
                        <a href="admin_home.php?all_users">
                            <i class="fa fa-user"></i> View Users
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="dashboard_content_container" id="dashboard_content_container">
            <div class="dashboard_topnav">
                <a href="#" id="toggleBtn">
                    <i class="fa fa-bars"></i> Toggle Sidebar
                </a>
            </div>

            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <?php
                    if (isset($_GET['dashboard'])) {
                        include('dashboard.php');
                    }
                    if (isset($_GET['add_trainer'])) {
                        include('add_trainer.php');
                    }
                    if (isset($_GET['trainers_list'])) {
                        include('trainers_list.php');
                    }
                    if (isset($_GET['add_products'])) {
                        include('add_products.php');
                    }
                    if (isset($_GET['view_products'])) {
                        include('view_products.php');
                    }
                    if (isset($_GET['all_orders'])) {
                        include('all_orders.php');
                    }
                    if (isset($_GET['all_users'])) {
                        include('all_users.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('dashboard_slidebar');
        const contentContainer = document.getElementById('dashboard_content_container');

        toggleBtn.addEventListener('click', () => {
            if (sidebar.style.width === '20%') {
                sidebar.style.width = '8%';
                contentContainer.style.marginLeft = '8%';
                contentContainer.style.width = '92%';
            } else {
                sidebar.style.width = '20%';
                contentContainer.style.marginLeft = '20%';
                contentContainer.style.width = '80%';
            }
        });
    </script>
</body>

</html>