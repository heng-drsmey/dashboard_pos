<?php
include('include/head.php');
include('function_Pro.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Unit Of Measure</title>

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
                        <h1 class="h3 mb-0 text-gray-800">UOM</h1>
                        <a href="product-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm" disabled><i class="fas fa-user text-white-50"></i> Product List</a>
                    </div>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <!-- Add UOM -->
                                <div class="col-12">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <?php
                                                // //call function Add()
                                                // Add();
                                                // // Select data for update
                                                // if (isset($_REQUEST['Id'])) {
                                                //     $uomId = $_REQUEST['Id'];                                   
                                                //     update();
                                                //     $rowFrm = $conn->query("SELECT * FROM `uom` WHERE Id=$uomId")->fetch_assoc();
                                                // } else {
                                                //     $rowFrm = array("Name" => "", "Code" => "", "Remark" => "",);
                                                // }
                                                ?>
                                                <div class="mb-4">
                                                    <div class="card-body">
                                                        <label for="Code">code</label>
                                                        <input type="text" class="form-control" name="txtcode" required value="<?php //echo '' . $rowFrm['Code'] . '' 
                                                                                                                                ?>">
                                                        <label for="Name">Name</label>
                                                        <input type="text" class="form-control" name="txtname">
                                                        <label for="Category">Category</label>
                                                        <input type="text" class="form-control" name="txtcategory">
                                                        <label for="UOM">UOM</label>
                                                        <input type="text" class="form-control" name="txtuom">
                                                        <label for="Price">Price</label>
                                                        <input type="text" class="form-control" name="txtprice">
                                                        <label for="Description">Description</label>
                                                        <input type="text" class="form-control" name="txtdescription">
                                                        <label for="CreateBy">CreateBy</label>
                                                        <input type="text" class="form-control" name="txtcreateBy">
                                                        <!-- <label for="Category">Category</label>
                                                        <input type="text" class="form-control" name="txtcategory" > -->

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
                                                            <a href="uom.php" class="btn btn-info btn-sm"> NEW </a>
                                                        '   ;
                                                        } else {
                                                            echo '
                                                        <button type="submit" class="btn btn-primary btn-sm" name="btnAdd">Save</button>
                                                        ';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card shadow mb-4">
                                                    <div class="card-body">
                                                        <div class="con-input-file">
                                                            <button onclick="handleClickRemove()" class="remove-image">
                                                                <i class='bx bx-x'></i>
                                                            </button>
                                                            <div class="con-bg">
                                                                <img class="bg" src="" alt="">
                                                            </div>
                                                            <div class="img-1">
                                                                <svg id="Capa_1" enable-background="new 0 0 510 510" viewBox="0 0 510 510" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                    <linearGradient id="lg1">
                                                                        <stop offset="0" stop-color="#cdec7a" />
                                                                        <stop offset=".2157" stop-color="#b0e995" />
                                                                        <stop offset=".5613" stop-color="#87e4bb" />
                                                                        <stop offset=".8347" stop-color="#6ee1d2" />
                                                                        <stop offset="1" stop-color="#65e0db" />
                                                                    </linearGradient>
                                                                    <linearGradient id="SVGID_3_" gradientTransform="matrix(.983 -.185 .185 .983 55.608 42.369)" gradientUnits="userSpaceOnUse" x1="15.52" x2="340.888" xlink:href="#lg1" y1="104.705" y2="430.073" />
                                                                    <linearGradient id="lg2">
                                                                        <stop offset="0" stop-color="#cdec7a" stop-opacity="0" />
                                                                        <stop offset=".2354" stop-color="#9ad57d" stop-opacity=".235" />
                                                                        <stop offset=".6035" stop-color="#51b482" stop-opacity=".604" />
                                                                        <stop offset=".8679" stop-color="#239f85" stop-opacity=".868" />
                                                                        <stop offset="1" stop-color="#119786" />
                                                                    </linearGradient>
                                                                    <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="491.682" x2="450.637" xlink:href="#lg2" y1="256.546" y2="256.546" />
                                                                    <linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="176.731" x2="176.731" xlink:href="#lg2" y1="466.917" y2="442.601" />
                                                                    <linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="88.264" x2="413.632" y1="111.753" y2="437.121">
                                                                        <stop offset="0" stop-color="#f8f6fb" />
                                                                        <stop offset="1" stop-color="#efdcfb" />
                                                                    </linearGradient>
                                                                    <linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="112.768" x2="430.112" y1="101.155" y2="514.021">
                                                                        <stop offset="0" stop-color="#18cefb" />
                                                                        <stop offset=".2969" stop-color="#2bb9f9" />
                                                                        <stop offset=".7345" stop-color="#42a0f7" />
                                                                        <stop offset="1" stop-color="#4a97f6" />
                                                                    </linearGradient>
                                                                    <linearGradient id="SVGID_8_" gradientUnits="userSpaceOnUse" x1="75.588" x2="214.616" y1="316.53" y2="497.406">
                                                                        <stop offset="0" stop-color="#cdec7a" />
                                                                        <stop offset=".2154" stop-color="#b0e995" stop-opacity=".784" />
                                                                        <stop offset=".5604" stop-color="#87e4bb" stop-opacity=".439" />
                                                                        <stop offset=".8334" stop-color="#6ee1d2" stop-opacity=".165" />
                                                                        <stop offset=".9985" stop-color="#65e0db" stop-opacity="0" />
                                                                    </linearGradient>
                                                                    <linearGradient id="SVGID_9_" gradientUnits="userSpaceOnUse" x1="198.822" x2="366.499" xlink:href="#lg1" y1="288.474" y2="506.622" />
                                                                    <linearGradient id="SVGID_10_" gradientUnits="userSpaceOnUse" x1="117.242" x2="171.618" y1="131.922" y2="202.666">
                                                                        <stop offset="0" stop-color="#ffd945" />
                                                                        <stop offset=".3043" stop-color="#ffcd3e" />
                                                                        <stop offset=".8558" stop-color="#ffad2b" />
                                                                        <stop offset="1" stop-color="#ffa325" />
                                                                    </linearGradient>
                                                                    <path d="m424.01 448.166h-389.245c-18.715 0-33.886-15.171-33.886-33.886v-322.806c0-18.715 15.171-33.886 33.886-33.886h389.245c18.715 0 33.886 15.171 33.886 33.886v322.806c0 18.715-15.171 33.886-33.886 33.886z" fill="url(#SVGID_6_)" />
                                                                    <g>
                                                                        <path d="m392.279 416.326h-325.782c-15.663 0-28.361-12.698-28.361-28.361v-270.175c0-15.663 12.698-28.361 28.361-28.361h325.782c15.663 0 28.361 12.698 28.361 28.361v270.175c0 15.663-12.698 28.361-28.361 28.361z" fill="url(#SVGID_7_)" />
                                                                        <g>
                                                                            <path d="m252.069 416.326h-185.567c-15.666 0-28.37-12.694-28.37-28.359v-44.29l47.082-57.228c15.538-18.903 44.46-18.903 60.009 0l29.315 35.64z" fill="url(#SVGID_8_)" />
                                                                            <path d="m420.643 316.75v71.217c0 15.666-12.704 28.359-28.37 28.359h-295.268l77.532-94.237 95.246-115.783c15.538-18.892 44.471-18.892 60.009 0z" fill="url(#SVGID_9_)" />
                                                                        </g>
                                                                        <circle cx="137.225" cy="157.919" fill="url(#SVGID_10_)" r="40.219" />
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="img-2">
                                                                <div class="square-1"></div>
                                                            </div>
                                                            <div class="img-3">
                                                                <div class="square-2"></div>
                                                            </div>
                                                            <div class="con-text">
                                                                Drop your image here, or Browse
                                                            </div>
                                                            <input class="input" onchange="processFile(event)" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)" ondragleave="dragLeave(event)" ondragenter="dragEnter(event)" ondragenter="dragEnter(event)" type="file" name="" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>

                                <!-- List UOM -->
                                <!-- <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Remark</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $sqlPro = "SELECT * FROM `uom`";
                                                $item = $conn->query($sqlPro);
                                                $rowPro = $item->fetch_assoc();
                                                ?>
                                                <?php foreach ($item as $rowuom) :

                                                ?>
                                                    <tr>
                                                        <td><?= $rowuom['Code'] ?></td>
                                                        <td><?= $rowuom['Name'] ?></td>
                                                        <td><?= $rowuom['Remark'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($rowuom['Status'] == 1) {
                                                                echo '<p><a href="statusUOM.php?Id=' . $rowuom['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>';
                                                            } else {
                                                                echo '<p><a href="statusUOM.php?Id=' . $rowuom['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php
                                                        delete();
                                                        ?>
                                                        <td>
                                                            <a href="uom.php?Id=<?= $rowuom['Id'] ?>" class="btn btn-outline-primary btn-sm "><i class="fa fa-pencil"></i></a>
                                                            <a href="uom.php?delId=<?= $rowuom['Id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
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
    <!-- upload image -->
    
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
    <script src="./js/upload-image.js"></script>

</body>

</html>