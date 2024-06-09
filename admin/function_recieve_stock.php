<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('cn.php');


function recieve_stock() {
    global $conn;

    if (isset($_POST['btnAdd'])) {
        $recievedate = $conn->real_escape_string($_POST['recievedate']);
        $recieveby = $conn->real_escape_string($_POST['recieveby']);
        $purchaseno = $conn->real_escape_string($_POST['purchaseno']);
        $supplier = $conn->real_escape_string($_POST['supplier']);
        $product = $conn->real_escape_string($_POST['product']);
        $uom = $conn->real_escape_string($_POST['uom']);
        $quantity = $conn->real_escape_string($_POST['quantity']);
        $price = $conn->real_escape_string($_POST['price']);
        $currency = $conn->real_escape_string($_POST['currency']);
        $paid = $conn->real_escape_string($_POST['paid']);
        $paymentstatus = $conn->real_escape_string($_POST['paymentstatus']);
        $discount = $conn->real_escape_string($_POST['discount']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $description = $conn->real_escape_string($_POST['description']);
        $moment_pro_id = $conn->real_escape_string($_POST['moment_pro_id']);
        $moment_pro_in = $conn->real_escape_string($_POST['moment_pro_in']);
        $moment_pro_out = $conn->real_escape_string($_POST['moment_pro_out']);

        // Verify if the Pro_Out_Id exists in pro_out table
        // $query_check_pro_out = "SELECT * FROM `pro_out` WHERE `Id` = '$moment_pro_out'";
        // $result_check_pro_out = $conn->query($query_check_pro_out);

        // if ($result_check_pro_out->num_rows == 0) {
        //     echo '
        //         <script>
        //             swal({
        //                 title: "Error",
        //                 text: "Pro_Out_Id does not exist in pro_out table",
        //                 icon: "error",
        //             });
        //         </script>
        //     ';
        //     return;
        // }

        $recieve_stock = "INSERT INTO `pro_in`( `RecieveDate`, `RecieveBy`, `Supplier`, `PurchaseNo`, `ProId`,`Uom`, `Qty_In`, `Price_In`, `DiscountAmount`, `Currency`, `Description`, `Paid`, `PaymentStatus`, `CreateBy`) VALUES
        ('$recievedate','$recieveby','$supplier','$purchaseno','$product','$uom','$quantity','$price','$discount','$currency','$description','$paid','$paymentstatus','$createby')";

        if ($conn->query($recieve_stock) === TRUE) {
            $moment_pro_in = $conn->insert_id; // Get the last inserted ID from pro_in table
            $moment_pro_id = $product;

            $record_moment = "INSERT INTO `pro_moment`(`ProId`, `Pro_In_Id`) VALUES ('$moment_pro_id', '$moment_pro_in')";

            if ($conn->query($record_moment) === TRUE) {
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
                            text: "Data cannot be inserted into pro_moment",
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
                        text: "Data cannot be inserted into pro_in",
                        icon: "error",
                    });
                </script>
            ';
        }
    }
}

// delete_recieve_1 we can restore data come back again just update del=1
function delete_recieve_1(){
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        $sqlDeleteuser = "UPDATE `pro_in` SET `del`=0 WHERE `Id`='$delId'";
        if ($conn->query($sqlDeleteuser) === TRUE) {
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

