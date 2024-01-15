<?php include("../includes/header.php"); ?>

<?php
$showAlert = false;
$showUpdateAlert = false;
include("../includes/utils.php");

$util = new AdminUtils();

$data = $util->displayProductData();

if (isset($_GET["status"])) {
    $id = $_GET["id"];

    if ($_GET["status"] === "delete") {
        $result = $util->deleteProduct($id);

        if ($result["status"] === "true") {
            $showAlert = true;
        } else {
            $errorMessage = $result["msg"]; // Get the error message from the response
        }
    } else if ($_GET["status"] === "update") {
        $id = $_GET["id"];
        $result = $util->updateCat($id, $_POST);
        if ($result["status"] === "true") {
            $showUpdateAlert = true;
        }
    } else {
        // Invalid status parameter
    }
}

?>

<main>

    <?php
    if ($showAlert) {
        echo ' <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Deleted Successfully.
    </div>';
        header('location: manageProduct.php');
    } else if (isset($errorMessage)) {
        echo ' <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
    </div>';
    }
    ?>

    <?php
    if ($showUpdateAlert) {
        echo ' <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Updated Successfully.
    </div>';
        header("refresh:1;url=addProduct.php");
    } else if (isset($errorMessage)) {
        echo ' <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
    </div>';
    }
    ?>

    <div class="container-fluid my-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['id'];  ?></th>
                            <td><?php echo $row['cat_id'];  ?></td>
                            <td><?php echo $row['pName'];  ?></td>
                            <td class="text-center"><?php echo $row['pDesc'];  ?></td>
                            <td class="text-center"><img src="uploads/<?php echo $row['pImage']; ?>" style="width: 150px;" height="100%" alt=""></td>
                            <td class="text-center"><?php echo $row['pPrice'];  ?></td>
                            <td class="text-center"><?php echo $row['pStatus'];  ?></td>
                            <td class="text-center">

                                <button data-toggle="modal" class="btn btn-success" data-target="#exampleModal<?php echo $row['id']; ?>">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data" action="?status=update&id=<?php echo $row['id']; ?>">
                                                    <!-- Category Name Input -->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="catName" id="categoryName" value="<?php echo $row['catName']; ?>">
                                                    </div>
                                                    <!-- Category Description Input -->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="catDesc" id="categoryDesc" value="<?php echo $row['catDesc']; ?>">
                                                    </div>
                                                    <!-- Image Upload -->
                                                    <div class="form-group">
                                                        <label for="imageUpload" class="float-left">Upload Image</label>
                                                        <input type="file" name="catImg" class="form-control" id="imageUpload">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="?status=delete&id=<?php echo $row['id'];  ?>" name="deleteCat" class=" btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php  }  ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php include("../includes/footer.php"); ?>