<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$user_id = $_SESSION['user_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->stock_dec($user_id); // Decrease product stock after placing order
if ($obj->dbexecute()) {
    // Change order status
    $obj->order_success($user_id); // Change status of order as 'Success'
    if ($obj->dbexecute()) {
        echo '<script>alert("Placed order successfully!");</script>';
        header("Location: index.php");
    } else {
        echo "Error:<br>" . mysqli_error($conn);
    }
} else {
    echo "Error:<br>" . mysqli_error($conn);
}
