<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
include('function_payment_method.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Payment Method</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Payment Method</h1>
                        <!-- <a href="Tableduct-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm" disabled><i class="fas fa-user text-white-50"></i> Add New</a> -->
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <!-- Add UOM -->
                                <div class="col-4">
                                    <form method="post" enctype="multipart/form-data">
                                        <?php
                                        //call function Add()
                                        Add();
                                        // Select data for update
                                        if (isset($_REQUEST['Id'])) {
                                            $payment_method_Id = $_REQUEST['Id'];
                                            update();
                                            $rowFrm = $conn->query("SELECT * FROM `paymentmethod` WHERE Id=$payment_method_Id")->fetch_assoc();
                                        } else {
                                            $rowFrm = array("Name" => "",  "Code" => "", "CreateBy" => "",);
                                        }
                                        ?>
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
                                                <label for="Code">Code</label>
                                                <input type="text" class="form-control border-left-danger" name="txtcode" value="<?php echo '' . $rowFrm['Code'] . '' ?>" required>
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control border-left-danger" name="txtname" value="<?php echo '' . $rowFrm['Name'] . '' ?>" required>
                                                <label for="CreateBy">CreateBy</label>
                                                <select class="form-control mb-2" style="width: 100%;" name="txtcreateby">
                                                    <?php
                                                    $sqlcreateby = "SELECT * FROM `user`WHERE del=1";
                                                    $qrcreateby = $conn->query($sqlcreateby);
                                                    while ($rowcreateby = $qrcreateby->fetch_assoc()) {
                                                        if ($rowcreateby['Id'] == $rowFrm['CreateBy']) $sel = 'selected';
                                                        else $sel = '';
                                                        echo '<option value="' . $rowcreateby['Id'] . '" ' . $sel . '>' . $rowcreateby['Username'] . '</option>';
                                                    }

                                                    ?>
                                                </select>

                                                <input style="display: none;" type="text" class="form-control " name="txtupdate_at">
                                                <!-- <div class="form-check form-switch ms-4 mt-3">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="status">
                                                    <label class="form-check-label mb-2" for="status">Disable</label>
                                                </div> -->

                                                <!-- <input type="submit" class="btn btn-primary mt-5" name="btnAdd" value="Save"> -->
                                                <?php
                                                if (isset($_REQUEST['Id'])) {
                                                    echo '
                                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm " name="btnUpdate">
                                                        <a href="payment-method.php" class="btn btn-info btn-sm"> NEW </a>
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
                                <div class="col-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>CreateBy</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>CreateBy</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <?php
                                                include('confirm_delete.php');
                                                delete();
                                            ?>
                                            <tbody>
                                                <?php
                                                $sqlPayment_method = "SELECT * FROM `paymentmethod` WHERE del=1";
                                                $item = $conn->query($sqlPayment_method);
                                                $rowPayment_method = $item->fetch_assoc();
                                                ?>
                                                <?php foreach ($item as $rowPayment_method) :

                                                    $createby = $conn->query("SELECT * FROM `user` WHERE Id=" . $rowPayment_method['CreateBy'])->fetch_assoc();
                                                    $i = 1;
                                                ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $rowPayment_method['Code'] ?></td>
                                                        <td><?= $rowPayment_method['Name'] ?></td>
                                                        <td><?= $createby['Username'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($rowPayment_method['Status'] == 1) {
                                                                echo '<p><a href="statusPayment_method.php?Id=' . $rowPayment_method['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                            } else {
                                                                echo '<p><a href="statusPayment_method.php?Id=' . $rowPayment_method['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <a href="payment-method.php?Id=<?= $rowPayment_method['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" data-href="payment-method.php?delId=<?= $rowPayment_method['Id'] ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php  $i++; ?>
                                                <?php endforeach  ?>
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

        // controll alert
        $(document).ready(function() {
        // Event listener for when the alert is closed
        $('#alert-success').on('closed.bs.alert', function () {
            // Action to perform after the alert is closed
            console.log('Alert closed');
            // You can perform additional actions here, such as redirecting the user
            window.location.href = "payment-method.php";
        });

        // Alternatively, you can automatically close the alert after some time
        setTimeout(function() {
            $('#alert-success').alert('close');
        }, 2000); // Adjust the time (2000 milliseconds = 2 seconds) as needed
    });
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