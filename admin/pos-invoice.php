<?php
include('include/head.php');
include('function_pos_invoice.php');
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
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                                        <input type="date" class="form-control mb-2 border-left-danger" name="saledate" required value="<?php echo '' . htmlspecialchars($rowFrm['SaleDate']) . '' ?>">

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="Table">Table</label>
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="table">
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
                                                        <select class="form-control mb-2 border-left-danger" style="width: 100%;" name="saleby">
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
                                                        <input type="text" class="form-control mb-2 border-left-danger" name="saleno" required value="<?php // echo ''.htmlspecialchars($rowFrm['SaleNo']).'' 
                                                                                                                                                        ?>">
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
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product</th>
                                                            <th>UOM</th>
                                                            <th>Currency</th>
                                                            <th>Quantity</th>
                                                            <th>Quantity Free</th>
                                                            <th>Price</th>
                                                            <th>Discount Amount</th>
                                                            <th>Discription</th>
                                                            <!-- <th>Currency</th> -->
                                                            <th>
                                                                <button class="btn btn-primary add-row">+</button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope='row'> 1</th>
                                                            <td>
                                                            <!-- <label for="Product">Product</label> -->
                                                            <select class="form-control mb-2" style="width: 100%;" name="product">
                                                                <?php
                                                                $sqlPro = "SELECT * FROM `product` WHERE del=1";
                                                                $qrPro = $conn->query($sqlPro);
                                                                while ($rowPro = $qrPro->fetch_assoc()) {
                                                                    if ($rowPro['Id'] == $rowFrm['ProductId']) $sel = 'selected';
                                                                    else $sel = '';
                                                                    echo '<option value="' . $rowPro['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowPro['Name']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            </td>
                                                            <td>                                                           
                                                                <select class="form-control mb-2 " style="width: 100%;" name="txtuom">
                                                                <?php
                                                                $sqlUom = "SELECT * FROM `uom` WHERE del=1";
                                                                $qrUom = $conn->query($sqlUom);
                                                                while ($rowUom = $qrUom->fetch_assoc()) {
                                                                    if ($rowUom['Id'] == $rowFrm['UomId']) $sel = 'selected';
                                                                    else $sel = '';
                                                                    echo '<option value="' . $rowUom['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowUom['Name']) . '</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                            </td>
                                                            <td>
                                                            <select class="form-control" style="width: 100%;" name="currency">
                                                                    <?php
                                                                    $sqlCurrency = "SELECT * FROM `currency` WHERE del=1";
                                                                    $qrCurrency = $conn->query($sqlCurrency);
                                                                    while ($rowCurrency = $qrCurrency->fetch_assoc()) {
                                                                        if ($rowCurrency['Id'] == $rowFrm['Currency']) $sel = 'selected';
                                                                        else $sel = '';
                                                                        echo '<option value="' . $rowCurrency['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowCurrency['Code']) . '</option>';
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="quantity" id="" class="form-control "></td>
                                                            <td><input type="text" name="quantity_free" id="" class="form-control"></td>
                                                            <td><input type="text" name="price" id="" class="form-control"></td>
                                                            <td><input type="text" name="discount_amount" id="" class="form-control"></td>
                                                            <td><input type="text" name="discription" id="" class="form-control"></td>
                                                            <td><a href='javascript:void(0)' class='btn btn-danger delete-row'>-</a></td>
                                                        </tr>
                                                        <!-- Rows will be added here dynamically -->
                                                    </tbody>
                                                </table>
                                            </div>

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
                                    } elseif (isset($_REQUEST['view'])) {
                                        echo '<a href="Receive-stock-list.php" class="btn btn-info btn-sm "> Back to list </a>';
                                    } else {
                                        echo '
                                            <button type="submit" class="btn btn-primary bg-gradient-info w-25 float-right" name="btnAdd">Save</button>
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
    <script>
    $(document).ready(function () {
        var i = 1;
      $('thead').on('click', '.add-row', function () {
        
        i++;
        var tr =
        
          "<tr>" +
          "<th scope='row'> " +i+ "</th>" +
          "<td>"+
          "<select class='form-control mb-2' style='width: 100%;' name='product'>"+
            <?php
            $sqlPro = "SELECT * FROM `product` WHERE del=1";
            $qrPro = $conn->query($sqlPro);
            while ($rowPro = $qrPro->fetch_assoc()) {
                if ($rowPro['Id'] == $rowFrm['ProductId']) $sel = 'selected';
                else $sel = '';
                echo '<option value="' . $rowPro['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowPro['Name']) . '</option>';
            }
            ?>
        "</select>"+
          "</td>" +
          "<td>"+
            "<select class='custom-select '>"+
              "<option selected>--Select--</option>"+
              "<option value='1'>One</option>"+
              "<option value='2'>Two</option>"+
              "<option value='3'>Three</option>"+
            "</select>"+
        "</td>" +
          "<td><input type='text' class='form-control ' name='age[]'></td>" +
          "<td><input type='text' class='form-control' name='name[]'></td>" +
          "<td><input type='text' class='form-control' name='birth[]'></td>" +
          "<td><input type='text' class='form-control' name='age[]'></td>" +
          "<td><input type='text' class='form-control' name='name[]'></td>" +
          "<td><input type='text' class='form-control' name='birth[]'></td>" +
          "<td><a href='javascript:void(0)' class='btn btn-danger delete-row'>-</a></td>" +
          "</tr>";
        $('tbody').append(tr);
      });

      $('tbody').on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
      });
    });
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
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Upload image script -->
    <script src="js/img-script.js"></script>
</body>

</html>