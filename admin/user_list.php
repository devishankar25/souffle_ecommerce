<body>
<?php
$get_user = "SELECT * FROM `user`";
$result = $conn->query($get_user);
if($result){
    echo "
    <h3 class='text-center text-success mx-5'>Users List</h3>
    <table class='table table-bordered mt-3 mx-5'>
        <thead class='text-center'>
            <tr>
                <th>Sr. No.</th>
                <th>User Id</th>
                <th>User IP Address</th>
                <th>Username</th>
                <th>User Email</th>
                <th>User Contact</th>
            </tr>
        </thead>
        <tbody class='text-center'>";
    if($result->num_rows>0){
        $sr_no = 0;
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            $user_ip = getClientIp();  // Assuming getClientIp() is a defined function
            $username = $row['username'];
            $email = $row['email'];
            $contact = $row['contact'];
            $sr_no++;
            echo "
            <tr class='text-center'>
                <td>$sr_no</td>
                <td>$user_id</td>
                <td>$user_ip</td>
                <td>$username</td>
                <td>$email</td>
                <td>$contact</td>
            </tr>";
        }
        echo "
        </tbody>
    </table>";
    }
    else{
        echo "<h3 class='text-danger mt-3'>No payments yet</h2>";
    }
}
else{
    echo "<h3 class='text-center text-danger mt-5 mx-5'>No User Yet</h3>";
}
?>
</body>