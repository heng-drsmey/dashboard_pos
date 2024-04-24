<?php
                        include         
$id = $_GET['Id'];
$status = $_GET['status'];
$query = "UPDATE `product` SET `status`=$status WHERE Id=$id";
mysqli_query($conn,$query);
header('location: index.php');
?>