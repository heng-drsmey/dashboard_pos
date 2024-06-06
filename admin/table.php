<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
include('function_table.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Table</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Table</h1>
                        <!-- <a href="Tableduct-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm" disabled><i class="fas fa-user text-white-50"></i> Add New</a> -->
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <!-- Add UOM -->
                                <div class="col-6">
                                    <form method="post" enctype="multipart/form-data">
                                    <?php
                                    //call function Add()
                                    Add();
                                    // Select data for update
                                    if (isset($_REQUEST['Id'])) {
                                        $tableId = $_REQUEST['Id'];                                   
                                        update();
                                        $rowFrm = $conn->query("SELECT * FROM `table` WHERE Id=$tableId")->fetch_assoc();
                                    } else {
                                        $rowFrm = array("Name" => "",  "Description" => "",);
                                    }
                                    ?>
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control" name="txtname" value="<?php echo '' . $rowFrm['Name'] . '' ?>" required>
                                                <label for="Remark">Remark</label>
                                                <input type="text" class="form-control" name="txtdesc" value="<?php echo '' . $rowFrm['Description'] . '' ?>" required>
                                                <input style="display: none;" type="text" class="form-control" name="txtupdate_at">
                                                <div class="form-check form-switch ms-4 mt-3">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="status">
                                                    <label class="form-check-label mb-2" for="status">Disable</label>
                                                </div>
                                               
                                                <!-- <input type="submit" class="btn btn-primary mt-5" name="btnAdd" value="Save"> -->
                                                <?php
                                                if (isset($_REQUEST['Id'])) {
                                                    echo '
                                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm" name="btnUpdate">
                                                        <a href="table.php" class="btn btn-info btn-sm"> NEW </a>
                                                    ';
                                                } else {
                                                    echo '
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btnAdd">Save</button>
                                                        ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- List UOM -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $sqlTable = "SELECT * FROM `table`";
                                                $item = $conn->query($sqlTable);
                                                $rowTable = $item->fetch_assoc();
                                                ?>
                                                <?php foreach ($item as $rowTable) :

                                                ?>
                                                    <tr>
                                                        <td><?= $rowTable['Name'] ?></td>
                                                        <td><?= $rowTable['Description'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($rowTable['Status'] == 1) {
                                                                echo '<p><a href="statusTable.php?Id=' . $rowTable['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                            } else {
                                                                echo '<p><a href="statusTable.php?Id=' . $rowTable['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php
                                                        delete();
                                                        ?>
                                                        <td>
                                                            <a href="table.php?Id=<?= $rowTable['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                            <a href="table.php?delId=<?= $rowTable['Id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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