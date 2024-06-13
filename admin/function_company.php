<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert company
function company_insert() {
    global $conn;
        if (isset($_POST['btnsave'])) {
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $status = isset($_POST['status']) ? 1 : 0;
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $companynewimage = $currentdate.'_'.rand().'_'.$companyimage;

        if(!empty($companyimage)){
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`,`Remark`, `Status`, `Logo`)
            VALUES ('$companycode','$companyname','$address','$createby','$remark',1,'$companynewimage')";
            move_uploaded_file($companyimageTmp, './ImageCompany/' .$companynewimage);
        }else {
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`,`Remark`, `Status`, `Logo`)
            VALUES ('$companycode','$companyname','$address','$createby','$remark',1,'no_image.png')";
        }

        $final = $conn->query($sqlInsertcompany);
        if($final == true){
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                    // SweetAlert code
                    swal({
                        title: "Success",
                        text: "Company added successfully",
                        icon: "success"
                    }).then(function() {
                        window.location = "company-add.php";
                    });
                    });
                </script>';
        }else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "There was an error adding the company. Please try again. Error: ' . $conn->error . '",
                        icon: "error"
                    }).then(function() {
                        window.location = "company-add.php";
                    });
                });
            </script>';
        }
    }   
}

// function company_update() {
//     global $conn;
    
//     if (isset($_REQUEST['btnUpdate'])) {
//         $companyid = $_REQUEST['Id'];
//         $companycode = $conn->real_escape_string($_POST['companycode']);
//         $companyname = $conn->real_escape_string($_POST['companyname']);
//         $address = $conn->real_escape_string($_POST['address']);
//         $createby = $conn->real_escape_string($_POST['createby']);
//         $remark = $conn->real_escape_string($_POST['remark']);
//         // $remark = $conn->real_escape_string($_POST['remark']);
//         // $remark = $conn->real_escape_string($_POST['remark']);
//       $companyimage = $_FILES['companyimage']['name'];
//       $companyimageTmp = $_FILES['companyimage']['tmp_name'];
//       $currentDate = date("Y_m_d_H_i_s");
//       $updateAt = $_REQUEST['updateat'];
//       $update = $updateAt . $currentDate;
//       $txtNewImage = $currentDate . '_' . rand() . '_' . $companyimage;
//     //   $txtNewImage = $curentDate . $companyimage;
//       if (!empty($companyimage)) {
//         $sqlupdate = "UPDATE `outlet` SET `Id`='$companyid', `Name`='$companyname',`Code`='$companycode',`Status`=1,`Address`='$address',`Logo`='$txtNewImage',`CreateBy`='$createby',`UpdateAt`='$update',`Remark`='$remark' WHERE Id=$companyid";
//         $getImage = $conn->query("SELECT * FROM `outlet` WHERE Id=$companyid")->fetch_assoc();
//         unlink('ImageCompany/' . $getImage['Logo']);
//         move_uploaded_file($companyimageTmp, 'ImageCompany/' . $txtNewImage);
//       } else {
//         $sqlupdate = "UPDATE `outlet` SET `Id`='$companyid', `Name`='$companyname',`Code`='$companycode',`Status`=1,`Address`='$address',`CreateBy`='$createby',`UpdateAt`='$update',`Remark`='$remark' WHERE Id=$companyid";
//       }
//       if ($conn->query($sqlupdate) === TRUE) {
//         echo '
//                       <script>
//                         swal({
//                           title: "Success",
//                           text: "Data update success",
//                           icon: "success",
//                         });
//                       </script>
//                       ';
//       } else {
//         echo '
//                       <script>
//                         swal({
//                           title: "Try again",
//                           text: "Data can not update",
//                           icon: "error",
//                         });
//                       </script>
//                       ';
//       }
//     }
    
// }
function company_update() {
    global $conn;

    if (isset($_REQUEST['btnUpdate'])) {
        $companyid = $conn->real_escape_string($_REQUEST['Id']);
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $currentDate = date("Y_m_d_H_i_s");
        $updateAt = $conn->real_escape_string($_REQUEST['updateat']);
        $update = $updateAt . $currentDate;
        $txtNewImage = $currentDate . '_' . rand() . '_' . $companyimage;

        if (!empty($companyimage)) {
            $sqlupdate = "UPDATE `outlet` SET `Id`='$companyid', `Name`='$companyname', `Code`='$companycode', `Status`=1, `Address`='$address', `Logo`='$txtNewImage', `CreateBy`='$createby', `UpdateAt`='$update', `Remark`='$remark' WHERE `Id`='$companyid'";
            
            // Fetch the current image
            $getImage = $conn->query("SELECT `Logo` FROM `outlet` WHERE `Id`='$companyid'")->fetch_assoc();
            if ($getImage) {
                $oldImage = 'ImageCompany/' . $getImage['Logo'];
                move_uploaded_file($companyimageTmp, 'ImageCompany/' . $txtNewImage);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        } else {
            $sqlupdate = "UPDATE `outlet` SET `Id`='$companyid', `Name`='$companyname', `Code`='$companycode', `Status`=1, `Address`='$address', `CreateBy`='$createby', `UpdateAt`='$update', `Remark`='$remark' WHERE `Id`='$companyid'";
        }

        if ($conn->query($sqlupdate) === TRUE) {
            echo '<script>
                    swal({
                      title: "Success",
                      text: "Data update success",
                      icon: "success",
                    });
                  </script>';
        } else {
            echo '<script>
                    swal({
                      title: "Try again",
                      text: "Data can not update",
                      icon: "error",
                    });
                  </script>';
        }
        
    }
}


?>

