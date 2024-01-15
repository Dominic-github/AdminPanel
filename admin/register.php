<?php
    include("includes/utils.php");
    $util = new Utils();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $result = $util->register($_POST);
        if (!$result) {
            echo json_encode(array("status" => "failed", "message" => "failed to submit"));
        } else {
            header("Content-Type: application/json");
            echo json_encode($result);
            exit;
        }
}
