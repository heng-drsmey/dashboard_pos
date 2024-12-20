<?php
include('cn.php');
function generateInvoiceNo()
{
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
    generateInvoiceNo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            text-align: center;
        }
        .receipt {
            max-width: 300px;
            margin: 20px auto;
            padding: 15px;
            border: 1px dashed #000;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
        }
        .details, .items {
            text-align: left;
            margin: 10px 0;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items table th, .items table td {
            border-bottom: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .items table th {
            font-weight: bold;
        }
        .total {
            text-align: right;
            margin: 10px 0;
            font-size: 1.2em;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <?php
            include('cn.php'); // Database connection
            $invoiceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

            // Fetch store details
            $storeQuery = "SELECT Name, Address, Telephone FROM outlet LIMIT 1";
            $storeResult = $conn->query($storeQuery);
            $store = $storeResult->fetch_assoc();

            echo "<h2>" . htmlspecialchars($store['Name']) . "</h2>";
            echo "<p>" . htmlspecialchars($store['Address']) . "</p>";
            echo "<p>Phone: " . htmlspecialchars($store['Telephone']) . "</p>";
            ?>
        </div>

        <div class="details">
            <?php
            // Fetch invoice details
            $invoiceQuery = "SELECT CreateAt, InvoiceNo, Price, DiscountCur, FROM invoice WHERE Id = $invoiceId";
            $invoiceResult = $conn->query($invoiceQuery);
            $invoice = $invoiceResult->fetch_assoc();

            echo "<p><strong>Date:</strong> " . date('d-m-Y', strtotime($invoice['CreateAt'])) . "</p>";
            echo "<p><strong>Receipt #:</strong> " . $invoiceId . "</p>";
            ?>
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch item details for the invoice
                    
                    $itemsResult = $conn->query($itemsQuery);

                    while ($item = $itemsResult->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($item['ProductName']) . "</td>
                                <td>" . intval($item['QTY']) . "</td>
                                <td>$" . number_format($item['Price'], 2) . "</td>
                                <td>$" . number_format($item['Amount'], 2) . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="total">
            <?php
            echo "<p>Total: $" . number_format($invoice['TotalPrice'], 2) . "</p>";
            echo "<p>Discount: $" . number_format($invoice['Discount'], 2) . "</p>";
            echo "<p>Total After Discount: $" . number_format($invoice['TotalAfterDiscount'], 2) . "</p>";
            ?>
        </div>

        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>Visit us again!</p>
        </div>
    </div>

    <script>
        // Optional: Trigger print immediately
        window.print();
    </script>
</body>
</html>
