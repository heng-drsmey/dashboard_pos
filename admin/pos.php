<!-- Session user  -->
<?php
session_start();
include('cn.php');
if (!isset($_SESSION['session'])) {
    header("location: login.php");
}
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
    <link rel="stylesheet" href="css/img-ratio.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- bootstrap 5.3.3 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</head>
<style>
    .cate_card {
        background: #fff;
        border: 1px solid #dadada;
        border-radius: 6px;
        height: 50px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
    }

    .cate_card:hover {
        text-decoration: none;
    }

    .order-detail {
        display: flex;
        align-items: center;
        background: #f6f6f6;
        padding: 25px;
        border-radius: 10px;
    }

    .input-group {
        background: #fff;
        width: 105px;
        height: 30px;
        justify-content: space-evenly;
        border: 1px solid #dadada;
        border-radius: 25px;
    }

    .input-group input[type=number] {
        border: none;
    }

    .btn-min-plus {
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        background: #4e73df;
        justify-content: center;
        color: #fff;
    }
</style>

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
                        <h1 class="h3 mb-0 text-gray-800">POS</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row text-center mb-3 ">
                                <div class="col-lg-4">
                                    <a class="cate_card d-flex align-items-center justify-content-center" href="#">HOT</a>
                                </div>
                                <div class="col-lg-4">
                                    <a class="cate_card d-flex align-items-center justify-content-center" href="#">ICED</a>
                                </div>
                                <div class="col-lg-4">
                                    <a class="cate_card d-flex align-items-center justify-content-center" href="#">FRAPPED</a>
                                </div>
                            </div>
                            <h5>All Items</h5>
                            <div class="row">
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="card">
                                        <div class="thumnail">
                                            <div class="thumbnail-wrapper">
                                                <div class="thumbnail-inner img4by3">
                                                    <img src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Iced Latte</h5>
                                            <h5 class="card-text text-success">$1.5</h5>
                                            <a href="#" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-white p-4" style="border-radius: 15px; border: 1px solid #dadada;">
                            <h4>Order Number</h4>
                            <b class="text-primary">0001</b>
                            <h4>Order Items</h4>
                            <div class="row order-detail">
                                <div class="col-lg-3">
                                    <div class="thumbnail-wrapper">
                                        <div class="thumbnail-inner img1by1 rounded-circle">
                                            <img class="rounded-circle" src="https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190607_IcedCaffeLatte.jpg?impolicy=1by1_wide_topcrop_630" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Iced Latte</h5>
                                    <h5 class="text-success">$1.50</h5>
                                </div>
                                <div class="col-lg-5 text-center" style="display: contents;">
                                    <div class="input-group d-flex align-items-center mx-3">
                                        <i class="fa-solid fa-minus btn-min-plus"></i>
                                        <input type="number" name="" id="" style="width: 50px; text-align: center;" value="1">
                                        <i class="fa-solid fa-plus btn-min-plus"></i>
                                    </div>
                                    <i class="fa-solid fa-trash-can text-danger"></i>
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