<?php
include('include/head.php');
include('function_pos_invoice.php');
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
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include './include/sidebar.php' ?>
        <form action="pos.php" method="post" enctype="multipart/form-data" oninput="calculatePOS()">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php include './include/topbar.php' ?>
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
                                    Cashier: <span id="userid" name="userid" value="<?php echo htmlspecialchars($rowFrm['UserId']); ?>"></span>
                                </span>
                                <span class="font-weight-bold text-white">|</span>
                                <span class="font-weight-bold text-white">
                                    Shift: <span id="shift" name="shift" value="<?php echo htmlspecialchars($rowFrm['ShiftDetailsId']); ?>"></span>
                                </span>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="table" id="table">
                                    <option value="" disabled selected>Select table...</option>
                                        <?php
                                                $sqltable = "SELECT * FROM `table` WHERE del=1";
                                                $qrtable = $conn->query($sqltable);
                                                while ($rowtable = $qrtable->fetch_assoc()){
                                                $sel = ($rowtable['Id'] == $rowFrm['TableId']) ? 'selected' : '';
                                                echo '<option value="' .htmlspecialchars($rowtable['Id']) .'" ' . $sel . '>' . htmlspecialchars($rowtable['Name']) . '</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="customer" id="customer">
                                        <?php
                                                $sqlcustomer = "SELECT * FROM `customer` WHERE del=1";
                                                $qrcustomer = $conn->query($sqlcustomer);
                                                while ($rowcustomer = $qrcustomer->fetch_assoc()){
                                                $sel = ($rowcustomer['Id'] == $rowFrm['CustomerId']) ? 'selected' : '';
                                                echo '<option value="' .htmlspecialchars($rowcustomer['Id']) .'" ' . $sel . '>' . htmlspecialchars($rowcustomer['Lastname']) . '</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="branch" id="branch">
                                        <?php
                                                $sqlbranch = "SELECT * FROM `outlet` WHERE del=1";
                                                $qrbranch = $conn->query($sqlbranch);
                                                while ($rowbranch = $qrbranch->fetch_assoc()){
                                                $sel = ($rowbranch['Id'] == $rowFrm['OutletId']) ? 'selected' : '';
                                                echo '<option value="' .htmlspecialchars($rowbranch['Id']) .'" ' . $sel . '>' . htmlspecialchars($rowbranch['Name']) . '</option>';
                                                }
                                        ?>
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
                                        <div class="tab-content overflow-auto" id="itemGroupTabsContent" style="max-height: 600px; overflow-y: auto;">
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
                                                            <div class="col-lg-3 pt-3 pb-3 product-item" data-name="<?= strtolower($row['ProductName']) ?>">
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
                                                                        <button class="btn btn-primary add-to-cart" type="button" data-item="<?= $row['ProductName'] ?>" data-price="<?= $row['ProductPrice'] ?>">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="order-list">
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div>
                                        <label for="discount" class="form-label fw-bold">Discount (%):</label>
                                        <input type="number" min="0" id="discount" class="form-control fw-bold" value="0">
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="5">5%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="10">10%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="15">15%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="20">20%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="25">25%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="30">30%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="50">50%</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm discount-btn fw-bold" data-discount="100">100%</button>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="discount-amount" class="form-label fw-bold">Discount ($):</label>
                                        <input type="number" min="0" id="discount-amount" class="form-control fw-bold" value="0">
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <h5>Total:</h5>
                                        <h5 id="total-price">$0.00</h5>
                                    </div>
                                    <button class="btn btn-success mt-3" id="checkout" type="button"><i class="fa-brands fa-paypal"></i> Checkout</button>

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
                                    <a href=""class="btn btn-primary mt-4 mr-2 p-2" id="open-shift"><i class="fa-solid fa-door-open"></i> Open Shift</a>
                                    <a href=""class="btn btn-danger mt-4 mr-2 p-2" id="close-shift"><i class="fa-solid fa-door-closed"></i> Close Shift</a>
                                    <a href=""class="btn btn-warning mt-4 mr-2 p-2" id="delete-invoice"> <i class="fa-solid fa-rectangle-xmark"></i> Delete Invoice</a>
                                    <a href=""class="btn btn-info mt-4 mr-2 p-2" id="reprint"><i class="fa-solid fa-copy"></i> Reprint</a>
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
                                        <span id="modal-before-discount" name="totalbedis" value="<?php echo htmlspecialchars($rowFrm['TotalBeDis']); ?>">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Discount Percentage:</span>
                                        <span id="modal-discount-percentage" name="discountper" value="<?php echo htmlspecialchars($rowFrm['DiscountPer']); ?>">0%</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Discount Amount:</span>
                                        <span id="modal-discount-amount" name="discountcur" value="<?php echo htmlspecialchars($rowFrm['DiscountCur']); ?>">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Total After Discount:</span>
                                        <span id="modal-total-after-discount" name="totalaftdis" value="<?php echo htmlspecialchars($rowFrm['AmountInUSD']); ?>">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4">
                                        <span>Change:</span>
                                        <span id="modal-change" name="changeusd" value="<?php echo htmlspecialchars($rowFrm['ChangeUSD']); ?>">$0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 bg-white py-4 rounded card shadow mb-4 w-50">
                                <!-- Scrollable Section: Payment Method -->
                                    <label for="payment-method" class="modal-title mb-4 bg-success text-center rounded p-2 fs-4 text-white">Payment Method</label>
                                    <div class="d-flex justify-content-between">
                                        <select id="payment-method" class="form-select fw-bold fs-5 mt-3 w-50 h-25" name="payment">
                                            <?php
                                                    $sqlpayment = "SELECT * FROM `paymentmethod` WHERE del=1";
                                                    $qrpayment = $conn->query($sqlpayment);
                                                    while ($rowpayment = $qrpayment->fetch_assoc()){
                                                    $sel = ($rowpayment['Id'] == $rowFrm['PaymentMethodId']) ? 'selected' : '';
                                                    echo '<option value="' .htmlspecialchars($rowpayment['Id']) .'" ' . $sel . '>' . htmlspecialchars($rowpayment['Name']) . '</option>';
                                                }
                                            ?>
                                        </select>
                                    <!-- Centered Card Section: Payment Received -->
                                        <div class="card-body text-center">
                                            <label for="payment-received" class="form-label fw-bold fs-5">Payment Received</label>
                                            <input type="number" min="0" id="payment-received" class="form-control fw-bold fs-5" name="paidinusd" value="<?php echo htmlspecialchars($rowFrm['PaidInUSD']); ?>" placeholder="Enter amount......">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btnsave" class="btn btn-primary" id="finalize-payment">Finalize Payment</button>
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
                let total = 0;

                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    // Create a new row
                    const row = document.createElement('tr');

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

                totalPrice.textContent = `$${discountedTotal.toFixed(2)}`;
            }




            function removeItem(index) {
                cart.splice(index, 1);
                updateCart();
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', () => {
                    const itemName = button.getAttribute('data-item');
                    const itemPrice = parseFloat(button.getAttribute('data-price'));
                    const existingItem = cart.find(item => item.name === itemName);

                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        cart.push({ name: itemName, price: itemPrice, quantity: 1 });
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
            });

            document.getElementById('finalize-payment').addEventListener('click', () => {
                alert('Payment finalized!');
                paymentModal.hide();
            });

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
            document.addEventListener('DOMContentLoaded', function () {
                const checkoutButton = document.getElementById('checkout');
                const orderList = document.getElementById('order-list');
                const paymentModal = document.getElementById('paymentModal');

                checkoutButton.addEventListener('click', function (e) {
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
                paymentModal.addEventListener('hidden.bs.modal', function () {
                checkoutButton.removeAttribute('data-bs-toggle');
                checkoutButton.removeAttribute('data-bs-target');
            });
            });

        </script>





    </body>

</html>
