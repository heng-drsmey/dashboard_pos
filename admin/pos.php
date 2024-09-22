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

    <title>Point of Sale</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/img-ratio.css">
    <link rel="stylesheet" href="css/pos.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<style>

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
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">POS</h1>
                                <div class="search-box">
                                    <button class="btn-search"><i class="fas fa-search"></i></button>
                                    <input type="text" class="input-search" placeholder="Type to Search...">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Table</option>
                                <option value="t1">Table 1</option>
                                <option value="t2">Table 2</option>
                                <option value="t3">Table 3</option>
                                <option value="t4">Table 4</option>
                                <option value="t5">Table 5</option>
                                <option value="t6">Table 6</option>
                                <option value="t7">Table 7</option>
                                <option value="t8">Table 8</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Outlet</option>
                                <option value="o1">Sen Sok</option>
                                <option value="o2">Toul Kork</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card border-0">
                                        <div class="thumbnail-wrapper">
                                            <div class="thumbnail-inner img4by3">
                                                <img src="https://images.ctfassets.net/v601h1fyjgba/4GLzOncHIe8rq3xY099cZ/dd17ce72ebb6fb01659c763fe64953db/Iced_Latte.jpg" class="rounded" alt="...">

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Iced Latte</p>
                                            <h5 class="text-success">$3.00</h5>
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card border-0">
                                        <div class="thumbnail-wrapper">
                                            <div class="thumbnail-inner img4by3">
                                                <img src="https://images.ctfassets.net/v601h1fyjgba/6TroCkgvDucbXj1OSPeve5/7cfeb09a7498e59bd7a48c4e048d2cec/Lite_Iced_Cappuccino_Hi.jpg" class="rounded" alt="...">

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Iced Cappucino</p>
                                            <h5 class="text-success">$3.00</h5>
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card border-0">
                                        <div class="thumbnail-wrapper">
                                            <div class="thumbnail-inner img4by3">
                                                <img src="https://www.mondomulia.com/wp-content/uploads/2015/02/Artisan-School-Latte-Art-15-1.jpg" class="rounded" alt="...">

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Expresso</p>
                                            <h5 class="text-success">$3.00</h5>
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card border-0">
                                        <div class="thumbnail-wrapper">
                                            <div class="thumbnail-inner img4by3">
                                                <img src="https://majestycoffee.com/cdn/shop/articles/americano_b74a8154-454b-4f74-9a6c-95fbc4152ed3.jpg?v=1684048195" class="rounded" alt="...">

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Americano</p>
                                            <h5 class="text-success">$3.00</h5>
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-white py-4 rounded">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="thumbnail-wrapper">
                                        <div class="thumbnail-inner img1by1">
                                            <img src="https://images.ctfassets.net/v601h1fyjgba/6TroCkgvDucbXj1OSPeve5/7cfeb09a7498e59bd7a48c4e048d2cec/Lite_Iced_Cappuccino_Hi.jpg" class="rounded" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Iced Cappucino</h5>
                                    <div class="number-input" data-id="1">
                                        <button onclick="decrement(1)">-</button>
                                        <input type="text" id="number-1" value="1" readonly>
                                        <button onclick="increment(1)">+</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-trash-alt ml-5 text-danger"></i>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <h5>$3.00</h5>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-3">
                                    <div class="thumbnail-wrapper">
                                        <div class="thumbnail-inner img1by1">
                                            <img src="https://images.ctfassets.net/v601h1fyjgba/4GLzOncHIe8rq3xY099cZ/dd17ce72ebb6fb01659c763fe64953db/Iced_Latte.jpg" class="rounded" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Iced Latte</h5>
                                    <div class="number-input" data-id="2">
                                        <button onclick="decrement(2)">-</button>
                                        <input type="text" id="number-2" value="1" readonly>
                                        <button onclick="increment(2)">+</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-trash-alt ml-5 text-danger"></i>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <h5>$3.00</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="px-4">
                                <div class="row bg-light-blue py-3">
                                    <div class="col-lg-6 text-left">
                                        <h5 class="text-dark">Total</h5>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <h5 class="text-dark">$6.00</h5>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="mt-5 btn btn-primary form-control">Checkout</a>
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

            function decrement(id) {
                const numberInput = document.getElementById(`number-${id}`);
                let currentValue = parseInt(numberInput.value);
                if (currentValue > 0) {
                    numberInput.value = currentValue - 1;
                }
            }

            function increment(id) {
                const numberInput = document.getElementById(`number-${id}`);
                let currentValue = parseInt(numberInput.value);
                numberInput.value = currentValue + 1;
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