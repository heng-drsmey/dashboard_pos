<?php
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-mug-hot"></i>
        </div>
        <div class="sidebar-brand-text mx-3">POS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo ($current_page == 'company-add.php' || $current_page == 'company-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCom" aria-expanded="true" aria-controls="collapseCom">
            <i class="fas fa-fw fa-building"></i>
            <span>Company</span>
        </a>
        <div id="collapseCom" class="collapse" aria-labelledby="headingCom" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <a class="collapse-item" href="company-add.php">Add Company</a>
                <a class="collapse-item" href="company-list.php">Company List</a> -->
                <!-- Company -->
                <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <span style="color: blue;">Company</span>
                </a>
                <div id="collapseEmployee" class="collapse <?php echo ($current_page == 'company-add.php' || $current_page == 'company-list.php') ? 'show' : ''; ?>" aria-labelledby="headingEmployee" data-parent="#collapseSet">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'company-add.php') ? 'active' : ''; ?>" href="company-add.php">Add Company</a>
                        <a class="collapse-item <?php echo ($current_page == 'company-list.php') ? 'active' : ''; ?>" href="company-list.php">Company List</a>

                    </div>
                </div>
                <!-- Employee -->
                <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <span style="color: blue;">Employee</span>
                </a>
                <div id="collapseEmployee" class="collapse <?php echo ($current_page == 'employee-add.php' || $current_page == 'employee-list.php') ? 'show' : ''; ?>" aria-labelledby="headingEmployee" data-parent="#collapseSet">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'employee-add.php') ? 'active' : ''; ?>" href="employee-add.php">Add Employee</a>
                        <a class="collapse-item <?php echo ($current_page == 'employee-list.php') ? 'active' : ''; ?>" href="employee-list.php">Employees List</a>

                    </div>
                </div>
                <!-- Customer -->
                <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <span style="color: blue;">Customer</span>
                </a>
                <div id="collapseEmployee" class="collapse <?php echo ($current_page == 'customer-add.php' || $current_page == 'customer-list.php') ? 'show' : ''; ?>" aria-labelledby="headingEmployee" data-parent="#collapseSet">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'customer-add.php') ? 'active' : ''; ?>" href="customer-add.php">Add Customer</a>
                        <a class="collapse-item <?php echo ($current_page == 'customer-list.php') ? 'active' : ''; ?>" href="customer-list.php">Customers List</a>

                    </div>
                </div>
            </div>

        </div>

    </li>

    <!-- <li class="nav-item <?php echo ($current_page == 'employee-add.php' || $current_page == 'employee-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp" aria-expanded="true" aria-controls="collapseEmp">
            <i class="fas fa-fw fa-user"></i>
            <span>Employee</span>
        </a>
        <div id="collapseEmp" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="employee-add.php">Add Employee</a>
                <a class="collapse-item" href="employee-list.php">Employees List</a>
            </div>
        </div>
    </li> -->
    <!-- <li class="nav-item <?php echo ($current_page == 'cus-add.php' || $current_page == 'cus-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCus" aria-expanded="true" aria-controls="collapseCus">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Customer</span>
        </a>
        <div id="collapseCus" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="customer-add.php">Add Customer</a>
                <a class="collapse-item" href="customer-list.php">Customers List</a>
            </div>
        </div>
    </li> -->

    <!-- <li class="nav-item <?php echo ($current_page == 'cate-add.php' || $current_page == 'cate-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCat" aria-expanded="true" aria-controls="collapsePro">
            <i class="fas fa-fw fa-list"></i>
            <span>Category</span>
        </a>
        <div id="collapseCat" class="collapse" aria-labelledby="headingCat" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="cate-add.php">Add Category</a>
                <a class="collapse-item" href="cate-list.php">Category List</a>
            </div>
        </div>
    </li> -->
    <li class="nav-item <?php echo ($current_page == 'cate-add.php' || $current_page == 'cate-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayroll" aria-expanded="true" aria-controls="collapsePayroll">
            <!-- <i class="fas fa-fw fa-money" aria-hidden="true"></i> -->
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Payroll</span>
        </a>
        <div id="collapsePayroll" class="collapse" aria-labelledby="headingCat" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <a class="collapse-item" href="cate-add.php">Payroll By Month</a> -->
                <a class="collapse-item" href="payroll.php">Payroll</a>
                <a class="collapse-item" href="payroll-list.php">Review Salary</a>
            </div>
        </div>
    </li>

    <!-- <li class="nav-item <?php echo ($current_page == 'product.php' || $current_page == 'product-list.php' || $current_page == 'product-addOn-uom.php' || $current_page == 'uom.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePro" aria-expanded="false" aria-controls="collapsePro">
            <i class="fas fa-fw fa-mug-hot"></i>

            <span>Product</span>
        </a>
        <div id="collapsePro" class="collapse" aria-labelledby="headingPro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="product-list.php">Product List</a>
                <a class="collapse-item" href="product-addOn-uom.php">Product Add On UOM</a>
                <a class="collapse-item" href="product.php">Add Product</a>
                <a class="collapse-item" href="uom.php">Unit Of Measure</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item <?php echo ($current_page == 'receive-stock.php' || $current_page == 'pos-invoice.php' || $current_page == 'stock-moment.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStock_controller" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Stock Inventory</span>
        </a>
        <div id="collapseStock_controller" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="receive-stock.php">Recieve Stock</a>

                <a class="collapse-item" href="stock-moment.php">Stock Moment</a>
                <!-- <a class="collapse-item" href="user-list.php">POS</a> -->
                <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <span style="color: blue;">Product</span>
                </a>
                <div id="collapseEmployee" class="collapse <?php echo ($current_page == 'product-list.php' || $current_page == 'product-addOn-uom.php' || $current_page == 'product.php' || $current_page == 'uom.php' || $current_page == 'cate-list.php') ? 'show' : ''; ?>" aria-labelledby="headingEmployee" data-parent="#collapseSet">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'product.php') ? 'active' : ''; ?>" href="product.php">Add Product</a>
                        <a class="collapse-item <?php echo ($current_page == 'product-list.php') ? 'active' : ''; ?>" href="product-list.php">Product List</a>
                        <a class="collapse-item <?php echo ($current_page == 'uom.php') ? 'active' : ''; ?>" href="uom.php">Unit Of Measure</a>
                        <a class="collapse-item" href="cate-list.php">Category List</a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item <?php echo ($current_page == 'shift.php' || $current_page == 'shift-details.php' || $current_page == 'sale-details.php' || $current_page == 'pos-invoice.php' || $current_page == 'pos.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePOS" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-laptop" aria-hidden="true"></i>
            <span>Point Of Sale</span>
        </a>
        <div id="collapsePOS" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="shift.php">Shift</a>
                <a class="collapse-item" href="shift-details.php">Shift Details</a>
                <a class="collapse-item" href="sale-details.php">Sales Details</a>
                <a class="collapse-item" href="pos-invoice.php">POS Invoice</a>
                <a class="collapse-item" href="pos.php">POS</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo ($current_page == 'purchse.php' || $current_page == 'daily-sales.php' || $current_page == 'sales-by-item.php' || $current_page == 'payroll-expense.php' || $current_page == 'net-revenue.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSet1" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file"></i>
            <span>Report</span>
        </a>
        <div id="collapseSet1" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="purchse.php">Purchase</a>
                <a class="collapse-item" href="./Report/daily-sales.php">Daily Sales</a>
                <a class="collapse-item" href="./Report/sales-by-item.php">Sales By Item</a>
                <a class="collapse-item" href="./Report/payroll-expense.php">Payroll Expense</a>
                <a class="collapse-item" href="./Report/net-revenue.php">Net Revenue</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo ($current_page == 'user-list.php' || $current_page == 'table.php' || $current_page == 'role.php') || $current_page == 'payment-method.php' || $current_page == 'currency.php' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSet" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSet" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="currency.php">Currency</a>
                <!-- <ul id="accordionSidebar">
                        <li class="nav-item <?php echo ($current_page == 'employee-list.php' || $current_page == 'employee-list.php' || $current_page == 'employee-list.php') || $current_page == 'employee-list.php' ? 'active' : ''; ?>">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSet" aria-expanded="true" aria-controls="collapseUtilities">
                                <span>Employee</span>
                            </a>
                            <div id="collapseSet" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="employee-list.php">Bank</a>
                                    <a class="collapse-item" href="employee-list.php">Employee Type</a>
                                    <a class="collapse-item" href="employee-list.php">Nationality</a>
                                    <a class="collapse-item" href="employee-list.php">Positions</a>  
                                </div>
                            </div>
                        </li>
                    </ul>                    -->
                <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <span>Employee</span>
                </a>
                <div id="collapseEmployee" class="collapse <?php echo ($current_page == 'bank.php' || $current_page == 'employee-type.php' || $current_page == 'nationality.php' || $current_page == 'positions.php') ? 'show' : ''; ?>" aria-labelledby="headingEmployee" data-parent="#collapseSet">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'bank.php') ? 'active' : ''; ?>" href="bank.php">Bank</a>
                        <a class="collapse-item <?php echo ($current_page == 'employee-type.php') ? 'active' : ''; ?>" href="employee-type.php">Employee Type</a>
                        <a class="collapse-item <?php echo ($current_page == 'nationality.php') ? 'active' : ''; ?>" href="nationality.php">Nationality</a>
                        <a class="collapse-item <?php echo ($current_page == 'positions.php') ? 'active' : ''; ?>" href="positions.php">Positions</a>
                    </div>
                </div>
                <a class="collapse-item" href="payment-method.php">Payment Method</a>
                <a class="collapse-item" href="role.php">Role</a>
                <a class="collapse-item" href="table.php">Table</a>
                <a class="collapse-item" href="user-list.php">User List</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- Make sure to include Bootstrap's JS and jQuery at the end of your body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>