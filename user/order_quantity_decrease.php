<?php
session_start();
if (!$_SESSION['user_id']) {
  header("Location: ../login.php");
}
include('../config.php');
$order_id = $_GET['order_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->quantity($order_id); // Select quantity of order
$result = $obj->dbexecute(); // Execute query
$row = mysqli_fetch_assoc($result);
if ($row['order_quantity'] > 1) {
  $obj->quantity_dec($order_id); // Decrease quantity of order
  if ($obj->dbexecute()) {
    header("Location: cart.php");
  } else {
    echo "Error:<br>" . mysqli_error($conn);
  }
} else {
  header("Location: cart.php");
}
