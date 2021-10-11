<?php
session_start();
if (!$_SESSION['user_id']) {
  header("Location: ../login.php");
}
include('../config.php');
$order_id = $_GET['order_id'];
$sql1 = "SELECT tbl_order.order_quantity,tbl_product.product_stock FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id WHERE order_id='$order_id'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
if ($row['order_quantity'] < $row['product_stock']) {
  $sql2 = "UPDATE tbl_order SET order_quantity=order_quantity+1 WHERE order_id='$order_id'";
  if (mysqli_query($conn, $sql2)) {
    header("Location: cart.php");
  } else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
  }
} else {
  header("Location: cart.php");
}
