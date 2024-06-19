<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
include ('function_pos_invoice.php');
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - POS Inoive</title>

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
                        <h1 class="h3 mb-0 text-gray-800">POS Invoice</h1>
                        <a href="pos-invoice-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"> Invoice List</a>
                    </div>
                    <!-- form Receive Stock -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    // // call function Receive Stock
                                    // receive_stock();
                                    // // call data for update and view
                                    // if (isset($_REQUEST['Id'])) {
                                    //     $receiveId = $_REQUEST['Id'];                                   
                                    //     update_receive_stock();
                                    //     $rowFrm = $conn->query("SELECT * FROM `pro_in` WHERE Id=$receiveId")->fetch_assoc();
                                    // }elseif(isset($_REQUEST['view'])){
                                    //     $receiveId = $_REQUEST['view'];                                   
                                    //     $rowFrm = $conn->query("SELECT * FROM `pro_in` WHERE Id=$receiveId")->fetch_assoc();
                                    // }
                                    //  else {
                                    //     $rowFrm = array("RecieveDate" => "", "RecieveBy" => " ", "Supplier" => "", "PurchaseNo" => "","ProId" => "","Uom" => "","Qty_In" => "","Price_In" => "","DiscountAmount" => "","Currency" => "","Description" => "","Paid" => "","CreateBy" => "","UpdateAt" => "",);
                                    // }
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="Sale Date">Sale Date</label>
                                                        <input type="date" class="form-control mb-2 border-left-danger" name="saledate" required value="<?php echo ''.htmlspecialchars($rowFrm['SaleDate']).'' ?>">

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="Table">Table</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="table" >
                                                            <?php
                                                            $sqlTable = "SELECT * FROM `table`";
                                                            $qrTable = $conn->query($sqlTable);
                                                            while ($rowTable = $qrTable->fetch_assoc()) {
                                                                if ($rowTable['Id'] == $rowFrm['TableId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowTable['Id'] . '" ' . $sel . '>' . $rowTable['Name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="Sale By">Sale By(Emp)</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="saleby" >
                                                            <?php
                                                            $sqlEmployee = "SELECT * FROM `employee`";
                                                            $qrEmployee = $conn->query($sqlEmployee);
                                                            while ($rowEmployee = $qrEmployee->fetch_assoc()) {
                                                                if ($rowEmployee['Id'] == $rowFrm['SaleBy']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowEmployee['Id'] . '" ' . $sel . '>' . $rowEmployee['Firstname'] . ' ' . $rowEmployee['Lastname'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="SaleNo">Sale No.</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="saleno" required value="<?php // echo ''.htmlspecialchars($rowFrm['SaleNo']).'' ?>" >
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Customer">Customer</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="Customer">
                                                            <?php
                                                            $sqlCurrency = "SELECT * FROM `customer`";
                                                            $qrCurrency = $conn->query($sqlCurrency);
                                                            while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                if ($rowCurrency['Id'] == $rowFrm['Customer']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . $rowCurrency['Name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Product">Product</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="product">
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
                                                        <label for="UOM">UOM</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="uom">
                                                            <?php
                                                            $sqlPro = "SELECT * FROM `uom`";
                                                            $qrPro = $conn->query($sqlPro);
                                                            while ($rowPro = $qrPro->fetch_assoc()) {
                                                                if ($rowPro['Id'] == $rowFrm['Uom']) $sel = 'selected';
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
                                                        <input type="number" class="form-control mb-2 border-left-danger" name="quantity" required value="<?php echo ''.$rowFrm['Qty_Out'].'' ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="QuantityFree">Quantity Free</label>
                                                        <input type="number" class="form-control mb-2 border-left-danger" name="quantityfree" required value="<?php echo ''.$rowFrm['Qty_Out_Free'].'' ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="Price">Price</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="price" required value="<?php // echo ''.$rowFrm['Price_In'].'' ?>">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Paid">Paid</label>
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="paid" required value="<?php // echo ''.$rowFrm['Paid'].'' ?>">
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
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="discount" value="<?php // echo ''.$rowFrm['DiscountAmount'].'' ?>">
                                                    </div>
                                                   
                                                </div>

                                            </div>
                                            <label for="Description">Description</label>
                                            <textarea type="text" class="form-control mb-2 " rows="3" cols="10" name="description" value="<?php // echo ''.htmlspecialchars($rowFrm['Description']).'' ?>" ><?php // echo ''.htmlspecialchars($rowFrm['Description']).'' ?></textarea>

                                            <input style="display: none;" type="text" class="form-control" name="txtupdate_at">
                                            <input style="display: none;" type="text" class="form-control" name="moment_pro_id">
                                            <input style="display: none;" type="text" class="form-control" name="moment_pro_in">
                                            <input style="display: none;" type="text" class="form-control" name="moment_pro_out">
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_REQUEST['Id'])) {
                                        echo '
                                                    <input type="submit" value="UPDATE" class="btn btn-success btn-sm " name="btnUpdate">
                                                    <a href="Receive-stock.php" class="btn btn-info btn-sm "> NEW </a>
                                                ';
                                    } elseif(isset($_REQUEST['view'])){
                                        echo '<a href="Receive-stock-list.php" class="btn btn-info btn-sm "> Back to list </a>';
                                    }
                                    else {
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