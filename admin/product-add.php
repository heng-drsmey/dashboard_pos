<?php
// session_start();
include('include/head.php');
include('cn.php');
include('function_pro.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
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
                        <form method="post" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
                                                <label for="Code">code</label>
                                                <input type="text" class="form-control" name="txtcode">
                                                <label for="Name">Item Name</label>
                                                <input type="text" class="form-control" name="txtname">
                                                <label for="Category">Category</label>
                                                <select class="form-control form-select-sm" name="txtcate">
                                                    <?php
                                                    $sqlCate = "SELECT * FROM `category`";
                                                    $rsCate = $conn->query($sqlCate);
                                                    while ($rowCate = $rsCate->fetch_assoc()) {
                                                        echo '<option value="' . $rowCate['Id'] . '" >' . $rowCate['Name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="Size">Size</label>
                                                <select class="form-control form-select-sm" name="txtsku">
                                                    <?php
                                                    // $sqlSku = "SELECT * FROM `productsku`";
                                                    $sqlSku = "SELECT SizeName FROM `productsku` GROUP BY `SizeName`";
                                                    $rsSku = $conn->query($sqlSku);
                                                    while ($rowSku = $rsSku->fetch_assoc()) {
                                                        echo '<option value="' . $rowSku['Id'] . '" >' . $rowSku['SizeName'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="Price">Price</label>
                                                <input type="number" class="form-control" name="txtprice">

                                                <label for="Description">Description</label>
                                                <input type="text" class="form-control" name="txtdesc">
                                                <label for="CreateBy">CreateBy</label>
                                                <select class="form-control form-select-sm" name="txtcreateby">
                                                    <?php
                                                    $sqlUser = "SELECT * FROM `user`";
                                                    $rsUser = $conn->query($sqlUser);

                                                    while ($rowUser = $rsUser->fetch_assoc()) {
                                                        $Emp = $conn->query("SELECT * FROM `employee` WHERE Id=" . $rowUser['EmployeeId'])->fetch_assoc();
                                                        echo '<option value="' . $rowUser['Id'] . '" >' . $rowUser['Username'] . ' ~ ' . $Emp['Lastname'] . '</option>';
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
                                            <!-- Display the image -->
                                            <img src="ImageProduct/<?php echo $row['Image'] ?>" alt="" style="max-width:100%; height:258px;" id="demo">
                                            <br>
                                            <div class="form-group mt-2">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <!-- File input field -->
                                                        <input type="file" class="custom-file-input" id="myid" accept="image/*" name="txtImage" onchange="previewImage(event)">
                                                        <label class="custom-file-label" for="myid">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary mt-5" name="btnAdd">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script>
  function previewImage(event) {
    // Get the selected file
    var input = event.target;
    var file = input.files[0];

    // If a file is selected
    if (file) {
      var reader = new FileReader();

      // Set up the FileReader onload function
      reader.onload = function(e) {
        // Update the image src attribute with the data URL
        document.getElementById('demo').src = e.target.result;
      }

      // Read the file as a data URL
      reader.readAsDataURL(file);
    }
  }

  function display(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(event) {
        $('#myid').attr('src', event.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#demo").change(function() {
    display(this);
  });
</script>
</body>

</html>