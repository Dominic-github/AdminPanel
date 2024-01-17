<?php include("../includes/header.php");  ?>

<?php   

$showAlert = false;
include("../includes/utils.php");

$utils = new AdminUtils();

if (isset($_POST["submit"])) {

  $_POST["userId"] = 1;
  $_POST["amount"] = 2831000;
  $_POST["orderImage"] = 'order1.jpg';
  $_POST["quantity"] = [5,3,2,3,1];
  $_POST["productIdList"] = '1,2,3,4,5';


  $result = $utils->addOrder($_POST);

  if ($result["status"] === "true") {
      $showAlert = true;
  } else {
      $errorMessage = $result["msg"]; // Get the error message from the response
  }
}

?>

<form method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="proImg">Upload Image</label>
    <input type="file" name="orderImg" required class="form-control mb-3" id="proImg">
  </div>

  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>                    
</form>

<?php include("../includes/footer.php");  ?>