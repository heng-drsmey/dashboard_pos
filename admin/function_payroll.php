<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert payroll
function payroll_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $codepayroll = $conn->real_escape_string($_POST['codepayroll']);
        $type = $conn->real_escape_string($_POST['type']);
        $numofday = $conn->real_escape_string($_POST['numofday']);
        $numofmonth = $conn->real_escape_string($_POST['numofmonth']);
        $interimbasesalary = $conn->real_escape_string($_POST['interimbasesalary']);
        $date = $conn->real_escape_string($_POST['date']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $codeemployee = $conn->real_escape_string($_POST['codeemployee']);
        $employee = $conn->real_escape_string($_POST['employee']);
        $employeetype = $conn->real_escape_string($_POST['employeetype']);
        $positions = $conn->real_escape_string($_POST['positions']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $accountname = $conn->real_escape_string($_POST['accountname']);
        $accountnumber = $conn->real_escape_string($_POST['accountnumber']);
        $basesalary = $conn->real_escape_string($_POST['basesalary']);
        $bonus = $conn->real_escape_string($_POST['bonus']);
        $allowance = $conn->real_escape_string($_POST['allowance']);
        $seniority = $conn->real_escape_string($_POST['seniority']);
        $deduction = $conn->real_escape_string($_POST['deduction']);
        $interimsalary = $conn->real_escape_string($_POST['interimsalary']);
        $netsalary = $conn->real_escape_string($_POST['netsalary']);

        $sqlpayrollinsert = "INSERT INTO `payroll` (`Code`,`Type`,`NumberDay`,`NumberMonth`,`InterimSalary`,`Date`,`CreateBy`,`Remark`,`CodeEmployee`,`Employee`,`EmployeeType`,`Positions`,`Nation`,`Telephone`,`OutletName`,`Bank`,`AccountName`,`AccountNumber`,`BaseSalary`,`Bonus`,`Allowance`,`Seniority`,`Deduction`,`InterimPayment`,`SalaryPayment`)
        VALUES ('$codepayroll','$type','$numofday','$numofmonth','$interimbasesalary','$date','$createby','$remark','$codeemployee','$employee','$employeetype','$positions','$nationality','$telephone','$branch','$bank','$accountname','$accountnumber','$basesalary','$bonus','$allowance','$seniority','$deduction','$interimsalary','$netsalary')";

        
        if($conn->query($sqlpayrollinsert) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Payroll added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "payroll.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the payroll. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "payroll.php";
                        });
                    });
                  </script>';
        }
    }
}

//update payroll
function payroll_update() {
    global $conn;

    if(isset($_REQUEST['btnupdate'])) {
        $payrollid = $conn->real_escape_string($_REQUEST['Id']);
        $codepayroll = $conn->real_escape_string($_POST['codepayroll']);
        $type = $conn->real_escape_string($_POST['type']);
        $numofday = $conn->real_escape_string($_POST['numofday']);
        $numofmonth = $conn->real_escape_string($_POST['numofmonth']);
        $interimbasesalary = $conn->real_escape_string($_POST['interimbasesalary']);
        $date = $conn->real_escape_string($_POST['date']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $codeemployee = $conn->real_escape_string($_POST['codeemployee']);
        $employee = $conn->real_escape_string($_POST['employee']);
        $employeetype = $conn->real_escape_string($_POST['employeetype']);
        $positions = $conn->real_escape_string($_POST['positions']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $accountname = $conn->real_escape_string($_POST['accountname']);
        $accountnumber = $conn->real_escape_string($_POST['accountnumber']);
        $basesalary = $conn->real_escape_string($_POST['basesalary']);
        $bonus = $conn->real_escape_string($_POST['bonus']);
        $allowance = $conn->real_escape_string($_POST['allowance']);
        $seniority = $conn->real_escape_string($_POST['seniority']);
        $deduction = $conn->real_escape_string($_POST['deduction']);
        $interimsalary = $conn->real_escape_string($_POST['interimsalary']);
        $netsalary = $conn->real_escape_string($_POST['netsalary']);
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;

        $sqlpayrollupdate = "UPDATE `payroll` SET `Code` = '$codepayroll',`Type` = '$type',`NumberDay` = '$numofday',`NumberMonth` = '$numofmonth',`InterimSalary` = '$interimbasesalary',`Date` = '$date',`CreateBy` = '$createby',`Remark` = '$remark',`CodeEmployee` = '$codeemployee',`Employee` = '$employee',`EmployeeType` = '$employeetype',`Positions` = '$positions',`Nation` = '$nationality',`Telephone` = '$telephone',`OutletName` = '$branch',`Bank` = '$bank',`AccountName` = '$accountname',`AccountNumber` = '$accountnumber',`BaseSalary` = '$basesalary',`Bonus` = '$bonus',`Allowance` = '$allowance',`Seniority` = '$seniority',`Deduction` = '$deduction',`InterimPayment` = '$interimsalary',`SalaryPayment` = '$netsalary',`UpdateAt`='$update' WHERE Id=$payrollid";

        if($conn->query($sqlpayrollupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Payroll updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "payroll-list.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the payroll. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "payroll-list.php";
                        });
                    });
                  </script>';
        }
    }
}

//delete payroll
function payroll_delete() {
    global $conn;

    // Define foreign table references (leave as empty array if no foreign tables exist)
    $foreignTable = []; // No foreign tables for payroll by default

    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        $canDelete = true;

        // Check for foreign key references only if $foreignTable is not empty
        if (!empty($foreignTable)) {
            foreach ($foreignTable as $table => $column) {
                $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
                $resultForeignKey = $conn->query($checkForeignKey);

                if ($resultForeignKey && $rowForeignKey = $resultForeignKey->fetch_assoc()) {
                    if ($rowForeignKey['count'] > 0) {
                        $canDelete = false;
                        break;
                    }
                }
            }
        }

        // Proceed with deletion if no foreign key constraints are violated
        if ($canDelete) {
            $sqlpayrolldelete = "UPDATE `payroll` SET `del` = 0 WHERE `Id` = '$delId'";
            if ($conn->query($sqlpayrolldelete) === TRUE) {
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
                <strong>Cannot delete payroll. It is being referenced in other records.</strong>
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