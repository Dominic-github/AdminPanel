<?php

$showAlert = false;
include("includes/utils.php");

$utils = new AdminUtils();

if (isset($_POST["submit"])) {
    $result = $utils->register($_POST);

    if ($result["status"] === "true") {
        $showAlert = true;
    } else {
        $errorMessage = $result["msg"]; // Get the error message from the response
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <?php

    if ($showAlert) {
        echo ' <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Your account is created successfully.
    </div>';
    } else if (isset($errorMessage)) {
        echo ' <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> ' . $errorMessage . '
    </div>';
    }
    ?>


    <div class="container mt-5 pt-5">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="row">
                <div class="col-12 m-auto">

                    <div class="card">
                        <div class="card-header text-center">Admin Registration</div>
                        <div class="card-body">
                            <form class="text-center border border-light p-5" method="post">

                                <p class="h4 mb-4">Sign Up</p>

                                <input type="text" class="form-control mb-4" required name="username" placeholder="Username">
                                <input type="email" class="form-control mb-4" required name="email" placeholder="E-mail">

                                <input type="password" class="form-control mb-4" required name="password" placeholder="Password">

                                <button class="btn btn-info btn-block my-4" name="submit" type="submit">Sign Up</button>

                                <p>Already have a account?
                                    <a href="index.php">Sign in</a>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
</body>

</html>