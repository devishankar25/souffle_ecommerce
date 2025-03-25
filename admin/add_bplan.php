<?php
include('../includes/db.php'); // Include database connection
$totalPrice = 0;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM `admin_signup` WHERE username = ?"); // Added backticks
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admin_id = $row['admin_id'];
        if (isset($_POST['add_plan'])) {
            $plan_name = $_POST['plan_name'];
            $pro_category = $_POST['pro_name'];
            $pro_brand = $_POST['pro_names'];
            $product = $_POST['pro3_names'];
            $stmt = $conn->prepare("SELECT pro_price FROM `products` WHERE pro_id IN (?,?,?)"); // Added backticks
            $stmt->bind_param("iii", $pro_category, $pro_brand, $product);  // corrected bind_param type
            $stmt->execute();
            $price_result = $stmt->get_result();
            while ($price_row = $price_result->fetch_assoc()) {
                $totalPrice += $price_row['pro_price'];
            }
            $stmt = $conn->prepare("INSERT INTO `plan` (`admin_id`,`plan_name`, `pro1_id`, `pro2_id`, `pro3_id`, `plan_price`) VALUES(?, ?, ?, ?, ?, ?)");  // Added backticks
            $stmt->bind_param("isiiid", $admin_id, $plan_name, $pro_category, $pro_brand, $product, $totalPrice);
            $result = $stmt->execute();
            if ($result) {
                echo "<script>alert('Added plan successfully')</script>";
                echo "<script>window.open('admin_home.php?view_bplan','_self')</script>";
            } else {
                echo "Error " . $stmt->error;
            }
        }
    } else {
        echo "<script>alert('Session not set')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Basic Plans</title>
</head>

<body>
    <h3 class="text-center text-success mt-5">
        <strong>Add Basic Plans</strong>
    </h3>
    <form action="" method="post" class="mb-2" enctype="multipart/form-data">
        <div class="container text-center m-auto mt-3">
            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light mt-3" id="basic-addon1"><i
                        class="fa-solid fa-id-card-clip"></i>
                    <label for="plan_name" class="form-label m-auto mx-2">Plan
                        Name</label></span>
                <input type="text" class="form-control mt-3" placeholder="Plan Name" name="plan_name"
                    aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9\s]/i.test(event.key)" // Added escape character for space
                    autocomplete="off" required>
            </div>

            <div class="input-group mb-2 m-auto">
                <select name="pro_name" id="pro_name" class="form-select m-2 mb-2 my-3 w-50"> // Added id
                    <option value="">Select Product 1</option>
                    <?php
                    $select = "SELECT * FROM `products`";  // Added backticks
                    $result = $conn->query($select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $pro_name = $row['pro_name'];
                            $pro_id = $row['pro_id'];
                            echo "<option value='$pro_id'>$pro_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="input-group mb-2 m-auto">
                <select name="pro_names" id="pro_names" class="form-select m-2 mb-2 my-3 w-50"> // Added id
                    <option value="">Select Product 2</option>
                    <?php
                    $query = "SELECT * FROM `products`";  // Added backticks
                    $result_query = $conn->query($query);
                    if ($result_query) {
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $pro_name = $row['pro_name'];
                            $pro_id = $row['pro_id'];
                            echo "<option value='$pro_id'>$pro_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="input-group mb-2 m-auto">
                <select name="pro3_names" id="pro3_names" class="form-select m-2 mb-2 my-3 w-50"> // Added id
                    <option value="">Select Product 3</option>
                    <?php
                    $select_query = "SELECT * FROM `products`";  // Added backticks
                    $result_select_query = $conn->query($select_query);
                    if ($result_select_query) {
                        while ($row = mysqli_fetch_assoc($result_select_query)) {
                            $pro_name = $row['pro_name'];
                            $pro_id = $row['pro_id'];
                            echo "<option value='$pro_id'>$pro_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="input-group text-center w-10 mb-2 m-auto">
                <button type="submit" class="p-2 my-2 m-auto text-center" name="add_plan">Add
                    Plan</button>
            </div>
        </div>
    </form>
</body>

</html>