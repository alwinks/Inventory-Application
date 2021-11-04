<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
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
    <div class="card-group col-sm-6">
        <?php
        include('../config.php');
        $obj = new dboperation(); // New object
        $conn = $obj->dbconn(); // Check connection
        $obj->product_display(); // Display products where stock above 0
        $result = $obj->dbexecute(); // Execute query
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'>";
                echo "<img class='card-img-top' src='../assets/images/" . $row['product_img'] . "'>";
                echo "<div class='card-body'>";
                echo "<h4 class='card-title'>" . $row['product_name'] . "</h4>";
                echo "<p class='card-text'>" . $row['product_desc'] . "</p>";
                echo "<p class='card-text'>₹" . $row['product_rate'] . "</p>";
                echo "<p class='card-text'>" . $row['product_stock'] . " remaining</p>";
                echo "<a href='cart_add.php?product_id=" . $row['product_id'] . "' class='btn btn-success mx-auto mx-md-0 text-white'>Add to Cart</a>";
                echo "</div></div>";
            }
        } else {
            echo "0 results";
        }
        mysqli_close($conn);
        ?>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>