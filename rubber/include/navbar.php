<?php
require_once __DIR__ . '/rubber-helpers.php';
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$topbarTitle = rubber_resolve_topbar_title($currentPage);
$navLoc = str_replace(' ', '', $_SESSION['loc'] ?? '');
$base = $rubber_base ?? '';
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Rubber navigation">
    <div class="admin-sidebar__brand">
        <img src="<?php echo $base; ?>assets/img/logo.png" alt="EJN Rubber" width="36" height="36">
        <div>
            <strong>EJN Rubber</strong>
            <small>Purchasing</small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="<?php echo $base; ?>dry_receiving_record.php" class="admin-nav-link<?php echo rubber_nav_active('dry_receiving_record.php', $currentPage); ?>">
                <i class="fas fa-truck"></i> DRY Receiving
            </a>
            <?php if (strcasecmp(trim($navLoc), 'Kidapawan') !== 0): ?>
            <a href="<?php echo $base; ?>ejn_rubber_record.php" class="admin-nav-link<?php echo rubber_nav_active('ejn_rubber_record.php', $currentPage); ?>">
                <i class="fas fa-truck-ramp-box"></i> EJN Rubber
            </a>
            <?php endif; ?>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Purchasing</span>
            <a href="<?php echo $base; ?>cuplumps_purchase_record.php" class="admin-nav-link<?php echo rubber_nav_active(['cuplumps_purchase_record.php', 'wet_rubber.php'], $currentPage); ?>">
                <i class="fas fa-cash-register"></i> Cuplump Purchasing
            </a>
            <a href="<?php echo $base; ?>bales_purchase_record.php" class="admin-nav-link<?php echo rubber_nav_active(['bales_purchase_record.php', 'bales_rubber.php'], $currentPage); ?>">
                <i class="fas fa-cash-register"></i> Bales Purchasing
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Inventory &amp; Records</span>
            <?php if (strcasecmp(trim($navLoc), 'Kidapawan') !== 0): ?>
            <a href="<?php echo $base; ?>inv_bale.php" class="admin-nav-link<?php echo rubber_nav_active(['inv_bale.php', 'inventory_bale.php'], $currentPage); ?>">
                <i class="fas fa-cube"></i> Bale Inventory
            </a>
            <a href="<?php echo $base; ?>bale_record.php" class="admin-nav-link<?php echo rubber_nav_active('bale_record.php', $currentPage); ?>">
                <i class="fas fa-book"></i> Bale Record
            </a>
            <a href="<?php echo $base; ?>inv_cuplump.php" class="admin-nav-link<?php echo rubber_nav_active(['inv_cuplump.php', 'inventory_cuplump.php'], $currentPage); ?>">
                <i class="fas fa-tree"></i> Cuplump Inventory
            </a>
            <?php endif; ?>
            <a href="<?php echo $base; ?>contract-purchase.php" class="admin-nav-link<?php echo rubber_nav_active('contract-purchase.php', $currentPage); ?>">
                <i class="fas fa-boxes-stacked"></i> Purchase Contract
            </a>
            <a href="<?php echo $base; ?>cash-advance.php" class="admin-nav-link<?php echo rubber_nav_active('cash-advance.php', $currentPage); ?>">
                <i class="fas fa-money-bill-wave"></i> Cash Advance
            </a>
            <a href="<?php echo $base; ?>seller.php" class="admin-nav-link<?php echo rubber_nav_active('seller.php', $currentPage); ?>">
                <i class="fas fa-user"></i> Sellers
            </a>
        </div>
    </nav>

    <div class="admin-sidebar__footer">
        <a href="<?php echo $base; ?>function/logout.php" class="admin-sidebar__logout">
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
            <span class="rubber-topbar__loc"><i class="fas fa-location-dot"></i> <?php echo adm_esc($locDisplay); ?></span>
        <?php endif; ?>
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="<?php echo rubber_asset('js/rubber-nav.js', $base); ?>"></script>
