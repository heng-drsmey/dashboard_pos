<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function add()
{
    global $conn;
    if (isset($_POST['btnAdd'])) {
        $txtcode = $_POST['txtcode'];
        $txtname = $_POST['txtname'];
        $txtremark = $_POST['txtremark'];

        $sql = " INSERT INTO `uom`(`Code`, `Name`, `Remark`) VALUES ('$txtcode','$txtname','$txtremark') ";

        $rs = $conn->query($sql);
        if ($rs == true) {
            echo '
                <script>
                  swal({
                    title: "Success",
                    text: "Data insert success",
                    icon: "success",
                  });
                </script>
                ';
        } else {
            echo '
                <script>
                  swal({
                    title: "Try Again",
                    text: "Data can not insert",
                    icon: "error",
                  });
                </script>
                ';
        }
    }
}

function delete() {
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        $sqlDeleteuom = "DELETE FROM `uom` WHERE `Id`='$delId'";
        if ($conn->query($sqlDeleteuom) == TRUE) {
            echo '
                <script>
                swal({
                    title: "Success",
                    text: "Data delete success",
                    icon: "success",
                });
                </script> 
    ';
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "";
    }
}

function update() {
    global $conn;
    // selece data for update
    if (isset($_REQUEST['btnUpdate'])) {
        $uomId = $_REQUEST['Id'];
        $name = $_REQUEST['txtname'];
        $code = $_REQUEST['txtcode'];
        $remark = $_REQUEST['txtremark'];
        $curentDate = date("Y_m_d_H_i_s");
        $update_at = $_REQUEST['txtupdate_at'];
        $update = $update_at.$curentDate;
        $sqlUpdate = "UPDATE `uom` SET `Code`='$code',`Name`='$name',`Remark`='$remark',`UpdateAt`='$update' WHERE Id=$uomId";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo '
                                <script>
                                  swal({
                                    title: "Success",
                                    text: "Data insert success",
                                    icon: "success",
                                  });
                                </script>
                                ';
        } else {
            echo '
                                <script>
                                  swal({
                                    title: "Try again",
                                    text: "Data can not insert",
                                    icon: "error",
                                  });
                                </script>
                                ';
        }
    }
}
?>