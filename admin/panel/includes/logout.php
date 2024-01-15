<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/AdminPanel/admin/panel/");
exit(); // Ensure that no further code is executed after the redirect
?>