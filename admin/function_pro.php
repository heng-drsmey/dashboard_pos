<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function addProduct()
{
    global $conn;

    if (isset($_POST['btnAdd'])) {
        $txtcode = $_POST['txtcode'];
        $txtname = $_POST['txtname'];
        $txtcategory = $_POST['txtcategory'];
        $txtuom = $_POST['txtuom'];
        $txtprice = $_POST['txtprice'];
        $txtcurrency = $_POST['txtcurrency'];
        $txtdescription = $_POST['txtdescription'];
        $txtcreateby = $_POST['txtcreateby'];
        $txtImage = $_FILES['txtImage']['name'];
        $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        $currentDate = date("Y_m_d_H_i_s");
        $txtNewImage = $currentDate.'_'.rand().'_'.$txtImage;

        if(!empty($txtImage)){
            $InsertPro = "INSERT INTO `product`(`ProCode`, `CategoryId`, `Name`, `Description`, `Image`, `Status`, `CreateBy`) VALUES 
            ('$txtcode','$txtcategory','$txtname','$txtdescription','$txtNewImage',1,'$txtcreateby')";
            move_uploaded_file($txtImageTmp, './ImageProduct/'.$txtNewImage);
        }else{
            $InsertPro = "INSERT INTO `product`(`ProCode`, `CategoryId`, `Name`, `Description`, `Image`, `Status`, `CreateBy`) VALUES 
            ('$txtcode','$txtcategory','$txtname','$txtdescription','no_image.png',1,'$txtcreateby')";
        }

        $rs = $conn->query($InsertPro);

        if ($rs == true) {
            $proId = $conn->insert_id;
            $InsertProsku = "INSERT INTO `productsku`( `ProductId`, `UomId`, `Price`, `Currency`) VALUES 
            ('$proId','$txtuom','$txtprice','$txtcurrency')";
            $rs_sku = $conn->query($InsertProsku);

            if ($rs_sku == true) {
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
function Product_addOn_uom()
{
    global $conn;

    if (isset($_POST['btnAdd'])) {
        $txtproduct = $_POST['txtproduct'];
        $txtuom = $_POST['txtuom'];
        $txtprice = $_POST['txtprice'];
        $txtcurrency = $_POST['txtcurrency'];
        // $txtImage = $_FILES['txtImage']['name'];
        // $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        // $currentDate = date("Y_m_d_H_i_s");
        // $txtNewImage = $currentDate.'_'.rand().'_'.$txtImage;

        $sql = " INSERT INTO `productsku`(`ProductId`, `UomId`, `Price`, `Currency`) VALUES
         ($txtproduct,$txtuom,$txtprice,$txtcurrency)";

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

// delete pro_add_on_uom
function delete_add_uom() {
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        $sqlDelete = "DELETE FROM `productsku` WHERE `Id`='$delId'";
        if ($conn->query($sqlDelete) == TRUE) {
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
 
// update pro_add_on_uom
function update_add_uom() {
    global $conn;
    // selece data for update
    if (isset($_REQUEST['btnUpdate'])) {
        $Pro_Add_Uom = $_REQUEST['Id'];
        $txtproduct = $_POST['txtproduct'];
        $txtuom = $_POST['txtuom'];
        $txtprice = $_POST['txtprice'];
        $txtcurrency = $_POST['txtcurrency'];
        $curentDate = date("Y_m_d_H_i_s");
        $update_at = $_POST['txtupdate_at'];
        $update = $update_at.$curentDate;
        $sqlUpdate = "UPDATE `productsku` SET `ProductId`='$txtproduct',`UomId`='$txtuom',`Price`='$txtprice',`Currency`='$txtcurrency', `UpdateAt`='$update' WHERE Id=$Pro_Add_Uom";
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
?>