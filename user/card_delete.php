<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
$card_id = $_GET['card_id'];
// Delete user card
$sql = "DELETE FROM tbl_card WHERE card_id='$card_id'";
if (mysqli_query($conn, $sql)) {
    header("Location: cards.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
