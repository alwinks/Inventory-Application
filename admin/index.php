<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("Location: ../admin.php");
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Home</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Orders</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Image</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Quantity</th>
                                <th class="border-top-0">Amount</th>
                                <th class="border-top-0">Ordered by</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT tbl_product.product_name,tbl_product.product_img,tbl_product.product_desc,tbl_order.order_quantity,tbl_order.order_amount,tbl_user.user_username FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_order.order_status='Success'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['product_name'] . "</td>";
                                    echo "<td><img src='../images/" . $row['product_img'] . "' height='50px'></td>";
                                    echo "<td>" . $row['product_desc'] . "</td>";
                                    echo "<td>" . $row['order_quantity'] . "</td>";
                                    echo "<td>₹" . $row['order_amount'] . "</td>";
                                    echo "<td>" . $row['user_username'] . "</td>";
                                    echo "</tr>";
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
<!-- End Container fluid  -->
<?php
include("footer.php");
?>