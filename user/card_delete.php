<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$card_id = $_GET['card_id'];
$obj = new dboperation(); // New object
$conn = $obj->dbconn(); // Check connection
$obj->card_delete($card_id); // Delete card
if ($obj->dbexecute()) {
    header("Location: cards.php");
} else {
    echo "Error:<br>" . mysqli_error($conn);
}
