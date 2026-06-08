<?php
include 'include/header.php';
include 'include/navbar.php';

$CurrentYear = date('Y');
$currentMonthName = date('F');
include 'dashboard/dashboard_computation.php';
?>

<div class="main-content admin-page">
    <header class="adm-page-header">
        <h1>Executive Dashboard</h1>
        <p><?php echo $currentMonthName . ' ' . $CurrentYear; ?> — sales, inventory, expenses, and operations at a glance.</p>
    </header>

    <div class="adm-kpi-grid">
        <div class="adm-kpi adm-kpi--green">
            <span class="adm-kpi__icon adm-kpi__icon--green"><i class="fas fa-chart-line"></i></span>
            <div class="adm-kpi__label">Total Revenue</div>
            <div class="adm-kpi__value"><?php echo adm_peso($combined_sales_year); ?></div>
            <div class="adm-kpi__sub">This month: <?php echo adm_peso($combined_sales_month); ?></div>
        </div>
        <div class="adm-kpi adm-kpi--green">
            <span class="adm-kpi__icon adm-kpi__icon--green"><i class="fas fa-sack-dollar"></i></span>
            <div class="adm-kpi__label">Gross Profit</div>
            <div class="adm-kpi__value"><?php echo adm_peso($combined_profit_year); ?></div>
            <div class="adm-kpi__sub">This month: <?php echo adm_peso($combined_profit_month); ?></div>
        </div>
        <div class="adm-kpi adm-kpi--red">
            <span class="adm-kpi__icon adm-kpi__icon--red"><i class="fas fa-wallet"></i></span>
            <div class="adm-kpi__label">Operating Expenses</div>
            <div class="adm-kpi__value"><?php echo adm_peso($total_expenses_year['total'] ?? 0); ?></div>
            <div class="adm-kpi__sub">This month: <?php echo adm_peso($month_expenses['total'] ?? 0); ?></div>
        </div>
        <div class="adm-kpi adm-kpi--blue">
            <span class="adm-kpi__icon adm-kpi__icon--blue"><i class="fas fa-ship"></i></span>
            <div class="adm-kpi__label">Shipping Costs</div>
            <div class="adm-kpi__value"><?php echo adm_peso($combined_shipping_year); ?></div>
            <div class="adm-kpi__sub">Bales + Cuplump (YTD)</div>
        </div>
        <div class="adm-kpi adm-kpi--gold">
            <span class="adm-kpi__icon adm-kpi__icon--gold"><i class="fas fa-file-invoice-dollar"></i></span>
            <div class="adm-kpi__label">Unpaid Balance</div>
            <div class="adm-kpi__value"><?php echo adm_peso($combined_unpaid); ?></div>
            <div class="adm-kpi__sub"><?php echo number_format($combined_active_sales); ?> open sales</div>
        </div>
        <div class="adm-kpi">
            <span class="adm-kpi__icon adm-kpi__icon--blue"><i class="fas fa-mug-hot"></i></span>
            <div class="adm-kpi__label">Coffee Sales</div>
            <div class="adm-kpi__value"><?php echo adm_peso($coffee_sales_year['total'] ?? 0); ?></div>
            <div class="adm-kpi__sub">Year to date</div>
        </div>
    </div>

    <section class="adm-section">
        <div class="adm-section__head"><h2 class="adm-section__title">Quick Access</h2></div>
        <div class="adm-quick-grid">
            <a href="overall_report.php" class="adm-quick-link"><i class="fas fa-chart-pie"></i> Overall Report</a>
            <a href="sales_reports.php" class="adm-quick-link"><i class="fas fa-file-invoice"></i> Sales Reports</a>
            <a href="purchase_report.php" class="adm-quick-link"><i class="fas fa-cart-shopping"></i> Purchases</a>
            <a href="basilan.expense.report.php" class="adm-quick-link"><i class="fas fa-receipt"></i> Expenses</a>
            <a href="inv_bale.php" class="adm-quick-link"><i class="fas fa-box"></i> Bale Inventory</a>
            <a href="inv_cuplump.php" class="adm-quick-link"><i class="fas fa-tree"></i> Cuplump Stock</a>
            <a href="copra_record.php" class="adm-quick-link"><i class="fas fa-seedling"></i> Copra</a>
            <a href="admin_users.php" class="adm-quick-link"><i class="fas fa-users"></i> Users</a>
        </div>
    </section>

    <section class="adm-section">
        <div class="adm-section__head">
            <h2 class="adm-section__title">Sales Performance</h2>
            <span class="adm-section__badge"><?php echo $CurrentYear; ?></span>
        </div>
        <div class="adm-grid-2">
            <div class="adm-card">
                <div class="adm-card__head"><h3>Monthly Sales Trend</h3></div>
                <div class="adm-card__body adm-card__body--chart"><?php
                    $canvasId = 'trend_sales';
                    $chartYear = (int) $CurrentYear;
                    include 'statistical_card/saleProceedTrend.php';
                ?></div>
            </div>
            <div class="adm-card">
                <div class="adm-card__head"><h3>Gross Profit Trend</h3></div>
                <div class="adm-card__body adm-card__body--chart"><?php
                    $canvasId = 'trend_grossprofit';
                    $chartYear = (int) $CurrentYear;
                    include 'statistical_card/grossProfitTrend.php';
                ?></div>
            </div>
        </div>
    </section>

    <section class="adm-section">
        <div class="adm-section__head"><h2 class="adm-section__title">Rubber Sales Breakdown</h2></div>
        <div class="adm-grid-2">
            <div class="adm-card">
                <div class="adm-card__head"><h3><i class="fas fa-box"></i> Bales (<?php echo $CurrentYear; ?>)</h3></div>
                <div class="adm-card__body adm-mini-kpis">
                    <div><span>Sales</span><strong><?php echo adm_peso($bale_sales['total_sales'] ?? 0); ?></strong></div>
                    <div><span>Gross Profit</span><strong class="text-success"><?php echo adm_peso($gross_profit_year['total_gross_profit'] ?? 0); ?></strong></div>
                    <div><span>Shipping</span><strong><?php echo adm_peso($total_shipping['total_ship_expense'] ?? 0); ?></strong></div>
                    <div><span>Unpaid</span><strong class="text-warning"><?php echo adm_peso($bale_unpaid['unpaid_balance'] ?? 0); ?></strong></div>
                </div>
            </div>
            <div class="adm-card">
                <div class="adm-card__head"><h3><i class="fas fa-tree"></i> Cuplump (<?php echo $CurrentYear; ?>)</h3></div>
                <div class="adm-card__body adm-mini-kpis">
                    <div><span>Sales</span><strong><?php echo adm_peso($cuplump_sales['total_sales'] ?? 0); ?></strong></div>
                    <div><span>Gross Profit</span><strong class="text-success"><?php echo adm_peso($gross_profit_cuplump_year['total_gross_profit_cuplump'] ?? 0); ?></strong></div>
                    <div><span>Shipping</span><strong><?php echo adm_peso($total_shipping_cuplump['total_ship_expense_cuplump'] ?? 0); ?></strong></div>
                    <div><span>Unpaid</span><strong class="text-warning"><?php echo adm_peso($cuplump_unpaid['unpaid_balance'] ?? 0); ?></strong></div>
                </div>
            </div>
        </div>
    </section>

    <section class="adm-section">
        <div class="adm-section__head">
            <h2 class="adm-section__title">Plant Inventory</h2>
            <a href="inv_bale.php" class="adm-section__badge" style="text-decoration:none;">View details</a>
        </div>
        <div class="adm-grid-4">
            <div class="adm-inv-card">
                <div class="adm-inv-card__head"><h4>Cuplump</h4><i class="fas fa-cubes" style="color:var(--adm-green-700)"></i></div>
                <div class="adm-inv-row"><span>Basilan</span><span><?php echo number_format($basilan_cuplumps['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Kidapawan</span><span><?php echo number_format($kidapawan_cuplumps['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Total</span><span><?php echo number_format($total_cuplumps_weight ?? 0); ?> kg</span></div>
            </div>
            <div class="adm-inv-card">
                <div class="adm-inv-card__head"><h4>Crumb</h4><i class="fas fa-mortar-pestle" style="color:var(--adm-gold)"></i></div>
                <div class="adm-inv-row"><span>Basilan</span><span><?php echo number_format($basilan_milling['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Kidapawan</span><span><?php echo number_format($kidapawan_milling['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Total</span><span><?php echo number_format($total_milling_weight ?? 0); ?> kg</span></div>
            </div>
            <div class="adm-inv-card">
                <div class="adm-inv-card__head"><h4>Blanket</h4><i class="fas fa-scroll" style="color:var(--adm-info)"></i></div>
                <div class="adm-inv-row"><span>Basilan</span><span><?php echo number_format($basilan_drying['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Kidapawan</span><span><?php echo number_format($kidapawan_drying['inventory'] ?? 0); ?> kg</span></div>
                <div class="adm-inv-row"><span>Total</span><span><?php echo number_format($total_drying_weight ?? 0); ?> kg</span></div>
            </div>
            <div class="adm-inv-card">
                <div class="adm-inv-card__head"><h4>Bales</h4><i class="fas fa-box-open" style="color:var(--adm-green-700)"></i></div>
                <div class="adm-inv-row"><span>Basilan</span><span><?php echo number_format($basilan_balesCount['inventory'] ?? 0); ?> pcs</span></div>
                <div class="adm-inv-row"><span>Kidapawan</span><span><?php echo number_format($kidapawan_balesCount['inventory'] ?? 0); ?> pcs</span></div>
                <div class="adm-inv-row"><span>Total</span><span><?php echo number_format($total_bales_count ?? 0); ?> pcs</span></div>
            </div>
        </div>
    </section>

    <section class="adm-section">
        <div class="adm-section__head"><h2 class="adm-section__title">Detailed Reports</h2></div>
        <div class="adm-tabs" role="tablist">
            <button type="button" class="adm-tab active" data-adm-tab="sales"><i class="fas fa-chart-line"></i> Sales</button>
            <button type="button" class="adm-tab" data-adm-tab="inventory"><i class="fas fa-boxes-stacked"></i> Inventory</button>
            <button type="button" class="adm-tab" data-adm-tab="expense"><i class="fas fa-money-bill-wave"></i> Expenses</button>
            <button type="button" class="adm-tab" data-adm-tab="copra"><i class="fas fa-leaf"></i> Copra</button>
        </div>
        <div class="adm-card">
            <div class="adm-card__body">
                <div class="adm-tab-panel active" data-adm-panel="sales"><?php include 'tab/report.sales.php'; ?></div>
                <div class="adm-tab-panel" data-adm-panel="inventory"><?php include 'tab/report.inventory.php'; ?></div>
                <div class="adm-tab-panel" data-adm-panel="expense"><?php include 'tab/report.expense.php'; ?></div>
                <div class="adm-tab-panel" data-adm-panel="copra"><?php include 'tab/report.copra.php'; ?></div>
            </div>
        </div>
    </section>
</div>

<script src="js/admin-dashboard.js?v=<?php echo file_exists(__DIR__ . '/js/admin-dashboard.js') ? filemtime(__DIR__ . '/js/admin-dashboard.js') : '1'; ?>"></script>

</body>
</html>
