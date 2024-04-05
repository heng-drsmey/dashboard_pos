<?php
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
    <li class="nav-item <?php echo ($current_page == 'com-add.php' || $current_page == 'com-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCom" aria-expanded="true" aria-controls="collapseCom">
            <i class="fas fa-fw fa-building"></i>
            <span>Company</span>
        </a>
        <div id="collapseCom" class="collapse" aria-labelledby="headingCom" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="com-add.php">Add Company</a>
                <a class="collapse-item" href="com-list.php">Company List</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo ($current_page == 'emp-add.php' || $current_page == 'emp-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp" aria-expanded="true" aria-controls="collapseEmp">
            <i class="fas fa-fw fa-user"></i>
            <span>Employees</span>
        </a>
        <div id="collapseEmp" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="emp-add.php">Add Employee</a>
                <a class="collapse-item" href="emp-list.php">Employees List</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo ($current_page == 'cate-add.php' || $current_page == 'cate-list.php') ? 'active' : ''; ?>">
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
    </li>

    <li class="nav-item <?php echo ($current_page == 'product-add.php' || $current_page == 'product-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePro" aria-expanded="true" aria-controls="collapsePro">
            <i class="fas fa-fw fa-mug-hot"></i>
            <span>Product</span>
        </a>
        <div id="collapsePro" class="collapse" aria-labelledby="headingPro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="product-add.php">Add Product</a>
                <a class="collapse-item" href="product-list.php">Product List</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo ($current_page == 'inventory.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="inventory.php">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Inventory</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo ($current_page == 'user-list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSet" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSet" class="collapse" aria-labelledby="headingSet" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
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