<?php
session_start();
if (!$_SESSION['admin_id']) {
  header("Location: ../admin.php");
}
include('../config.php');
$product_id = $_GET['product_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->product_delete($product_id); // Delete product
if ($obj->dbexecute()) {
  header("Location: products.php");
  echo "<script>alert('Product deleted successfully!');</script>";
} else {
  echo "Error:<br>" . mysqli_error($conn);
}
