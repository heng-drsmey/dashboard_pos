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
        $basesalary = $conn->real_escape_string($_POST['basesalary']);
        $bonus = $conn->real_escape_string($_POST['bonus']);
        $allowance = $conn->real_escape_string($_POST['allowance']);
        $seniority = $conn->real_escape_string($_POST['seniority']);
        $deduction = $conn->real_escape_string($_POST['deduction']);
        $interimsalary = $conn->real_escape_string($_POST['interimsalary']);
        $netsalary = $conn->real_escape_string($_POST['netsalary']);

        $sqlpayrollinsert = "INSERT INTO `payroll` (`Code`,`Type`,`NumberDay`,`NumberMonth`,`InterimSalary`,`Date`,`CreateBy`,`Remark`,`CodeEmployee`,`Employee`,`EmployeeType`,`BaseSalary`,`Bonus`,`Allowance`,`Seniority`,`Deduction`,`InterimPayment`,`SalaryPayment`)
        VALUES ('$codepayroll','$type','$numofday','$numofmonth','$interimbasesalary','$date','$createby','$remark','$codeemployee','$employee','$employeetype','$basesalary','$bonus','$allowance','$seniority','$deduction','$interimsalary','$netsalary')";

        
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
?>