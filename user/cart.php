<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$user_id = $_SESSION['user_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->cart_refresh($user_id); // Refresh cart as amount=quantity*rate
$obj->dbexecute(); // Execute query
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Cart</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cart</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Image</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Rate</th>
                                <th class="border-top-0">Quantity</th>
                                <th class="border-top-0">Amount</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $obj->cart_display($user_id); // Display cart
                            $result = $obj->dbexecute(); // Execute query
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['product_name'] . "</td>";
                                    echo "<td><img src='../assets/images/" . $row['product_img'] . "' height='50px'></td>";
                                    echo "<td>" . $row['product_desc'] . "</td>";
                                    echo "<td>₹" . $row['product_rate'] . "</td>";
                                    echo "<td><a href='order_quantity_increase.php?order_id=" . $row['order_id'] . "'>+&emsp;</a>" . $row['order_quantity'] . "<a href='order_quantity_decrease.php?order_id=" . $row['order_id'] . "'>&emsp;-</a></td>";
                                    echo "<td>₹" . $row['order_amount'] . "</td>";
                                    echo "<td>";
                                    echo "<a class='text-danger' href='cart_remove.php?order_id=" . $row['order_id'] . "' data-toggle='tooltip'>Remove</a>";
                                    echo "</td></tr>";
                                }
                                echo "<tr><td><b>Total</b></td><td></td><td></td><td></td><td></td><td>";
                                $obj->cart_total($user_id); // Display total amount of orders
                                $result = $obj->dbexecute(); // Execute query
                                $row = mysqli_fetch_assoc($result);
                                echo "<b>₹" . $row['total'] . "</b>";
                                echo "</td><td><a href='order_place.php' class='btn btn-success text-white'>Place Order</a></td></tr>";
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>