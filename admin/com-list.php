<?php
include('cn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Companies List</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- link sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   

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
                        <h1 class="h3 mb-0 text-gray-800">Companies List</h1>
                        <a href="com-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Add New</a>
                    </div>
                    <?php 
                    if(isset($_GET['delId'])) {
                        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
                        $sqlDeleteOutlet = "DELETE FROM `outlet` WHERE `Id`='$delId'";
                        if($conn->query($sqlDeleteOutlet) === TRUE) {
                            echo'
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
                    <!-- DataTales  -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>CreateBy</th>
                                            <th>CreateAt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>    
                                    <?php
                                    $sqloutlet = "SELECT * FROM `outlet`";
                                    $rs = $conn->query($sqloutlet);
                                    while ($rowOutlet = $rs->fetch_assoc()) {
                                        $Createby = $conn->query("SELECT * FROM `user` WHERE Id=" .$rowOutlet['CreateBy'])->fetch_assoc();
                                        echo '
                                            <tbody>
                                                <tr>
                                                    <td>'.$rowOutlet['Name'].'</td>
                                                    <td>'.$rowOutlet['Code'].'</td>
                                                    <td>'.$rowOutlet['Address'].'</td>
                                                    <td>'.$rowOutlet['Status'].'</td>
                                                    <td>'.$Createby['Username'].'</td>
                                                    <td>'.$rowOutlet['CreateAt'].'</td>
                                                    <td>
                                                        <a href="com-add.php?OutId='.$rowOutlet['Id'].'"  " class="btn btn-outline-primary btn-sm ">Edit</a>
                                                        <a href="com-list.php?delId='.$rowOutlet['Id'].'" class="btn btn-outline-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Outlet?\')">Delete</a> 
                                                
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            ';
                                    }
                                    ?>

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