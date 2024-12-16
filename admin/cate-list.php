<?php
include('include/head.php');
include('function_category.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Categories List</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Categories List</h1>
                        <a href="cate-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Add New</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Create By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Create By</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include('confirm_delete.php');
                                        category_delete();

                                        // Optimized SQL Query with JOIN to fetch all required data
                                        $sqlSelectcate = "
                                                            SELECT c.*, u.Username 
                                                            FROM `category` c 
                                                            LEFT JOIN `user` u ON c.CreateBy = u.Id 
                                                            WHERE c.del = 1";
                                        $final = $conn->query($sqlSelectcate);

                                        if ($final && $final->num_rows > 0) {
                                            while ($rowcate = $final->fetch_assoc()) {
                                                // Determine Status Labels
                                                $statusLabel = $rowcate['Status'] == 1 ? "Enable" : "Disable";
                                                $statusClass = $rowcate['Status'] == 1 ? "badge-success" : "badge-secondary";
                                                $statusLink = "statusCategory.php?Id={$rowcate['Id']}&Status=" . ($rowcate['Status'] == 1 ? 0 : 1);
                                        ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($rowcate['Name']) ?></td>
                                                    <td><?= htmlspecialchars($rowcate['Description']) ?></td>
                                                    <td>
                                                        <p>
                                                            <a href="<?= $statusLink ?>" class="badge badge-lg <?= $statusClass ?> text-white"><?= $statusLabel ?></a>
                                                        </p>
                                                    </td>
                                                    <td><img src="ImageCategory/<?= htmlspecialchars($rowcate['Image']) ?>" alt="Category Image" width="50px"></td>
                                                    <td><?= htmlspecialchars($rowcate['Username'] ?? 'Unknown') ?></td>
                                                    <td>
                                                        <a href="cate-add.php?Id=<?= $rowcate['Id'] ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        <a href="cate-add.php?view=<?= $rowcate['Id'] ?>" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" data-href="cate-list.php?delId=<?= $rowcate['Id'] ?>"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="6" class="text-center">No data found.</td></tr>';
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