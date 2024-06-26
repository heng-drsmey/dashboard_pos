<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');

// insert bank
function bank_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $bank = $conn->real_escape_string($_POST['bank']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);

        $sqlbankinsert = "INSERT INTO `bank` (`Bank`,`CreateBy`,`Remark`) VALUES ('$bank','$createby','$remark')";

        $final = $conn->query($sqlbankinsert);
        if($final == true) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Bank added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "bank.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the bank. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "bank.php";
                        });
                    });
                  </script>';
        }
    }
}

//update bank
function bank_update() {
    global $conn;

    if(isset($_REQUEST['btnupdate'])) {
        $bankid = $conn->real_escape_string($_REQUEST['Id']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;

        $sqlbankupdate = "UPDATE `bank` SET `Bank`='$bank',`CreateBy`='$createby',`Remark`='$remark',`UpdateAt`='$update' WHERE Id=$bankid";
        if($conn->query($sqlbankupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Bank updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "bank.php";
                        });
                    });
                  </script>';
        }else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the bank. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "bank.php";
                        });
                    });
                  </script>';
        }

    }
}
?>