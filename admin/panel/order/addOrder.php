<?php include("../includes/header.php");  ?>
<?php

$showAlert = false;
include("../includes/utils.php");

$utils = new AdminUtils();

if (isset($_POST["submit"])) {
    $result = $utils->addOrder($_POST);

    if ($result["status"] === "true") {
        $showAlert = true;
    } else {
        $errorMessage = $result["msg"]; // Get the error message from the response
    }
}

?>



<main>

    <?php

    if ($showAlert) {
        echo ' <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Category Added Successfully.
    </div>';
        header("refresh:1;url=addProduct.php");
    } else if (isset($errorMessage)) {
        echo ' <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
    </div>';
    }
    ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header h3 text-center">
                        Add Products
                    </div>
                    <div class="card-body">



                        <form method="post" enctype="multipart/form-data">
                            <!-- Product Name Input -->
                            <div class="form-group">
                                <label for="proName">Product Name</label>
                                <input type="text" class="form-control mb-3" required name="proName" id="proName" placeholder="Enter Product Name">
                            </div>

                            <!-- Product Description Input -->
                            <div class="form-group">
                                <label for="proDesc">Product Description</label>
                                <input type="text" class="form-control mb-3" required name="proDesc" id="proDesc" placeholder="Enter Product description">
                            </div>

                            <div class="form-group">
                                <label for="proDesc">Product Price</label>
                                <input type="number" class="form-control mb-3" required name="proPrice" id="proPrice" placeholder="Enter Product Price">
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="proImage">Upload Image</label>
                                <input type="file" name="proImage" required class="form-control mb-3" id="proImage">
                            </div>

                            <!-- Select Element -->
                            <div class="form-group">
                                <label for="productCategory">Product Category</label>
                                <select class="form-select mb-3" aria-label="Product Category" name="proCatId">
                                    <option selected>Choose Product Category</option>

                                    <?php
                                    $data = $utils->displayCatData();
                                    while ($row = mysqli_fetch_array($data)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['catName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>


<?php include("../includes/footer.php");  ?>