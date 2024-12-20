<!-- Session user  -->
<?php
include('include/head.php');
include('function_user.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Invoice List</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- bootstrap 5.3.3 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
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
                        <h1 class="h3 mb-0 text-gray-800">Invoice List</h1>
                        <a href="pos.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> POS</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Invoice Number</th>
                                            <th>Total Amount</th>
                                            <th>Discount</th>
                                            <th>Total After Discount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Invoice Number</th>
                                            <th>Total Amount</th>
                                            <th>Discount</th>
                                            <th>Total After Discount</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        // $sqlInvoice = "SELECT 
                                        //                     invoice.InvoiceNo AS InvoiceNumber, 
                                        //                     DATE(invoice.CreateAt) AS InvoiceDate, 
                                        //                     SUM(invoice.TotalBeDis) AS TotalAmount, 
                                        //                     SUM(invoice.DiscountCur) AS Discount,
                                        //                     CASE 
                                        //                         WHEN SUM(invoice.DiscountCur) = 0 THEN SUM(invoice.TotalBeDis)
                                        //                         ELSE SUM(invoice.TotalBeDis) - SUM(invoice.DiscountCur)
                                        //                     END AS TotalAfterDiscount
                                        //                 FROM `invoice` 
                                        //                 WHERE invoice.del = 1 
                                        //                 AND DATE(invoice.CreateAt) = CURDATE() -- Filter for the current date
                                        //                 GROUP BY invoice.InvoiceNo, DATE(invoice.CreateAt)
                                        //                 ORDER BY InvoiceDate ASC
                                        //                 ";

                                        $sqlInvoice = " SELECT 
                                                            invoice.InvoiceNo AS InvoiceNumber, 
                                                            DATE(invoice.CreateAt) AS InvoiceDate, 
                                                            SUM(invoice.QTY * invoice.Price) AS TotalAmount, -- Sum of QTY * Price
                                                            invoice.DiscountCur AS Discount, -- Show Discount directly (no sum)
                                                            CASE 
                                                                WHEN invoice.DiscountCur = 0 THEN SUM(invoice.QTY * invoice.Price)
                                                                ELSE SUM(invoice.QTY * invoice.Price) - invoice.DiscountCur
                                                            END AS TotalAfterDiscount
                                                        FROM `invoice` 
                                                        WHERE invoice.del = 1 
                                                        AND DATE(invoice.CreateAt) = CURDATE() -- Filter for the current date
                                                        GROUP BY invoice.InvoiceNo, invoice.DiscountCur, DATE(invoice.CreateAt) -- Group by InvoiceNumber and DiscountCur
                                                        ORDER BY InvoiceDate DESC


                                                ";
                                        $Invoice = $conn->query($sqlInvoice);
                                        if ($Invoice) {
                                            while ($rowInvoice = $Invoice->fetch_assoc()) :
                                        ?>
                                                <tr>
                                                    <td><?= date('d-m-Y', strtotime($rowInvoice['InvoiceDate'])) ?></td>
                                                    <td><?= htmlspecialchars($rowInvoice['InvoiceNumber']) ?></td>
                                                    <td><?= number_format($rowInvoice['TotalAmount'], 2) ?></td>
                                                    <td><?= number_format($rowInvoice['Discount'], 2) ?></td>
                                                    <td><?= number_format($rowInvoice['TotalAfterDiscount'], 2) ?></td>
                                                    <td><a href="format_receipt.php?InvoiceNo=<?= $rowInvoice['InvoiceNumber'] ?>" class="badge badge-success badge-lg " id="reprint" ><i class="fa-solid fa-print"></i> Reprint</a></td>
                                                </tr>
                                        <?php endwhile;
                                        } else {
                                            echo "<tr><td colspan='5'>No records found.</td></tr>";
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
                    window.location.href = "user-list.php";
                });

                // Alternatively, you can automatically close the alert after some time
                setTimeout(function() {
                    $('#alert-success').alert('close');
                }, 2000); // Adjust the time (2000 milliseconds = 2 seconds) as needed
            });
        </script>
    </div>
    <!-- End of Page Wrapper -->

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