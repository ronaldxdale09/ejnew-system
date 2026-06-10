<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$userDisplay = htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['user'] ?? 'Admin', ENT_QUOTES, 'UTF-8');

function adm_nav_active($pages, $currentPage) {
    $pages = (array) $pages;
    return in_array($currentPage, $pages, true) ? ' active' : '';
}

function adm_nav_open($pages, $currentPage) {
    $pages = (array) $pages;
    return in_array($currentPage, $pages, true) ? ' open' : '';
}

$opsPlant = ['plant_basilan_recording.php', 'plant_kid_recording.php'];
$opsBales = ['inv_bale.php', 'bale_record.php', 'bale_sale_record.php', 'container_record.php', 'bale_shipment_record.php'];
$opsCuplump = ['inv_cuplump.php', 'cuplump_sale_record.php', 'cuplump_container_record.php', 'cuplump_shipment_record.php'];
$opsCoffee = ['coffee_list.php', 'coffee_production.php', 'coffee_sale_record.php'];
$opsFinanceExp = ['basilan.expense.php', 'basilan.expense.report.php', 'zam.expense.php', 'zam.expense.report.php', 'kidapawan.expense.php', 'kidapawan.expense.report.php'];
$opsFinancePurch = ['purchase_report.php', 'dry_receiving_record.php', 'cuplumps_purchase_record.php'];
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Admin navigation">
    <div class="admin-sidebar__brand">
        <img src="assets/img/logo.png" alt="EJN Rubber" height="32">
        <div>
            <strong>EJN Rubber</strong>
            <small>Admin Console</small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="dashboard.php" class="admin-nav-link<?php echo adm_nav_active('dashboard.php', $currentPage); ?>">
                <i class="fas fa-gauge-high"></i> Dashboard
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Finance</span>
            <div class="admin-nav-group<?php echo adm_nav_open($opsFinanceExp, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsFinanceExp, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-receipt"></i> Expenses
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="basilan.expense.php" class="admin-nav-link<?php echo adm_nav_active(['basilan.expense.php', 'basilan.expense.report.php'], $currentPage); ?>">Basilan</a>
                    <a href="zam.expense.php" class="admin-nav-link<?php echo adm_nav_active(['zam.expense.php', 'zam.expense.report.php'], $currentPage); ?>">Zamboanga</a>
                    <a href="kidapawan.expense.php" class="admin-nav-link<?php echo adm_nav_active('kidapawan.expense.php', $currentPage); ?>">Kidapawan</a>
                </div>
            </div>
            <div class="admin-nav-group<?php echo adm_nav_open($opsFinancePurch, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsFinancePurch, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-cart-shopping"></i> Purchases
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="purchase_report.php" class="admin-nav-link<?php echo adm_nav_active('purchase_report.php', $currentPage); ?>">Purchase Report</a>
                    <a href="dry_receiving_record.php" class="admin-nav-link<?php echo adm_nav_active('dry_receiving_record.php', $currentPage); ?>">Dry Receiving</a>
                    <a href="cuplumps_purchase_record.php" class="admin-nav-link<?php echo adm_nav_active('cuplumps_purchase_record.php', $currentPage); ?>">Cuplump Purchasing</a>
                </div>
            </div>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Reports</span>
            <a href="overall_report.php" class="admin-nav-link<?php echo adm_nav_active('overall_report.php', $currentPage); ?>">
                <i class="fas fa-chart-pie"></i> Overall Report
            </a>
            <a href="sales_reports.php" class="admin-nav-link<?php echo adm_nav_active('sales_reports.php', $currentPage); ?>">
                <i class="fas fa-file-lines"></i> Sales Reports
            </a>
            <a href="copra_record.php" class="admin-nav-link<?php echo adm_nav_active('copra_record.php', $currentPage); ?>">
                <i class="fas fa-seedling"></i> Copra Record
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Operations</span>
            <div class="admin-nav-group<?php echo adm_nav_open($opsPlant, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsPlant, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-industry"></i> Rubber Plant
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="plant_basilan_recording.php" class="admin-nav-link<?php echo adm_nav_active('plant_basilan_recording.php', $currentPage); ?>">Basilan Plant</a>
                    <a href="plant_kid_recording.php" class="admin-nav-link<?php echo adm_nav_active('plant_kid_recording.php', $currentPage); ?>">Kidapawan Plant</a>
                </div>
            </div>
            <div class="admin-nav-group<?php echo adm_nav_open($opsBales, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsBales, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-box"></i> Bales
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="inv_bale.php" class="admin-nav-link<?php echo adm_nav_active('inv_bale.php', $currentPage); ?>">Inventory</a>
                    <a href="bale_record.php" class="admin-nav-link<?php echo adm_nav_active('bale_record.php', $currentPage); ?>">Records</a>
                    <a href="bale_sale_record.php" class="admin-nav-link<?php echo adm_nav_active('bale_sale_record.php', $currentPage); ?>">Sales</a>
                    <a href="container_record.php" class="admin-nav-link<?php echo adm_nav_active('container_record.php', $currentPage); ?>">Container</a>
                    <a href="bale_shipment_record.php" class="admin-nav-link<?php echo adm_nav_active('bale_shipment_record.php', $currentPage); ?>">Shipment</a>
                </div>
            </div>
            <div class="admin-nav-group<?php echo adm_nav_open($opsCuplump, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsCuplump, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-tree"></i> Cuplump
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="inv_cuplump.php" class="admin-nav-link<?php echo adm_nav_active('inv_cuplump.php', $currentPage); ?>">Field Inventory</a>
                    <a href="cuplump_sale_record.php" class="admin-nav-link<?php echo adm_nav_active('cuplump_sale_record.php', $currentPage); ?>">Sales</a>
                    <a href="cuplump_container_record.php" class="admin-nav-link<?php echo adm_nav_active('cuplump_container_record.php', $currentPage); ?>">Container</a>
                    <a href="cuplump_shipment_record.php" class="admin-nav-link<?php echo adm_nav_active('cuplump_shipment_record.php', $currentPage); ?>">Shipment</a>
                </div>
            </div>
            <div class="admin-nav-group<?php echo adm_nav_open($opsCoffee, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo adm_nav_open($opsCoffee, $currentPage) ? 'true' : 'false'; ?>">
                    <i class="fas fa-mug-hot"></i> Coffee
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="coffee_list.php" class="admin-nav-link<?php echo adm_nav_active('coffee_list.php', $currentPage); ?>">Inventory</a>
                    <a href="coffee_production.php" class="admin-nav-link<?php echo adm_nav_active('coffee_production.php', $currentPage); ?>">Production</a>
                    <a href="coffee_sale_record.php" class="admin-nav-link<?php echo adm_nav_active('coffee_sale_record.php', $currentPage); ?>">Sales</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="admin-sidebar__footer">
        <a href="function/logout.php" class="admin-sidebar__logout">
            <i class="fas fa-right-from-bracket"></i> Sign Out
        </a>
    </div>
</aside>

<header class="admin-topbar">
    <button type="button" class="admin-topbar__menu" id="sidebarToggle" aria-label="Open menu">
        <i class="fas fa-bars"></i>
    </button>
    <div class="admin-topbar__title">EN-System Admin</div>
    <div class="admin-topbar__spacer"></div>
    <div class="admin-topbar__meta">
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="js/admin-nav.js?v=<?php echo file_exists('js/admin-nav.js') ? filemtime('js/admin-nav.js') : '1'; ?>"></script>
