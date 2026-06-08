<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/copra_record/data.php';

$selectedYear = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
$kpis = copra_record_kpis($con, $selectedYear);
$years = copra_record_years($con);
$sellers = copra_record_sellers($con);

$isCurrentYear = $selectedYear === (int) date('Y');
$defaultDateFrom = $isCurrentYear ? date('Y-01-01') : ($selectedYear . '-01-01');
$defaultDateTo = $isCurrentYear ? date('Y-m-d') : ($selectedYear . '-12-31');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
<link rel="stylesheet" href="css/copra-theme.css?v=<?php echo file_exists('css/copra-theme.css') ? filemtime('css/copra-theme.css') : '1'; ?>">

<div class="main-content admin-page copra-page">
    <?php adm_page_header(
        'Copra Purchase Record',
        'Track copra buying transactions, weights, and payments — filter by year, seller, or date range.',
        ['Reports', 'Copra']
    ); ?>

    <div class="copra-kpi-grid">
        <div class="copra-kpi">
            <div class="copra-kpi__label"><?php echo $selectedYear; ?> Purchases</div>
            <div class="copra-kpi__value"><?php echo adm_peso($kpis['total_purchase'], 0); ?></div>
            <div class="copra-kpi__sub"><?php echo number_format($kpis['total_transactions']); ?> transactions</div>
        </div>
        <div class="copra-kpi">
            <div class="copra-kpi__label"><?php echo $selectedYear; ?> Weight</div>
            <div class="copra-kpi__value"><?php echo number_format($kpis['total_weight'], 0); ?> <small>kg</small></div>
            <div class="copra-kpi__sub">Net resecada weight</div>
        </div>
        <div class="copra-kpi">
            <div class="copra-kpi__label">Avg ₱ / kg</div>
            <div class="copra-kpi__value"><?php echo adm_peso($kpis['avg_per_kg'], 2); ?></div>
            <div class="copra-kpi__sub"><?php echo $selectedYear; ?> average</div>
        </div>
        <div class="copra-kpi">
            <div class="copra-kpi__label">This Month</div>
            <div class="copra-kpi__value"><?php echo adm_peso($kpis['month_purchase'], 0); ?></div>
            <div class="copra-kpi__sub"><?php echo number_format($kpis['month_transactions']); ?> purchases</div>
        </div>
        <div class="copra-kpi">
            <div class="copra-kpi__label">Tax Paid</div>
            <div class="copra-kpi__value"><?php echo adm_peso($kpis['total_tax'], 0); ?></div>
            <div class="copra-kpi__sub"><?php echo $selectedYear; ?> withholding</div>
        </div>
        <div class="copra-kpi copra-kpi--alert">
            <div class="copra-kpi__label">Pending Cash Advances</div>
            <div class="copra-kpi__value"><?php echo number_format($kpis['pending_ca_count']); ?></div>
            <div class="copra-kpi__sub"><?php echo adm_peso($kpis['outstanding_ca'], 0); ?> outstanding</div>
        </div>
    </div>

    <?php adm_panel_open('Purchase Transactions'); ?>

    <div class="copra-toolbar">
        <div class="copra-filter-field">
            <label for="copraYear">Year (KPIs)</label>
            <select id="copraYear" class="form-select form-select-sm" data-default-year="<?php echo $selectedYear; ?>">
                <?php foreach ($years as $y): ?>
                    <option value="<?php echo $y; ?>" <?php echo $y === $selectedYear ? 'selected' : ''; ?>><?php echo $y; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="copra-filter-field">
            <label for="copraSeller">Seller</label>
            <select id="copraSeller" class="form-select form-select-sm">
                <option value="">All sellers</option>
                <?php foreach ($sellers as $s): ?>
                    <option value="<?php echo adm_esc($s['name']); ?>">
                        [<?php echo adm_esc($s['code']); ?>] <?php echo adm_esc($s['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="copra-filter-field">
            <label for="copraDateFrom">From</label>
            <input type="text" id="copraDateFrom" class="form-control form-control-sm" autocomplete="off" placeholder="Start date" value="<?php echo adm_esc($defaultDateFrom); ?>">
        </div>
        <div class="copra-filter-field">
            <label for="copraDateTo">To</label>
            <input type="text" id="copraDateTo" class="form-control form-control-sm" autocomplete="off" placeholder="End date" value="<?php echo adm_esc($defaultDateTo); ?>">
        </div>
        <div class="copra-filter-actions">
            <button type="button" class="copra-preset-btn" data-copra-preset="month">This month</button>
            <button type="button" class="copra-preset-btn" data-copra-preset="ytd">YTD</button>
            <button type="button" class="copra-preset-btn" data-copra-preset="all">All dates</button>
            <button type="button" class="copra-preset-btn" id="copraClearFilters">Clear</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped w-100" id="transaction_history">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Contract</th>
                    <th>Seller</th>
                    <th class="text-end">1st Price</th>
                    <th class="text-end">2nd Price</th>
                    <th class="text-end">Net Weight</th>
                    <th class="text-end">Amount Paid</th>
                    <th class="text-center">View</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="copra-table-foot">
        <span><strong>Filtered:</strong> <span id="copraFilteredCount">0</span> records</span>
        <span><strong>Total paid:</strong> <span id="copraFilteredPaid">₱0</span></span>
        <span><strong>Total weight:</strong> <span id="copraFilteredWeight">0 kg</span></span>
        <span><strong>Avg ₱/kg:</strong> <span id="copraFilteredAvgKg">₱0</span></span>
    </div>

    <?php adm_panel_close(); ?>
</div>

<?php include 'modal/copraHistory_modal.php'; ?>

<script src="js/copra-record.js?v=<?php echo file_exists('js/copra-record.js') ? filemtime('js/copra-record.js') : '1'; ?>"></script>
</body>
</html>
