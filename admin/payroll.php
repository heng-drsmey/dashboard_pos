<?php
include('include/head.php');
include('function_bank.php')
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                        <!-- <a href="Tableduct-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm" disabled><i class="fas fa-user text-white-50"></i> Add New</a> -->
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                                            <form method="post" enctype="multipart/form-data" oninput="calculateSalaries()">
                            <div class="card-body">
                                <h5 style="color:black;">Payroll Information</h5>
                                <hr style="display: block; color: red; border: none; height: 1px; width: 100%; background-color: blue;">
                                <input type="text" style="display: none;" name="Id" value="<?php echo htmlspecialchars($rowFrm['Id']); ?>">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="codepayroll">Code Payroll</label>
                                        <input type="text" class="form-control border-left-danger" name="codepayroll" required>
                                    </div>

                                    <div class="col-3">
                                        <label for="type">Type</label>
                                        <select class="form-control border-left-danger" name="type" id="type" required>
                                            <option value="Interim">Interim</option>
                                            <option value="Final">Final</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofday">Number of Day</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">A</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="numofday" id="numofday">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="numofmonth">Number of Month</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">B</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="numofmonth" id="numofmonth">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control border-left-danger" name="date" required>
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
                                    <div class="col-6">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark">
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
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#employeeModal">Search</button>
                                            </div>
                                            <input type="text" class="form-control border-left-danger" name="codeemployee" id="codeemployee" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="employee">Employee</label>
                                        <input type="text" class="form-control" name="employee" id="employee" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeetype">Employee Type</label>
                                        <input type="text" class="form-control" name="employeetype" id="employeetype" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="basesalary">Base Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">C</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="basesalary" id="basesalary">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="bonus">Bonus</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">D</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="bonus" id="bonus">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="allowance">Allowance</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">E</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="allowance" id="allowance">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="seniority">Seniority Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">F</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="seniority" id="seniority">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="pension">Pension Fund Deduction</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">G</span>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="pension" id="pension">
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
                                            <input type="number" class="form-control" name="interimsalary" id="interimsalary" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="netsalary">Net Salary Payment</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">C + D + E + F - G</span>
                                            </div>
                                            <input type="number" class="form-control" name="netsalary" id="netsalary" readonly>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($_REQUEST['Id'])) {
                                    echo '
                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm mt-5" name="btnupdate">
                                        <a href="payroll.php" class="btn btn-info btn-sm mt-5"> NEW </a>
                                    ';
                                } else {
                                    echo '
                                        <button type="submit" class="btn btn-primary btn-sm mt-5 w-50" name="btnsave">Save</button>
                                        ';
                                }
                                ?>
                            </div>
                            <!-- Employee Modal -->
                            <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="employeeModalLabel">Select Employee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover" id="employeeTable">
                                                <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Employee Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Fetch employee data along with employee type from the database
                                                    $query = "SELECT employee.Code, employee.Lastname, employeetype.EmployeeType 
                                                            FROM employee
                                                            LEFT JOIN employeetype ON employee.EmployeeType = employeetype.Id
                                                            WHERE employee.del = 1";
                                                    $result = $conn->query($query);

                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr ondblclick='selectEmployee(this)'>";
                                                        echo "<td>" . htmlspecialchars($row['Code']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['Lastname']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['EmployeeType']) . "</td>";
                                                        echo "</tr>";
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
                             <!-- JavaScript for automatic calculation -->
    <script>
        function calculateSalaries() {
            const baseSalary = parseFloat(document.getElementById("basesalary").value) || 0;
            const numOfDay = parseFloat(document.getElementById("numofday").value) || 0;
            const numOfMonth = parseFloat(document.getElementById("numofmonth").value) || 0;
            const bonus = parseFloat(document.getElementById("bonus").value) || 0;
            const allowance = parseFloat(document.getElementById("allowance").value) || 0;
            const seniority = parseFloat(document.getElementById("seniority").value) || 0;
            const pension = parseFloat(document.getElementById("pension").value) || 0;

            const interimSalary = numOfMonth > 0 ? (baseSalary * numOfDay) / numOfMonth : 0;
            document.getElementById("interimsalary").value = interimSalary.toFixed(2);

            const netSalary = baseSalary + bonus + allowance + seniority - pension;
            document.getElementById("netsalary").value = netSalary.toFixed(2);
        }

                // Define the selectEmployee function
        function selectEmployee(row) {
            // Ensure row is a valid element and not null
            if (row) {
                const code = row.cells[0].textContent;
                const name = row.cells[1].textContent;
                const employeeType = row.cells[2].textContent;

                // Populate fields with data from the selected row
                document.getElementById('codeemployee').value = code;
                document.getElementById('employee').value = name;
                document.getElementById('employeetype').value = employeeType;

                // Close the modal
                $('#employeeModal').modal('hide');
            }
        }

        // Make sure jQuery and Bootstrap are loaded correctly
        $(document).ready(function() {
            // No additional setup needed here for double-click handling
        });
    </script>
    <!-- Scroll to Top Button-->
    <?php include './include/scroll-btn.php' ?>

    <!-- Logout Modal-->
    <?php include './include/logout-modal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Include Bootstrap's JS and jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>