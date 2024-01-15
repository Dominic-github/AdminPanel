<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: dashboard.php");
    exit(); // Make sure to exit after a header redirect
}

$login = false;
$showAlert = false;
include("includes/utils.php");

$utils = new AdminUtils();

if (isset($_POST["submit"])) {
    $result = $utils->login($_POST);

    if ($result["status"] === "true") {
        $showAlert = true;
        $login = true;

        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_POST['username'];
        header('Location: dashboard.php');
    } else {
        $errorMessage = $result["msg"]; // Get the error message from the response
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php

    if ($showAlert) {
        echo ' <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Logged in successfully.
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
                        <div class="card-header text-center">Admin Login</div>
                        <div class="card-body">
                            <!-- Default form login -->
                            <form class="text-center border border-light p-5" method="post">

                                <p class="h4 mb-4">Sign in</p>

                                <!-- Email -->
                                <input type="text" class="form-control mb-4" required name="username" placeholder="Username">

                                <!-- Password -->
                                <input type="password" class="form-control mb-4" required name="password" placeholder="Password">

                                <!-- Sign in button -->
                                <button class="btn btn-info btn-block my-4" name="submit" type="submit">Sign in</button>

                                <!-- Register -->
                                <p>Not a member?
                                    <a href="register.php">Register</a>
                                </p>
                            </form>
                            <!-- Default form login -->
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>



    <!-- Optional JavaScript -->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
</body>

</html>