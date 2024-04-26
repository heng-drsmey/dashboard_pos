<?php 
    include('include/head.php');
    include('cn.php');
?>

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
                    <h1 class="h3 mb-4 text-gray-800">Add Product</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <label for="Code">code</label>
                                            <input type="text" class="form-control">
                                            <label for="Name">Item Name</label>
                                            <input type="text" class="form-control">                                          
                                            <label for="Category">Category</label>
                                            <select class="form-control form-select-sm">
                                            <?php
                                                $sqlCate = "SELECT * FROM `category`";
                                                $rsCate = $conn->query($sqlCate);
                                                while($rowCate = $rsCate->fetch_assoc()){
                                                    echo '<option value="'.$rowCate['Id'].'" >'.$rowCate['Name'].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label for="Size">Size</label>
                                            <select class="form-control form-select-sm">
                                            <?php
                                                $sqlSku = "SELECT * FROM `productsku`";
                                                $rsSku = $conn->query($sqlSku);
                                                while($rowSku = $rsSku->fetch_assoc()){
                                                    echo '<option value="'.$rowSku['Id'].'" >'.$rowSku['SizeName'].' ~ '.$rowSku['Price'].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label for="Price">Price</label>
                                            <input type="number" class="form-control">
                                            
                                            <label for="Description">Description</label>
                                            <input type="text" class="form-control">
                                            <label for="CreateBy">CreateBy</label>
                                            <select class="form-control form-select-sm">
                                            <?php
                                                $sqlUser = "SELECT * FROM `user`";
                                                $rsUser = $conn->query($sqlUser);
                                                
                                                while($rowUser = $rsUser->fetch_assoc()){
                                                    $Emp = $conn->query("SELECT * FROM `employee` WHERE Id=" . $rowUser['EmployeeId'])->fetch_assoc();
                                                    echo '<option value="'.$rowUser['Id'].'" >'.$rowUser['Username'].' ~ '.$Emp['Lastname'].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <div class="form-check form-switch ms-4 mt-3">
                                                <input class="form-check-input" type="checkbox" role="switch" id="status">
                                                <label class="form-check-label" for="status">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-lg-4">
                                    <div class="card shadow mb-4 p-3">
                                        <img src="" alt="" width="200px" height="300px" style="background-color: gray;">
                                        <input type="file" name="" id="" accept="*/file" class="mt-2">
                                        <button type="button" class="btn btn-primary mt-5">Submit</button>
                                    </div>
                                </div>   
                            </div>                                                  
                        </div>

                        <!-- <div class="col-lg-6">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Split Buttons with Icon</h6>
                                </div>
                                <div class="card-body">
                                    <p>Works with any button colors, just use the <code>.btn-icon-split</code> class and
                                        the markup in the examples below. The examples below also use the
                                        <code>.text-white-50</code> helper class on the icons for additional styling,
                                        but it is not required.
                                    </p>
                                    <a href="#" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Split Button Primary</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Split Button Success</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Split Button Info</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">Split Button Warning</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Split Button Danger</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Split Button Secondary</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-light btn-icon-split">
                                        <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Split Button Light</span>
                                    </a>
                                    <div class="mb-4"></div>
                                    <p>Also works with small and large button classes!</p>
                                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Split Button Small</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Split Button Large</span>
                                    </a>
                                </div>
                            </div>

                        </div> -->

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

</body>

</html>