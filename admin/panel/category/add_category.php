<?php include("../includes/header.php"); ?>

<?php

$showAlert = false;
include("../includes/utils.php");

$utils = new AdminUtils();

if (isset($_POST["submit"])) {

    $result = $utils->addCategory($_POST);

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
        header("refresh:1;url=add_category.php");
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
                        Add Category
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <!-- Product Name Input -->
                            <div class="form-group">
                                <label for="proName">Category Name</label>
                                <input type="text" class="form-control mb-3" required name="catName" id="proName" placeholder="Enter Product Name">
                            </div>

                            <!-- Product Description Input -->
                            <div class="form-group">
                                <label for="proDesc">Category Description</label>
                                <input type="text" class="form-control mb-3" required name="catDesc" id="proDesc" placeholder="Enter Product description">
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="proImg">Upload Image</label>
                                <input type="file" name="catImg" required class="form-control mb-3" id="proImg">
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


    <?php include("../includes/footer.php");  ?>