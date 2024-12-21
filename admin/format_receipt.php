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

        .details,
        .items {
            text-align: left;
            margin: 10px 0;
        }

        .items table {
            width: 100%;
            border-collapse: collapse;
        }

        .items table th,
        .items table td {
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
    <!-- <a href="pos.php">Back to POS</a> -->
    <div class="receipt">
        <?php
        include('cn.php'); // Database connection
        $invoiceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Fetch store details
        $storeQuery = "SELECT Name, Address, Telephone FROM outlet LIMIT 1";
        $storeResult = $conn->query($storeQuery);
        $store = $storeResult->fetch_assoc();

        echo "<h2><a href='pos.php'>" . htmlspecialchars($store['Name']) . "</a></h2>";
        echo "<p>" . htmlspecialchars($store['Address']) . "</p>";
        echo "<p>Phone: " . htmlspecialchars($store['Telephone']) . "</p>";
        ?>


        <?php
        // Ensure the connection is established ($conn)

        // Check if InvoiceNo is set
        if (isset($_GET['InvoiceNo']) && !empty($_GET['InvoiceNo'])) {
            $InvoiceNo = $_GET['InvoiceNo'];

            // Prepare and execute query for invoice
            $stmtInvoice = $conn->prepare("SELECT * FROM invoice WHERE InvoiceNo = ? LIMIT 1");
            $stmtInvoice->bind_param("s", $InvoiceNo);
            $stmtInvoice->execute();
            $resultInvoice = $stmtInvoice->get_result();

            if ($resultInvoice->num_rows > 0) {
                $invoice = $resultInvoice->fetch_assoc();

                // Extract discount value from the column
                $discount = $invoice['DiscountCur'] ?? 0; // Default to 0 if column is null or empty

                // Display invoice details
                echo "<div class='details'>";
                echo "<p><strong>Date:</strong> " . date('d-m-Y', strtotime($invoice['CreateAt'])) . "</p>";
                echo "<p><strong>Receipt #:</strong> " . htmlspecialchars($invoice['InvoiceNo']) . "</p>";
                echo "</div>";

                // Fetch and display invoice items
                $stmtItems = $conn->prepare("SELECT * FROM invoice WHERE InvoiceNo = ?");
                $stmtItems->bind_param("s", $InvoiceNo);
                $stmtItems->execute();
                $resultItems = $stmtItems->get_result();

                echo "<div class='items'>";
                echo "<table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>";

                $total = 0;

                if ($resultItems->num_rows > 0) {
                    while ($item = $resultItems->fetch_assoc()) {
                        $amount = $item['QTY'] * $item['Price'];
                        $total += $amount;

                        echo "<tr>
                        <td>" . htmlspecialchars($item['ProName']) . "</td>
                        <td>" . htmlspecialchars($item['QTY']) . "</td>
                        <td>$" . number_format($item['Price'], 2) . "</td>
                        <td>$" . number_format($amount, 2) . "</td>
                      </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No items found.</td></tr>";
                }

                echo "</tbody></table></div>";

                // Calculate total after discount
                $totalAfterDiscount = $total - $discount;

                // Display totals
                echo "<div class='total'>";
                echo "<p>Total: $" . number_format($total, 2) . "</p>";
                echo "<p>Discount: $" . number_format($discount, 2) . "</p>";
                echo "<p>Total After Discount: $" . number_format($totalAfterDiscount, 2) . "</p>";
                echo "</div>";

                // Close statements
                $stmtItems->close();
            } else {
                echo "<p>No records found for the provided InvoiceNo.</p>";
            }

            $stmtInvoice->close();
        } else {
            echo "<p>Invoice number is not provided or invalid.</p>";
        }
        ?>



        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>Visit us again!</p>
        </div>
    </div>
    </div>
    <script>
        // Optional: Trigger print immediately
        window.print();
    </script>
</body>

</html>