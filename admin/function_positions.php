<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');

// insert positions
function positions_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $positions = $conn->real_escape_string($_POST['positions']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);

        $sqlpositionsinsert = "INSERT INTO `positions` (`Positions`,`CreateBy`,`Remark`) VALUES ('$positions','$createby','$remark')";

        $final = $conn->query($sqlpositionsinsert);
        if($final == true) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Positions added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "positions.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the positions. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "positions.php";
                        });
                    });
                  </script>';
        }
    }
}

//update positions
function positions_update() {
    global $conn;

    if(isset($_REQUEST['btnupdate'])) {
        $positionsid = $conn->real_escape_string($_REQUEST['Id']);
        $positions = $conn->real_escape_string($_POST['positions']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;

        $sqlpositionsupdate = "UPDATE `positions` SET `Positions`='$positions',`CreateBy`='$createby',`Remark`='$remark',`UpdateAt`='$update' WHERE Id=$positionsid";
        if($conn->query($sqlpositionsupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Positions updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "positions.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the positions. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "positions.php";
                        });
                    });
                  </script>';
        }

    }
}

// delete positions
function positions_delete() {
    global $conn;
    if(isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        
        $foreignTables = [
            'employee' => 'Position',
        ];
        $canDelete = true;
        foreach ($foreignTables as $table => $column) {
            $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
            $resultForeignKey = $conn->query($checkForeignKey);
            $rowForeignKey = $resultForeignKey->fetch_assoc();
            
            if($rowForeignKey['count'] > 0) {
                $canDelete = false;
                break;
            }
        }
        if ($canDelete) {
            $sqlpositionsdelete = "UPDATE `positions` SET `del` = 0 WHERE `Id` = '$delId'";
            if($conn->query($sqlpositionsdelete) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        <strong>Delete Success.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }else {
                echo "Error deleting record: " . $conn->error;
            }
        }else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    <strong>Cannot delete positions. It is being referenced in other records.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }else {
        echo "";
    }
}
?>