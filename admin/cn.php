<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "db_sys_coffee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$home='http://localhost/dashboard_pos/admin';


?>