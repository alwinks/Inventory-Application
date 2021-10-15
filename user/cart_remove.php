<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$order_id = $_GET['order_id'];
// Remove product from cart
$sql = "DELETE FROM tbl_order WHERE order_id='$order_id'";
if (mysqli_query($conn, $sql)) {
    header("Location: cart.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
