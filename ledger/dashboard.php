<?php
include 'include/header.php';
require_once __DIR__ . '/dashboard/data.php';

include 'include/navbar.php';

$source = $_SESSION['loc'];
$dash = ledger_dashboard_data($con, $source);
$k = $dash['kpis'];
$c = $dash['charts'];
$isZamboanga = ledger_is_zamboanga($source);
?>

<div class="main-content admin-page ledger-page">
    <?php adm_page_header(
        'Dashboard',
        'Financial overview — expenses, purchases, toppers, cash advance, and coffee sales.',
        [trim($source)]
    ); ?>

    <div class="ledger-dash-kpi-grid">
        <div class="adm-kpi">
            <div class="adm-kpi__label">Expenses Today</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['expense_today'], 0); ?></div>
            <div class="adm-kpi__sub"><?php echo adm_esc($dash['month_label']); ?> · <?php echo adm_peso($k['expense_month'], 0); ?></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Purchases Today</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['purchase_today'], 0); ?></div>
            <div class="adm-kpi__sub"><?php echo adm_esc($dash['month_label']); ?> · <?php echo adm_peso($k['purchase_month'], 0); ?></div>
        </div>
        <?php if (!$isZamboanga): ?>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Cash Advance Today</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['ca_today'], 0); ?></div>
            <div class="adm-kpi__sub"><?php echo (int) $k['ca_count']; ?> this month</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Maloong (<?php echo adm_esc($dash['month_label']); ?>)</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['maloong_month'], 0); ?></div>
            <div class="adm-kpi__sub">YTD <?php echo adm_peso($k['maloong_year'], 0); ?></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Buahan (<?php echo adm_esc($dash['month_label']); ?>)</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['buahan_month'], 0); ?></div>
            <div class="adm-kpi__sub">YTD <?php echo adm_peso($k['buahan_year'], 0); ?></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Coffee Sales</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['coffee_month'], 0); ?></div>
            <div class="adm-kpi__sub">YTD <?php echo adm_peso($k['coffee_year'], 0); ?></div>
        </div>
        <?php endif; ?>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo (int) $dash['year']; ?> Expenses</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['expense_year'], 0); ?></div>
            <div class="adm-kpi__sub">Year to date</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo (int) $dash['year']; ?> Purchases</div>
            <div class="adm-kpi__value"><?php echo adm_peso($k['purchase_year'], 0); ?></div>
            <div class="adm-kpi__sub">Year to date</div>
        </div>
    </div>

    <div class="ledger-dash-charts">
        <div class="ledger-chart-card ledger-chart-card--wide">
            <div class="ledger-chart-card__head">Monthly Expenses vs Purchases (<?php echo (int) $dash['year']; ?>)</div>
            <div class="ledger-chart-card__body ledger-chart-card__body--tall"><canvas id="dashFinanceChart"></canvas></div>
        </div>
        <?php if (!$isZamboanga): ?>
        <div class="ledger-chart-card ledger-chart-card--wide">
            <div class="ledger-chart-card__head">Maloong vs Buahan Revenue (<?php echo (int) $dash['year']; ?>)</div>
            <div class="ledger-chart-card__body ledger-chart-card__body--tall"><canvas id="dashTopperChart"></canvas></div>
        </div>
        <?php endif; ?>
        <div class="ledger-chart-card">
            <div class="ledger-chart-card__head">Expenses by Category (YTD)</div>
            <div class="ledger-chart-card__body"><canvas id="dashExpenseCatChart"></canvas></div>
        </div>
        <div class="ledger-chart-card">
            <div class="ledger-chart-card__head">Purchases by Category (YTD)</div>
            <div class="ledger-chart-card__body"><canvas id="dashPurchaseCatChart"></canvas></div>
        </div>
        <?php if (!$isZamboanga): ?>
        <div class="ledger-chart-card">
            <div class="ledger-chart-card__head">Cash Advance by Station (YTD)</div>
            <div class="ledger-chart-card__body"><canvas id="dashCaChart"></canvas></div>
        </div>
        <?php endif; ?>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <?php adm_panel_open("Today's Expenses"); ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <?php
                    $loc = mysqli_real_escape_string($con, $source);
                    $results = mysqli_query($con, "SELECT * FROM ledger_expenses WHERE location='{$loc}' AND DATE(`date`)=CURDATE() ORDER BY id DESC LIMIT 8");
                    ?>
                    <thead><tr><th>Date</th><th>VOC</th><th>Particulars</th><th>Category</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        <?php if ($results && mysqli_num_rows($results)): ?>
                            <?php while ($row = mysqli_fetch_array($results)): ?>
                                <tr>
                                    <td><?php echo adm_esc($row['date']); ?></td>
                                    <td><?php echo adm_esc($row['voucher_no']); ?></td>
                                    <td><?php echo adm_esc($row['particulars']); ?></td>
                                    <td><?php echo adm_esc($row['category']); ?></td>
                                    <td class="text-end"><?php echo adm_peso($row['total_amount'], 0); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: echo ledger_empty_table_row(5); endif; ?>
                    </tbody>
                </table>
            </div>
            <?php adm_panel_close(); ?>
        </div>

        <div class="col-lg-6">
            <?php adm_panel_open('Subscriptions This Month'); ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <?php
                    $results = mysqli_query($con, "SELECT * FROM ledger_expenses WHERE location='{$loc}' AND category='Subscription'
                        AND MONTH(`date`)=MONTH(CURDATE()) AND YEAR(`date`)=YEAR(CURDATE()) ORDER BY id DESC LIMIT 8");
                    ?>
                    <thead><tr><th>VOC</th><th>Name</th><th>Last Paid</th><th>Next Due</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        <?php if ($results && mysqli_num_rows($results)): ?>
                            <?php while ($row = mysqli_fetch_array($results)): ?>
                                <tr>
                                    <td><?php echo adm_esc($row['voucher_no']); ?></td>
                                    <td><?php echo adm_esc($row['particulars']); ?></td>
                                    <td><span class="badge bg-success"><?php echo adm_esc($row['date']); ?></span></td>
                                    <td><span class="badge bg-danger"><?php echo date('Y-m-d', strtotime('+1 month', strtotime($row['date']))); ?></span></td>
                                    <td class="text-end"><?php echo adm_peso($row['total_amount'], 0); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: echo ledger_empty_table_row(5); endif; ?>
                    </tbody>
                </table>
            </div>
            <?php adm_panel_close(); ?>
        </div>

        <?php if (!$isZamboanga): ?>
        <div class="col-lg-6">
            <?php adm_panel_open('Cash Advance Today'); ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <?php $results = mysqli_query($con, "SELECT * FROM ledger_cashadvance WHERE DATE(`date`)=CURDATE() ORDER BY id DESC LIMIT 8"); ?>
                    <thead><tr><th>VOC</th><th>Customer</th><th>Station</th><th>Category</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        <?php if ($results && mysqli_num_rows($results)): ?>
                            <?php while ($row = mysqli_fetch_array($results)): ?>
                                <tr>
                                    <td><?php echo adm_esc($row['voucher']); ?></td>
                                    <td><?php echo adm_esc($row['customer']); ?></td>
                                    <td><?php echo adm_esc($row['buying_station']); ?></td>
                                    <td><?php echo adm_esc($row['category']); ?></td>
                                    <td class="text-end"><?php echo adm_peso($row['amount'], 0); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: echo ledger_empty_table_row(5); endif; ?>
                    </tbody>
                </table>
            </div>
            <?php adm_panel_close(); ?>
        </div>

        <div class="col-lg-6">
            <?php adm_panel_open('Recent Purchases'); ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <?php $results = mysqli_query($con, "SELECT * FROM ledger_purchase WHERE location='{$loc}' ORDER BY id DESC LIMIT 8"); ?>
                    <thead><tr><th>Date</th><th>Category</th><th>Customer</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        <?php if ($results && mysqli_num_rows($results)): ?>
                            <?php while ($row = mysqli_fetch_array($results)): ?>
                                <tr>
                                    <td><?php echo adm_esc($row['date']); ?></td>
                                    <td><?php echo adm_esc($row['category']); ?></td>
                                    <td><?php echo adm_esc($row['customer_name']); ?></td>
                                    <td class="text-end"><?php echo adm_peso($row['total_amount'], 0); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: echo ledger_empty_table_row(4); endif; ?>
                    </tbody>
                </table>
            </div>
            <?php adm_panel_close(); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="ledger-dash-links">
        <a href="ledger-expense.php" class="ledger-dash-link"><i class="fas fa-receipt"></i> Expense Record</a>
        <a href="expense_report.php" class="ledger-dash-link"><i class="fas fa-chart-bar"></i> Expense Report</a>
        <?php if (!$isZamboanga): ?>
        <a href="ledger-purchase.php" class="ledger-dash-link"><i class="fas fa-cart-shopping"></i> Purchases</a>
        <a href="ledger-ca.php" class="ledger-dash-link"><i class="fas fa-hand-holding-dollar"></i> Cash Advance</a>
        <a href="ledger-maloong.php" class="ledger-dash-link"><i class="fas fa-boxes-stacked"></i> Maloong</a>
        <a href="ledger-buahan.php" class="ledger-dash-link"><i class="fas fa-boxes-stacked"></i> Buahan</a>
        <?php endif; ?>
    </div>
</div>

<script>
window.__ledgerDashboard = <?php echo json_encode([
    'month_labels' => $c['month_labels'],
    'expenses' => $c['expenses'],
    'purchases' => $c['purchases'],
    'maloong' => $c['maloong'],
    'buahan' => $c['buahan'],
    'expense_cat_labels' => $c['expense_categories']['labels'],
    'expense_cat_values' => $c['expense_categories']['values'],
    'purchase_cat_labels' => $c['purchase_categories']['labels'],
    'purchase_cat_values' => $c['purchase_categories']['values'],
    'ca_labels' => $c['ca_stations']['labels'],
    'ca_values' => $c['ca_stations']['values'],
], JSON_HEX_TAG | JSON_HEX_AMP); ?>;
</script>
<script src="js/ledger-dashboard.js?v=<?php echo filemtime(__DIR__ . '/js/ledger-dashboard.js'); ?>"></script>
</body>
</html>
