<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->cart_check($product_id, $user_id); // Check if product already exists in cart
$result = $obj->dbexecute(); // Execute query
if (mysqli_num_rows($result) == 0) {
    // Add product in cart
    $obj->cart_add($product_id, $user_id); // Add product to cart
    if ($obj->dbexecute()) {
        header("Location: cart.php");
    } else {
        echo "Error:<br>" . mysqli_error($conn);
    }
} else {
    echo '<script>alert("Already added in cart!");</script>';
    header("Location: cart.php");
}
