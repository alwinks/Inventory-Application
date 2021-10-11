<?php
session_start();
if (!$_SESSION['user_id']) {
  header("Location: ../login.php");
}
include('../config.php');
$order_id = $_GET['order_id'];
$sql1 = "SELECT order_quantity FROM tbl_order WHERE order_id='$order_id'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
if ($row['order_quantity'] > 1) {
  $sql2 = "UPDATE tbl_order SET order_quantity=order_quantity-1 WHERE order_id='$order_id'";
  if (mysqli_query($conn, $sql2)) {
    header("Location: cart.php");
  } else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
  }
} else {
  header("Location: cart.php");
}
