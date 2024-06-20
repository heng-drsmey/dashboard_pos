<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert employee
function employee_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
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
        $status = isset($_POST['status']) ? 1 : 0;
        $employeeimage = $_FILES['employeeimage']['name'];
        $employeeimageTmp = $_FILES['employeeimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $employeenewimage = $currentdate . '_' . rand() . '_' . $employeeimage;

        if(!empty($employeeimage)) {
            $sqlemployeeinsert = "INSERT INTO `employee` (`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Marital`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Position`, `EmployeeType`, `JoinAT`, `ResignAt`, `ReasonResign`, `Bank`, `AccountName`, `AccountNumber`, `IdCard`,
                                `Currency`, `Salary`, `CreateBy`, `Remark`, `Status`, `Image`) 
                                VALUES ('$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$marital', '$email', '$telephone', '$address', 
                                '$branch', '$positions', '$employeetype', '$joindate', '$resigndate', '$reasonresign', '$bank', '$accountname', '$accountnumber', '$idcard', 
                                '$currency', '$salary', '$createby', '$remark', 1, '$employeenewimage')";
                                move_uploaded_file($employeeimageTmp, './ImageEmployee/' . $employeenewimage);
        } else {
            $sqlemployeeinsert = "INSERT INTO `employee` (`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Marital`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Position`, `EmployeeType`, `JoinAT`, `ResignAt`, `ReasonResign`, `Bank`, `AccountName`, `AccountNumber`, `IdCard`,
                                `Currency`, `Salary`, `CreateBy`, `Remark`, `Status`, `Image`) 
                                VALUES ('$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$marital', '$email', '$telephone', '$address', 
                                '$branch', '$positions', '$employeetype', '$joindate', '$resigndate', '$reasonresign', '$bank', '$accountname', '$accountnumber', '$idcard', 
                                '$currency', '$salary', '$createby', '$remark', 1, 'no_image.png')";
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
?>