<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert company
function company_insert() {
    global $conn;
    if (isset($_POST['btnsave'])) {
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $status = isset($_POST['status']) ? 1 : 0;
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $companynewimage = $currentdate . '_' . rand() . '_' . $companyimage;

        if (!empty($companyimage)) {
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`, `Remark`, `Status`, `Logo`)
                                 VALUES ('$companycode', '$companyname', '$address', '$createby', '$remark', 1, '$companynewimage')";
            move_uploaded_file($companyimageTmp, './ImageCompany/' . $companynewimage);
        } else {
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`, `Remark`, `Status`, `Logo`)
                                 VALUES ('$companycode', '$companyname', '$address', '$createby', '$remark', 1, 'no_image.png')";
        }

        if ($conn->query($sqlInsertcompany) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Company added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "company-add.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the company. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "company-add.php";
                        });
                    });
                  </script>';
        }
    }
}

// update company
function company_update() {
    global $conn;

    if (isset($_REQUEST['btnupdate'])) {
        $companyid = $conn->real_escape_string($_REQUEST['Id']);
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = $conn->real_escape_string($_REQUEST['updateat']);
        $update = $updateat . $currentdate;
        $companynewimage = $currentdate . '_' . rand() . '_' . $companyimage;

        if (!empty($companyimage)) {
            $getImage = $conn->query("SELECT `Logo` FROM `outlet` WHERE `Id`='$companyid'")->fetch_assoc();
            if ($getImage) {
                $oldImage = 'ImageCompany/' . $getImage['Logo'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            move_uploaded_file($companyimageTmp, 'ImageCompany/' . $companynewimage);
            $logoUpdate = "`Logo`='$companynewimage',";
        } else {
            $logoUpdate = "";
        }

        $sqlupdate = "UPDATE `outlet` SET 
                        `Name`='$companyname', 
                        `Code`='$companycode', 
                        `Status`=1, 
                        `Address`='$address', 
                        $logoUpdate 
                        `CreateBy`='$createby', 
                        `UpdateAt`='$update', 
                        `Remark`='$remark' 
                      WHERE `Id`='$companyid'";

        // Remove trailing comma if $logoUpdate is empty
        $sqlupdate = str_replace(", WHERE", " WHERE", $sqlupdate);

        if ($conn->query($sqlupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Company updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "company-list.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the company. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "company-list.php";
                        });
                    });
                  </script>';
        }
    }
}


?>

