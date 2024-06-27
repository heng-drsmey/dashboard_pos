<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function add()
{
  global $conn;
  if (isset($_POST['btnAdd'])) {
    $txtname = $conn->real_escape_string($_POST['txtname']);
    $txtcode = $conn->real_escape_string($_POST['txtcode']);
    $txtcreateby = $conn->real_escape_string($_POST['txtcreateby']);

    $sql = " INSERT INTO `paymentmethod`( `Name`, `Code`,`CreateBy`) VALUES ('$txtname','$txtcode','$txtcreateby')";

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

// function delete()
// {
//   global $conn;
//   if (isset($_GET['delId'])) {
//     $delId = mysqli_real_escape_string($conn, $_GET['delId']);
//     $sqlDeletepaymentmethod = "UPDATE `paymentmethod` SET `del`=0 WHERE `Id`='$delId'";
//     if ($conn->query($sqlDeletepaymentmethod) == TRUE) {
//       echo '
//         <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
//           <strong>Delete Success.</strong>
//           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//             <span aria-hidden="true">&times;</span>
//           </button>
//         </div>
//       ';
//     } else {
//       echo "Error deleting record: " . $conn->error;
//     }
//   } else {
//     echo "";
//   }
// }
function delete(){
  global $conn;
  if (isset($_GET['delId'])) {
      $delId = mysqli_real_escape_string($conn, $_GET['delId']);
      
      // List of tables and the corresponding foreign key column that reference the product ID
      $foreignTables = [
          'invoice' => 'PaymentMethodId',
          // Add more tables and their foreign key columns here
      ];
      
      $canDelete = true;
      foreach ($foreignTables as $table => $column) {
          $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
          $resultForeignKey = $conn->query($checkForeignKey);
          $rowForeignKey = $resultForeignKey->fetch_assoc();
          
          if ($rowForeignKey['count'] > 0) {
              $canDelete = false;
              break;
          }
      }
      
      if ($canDelete) {
          $sqlproductdelete = "UPDATE `paymentmethod` SET `del` = 0 WHERE `Id` = '$delId'";
          if ($conn->query($sqlproductdelete) === TRUE) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                      <strong>Delete Success.</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
          } else {
              echo "Error deleting record: " . $conn->error;
          }
      } else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                  <strong>Cannot delete product. It is being referenced in other records.</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
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
    $payment_method_Id = $_REQUEST['Id'];
    $name = $conn->real_escape_string($_REQUEST['txtname']);
    $code = $conn->real_escape_string($_REQUEST['txtcode']);
    $txtcreateby = $conn->real_escape_string($_POST['txtcreateby']);
    $curentDate = date("Y_m_d_H_i_s");
    $update_at = $_REQUEST['txtupdate_at'];
    $update = $update_at . $curentDate;
    $sqlUpdate = "UPDATE `paymentmethod` SET `Name`='$name',`Code`='$code',`UpdateAt`='$update',`CreateBy`='$txtcreateby' WHERE Id=$payment_method_Id ";
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