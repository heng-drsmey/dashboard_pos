<?php
include('include/head.php');
include('function_payroll.php')
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
                        <a href="payroll-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Payroll List</a>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <form action="payroll.php" method="post" enctype="multipart/form-data" oninput="calculateSalaries()">
                            <?php
                            // Call function payroll insert
                            payroll_insert();
                            // Initialize an empty array for the form data
                            $rowFrm = array(
                                "Id" => "","Code" => "", "Type" => "", "NumberDay"  => "", "NumberMonth"    => "", "InterimSalary" => "", "Date" => "", 
                                "CreateBy" => "", "Remark" => "", "CodeEmployee" => "", "Employee" => "", "EmployeeType" => "","Positions" => "",
                                "Nation" => "", "Telephone" =>"", "OutletName" =>"", "Bank" =>"", "AccountName" =>"", "AccountNumber" =>"", "BaseSalary" => "",
                                "Bonus" => "", "Allowance" => "", "Seniority" => "", "Deduction" =>"", "InterimPayment" => "", "SalaryPayment" => ""
                            );
                            // check if the `Id` parameter is set and valid
                            if(isset($_REQUEST['Id']) && is_numeric($_REQUEST['Id'])) {
                                $payrollid = $conn->real_escape_string($_REQUEST['Id']);
                                // Call the employee update function if needed
                                payroll_update();
                                // Fetch the employee data for update
                                $result = $conn->query("SELECT * FROM `payroll` WHERE `Id` = '$payrollid'");
                                if ($result && $result->num_rows > 0) {
                                     $rowFrm = $result->fetch_assoc();
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
                                 }
                             }                                   
                            ?>
                            <div class="card-body">
                                <h5 style="color:black;">Payroll Information</h5>
                                <hr style="display: block; color: red; border: none; height: 1px; width: 100%; background-color: blue;">
                                <input type="text" style="display: none;" name="Id" value="<?php echo isset($rowFrm['Id']) ? htmlspecialchars($rowFrm['Id']) : ''; ?>">


                                <div class="row">
                                    <div class="col-3">
                                        <label for="codepayroll">Code Payroll</label>
                                        <input type="text" class="form-control border-left-danger" name="codepayroll"  value="<?php echo isset($rowFrm['Code']) ? htmlspecialchars($rowFrm['Code']) : ''; ?>"  required>
                                    </div>

                                    <div class="col-3">
                                        <label for="type">Type</label>
                                        <select class="form-control border-left-danger" name="type" id="type">
                                            <option value="interim" <?php echo (isset($rowFrm['Type']) && $rowFrm['Type'] == 'interim') ? 'selected' : ''; ?>>Interim</option>
                                            <option value="final" <?php echo (isset($rowFrm['Type']) && $rowFrm['Type'] == 'final') ? 'selected' : ''; ?>>Final</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofday">Number of Day</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">A</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="numofday" value="<?php echo htmlspecialchars($rowFrm['NumberDay']); ?>" id="numofday">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofmonth">Number of Month</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">B</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="numofmonth" value="<?php echo htmlspecialchars($rowFrm['NumberMonth']); ?>" id="numofmonth">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="interimbasesalary">Interim Base Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">C</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="interimbasesalary" value="<?php echo htmlspecialchars($rowFrm['InterimSalary']); ?>" id="interimbasesalary">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control border-left-danger" name="date" value="<?php echo htmlspecialchars($rowFrm['Date']); ?>" id="date" required>
                                    </div>

                                    <div class="col-3">
                                        <label for="createby">Create By</label>
                                        <select class="form-control mb-2" style="width: 100%;" name="createby">
                                            <?php
                                            $sqlcreateby = "SELECT * FROM `user` WHERE del=1";
                                            $qrcreateby = $conn->query($sqlcreateby);
                                            while ($rowcreateby = $qrcreateby->fetch_assoc()) {
                                                if ($rowcreateby['Id'] == $rowFrm['CreateBy']) $sel = 'selected';
                                                else $sel = '';
                                                echo '<option value="' . $rowcreateby['Id'] . '" ' . $sel . '>' . $rowcreateby['Username'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark" value="<?php echo isset($rowFrm['Remark']) ? htmlspecialchars($rowFrm['Remark']) : ''; ?>" id="remark">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 style="color:black;">Payroll by Employee</h5>
                                <hr style="display: block; color: red; border: none; height: 1px; width: 100%; background-color: blue;">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="codeemployee">Code</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#employeeModal" onclick="adjustModalWidth()">Search</button>
                                            </div>
                                            <input type="text" class="form-control border-left-danger" name="codeemployee" value="<?php echo isset($rowFrm['CodeEmployee']) ? htmlspecialchars($rowFrm['CodeEmployee']) : ''; ?>" id="codeemployee" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="employee">Employee</label>
                                        <input type="text" class="form-control" name="employee" value="<?php echo isset($rowFrm['Employee']) ? htmlspecialchars($rowFrm['Employee']) : ''; ?>" id="employee" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeetype">Employee Type</label>
                                        <input type="text" class="form-control" name="employeetype" value="<?php echo isset($rowFrm['EmployeeType']) ? htmlspecialchars($rowFrm['EmployeeType']) : ''; ?>" id="employeetype" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="positions">Positions</label>
                                        <input type="text" class="form-control" name="positions" value="<?php echo isset($rowFrm['Positions']) ? htmlspecialchars($rowFrm['Positions']) : ''; ?>" id="positions" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="nationality">Nationality</label>
                                        <input type="text" class="form-control" name="nationality" value="<?php echo isset($rowFrm['Nation']) ? htmlspecialchars($rowFrm['Nation']) : ''; ?>" id="nationality" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" class="form-control" name="telephone" value="<?php echo isset($rowFrm['Telephone']) ? htmlspecialchars($rowFrm['Telephone']) : ''; ?>" id="telephone" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="branch">Branch</label>
                                        <input type="text" class="form-control" name="branch" value="<?php echo isset($rowFrm['OutletName']) ? htmlspecialchars($rowFrm['OutletName']) : ''; ?>" id="branch" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="bank">Bank</label>
                                        <input type="text" class="form-control" name="bank" value="<?php echo isset($rowFrm['Bank']) ? htmlspecialchars($rowFrm['Bank']) : ''; ?>" id="bank" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="accountname">Account Name</label>
                                        <input type="text" class="form-control" name="accountname" value="<?php echo isset($rowFrm['AccountName']) ? htmlspecialchars($rowFrm['AccountName']) : ''; ?>" id="accountname" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="accountnumber">Account Number</label>
                                        <input type="text" class="form-control" name="accountnumber" value="<?php echo isset($rowFrm['AccountNumber']) ? htmlspecialchars($rowFrm['AccountNumber']) : ''; ?>" id="accountnumber" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="basesalary">Base Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">D</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="basesalary" value="<?php echo htmlspecialchars($rowFrm['BaseSalary']); ?>" id="basesalary">
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
                                            <input type="number" min="0" class="form-control" name="bonus" value="<?php echo htmlspecialchars($rowFrm['Bonus']); ?>" id="bonus">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="allowance">Allowance</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">F</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="allowance" value="<?php echo htmlspecialchars($rowFrm['Allowance']); ?>" id="allowance">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="seniority">Seniority Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">G</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="seniority" value="<?php echo htmlspecialchars($rowFrm['Seniority']); ?>" id="seniority">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="deduction">Pension Fund Deduction</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">H</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="deduction" value="<?php echo htmlspecialchars($rowFrm['Deduction']); ?>" id="deduction">
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
                                            <input type="number" class="form-control" name="interimsalary" value="<?php echo htmlspecialchars($rowFrm['InterimPayment']); ?>" id="interimsalary" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="netsalary">Net Salary Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">D + E + F + G - H</span>
                                            </div>
                                            <input type="number" class="form-control" name="netsalary" value="<?php echo htmlspecialchars($rowFrm['SalaryPayment']); ?>" id="netsalary" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!-- Disable Checkbox -->
                                <div class="form-check form-switch ms-4 mt-3">
                                    <input type="checkbox" class="form-check-input" role="switch" id="status" name="status" <?php echo isset($payroll) && $payroll['Status'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status">Disable</label>
                                </div>
                                <?php
                                if (isset($_REQUEST['Id'])) {
                                    echo '
                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm mt-5" name="btnupdate">
                                        <a href="payroll.php" class="btn btn-info btn-sm mt-5"> NEW </a>
                                    ';
                                } else {
                                    echo '
                                        <button type="submit" class="btn btn-primary btn-sm mt-5" name="btnsave" style="width: 20%;">Save</button>
                                        ';
                                }
                                ?>
                            </div>
                            <!-- Employee Modal -->
                            <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" id="employeeModalDialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="employeeModalLabel">Select Employee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="employeeTable">
                                                <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Employee Type</th>
                                                        <th>Positions</th>
                                                        <th>Nationality</th>
                                                        <th>Telephone</th>
                                                        <th>Branch</th>
                                                        <th>Bank</th>
                                                        <th>AC Name</th>
                                                        <th>AC Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "
                                                    SELECT 
                                                        employee.Code, 
                                                        employee.Lastname, 
                                                        employeetype.EmployeeType AS EmployeeTypeName, 
                                                        positions.Positions AS PositionName, 
                                                        nationality.Nation AS NationalityName, 
                                                        employee.Tel, 
                                                        outlet.Name AS BranchName, 
                                                        bank.Bank AS BankName, 
                                                        employee.AccountName, 
                                                        employee.AccountNumber
                                                    FROM employee
                                                    LEFT JOIN employeetype ON employee.EmployeeType = employeetype.Id
                                                    LEFT JOIN positions ON employee.Position = positions.Id
                                                    LEFT JOIN nationality ON employee.Nation = nationality.Id
                                                    LEFT JOIN outlet ON employee.OutletId = outlet.Id
                                                    LEFT JOIN bank ON employee.Bank = bank.Id
                                                    WHERE employee.del = 1";

                                                    $result = $conn->query($query);

                                                    if ($result) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr ondblclick='selectEmployee(this)'>";
                                                            echo "<td>" . htmlspecialchars($row['Code']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['Lastname']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['EmployeeTypeName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['PositionName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['NationalityName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['Tel']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['BranchName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['BankName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['AccountName']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['AccountNumber']) . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "Error: " . $conn->error;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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


    <!-- JavaScript for calculating interim and net salaries separately -->
<script>
    function calculateInterimSalary() {
        const interimbaseSalary = parseFloat(document.getElementById("interimbasesalary").value) || 0;
        const numOfDay = parseFloat(document.getElementById("numofday").value) || 0;
        const numOfMonth = parseFloat(document.getElementById("numofmonth").value) || 0;

        const interimSalary = numOfMonth > 0 ? (interimbaseSalary * numOfDay) / numOfMonth : 0;
        document.getElementById("interimsalary").value = interimSalary.toFixed(2);
    }

    function calculateNetSalary() {
        const baseSalary = parseFloat(document.getElementById("basesalary").value) || 0;
        const bonus = parseFloat(document.getElementById("bonus").value) || 0;
        const allowance = parseFloat(document.getElementById("allowance").value) || 0;
        const seniority = parseFloat(document.getElementById("seniority").value) || 0;
        const deduction = parseFloat(document.getElementById("deduction").value) || 0;

        const netSalary = baseSalary + bonus + allowance + seniority - deduction;
        document.getElementById("netsalary").value = netSalary.toFixed(2);
    }

    // Attach event listeners to trigger each calculation separately
    document.getElementById("interimbasesalary").addEventListener("input", calculateInterimSalary);
    document.getElementById("numofday").addEventListener("input", calculateInterimSalary);
    document.getElementById("numofmonth").addEventListener("input", calculateInterimSalary);

    document.getElementById("basesalary").addEventListener("input", calculateNetSalary);
    document.getElementById("bonus").addEventListener("input", calculateNetSalary);
    document.getElementById("allowance").addEventListener("input", calculateNetSalary);
    document.getElementById("seniority").addEventListener("input", calculateNetSalary);
    document.getElementById("deduction").addEventListener("input", calculateNetSalary);

</script>

<!-- JavaScript includes - Ensure the order is correct -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<script>

    // Define the selectEmployee function in the global scope
    function selectEmployee(row) {
        if (row) {
            const code = row.cells[0].textContent;
            const name = row.cells[1].textContent;
            const employeeType = row.cells[2].textContent;
            const positions = row.cells[3].textContent;
            const nation = row.cells[4].textContent;
            const telephone = row.cells[5].textContent;
            const branch = row.cells[6].textContent;
            const bank = row.cells[7].textContent;
            const acname = row.cells[8].textContent;
            const acnumber = row.cells[9].textContent;

            // Populate fields with data from the selected row
            document.getElementById("codeemployee").value = code;
            document.getElementById("employee").value = name;
            document.getElementById("employeetype").value = employeeType;
            document.getElementById("positions").value = positions;
            document.getElementById("nationality").value = nation;
            document.getElementById("telephone").value = telephone;
            document.getElementById("branch").value = branch;
            document.getElementById("bank").value = bank;
            document.getElementById("accountname").value = acname;
            document.getElementById("accountnumber").value = acnumber;

            // Close the modal
            $('#employeeModal').modal('hide');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const searchButton = document.querySelector('[data-target="#employeeModal"]');

        // Initialize DataTable on employeeTable
        $('#employeeTable').DataTable();

        // Event listener for double-click on table rows to select employee
        $('#employeeTable tbody').on('dblclick', 'tr', function () {
            selectEmployee(this);
        });

        // Manage backdrop removal to prevent duplicates
        $('#employeeModal').on('show.bs.modal', function () {
            searchButton.disabled = true; // Disable button to prevent re-clicking
        });

        // Remove backdrops after modal hides
        $('#employeeModal').on('hide.bs.modal', function () {
            searchButton.disabled = false; // Re-enable search button
        });

        // Ensure all backdrops are removed after modal closes
        $('#employeeModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
    });

</script>
<script>
    function adjustModalWidth() {
        const modalDialog = document.getElementById('employeeModalDialog');
        modalDialog.style.maxWidth = '90%'; // Set modal width to 90% of viewport
    }
</script>
</body>

</html>