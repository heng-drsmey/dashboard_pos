<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
    exit();
}

?>
<!-- Font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>