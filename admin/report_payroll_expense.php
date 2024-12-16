<?php
include('include/head.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Report Payroll</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="pos.php" class="d-none d-sm-inline btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> POS</a>
                            <!-- <i class="fa fa-plus-square" aria-hidden="true"></i> -->
                        </div>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTable" width="auto" cellspacing="0" style="font-size: small; ">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Payroll Code</th>
                                            <th>Type</th>
                                            <th>Employee</th>
                                            <th>Interim Salary</th>
                                            <th>Base Salary</th>
                                            <th>Bonus</th>
                                            <th>Allowance</th>
                                            <th>Seniority Payment</th>
                                            <th>Net Salary Payment</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total</th>
                                            <th id="totalInterimSalary"></th>
                                            <th id="totalBaseSalary"></th>
                                            <th id="totalBonus"></th>
                                            <th id="totalAllowance"></th>
                                            <th id="totalSeniority"></th>
                                            <th id="totalSalaryPayment"></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        // Initialize the totals
                                        $totalInterimSalary = 0;
                                        $totalBaseSalary = 0;
                                        $totalBonus = 0;
                                        $totalAllowance = 0;
                                        $totalSeniority = 0;
                                        $totalSalaryPayment = 0;

                                        $sqlPayroll = "SELECT * FROM `payroll`";
                                        $resultPayroll = $conn->query($sqlPayroll);
                                        // Loop through the rows and accumulate the totals
                                        while ($rowPayroll = $resultPayroll->fetch_assoc()) {
                                            $totalInterimSalary += $rowPayroll['InterimSalary'];
                                            $totalBaseSalary += $rowPayroll['BaseSalary'];
                                            $totalBonus += $rowPayroll['Bonus'];
                                            $totalAllowance += $rowPayroll['Allowance'];
                                            $totalSeniority += $rowPayroll['Seniority'];
                                            $totalSalaryPayment += $rowPayroll['SalaryPayment'];
                                        }
                                        ?>
                                        <?php foreach ($resultPayroll as $rowPayroll) : ?>
                                            <tr>
                                                <td><?= $rowPayroll['Date'] ?></td>
                                                <td><?= $rowPayroll['Code'] ?></td>
                                                <td><?= $rowPayroll['Type']; ?></td>
                                                <td><?= $rowPayroll['Employee']; ?></td>
                                                <td><?= $rowPayroll['InterimSalary']; ?></td>
                                                <td><?= $rowPayroll['BaseSalary']; ?></td>
                                                <td><?= $rowPayroll['Bonus']; ?></td>
                                                <td><?= $rowPayroll['Allowance']; ?></td>
                                                <td><?= $rowPayroll['Seniority']; ?></td>
                                                <td><?= $rowPayroll['SalaryPayment']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

                                <script>
                                    // Insert the calculated totals into the table footer
                                    document.getElementById('totalInterimSalary').innerText = <?= $totalInterimSalary ?>;
                                    document.getElementById('totalBaseSalary').innerText = <?= $totalBaseSalary ?>;
                                    document.getElementById('totalBonus').innerText = <?= $totalBonus ?>;
                                    document.getElementById('totalAllowance').innerText = <?= $totalAllowance ?>;
                                    document.getElementById('totalSeniority').innerText = <?= $totalSeniority ?>;
                                    document.getElementById('totalSalaryPayment').innerText = <?= $totalSalaryPayment ?>;
                                </script>

                            </div>
                        </div>
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

    <!-- Search -->
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // controll alert
        $(document).ready(function() {
            // Event listener for when the alert is closed
            $('#alert-success').on('closed.bs.alert', function() {
                // Action to perform after the alert is closed
                console.log('Alert closed');
                // You can perform additional actions here, such as redirecting the user
                window.location.href = "product-list.php";
            });

            // Alternatively, you can automatically close the alert after some time
            setTimeout(function() {
                $('#alert-success').alert('close');
            }, 2000); // Adjust the time (2000 milliseconds = 2 seconds) as needed
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

</body>

</html>