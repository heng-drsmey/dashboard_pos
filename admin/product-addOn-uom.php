<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
include('function_Pro.php');
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Add On UOM</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- style upload image -->
    <link href="css/img-style.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include './include/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?php include './include/topbar.php' ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-item-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add on UOM</h1>
                        <a href="product-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm">Product List</a>
                    </div>
                    <!-- form add product -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <!-- <pre> -->
                                            <?php
                                            // call function add product
                                            Product_addOn_uom();
                                            // Select data for update
                                            if (isset($_REQUEST['Id'])) {
                                                $Pro_Add_Uom = $_REQUEST['Id'];
                                                update_add_uom();
                                                $rowFrm = $conn->query("SELECT * FROM `productsku` WHERE Id=$Pro_Add_Uom")->fetch_assoc();
                                            } else {
                                                $rowFrm = array("ProductId" => "", "UomId" => "", "Price" => "", "Currency" => "",);
                                            }
                                            // echo var_dump($rowFrm);
                                            ?>
                                            <!-- </pre> -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-body">
                                                        <label for="Product">Product</label>
                                                        <select class="form-control" style="width: 100%;" name="txtproduct">
                                                            <?php
                                                            $sqlPro = "SELECT * FROM `product`";
                                                            $qrPro = $conn->query($sqlPro);
                                                            while ($rowPro = $qrPro->fetch_assoc()) {
                                                                if ($rowPro['Id'] == $rowFrm['ProductId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowPro['Id'] . '" ' . $sel . '>' . $rowPro['Name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="UOM">UOM</label>
                                                        <select class="form-control" style="width: 100%;" name="txtuom">
                                                            <?php
                                                            $sqlUom = "SELECT * FROM `uom`";
                                                            $qrUom = $conn->query($sqlUom);
                                                            while ($rowUom = $qrUom->fetch_assoc()) {
                                                                if ($rowUom['Id'] == $rowFrm['UomId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowUom['Id'] . '" ' . $sel . '>' . $rowUom['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="Price">Price</label>
                                                                <input type="text" class="form-control" name="txtprice" value="<?php echo '' . $rowFrm['Price'] . '' ?>" required>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="Currency">Currency</label>
                                                                <select class="form-control" style="width: 100%;" name="txtcurrency">
                                                                    <?php
                                                                    $sqlCurrency = "SELECT * FROM `currency`";
                                                                    $qrCurrency = $conn->query($sqlCurrency);
                                                                    while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                        if ($rowCurrency['Id'] == $rowFrm['Currency']) $sel = 'selected';
                                                                        else $sel = '';
                                                                        echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . $rowCurrency['Code'] . '</option>';
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12" style="display: none;">
                                                            <label for="update">update</label>
                                                            <input type="text" class="form-control " name="txtupdate_at" value="<?php echo '' . $rowFrm['UpdateAt'] . '' ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            if (isset($_REQUEST['Id'])) {
                                                echo '
                                                    <input type="submit" value="UPDATE" class="btn btn-success btn-sm mt-5" name="btnUpdate">
                                                    <a href="product-addOn-uom.php" class="btn btn-info btn-sm mt-5"> NEW </a>
                                                ';
                                            } else {
                                                echo '
                                                    <button type="submit" class="btn btn-primary btn mt-5 " name="btnAdd">Save</button>
                                                ';
                                            }
                                            ?>
                                        </form>
                                        <!-- end form  -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>P. Name</th>
                                                <th>UOM</th>
                                                <th>Price</th>
                                                <th>Currency</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>P. Name</th>
                                                <th>UOM</th>
                                                <th>Price</th>
                                                <th>Currency</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $sqlPro = "SELECT * FROM `productsku`";
                                            $item = $conn->query($sqlPro);
                                            $rowPro = $item->fetch_assoc();
                                            ?>
                                            <?php foreach ($item as $rowPro_add_uom) :
                                                $product = $conn->query("SELECT * FROM `product` WHERE Id=" . $rowPro_add_uom['ProductId'])->fetch_assoc();
                                                $Uom = $conn->query("SELECT * FROM `uom` WHERE Id=" . $rowPro_add_uom['UomId'])->fetch_assoc();
                                                $Currency = $conn->query("SELECT * FROM `currency` WHERE Id=" . $rowPro_add_uom['Currency'])->fetch_assoc();

                                            ?>
                                                <tr>
                                                    <td><?= $product['Name'] ?></td>
                                                    <td><?= $Uom['Name'] ?></td>
                                                    <td><?= $rowPro_add_uom['Price'] ?></td>
                                                    <td><?= $Currency['Code'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($product['Status'] == 1) {
                                                            echo '<p><a href="statusPro.php?Id=' . $product['Id'] . '&Status=1" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                        } else {
                                                            echo '<p><a href="statusPro.php?Id=' . $product['Id'] . '&Status=0" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php
                                                    delete_add_uom();
                                                    ?>
                                                    <td>
                                                        <a href="product-addOn-uom.php?Id=<?= $rowPro_add_uom['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                        <a href="product-addOn-uom.php?delId=<?= $rowPro_add_uom['Id'] ?>" class="btn btn-outline-danger btn-sm" ><i class="fas fa-trash"></i></a>

                                                    </td>
                                                </tr>

                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--content-fluid-->
            </div><!--content-->
        </div> <!--content-wrapper-->
    </div> <!--wrapper-->
    <?php include('include/footer.php') ?>
    </script>
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
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Upload image script -->
    <script src="js/img-script.js"></script>
</body>

</html>