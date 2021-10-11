<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
$sql1 = "SELECT * FROM tbl_order WHERE order_status='Cart' AND product_id='$product_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) == 0) {
    $sql2 = "INSERT INTO tbl_order (product_id,user_id,order_quantity,order_status) VALUES ('$product_id','$user_id','1','Cart')";
    if (mysqli_query($conn, $sql2)) {
        header("Location: cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
else
{
    echo '<script>alert("Already added in cart!");</script>';
    header("Location: cart.php");
}
