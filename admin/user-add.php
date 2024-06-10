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
                    <!-- form add user -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    // call function add user
                                    add_user();
                                    // call data for update
                                    if (isset($_REQUEST['Id'])) {
                                        $userId = $_REQUEST['Id'];                                   
                                        update_user();
                                        $rowUser = $conn->query("SELECT * FROM `user` WHERE Id=$userId")->fetch_assoc();
                                        // $pro = $conn->query("SELECT * FROM `user` WHERE Id=" . $userId['userId'])->fetch_assoc();
                                    } else {
                                        $rowUser = array("OutletId" => "", "EmployeeId" => "", "RoleId" => "","CreateBy" => "","Username" => "","Password" => "","Remark" => "",);
                                    }
                                    // echo var_dump($rowUser);
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Outlet">Outlet</label>
                                                        <select class="form-control border-left-danger" style="width: 100%;" name="txtoutlet">
                                                            <?php
                                                            $sqloutlet = "SELECT * FROM `outlet`";
                                                            $qroutlet = $conn->query($sqloutlet);
                                                            while ($rowoutlet = $qroutlet->fetch_assoc()) {
                                                                if ($rowoutlet['Id'] == $rowUser['OutletId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowoutlet['Id'] . '" ' . $sel . '>' . $rowoutlet['Name'] . '</option>';
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
                                                                if ($rowEmp['Id'] == $rowUser['EmployeeId'])  $sel = 'selected';
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
                                                                if ($rowRole['Id'] == $rowUser['RoleId']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowRole['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowRole['Name']) . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="CreateBy">CreateBy</label>
                                                        <select class="form-control border-left-danger" style="width: 100%;" name="txtcreateby">
                                                            <?php
                                                            $sqlUser1 = "SELECT * FROM `user` WHERE del=1";
                                                            $qrUser1 = $conn->query($sqlUser1);
                                                            while ($rowUser1 = $qrUser1->fetch_assoc()) {
                                                                if ($rowUser1['Id'] == $rowUser['CreateBy']) $sel = 'selected';
                                                                else $sel = '';
                                                                echo '<option value="' . $rowUser1['Id'] . '" ' . $sel . '>' . htmlspecialchars($rowUser1['Username']) . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="Username">Username</label>
                                                        <input type="text" class="form-control border-left-danger" name="txtusername" required value="<?php echo''.htmlspecialchars($rowUser['Username']).''; ?>">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="Password">Password</label>
                                                        <input type="text" class="form-control border-left-danger" name="txtpassword" required value="<?php echo '' .htmlspecialchars($rowUser['Password']) . '' ?>">
                                                    </div>
                                                </div>
                                                <label for="Remark">Remark</label>
                                                <input type="text" class="form-control" name="txtremark" value="<?php echo ''.htmlspecialchars($rowUser['Remark']).'' ?>">

                                                <input style="display: none;" type="text" class="form-control" name="txtupdate_at" >
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