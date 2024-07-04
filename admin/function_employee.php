<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert employee
function employee_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $code = $conn->real_escape_string($_POST['code']);
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $dateofbirth = $conn->real_escape_string($_POST['dateofbirth']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $marital = $conn->real_escape_string($_POST['marital']);
        $email = $conn->real_escape_string($_POST['email']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $address = $conn->real_escape_string($_POST['address']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $positions = $conn->real_escape_string($_POST['positions']);
        $employeetype = $conn->real_escape_string($_POST['employeetype']);
        $joindate = $conn->real_escape_string($_POST['joindate']);
        $resigndate = $conn->real_escape_string($_POST['resigndate']);
        $reasonresign = $conn->real_escape_string($_POST['reasonresign']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $accountname = $conn->real_escape_string($_POST['accountname']);
        $accountnumber = $conn->real_escape_string($_POST['accountnumber']);
        $idcard = $conn->real_escape_string($_POST['idcard']);
        $currency = $conn->real_escape_string($_POST['currency']);
        $salary = $conn->real_escape_string($_POST['salary']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        //$status = isset($_POST['status']) ? 1 : 0;
        $employeeimage = $_FILES['employeeimage']['name'];
        $employeeimageTmp = $_FILES['employeeimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $employeenewimage = $currentdate . '_' . rand() . '_' . $employeeimage;

        if(!empty($employeeimage)) {
            $sqlemployeeinsert = "INSERT INTO `employee` (`code`,`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Marital`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Position`, `EmployeeType`, `JoinAT`, `ResignAt`, `ReasonResign`, `Bank`, `AccountName`, `AccountNumber`, `IdCard`,
                                `Currency`, `Salary`, `CreateBy`, `Remark`, `Image`) 
                                VALUES ('$code','$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$marital', '$email', '$telephone', '$address', 
                                '$branch', '$positions', '$employeetype', '$joindate', '$resigndate', '$reasonresign', '$bank', '$accountname', '$accountnumber', '$idcard', 
                                '$currency', '$salary', '$createby', '$remark', '$employeenewimage')";
                                move_uploaded_file($employeeimageTmp, './ImageEmployee/' . $employeenewimage);
        } else {
            $sqlemployeeinsert = "INSERT INTO `employee` (`code`,`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Marital`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Position`, `EmployeeType`, `JoinAT`, `ResignAt`, `ReasonResign`, `Bank`, `AccountName`, `AccountNumber`, `IdCard`,
                                `Currency`, `Salary`, `CreateBy`, `Remark`, `Image`) 
                                VALUES ('$code','$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$marital', '$email', '$telephone', '$address', 
                                '$branch', '$positions', '$employeetype', '$joindate', '$resigndate', '$reasonresign', '$bank', '$accountname', '$accountnumber', '$idcard', 
                                '$currency', '$salary', '$createby', '$remark', 'no_image.png')";
        }

        if ($conn->query($sqlemployeeinsert) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Employee added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "employee-add.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the employee. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "employee-add.php";
                        });
                    });
                  </script>';
        }
    }
}

//update employee
function employee_update() {
    global $conn;

    if (isset($_REQUEST['btnupdate'])) {
        $employeeid = $conn->real_escape_string($_REQUEST['Id']);
        $code = $conn->real_escape_string($_POST['code']);
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $dateofbirth = $conn->real_escape_string($_POST['dateofbirth']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $marital = $conn->real_escape_string($_POST['marital']);
        $email = $conn->real_escape_string($_POST['email']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $address = $conn->real_escape_string($_POST['address']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $positions = $conn->real_escape_string($_POST['positions']);
        $employeetype = $conn->real_escape_string($_POST['employeetype']);
        $joindate = $conn->real_escape_string($_POST['joindate']);
        $resigndate = $conn->real_escape_string($_POST['resigndate']);
        $reasonresign = $conn->real_escape_string($_POST['reasonresign']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $accountname = $conn->real_escape_string($_POST['accountname']);
        $accountnumber = $conn->real_escape_string($_POST['accountnumber']);
        $idcard = $conn->real_escape_string($_POST['idcard']);
        $currency = $conn->real_escape_string($_POST['currency']);
        $salary = $conn->real_escape_string($_POST['salary']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $employeeimage = $_FILES['employeeimage']['name'];
        $employeeimageTmp = $_FILES['employeeimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;
        $employeenewimage = $currentdate . '_' . rand() . '_' . $employeeimage;

        $profileUpdate = "";
        if (!empty($employeeimage)) {
            $getImage = $conn->query("SELECT `Image` FROM `employee` WHERE `Id`='$employeeid'")->fetch_assoc();
            if ($getImage) {
                $oldImage = 'ImageEmployee/' . $getImage['Image'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            move_uploaded_file($employeeimageTmp, 'ImageEmployee/' . $employeenewimage);
            $profileUpdate = "`Image`='$employeenewimage',";
        }

        $sqlemployeeupdate = "UPDATE `employee` SET `Code`='$code', `Firstname`='$firstname', `Lastname`='$lastname', `Gender`='$gender', `Dob`='$dateofbirth', `Nation`='$nationality', 
                                `Marital`='$marital', `Email`='$email', `Tel`='$telephone', `Address`='$address', `OutletId`='$branch', `Position`='$positions', `EmployeeType`='$employeetype', 
                                `JoinAT`='$joindate', `ResignAt`='$resigndate', `ReasonResign`='$reasonresign', `Bank`='$bank', `AccountName`='$accountname', `AccountNumber`='$accountnumber', 
                                `IdCard`='$idcard', `Currency`='$currency', `Salary`='$salary', `CreateBy`='$createby', `UpdateAt`='$update', `Remark`='$remark' $profileUpdate 
                              WHERE `Id`='$employeeid'";
        // Remove trailing comma if $profileUpdate is empty
        $sqlemployeeupdate = str_replace(", WHERE", " WHERE", $sqlemployeeupdate);

        if($conn->query($sqlemployeeupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Employee updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "employee-list.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the Employee. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "employee-list.php";
                        });
                    });
                  </script>';
        }
    }
}


// delete employee
function employee_delete() {
    global $conn;
    if(isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);

        // List of tables and the corresponding foreign key column that reference the company ID
        $foreignTables = [
            'employeepayroll' => 'EmployeeId',
            'employeereviewsalary' => 'EmployeeId',
            'user' => 'EmployeeId',
            // Add more tables and their foreign key columns here
        ];
        $canDelete = true;
        foreach ($foreignTables as $table => $column) {
            $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
            $resultForeignKey = $conn->query($checkForeignKey);
            $rowForeignKey = $resultForeignKey->fetch_assoc();

            if($rowForeignKey['count'] > 0) {
                $canDelete = false;
                break;
            }
        }
        if ($canDelete) {
            $sqlemployeedelete = "UPDATE `employee` SET `del` = 0 WHERE `Id` = '$delId'";
            if($conn->query($sqlemployeedelete) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        <strong>Delete Success.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }else {
                echo "Error deleting record: " . $conn->error;
            }
        }else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    <strong>Cannot delete employee. It is being referenced in other records.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }else {
        echo "";
    }
}
?>