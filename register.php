<?php
// Add new user details
include('config.php');
if (isset($_POST['user_register'])) {
  $user_username = $_POST['user_username'];
  $user_password = $_POST['user_password'];
  $sql = "INSERT INTO tbl_user (user_username,user_password) VALUES ('$user_username','$user_password')";
  if (mysqli_query($conn, $sql)) {
    header("location: login.php");
    echo "<script>alert('Registered successfully!');</script>";
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
      <h3 class="page-title mb-0 p-0">Home</h3>
    </div>
  </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Register as User</h3>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
        <form class="form-horizontal form-material mx-2" onsubmit="return validate()" name="user_register" method="POST" action="<?php $_PHP_SELF ?>">
          <div class="form-group">
            <label class="col-md-12 mb-0">New Username</label>
            <div class="col-md-12">
              <input required name="user_username" type="text" placeholder="Enter new username" class="form-control ps-0 form-control-line">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12 mb-0">New Password</label>
            <div class="col-md-12">
              <input required name="user_password" type="password" placeholder="Enter new password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12 mb-0">Confirm Password</label>
            <div class="col-md-12">
              <input required name="user_password_confirm" type="password" placeholder="Confirm new password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12 d-flex">
              <button name="user_register" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Container fluid  -->
<script>
  function validate() {
    var password = document.user_register.user_password.value;
    var confirm = document.user_register.user_password_confirm.value;
    if (password != confirm) {
      alert("Passwords do not match!");
      return false;
    }
    return true;
  }
</script>
<?php
include("footer.php");
?>