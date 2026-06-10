<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$topbarTitle = plantation_resolve_topbar_title($currentPage);
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Plantation navigation">
    <div class="admin-sidebar__brand">
        <img src="assets/img/logo.png" alt="EJN Rubber" height="32">
        <div>
            <strong>EJN Rubber</strong>
            <small><?php echo adm_esc($locDisplay ?: 'Plantation'); ?></small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="dashboard.php" class="admin-nav-link<?php echo plantation_nav_active('dashboard.php', $currentPage); ?>">
                <i class="fas fa-house"></i> Home
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Processing</span>
            <a href="recording.php" class="admin-nav-link<?php echo plantation_nav_active('recording.php', $currentPage); ?>">
                <i class="fas fa-gears"></i> Rubber Processing
            </a>
            <a href="record_allrubber.php" class="admin-nav-link<?php echo plantation_nav_active('record_allrubber.php', $currentPage); ?>">
                <i class="fas fa-book"></i> Transaction Record
            </a>
            <a href="inventory_bale.php" class="admin-nav-link<?php echo plantation_nav_active('inventory_bale.php', $currentPage); ?>">
                <i class="fas fa-cube"></i> Bales Record
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Export</span>
            <a href="container_record.php" class="admin-nav-link<?php echo plantation_nav_active(['container_record.php', 'container.php'], $currentPage); ?>">
                <i class="fas fa-truck"></i> Container
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
            <span class="plantation-topbar__loc"><i class="fas fa-location-dot"></i> <?php echo adm_esc($locDisplay); ?></span>
        <?php endif; ?>
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="js/plantation-nav.js?v=<?php echo file_exists(__DIR__ . '/../js/plantation-nav.js') ? filemtime(__DIR__ . '/../js/plantation-nav.js') : '1'; ?>"></script>
