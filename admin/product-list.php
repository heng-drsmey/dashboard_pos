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

    <title>SB Admin 2 - Product List</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
                        <a href="product-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Add New</a>
                    </div>
                    <?php
                        if(isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sqlproduct = "SELECT * FROM `product` WHERE `Name` LIKE '%$search%'";
                        } else {
                        $sqlproduct = "SELECT * FROM `product`";
                        }
                        $qrproduct = $conn->query($sqlproduct);
                    ?>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <!-- <div class="input-group sticky">      
                                    <form class="form-inline ml-3 w-100" method="GET">        
                                        <div class="input-group input-group ">
                                        <input class="form-control form-control-navbar" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        </div>
                                    </form>
                                </div> -->
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>CreateBy</th>
                                            <th>CreateAt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>CreateBy</th>
                                            <th>CreateAt</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <?php
                                    if (isset($_GET['delId'])) {
                                        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
                                        $sqlDeleteOutlet = "DELETE FROM `product` WHERE `Id`='$delId'";
                                        if ($conn->query($sqlDeleteOutlet) === TRUE) {
                                            echo '
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
                                    <?php
                                    $sqlPro = "SELECT * FROM `product`";
                                    $rs = $conn->query($sqlPro);
                                    while ($rowPro = $rs->fetch_assoc()) {
                                        $createBy = $conn->query("SELECT * FROM `user` WHERE Id=" . $rowPro['CreateBy'])->fetch_assoc();
                                        $Cate = $conn->query("SELECT * FROM `Category` WHERE Id=" . $rowPro['CategoryId'])->fetch_assoc();
                                        echo '
                                                <tbody>
                                                    <tr>
                                                        <td>' . $rowPro['Name'] . '</td>
                                                        <td>' . $Cate['Name'] . '</td>
                                                        <td>' . $rowPro['Description'] . '</td>
                                                        <td><img src="ImageProduct/' . $rowPro['Image'] . '" alt="" width="150px"></td>
                                                        <td>' . $rowPro['Status'] . '</td>
                                                        <td>' . $createBy['Username'] . '</td>
                                                        <td>' . $rowPro['CreateAt'] . '</td>
                                                        <td>
                                                            <a href="product-add.php?ProId=' . $rowPro['Id'] . '"  " class="btn btn-outline-primary btn-sm ">Edit</a>
                                                            <a href="product-list.php?delId=' . $rowPro['Id'] . '" class="btn btn-outline-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Outlet?\')">Delete</a> 
                                                    
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