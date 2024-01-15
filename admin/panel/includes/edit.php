<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_reset();
    session_destroy();
    header('location: index.php');
}
