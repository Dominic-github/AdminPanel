<?php
include("includes/utils.php");
$util = new Utils();

$data = $util->fetchCategories();

echo $data;
?>