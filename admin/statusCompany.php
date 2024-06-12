<?php
    include ('cn.php');      
$id = $_REQUEST['Id'];
$status = $_REQUEST['Status'];
$query = "UPDATE `outlet` SET `Status`=$status WHERE Id=$id";
mysqli_query($conn,$query);
header('location: company-list.php');
?>