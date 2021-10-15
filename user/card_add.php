<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../login.php");
}
include('../config.php');
if (isset($_POST['card_add'])) {
    $user_id = $_SESSION['user_id'];
    $card_number = $_POST['card_number'];
    $card_cvc = $_POST['card_cvc'];
    // Add new user card
    $sql = "INSERT INTO tbl_card (user_id,card_number,card_cvc) VALUES ('$user_id','$card_number','$card_cvc')";
    if (mysqli_query($conn, $sql)) {
        header("Location: cards.php");
        echo "<script>alert('Card added successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">cards</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Add Card</h3>
                    <form class="form-horizontal form-material mx-2" name="card_add" method="POST" action="<?php $_PHP_SELF ?>">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Card Number</label>
                            <div class="col-md-12">
                                <input required name="card_number" maxlength="12" type="number" placeholder="Enter new card number" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">CVC</label>
                            <div class="col-md-12">
                                <input required name="card_cvc" type="password" maxlength="3" placeholder="Enter new card CVC" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 d-flex">
                                <button name="card_add" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Add Card</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>