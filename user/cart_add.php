<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO tbl_order (product_id,user_id,order_quantity,order_status) VALUES ('$product_id','$user_id','1','Cart')";
if (mysqli_query($conn, $sql)) {
    header("Location: cart.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
