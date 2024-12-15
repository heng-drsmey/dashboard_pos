<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function addProduct()
{
    global $conn;

    if (isset($_POST['btnAdd'])) {
        $txtcode = $conn->real_escape_string($_POST['txtcode']);
        $txtname = $conn->real_escape_string($_POST['txtname']);
        $txtcategory = $_POST['txtcategory'];
        $txtuom = $_POST['txtuom'];
        $txtprice = $_POST['txtprice'];
        $txtcurrency = $_POST['txtcurrency'];
        $txtdescription = $conn->real_escape_string($_POST['txtdescription']);
        $txtcreateby = $_POST['txtcreateby'];
        $txtImage = $_FILES['txtImage']['name'];
        $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        $currentDate = date("Y_m_d_H_i_s");
        $txtNewImage = $currentDate . '_' . rand() . '_' . $txtImage;

        if (!empty($txtImage)) {
            $InsertPro = "INSERT INTO `product`(`ProCode`, `CategoryId`,`uom`, `price`, `currency`, `Name`, `Description`, `Image`, `Status`, `CreateBy`) VALUES 
            ('$txtcode','$txtcategory','$txtuom','$txtprice','$txtcurrency','$txtname','$txtdescription','$txtNewImage',1,'$txtcreateby')";
            move_uploaded_file($txtImageTmp, './ImageProduct/' . $txtNewImage);
        } else {
            $InsertPro = "INSERT INTO `product`(`ProCode`, `CategoryId`, `uom`, `price`, `currency`,`Name`, `Description`, `Image`, `Status`, `CreateBy`) VALUES 
            ('$txtcode','$txtcategory','$txtuom','$txtprice','$txtcurrency','$txtname','$txtdescription','no_image.png',1,'$txtcreateby')";
        }

        $rs = $conn->query($InsertPro);

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

// update product
function UpdateProduct() {
    global $conn;
    // selece data for update
    if (isset($_REQUEST['btnUpdate'])) {
        $pro = $_REQUEST['Id'];
        $txtcode = $conn->real_escape_string($_POST['txtcode']);
        $txtname = $conn->real_escape_string($_POST['txtname']);
        $txtcategory = $_POST['txtcategory'];
        $txtuom = $_POST['txtuom'];
        $txtprice = $_POST['txtprice'];
        $txtcurrency = $_POST['txtcurrency'];
        $txtdescription = $conn->real_escape_string($_POST['txtdescription']);
        $txtcreateby = $_POST['txtcreateby'];
        $txtImage = $_FILES['txtImage']['name'];
        $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        $currentDate = date("Y_m_d_H_i_s");
        $txtNewImage = $currentDate.'_'.rand().'_'.$txtImage;
        if(!empty($txtImage)){
            $sqlUpdate = "UPDATE `product` SET `ProCode`='$txtcode',`CategoryId`='$txtcategory',`uom`='$txtuom',`price`='$txtprice',`currency`='$txtcurrency',`Name`='$txtname',`Description`='$txtdescription',`Image`='$txtNewImage',`CreateBy`='$txtcreateby',`UpdateAt`='$currentDate' WHERE Id=$pro";
            $getImage = $conn->query("SELECT * FROM `product` WHERE Id= $pro")->fetch_assoc();
            unlink('ImageProduct/' .$getImage['Image']);
            move_uploaded_file($txtImageTmp, 'ImageProduct/'.$txtNewImage);
        }else{
            $sqlUpdate = "UPDATE `product` SET `ProCode`='$txtcode',`CategoryId`='$txtcategory',`uom`='$txtuom',`price`='$txtprice',`currency`='$txtcurrency',`Name`='$txtname',`Description`='$txtdescription',`CreateBy`='$txtcreateby',`UpdateAt`='$currentDate' WHERE Id=$pro";
        }
        if ($conn->query($sqlUpdate) === TRUE) {
            echo '
                                <script>
                                  swal({
                                    title: "Success",
                                    text: "Data Update success",
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



function delete_product()
{
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);

        // List of tables and the corresponding foreign key column that reference the product ID
        $foreignTables = [
            'invoice' => 'ProductId',
            'invoice_detail' => 'ProductId',
            // 'pro_in' => 'ProId',
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
            $sqlproductdelete = "UPDATE `product` SET `del` = 0 WHERE `Id` = '$delId'";
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


// function Product_addOn_uom()
// {
//     global $conn;

//     if (isset($_POST['btnAdd'])) {
//         $txtproduct = $_POST['txtproduct'];
//         $txtuom = $conn->real_escape_string($_POST['txtuom']);
//         $txtprice = $_POST['txtprice'];
//         $txtcurrency = $_POST['txtcurrency'];
//         // $txtImage = $_FILES['txtImage']['name'];
//         // $txtImageTmp = $_FILES['txtImage']['tmp_name'];
//         // $currentDate = date("Y_m_d_H_i_s");
//         // $txtNewImage = $currentDate.'_'.rand().'_'.$txtImage;

//         $sql = " INSERT INTO `productsku`(`ProductId`, `UomId`, `Price`, `Currency`) VALUES
//          ($txtproduct,$txtuom,$txtprice,$txtcurrency)";

//         $rs = $conn->query($sql);
//         if ($rs == true) {
//             echo '
//                 <script>
//                   swal({
//                     title: "Success",
//                     text: "Data insert success",
//                     icon: "success",
//                   });
//                 </script>
//                 ';
//         } else {
//             echo '
//                 <script>
//                   swal({
//                     title: "Try Again",
//                     text: "Data can not insert",
//                     icon: "error",
//                   });
//                 </script>
//                 ';
//         }
//     }
// }

// delete pro_add_on_uom
// function delete_add_uom() {
//     global $conn;
//     if (isset($_GET['delId'])) {
//         $delId = mysqli_real_escape_string($conn, $_GET['delId']);
//         $sqlDelete = "UPDATE FROM `productsku` SET `del`=0 WHERE `Id`='$delId'";
//         if ($conn->query($sqlDelete) === TRUE) {
//             echo '
//                 <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
//                 <strong>Delete Success.</strong>
//                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                     <span aria-hidden="true">&times;</span>
//                 </button>
//                 </div>
//             ';
//         } else {
//             echo "Error deleting record: " . $conn->error;
//         }
//     } else {
//         echo "";
//     }
// }
// function delete_add_uom(){
//     global $conn;
//     if (isset($_GET['delId'])) {
//         $delId = mysqli_real_escape_string($conn, $_GET['delId']);

//         // List of tables and the corresponding foreign key column that reference the product ID
//         $foreignTables = [
//             'productsku' => 'ProductId',
//             'pro_in' => 'ProId',
//             // Add more tables and their foreign key columns here
//         ];

//         $canDelete = true;
//         foreach ($foreignTables as $table => $column) {
//             $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
//             $resultForeignKey = $conn->query($checkForeignKey);
//             $rowForeignKey = $resultForeignKey->fetch_assoc();

//             if ($rowForeignKey['count'] > 0) {
//                 $canDelete = false;
//                 break;
//             }
//         }

//         if ($canDelete) {
//             $sqlproductdelete = "UPDATE `productsku` SET `del` = 0 WHERE `Id` = '$delId'";
//             if ($conn->query($sqlproductdelete) === TRUE) {
//                 echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
//                         <strong>Delete Success.</strong>
//                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                             <span aria-hidden="true">&times;</span>
//                         </button>
//                     </div>';
//             } else {
//                 echo "Error deleting record: " . $conn->error;
//             }
//         } else {
//             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
//                     <strong>Cannot delete product. It is being referenced in other records.</strong>
//                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                         <span aria-hidden="true">&times;</span>
//                     </button>
//                 </div>';
//         }
//     } else {
//         echo "";
//     }
// }

// update pro_add_on_uom
// function update_add_uom() {
//     global $conn;
//     // selece data for update
//     if (isset($_REQUEST['btnUpdate'])) {
//         $Pro_Add_Uom = $_REQUEST['Id'];
//         $txtproduct = $_POST['txtproduct'];
//         $txtuom = $conn->real_escape_string($_POST['txtuom']);
//         $txtprice = $_POST['txtprice'];
//         $txtcurrency = $_POST['txtcurrency'];
//         $curentDate = date("Y_m_d_H_i_s");
//         $update_at = $_POST['txtupdate_at'];
//         $update = $update_at.$curentDate;
//         $sqlUpdate = "UPDATE `productsku` SET `ProductId`='$txtproduct',`UomId`='$txtuom',`Price`='$txtprice',`Currency`='$txtcurrency', `UpdateAt`='$update' WHERE Id=$Pro_Add_Uom";
//         if ($conn->query($sqlUpdate) === TRUE) {
//             echo '
//                                 <script>
//                                   swal({
//                                     title: "Success",
//                                     text: "Data Update success",
//                                     icon: "success",
//                                   });
//                                 </script>
//                                 ';
//         } else {
//             echo '
//                                 <script>
//                                   swal({
//                                     title: "Try again",
//                                     text: "Data can not update",
//                                     icon: "error",
//                                   });
//                                 </script>
//                                 ';
//         }
//     }
// }
?>