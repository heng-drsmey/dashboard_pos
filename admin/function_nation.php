<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');

// insert nationality
function nation_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $nation = $conn->real_escape_string($_POST['nation']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);

        $sqlnationinsert = "INSERT INTO `nationality` (`Nation`,`CreateBy`,`Remark`) VALUES ('$nation','$createby','$remark')";

        $final = $conn->query($sqlnationinsert);
        if($final == true) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Nationality added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "nationality.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the nationality. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "nationality.php";
                        });
                    });
                  </script>';
        }
    }
}

//update nationality
function nation_update() {
    global $conn;

    if(isset($_REQUEST['btnupdate'])) {
        $nationid = $conn->real_escape_string($_REQUEST['Id']);
        $nation = $conn->real_escape_string($_POST['nation']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;

        $sqlnationupdate = "UPDATE `nationality` SET `Nation`='$nation',`CreateBy`='$createby',`Remark`='$remark',`UpdateAt`='$update' WHERE Id=$nationid";
        if($conn->query($sqlnationupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Nationality updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "nationality.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the nationality. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "nationality.php";
                        });
                    });
                  </script>';
        }

    }
}

// delete nationality
function nation_delete() {
    global $conn;
    if(isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        
        $foreignTables = [
            'employee' => 'Nation',
            'customer' => 'Nation',
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
            $sqlnationdelete = "UPDATE `nationality` SET `del` = 0 WHERE `Id` = '$delId'";
            if($conn->query($sqlnationdelete) === TRUE) {
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
                    <strong>Cannot delete nationality. It is being referenced in other records.</strong>
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