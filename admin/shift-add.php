<?php
// Include the database connection
include('include/head.php');
include('function_shift.php'); // Include the functions

// Fetching shift data for editing
$shiftId = '';
$shiftName = '';

if (isset($_GET['Id'])) {  // Using 'Id' from URL
    $shiftId = $_GET['Id'];

    // Query to fetch old data based on the ID
    $sql = "SELECT * FROM shift WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $shiftId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data exists
    if ($result->num_rows > 0) {
        $shift = $result->fetch_assoc();
        $shiftName = isset($shift['Name']) ? htmlspecialchars($shift['Name']) : '';  // Handle null safely
    } else {
        echo "Shift not found!";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        shift_update(); // Call update function if editing
    } else {
        shift_insert(); // Call insert function if adding
    }
}

// Fetch all shifts for displaying in the table
$sql = "SELECT * FROM shift";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Add Shift</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Link bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- css for upload image -->
    <link href="css/img-style.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <h1 class="h3 mb-4 text-gray-800">
                            <?php echo isset($_REQUEST['Id']) ? 'Edit Shift' : 'Add Shift'; ?></h1>
                        <a href="shift.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i
                                class="fas fa-user text-white-50"></i> Shift</a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form
                                        action="shift-add.php<?php echo isset($_GET['Id']) ? '?Id=' . $shiftId : ''; ?>"
                                        method="post">

                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row">
                                                    <h5>Shift</h5>
                                                    <hr
                                                        style="display: block; color: red; border: none; height: 1px; width: 98%; background-color: blue;">
                                                    <!-- Name -->
                                                    <div class="col-4">
                                                        <input type="hidden" name="id" value="<?php echo $shiftId; ?>">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control border-left-danger"
                                                            id="name" name="name"
                                                            value="<?php echo isset($shiftName) ? $shiftName : ''; ?>"
                                                            required>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-3">
                                                            <button type="submit" class="btn btn-primary">
                                                                <?php echo isset($_GET['Id']) ? 'Update Shift' : 'Add Shift'; ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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