<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$topbarTitle = sales_resolve_topbar_title($currentPage);
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Sales navigation">
    <div class="admin-sidebar__brand">
        <img src="assets/img/logo.png" alt="EJN Rubber" width="36" height="36">
        <div>
            <strong>EJN Rubber</strong>
            <small>Sales</small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="dashboard.php" class="admin-nav-link<?php echo sales_nav_active('dashboard.php', $currentPage); ?>">
                <i class="fas fa-house"></i> Home
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Bale Sales</span>
            <a href="bale_sale_record.php" class="admin-nav-link<?php echo sales_nav_active(['bale_sale_record.php', 'bale_sales.php'], $currentPage); ?>">
                <i class="fas fa-balance-scale"></i> Rubber Bale Sale
            </a>
            <a href="bale_container_record.php" class="admin-nav-link<?php echo sales_nav_active(['bale_container_record.php'], $currentPage); ?>">
                <i class="fas fa-box-open"></i> Bale Container
            </a>
            <a href="bale_shipment_record.php" class="admin-nav-link<?php echo sales_nav_active(['bale_shipment_record.php', 'bale_shipment.php'], $currentPage); ?>">
                <i class="fas fa-ship"></i> Bale Shipment
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Cuplump Sales</span>
            <a href="cuplump_sale_record.php" class="admin-nav-link<?php echo sales_nav_active(['cuplump_sale_record.php', 'cuplump_sale.php'], $currentPage); ?>">
                <i class="fas fa-cash-register"></i> Cuplump Sale
            </a>
            <a href="cuplump_container_record.php" class="admin-nav-link<?php echo sales_nav_active(['cuplump_container_record.php', 'cuplump_container.php'], $currentPage); ?>">
                <i class="fas fa-dumpster"></i> Cuplump Container
            </a>
            <a href="cuplump_shipment_record.php" class="admin-nav-link<?php echo sales_nav_active(['cuplump_shipment_record.php', 'cuplump_shipment.php'], $currentPage); ?>">
                <i class="fas fa-ship"></i> Cuplump Shipment
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Inventory & Reports</span>
            <a href="inventory_bale.php" class="admin-nav-link<?php echo sales_nav_active('inventory_bale.php', $currentPage); ?>">
                <i class="fas fa-cube"></i> Bale Inventory
            </a>
            <a href="report_bales.php" class="admin-nav-link<?php echo sales_nav_active('report_bales.php', $currentPage); ?>">
                <i class="fas fa-chart-column"></i> Bale Report
            </a>
            <a href="report_cuplump.php" class="admin-nav-link<?php echo sales_nav_active('report_cuplump.php', $currentPage); ?>">
                <i class="fas fa-chart-line"></i> Cuplump Report
            </a>
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
    <div class="admin-topbar__title"><?php echo adm_esc($topbarTitle); ?></div>
    <div class="admin-topbar__spacer"></div>
    <div class="admin-topbar__meta">
        <?php if ($locDisplay): ?>
            <span class="sales-topbar__loc"><i class="fas fa-location-dot"></i> <?php echo adm_esc($locDisplay); ?></span>
        <?php endif; ?>
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="js/sales-nav.js?v=<?php echo file_exists(__DIR__ . '/../js/sales-nav.js') ? filemtime(__DIR__ . '/../js/sales-nav.js') : '1'; ?>"></script>
