<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function add()
{
  global $conn;
  if (isset($_POST['btnAdd'])) {
    $txtname = $conn->real_escape_string($_POST['txtname']);
    $txtremark = $conn->real_escape_string($_POST['txtdesc']);

    $sql = " INSERT INTO `table`( `Name`, `Description`) VALUES ('$txtname','$txtremark')";

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

function delete()
{
  global $conn;
  if (isset($_GET['delId'])) {
    $delId = mysqli_real_escape_string($conn, $_GET['delId']);
    $sqlDeleteuom = "UPDATE `table` SET `del`=0 WHERE `Id`='$delId'";
    if ($conn->query($sqlDeleteuom) == TRUE) {
      echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
          <strong>Delete Success.</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      ';
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  } else {
    echo "";
  }
}


function update()
{
  global $conn;
  // selece data for update
  if (isset($_REQUEST['btnUpdate'])) {
    $tableId = $_REQUEST['Id'];
    $name = $conn->real_escape_string($_REQUEST['txtname']);
    $remark = $conn->real_escape_string($_REQUEST['txtdesc']);
    $curentDate = date("Y_m_d_H_i_s");
    $update_at = $_REQUEST['txtupdate_at'];
    $update = $update_at . $curentDate;
    $sqlUpdate = "UPDATE `table` SET `Name`='$name',`Description`='$remark',`UpdateAt`='$update' WHERE Id=$tableId ";
    if ($conn->query($sqlUpdate) === TRUE) {
      echo '
                                <script>
                                  swal({
                                    title: "Success",
                                    text: "Data update success",
                                    icon: "success",
                                  });
                                </script>
                                ';
                                  } else {
                                    echo '
                                <script>
                                  swal({
                                    title: "Try again",
                                    text: "Data can not update",
                                    icon: "error",
                                  });
                                </script>
                                ';
    }
  }
}
?>