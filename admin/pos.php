<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
// Include the database connection and other necessary files
include('include/head.php');
include('function_shift.php');

// Fetch the most recent shift record with Status = 1 (Open)
$sqlLatestShift = "SELECT * FROM `shift` WHERE Status = 1 ORDER BY CreateAt DESC LIMIT 1";
$resultLatestShift = $conn->query($sqlLatestShift);

// Initialize variables
$shiftId = '';
$userId = '';
$status = 'Closed'; // Default status

if ($resultLatestShift && $resultLatestShift->num_rows > 0) {
    $latestShift = $resultLatestShift->fetch_assoc();
    $shiftId = $latestShift['Id'];
    $shiftName = $latestShift['Name'];        // The ID of the shift
    $userId = $latestShift['CreateBy'];          // The User ID who created the shift
    $status = $latestShift['Status'] == 1 ? 'Open' : 'Closed'; // Determine shift status
}

// Fetch the username based on the UserId
$username = 'Unknown User'; // Default username
if (!empty($userId)) {
    $sqlUser = "SELECT Username FROM user WHERE Id = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param('i', $userId);
    $stmtUser->execute();
    $stmtUser->bind_result($fetchedUsername);
    if ($stmtUser->fetch()) {
        $username = htmlspecialchars($fetchedUsername); // Sanitize username for display
    }
    $stmtUser->close();
}

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


// Fetch tables
$table = $conn->query("SELECT * FROM `table` WHERE del = 1");

// Fetch customers
$customer = $conn->query("SELECT * FROM `customer` WHERE del = 1");

// Fetch branches
$branch = $conn->query("SELECT * FROM `outlet` WHERE del = 1");

// Fetch payment methods
$payment = $conn->query("SELECT * FROM `paymentmethod` WHERE del = 1");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnsave'])) {
    include('cn.php');

    // Generate custom invoice number
    $invoiceNo = generateInvoiceNo();

    $sql = "INSERT INTO invoice (
        InvoiceNo, OutletId, UserId, TableId, CustomerId, ShiftId, PaymentMethodId,
        CateName, ProCode, ProName, UOM, Price, QTY, Amount,
        TotalBeDis, DiscountPer, DiscountCur, AmountInUSD, PaidInUSD, ChangeUSD
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach ($_POST['items'] as $item) {
                // echo "<pre>";
                // print_r($item);
                // echo "</pre>";
                // exit;
                $branch = isset($_POST['items'][0]['branch']) ? intval($_POST['items'][0]['branch']) : 0;
                $userid = isset($_POST['items'][0]['userid']) ? intval($_POST['items'][0]['userid']) : 0;
                $table = isset($_POST['items'][0]['table']) ? intval($_POST['items'][0]['table']) : 0;
                $customer = isset($_POST['items'][0]['customer']) ? intval($_POST['items'][0]['customer']) : 0;
                $shift = isset($_POST['items'][0]['shift']) ? intval($_POST['items'][0]['shift']) : 0;
                $payment = isset($_POST['items'][0]['payment']) ? intval($_POST['items'][0]['payment']) : 0;

                $catename = isset($item['catename']) ? htmlspecialchars($item['catename']) : '';
                $procode = isset($item['procode']) ? htmlspecialchars($item['procode']) : '';


                $proname = isset($item['proname']) ? htmlspecialchars($item['proname']) : '';
                $uom = isset($item['uom']) ? htmlspecialchars($item['uom']) : '';
                $price = isset($item['price']) ? floatval($item['price']) : 0.0;
                $qty = isset($item['qty']) ? intval($item['qty']) : 0;
                $amount = isset($item['amount']) ? floatval($item['amount']) : 0.0;


                $totalbedis = isset($item['totalbedis']) ? floatval($item['totalbedis']) : 0.0;
                $discountper = isset($item['discountper']) ? floatval($item['discountper']) : 0.0;
                $discountcur = isset($item['discountcur']) ? floatval($item['discountcur']) : 0.0;
                $totalaftdis = isset($item['totalaftdis']) ? floatval($item['totalaftdis']) : 0.0;

                $paidinusd = isset($_POST['items'][0]['paidinusd']) ? floatval($_POST['items'][0]['paidinusd']) : 0.0;
                $changeusd = isset($_POST['items'][0]['changeusd']) ? floatval($_POST['items'][0]['changeusd']) : 0.0;

                $stmt->bind_param(
                    'siiiiiissssddddddddd',
                    $invoiceNo,
                    $branch,
                    $userid,
                    $table,
                    $customer,
                    $shift,
                    $payment,
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

                // if (!$stmt->execute()) {
                //     echo "<div class='alert alert-danger'>Error saving item: " . $stmt->error . "</div>";
                //     break; // Stop the loop if an error occurs
                // }
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
                                                text: "Error inserting data. ' . $stmt->error . '",
                                                icon: "error"
                                            }).then(function() {
                                                window.location = "pos.php";
                                            });
                                        });
                                      </script>';
                }
            }
            echo "<div class='alert alert-success'>All items saved successfully. Invoice No: $invoiceNo</div>";
        } else {
            echo "<div class='alert alert-warning'>No items to process.</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error preparing query: " . $conn->error . "</div>";
    }

    $conn->close();
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Point of Sale</title>
    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/img-ratio.css">
    <link rel="stylesheet" href="css/pos.css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <style>
        .nav-link.active {
            background-color: #007bff !important;
            color: white !important;
        }

        .nav-link {
            transition: background-color 0.3s ease;
        }

        form {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            /* Adjust child layout if needed */
            justify-content: center;
            /* Center items vertically */
            align-items: center;
            /* Center items horizontally */
            box-sizing: border-box;
            padding: 20px;
            /* Optional padding */
            background-color: #f9f9f9;
            /* Background color */
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include './include/sidebar.php' ?>
        <form method="post" enctype="multipart/form-data" action="">
            <?php
            // pos_invoice_insert();
            // Initialize an empty array for the form data
            $rowFrm = array(
                "Id" => "",
                "OutletId" => "",
                "UserId" => "",
                "TableId"  => "",
                "CustomerId"    => "",
                "ShiftId" => "",
                "PaymentMethodId" => "",
                "InvoiceNo" => "",
                "CateName" => "",
                "ProCode" => "",
                "ProName" => "",
                "UOM" => "",
                "Price" => "",
                "QTY" => "",
                "Amount" => "",
                "TotalBeDis" => "",
                "DiscountPer" => "",
                "DiscountCur" => "",
                "AmountInUSD" => "",
                "PaidInUSD" => "",
                "ChangeUSD" => ""
            );
            ?>



            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3">
                                <div class="search-box">
                                    <button class="btn-search bg-info"><i class="fas fa-search"></i></button>
                                    <input type="text" id="productSearch" class="input-search" placeholder="Search to Product...">
                                </div>
                            </div>
                            <div class="col-lg-4 bg-primary text-center rounded w-25 h-25 p-2">
                                <span class="font-weight-bold text-white">
                                    Cashier: <span id="userid" name="userid" value="<?php echo htmlspecialchars($userId); ?>">
                                        <?php echo !empty($username) ? $username : 'Unknown User'; ?>
                                    </span>
                                </span>
                                <span class="font-weight-bold text-white">|</span>
                                <span class="font-weight-bold text-white">
                                    <span id="shift" name="shift" value="<?php echo htmlspecialchars($shiftName); ?>">
                                        <?php echo !empty($shiftName) ? htmlspecialchars($shiftName) : 'No Shift Found'; ?>
                                    </span>
                                </span>
                                <!-- <span class="font-weight-bold text-white">|</span> -->
                                <!-- <span class="font-weight-bold text-white">
                                    Status: <span id="status">
                                        <?php echo htmlspecialchars($status); ?>
                                    </span>
                                </span> -->
                                <input type="hidden" name="items[0][shift]" value="<?php echo htmlspecialchars($shiftId); ?>">
                                <input type="hidden" name="items[0][userid]" value="<?php echo htmlspecialchars($userId); ?>">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" style="display: none;" name="Id" value="<?php echo isset($rowFrm['Id']) ? htmlspecialchars($rowFrm['Id']) : ''; ?>">
                                <select class="form-select" name="items[0][table]" id="table">
                                    <option value="" disabled selected>Select table...</option>
                                    <?php while ($row = $table->fetch_assoc()): ?>
                                        <option value="<?= htmlspecialchars($row['Id']) ?>"><?= htmlspecialchars($row['Name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="items[0][customer]" id="customer">
                                    <?php while ($row = $customer->fetch_assoc()): ?>
                                        <option value="<?= htmlspecialchars($row['Id']) ?>"><?= htmlspecialchars($row['Lastname']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="items[0][branch]" id="branch">
                                    <?php while ($row = $branch->fetch_assoc()): ?>
                                        <option value="<?= htmlspecialchars($row['Id']) ?>"><?= htmlspecialchars($row['Name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col bg-white py-4 rounded card shadow mb-4">
                                <div class="col-lg-12">
                                    <!-- Tablist -->
                                    <ul class="nav nav-tabs" id="itemGroupTabs" role="tablist">
                                        <?php
                                        $categories = $conn->query("SELECT DISTINCT Name FROM `category`");
                                        $firstTab = true; // First tab active
                                        while ($category = $categories->fetch_assoc()) :
                                            $categoryName = $category['Name'];
                                        ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link <?= $firstTab ? 'active' : '' ?>" id="<?= strtolower($categoryName) ?>-tab"
                                                    data-bs-toggle="tab" data-bs-target="#<?= strtolower($categoryName) ?>" type="button" role="tab"
                                                    aria-controls="<?= strtolower($categoryName) ?>" aria-selected="<?= $firstTab ? 'true' : 'false' ?>">
                                                    <?= $categoryName ?>
                                                </button>
                                            </li>
                                        <?php
                                            $firstTab = false;
                                        endwhile;
                                        ?>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content " id="itemGroupTabsContent" style="max-height: 600px; overflow: auto; display: block;">
                                        <?php
                                        $categories = $conn->query("SELECT DISTINCT Name FROM `category`");
                                        $firstTab = true;
                                        while ($category = $categories->fetch_assoc()) :
                                            $categoryName = $category['Name'];
                                        ?>
                                            <div class="tab-pane fade <?= $firstTab ? 'show active' : '' ?>" id="<?= strtolower($categoryName) ?>" role="tabpanel"
                                                aria-labelledby="<?= strtolower($categoryName) ?>-tab">
                                                <div class="row">
                                                    <?php
                                                    $products = $conn->query("
                                                            SELECT 
                                                                p.Name AS ProductName,
                                                                p.Image AS ProductImage,
                                                                p.price AS ProductPrice,
                                                                u.Name AS UOMName
                                                            FROM 
                                                                product p
                                                            JOIN 
                                                                uom u ON u.Id = p.uom
                                                            JOIN 
                                                                category c ON c.Id = p.CategoryId
                                                            WHERE 
                                                                c.Name = '$categoryName' AND p.del = 1
                                                        ");

                                                    while ($row = $products->fetch_assoc()) :
                                                    ?>
                                                        <div class="col-3 pt-2 pb-2 product-item" data-name="<?= strtolower($row['ProductName']) ?>">
                                                            <div class="card border-1">
                                                                <div class="thumbnail-wrapper">
                                                                    <div class="thumbnail-inner img4by3">
                                                                        <img src="ImageProduct/<?= $row['ProductImage'] ?>" class="rounded" alt="<?= $row['ProductName'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text"><?= $row['ProductName'] ?></p>
                                                                    <h5 class="text-success"><?= $row['ProductPrice'] ?></h5>
                                                                    <p class="text-muted"><?= $row['UOMName'] ?></p>

                                                                    <button class="btn btn-primary add-to-cart" type="button" data-item="<?= $row['ProductName'] ?>" data-price="<?= $row['ProductPrice'] ?>" data-catename="<?= $categoryName ?>">
                                                                        <i class="fas fa-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                        <?php
                                            $firstTab = false;
                                        endwhile;
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 bg-white py-4 rounded ml-4 card shadow mb-4">
                                <div id="order-details">
                                    <h5 class="text-center">Order Details</h5>
                                    <table class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- Scrollable body -->
                                    <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                                        <input type="text" style="display: none;" name="items[0][invoiceNo]" value="<?php echo isset($rowFrm['InvoiceNo']) ? htmlspecialchars($rowFrm['InvoiceNo']) : ''; ?>">
                                        <table class="table table-hover">
                                            <tbody id="order-list">
                                                <!-- Dynamically generated content -->
                                                <tr>
                                                    <td>
                                                        <!-- <input type="text" name="items[0][catename]" class="form-control" style="display: block;" value="<?php echo isset($rowFrm['CateName']) ? htmlspecialchars($rowFrm['CateName']) : ''; ?>">
                                                            <input type="hidden" name="items[0][procode]" class="form-control" style="display: none;" value="<?php echo isset($rowFrm['ProCode']) ? htmlspecialchars($rowFrm['ProCode']) : ''; ?>">
                                                            <input type="text" name="items[0][proname]" class="form-control" 
                                                                value="<?php echo htmlspecialchars($rowFrm['ProName']); ?>" readonly> -->
                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="items[0][price]" class="form-control" 
                                                                value="<?php echo htmlspecialchars($rowFrm['Price']); ?>" readonly> -->
                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="items[0][qty]" class="form-control" 
                                                                value="<?php echo htmlspecialchars($rowFrm['QTY']); ?>" readonly> -->
                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="items[0][amount]" class="form-control" 
                                                                value="<?php echo htmlspecialchars($rowFrm['Amount']); ?>" readonly> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="discount" class="form-label fw-bold">Discount (%):</label>
                                        <input type="number" min="0" name="discount" id="discount" class="form-control fw-bold" value="0">
                                        <div class="mt-4 row g-2">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="5">5%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="10">10%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="15">15%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="20">20%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="25">25%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="30">30%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="50">50%</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-primary btn-sm discount-btn w-100 fw-bold fs-5" data-discount="100">100%</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="discount-amount" class="form-label fw-bold">Discount ($):</label>
                                        <input type="number" min="0.0" step="0.01" id="discount-amount" class="form-control fw-bold" value="0">
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <label class="fw-bold fs-4">Total USD:</label>
                                        <label class="fw-bold fs-4" id="total-price">$0.00</label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <label class="fw-bold fs-4">Total KHR:</label>
                                        <label class="fw-bold fs-4" id="total-price-kh">៛0.00</label>
                                    </div>
                                    <button class="btn btn-success mt-3" id="checkout" type="button"><i class="fa-brands fa-paypal"></i> Tender</button>

                                    <button class="btn btn-secondary mt-3" id="print-bill" type="button"><i class="fa-solid fa-print"></i> Print Bill</button>
                                </div>
                                <div id="receipt-preview" style="display: none;">
                                    <h5 class="text-center">Receipt</h5>
                                    <ul id="receipt-list" class="list-group"></ul>
                                    <hr>
                                    <div class="d-flex justify-content-between fs-4">
                                        <h5>Total:</h5>
                                        <h5 id="receipt-total">$0.00</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <!-- Open Shift Button -->

                                    <?php
                                        $SQLshift = "SELECT * FROM `shift` ";
                                        $shift = $conn->query($SQLshift);
                                        $rowshift = $shift->fetch_assoc();
                                    ?>
                                    <?php foreach ($shift as $rowshift)

                                    ?>
                                    <?php
                                        if ($rowshift['Status'] == 1)
                                        {
                                            echo '<a href="closeShift.php?Id='.$rowshift['Id'].'&Status=0   "class="btn btn-danger mt-4 mr-2 p-2" id="close-shift"><i class="fa-solid fa-door-closed"></i> Close Shift</a>';
                                        }else{
                                            echo '<a href="shift-add.php" class="btn btn-primary mt-4 mr-2 p-2" id="open-shift"><i class="fa-solid fa-door-open"></i> Open Shift</a>';
                                        }
                                    ?>
                                    <a href="report_list_sales_in_pos_today.php" class="btn btn-warning mt-4 mr-2 p-2" id="delete-invoice"> </i> Invoice List</a>
                                    <a href="format_receipt.php" class="btn btn-info mt-4 mr-2 p-2" id="reprint"><i class="fa-solid fa-copy"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" id="paymentModalDialog" style="max-width: 80%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel">Checkout Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="col-lg-4 bg-white py-4 rounded ml-4 card shadow mb-4 w-50">
                                <!-- Scrollable Section: Payment Summary -->
                                <label class="modal-title mb-4 bg-info text-center rounded p-2 fs-4" id="paymentModalLabel">Payment Summary</label>
                                <div class="mb-4" style="overflow-y: auto; max-height: 200px;">
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Before Discount Total:</span>
                                        <span id="modal-before-discount" name="totalbedis">$0.00</span>
                                        <!-- <input type="text" style="display: block;" name="items[0][totalbedis]" value="<?php echo isset($rowFrm['TotalBeDis']) ? htmlspecialchars($rowFrm['TotalBeDis']) : ''; ?>"> -->
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Discount Percentage:</span>
                                        <span id="modal-discount-percentage" name="discountper">0%</span>
                                        <!-- <input type="text" style="display: none;" name="items[0][discountper]" value="<?php echo isset($rowFrm['DiscountPer']) ? htmlspecialchars($rowFrm['DiscountPer']) : ''; ?>"> -->
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Discount Amount:</span>
                                        <span id="modal-discount-amount" name="discountcur">$0.00</span>
                                        <!-- <input type="text" style="display: none;" name="items[0][discountcur]" value="<?php echo isset($rowFrm['DiscountCur']) ? htmlspecialchars($rowFrm['DiscountCur']) : ''; ?>"> -->
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Total After Discount:</span>
                                        <span id="modal-total-after-discount" name="totalaftdis">$0.00</span>
                                        <!-- <input type="text" style="display: none;" id="totalaftdisValue"> -->
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Change:</span>
                                        <span id="modal-change" name="changeusd">$0.00</span>
                                        <input type="text" id="modelChangeUsdAmount" style="display: none;" name="items[0][changeusd]" value="<?php echo isset($rowFrm['ChangeUSD']) ? htmlspecialchars($rowFrm['ChangeUSD']) : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 bg-white py-4 rounded card shadow mb-4 w-50">
                                <!-- Scrollable Section: Payment Method -->
                                <label for="payment-method" class="modal-title mb-4 bg-success text-center rounded p-2 fs-4 text-white">Payment Method</label>
                                <div class="d-flex justify-content-between">
                                    <select id="payment-method" class="form-select fw-bold fs-5 mt-3 w-50 h-25" name="items[0][payment]">
                                        <?php while ($row = $payment->fetch_assoc()): ?>
                                            <option value="<?= htmlspecialchars($row['Id']) ?>"><?= htmlspecialchars($row['Name']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <!-- Centered Card Section: Payment Received -->
                                    <div class="card-body text-center">
                                        <label for="payment-received" class="form-label fw-bold fs-5">Payment Received</label>
                                        <input type="number" min="0" id="payment-received" class="form-control fw-bold fs-5" step="0.01" name="items[0][paidinusd]" value="<?php echo htmlspecialchars($rowFrm['PaidInUSD']); ?>" placeholder="Enter amount......" ​required>
                                        <button type="button" class="btn btn-success mt-3 w-100" id="remaining-payment">Add Remaining</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Scrollable Section: Quick Payment -->
                            <div class="col-lg-2 bg-white py-4 rounded mr-4 card shadow mb-4 w-25">
                                <lable for="quick-payment" class="modal-title mb-4 bg-warning text-center rounded p-2 fs-4">Quick Payment</lable>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="1">1$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="2">2$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="5">5$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="10">10$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="20">20$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="50">50$</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-warning quick-payment w-100 fw-bold fs-5" data-value="100">100$</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons: Close and Finalize Payment -->
                        <div class="d-flex justify-content-end gap-3 mb-4 mr-4">
                            <button type="button" class="btn btn-secondary p-4" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="btnsave" class="btn btn-primary p-4" id="finalize-payment">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const cart = [];
                const orderList = document.getElementById('order-list');
                const totalPrice = document.getElementById('total-price');
                const totalPriceKH = document.getElementById('total-price-kh');
                const discountInput = document.getElementById('discount');
                const discountAmountInput = document.getElementById('discount-amount'); //new
                const discountButtons = document.querySelectorAll('.discount-btn'); //new
                const totalPriceElement = document.getElementById('total-price'); //new
                const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                const modalBeforeDiscount = document.getElementById('modal-before-discount');
                const modalDiscountPercentage = document.getElementById('modal-discount-percentage');
                const modalDiscountAmount = document.getElementById('modal-discount-amount');
                const modalTotalAfterDiscount = document.getElementById('modal-total-after-discount');
                const paymentReceivedInput = document.getElementById('payment-received');
                const remainingPaymentButton = document.getElementById('remaining-payment');
                const modalChange = document.getElementById('modal-change');

                function updateCart() {
                    orderList.innerHTML = ''; // Clear the table body
                    let total = 0.0;
                    const totalSum = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                    cart.forEach((item, index) => {

                        console.log(item)

                        const itemTotal = item.price * item.quantity;
                        total += itemTotal;

                        // Create a new row
                        const row = document.createElement('tr');

                        let hiddenInputs = "<input type='hidden' name='items[" + index + "][proname]' value='" + item.name + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][catename]' value='" + item.catename + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][catename]' value='" + item.catename + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][price]' value='" + item.price.toFixed(2) + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][qty]' value='" + item.quantity + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][amount]' value='" + itemTotal.toFixed(2) + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][totalbedis]' value='" + totalSum.toFixed(2) + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][discountper]' value='" + parseFloat(discountInput.value).toFixed(2) + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][discountcur]' value='" + parseFloat(totalSum * parseFloat(discountInput.value) / 100.0).toFixed(2) + "'>";
                        hiddenInputs += "<input type='hidden' name='items[" + index + "][totalaftdis]' value='" + (totalSum - parseFloat(totalSum * parseFloat(discountInput.value) / 100.0).toFixed(2)) + "'>";

                        row.innerHTML += hiddenInputs;

                        // Description
                        const nameCell = document.createElement('td');
                        nameCell.textContent = item.name;

                        // Price
                        const priceCell = document.createElement('td');
                        priceCell.textContent = `$${item.price.toFixed(2)}`;

                        // Quantity
                        const quantityCell = document.createElement('td');
                        const quantityContainer = document.createElement('div');
                        quantityContainer.classList.add('d-flex', 'align-items-center', 'justify-content-center');

                        const decreaseBtn = document.createElement('button');
                        decreaseBtn.classList.add('btn', 'btn-sm', 'btn-secondary', 'me-1');
                        decreaseBtn.textContent = '-';
                        decreaseBtn.addEventListener('click', () => {
                            if (item.quantity > 1) {
                                item.quantity--;
                                updateCart();
                            }
                        });

                        const quantityDisplay = document.createElement('span');
                        quantityDisplay.textContent = item.quantity;

                        const increaseBtn = document.createElement('button');
                        increaseBtn.classList.add('btn', 'btn-sm', 'btn-secondary', 'ms-1');
                        increaseBtn.textContent = '+';
                        increaseBtn.addEventListener('click', () => {
                            item.quantity++;
                            updateCart();
                        });

                        quantityContainer.appendChild(decreaseBtn);
                        quantityContainer.appendChild(quantityDisplay);
                        quantityContainer.appendChild(increaseBtn);
                        quantityCell.appendChild(quantityContainer);

                        // Amount
                        const amountCell = document.createElement('td');
                        amountCell.textContent = `$${itemTotal.toFixed(2)}`;

                        // Remove Button with Font Awesome icon
                        const actionCell = document.createElement('td');
                        const removeBtn = document.createElement('button');
                        removeBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                        // Add Font Awesome icon
                        const icon = document.createElement('i');
                        icon.classList.add('fas', 'fa-trash'); // Font Awesome trash icon
                        removeBtn.appendChild(icon);
                        removeBtn.addEventListener('click', () => {
                            cart.splice(index, 1);
                            updateCart();
                        });
                        actionCell.appendChild(removeBtn);

                        // Append all cells to the row
                        row.appendChild(nameCell);
                        row.appendChild(priceCell);
                        row.appendChild(quantityCell);
                        row.appendChild(amountCell);
                        row.appendChild(actionCell);

                        // Add the row to the table body
                        orderList.appendChild(row);
                    });

                    // Calculate discounts and total
                    const discountPercentage = parseFloat(discountInput.value) || 0;
                    const discountByAmount = parseFloat(discountAmountInput.value) || 0;

                    const discountFromPercentage = total * (discountPercentage / 100);
                    const discountedTotal = Math.max(total - discountFromPercentage - discountByAmount, 0);


                    document.getElementById('discount-amount').value = parseFloat(parseFloat(discountFromPercentage).toFixed(2));

                    totalPrice.textContent = `$${discountedTotal.toFixed(2)}`;
                    totalPriceKH.textContent = `៛${parseFloat(discountedTotal * 4100).toFixed(2)}`;
                }




                function removeItem(index) {
                    cart.splice(index, 1);
                    updateCart();
                }

                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', () => {
                        const itemName = button.getAttribute('data-item');
                        const itemPrice = parseFloat(button.getAttribute('data-price'));
                        const itemCateName = button.getAttribute('data-catename');
                        const existingItem = cart.find(item => item.name === itemName);

                        if (existingItem) {
                            existingItem.quantity += 1;
                        } else {
                            cart.push({
                                name: itemName,
                                price: itemPrice,
                                quantity: 1,
                                catename: itemCateName
                            });
                        }

                        updateCart();
                    });
                });

                remainingPaymentButton.addEventListener('click', () => {
                    const totalAfterDiscount = parseFloat(modalTotalAfterDiscount.textContent.replace('$', '')) || 0;
                    paymentReceivedInput.value = totalAfterDiscount.toFixed(2);
                    paymentReceivedInput.dispatchEvent(new Event('input'));
                });
                discountInput.addEventListener('input', updateCart);
                discountAmountInput.addEventListener('input', updateCart);

                discountButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const percentage = parseFloat(button.getAttribute('data-discount'));
                        discountInput.value = percentage;
                        updateCart();
                    });
                });

                document.getElementById('checkout').addEventListener('click', () => {

                    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                    const discount = parseFloat(discountInput.value) || 0;
                    const discountAmount = parseFloat(discountAmountInput.value) || 0;
                    const discountFromPercentage = total * (discount / 100);
                    const totalAfterDiscount = total - discountFromPercentage - discountAmount;

                    modalBeforeDiscount.textContent = `$${total.toFixed(2)}`;
                    modalDiscountPercentage.textContent = `${discount}%`;
                    modalDiscountAmount.textContent = `$${discountAmount.toFixed(2)}`;
                    modalTotalAfterDiscount.textContent = `$${totalAfterDiscount.toFixed(2)}`;
                });

                document.querySelectorAll('.quick-payment').forEach(button => {
                    button.addEventListener('click', () => {
                        const value = parseFloat(button.getAttribute('data-value'));
                        const current = parseFloat(paymentReceivedInput.value) || 0;
                        paymentReceivedInput.value = current + value;
                        paymentReceivedInput.dispatchEvent(new Event('input'));
                    });
                });

                paymentReceivedInput.addEventListener('input', () => {
                    const received = parseFloat(paymentReceivedInput.value) || 0;
                    const totalAfterDiscount = parseFloat(modalTotalAfterDiscount.textContent.replace('$', ''));
                    const change = received - totalAfterDiscount;

                    modalChange.textContent = `$${change.toFixed(2)}`;

                    document.getElementById("modelChangeUsdAmount").value = change.toFixed(2);

                });

                // document.getElementById('finalize-payment').addEventListener('click', () => {
                //     alert('Payment finalized!');
                //     paymentModal.hide();
                // });

            });

            function adjustModalWidth() {
                const modalDialog = document.getElementById('paymentModalDialog');
                modalDialog.style.maxWidth = '10%'; // Set modal width to 90% of viewport
            }
        </script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script>
            // Search Filter
            document.getElementById('productSearch').addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const productItems = document.querySelectorAll('.product-item');

                productItems.forEach(item => {
                    const productName = item.getAttribute('data-name');
                    if (productName.includes(searchValue)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkoutButton = document.getElementById('checkout');
                const orderList = document.getElementById('order-list');
                const paymentModal = document.getElementById('paymentModal');

                checkoutButton.addEventListener('click', function(e) {
                    // Check if there are any items in the order list
                    const hasItems = orderList.querySelectorAll('tr').length > 0;

                    if (!hasItems) {
                        // Prevent default behavior and show an alert
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'No item for checkout',
                            text: 'Please add items to the order before proceeding.',
                        });
                    } else {
                        // Add Bootstrap modal attributes dynamically to the button
                        checkoutButton.setAttribute('data-bs-toggle', 'modal');
                        checkoutButton.setAttribute('data-bs-target', '#paymentModal');

                        // Simulate a click to trigger the modal
                        checkoutButton.click();
                    }
                });
                paymentModal.addEventListener('hidden.bs.modal', function() {
                    checkoutButton.removeAttribute('data-bs-toggle');
                    checkoutButton.removeAttribute('data-bs-target');
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const paymentReceivedInput = document.getElementById('payment-received');
                const finalizePaymentButton = document.getElementById('finalize-payment');
                const modalTotalAfterDiscount = document.getElementById('modal-total-after-discount');
                const modalChange = document.getElementById('modal-change');

                // Disable the "Pay" button initially
                finalizePaymentButton.disabled = true;

                // Listen for input changes in the payment-received field
                paymentReceivedInput.addEventListener('input', function() {
                    const received = parseFloat(paymentReceivedInput.value) || 0;
                    const totalAfterDiscount = parseFloat(modalTotalAfterDiscount.textContent.replace('$', '')) || 0;
                    const change = received - totalAfterDiscount;

                    // Update change amount
                    modalChange.textContent = `$${change.toFixed(2)}`;
                    document.getElementById("modelChangeUsdAmount").value = change.toFixed(2);

                    // Check if payment is sufficient
                    if (received < totalAfterDiscount) {
                        finalizePaymentButton.disabled = true;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Payment is not enough',
                            text: `You need to pay at least $${totalAfterDiscount.toFixed(2)}.`,
                        });
                    } else {
                        finalizePaymentButton.disabled = false;
                    }
                });

                // Additional validation when attempting to submit payment
                finalizePaymentButton.addEventListener('click', function(e) {
                    const received = parseFloat(paymentReceivedInput.value) || 0;
                    const totalAfterDiscount = parseFloat(modalTotalAfterDiscount.textContent.replace('$', '')) || 0;

                    if (received < totalAfterDiscount) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment is not enough',
                            text: `You cannot proceed. Required amount: $${totalAfterDiscount.toFixed(2)}.`,
                        });
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const finalizePaymentButton = document.getElementById('finalize-payment');
                const tableSelect = document.getElementById('table');

                finalizePaymentButton.addEventListener('click', function(e) {
                    // Check if a table is selected
                    if (!tableSelect.value) {
                        e.preventDefault(); // Prevent form submission
                        Swal.fire({
                            icon: 'warning',
                            title: 'Table not selected',
                            text: 'Please select a table before proceeding.',
                        });
                    }
                });
            });
        </script>


</body>

</html>