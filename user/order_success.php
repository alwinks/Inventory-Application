<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$user_id = $_SESSION['user_id'];
// Decrease product stock
$sql1 = "UPDATE tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id SET tbl_product.product_stock=tbl_product.product_stock-tbl_order.order_quantity WHERE user_id='$user_id' AND order_status='Cart'";
if (mysqli_query($conn, $sql1)) {
    // Change order status
    $sql2 = "UPDATE tbl_order SET order_status='Success' WHERE user_id='$user_id'";
    if (mysqli_query($conn, $sql2)) {
        echo '<script>alert("Placed order successfully!");</script>';
        header("Location: index.php");
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}
