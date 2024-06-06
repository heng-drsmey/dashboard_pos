<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
include('function_user.php');
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Add User</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Add User</h1>
                        <a href="user-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm">User List</a>
                    </div>
                    <!-- form add product -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    // call function add product
                                    add_user();
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
                                        <div class="col-lg-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Outlet">Outlet</label>
                                                        <!-- <input type="text" class="form-control" name="txtoutlet" required value="<?php // echo '' . $ProId['Code'] . '' 
                                                                                                                                        ?>"> -->
                                                        <select class="form-control border-left-danger" name="txtoutlet">
                                                            <?php
                                                            $sqlOutlet = "SELECT * FROM `outlet`";
                                                            $qrOutlet = $conn->query($sqlOutlet);
                                                            while ($rowOutlet = $qrOutlet->fetch_assoc()) {
                                                                if ($rowOutlet['Id'] == $rowUser['Id'])  $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowOutlet['Id'] . '" ' . $sel . '>' . $rowOutlet['Name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Employee">Employee</label>
                                                        <select class="form-control border-left-danger" name="txtemp">
                                                            <?php
                                                            $sqlEmp = "SELECT * FROM `employee`";
                                                            $qrEmp = $conn->query($sqlEmp);
                                                            while ($rowEmp = $qrEmp->fetch_assoc()) {
                                                                if ($rowEmp['Id'] == $rowUser['Id'])  $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowEmp['Id'] . '" ' . $sel . '>' . $rowEmp['Firstname'] . ' ' . $rowEmp['Lastname'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Role">Role</label>
                                                        <select class="form-control border-left-danger" style="width: 100%;" name="txtrole">
                                                            <?php
                                                            $sqlRole = "SELECT * FROM `role`";
                                                            $qrRole = $conn->query($sqlRole);
                                                            while ($rowRole = $qrRole->fetch_assoc()) {
                                                                if ($rowRole['Id'] == $rowFrm['Id']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowRole['Id'] . '" ' . $sel . '>' . $rowRole['Name'] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="CreateBy">CreateBy</label>
                                                        <select class="form-control border-left-danger" style="width: 100%;" name="txtcreateby">
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
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Username">Username</label>
                                                        <input type="text" class="form-control border-left-danger" name="txtusername" required value="">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Password">Password</label>
                                                        <input type="text" class="form-control border-left-danger" name="txtpassword" required value="<?php echo '' //  .$rowFrm['ProductId'] . '' ?>">
                                                    </div>
                                                </div>
                                                <label for="Remark">Remark</label>
                                                <input type="text" class="form-control" name="txtremark">


                                                <input style="display: none;" type="text" class="form-control" name="txtupdate_at">
                                                <!-- <div class="form-check form-switch ms-4 mt-3">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="status" name="txtstatus">
                                                    <label class="form-check-label mb-2 " for="status">Disable</label>
                                                </div> -->
                                                <?php
                                                if (isset($_REQUEST['Id'])) {
                                                    echo '
                                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm mt-5" name="btnUpdate">
                                                        <a href="user-add.php" class="btn btn-info btn-sm mt-5"> NEW </a>
                                                    ';
                                                } else {
                                                    echo '
                                                        <button type="submit" class="btn btn-primary btn-sm mt-5" name="btnAdd">Save</button>
                                                    ';
                                                }
                                                ?>
                                            </div>
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