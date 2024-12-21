<?php
include('include/head.php');
include('cn.php'); // Include your database connection

// Initialize an empty array for the employee data
$payroll = array(
    "Id" => "","Code" => "", "Type" => "", "NumberDay"  => "", "NumberMonth"    => "", "InterimSalary" => "", "Date" => "", 
    "CreateBy" => "","CreateAt" => "", "Remark" => "", "CodeEmployee" => "", "Employee" => "", "EmployeeType" => "","Positions" => "",
    "Nation" => "", "Telephone" =>"", "OutletName" =>"", "Bank" =>"", "AccountName" =>"", "AccountNumber" =>"", "BaseSalary" => "",
    "Bonus" => "", "Allowance" => "", "Seniority" => "", "Deduction" =>"", "InterimPayment" => "", "SalaryPayment" => "",
    "UpdateAt" => "","Status" => ""
);

// Check if the `Id` parameter is set and valid
if (isset($_REQUEST['Id']) && is_numeric($_REQUEST['Id'])) {
    $payrollid = $conn->real_escape_string($_REQUEST['Id']);
    
    // Fetch the employee data
    $result = $conn->query("SELECT * FROM `payroll` WHERE `Id` = '$payrollid'");

    if ($result && $result->num_rows > 0) {
        $payroll = $result->fetch_assoc();
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "Failed to fetch payroll data. Please try again.",
                        icon: "error"
                    }).then(function() {
                        window.location = "payroll-list.php";
                    });
                });
            </script>';
        exit();
    }
} else {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Error",
                    text: "Invalid payroll ID.",
                    icon: "error"
                }).then(function() {
                    window.location = "payroll-list.php";
                });
            });
        </script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Payroll by Employee</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    #wrapper {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    #page-content-wrapper {
        flex-grow: 1;
        overflow-y: auto;
    }
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include './include/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include './include/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payroll</h1>
                        <div class="both">
                            <a href="payroll-print.php?Id=<?php echo $payroll['Id']; ?>" class="btn btn-warning shadow-sm"><i class="fas fa-print"></i> Print</a>
                            <a href="payroll-list.php" class="btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Payroll List</a>
                        </div>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <form action="payroll.php" method="post" enctype="multipart/form-data" oninput="calculateSalaries()">
                            <div class="card-body">
                                <h5 style="color:black;">Payroll Information</h5>
                                <hr style="display: block; color: red; border: none; height: 1px; width: 100%; background-color: blue;">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="codepayroll">Code Payroll</label>
                                        <input type="text" class="form-control" name="codepayroll"  value="<?php echo isset($payroll['Code']) ? htmlspecialchars($payroll['Code']) : ''; ?>"  readonly>
                                    </div>

                                    <div class="col-3">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" name="type"  value="<?php echo isset($payroll['Type']) ? htmlspecialchars($payroll['Type']) : ''; ?>"  readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofday">Number of Day</label>
                                        <input type="text" class="form-control" name="numofday"  value="<?php echo isset($payroll['NumberDay']) ? htmlspecialchars($payroll['NumberDay']) : ''; ?>"  readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofmonth">Number of Month</label>
                                        <input type="text" class="form-control" name="numofmonth"  value="<?php echo isset($payroll['NumberMonth']) ? htmlspecialchars($payroll['NumberMonth']) : ''; ?>"  readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="interimbasesalary">Interim Base Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">C</span>
                                            </div>
                                            <input type="number" class="form-control" name="interimbasesalary" value="<?php echo htmlspecialchars($payroll['InterimSalary']); ?>" id="interimbasesalary" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($payroll['Date']); ?>" id="date" readonly>
                                    </div>

                                    <div class="col-3">
                                        <!-- create by -->
                                        <label for="createby">Created By</label>
                                        <input type="text" class="form-control" id="createby" name="createby" value="<?php
                                        $createById = $payroll['CreateBy'];
                                        $sqlcreateby = "SELECT `Username` FROM `user` WHERE `Id` = '$createById'";
                                        $qrcreateby = $conn->query($sqlcreateby);
                                        if ($qrcreateby && $qrcreateby->num_rows > 0) {
                                        $rowcreateby = $qrcreateby->fetch_assoc();
                                        echo htmlspecialchars($rowcreateby['Username']);
                                        }
                                        ?>" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="createat">Create At</label>
                                        <input type="text" class="form-control" name="createat" value="<?php echo isset($payroll['CreateAt']) ? htmlspecialchars($payroll['CreateAt']) : ''; ?>" id="createat" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="updateat">Update At</label>
                                        <input type="text" class="form-control" name="updateat" value="<?php echo isset($payroll['UpdateAt']) ? htmlspecialchars($payroll['UpdateAt']) : ''; ?>" id="updateat" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark" value="<?php echo isset($payroll['Remark']) ? htmlspecialchars($payroll['Remark']) : ''; ?>" id="remark" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 style="color:black;">Payroll by Employee</h5>
                                <hr style="display: block; color: red; border: none; height: 1px; width: 100%; background-color: blue;">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="codeemployee">Code</label>
                                        <input type="text" class="form-control" name="codeemployee" value="<?php echo isset($payroll['CodeEmployee']) ? htmlspecialchars($payroll['CodeEmployee']) : ''; ?>" id="codeemployee" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employee">Employee</label>
                                        <input type="text" class="form-control" name="employee" value="<?php echo isset($payroll['Employee']) ? htmlspecialchars($payroll['Employee']) : ''; ?>" id="employee" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeetype">Employee Type</label>
                                        <input type="text" class="form-control" name="employeetype" value="<?php echo isset($payroll['EmployeeType']) ? htmlspecialchars($payroll['EmployeeType']) : ''; ?>" id="employeetype" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="positions">Positions</label>
                                        <input type="text" class="form-control" name="positions" value="<?php echo isset($payroll['Positions']) ? htmlspecialchars($payroll['Positions']) : ''; ?>" id="positions" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="nationality">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" value="<?php echo isset($payroll['Nation']) ? htmlspecialchars($payroll['Nation']) : ''; ?>" id="nationality" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" class="form-control" name="telephone" value="<?php echo isset($payroll['Telephone']) ? htmlspecialchars($payroll['Telephone']) : ''; ?>" id="telephone" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="branch">Branch</label>
                                        <input type="text" class="form-control" name="branch" value="<?php echo isset($payroll['OutletName']) ? htmlspecialchars($payroll['OutletName']) : ''; ?>" id="branch" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="bank">Bank</label>
                                        <input type="text" class="form-control" name="bank" value="<?php echo isset($payroll['Bank']) ? htmlspecialchars($payroll['Bank']) : ''; ?>" id="bank" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="accountname">Account Name</label>
                                        <input type="text" class="form-control" name="accountname" value="<?php echo isset($payroll['AccountName']) ? htmlspecialchars($payroll['AccountName']) : ''; ?>" id="accountname" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="accountnumber">Account Number</label>
                                        <input type="text" class="form-control" name="accountnumber" value="<?php echo isset($payroll['AccountNumber']) ? htmlspecialchars($payroll['AccountNumber']) : ''; ?>" id="accountnumber" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="basesalary">Base Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">D</span>
                                            </div>
                                            <input type="number" class="form-control" name="basesalary" value="<?php echo htmlspecialchars($payroll['BaseSalary']); ?>" id="basesalary" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="bonus">Bonus</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">E</span>
                                            </div>
                                            <input type="number" class="form-control" name="bonus" value="<?php echo htmlspecialchars($payroll['Bonus']); ?>" id="bonus" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="allowance">Allowance</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">F</span>
                                            </div>
                                            <input type="number" class="form-control" name="allowance" value="<?php echo htmlspecialchars($payroll['Allowance']); ?>" id="allowance" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="seniority">Seniority Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">G</span>
                                            </div>
                                            <input type="number" class="form-control" name="seniority" value="<?php echo htmlspecialchars($payroll['Seniority']); ?>" id="seniority" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="deduction">Pension Fund Deduction</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">H</span>
                                            </div>
                                            <input type="number" class="form-control" name="deduction" value="<?php echo htmlspecialchars($payroll['Deduction']); ?>" id="deduction" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="interimsalary">Interim Salary Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">C x A / B</span>
                                            </div>
                                            <input type="number" class="form-control" name="interimsalary" value="<?php echo htmlspecialchars($payroll['InterimPayment']); ?>" id="interimsalary" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="netsalary">Net Salary Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">D + E + F + G - H</span>
                                            </div>
                                            <input type="number" class="form-control" name="netsalary" value="<?php echo htmlspecialchars($payroll['SalaryPayment']); ?>" id="netsalary" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!-- Disable Checkbox -->
                                <div class="form-check form-switch ms-4 mt-3">
                                    <input type="checkbox" class="form-check-input" role="switch" id="status" name="status" <?php echo isset($payroll) && $payroll['Status'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status">Disable</label>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './include/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<!-- JavaScript includes - Ensure the order is correct -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>