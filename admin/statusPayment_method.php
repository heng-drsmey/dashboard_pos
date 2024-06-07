<?php
    include ('cn.php');      
$id = $_REQUEST['Id'];
$status = $_REQUEST['Status'];
$query = "UPDATE `paymentmethod` SET `Status`=$status WHERE Id=$id";
mysqli_query($conn,$query);
header('location: payment-method.php');
?>
