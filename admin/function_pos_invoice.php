<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert pos-invoice
function pos_invoice_insert() {
    global $conn;
    if (isset($_POST['btnsave'])) {
        // $branch = $conn->real_escape_string($_POST['branch']);
        // $userid = $conn->real_escape_string($_POST['userid']);
        // $table = $conn->real_escape_string($_POST['table']);
        // $customer = $conn->real_escape_string($_POST['customer']);
        // $shift = $conn->real_escape_string($_POST['shift']);
        // $payment = $conn->real_escape_string($_POST['payment']);
        // $invoiceno = $conn->real_escape_string($_POST['invoiceno']);
        // $catename = $conn->real_escape_string($_POST['catename']);
        // $procode = $conn->real_escape_string($_POST['procode']);
        // $proname = $conn->real_escape_string($_POST['proname']);
        // $uom = $conn->real_escape_string($_POST['uom']);
        // $price = $conn->real_escape_string($_POST['price']);
        // $qty = $conn->real_escape_string($_POST['qty']);
        // $amount = $conn->real_escape_string($_POST['amount']);
        // $totalbedis = $conn->real_escape_string($_POST['totalbedis']);
        // $discountper = $conn->real_escape_string($_POST['discountper']);
        // $discountcur = $conn->real_escape_string($_POST['discountcur']);
        // $totalaftdis = $conn->real_escape_string($_POST['totalaftdis']);
        // $paidinusd = $conn->real_escape_string($_POST['paidinusd']);
        // $changeusd = $conn->real_escape_string($_POST['changeusd']);

        // $sqlposinvoiceinsert = "INSERT INTO `invoice` (`OutletId`, `UserId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceNo`, `CateName`, `ProCode`, `ProName`, `UOM`, `Price`, `QTY`, `Amount`, `TotalBeDis`, `DiscountPer`, `DiscountCur`, `AmountInUSD`, `PaidInUSD`, `ChangeUSD`)
        // VALUES ('$branch','$userid','$table','$customer','$shift','$payment','$invoiceno','$catename','$procode','$proname','$uom','$price','$qty','$amount','$totalbedis','$discountper','$discountcur','$totalaftdis','$paidinusd','$changeusd')";

        
        // if($conn->query($sqlposinvoiceinsert) === TRUE) {
        //     echo '<script>
        //             document.addEventListener("DOMContentLoaded", function() {
        //                 swal({
        //                     title: "Success",
        //                     text: "Payment successfully",
        //                     icon: "success"
        //                 }).then(function() {
        //                     window.location = "pos.php";
        //                 });
        //             });
        //           </script>';
        // }else {
        //     echo '<script>
        //             document.addEventListener("DOMContentLoaded", function() {
        //                 swal({
        //                     title: "Error",
        //                     text: "There was an error payment the pos. Please try again. Error: ' . $conn->error . '",
        //                     icon: "error"
        //                 }).then(function() {
        //                     window.location = "pos.php";
        //                 });
        //             });
        //           </script>';
        // }

        $branch = isset($_POST['branch']) ? $conn->real_escape_string($_POST['branch']) : null;
        $userid = isset($_POST['userid']) ? $conn->real_escape_string($_POST['userid']) : null;
        $table = isset($_POST['table']) ? $conn->real_escape_string($_POST['table']) : null;
        $customer = isset($_POST['customer']) ? $conn->real_escape_string($_POST['customer']) : null;
        $shift = isset($_POST['shift']) ? $conn->real_escape_string($_POST['shift']) : null;
        $payment = isset($_POST['payment']) ? $conn->real_escape_string($_POST['payment']) : null;
        $invoiceno = isset($_POST['invoiceno']) ? $conn->real_escape_string($_POST['invoiceno']) : null;
        $catename = isset($_POST['catename']) ? $conn->real_escape_string($_POST['catename']) : null;
        $procode = isset($_POST['procode']) ? $conn->real_escape_string($_POST['procode']) : null;
        $proname = isset($_POST['proname']) ? $conn->real_escape_string($_POST['proname']) : null;
        $uom = isset($_POST['uom']) ? $conn->real_escape_string($_POST['uom']) : null;
        $price = isset($_POST['price']) ? $conn->real_escape_string($_POST['price']) : 0;
        $qty = isset($_POST['qty']) ? $conn->real_escape_string($_POST['qty']) : 0;
        $amount = isset($_POST['amount']) ? $conn->real_escape_string($_POST['amount']) : 0;
        $totalbedis = isset($_POST['totalbedis']) ? $conn->real_escape_string($_POST['totalbedis']) : 0;
        $discountper = isset($_POST['discountper']) ? $conn->real_escape_string($_POST['discountper']) : 0;
        $discountcur = isset($_POST['discountcur']) ? $conn->real_escape_string($_POST['discountcur']) : 0;
        $totalaftdis = isset($_POST['totalaftdis']) ? $conn->real_escape_string($_POST['totalaftdis']) : 0;
        $paidinusd = isset($_POST['paidinusd']) ? $conn->real_escape_string($_POST['paidinusd']) : 0;
        $changeusd = isset($_POST['changeusd']) ? $conn->real_escape_string($_POST['changeusd']) : 0;

        $shiftValidationQuery = "SELECT Id FROM shift WHERE Id = ?";
$stmt = $conn->prepare($shiftValidationQuery);
$stmt->bind_param("i", $shift);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Error",
                    text: "Invalid Shift Details ID.",
                    icon: "error"
                }).then(function() {
                    window.location = "pos.php";
                });
            });
          </script>';
    $stmt->close();
    return;
}
$stmt->close();

$sqlposinvoiceinsert = "INSERT INTO `invoice` 
(`OutletId`, `UserId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceNo`, `CateName`, `ProCode`, `ProName`, `UOM`, `Price`, `QTY`, `Amount`, `TotalBeDis`, `DiscountPer`, `DiscountCur`, `AmountInUSD`, `PaidInUSD`, `ChangeUSD`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmtInsert = $conn->prepare($sqlposinvoiceinsert);
$stmtInsert->bind_param(
    "iiiiiissssddidddddd",
    $branch, $userid, $table, $customer, $shift, $payment, $invoiceno, $catename, $procode, $proname,
    $uom, $price, $qty, $amount, $totalbedis, $discountper, $discountcur, $totalaftdis, $paidinusd, $changeusd
);

if ($stmtInsert->execute()) {
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
                    text: "Error inserting data. ' . $stmtInsert->error . '",
                    icon: "error"
                }).then(function() {
                    window.location = "pos.php";
                });
            });
          </script>';
}
$stmtInsert->close();


    }
}

// Function to auto-generate InvoiceNo
function generateInvoiceNo() {
    global $conn;

    // Query to get the last InvoiceNo
    $sqlLastInvoice = "SELECT InvoiceNo FROM invoice ORDER BY Id DESC LIMIT 1";
    $result = $conn->query($sqlLastInvoice);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastInvoiceNo = $row['InvoiceNo'];

        // Extract the numeric part of the InvoiceNo
        $number = (int)substr($lastInvoiceNo, 4);

        // Increment the number
        $newNumber = $number + 1;

        // Format the new InvoiceNo
        return 'INV-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    } else {
        // Default starting number if no records exist
        return 'INV-00001';
    }
}
?>