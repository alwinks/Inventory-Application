<?php
session_start();
if (!$_SESSION['admin_id']) {
  header("Location: ../admin.php");
}
include('../config.php');
if (isset($_POST['product_add'])) {
  $product_name = $_POST['product_name'];
  $product_img = $_POST['product_img'];
  $product_desc = $_POST['product_desc'];
  $product_rate = $_POST['product_rate'];
  $product_stock = $_POST['product_stock'];
  // Add new product
  $sql = "INSERT INTO tbl_product (product_name,product_img,product_desc,product_rate,product_stock) VALUES ('$product_name','$product_img','$product_desc','$product_rate','$product_stock')";
  if (mysqli_query($conn, $sql)) {
    header("Location: products.php");
    echo "<script>alert('Product added successfully!');</script>";
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
      <h3 class="page-title mb-0 p-0">Products</h3>
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
          <h3 class="card-title">Add Product</h3>
          <form class="form-horizontal form-material mx-2" name="product_add" method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <label class="col-md-12 mb-0">Product Name</label>
              <div class="col-md-12">
                <input required name="product_name" type="text" placeholder="Enter new product name" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Product Image</label>
              <div class="col-md-12">
                <input required name="product_img" type="file">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Product Description</label>
              <div class="col-md-12">
                <input required name="product_desc" type="text" placeholder="Enter new product description" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Product Rate</label>
              <div class="col-md-12">
                <input required name="product_rate" type="number" placeholder="Enter new product rate" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Product Stock</label>
              <div class="col-md-12">
                <input required name="product_stock" type="number" placeholder="Enter new product stock" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button name="product_add" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Add Product</button>
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