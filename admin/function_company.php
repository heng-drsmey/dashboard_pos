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
            $sqlcompanyinsert = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`, `Remark`, `Status`, `Logo`)
                                 VALUES ('$companycode', '$companyname', '$address', '$createby', '$remark', 1, '$companynewimage')";
            move_uploaded_file($companyimageTmp, './ImageCompany/' . $companynewimage);
        } else {
            $sqlcompanyinsert = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`, `Remark`, `Status`, `Logo`)
                                 VALUES ('$companycode', '$companyname', '$address', '$createby', '$remark', 1, 'no_image.png')";
        }

        if ($conn->query($sqlcompanyinsert) === TRUE) {
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

        $sqlcompanyupdate = "UPDATE `outlet` SET 
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
        $sqlcompanyupdate = str_replace(", WHERE", " WHERE", $sqlcompanyupdate);

        if ($conn->query($sqlcompanyupdate) === TRUE) {
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

// function company_delete(){
//     global $conn;
//     if (isset($_GET['delId'])) {
//         $delId = mysqli_real_escape_string($conn, $_GET['delId']);
//         $sqlcompanydelete = "UPDATE `outlet` SET `del` =0 WHERE `Id` = '$delId'";
//         if($conn->query($sqlcompanydelete) === TRUE) {
//             echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
//                         <strong>Delete Success.</strong>
//                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                             <span aria-hidden="true">&times;</span>
//                         </button>
//                     </div>';
//         }else {
//             echo "Error deleting record: " .$conn->error;
//         }
//     }else {
//         echo "";
//     }
// }

function company_delete(){
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        
        // List of tables and the corresponding foreign key column that reference the company ID
        $foreignTables = [
            'user' => 'OutletId',
            'employee' => 'OutletId',
            'invoice' => 'OutletId',
            // Add more tables and their foreign key columns here
        ];
        
        $canDelete = true;
        foreach ($foreignTables as $table => $column) {
            $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
            $resultForeignKey = $conn->query($checkForeignKey);
            $rowForeignKey = $resultForeignKey->fetch_assoc();
            
            if ($rowForeignKey['count'] > 0) {
                $canDelete = false;
                break;
            }
        }
        
        if ($canDelete) {
            $sqlcompanydelete = "UPDATE `outlet` SET `del` = 0 WHERE `Id` = '$delId'";
            if ($conn->query($sqlcompanydelete) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        <strong>Delete Success.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    <strong>Cannot delete company. It is being referenced in other records.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    } else {
        echo "";
    }
}


?>

