<!-- Session user  -->
<?php
include('include/head.php');
include('function_user.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Users List</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- bootstrap 5.3.3 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
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
                        <h1 class="h3 mb-0 text-gray-800">Users List</h1>
                        <a href="user-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Add New</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Employee</th>
                                            <!-- <th>Password</th> -->
                                            <th>Role</th>
                                            <th>OutLet Or Company</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Active</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Employee</th>
                                            <!-- <th>Password</th> -->
                                            <th>Role</th>
                                            <th>OutLet Or Company</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Active</th>
                                        </tr>
                                    </tfoot>
                                    <?php
                                        include('confirm_delete.php');
                                        delete_user();
                                    ?>
                                    <tbody>
                                        <?php
                                        $sqlUser = "SELECT * FROM `user` WHERE del=1";
                                        $item = $conn->query($sqlUser);
                                        $rowUser = $item->fetch_assoc();
                                        ?>
                                        <?php foreach ($item as $rowUser) :
                                            $outlet = $conn->query("SELECT * FROM `outlet` WHERE Id=" . $rowUser['OutletId'])->fetch_assoc();
                                            $role = $conn->query("SELECT * FROM `role` WHERE Id=" . $rowUser['RoleId'])->fetch_assoc();
                                            $emp = $conn->query("SELECT * FROM `employee` WHERE Id=" . $rowUser['EmployeeId'])->fetch_assoc();
                                        ?>
                                            <tr>
                                                <td><?= $rowUser['Username'] ?></td>
                                                <td><?= $emp['Firstname'] ?> <?= $emp['Lastname'] ?></td>
                                                <!-- <td class="password"><?= $rowUser['Password'] ?></td> -->
                                                <td><?= $role['Name'] ?></td>
                                                <td><?= $outlet['Name'] ?></td>
                                                <td><?= $rowUser['Remark'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($rowUser['Status'] == 1) {
                                                        echo '<p><a href="statusUser.php?Id=' . $rowUser['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                    } else {
                                                        echo '<p><a href="statusUser.php?Id=' . $rowUser['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                    }
                                                    ?>
                                                </td>
                                               
                                                <td>
                                                    <a href="user-add.php?Id=<?= $rowUser['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" data-href="user-list.php?delId=<?= $rowUser['Id'] ?>"><i class="fas fa-trash"></i></button>
                                                    
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
// controll alert
        $(document).ready(function() {
    // Event listener for when the alert is closed
    $('#alert-success').on('closed.bs.alert', function () {
        // Action to perform after the alert is closed
        console.log('Alert closed');
        // You can perform additional actions here, such as redirecting the user
        window.location.href = "user-list.php";
    });

    // Alternatively, you can automatically close the alert after some time
    setTimeout(function() {
        $('#alert-success').alert('close');
    }, 2000); // Adjust the time (2000 milliseconds = 2 seconds) as needed
});
    </script>
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