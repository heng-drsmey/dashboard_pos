<?php
include('cn.php');

function company_update_status($id, $status) {
    global $conn;

    // Escape variables to protect against SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);

    // Update company status in the database
    $query = "UPDATE `outlet` SET `Status` = '$status' WHERE `Id` = '$id'";
    mysqli_query($conn, $query);

    // Redirect to the company list page
    header('location: company-list.php');
    exit();
}

// Check if the required parameters are set
if (isset($_REQUEST['OutId']) && isset($_REQUEST['Status'])) {
    $id = $_REQUEST['OutId'];
    $status = $_REQUEST['Status'];

    // Call the function to update company status
    company_update_status($id, $status);
} else {
    // Handle invalid request
    header('location: company-list.php');
    exit();
}
?>
