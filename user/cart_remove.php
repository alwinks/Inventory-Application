<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$order_id = $_GET['order_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->cart_remove($order_id); // Remove product from cart
if ($obj->dbexecute()) {
    header("Location: cart.php");
} else {
    echo "Error:<br>" . mysqli_error($conn);
}
