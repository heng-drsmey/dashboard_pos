<!-- link sweet alert -->
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
function pos_invoice_insert() {
    global $conn;

    if (isset($_POST['btnsave'])) {
        // Fetch and sanitize input data
        $branch = isset($_POST['branch']) ? $conn->real_escape_string($_POST['branch']) : null;
        $userid = isset($_POST['userid']) ? $conn->real_escape_string($_POST['userid']) : null;
        $table = isset($_POST['table']) ? $conn->real_escape_string($_POST['table']) : null;
        $customer = isset($_POST['customer']) ? $conn->real_escape_string($_POST['customer']) : null;
        $shift = isset($_POST['shift']) ? $conn->real_escape_string($_POST['shift']) : null;
        $payment = isset($_POST['payment']) ? $conn->real_escape_string($_POST['payment']) : null;
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

        // Auto-generate InvoiceNo
        $invoiceno = generateInvoiceNo();

        // Validate ShiftDetailsId
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

        // Insert data into the invoice table
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
?>
