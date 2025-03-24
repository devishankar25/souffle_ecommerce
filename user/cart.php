<?php

$get_ip = getClientIP();
$total = 0;
$sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
$result = $conn->query($sql);
$result_count = mysqli_num_rows($result);
?>

<body <section id="page">

    <h2>My Cart</h2>

    </section>

    <section id="product1" class="section-p1">

        <div class="container">

            <div class="row">

                <form action="" method="post">

                    <table class="table table-bordered">

                        <?php
                        if ($result_count > 0) {
                            echo "
        <h4>Products</h4>
        <h5>which you choosed</h5>
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
                <th>Remove</th>
                <th colspan='2'>Operations</th>
            </tr>
        </thead>
        <tbody>";

                            while ($row = mysqli_fetch_array($result)) {
                                $pro_id = $row['pro_id'];
                                $get_price = "SELECT * FROM `products` WHERE pro_id='$pro_id'";
                                $result_products = $conn->query($get_price);

                                while ($row_products = mysqli_fetch_array($result_products)) {
                                    $pro_price = array($row_products['pro_price']);
                                    $pro_name = $row_products['pro_name'];
                                    $pro_image = $row_products['pro_image'];
                                    $pro_price_sum = array_sum($pro_price);
                                    $total = $total + $pro_price_sum;
                                    ?>

                                    <tr>
                                        <td><?php echo $pro_id ?></td>
                                        <td><img src="./product_images/<?php echo $pro_image ?>" alt="" class="cart_img">
                                        </td>
                                        <td><?php echo $pro_name ?></td>
                                        <td>
                                            <input type="text" name="qty"
                                                   value="<?php $get_quantity = "SELECT * FROM `cart` WHERE pro_id='$pro_id'";
                                                   $result_qty = $conn->query($get_quantity);
                                                   $row_qty = mysqli_fetch_array($result_qty);
                                                   echo $row_qty['quantity']; ?>">
                                            <style>input {
                                                    width: 30%;
                                                }</style>
                                            <?php
                                            $get_ip = getClientIP();
                                            if (isset($_POST['update_cart'])) {
                                                $quantities = $_POST['qty'];
                                                $update_cart = "UPDATE `cart` SET quantity=$quantities WHERE ip_address='$get_ip'";
                                                $result_update = $conn->query($update_cart);
                                                $total = $total + $quantities;
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row_products['pro_price'] ?></td>
                                        <td>
                                            <input type="checkbox" name="remove_item" id=""
                                                   value="<?php echo $pro_id ?>">
                                            </td>
                                        </tr>
                                    <style>
                                        img.cart_img {
                                            width: 80px;
                                            height: 80px
                                        }
                                    </style>
                                    <?php
                                }
                            }
                        } else {
                            echo "<h4 class='text-center text-danger'>No products in Cart</h4>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    $get_ip = getClientIP();
                    $cart_query = "SELECT * FROM `cart` WHERE ip_address= '$get_ip'";
                    $result_query = $conn->query($cart_query);
                    $result_counts = mysqli_num_rows($result_query);
                    if ($result_counts > 0) {
                        echo "
    <div class='total d-flex'>
        <h4>Total: $total /- </h4>
        <input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'>
        <button class='btn'><a href='checkout.php'>Checkout</a></button>
    </div>";
                    } else {
                        echo "
    <div class='total d-flex'>
        <input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'>
        <style>
            input.btn {
                margin-left: 10px;
                font-size: 20px;
                background-color: #6aa6a2;
                padding: 5px;
                border-radius: 5px;
                border: none;
                font-weight: 700;
                width: auto;
            }

            button.btn:hover {
                background-color: azure;
            }
        </style>
    </div>";
                    }
                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.open('product.php','_self')</script>";
                    } ?>
                </form>
            </div>
        </div>
    </section>
    </body>

    </html>