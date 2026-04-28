<?php
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="admin-sidebar">
    <a href="index.php" class="navbar-brand d-flex align-items-center ml-lg-3">
        <img src="img/logo1.png" alt="Logo" style="height:50px; margin-right:10px;">
    </a>
    <nav class="nav flex-column">
        <a class="nav-link <?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>" href="admin_dashboard.php">
            <i class="fa fa-th-large"></i> Dashboard
        </a>
        <a class="nav-link <?php echo ($current_page == 'admin_quotes.php') ? 'active' : ''; ?>" href="admin_quotes.php">
            <i class="fa fa-file-alt"></i> Quotes
        </a>
        <a class="nav-link <?php echo ($current_page == 'admin_customers.php') ? 'active' : ''; ?>" href="admin_customers.php">
            <i class="fa fa-users"></i> Customers
        </a>
        <a class="nav-link <?php echo ($current_page == 'admin_shipments.php') ? 'active' : ''; ?>" href="admin_shipments.php">
            <i class="fa fa-truck"></i> Shipments
        </a>
        <a class="nav-link <?php echo ($current_page == 'admin_deliveries.php') ? 'active' : ''; ?>" href="admin_deliveries.php">
            <i class="fa fa-plane"></i> Deliveries
        </a>
        <a class="nav-link <?php echo ($current_page == 'admin_reports.php') ? 'active' : ''; ?>" href="admin_reports.php">
            <i class="fa fa-chart-line"></i> Reports
        </a>
        <a class="nav-link <?php echo ($current_page == 'manage_products.php') ? 'active' : ''; ?>" href="manage_products.php">
            <i class="fa fa-tags"></i> Products
        </a>
        <hr style="border-color: #534015; margin: 20px;">
        <a class="nav-link" href="index.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>