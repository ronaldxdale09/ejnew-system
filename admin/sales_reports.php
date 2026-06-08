<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/sales_reports/data.php';

$selectedYear = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
$report = sr_build_report($con, $selectedYear);
$s = $report['summary'];
$monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

$srCell = static function ($v): string {
    if ($v == 0) {
        return '<span class="sr-empty">—</span>';
    }
    return adm_peso($v, 0);
};

$localPct = $s['net_sales'] > 0 ? ($s['local_sales'] / $s['net_sales']) * 100 : 0;
$exportPct = $s['net_sales'] > 0 ? ($s['export_sales'] / $s['net_sales']) * 100 : 0;
$cuplumpPct = $s['net_sales'] > 0 ? ($s['cuplump_sales'] / $s['net_sales']) * 100 : 0;

$cssVer = file_exists('css/sales-reports-theme.css') ? filemtime('css/sales-reports-theme.css') : '1';
$jsVer = file_exists('js/sales-reports.js') ? filemtime('js/sales-reports.js') : '1';
?>

<link rel="stylesheet" href="css/sales-reports-theme.css?v=<?php echo $cssVer; ?>">

<div class="main-content admin-page sr-page">
    <!-- Hero -->
    <section class="sr-hero">
        <img src="assets/img/sales-report-plantation.png" alt="" class="sr-hero__thumb" aria-hidden="true">
        <div class="sr-hero__main">
            <div class="sr-hero__top">
                <div class="sr-hero__head">
                    <span class="sr-hero__eyebrow">Executive Report</span>
                    <h1 class="sr-hero__title">Sales &amp; Profitability <?php echo (int) $report['year']; ?></h1>
                </div>
                <form class="sr-hero__year" method="get" action="sales_reports.php">
                    <label for="srYear">Year</label>
                    <select id="srYear" name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                        <?php foreach ($report['years'] as $y): ?>
                            <option value="<?php echo (int) $y; ?>" <?php echo (int) $y === (int) $report['year'] ? 'selected' : ''; ?>>
                                <?php echo (int) $y; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <p class="sr-hero__desc">Bale &amp; cuplump sales, COGS, milling, shipping, and gross profit by month.</p>
        </div>
    </section>

    <!-- KPI strip -->
    <div class="sr-kpi-grid">
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--green"><i class="fas fa-chart-line"></i></div>
            <div class="sr-kpi__label">Net Sales</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['net_sales'], 0); ?></div>
            <div class="sr-kpi__sub"><?php echo (int) $report['year']; ?> total revenue</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--gold"><i class="fas fa-coins"></i></div>
            <div class="sr-kpi__label">Gross Profit</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['gross_profit'], 0); ?></div>
            <div class="sr-kpi__sub"><?php echo number_format($s['margin_pct'], 1); ?>% margin</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--red"><i class="fas fa-boxes"></i></div>
            <div class="sr-kpi__label">Total COGS</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['cogs'], 0); ?></div>
            <div class="sr-kpi__sub">Bales + cuplump cost</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--blue"><i class="fas fa-shipping-fast"></i></div>
            <div class="sr-kpi__label">Shipping</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['shipping'], 0); ?></div>
            <div class="sr-kpi__sub">Freight &amp; logistics</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--purple"><i class="fas fa-percentage"></i></div>
            <div class="sr-kpi__label">YoY Growth</div>
            <div class="sr-kpi__value">
                <?php if ($s['yoy_growth'] !== null): ?>
                    <?php echo ($s['yoy_growth'] >= 0 ? '+' : '') . number_format($s['yoy_growth'], 1); ?>%
                <?php else: ?>
                    —
                <?php endif; ?>
            </div>
            <div class="sr-kpi__sub<?php echo $s['yoy_growth'] !== null && $s['yoy_growth'] >= 0 ? ' sr-kpi__sub--up' : ($s['yoy_growth'] !== null ? ' sr-kpi__sub--down' : ''); ?>">
                vs <?php echo (int) $report['prev_year']; ?> (<?php echo adm_peso($s['prev_net_sales'], 0); ?>)
            </div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--gold"><i class="fas fa-hand-holding-usd"></i></div>
            <div class="sr-kpi__label">Receivables</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['receivables'], 0); ?></div>
            <div class="sr-kpi__sub">Unpaid balances</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--green"><i class="fas fa-calendar-check"></i></div>
            <div class="sr-kpi__label">Best Month</div>
            <div class="sr-kpi__value"><?php echo adm_esc($s['highest_month']); ?></div>
            <div class="sr-kpi__sub"><?php echo adm_peso($s['highest_profit'], 0); ?> profit</div>
        </div>
        <div class="sr-kpi">
            <div class="sr-kpi__icon sr-kpi__icon--blue"><i class="fas fa-industry"></i></div>
            <div class="sr-kpi__label">Milling Cost</div>
            <div class="sr-kpi__value"><?php echo adm_peso($s['milling'], 0); ?></div>
            <div class="sr-kpi__sub"><?php echo (int) $report['year']; ?> processing</div>
        </div>
    </div>

    <!-- Product mix -->
    <div class="sr-mix-grid">
        <div class="sr-mix-card">
            <div class="sr-mix-card__icon sr-mix-card__icon--local"><i class="fas fa-store"></i></div>
            <div>
                <div class="sr-mix-card__label">Bale Local Sales</div>
                <div class="sr-mix-card__value"><?php echo adm_peso($s['local_sales'], 0); ?></div>
                <div class="sr-mix-card__pct"><?php echo number_format($localPct, 1); ?>% of net sales</div>
            </div>
        </div>
        <div class="sr-mix-card">
            <div class="sr-mix-card__icon sr-mix-card__icon--export"><i class="fas fa-globe-asia"></i></div>
            <div>
                <div class="sr-mix-card__label">Bale Export Sales</div>
                <div class="sr-mix-card__value"><?php echo adm_peso($s['export_sales'], 0); ?></div>
                <div class="sr-mix-card__pct"><?php echo number_format($exportPct, 1); ?>% of net sales</div>
            </div>
        </div>
        <div class="sr-mix-card">
            <img src="assets/img/sales-report-plantation.png" alt="" class="sr-mix-card__img" aria-hidden="true">
            <div>
                <div class="sr-mix-card__label">Cuplump Sales</div>
                <div class="sr-mix-card__value"><?php echo adm_peso($s['cuplump_sales'], 0); ?></div>
                <div class="sr-mix-card__pct"><?php echo number_format($cuplumpPct, 1); ?>% of net sales</div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <nav class="sr-tabs" aria-label="Report views">
        <button type="button" class="sr-tabs__btn active" data-sr-tab="overview">Overview</button>
        <button type="button" class="sr-tabs__btn" data-sr-tab="monthly">Monthly</button>
        <button type="button" class="sr-tabs__btn" data-sr-tab="report">Full Report</button>
    </nav>

    <!-- Overview panel -->
    <div class="sr-panel active" data-sr-panel="overview">
        <div class="sr-charts">
            <div class="sr-chart-card">
                <div class="sr-chart-card__head">Monthly Net Sales vs Gross Profit</div>
                <div class="sr-chart-card__body">
                    <canvas id="srTrendChart"></canvas>
                </div>
            </div>
            <div class="sr-chart-card">
                <div class="sr-chart-card__head">Annual Cost &amp; Profit Split</div>
                <div class="sr-chart-card__body">
                    <canvas id="srCostChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly panel -->
    <div class="sr-panel" data-sr-panel="monthly">
        <div class="sr-month-grid">
            <?php foreach ($report['monthly_cards'] as $card): ?>
                <?php $isEmpty = $card['net_sales'] == 0 && $card['gross_profit'] == 0; ?>
                <article class="sr-month-card<?php echo $isEmpty ? ' sr-month-card--empty' : ''; ?>">
                    <div class="sr-month-card__name"><?php echo adm_esc($card['label']); ?></div>
                    <div class="sr-month-card__row">
                        <span>Net Sales</span>
                        <span><?php echo $card['net_sales'] != 0 ? adm_peso($card['net_sales'], 0) : '—'; ?></span>
                    </div>
                    <div class="sr-month-card__row">
                        <span>Gross Profit</span>
                        <span><?php echo $card['gross_profit'] != 0 ? adm_peso($card['gross_profit'], 0) : '—'; ?></span>
                    </div>
                    <div class="sr-month-card__margin">
                        <?php if ($card['net_sales'] > 0): ?>
                            <?php echo number_format($card['margin_pct'], 1); ?>% margin
                        <?php else: ?>
                            No sales recorded
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Full report panel -->
    <div class="sr-panel" data-sr-panel="report">
        <div class="sr-table-toolbar">
            <span class="sr-table-toolbar__hint">
                <i class="fas fa-arrows-alt-h"></i> Scroll horizontally on mobile · sticky row labels
            </span>
            <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="sr-export-btn" id="srExportCsv">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button type="button" class="sr-export-btn" id="srPrintReport">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
        <div class="sr-table-wrap">
            <table class="sr-table" id="srReportTable">
                <thead>
                    <tr>
                        <th>Line Item</th>
                        <?php foreach ($monthLabels as $ml): ?>
                            <th><?php echo $ml; ?></th>
                        <?php endforeach; ?>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($report['rows'] as $row): ?>
                        <?php
                        $variant = $row['variant'] ?? 'detail';
                        $rowClass = 'sr-row--' . adm_esc($variant);
                        ?>
                        <tr class="<?php echo $rowClass; ?>">
                            <td><?php echo adm_esc($row['label']); ?></td>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <td class="num"><?php echo $srCell($row['months'][$m] ?? 0); ?></td>
                            <?php endfor; ?>
                            <td class="num"><strong><?php echo $srCell($row['total'] ?? 0); ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
window.__salesReport = <?php echo json_encode([
    'year' => $report['year'],
    'chart' => $report['chart'],
], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
</script>
<script src="js/sales-reports.js?v=<?php echo $jsVer; ?>"></script>
</body>
</html>
