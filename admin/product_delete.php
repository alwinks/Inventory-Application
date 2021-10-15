<?php
session_start();
if (!$_SESSION['admin_id']) {
  header("Location: ../admin.php");
}
include('../config.php');
$product_id = $_GET['product_id'];
// Delete product
$sql = "DELETE FROM tbl_product WHERE product_id='$product_id'";
if (mysqli_query($conn, $sql)) {
  header("Location: products.php");
  echo "<script>alert('Product deleted successfully!');</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
