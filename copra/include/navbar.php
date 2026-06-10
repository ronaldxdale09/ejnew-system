<?php
require_once __DIR__ . '/copra-helpers.php';
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$topbarTitle = copra_resolve_topbar_title($currentPage);
$base = $copra_base ?? '';
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar copra-sidebar" id="adminSidebar" aria-label="Copra navigation">
    <div class="admin-sidebar__brand">
        <img src="<?php echo $base; ?>assets/img/logo.png" alt="EJN Copra" height="32">
        <div>
            <strong>EJN Copra</strong>
            <small>Purchasing</small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="<?php echo $base; ?>dashboard.php" class="admin-nav-link<?php echo copra_nav_active('dashboard.php', $currentPage); ?>">
                <i class="fas fa-house"></i> Home
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Purchasing</span>
            <a href="<?php echo $base; ?>transaction.php" class="admin-nav-link<?php echo copra_nav_active('transaction.php', $currentPage); ?>">
                <i class="fas fa-cash-register"></i> Transaction
            </a>
            <a href="<?php echo $base; ?>transaction_history.php" class="admin-nav-link<?php echo copra_nav_active('transaction_history.php', $currentPage); ?>">
                <i class="fas fa-book"></i> Transaction Record
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Master Data</span>
            <a href="<?php echo $base; ?>seller.php" class="admin-nav-link<?php echo copra_nav_active(['seller.php', 'seller_profile.php'], $currentPage); ?>">
                <i class="fas fa-user"></i> Sellers
            </a>
            <a href="<?php echo $base; ?>contract-purchase.php" class="admin-nav-link<?php echo copra_nav_active('contract-purchase.php', $currentPage); ?>">
                <i class="fas fa-boxes-stacked"></i> Purchase Contract
            </a>
            <a href="<?php echo $base; ?>copra-ca.php" class="admin-nav-link<?php echo copra_nav_active('copra-ca.php', $currentPage); ?>">
                <i class="fas fa-money-bill-wave"></i> Cash Advance
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
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="<?php echo $base; ?>js/copra-nav.js?v=<?php echo file_exists(__DIR__ . '/../js/copra-nav.js') ? filemtime(__DIR__ . '/../js/copra-nav.js') : '1'; ?>"></script>
