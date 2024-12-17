<?php
// session_start();
include('include/head.php');
include('function_recieve_stock.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Stock Moment</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Stock Moment</h1>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="pos.php" class="d-none d-sm-inline btn btn-success shadow-sm"><i class="fa fa-plus-square" aria-hidden="true"></i> POS</a>
                        </div>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Product Code</th>
            <th>Product</th>
            <th>UOM</th>
            <th>Total Stock In</th>
            <th>Total Stock Out</th>
            <th>Remain</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Product Code</th>
            <th>Product</th>
            <th>UOM</th>
            <th>Total Stock In</th>
            <th>Total Stock Out</th>
            <th>Remain</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        // Optimized SQL query with GROUP BY and SUM
        $INV = "SELECT 
                    i.ProCode,
                    i.ProName,
                    u.Name AS UOM_Name,
                    SUM(p.Qty_In) AS Total_Stock_In,
                    SUM(i.QTY) AS Total_Stock_Out
                FROM 
                    invoice i
                LEFT JOIN 
                    pro_in p ON i.Id = p.Id
                LEFT JOIN 
                    uom u ON i.UOM = u.Id
                WHERE 
                    i.del = 1
                GROUP BY 
                    i.ProCode, i.ProName, u.Name";

        $result = $conn->query($INV);

        // Check if query executed successfully
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalStockIn = $row['Total_Stock_In'] ?? 0;
                $totalStockOut = $row['Total_Stock_Out'] ?? 0;
                $remain = $totalStockIn - $totalStockOut;
        ?>
                <tr>
                    <td><?= htmlspecialchars($row['ProCode']); ?></td>
                    <td><?= htmlspecialchars($row['ProName']); ?></td>
                    <td><?= htmlspecialchars($row['UOM_Name']); ?></td>
                    <td><?= $totalStockIn; ?></td>
                    <td><?= $totalStockOut; ?></td>
                    <td><?= $remain; ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='6'>No data available</td></tr>";
        }
        ?>
    </tbody>
</table>

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
                window.location.href = "recieve-stock-list.php";
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