<?php
include('include/head.php');

include('function_shift.php');

$sql = "SELECT * FROM shift";
$result = $conn->query($sql);

shift_delete();

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
    <title>Admin - Shift</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include './include/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './include/topbar.php' ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Shift</h1>
                        <a href="shift-add.php" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i
                                class="fas fa-user text-white-50"></i> Add New</a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Date</th>
                                            <th>Shift Code</th>
                                            <th>Cash USD</th>
                                            <th>Create by</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["Id"] . "</td>";
                                                echo "<td>" . $row["CreateAt"] . "</td>";
                                                echo "<td>" . $row["Name"] . "</td>";
                                                echo "<td>" . $row["CashUSD"]."</td>";
                                                echo "<td>" . $row["CreateBy"]."</td>";
                                                echo "<td>";
                                                if ($row['Status'] == 1) {
                                                    echo '<p><a href="statusShift.php?Id=' . $row['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Open</a></p>';
                                                } else {
                                                    echo '<p><a href="statusShift.php?Id=' . $row['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Close</a></p>';
                                                }
                                                echo "</td>";
                                                echo "<td>
                                                <a href='shift-add.php?Id=" . $row['Id'] . "' class='btn btn-outline-primary btn-sm'><i class='icon'></i>Edit</a>
                                                <a href='#' data-id='" . $row['Id'] . "' class='btn btn-outline-danger btn-sm delete-btn' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal'><i class='icon'></i>Delete</a>
                                            </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>0 results</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Confirmation Modal -->
                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this shift?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <a href="#" id="confirmDelete" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include './include/footer.php' ?>
        </div>
    </div>

    <script>
        // Script to handle delete button click
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const shiftId = this.getAttribute('data-id');
                const confirmDeleteButton = document.getElementById('confirmDelete');
                confirmDeleteButton.href = 'shift.php?delete=' +
                    shiftId; // Ensure this links to the correct deletion logic
            });
        });
    </script>
</body>

</html>