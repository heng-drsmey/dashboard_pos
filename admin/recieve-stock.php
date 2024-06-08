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

    <title>SB Admin 2 - Recieve Stock</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Recieve Stock</h1>
                        <a href="recieve-stock-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm">List Stock In</a>
                    </div>
                    <!-- form Recieve Stock -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    // call function Recieve Stock
                                    // addProduct();
                                    // call data for update
                                    // if (isset($_REQUEST['Id'])) {
                                    //     $productId = $_REQUEST['Id'];                                   
                                    //     // update();
                                    //     $rowFrm = $conn->query("SELECT * FROM `productsku` WHERE Id=$productId")->fetch_assoc();
                                    //     // $pro = $conn->query("SELECT * FROM `product` WHERE Id=" . $productId['ProductId'])->fetch_assoc();
                                    // } else {
                                    //     $rowFrm = array("Name" => "", "Code" => "", "Remark" => "",);
                                    // }
                                    ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Recieve Date">Recieve Date</label>
                                                        <input type="date" class="form-control mb-2 border-left-danger" name="recievedate" required>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Recieve By">Recieve By(Emp)</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="supplier">
                                                            <?php
                                                            $sqlEmployee = "SELECT * FROM `employee`";
                                                            $qrEmployee = $conn->query($sqlEmployee);
                                                            while ($rowEmployee = $qrEmployee->fetch_assoc()) {
                                                                if ($rowEmployee['Id'] == $rowFrm['RecieveBy']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowEmployee['Id'] . '" ' . $sel . '>' . $rowEmployee['Firstname'] . ' ' . $rowEmployee['Lastname'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="PurchaseNo">Purchase No.</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="purchaseno" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Supplier">Supplier</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="supplier">
                                                            <?php
                                                            $sqlCurrency = "SELECT * FROM `supplier`";
                                                            $qrCurrency = $conn->query($sqlCurrency);
                                                            while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                if ($rowCurrency['Id'] == $rowFrm['suppier']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . $rowCurrency['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Product">Product</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="supplier">
                                                            <?php
                                                            $sqlPro = "SELECT * FROM `product`";
                                                            $qrPro = $conn->query($sqlPro);
                                                            while ($rowPro = $qrPro->fetch_assoc()) {
                                                                if ($rowPro['Id'] == $rowFrm['ProId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowPro['Id'] . '" ' . $sel . '>' . $rowPro['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Currency">Currency</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="currency">
                                                            <?php
                                                            $sqlCurrency = "SELECT * FROM `currency`";
                                                            $qrCurrency = $conn->query($sqlCurrency);
                                                            while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                if ($rowCurrency['Id'] == $rowFrm['Currency']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . $rowCurrency['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="UOM">UOM</label>
                                                    <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="uom">
                                                        <?php
                                                        $sqlUom = "SELECT * FROM `uom`";
                                                        $qrUom = $conn->query($sqlUom);
                                                        while ($rowUom = $qrUom->fetch_assoc()) {
                                                            if ($rowUom['Id'] == $rowFrm['Uom']) $sel = 'selected';
                                                            else $sel = '';
                                                            echo '<option value="' . $rowUom['Id'] . '" ' . $sel . '>' . $rowUom['Name'] . '</option>';
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                    <div class="col-lg-4">
                                                        <label for="Quantity">Quantity</label>
                                                        <input type="number" class="form-control mb-2 border-left-danger" name="quantity" required>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="Price">Price</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="price" required>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Paid">Paid</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="paid" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Payment Status">Payment Status</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="paymentstatus">
                                                            <?php
                                                            $sqlCurrency = "SELECT * FROM `values` WHERE Id BETWEEN 4 AND 6";
                                                            $qrCurrency = $conn->query($sqlCurrency);
                                                            while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                if ($rowCurrency['Id'] == $rowFrm['PaymentStatus']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . $rowCurrency['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="DiscountAmount">Discount Amount</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="discount" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="CreateBy">CreateBy</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="txtcreateby">
                                                            <?php
                                                            $sqlUser = "SELECT * FROM `user`";
                                                            $qrUser = $conn->query($sqlUser);
                                                            while ($rowUser = $qrUser->fetch_assoc()) {
                                                                if ($rowUser['Id'] == $rowFrm['Id']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowUser['Id'] . '" ' . $sel . '>' . $rowUser['Username'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <label for="Description">Description</label>
                                            <textarea type="text" class="form-control mb-2 " rows="3" cols="10" name="description"></textarea>

                                            <input style="display: none;" type="text" class="form-control" name="txtupdate_at">
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_REQUEST['Id'])) {
                                        echo '
                                                    <input type="submit" value="UPDATE" class="btn btn-success btn-sm " name="btnUpdate">
                                                    <a href="product-add.php" class="btn btn-info btn-sm "> NEW </a>
                                                ';
                                    } else {
                                        echo '
                                                    <button type="submit" class="btn btn-primary bg-gradient-info w-25" name="btnAdd">Save</button>
                                                ';
                                    }
                                    ?>
                            </div>
                        </div>
                        </form>
                        <!-- end form  -->
                    </div>
                </div>
            </div>
        </div> <!--content-fluid-->
    </div><!--content-->
    </div> <!--content-wrapper-->
    </div> <!--wrapper-->
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
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Upload image script -->
    <script src="js/img-script.js"></script>
</body>

</html>