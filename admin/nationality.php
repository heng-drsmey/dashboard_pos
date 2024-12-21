<?php
include('include/head.php');
include('function_nation.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Nationality</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    #wrapper {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    #page-content-wrapper {
        flex-grow: 1;
        overflow-y: auto;
    }
</style>
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
                        <h1 class="h3 mb-0 text-gray-800">Nationality</h1>
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
                                            // Call function nationality insert
                                            nation_insert();
                                            // Initialize an empty array for the form data
                                            $rowFrm = array(
                                                "Id" => "", "Nation" => "", "CreateBy" => "","Remark" => "","CreateAt" => "", "UpdateAt" => "", "Status" => ""
                                            );
                                            // check if the `Id` parameter is set and valid
                                            if(isset($_REQUEST['Id']) && is_numeric($_REQUEST['Id'])) {
                                               $nationid = $conn->real_escape_string($_REQUEST['Id']);
                                               // Call the nationality update function if needed
                                               nation_update();
                                               // Fetch the nationality data for update
                                               $result = $conn->query("SELECT * FROM `nationality` WHERE `Id` = '$nationid'");
                                               if ($result && $result->num_rows > 0) {
                                                    $rowFrm = $result->fetch_assoc();
                                                } else {
                                                    echo '<script>
                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                swal({
                                                                    title: "Error",
                                                                    text: "Failed to fetch nationality data. Please try again.",
                                                                    icon: "error"
                                                                }).then(function() {
                                                                    window.location = "nationality.php";
                                                                });
                                                            });
                                                        </script>';
                                                }
                                            }
                                        ?>
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
                                            <input type="text" style="display: none;" name="Id" value="<?php echo htmlspecialchars($rowFrm['Id']); ?>">
                                                <label for="nation">Nationality</label>
                                                <input type="text" class="form-control border-left-danger" name="nation" value="<?php echo '' . $rowFrm['Nation'] . '' ?>" required>
                                                <label for="createby">Create By</label>
                                                <select class="form-control mb-2" style="width: 100%;" name="createby">
                                                    <?php
                                                    $sqlcreateby = "SELECT * FROM `user` WHERE del=1";
                                                    $qrcreateby = $conn->query($sqlcreateby);
                                                    while ($rowcreateby = $qrcreateby->fetch_assoc()) {
                                                        if ($rowcreateby['Id'] == $rowFrm['CreateBy']) $sel = 'selected';
                                                        else $sel = '';
                                                        echo '<option value="' . $rowcreateby['Id'] . '" ' . $sel . '>' . $rowcreateby['Username'] . '</option>';
                                                    }

                                                    ?>
                                                </select>
                                                <label for="remark">Remark</label>
                                                <input type="text" class="form-control " name="remark" value="<?php echo '' . $rowFrm['Remark'] . '' ?>">
                                                <?php
                                                if (isset($_REQUEST['Id'])) {
                                                    echo '
                                                        <input type="submit" value="UPDATE" class="btn btn-success btn-sm mt-5" name="btnupdate">
                                                        <a href="nationality.php" class="btn btn-info btn-sm mt-5"> NEW </a>
                                                    ';
                                                } else {
                                                    echo '
                                                        <button type="submit" class="btn btn-primary btn-sm mt-5 w-100" name="btnsave">Save</button>
                                                        ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- List UOM -->
                                <div class="col-8 mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nationality</th>
                                                    <th>CreateBy</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>   
                                                <?php
                                                    include('confirm_delete.php');
                                                    nation_delete();
                                                ?>
                                            <tbody>
                                                <?php
                                                $sqlnation = "SELECT * FROM `nationality` WHERE del=1";
                                                $item = $conn->query($sqlnation);
                                                $rownation = $item->fetch_assoc();
                                                ?>
                                                <?php foreach ($item as $rownation) :

                                                    $createby = $conn->query("SELECT * FROM `user` WHERE Id=" . $rownation['CreateBy'])->fetch_assoc();
                                                ?>
                                                    <tr>
                                                        <td><?= $rownation['Nation'] ?></td>
                                                        <td><?= $createby['Username'] ?></td>
                                                        <td><?= $rownation['Remark'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($rownation['Status'] == 1) {
                                                                echo '<p><a href="statusNation.php?Id=' . $rownation['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                            } else {
                                                                echo '<p><a href="statusNation.php?Id=' . $rownation['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <a href="nationality.php?Id=<?= $rownation['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" data-href="nationality.php?delId=<?= $rownation['Id'] ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                
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
            window.location.href = "nationality.php";
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