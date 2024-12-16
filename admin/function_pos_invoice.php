<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert pos-invoice
// function pos_invoice_insert() {
//     global $conn;
//     if (isset($_POST['btnsave'])) {
//         $branch = $conn->real_escape_string($_POST['branch']);
//         $userid = $conn->real_escape_string($_POST['userid']);
//         $table = $conn->real_escape_string($_POST['table']);
//         $customer = $conn->real_escape_string($_POST['customer']);
//         $shift = $conn->real_escape_string($_POST['shift']);
//         $payment = $conn->real_escape_string($_POST['payment']);
//         $invoiceno = $conn->real_escape_string($_POST['invoiceno']);
//         $catename = $conn->real_escape_string($_POST['catename']);
//         $procode = $conn->real_escape_string($_POST['procode']);
//         $proname = $conn->real_escape_string($_POST['proname']);
//         $uom = $conn->real_escape_string($_POST['uom']);
//         $price = $conn->real_escape_string($_POST['price']);
//         $qty = $conn->real_escape_string($_POST['qty']);
//         $amount = $conn->real_escape_string($_POST['amount']);
//         $totalbedis = $conn->real_escape_string($_POST['totalbedis']);
//         $discountper = $conn->real_escape_string($_POST['discountper']);
//         $discountcur = $conn->real_escape_string($_POST['discountcur']);
//         $totalaftdis = $conn->real_escape_string($_POST['totalaftdis']);
//         $paidinusd = $conn->real_escape_string($_POST['paidinusd']);
//         $changeusd = $conn->real_escape_string($_POST['changeusd']);

//         $sqlposinvoiceinsert = "INSERT INTO `invoice` (`OutletId`, `UserId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceNo`, `CateName`, `ProCode`, `ProName`, `UOM`, `Price`, `QTY`, `Amount`, `TotalBeDis`, `DiscountPer`, `DiscountCur`, `AmountInUSD`, `PaidInUSD`, `ChangeUSD`)
//         VALUES ('$branch','$userid','$table','$customer','$shift','$payment','$invoiceno','$catename','$procode','$proname','$uom','$price','$qty','$amount','$totalbedis','$discountper','$discountcur','$totalaftdis','$paidinusd','$changeusd')";

        
//         if($conn->query($sqlposinvoiceinsert) === TRUE) {
//             echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Success",
//                             text: "Payment successfully",
//                             icon: "success"
//                         }).then(function() {
//                             window.location = "pos.php";
//                         });
//                     });
//                   </script>';
//         }else {
//             echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "There was an error payment the pos. Please try again. Error: ' . $conn->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "pos.php";
//                         });
//                     });
//                   </script>';
//         }
//     }
// }

function pos_invoice_insert() {
    global $conn;

    if (isset($_POST['btnsave'])) {
        // Fetch and sanitize user inputs
        $branch = trim($_POST['branch']);
        $userid = trim($_POST['userid']);
        $table = trim($_POST['table']);
        $customer = trim($_POST['customer']);
        $shift = trim($_POST['shift']);
        $payment = trim($_POST['payment']);
        $invoiceno = trim($_POST['invoiceno']);
        $catename = trim($_POST['catename']);
        $procode = trim($_POST['procode']);
        $proname = trim($_POST['proname']);
        $uom = trim($_POST['uom']);
        $price = trim($_POST['price']);
        $qty = trim($_POST['qty']);
        $amount = trim($_POST['amount']);
        $totalbedis = trim($_POST['totalbedis']);
        $discountper = trim($_POST['discountper']);
        $discountcur = trim($_POST['discountcur']);
        $totalaftdis = trim($_POST['totalaftdis']);
        $paidinusd = trim($_POST['paidinusd']);
        $changeusd = trim($_POST['changeusd']);

        // Validate essential fields
        if (empty($branch) || empty($userid) || empty($invoiceno) || empty($price) || empty($qty)) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "Missing required fields. Please fill all required fields.",
                            icon: "error"
                        });
                    });
                  </script>';
            return;
        }

        // Prepare SQL statement
        $sqlposinvoiceinsert = "INSERT INTO `invoice` 
            (`OutletId`, `UserId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceNo`, `CateName`, `ProCode`, `ProName`, `UOM`, `Price`, `QTY`, `Amount`, `TotalBeDis`, `DiscountPer`, `DiscountCur`, `AmountInUSD`, `PaidInUSD`, `ChangeUSD`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $conn->prepare($sqlposinvoiceinsert);
        if ($stmt === false) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "Failed to prepare the SQL statement. Error: ' . $conn->error . '",
                            icon: "error"
                        });
                    });
                  </script>';
            return;
        }

        // Bind parameters to prevent SQL injection
        $stmt->bind_param(
            'sssssssssssdddsdddddd', 
            $branch, 
            $userid, 
            $table, 
            $customer, 
            $shift, 
            $payment, 
            $invoiceno, 
            $catename, 
            $procode, 
            $proname, 
            $uom, 
            $price, 
            $qty, 
            $amount, 
            $totalbedis, 
            $discountper, 
            $discountcur, 
            $totalaftdis, 
            $paidinusd, 
            $changeusd
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Payment successfully processed.",
                            icon: "success"
                        }).then(function() {
                            window.location = "pos.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "Failed to insert invoice. Error: ' . $stmt->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "pos.php";
                        });
                    });
                  </script>';
        }

        // Close the statement
        $stmt->close();
    }
}