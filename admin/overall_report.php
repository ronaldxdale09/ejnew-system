<?php
include 'include/header.php';
include 'include/navbar.php';
include 'overall_report/data.php';
?>

<div class="main-content admin-page">
    <header class="adm-page-header adm-page-header--row">
        <div>
            <h1>Overall Business Report</h1>
            <p>Rubber sales, production, expenses, and cash position — all amounts in Philippine Peso (₱).</p>
        </div>
        <form class="adm-year-filter" method="get" action="">
            <label for="reportYear">Year</label>
            <select class="form-select form-select-sm" id="reportYear" name="year" onchange="this.form.submit()">
                <?php foreach ($year_options as $opt): ?>
                    <option value="<?php echo (int) $opt['yr']; ?>" <?php echo ((int) $opt['yr'] === $report_year) ? 'selected' : ''; ?>>
                        <?php echo (int) $opt['yr']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </header>

    <div class="adm-kpi-grid adm-kpi-grid--report">
        <div class="adm-kpi adm-kpi--green">
            <div class="adm-kpi__label">Total Revenue</div>
            <div class="adm-kpi__value"><?php echo adm_peso($total_revenue); ?></div>
            <div class="adm-kpi__sub">Bales <?php echo adm_peso($bales_revenue); ?> · Cuplump <?php echo adm_peso($cuplump_revenue); ?><?php echo $coffee_revenue > 0 ? ' · Coffee ' . adm_peso($coffee_revenue) : ''; ?></div>
        </div>
        <div class="adm-kpi adm-kpi--green">
            <div class="adm-kpi__label">Gross Profit (Rubber)</div>
            <div class="adm-kpi__value"><?php echo adm_peso($total_gross_profit); ?></div>
            <div class="adm-kpi__sub">Margin <?php echo number_format($gross_margin_pct, 1); ?>%</div>
        </div>
        <div class="adm-kpi adm-kpi--red">
            <div class="adm-kpi__label">Operating Expenses</div>
            <div class="adm-kpi__value"><?php echo adm_peso($operating_expenses); ?></div>
            <div class="adm-kpi__sub"><?php echo number_format($expense_ratio_pct, 1); ?>% of revenue</div>
        </div>
        <div class="adm-kpi <?php echo $net_after_expenses >= 0 ? 'adm-kpi--green' : 'adm-kpi--red'; ?>">
            <div class="adm-kpi__label">Net After Expenses</div>
            <div class="adm-kpi__value"><?php echo adm_peso($net_after_expenses); ?></div>
            <div class="adm-kpi__sub">Gross profit − ledger expenses</div>
        </div>
        <div class="adm-kpi adm-kpi--gold">
            <div class="adm-kpi__label">Receivables</div>
            <div class="adm-kpi__value"><?php echo adm_peso($total_receivables); ?></div>
            <div class="adm-kpi__sub">Outstanding buyer balances</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Bale Inventory</div>
            <div class="adm-kpi__value"><?php echo adm_peso($inv_total_value); ?></div>
            <div class="adm-kpi__sub"><?php echo number_format($inv_total_kg, 0); ?> kg · <?php echo number_format($inv_total_bales, 0); ?> bales<?php echo $wip_total_kg > 0 ? ' · WIP ' . number_format($wip_total_kg, 0) . ' kg' : ''; ?></div>
        </div>
    </div>

    <div class="adm-tabs" role="tablist">
        <button type="button" class="adm-tab active" data-adm-tab="overview"><i class="fas fa-chart-pie"></i> Overview</button>
        <button type="button" class="adm-tab" data-adm-tab="operations"><i class="fas fa-industry"></i> Operations</button>
        <button type="button" class="adm-tab" data-adm-tab="outlook"><i class="fas fa-binoculars"></i> Outlook</button>
        <button type="button" class="adm-tab" data-adm-tab="actions"><i class="fas fa-list-check"></i> Actions</button>
    </div>

    <div class="adm-tab-panel active" data-adm-panel="overview">
        <?php include 'overall_report/tabs/overview.php'; ?>
    </div>
    <div class="adm-tab-panel" data-adm-panel="operations">
        <?php include 'overall_report/tabs/operations.php'; ?>
    </div>
    <div class="adm-tab-panel" data-adm-panel="outlook">
        <?php include 'overall_report/tabs/outlook.php'; ?>
    </div>
    <div class="adm-tab-panel" data-adm-panel="actions">
        <?php include 'overall_report/tabs/actions.php'; ?>
    </div>
</div>

<script>
(function () {
    const months = <?php echo json_encode($months_short); ?>;
    const revenue = <?php echo json_encode($chart_revenue); ?>;
    const profit = <?php echo json_encode($chart_profit); ?>;
    const directCosts = <?php echo json_encode($chart_cogs); ?>;
    const production = <?php echo json_encode($chart_production); ?>;
    const salesKg = <?php echo json_encode($chart_sales_kg); ?>;
    const expenses = <?php echo json_encode($chart_expenses); ?>;

    const chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'top', align: 'end', labels: { boxWidth: 12, font: { size: 11 } } } },
        scales: {
            y: { ticks: { font: { size: 10 } }, grid: { color: 'rgba(148,163,184,0.2)' } },
            x: { ticks: { font: { size: 10 } }, grid: { display: false } }
        }
    };

    if (document.getElementById('orRevenueProfitChart')) {
        new Chart(document.getElementById('orRevenueProfitChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    { label: 'Revenue', data: revenue, backgroundColor: '#1a734f', borderRadius: 4, barPercentage: 0.55, order: 2 },
                    { label: 'Gross Profit', data: profit, type: 'line', borderColor: '#c9922a', backgroundColor: 'rgba(201,146,42,0.08)', fill: true, tension: 0.3, pointRadius: 2, order: 1 }
                ]
            },
            options: chartDefaults
        });
    }

    if (document.getElementById('orCostChart')) {
        new Chart(document.getElementById('orCostChart'), {
            type: 'doughnut',
            data: {
                labels: ['COGS', 'Milling', 'Shipping', 'Operating Expenses'],
                datasets: [{
                    data: [<?php echo round($total_cogs); ?>, <?php echo round($total_milling); ?>, <?php echo round($total_shipping); ?>, <?php echo round($operating_expenses); ?>],
                    backgroundColor: ['#64748b', '#0284c7', '#94a3b8', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } } }
        });
    }

    if (document.getElementById('orVolumeChart')) {
        new Chart(document.getElementById('orVolumeChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    { label: 'Production (kg)', data: production, backgroundColor: '#6ad2ff', barPercentage: 0.55 },
                    { label: 'Sales (kg)', data: salesKg, type: 'line', borderColor: '#1a734f', backgroundColor: 'rgba(26,115,79,0.08)', fill: true, tension: 0.3, pointRadius: 2 }
                ]
            },
            options: { ...chartDefaults, interaction: { mode: 'index', intersect: false } }
        });
    }

    if (document.getElementById('orProfitTrendChart')) {
        new Chart(document.getElementById('orProfitTrendChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    { label: 'Gross Profit', data: profit, borderColor: '#059669', backgroundColor: 'rgba(5,150,105,0.08)', fill: true, tension: 0.3, pointRadius: 2 },
                    { label: 'Operating Expenses', data: expenses, borderColor: '#dc2626', borderDash: [4, 4], fill: false, tension: 0.3, pointRadius: 2 }
                ]
            },
            options: chartDefaults
        });
    }

    if (document.getElementById('orUnitCostChart')) {
        const labels = <?php echo json_encode(array_keys($unit_costs)); ?>;
        const values = <?php echo json_encode(array_values($unit_costs)); ?>;
        new Chart(document.getElementById('orUnitCostChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cost per kg (₱)',
                    data: values,
                    backgroundColor: values.map(v => v > <?php echo $avg_unit_cost; ?> ? '#dc2626' : '#059669'),
                    borderRadius: 4,
                    barPercentage: 0.5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { grid: { color: 'rgba(148,163,184,0.2)' } }, y: { grid: { display: false } } }
            }
        });
    }
})();
</script>

</body>
</html>
