<?php
include("includes/utils.php");
$util = new Utils();

$data = $util->fetchProducts();

echo $data;
?>