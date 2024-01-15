<?php
include("includes/utils.php");
$util = new Utils();

$data = $util->fetchOrders();

echo $data;
?>