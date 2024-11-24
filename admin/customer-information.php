<?php
include('include/head.php');
include('cn.php'); // Include your database connection

// Initialize an empty array for the customer data
$customer = array(
    "Id" => "","Code" => "", "Firstname" => "", "Lastname"  => "", "Gender" => "",
    "Dob" => "", "Nation" => "", "Email" => "", "Tel" => "", "Address" => "", "OutletId" => "",
    "Currency" => "", "CreateBy" => "","CreateAt" => "","Remark" => "", "UpdateAt" => "",
    "Image" => "", "Status" => ""
);

// Check if the `Id` parameter is set and valid
if (isset($_REQUEST['Id']) && is_numeric($_REQUEST['Id'])) {
    $customerid = $conn->real_escape_string($_REQUEST['Id']);
    
    // Fetch the customer data
    $result = $conn->query("SELECT * FROM `customer` WHERE `Id` = '$customerid'");

    if ($result && $result->num_rows > 0) {
        $customer = $result->fetch_assoc();
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "Failed to fetch customer data. Please try again.",
                        icon: "error"
                    }).then(function() {
                        window.location = "customer-list.php";
                    });
                });
            </script>';
        exit();
    }
} else {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Error",
                    text: "Invalid customere ID.",
                    icon: "error"
                }).then(function() {
                    window.location = "customer-list.php";
                });
            });
        </script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Add Customer</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Link bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- css for upload image -->
    <link href="css/img-style.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
                        <!-- Page Heading //change status add company if click button edit view edit company-->
                        <h1 class="h3 mb-4 text-gray-800"><?php echo isset($_REQUEST['Id']) ? 'Edit Customer' : 'Add Customer'; ?></h1>
                        <a href="customer-list.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-user text-white-50"></i> Customer List</a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form action="customer-add.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row">
                                                    <h5>Customer Information</h5>
                                                    <hr style="display: block; color: red; border: none; height: 1px; width: 98%; background-color: blue;">
                                                        <!-- code -->
                                                    <div class="col-4">
                                                        <input type="text" style="display: none;" name="Id" value="<?php echo htmlspecialchars($customer['Id']); ?>">
                                                        <label for="code">Code</label>
                                                        <input type="text" class="form-control border-left-danger" id="code" name="code" value="<?php echo htmlspecialchars($customer['Code']); ?>" readonly>
                                                    </div>
                                                        <!-- first name -->
                                                    <div class="col-4">
                                                        <label for="firstname">First Name</label>
                                                        <input type="text" class="form-control border-left-danger" id="firstname" name="firstname" value="<?php echo htmlspecialchars($customer['Firstname']); ?>" readonly>
                                                    </div>
                                                        <!-- last name -->
                                                    <div class="col-4">
                                                        <label for="lastname">Last Name</label>
                                                        <input type="text" class="form-control border-left-danger" id="lastname" name="lastname" value="<?php echo htmlspecialchars($customer['Lastname']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- div class row group -->
                                                <div class="row">
                                                    <!-- gender -->
                                                    <div class="col-4">
                                                        <label for="gender">Gender</label>
                                                        <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($customer['Gender']); ?>" readonly>
                                                    </div>
                                                        <!-- date of birth -->
                                                    <div class="col-4">
                                                        <label for="dateofbirth">Date of Birth</label>
                                                        <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="<?php echo htmlspecialchars($customer['Dob']); ?>" readonly>
                                                    </div>
                                                        <!-- nationality -->
                                                    <div class="col-4">
                                                        <label for="nationality">Nationality</label>
                                                        <input type="text" class="form-control" name="nationality" id="nationality" value="<?php
                                                            $nationalityId = $customer['Nation'];
                                                            $sqlnationality = "SELECT `Nation` FROM `nationality` WHERE `Id` = '$nationalityId'";
                                                            $qrnationality = $conn->query($sqlnationality);
                                                            if ($qrnationality && $qrnationality->num_rows > 0) {
                                                                $rownationality = $qrnationality->fetch_assoc();
                                                                echo htmlspecialchars($rownationality['Nation']);
                                                            }
                                                        ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- div class row group -->
                                                <div class="row">
                                                    <div class="col-4">
                                                            <!-- branch -->
                                                        <label for="branch">Branch</label>
                                                        <input type="text" class="form-control" name="branch" id="branch" value="<?php
                                                            $branchId = $customer['OutletId'];
                                                            $sqlbranch = "SELECT `Name` FROM `outlet` WHERE `Id` = '$branchId'";
                                                            $qrbranch = $conn->query($sqlbranch);
                                                            if ($qrbranch && $qrbranch->num_rows > 0) {
                                                                $rowbranch = $qrbranch->fetch_assoc();
                                                                echo htmlspecialchars($rowbranch['Name']);
                                                            }
                                                        ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                            <!-- currency -->
                                                        <label for="currency">Currency</label>
                                                        <input type="text" class="form-control" name="currency" id="currency" value="<?php
                                                            $currencyId = $customer['Currency'];
                                                            $sqlcurrency = "SELECT `Name` FROM `currency` WHERE `Id` = '$currencyId'";
                                                            $qrcurrency = $conn->query($sqlcurrency);
                                                            if ($qrcurrency && $qrcurrency->num_rows > 0) {
                                                                $rowcurrency = $qrcurrency->fetch_assoc();
                                                                echo htmlspecialchars($rowcurrency['Name']);
                                                            }
                                                        ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                            <!-- email -->
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($customer['Email']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- div class row group -->
                                                <div class="row">
                                                    <div class="col-4">
                                                            <!-- telephone -->
                                                        <label for="telephone">Telephone</label>
                                                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($customer['Tel']); ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                            <!-- address -->
                                                        <label for="address">Address</label>
                                                        <input type="textarea" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($customer['Address']); ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                            <!-- create by -->
                                                        <label for="createby">Created By</label>
                                                        <input type="text" class="form-control" id="createby" name="createby" value="<?php
                                                                $createById = $customer['CreateBy'];
                                                                $sqlcreateby = "SELECT `Username` FROM `user` WHERE `Id` = '$createById'";
                                                                $qrcreateby = $conn->query($sqlcreateby);
                                                                if ($qrcreateby && $qrcreateby->num_rows > 0) {
                                                                    $rowcreateby = $qrcreateby->fetch_assoc();
                                                                    echo htmlspecialchars($rowcreateby['Username']);
                                                                }
                                                            ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- div class row group -->
                                                 <div class="row">
                                                    <!-- Create at -->
                                                    <div class="col-4">
                                                        <label for="createat">Create At</label>
                                                        <input type="text" class="form-control" id="createat" name="createat" value="<?php echo htmlspecialchars($customer['CreateAt']); ?>" readonly>
                                                    </div>
                                                    <!-- Update at -->
                                                    <div class="col-4">
                                                        <label for="updateat">Update At</label>
                                                        <input type="text" class="form-control" id="updateat" name="updateat" value="<?php echo htmlspecialchars($customer['UpdateAt']); ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="remark">Remark</label>
                                                        <input type="textarea" class="form-control" id="remark" name="remark" value="<?php echo htmlspecialchars($customer['Remark']); ?>" readonly>
                                                    </div>
                                                        <!-- Disable Checkbox -->
                                                    <div class="form-check form-switch ms-4 mt-3">
                                                        <input type="checkbox" class="form-check-input" role="switch" id="status" name="status" <?php echo isset($customer) && $customer['Status'] ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="status">Disable</label>
                                                    </div>
                                                 </div>
                                                <!-- div class row group -->
                                            </div>
                                            <!--div class col-8 -->
                                            <!-- Image Upload on the Right -->
                                            <div class="col-lg-4 d-flex align-items-top justify-content-center">
                                                <div class=" mb-4 p-3 text center">
                                                    <div class="con-input-file">
                                                        <button onclick="handleClickRemove()" type="button" class="remove-image">
                                                            <i class="fa-solid fa-ban" style="color: red;"></i>
                                                        </button>
                                                        <div class="con-bg">
                                                            <img class="bg" src="" alt="">
                                                        </div>
                                                        <div class="img-1">
                                                            <?php
                                                            if (!empty($customer['Image'])) {
                                                                echo '<img class="image" id="customerimage" src="./ImageCustomer/' . htmlspecialchars($customer['Image']) . '" alt="customerimage" width="200px">';
                                                            } else {
                                                            ?>
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
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- div class row -->
                                    </form>
                                    
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
    <!-- Scripts for upload image -->
    <script src="js/img-script.js"></script>
    <!-- include the Anime.js library  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

</body>

</html>