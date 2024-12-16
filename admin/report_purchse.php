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

    <title>Admin - Report Purchase</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Purchase</h1>
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
                                            <th>Receive Date</th>
                                            <th>Receive By</th>
                                            <th>Supplier</th>
                                            <th>Purchase No</th>
                                            <th>Product Name</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>Unit Cost</th>
                                            <th>Discount Amount</th>
                                            <th>Description</th>
                                            <th>Paid Amount</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Receive Date</th>
                                            <th>Receive By</th>
                                            <th>Supplier</th>
                                            <th>Purchase No</th>
                                            <th>Product Name</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>Unit Cost</th>
                                            <th>Discount Amount</th>
                                            <th>Description</th>
                                            <th>Paid Amount</th>
                                            <th>Status</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $sqlPayroll = "SELECT * FROM `pro_in`";
                                        $resultPayroll = $conn->query($sqlPayroll);
                                        $rowPayroll = $resultPayroll->fetch_assoc();
                                    ?>
                                    <?php foreach ($resultPayroll as $rowPayroll) :
                                        $Emp = $conn->query("SELECT * FROM `employee` WHERE Id=" . $rowPayroll['RecieveBy'])->fetch_assoc();
                                        $Supplier = $conn->query("SELECT * FROM `supplier` WHERE Id=" . $rowPayroll['Supplier'])->fetch_assoc();
                                        $Product = $conn->query("SELECT * FROM `product` WHERE Id=" . $rowPayroll['ProId'])->fetch_assoc();	
                                        $Uom = $conn->query("SELECT * FROM `uom` WHERE Id=" . $rowPayroll['Uom'])->fetch_assoc();
                                        $Currency = $conn->query("SELECT * FROM `currency` WHERE Id=" . $rowPayroll['Currency'])->fetch_assoc();
                                        $Status = $conn->query("SELECT * FROM `values` WHERE Id=" . $rowPayroll['PaymentStatus'])->fetch_assoc();	
                                    ?>


                                        <tr>
                                            <td><?= $rowPayroll['RecieveDate'] ?></td>
                                            <td><?= $Emp['Lastname'] ?></td>
                                            <td><?= $Supplier['Name']; ?></td>
                                            <td><?= $rowPayroll['PurchaseNo']; ?></td>
                                            <td><?= $Product['Name']; ?></td>
                                            <td><?= $Uom['Name']; ?></td>
                                            <td><?= $rowPayroll['Qty_In']; ?></td>
                                            <td><?= $Currency['Symbol']; ?><?= $rowPayroll['Price_In']; ?></td>
                                            <td><?= $rowPayroll['DiscountAmount']; ?></td>
                                            <td><?= $rowPayroll['Description']; ?></td>
                                            <td><?= $rowPayroll['Paid']; ?></td>
                                            <td>
                                                <!-- <?= $Status['Name']; ?> -->
                                                <?php
                                                    if ($rowPayroll['PaymentStatus'] == 4) {
                                                        echo '<p class="d-sm-inline badge badge-warning shadow-sm"> '.$Status['Name'].' </p>';
                                                    } else if ($rowPayroll['PaymentStatus'] == 5) {
                                                        echo '<p class="d-sm-inline badge badge-success shadow-sm"> '.$Status['Name'].' </p>';
                                                    } else {
                                                        echo '<p class="d-sm-inline badge badge-primary shadow-sm"> '.$Status['Name'].' </p>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
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