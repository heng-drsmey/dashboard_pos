<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function add()
{
  global $conn;
  if (isset($_POST['btnAdd'])) {
    $txtname = $conn->real_escape_string($_POST['txtname']);
    $txtcode = $conn->real_escape_string($_POST['txtcode']);
    $txtsymbol = $conn->real_escape_string($_POST['txtsymbol']);
    $txtremark = $conn->real_escape_string($_POST['txtremark']);
    $txtcreateby = $conn->real_escape_string($_POST['txtcreateby']);

    $sql = " INSERT INTO `currency`( `Code`,`Name`, `Symbol`,`Remark`,`CreateBy`) VALUES ('$txtcode','$txtname','$txtsymbol','$txtremark','$txtcreateby')";

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
    $Currency_id = mysqli_real_escape_string($conn, $_GET['delId']);
    $sqlDeletecurrency = "UPDATE `currency` SET `del`=0 WHERE `Id`='$Currency_id'";
    if ($conn->query($sqlDeletecurrency) == TRUE) {
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
    $Currency_id = $_REQUEST['Id'];
    $name = $conn->real_escape_string($_REQUEST['txtname']);
    $code = $conn->real_escape_string($_REQUEST['txtcode']);
    $txtsymbol = $conn->real_escape_string($_REQUEST['txtsymbol']);
    $txtremark = $conn->real_escape_string($_REQUEST['txtremark']);
    $txtcreateby = $conn->real_escape_string($_POST['txtcreateby']);
    $curentDate = date("Y_m_d_H_i_s");
    $update_at = $_REQUEST['txtupdate_at'];
    $update = $update_at . $curentDate;
    $sqlUpdate = "UPDATE `currency` SET `Code`='$code',`Name`='$name',`Symbol`='$txtsymbol',`Remark`='$txtremark',`CreateBy`='$txtcreateby',`UpdateAt`='$update' WHERE Id=$Currency_id ";
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