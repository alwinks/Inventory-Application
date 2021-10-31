<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$user_id = $_SESSION['user_id'];
// Update cart as stock * quantity = amount
$sql = "UPDATE tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id SET tbl_order.order_amount=tbl_order.order_quantity*tbl_product.product_rate WHERE user_id='$user_id'";
mysqli_query($conn, $sql);
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
                            include('../config.php');
                            $user_id = $_SESSION['user_id'];
                            // Display cart
                            $sql1 = "SELECT tbl_product.product_name,tbl_product.product_img,tbl_product.product_desc,tbl_product.product_rate,tbl_order.order_id,tbl_order.order_quantity,tbl_order.order_amount FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_user.user_id='$user_id' AND order_status='Cart'";
                            $result = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['product_name'] . "</td>";
                                    echo "<td><img src='../images/" . $row['product_img'] . "' height='50px'></td>";
                                    echo "<td>" . $row['product_desc'] . "</td>";
                                    echo "<td>₹" . $row['product_rate'] . "</td>";
                                    echo "<td><a href='order_quantity_increase.php?order_id=" . $row['order_id'] . "'>+&emsp;</a>" . $row['order_quantity'] . "<a href='order_quantity_decrease.php?order_id=" . $row['order_id'] . "'>&emsp;-</a></td>";
                                    echo "<td>₹" . $row['order_amount'] . "</td>";
                                    echo "<td>";
                                    echo "<a class='text-danger' href='cart_remove.php?order_id=" . $row['order_id'] . "' data-toggle='tooltip'>Remove</a>";
                                    echo "</td></tr>";
                                }
                                echo "<tr><td><b>Total</b></td><td></td><td></td><td></td><td></td><td>";
                                // Display sum of orders
                                $sql = "SELECT SUM(order_amount) AS total FROM tbl_order WHERE user_id='$user_id' AND order_status='Cart'";
                                $result = mysqli_query($conn, $sql);
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