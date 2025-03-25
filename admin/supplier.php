<?php
include('../includes/db.php'); // Include database connection

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$get_admin = "SELECT * FROM  admin_signup' WHERE username = '$username'";
$result = $conn->query($get_admin);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_id = $row['admin_id'];

    if (isset($_POST['add_supplier'])) {
        $supplier_name = $_POST['supplier_name'];
        $email = $_POST['supplier_email'];
        $supplier_name = $conn->real_escape_string($supplier_name);
        $sql = "SELECT * FROM supplier WHERE supplier_name='$supplier_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<script>alert('Supplier already present')</script>";
        } else {
            $sql_insert = "INSERT INTO `supplier` (`admin_id`, `supplier_name`, `email`, `added_at`) 
                           VALUES ('$admin_id','$supplier_name', '$email', NOW())";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<script>alert('Supplier added successfully')</script>";
                exit();
            } else {
                echo "Error: " . $sql_insert . "<br>", $conn->error;
            }
        }
    }
}
?>

<body>
    <div class="container">
        <h3 class="text-center text-success mt-3 mb-3 m-auto">Insert Supplier</h3>
        <form action="" method="post" class="mb-2">
            <div class="input-group w-60 mb-2">
                <span class="input-group-text bg-light" id="basic-addon1">
                    <i class="fa-solid fa-table"></i>
                </span>
                <input type="text" class="form-control" placeholder="Insert Supplier"
                    name="supplier_name" aria-describedby="basic-addon1"
                    onkeydown="return /[a-zA-Z-]/.test(event.key)" autocomplete="off" required>
                <input type="email" class="form-control" placeholder="Insert Email"
                    name="supplier_email" aria-describedby="basic-addon1"
                    onkeydown="return /[a-zA-Z@.]/.test(event.key)" autocomplete="off" required>
            </div>
            <div class="input-group w-10 mb-2 m-auto">
                <button type="submit" class="p-2 my-2" name="add_supplier">Submit</button>
            </div>
        </form>
    </div>
</body>