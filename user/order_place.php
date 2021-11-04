<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$user_id = $_SESSION['user_id'];
if (isset($_POST['order'])) {
    $card_number = $_POST['card_number'];
    $card_cvc = $_POST['card_cvc'];
    $obj->card_validate($card_number, $card_cvc, $user_id); // Validate card while placing order
    $result = $obj->dbexecute(); // Execute query
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
                                $obj->cart_total($user_id); // Display total amount of orders
                                $result = $obj->dbexecute(); // Execute query
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
                                $obj->cart_display($user_id); // Display cart
                                $result = $obj->dbexecute(); // Execute query
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr><td>" . $row['product_name'] . "</td>";
                                        echo "<td><img src='../assets/images/" . $row['product_img'] . "' height='50px'></td>";
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