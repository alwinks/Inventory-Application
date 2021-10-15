<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
if (isset($_POST['order'])) {
    $user_id = $_SESSION['user_id'];
    $card_number = $_POST['card_number'];
    $card_cvc = $_POST['card_cvc'];
    // Validate user card details to place order
    $sql = "SELECT * FROM tbl_card WHERE card_number='$card_number' AND card_cvc='$card_cvc' AND user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("location: order_success.php");
    } else {
        echo '<script>alert("Incorrect card number or CVC!");</script>';
    }
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Place Order</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Enter Card Details</h3>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-material mx-2">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Card Number</label>
                            <div class="col-md-12">
                                <input required name="card_number" type="number" maxlength="12" placeholder="Enter card number" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">CVC</label>
                            <div class="col-md-12">
                                <input required name="card_cvc" type="password" maxlength="3" placeholder="Enter CVC" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 d-flex">
                                <?php
                                $user_id = $_SESSION['user_id'];
                                // Display sum of orders
                                $sql = "SELECT SUM(order_amount) AS total FROM tbl_order WHERE user_id='$user_id' AND order_status='Cart'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <button name="order" type="submit" class="btn btn-success mx-auto mx-md-0 text-white"><?php echo "Pay ₹" . $row['total']; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../config.php');
                                $user_id = $_SESSION['user_id'];
                                // Display order details
                                $sql = "SELECT tbl_product.product_name,tbl_product.product_img,tbl_product.product_desc,tbl_product.product_rate,tbl_order.order_quantity,tbl_order.order_amount FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_user.user_id='$user_id' AND order_status='Cart'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr><td>" . $row['product_name'] . "</td>";
                                        echo "<td><img src='../images/" . $row['product_img'] . "' height='50px'></td>";
                                        echo "<td>" . $row['product_desc'] . "</td>";
                                        echo "<td>₹" . $row['product_rate'] . "</td>";
                                        echo "<td>" . $row['order_quantity'] . "</td>";
                                        echo "<td>₹" . $row['order_amount'] . "</td></tr>";
                                    }
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
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>