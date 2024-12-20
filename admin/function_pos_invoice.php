link sweet alert
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

// Function to generate the next invoice number
function generateInvoiceNo() {
    global $conn;
    
    // Query to get the latest invoice number
    $sql = "SELECT InvoiceNo FROM invoice ORDER BY Id DESC LIMIT 1";
    $result = $conn->query($sql);

    // Initialize the next invoice number
    $nextInvoiceNo = 'INV-00001';

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestInvoiceNo = $row['InvoiceNo'];

        // Extract numeric part from the latest invoice number
        if (preg_match('/^INV-(\d+)$/', $latestInvoiceNo, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
            $nextInvoiceNo = 'INV-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        }
    }

    return $nextInvoiceNo;
}

// // Insert pos-invoice
// function pos_invoice_insert() {
//     global $conn;

//     if (isset($_POST['btnsave'])) {
//         // Fetch and sanitize input data
//         $branch = isset($_POST['branch']) ? $conn->real_escape_string($_POST['branch']) : null;
//         $userid = isset($_POST['userid']) ? $conn->real_escape_string($_POST['userid']) : null;
//         $table = isset($_POST['table']) ? $conn->real_escape_string($_POST['table']) : null;
//         $customer = isset($_POST['customer']) ? $conn->real_escape_string($_POST['customer']) : null;
//         $shift = isset($_POST['shift']) ? $conn->real_escape_string($_POST['shift']) : null;
//         $payment = isset($_POST['payment']) ? $conn->real_escape_string($_POST['payment']) : null;
//         $catename = isset($_POST['catename']) ? $conn->real_escape_string($_POST['catename']) : null;
//         $procode = isset($_POST['procode']) ? $conn->real_escape_string($_POST['procode']) : null;
//         $proname = isset($_POST['proname']) ? $conn->real_escape_string($_POST['proname']) : null;
//         $uom = isset($_POST['uom']) ? $conn->real_escape_string($_POST['uom']) : null;
//         $price = isset($_POST['price']) ? $conn->real_escape_string($_POST['price']) : 0;
//         $qty = isset($_POST['qty']) ? $conn->real_escape_string($_POST['qty']) : 0;
//         $amount = isset($_POST['amount']) ? $conn->real_escape_string($_POST['amount']) : 0;
//         $totalbedis = isset($_POST['totalbedis']) ? $conn->real_escape_string($_POST['totalbedis']) : 0;
//         $discountper = isset($_POST['discountper']) ? $conn->real_escape_string($_POST['discountper']) : 0;
//         $discountcur = isset($_POST['discountcur']) ? $conn->real_escape_string($_POST['discountcur']) : 0;
//         $totalaftdis = isset($_POST['totalaftdis']) ? $conn->real_escape_string($_POST['totalaftdis']) : 0;
//         $paidinusd = isset($_POST['paidinusd']) ? $conn->real_escape_string($_POST['paidinusd']) : 0;
//         $changeusd = isset($_POST['changeusd']) ? $conn->real_escape_string($_POST['changeusd']) : 0;

//         // Auto-generate InvoiceNo
//         $invoiceno = generateInvoiceNo();

//         // Validate ShiftDetailsId
//         $shiftValidationQuery = "SELECT Id FROM shift WHERE Id = ?";
//         $stmt = $conn->prepare($shiftValidationQuery);
//         $stmt->bind_param("i", $shift);
//         $stmt->execute();
//         $stmt->store_result();

//         if ($stmt->num_rows === 0) {
//             echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "Invalid Shift Details ID.",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "pos.php";
//                         });
//                     });
//                   </script>';
//             $stmt->close();
//             return;
//         }
//         $stmt->close();

//         // Insert data into the invoice table
//         $sqlposinvoiceinsert = "INSERT INTO `invoice` 
//         (`OutletId`, `UserId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceNo`, `CateName`, `ProCode`, `ProName`, `UOM`, `Price`, `QTY`, `Amount`, `TotalBeDis`, `DiscountPer`, `DiscountCur`, `AmountInUSD`, `PaidInUSD`, `ChangeUSD`)
//         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
//         $stmtInsert = $conn->prepare($sqlposinvoiceinsert);
//         $stmtInsert->bind_param(
//             "iiiiiissssddidddddd",
//             $branch, $userid, $table, $customer, $shift, $payment, $invoiceno, $catename, $procode, $proname,
//             $uom, $price, $qty, $amount, $totalbedis, $discountper, $discountcur, $totalaftdis, $paidinusd, $changeusd
//         );

//         if ($stmtInsert->execute()) {
//             echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Success",
//                             text: "Payment successfully processed.",
//                             icon: "success"
//                         }).then(function() {
//                             window.location = "pos.php";
//                         });
//                     });
//                   </script>';
//         } else {
//             echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "Error inserting data. ' . $stmtInsert->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "pos.php";
//                         });
//                     });
//                   </script>';
//         }
//         $stmtInsert->close();
//     }   
// }
function pos_invoice_insert() {
    // Check if the form is submitted via POST and the btnsave button is clicked
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnsave'])) {
        include('cn.php'); // Include your database connection
    
        // Retrieve and sanitize POST data
        $invoiceno = htmlspecialchars($_POST['invoiceno'] ?? '');
        $userId = intval($_POST['userid'] ?? 0);
        $shiftId = intval($_POST['shift'] ?? 0);
        $table = intval($_POST['table'] ?? 0);
        $customer = intval($_POST['customer'] ?? 0);
        $branch = intval($_POST['branch'] ?? 0);
        $totalbedis = floatval($_POST['totalbedis'] ?? 0);
        $discountper = floatval($_POST['discountper'] ?? 0);
        $discountcur = floatval($_POST['discountcur'] ?? 0);
        $totalaftdis = floatval($_POST['totalaftdis'] ?? 0);
        $payment = intval($_POST['payment'] ?? 0);
        $paidinusd = floatval($_POST['paidinusd'] ?? 0);
        $changeusd = floatval($_POST['changeusd'] ?? 0);
    
        // Validate ShiftId against the `shiftdetails` table
        $sqlCheckShift = "SELECT Id FROM shiftdetails WHERE Id = ?";
        $stmtCheckShift = $conn->prepare($sqlCheckShift);
        if (!$stmtCheckShift) {
            echo "<script>swal('Error!', 'Error preparing shift validation query: " . $conn->error . "', 'error');</script>";
            return;
        }
    
        $stmtCheckShift->bind_param('i', $shiftId);
        $stmtCheckShift->execute();
        $stmtCheckShift->store_result();
    
        if ($stmtCheckShift->num_rows === 0) {
            // ShiftId is invalid
            echo "<script>swal('Error!', 'Invalid ShiftId. Please check your input.', 'error');</script>";
            $stmtCheckShift->close();
            return;
        }
        $stmtCheckShift->close();
    
        // SQL query to insert data into the invoice table
        $sql = "INSERT INTO invoice (
            InvoiceNo, UserId, ShiftId, TableId, CustomerId, OutletId,
            TotalBeDis, DiscountPer, DiscountCur, AmountInUSD,
            PaymentMethodId, PaidInUSD, ChangeUSD
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "<script>swal('Error!', 'Error preparing insert query: " . $conn->error . "', 'error');</script>";
            return;
        }
    
        // Bind parameters
        $stmt->bind_param(
            "siisissdddsdd",
            $invoiceno,
            $userId,
            $shiftId,
            $table,
            $customer,
            $branch,
            $totalbedis,
            $discountper,
            $discountcur,
            $totalaftdis,
            $payment,
            $paidinusd,
            $changeusd
        );
    
        // Execute the query
        if ($stmt->execute()) {
            echo "<script>swal('Success!', 'Invoice inserted successfully!', 'success');</script>";
        } else {
            echo "<script>swal('Error!', 'Error inserting invoice: " . $stmt->error . "', 'error');</script>";
        }
    
        // Close the statement
        $stmt->close();
    }
}





?>
