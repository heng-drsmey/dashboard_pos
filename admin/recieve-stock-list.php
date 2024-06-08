<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
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

    <title>SB Admin 2 -  Stock Recieve List</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <a href="product.php" class="d-none d-sm-inline btn btn-success shadow-sm"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Product</a>
                            <a href="recieve-stock.php" class="d-none d-sm-inline btn btn-success shadow-sm"><i class="fa fa-plus-square" aria-hidden="true"></i> Recieve Stock</a>
                        </div>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Recieve Date</th>
                                            <th>Recieve By</th>
                                            <th>Purchase No.</th>
                                            <th>Supplier</th>
                                            <th>Product</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Paid</th>
                                            <th>Payment Status</th>
                                            <th>Discount</th>
                                            <th>Create By</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Recieve Date</th>
                                            <th>Recieve By</th>
                                            <th>Purchase No.</th>
                                            <th>Supplier</th>
                                            <th>Product</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Paid</th>
                                            <th>Payment Status</th>
                                            <th>Discount</th>
                                            <th>Create By</th>
                                            <th>Description</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <?php
                                    if (isset($_GET['delId'])) {
                                        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
                                        $sqlDeletePro = "DELETE FROM `pro_in` WHERE `Id`='$delId'";
                                        if ($conn->query($sqlDeletePro) === TRUE) {
                                            echo '
                                        <script>
                                            swal({
                                                title: "Success",
                                                text: "Data delete success",
                                                icon: "success",
                                            });
                                        </script> 
                                        ';
                                        } else {
                                            echo "Error deleting record: " . $conn->error;
                                        }
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                    <tbody>
                                        <?php
                                        $sqlPro = "SELECT * FROM `pro_in`";
                                        $item = $conn->query($sqlPro);
                                        $rowPro = $item->fetch_assoc();
                                        ?>
                                        <?php foreach ($item as $rowPro) :
                                            $product = $conn->query("SELECT * FROM `product` WHERE Id=" . $rowPro['ProId'])->fetch_assoc();
                                            $Uom = $conn->query("SELECT * FROM `uom` WHERE Id=" . $rowPro['Uom'])->fetch_assoc();
                                            $supplier = $conn->query("SELECT * FROM `supplier` WHERE Id=" . $rowPro['supplier'])->fetch_assoc();
                                            $CreateBy = $conn->query("SELECT * FROM `user` WHERE Id=" . $product['CreateBy'])->fetch_assoc();
                                            $Currency = $conn->query("SELECT * FROM `currency` WHERE Id=" . $rowPro['Currency'])->fetch_assoc();
                                            $payment_status = $conn->query("SELECT * FROM `values` WHERE Id=" . $rowPro['PaymentStatus'])->fetch_assoc();
                                            $employee = $conn->query("SELECT * FROM `employee` WHERE Id=" . $rowPro['RecieveBy'])->fetch_assoc();

                                        ?>

                                            <tr>
                                                <td><?= $product['RecieveDate'] ?></td>
                                                <td><?= $product['RecieveBy'] ?></td>
                                                <td><?= $product['Name'] ?></td>
                                                <td><?= $Uom['Name'] ?></td>
                                                <td><?= $Currency['Symbol'] ?><?= $rowPro['Price'] ?></td>
                                                <td><?= $Cate['Name'] ?></td>
                                                <td><?= $product['Description'] ?></td>
                                                <td><img src="ImageProduct/<?= $product['Image'] ?>" alt="" width="50px"></td>
                                                <td>
                                                    <?php
                                                    if ($product['Status'] == 1) {
                                                        echo '<p><a href="statusPro.php?Id=' . $product['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                    } else {
                                                        echo '<p><a href="statusPro.php?Id=' . $product['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?= $rowPro['CreateAt'] ?></td> -->
                                                <td><?= $CreateBy['Username'] ?></td>
                                                <td>
                                                    <a href="recieve-stock.php?ProId=<?= $rowPro['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                    <a href="recieve-stock-list.php?delId=<?= $rowPro['Id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
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