<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$isZamboanga = ledger_is_zamboanga($loc);

$expensePages = ['ledger-expense.php', 'expense_report.php'];
$purchasePages = ['ledger-purchase.php', 'purchase_report.php'];
$topperPages = ['ledger-maloong.php', 'ledger-buahan.php'];
$coffeePages = ['coffee_sale_record.php', 'coffee_list.php', 'coffee_sale_report.php', 'coffee_customer.php', 'coffee_sale.php'];

function ledger_submenu_open(array $pages, string $current): string
{
    return in_array($current, $pages, true) ? ' open' : '';
}
?>
<div class="admin-sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Ledger navigation">
    <div class="admin-sidebar__brand">
        <img src="assets/img/logo.svg" alt="EJN Rubber" width="36" height="36">
        <div>
            <strong>EJN Ledger</strong>
            <small><?php echo adm_esc($locDisplay ?: 'General'); ?></small>
        </div>
    </div>

    <nav class="admin-sidebar__nav">
        <div class="admin-nav-group">
            <a href="dashboard.php" class="admin-nav-link<?php echo ledger_nav_active('dashboard.php', $currentPage); ?>">
                <i class="fas fa-gauge-high"></i> Dashboard
            </a>
        </div>

        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Finance</span>

            <div class="admin-nav-group<?php echo ledger_submenu_open($expensePages, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo in_array($currentPage, $expensePages, true) ? 'true' : 'false'; ?>">
                    <i class="fas fa-receipt"></i> Expenses
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="ledger-expense.php" class="admin-nav-link<?php echo ledger_nav_active('ledger-expense.php', $currentPage); ?>">Expense Record</a>
                    <a href="expense_report.php" class="admin-nav-link<?php echo ledger_nav_active('expense_report.php', $currentPage); ?>">Expense Report</a>
                </div>
            </div>

            <?php if (!$isZamboanga): ?>
            <div class="admin-nav-group<?php echo ledger_submenu_open($purchasePages, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo in_array($currentPage, $purchasePages, true) ? 'true' : 'false'; ?>">
                    <i class="fas fa-cart-shopping"></i> Purchases
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="ledger-purchase.php" class="admin-nav-link<?php echo ledger_nav_active('ledger-purchase.php', $currentPage); ?>">Purchase Record</a>
                    <a href="purchase_report.php" class="admin-nav-link<?php echo ledger_nav_active('purchase_report.php', $currentPage); ?>">Purchase Report</a>
                </div>
            </div>

            <div class="admin-nav-group<?php echo ledger_submenu_open($topperPages, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo in_array($currentPage, $topperPages, true) ? 'true' : 'false'; ?>">
                    <i class="fas fa-boxes-stacked"></i> Toppers
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="ledger-maloong.php" class="admin-nav-link<?php echo ledger_nav_active('ledger-maloong.php', $currentPage); ?>">Maloong Toppers</a>
                    <a href="ledger-buahan.php" class="admin-nav-link<?php echo ledger_nav_active('ledger-buahan.php', $currentPage); ?>">Buahan Toppers</a>
                </div>
            </div>

            <a href="ledger-ca.php" class="admin-nav-link<?php echo ledger_nav_active('ledger-ca.php', $currentPage); ?>">
                <i class="fas fa-hand-holding-dollar"></i> Cash Advance
            </a>
            <?php endif; ?>
        </div>

        <?php if (!$isZamboanga): ?>
        <div class="admin-nav-group">
            <span class="admin-nav-group__label">Coffee</span>
            <div class="admin-nav-group<?php echo ledger_submenu_open($coffeePages, $currentPage); ?>">
                <button type="button" class="admin-nav-link admin-nav-toggle" aria-expanded="<?php echo in_array($currentPage, $coffeePages, true) ? 'true' : 'false'; ?>">
                    <i class="fas fa-mug-hot"></i> Coffee
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <div class="admin-nav-submenu">
                    <a href="coffee_sale_record.php" class="admin-nav-link<?php echo ledger_nav_active('coffee_sale_record.php', $currentPage); ?>">Coffee Sales</a>
                    <a href="coffee_list.php" class="admin-nav-link<?php echo ledger_nav_active('coffee_list.php', $currentPage); ?>">Product List</a>
                    <a href="coffee_sale_report.php" class="admin-nav-link<?php echo ledger_nav_active('coffee_sale_report.php', $currentPage); ?>">Sale Report</a>
                    <a href="coffee_customer.php" class="admin-nav-link<?php echo ledger_nav_active('coffee_customer.php', $currentPage); ?>">Customers</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
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
    <div class="admin-topbar__title">General Ledger</div>
    <div class="admin-topbar__spacer"></div>
    <div class="admin-topbar__meta">
        <?php if ($locDisplay): ?>
            <span class="ledger-topbar__loc"><i class="fas fa-location-dot"></i> <?php echo adm_esc($locDisplay); ?></span>
        <?php endif; ?>
        <span><?php echo date('M j, Y'); ?></span>
        <div class="admin-topbar__user">
            <i class="fas fa-user-circle"></i>
            <?php echo $userDisplay; ?>
        </div>
    </div>
</header>

<script src="js/ledger-nav.js?v=<?php echo file_exists(__DIR__ . '/../js/ledger-nav.js') ? filemtime(__DIR__ . '/../js/ledger-nav.js') : '1'; ?>"></script>
