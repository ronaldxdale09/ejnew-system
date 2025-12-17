<?php
include('include/header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('include/navbar.php');
include('../function/db.php');

$current_year = date("Y");

// --- 1. FINANCIAL DATA AGGREGATION ---

// Initialize Monthly Arrays (1-12)
$monthly_stats = [];
for ($m = 1; $m <= 12; $m++) {
    $monthly_stats[$m] = [
        'sales' => 0,
        'cogs' => 0,
        'milling' => 0,
        'shipping' => 0,
        'net_profit' => 0
    ];
}

// A. NET SALES & COGS & VOLUME (Correction: Handle col name diffs)
$sales_query = mysqli_query($con, "
    SELECT 
        MONTH(transaction_date) as month_num,
        SUM(sales_proceed) as total_sales,
        SUM(cost) as total_cogs,
        SUM(weight) as total_weight
    FROM (
        SELECT transaction_date, sales_proceed, total_bale_cost as cost, total_bale_weight as weight, 'bale' as type 
        FROM bales_sales_record WHERE status='Complete' AND YEAR(transaction_date) = '$current_year'
        UNION ALL
        SELECT transaction_date, total_sales as sales_proceed, total_cuplump_cost as cost, total_cuplump_weight as weight, 'cuplump' as type 
        FROM sales_cuplump_record WHERE YEAR(transaction_date) = '$current_year'
    ) as combined_sales
    GROUP BY month_num
");

$total_net_sales = 0;
$total_cogs = 0;
$total_vol_sold = 0;

if ($sales_query) {
    while ($row = mysqli_fetch_array($sales_query)) {
        $m = $row['month_num'];
        $monthly_stats[$m]['sales'] = $row['total_sales'];
        $monthly_stats[$m]['cogs'] = $row['total_cogs'];
        $monthly_stats[$m]['vol_sold'] = $row['total_weight']; // Capture Volume

        $total_net_sales += $row['total_sales'];
        $total_cogs += $row['total_cogs'];
        $total_vol_sold += $row['total_weight'];
    }
}

// B. MILLING COST (Bales Only)
$milling_query = mysqli_query($con, "
    SELECT MONTH(transaction_date) as month_num, SUM(total_milling_cost) as cost 
    FROM bales_sales_record 
    WHERE status='Complete' AND YEAR(transaction_date) = '$current_year'
    GROUP BY month_num
");
$total_milling_cost = 0;
if ($milling_query) {
    while ($row = mysqli_fetch_array($milling_query)) {
        $monthly_stats[$row['month_num']]['milling'] = $row['cost'];
        $total_milling_cost += $row['cost'];
    }
}

// C. SHIPPING COST (Aggregated)
$shipping_query = mysqli_query($con, "
    SELECT MONTH(ship_date) as month_num, SUM(total_shipping_expense) as cost 
    FROM (
        SELECT ship_date, total_shipping_expense FROM bale_shipment_record WHERE YEAR(ship_date) = '$current_year'
        UNION ALL
        SELECT ship_date, total_shipping_expense FROM sales_cuplump_shipment WHERE YEAR(ship_date) = '$current_year'
    ) as combined_ship
    GROUP BY month_num
");
$total_shipping_cost = 0;
if ($shipping_query) {
    while ($row = mysqli_fetch_array($shipping_query)) {
        $monthly_stats[$row['month_num']]['shipping'] = $row['cost'];
        $total_shipping_cost += $row['cost'];
    }
}

// D. CONSOLIDATE PROFIT
$total_operational_expenses = $total_milling_cost + $total_shipping_cost;
$gross_profit = $total_net_sales - ($total_cogs + $total_operational_expenses);

// Prepare simple arrays for Charts
$monthly_sales_data = [];
$monthly_cogs_data = [];
$monthly_profit_data = [];
$monthly_vol_sold_data = []; // New Line

foreach ($monthly_stats as $m => $data) {
    $monthly_sales_data[$m] = $data['sales'];
    $monthly_cogs_data[$m] = $data['cogs'];
    $monthly_vol_sold_data[$m] = $data['vol_sold'] ?? 0; // New Line
    $monthly_profit_data[$m] = $data['sales'] - ($data['cogs'] + $data['milling'] + $data['shipping']);
}

// --- 2. SUPPLEMENTARY DATA ---

// Top Buyers (Correction: Handle col name diffs)
$buyers_q = mysqli_query($con, "
    SELECT buyer_name, SUM(sales_proceed) as total_bought 
    FROM (
        SELECT buyer_name, sales_proceed FROM bales_sales_record WHERE status='Complete' AND YEAR(transaction_date) = '$current_year'
        UNION ALL
        SELECT buyer_name, total_sales as sales_proceed FROM sales_cuplump_record WHERE YEAR(transaction_date) = '$current_year'
    ) as combined_buyers 
    WHERE buyer_name IS NOT NULL AND buyer_name != ''
    GROUP BY buyer_name 
    ORDER BY total_bought DESC 
    LIMIT 5
");
$top_buyers = [];
if ($buyers_q) {
    while ($row = mysqli_fetch_array($buyers_q)) {
        $top_buyers[] = $row;
    }
}

// Expenses Breakdown (Prescriptive)
$exp_query = mysqli_query($con, "SELECT category, SUM(amount) as amount FROM ledger_expenses GROUP BY category");
$expenses_by_cat = [];
if ($exp_query) {
    while ($row = mysqli_fetch_array($exp_query)) {
        $expenses_by_cat[$row['category']] = $row['amount'];
    }
}

// Inventory Snapshot (Global)
$inv_q = mysqli_query($con, "
    SELECT 
        SUM(remaining_bales * kilo_per_bale) as total_kg, 
        SUM(remaining_bales) as total_bales,
        SUM((total_production_cost / NULLIF(produce_total_weight,0) * remaining_bales * kilo_per_bale)) as est_value
    FROM planta_bales_production 
    LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.remaining_bales != 0
");
$inv_data = ($inv_q) ? mysqli_fetch_array($inv_q) : [];
$inv_total_kg = $inv_data['total_kg'] ?? 0;
$inv_total_bales = $inv_data['total_bales'] ?? 0;
$inv_total_value = $inv_data['est_value'] ?? 0;



// --- 3. ANALYTICS HELPERS ---

// E. PRODUCTION VOLUME (Monthly)
$prod_vol_query = mysqli_query($con, "
    SELECT MONTH(receiving_date) as month_num, SUM(produce_total_weight) as vol 
    FROM planta_recording 
    WHERE YEAR(receiving_date) = '$current_year' 
    GROUP BY month_num
");
$monthly_production_data = array_fill(1, 12, 0); // Initialize 1-12
if ($prod_vol_query) {
    while ($row = mysqli_fetch_array($prod_vol_query)) {
        $monthly_production_data[$row['month_num']] = $row['vol'];
    }
}

// F. RECEIVABLES (Unpaid Balance)
$ar_query = mysqli_query($con, "
    SELECT SUM(unpaid_balance) as total_ar FROM (
        SELECT unpaid_balance FROM bales_sales_record WHERE status != 'Paid'
        UNION ALL
        SELECT unpaid_balance FROM sales_cuplump_record WHERE status != 'Paid'
    ) as combined_ar
");
$total_receivables = ($ar_query) ? mysqli_fetch_array($ar_query)['total_ar'] : 0;

// G. SOURCE PERFORMANCE (Diagnostic)
$source_perf_query = mysqli_query($con, "
    SELECT 
        source, 
        SUM(sales_proceed) as total_sales,
        SUM(total_bale_cost + total_milling_cost + total_ship_expense) as total_costs
    FROM bales_sales_record
    WHERE status='Complete' AND YEAR(transaction_date) = '$current_year'
    GROUP BY source
");
$source_performance = [];
if ($source_perf_query) {
    while ($row = mysqli_fetch_array($source_perf_query)) {
        $source = $row['source'] ?: 'Unknown';
        $profit = $row['total_sales'] - $row['total_costs'];
        $margin = ($row['total_sales'] > 0) ? ($profit / $row['total_sales']) * 100 : 0;
        $source_performance[$source] = [
            'sales' => $row['total_sales'],
            'profit' => $profit,
            'margin' => $margin
        ];
    }
}

// Unit Costs & Production (Existing modified)
$prod_query = mysqli_query($con, "SELECT 
    SUM(produce_total_weight) as total_produced, 
    SUM(total_production_cost) as total_prod_cost,
    source
    FROM planta_recording WHERE YEAR(receiving_date) = '$current_year' GROUP BY source");
$unit_costs = [];
$total_produced = 0;
if ($prod_query) {
    while ($row = mysqli_fetch_array($prod_query)) {
        $total_produced += $row['total_produced'];
        if ($row['total_produced'] > 0) {
            $unit_costs[$row['source']] = ($row['total_prod_cost'] / $row['total_produced']) + 12; // +12 Milling Fee
        }
    }
}
$avg_cost_kilo = (($inv_total_kg > 0) ? ($inv_total_value / $inv_total_kg) : 0) + 12;
$avg_price_kilo = ($total_vol_sold > 0) ? ($total_net_sales / $total_vol_sold) : 0;

// Predictive: Monthly Targets (+10%)
$monthly_targets = [];
foreach ($monthly_sales_data as $m => $val) {
    $monthly_targets[$m] = $val * 1.10;
}

// Predictive Forecast Revenue
$recent_sales = array_slice(array_filter($monthly_sales_data), -3);
$avg_monthly_sales = count($recent_sales) > 0 ? array_sum($recent_sales) / count($recent_sales) : 0;
$forecast_revenue = $avg_monthly_sales * 1.05;

// Predictive Inventory Growth (Real Logic)
$monthly_prod_est = ($total_produced > 0) ? ($total_produced / max(date('n'), 1)) : 0; // Avg per month YTD
$monthly_sales_vol_est = ($total_vol_sold > 0) ? ($total_vol_sold / max(date('n'), 1)) : 0; // Avg per month YTD
$projected_inventory_growth = $monthly_prod_est - $monthly_sales_vol_est;

// Predictive: Days Sales of Inventory (DSI)
$daily_sales_rate = ($total_vol_sold > 0) ? ($total_vol_sold / date('z')) : 0; // Sold / days so far
$days_inventory = ($daily_sales_rate > 0) ? ($inv_total_kg / $daily_sales_rate) : 0;


// Prescriptive: Expense Ranking
arsort($expenses_by_cat);
$top_expenses = array_slice($expenses_by_cat, 0, 5);

// Prescriptive: Action Plan
$action_plan = [];

// 1. Profitability
if ($gross_profit < 0) {
    $action_plan[] = ["priority" => "Critical", "issue" => "Negative YTD Profit", "action" => "Immediate audit of COGS. Halt discretionary spending.", "impact" => "High"];
} elseif ($gross_profit < ($total_net_sales * 0.10)) {
    $action_plan[] = ["priority" => "High", "issue" => "Low Net Margin (<10%)", "action" => "Optimize milling efficiency to reduce unit costs.", "impact" => "Medium"];
}

// 2. Logistics
if ($total_shipping_cost > ($total_net_sales * 0.12)) {
    $action_plan[] = ["priority" => "High", "issue" => "High Logistics Ratio", "action" => "Review shipping contracts. Logistics > 12% of sales.", "impact" => "High"];
}

// 3. Inventory Turnover
if ($projected_inventory_growth > 50000) {
    $action_plan[] = ["priority" => "Critical", "issue" => "Rapid Stock Buildup", "action" => "Production exceeds sales by >50MT/mo. Urgently increase sales volume.", "impact" => "High"];
}

// 4. Source Disparity
if (isset($unit_costs['Basilan']) && isset($unit_costs['Kidapawan'])) {
    if ($unit_costs['Basilan'] > $unit_costs['Kidapawan'] * 1.25) {
        $action_plan[] = ["priority" => "Medium", "issue" => "Basilan High Cost", "action" => "Basilan unit cost is 25% higher than Kidapawan. Investigate.", "impact" => "Low"];
    }
}
?>

<style>
    :root {
        --primary: #4318FF;
        --secondary: #6AD2FF;
        --text-main: #2B3674;
        --text-gray: #A3AED0;
        --bg-light: #F4F7FE;
        --white: #FFFFFF;
        --success: #05CD99;
        --warning: #FFB547;
        --danger: #EE5D50;
    }

    body {
        background-color: var(--bg-light);
    }

    .main-content {
        padding: 30px;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header h4 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: var(--text-main);
    }

    .page-header p {
        color: var(--text-gray);
        font-size: 14px;
        margin: 0;
    }

    /* TABS */
    .report-tabs {
        background: var(--white);
        padding: 10px;
        border-radius: 16px;
        display: inline-flex;
        gap: 15px;
        margin: 30px 0;
        box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
    }

    .tab-btn {
        background: transparent;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        color: var(--text-gray);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .tab-btn:hover {
        color: var(--primary);
        background: var(--bg-light);
    }

    .tab-btn.tab-active {
        background: var(--primary);
        color: var(--white);
        box-shadow: 0px 5px 14px rgba(67, 24, 255, 0.3);
    }

    /* LAYOUT COMPONENTS */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .kpi-card {
        background: var(--white);
        border-radius: 20px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
        transition: transform 0.2s;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
    }

    .kpi-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 15px;
    }

    .kpi-content h6 {
        margin: 0;
        color: var(--text-gray);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .kpi-content h3 {
        margin: 5px 0 0 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-main);
    }

    .chart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 25px;
    }

    .chart-card {
        background: var(--white);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
        height: 100%;
        min-height: 400px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-main);
    }

    .icon-primary {
        background: #F4F7FE;
        color: var(--primary);
    }

    .icon-success {
        background: #EEFBF6;
        color: var(--success);
    }

    .icon-warning {
        background: #FFF9EC;
        color: var(--warning);
    }

    .icon-danger {
        background: #FEF3F2;
        color: var(--danger);
    }

    .text-success {
        color: var(--success);
    }

    .text-danger {
        color: var(--danger);
    }

    .text-warning {
        color: var(--warning);
    }

    .tab-pane {
        display: none;
        animation: fadeIn 0.4s ease;
    }

    .tab-pane.tab-active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="main-content">
    <div class="page-header">
        <h4>Business Intelligence Report</h4>
        <p>Advanced analytics and strategic insights for operations (Year <?php echo $current_year; ?>).</p>
    </div>

    <div class="report-tabs">
        <button class="tab-btn tab-active" onclick="switchTab('descriptive', this)"><i class="fas fa-chart-pie"></i>
            Descriptive</button>
        <button class="tab-btn" onclick="switchTab('diagnostic', this)"><i class="fas fa-microscope"></i>
            Diagnostic</button>
        <button class="tab-btn" onclick="switchTab('predictive', this)"><i class="fas fa-bullseye"></i>
            Predictive</button>
        <button class="tab-btn" onclick="switchTab('prescriptive', this)"><i class="fas fa-clipboard-list"></i>
            Prescriptive</button>
    </div>

    <div id="descriptive" class="tab-pane tab-active">
        <?php include('overall_report_tabs/descriptive.php'); ?>
    </div>
    <div id="diagnostic" class="tab-pane">
        <?php include('overall_report_tabs/diagnostic.php'); ?>
    </div>
    <div id="predictive" class="tab-pane">
        <?php include('overall_report_tabs/predictive.php'); ?>
    </div>
    <div id="prescriptive" class="tab-pane">
        <?php include('overall_report_tabs/prescriptive.php'); ?>
    </div>
</div>

<script>
    function switchTab(tabId, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('tab-active'));
        btn.classList.add('tab-active');
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('tab-active'));
        document.getElementById(tabId).classList.add('tab-active');
    }

    const monthsStr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // DATA FROM PHP
    const salesData = <?php echo json_encode(array_values($monthly_sales_data)); ?>;
    const cogsData = <?php echo json_encode(array_values($monthly_cogs_data)); ?>;
    const profitData = <?php echo json_encode(array_values($monthly_profit_data)); ?>;
    const productionData = <?php echo json_encode(array_values($monthly_production_data)); ?>;
    const volSoldData = <?php echo json_encode(array_values($monthly_vol_sold_data ?? array_fill(0, 12, 0))); ?>;

    // 1. Sales vs Costs (Bar)
    if (document.getElementById('salesCostChart')) {
        const ctxSales = document.getElementById('salesCostChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'bar',
            data: {
                labels: monthsStr,
                datasets: [
                    { label: 'Net Sales', data: salesData, backgroundColor: '#4318FF', borderRadius: 4, barPercentage: 0.6 },
                    { label: 'COGS', data: cogsData, backgroundColor: '#A3AED0', borderRadius: 4, barPercentage: 0.6 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                scales: { y: { grid: { borderDash: [5, 5], drawBorder: false } }, x: { grid: { display: false } } },
                plugins: { legend: { position: 'top', align: 'end' } }
            }
        });
    }

    // 1-B. Volume Analysis (Production vs Sales)
    if (document.getElementById('volumeAnalysisChart')) {
        const ctxVol = document.getElementById('volumeAnalysisChart').getContext('2d');
        new Chart(ctxVol, {
            type: 'bar',
            data: {
                labels: monthsStr,
                datasets: [
                    {
                        label: 'Production (Kg)',
                        data: productionData,
                        backgroundColor: '#6AD2FF',
                        barPercentage: 0.6,
                        order: 2
                    },
                    {
                        label: 'Sales (Kg)',
                        data: volSoldData,
                        borderColor: '#4318FF',
                        backgroundColor: 'rgba(67, 24, 255, 0.1)',
                        type: 'line',
                        fill: true,
                        tension: 0.4,
                        order: 1
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: { y: { grid: { borderDash: [5, 5], drawBorder: false } }, x: { grid: { display: false } } },
                plugins: { legend: { position: 'top' } }
            }
        });
    }

    // 2. Cost Breakdown (Doughnut)
    if (document.getElementById('costBreakdownChart')) {
        const ctxBreakdown = document.getElementById('costBreakdownChart').getContext('2d');
        new Chart(ctxBreakdown, {
            type: 'doughnut',
            data: {
                labels: ['COGS', 'Milling', 'Shipping/Logistics'],
                datasets: [{
                    data: [<?php echo $total_cogs; ?>, <?php echo $total_milling_cost; ?>, <?php echo $total_shipping_cost; ?>],
                    backgroundColor: ['#EE5D50', '#FFB547', '#6AD2FF'], borderWidth: 0
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '70%',
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    // 3. Inventory Forecast (Line)
    if (document.getElementById('inventoryForecastChart')) {
        const ctxInvForecast = document.getElementById('inventoryForecastChart').getContext('2d');
        const currentStock = <?php echo $inv_total_kg ?? 0; ?>;
        const monthlyGrowth = <?php echo $projected_inventory_growth ?? 0; ?>;

        const forecastLabels = [];
        const forecastData = [];
        const date = new Date();
        for (let i = 1; i <= 6; i++) {
            date.setMonth(date.getMonth() + 1);
            forecastLabels.push(date.toLocaleString('default', { month: 'short' }));
            forecastData.push(Math.max(0, currentStock + (monthlyGrowth * i))); // Prevent negative stock
        }

        new Chart(ctxInvForecast, {
            type: 'line',
            data: {
                labels: forecastLabels,
                datasets: [{
                    label: 'Projected Stock (Kg)', data: forecastData,
                    borderColor: '#6AD2FF', backgroundColor: 'rgba(106, 210, 255, 0.1)', fill: true, tension: 0.4, pointRadius: 4
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { grid: { borderDash: [5, 5], drawBorder: false } }, x: { grid: { display: false } } }
            }
        });
    }

    // 4. Monthly Profit Trend (Diagnostic) - Line Chart
    if (document.getElementById('profitTrendChart')) {
        const ctxProfit = document.getElementById('profitTrendChart').getContext('2d');
        new Chart(ctxProfit, {
            type: 'line',
            data: {
                labels: monthsStr,
                datasets: [{
                    label: 'Net Profit',
                    data: profitData,
                    borderColor: '#05CD99',
                    backgroundColor: 'rgba(5, 205, 153, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                scales: { y: { grid: { borderDash: [5, 5], drawBorder: false } }, x: { grid: { display: false } } },
                plugins: { legend: { display: false } }
            }
        });
    }

</script>