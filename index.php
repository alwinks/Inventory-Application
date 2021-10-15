<?php
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
                <h4 class="card-title">Products</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Image</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Rate</th>
                                <th class="border-top-0">Stock</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display products
                            include('config.php');
                            $sql = "SELECT * FROM tbl_product";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['product_name'] . "</td>";
                                    echo "<td><img src='images/" . $row['product_img'] . "' height='50px'></td>";
                                    echo "<td>" . $row['product_desc'] . "</td>";
                                    echo "<td>₹" . $row['product_rate'] . "</td>";
                                    echo "<td>" . $row['product_stock'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='user/cart.php?product_id=" . $row['product_id'] . "'>Add to Cart</a>&emsp;";
                                    echo "</td></tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
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