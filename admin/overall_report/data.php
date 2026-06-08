<?php
/**
 * Overall Report — data layer (aligned with dashboard_computation.php field usage).
 */

$report_year = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
if ($report_year < 2020 || $report_year > ((int) date('Y') + 1)) {
    $report_year = (int) date('Y');
}

$year_sql = (int) $report_year;
$months_short = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

$monthly = [];
for ($m = 1; $m <= 12; $m++) {
    $monthly[$m] = [
        'revenue' => 0,
        'gross_profit' => 0,
        'cogs' => 0,
        'milling' => 0,
        'shipping' => 0,
        'expenses' => 0,
        'production_kg' => 0,
        'sales_kg' => 0,
        'bales_revenue' => 0,
        'cuplump_revenue' => 0,
    ];
}

function or_fetch_all(mysqli $con, string $sql): array
{
    $rows = [];
    $res = mysqli_query($con, $sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function or_fetch_one(mysqli $con, string $sql): array
{
    $res = mysqli_query($con, $sql);
    return ($res && ($row = mysqli_fetch_assoc($res))) ? $row : [];
}

// ── Monthly rubber sales & profit (stored gross_profit — authoritative) ──
$sales_monthly = or_fetch_all($con, "
    SELECT month_num,
           SUM(bales_revenue) AS bales_revenue,
           SUM(cuplump_revenue) AS cuplump_revenue,
           SUM(revenue) AS revenue,
           SUM(gross_profit) AS gross_profit,
           SUM(cogs) AS cogs,
           SUM(milling) AS milling,
           SUM(shipping) AS shipping,
           SUM(sales_kg) AS sales_kg
    FROM (
        SELECT MONTH(transaction_date) AS month_num,
               SUM(total_sales) AS bales_revenue,
               0 AS cuplump_revenue,
               SUM(total_sales) AS revenue,
               SUM(gross_profit) AS gross_profit,
               SUM(total_bale_cost) AS cogs,
               SUM(total_milling_cost) AS milling,
               SUM(total_ship_expense) AS shipping,
               SUM(total_bale_weight) AS sales_kg
        FROM bales_sales_record
        WHERE YEAR(transaction_date) = {$year_sql}
        GROUP BY MONTH(transaction_date)
        UNION ALL
        SELECT MONTH(transaction_date) AS month_num,
               0 AS bales_revenue,
               SUM(sales_proceed) AS cuplump_revenue,
               SUM(sales_proceed) AS revenue,
               SUM(gross_profit) AS gross_profit,
               SUM(total_cuplump_cost) AS cogs,
               0 AS milling,
               SUM(total_ship_expense) AS shipping,
               SUM(total_cuplump_weight) AS sales_kg
        FROM sales_cuplump_record
        WHERE YEAR(transaction_date) = {$year_sql}
        GROUP BY MONTH(transaction_date)
    ) AS combined
    GROUP BY month_num
");

foreach ($sales_monthly as $row) {
    $m = (int) $row['month_num'];
    if ($m < 1 || $m > 12) {
        continue;
    }
    $monthly[$m]['revenue'] = (float) $row['revenue'];
    $monthly[$m]['gross_profit'] = (float) $row['gross_profit'];
    $monthly[$m]['cogs'] = (float) $row['cogs'];
    $monthly[$m]['milling'] = (float) $row['milling'];
    $monthly[$m]['shipping'] = (float) $row['shipping'];
    $monthly[$m]['sales_kg'] = (float) $row['sales_kg'];
    $monthly[$m]['bales_revenue'] = (float) $row['bales_revenue'];
    $monthly[$m]['cuplump_revenue'] = (float) $row['cuplump_revenue'];
}

// ── Monthly operating expenses (ledger) ──
$exp_monthly = or_fetch_all($con, "
    SELECT CAST(LEFT(date, 4) AS UNSIGNED) AS month_num_raw, MONTH(STR_TO_DATE(date, '%Y-%m-%d')) AS month_num, SUM(total_amount) AS total
    FROM ledger_expenses
    WHERE date REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}'
      AND CAST(LEFT(date, 4) AS UNSIGNED) = {$year_sql}
    GROUP BY month_num
");
foreach ($exp_monthly as $row) {
    $m = (int) $row['month_num'];
    if ($m >= 1 && $m <= 12) {
        $monthly[$m]['expenses'] = (float) $row['total'];
    }
}

// ── Monthly production volume ──
$prod_monthly = or_fetch_all($con, "
    SELECT MONTH(receiving_date) AS month_num, SUM(produce_total_weight) AS vol
    FROM planta_recording
    WHERE YEAR(receiving_date) = {$year_sql}
    GROUP BY MONTH(receiving_date)
");
foreach ($prod_monthly as $row) {
    $m = (int) $row['month_num'];
    if ($m >= 1 && $m <= 12) {
        $monthly[$m]['production_kg'] = (float) $row['vol'];
    }
}

// ── YTD totals ──
$totals = or_fetch_one($con, "
    SELECT
        SUM(bales_revenue) AS bales_revenue,
        SUM(cuplump_revenue) AS cuplump_revenue,
        SUM(revenue) AS revenue,
        SUM(gross_profit) AS gross_profit,
        SUM(cogs) AS cogs,
        SUM(milling) AS milling,
        SUM(shipping) AS shipping,
        SUM(sales_kg) AS sales_kg
    FROM (
        SELECT SUM(total_sales) AS bales_revenue, 0 AS cuplump_revenue,
               SUM(total_sales) AS revenue, SUM(gross_profit) AS gross_profit,
               SUM(total_bale_cost) AS cogs, SUM(total_milling_cost) AS milling,
               SUM(total_ship_expense) AS shipping, SUM(total_bale_weight) AS sales_kg
        FROM bales_sales_record WHERE YEAR(transaction_date) = {$year_sql}
        UNION ALL
        SELECT 0, SUM(sales_proceed), SUM(sales_proceed), SUM(gross_profit),
               SUM(total_cuplump_cost), 0, SUM(total_ship_expense), SUM(total_cuplump_weight)
        FROM sales_cuplump_record WHERE YEAR(transaction_date) = {$year_sql}
    ) t
");

$coffee_row = or_fetch_one($con, "
    SELECT COALESCE(SUM(coffee_total_amount), 0) AS total
    FROM coffee_sale WHERE YEAR(coffee_date) = {$year_sql}
");
$coffee_revenue = (float) ($coffee_row['total'] ?? 0);

$expenses_row = or_fetch_one($con, "
    SELECT COALESCE(SUM(total_amount), 0) AS total
    FROM ledger_expenses
    WHERE date REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}'
      AND CAST(LEFT(date, 4) AS UNSIGNED) = {$year_sql}
");
$operating_expenses = (float) ($expenses_row['total'] ?? 0);

$total_revenue = (float) ($totals['revenue'] ?? 0) + $coffee_revenue;
$total_gross_profit = (float) ($totals['gross_profit'] ?? 0);
$total_cogs = (float) ($totals['cogs'] ?? 0);
$total_milling = (float) ($totals['milling'] ?? 0);
$total_shipping = (float) ($totals['shipping'] ?? 0);
$total_direct_costs = $total_cogs + $total_milling + $total_shipping;
$total_sales_kg = (float) ($totals['sales_kg'] ?? 0);
$bales_revenue = (float) ($totals['bales_revenue'] ?? 0);
$cuplump_revenue = (float) ($totals['cuplump_revenue'] ?? 0);

$net_after_expenses = $total_gross_profit - $operating_expenses;
$gross_margin_pct = $total_revenue > 0 ? ($total_gross_profit / $total_revenue) * 100 : 0;
$expense_ratio_pct = $total_revenue > 0 ? ($operating_expenses / $total_revenue) * 100 : 0;

// ── Receivables (outstanding balances) ──
$ar_row = or_fetch_one($con, "
    SELECT COALESCE(SUM(unpaid_balance), 0) AS total FROM (
        SELECT unpaid_balance FROM bales_sales_record WHERE unpaid_balance > 0
        UNION ALL
        SELECT unpaid_balance FROM sales_cuplump_record WHERE unpaid_balance > 0
    ) ar
");
$total_receivables = (float) ($ar_row['total'] ?? 0);

// ── Inventory (finished bales) ──
$inv_row = or_fetch_one($con, "
    SELECT
        COALESCE(SUM(remaining_bales * kilo_per_bale), 0) AS total_kg,
        COALESCE(SUM(remaining_bales), 0) AS total_bales,
        COALESCE(SUM(
            (total_production_cost / NULLIF(produce_total_weight, 0)) * remaining_bales * kilo_per_bale
        ), 0) AS est_value
    FROM planta_bales_production
    LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.remaining_bales > 0
");
$inv_total_kg = (float) ($inv_row['total_kg'] ?? 0);
$inv_total_bales = (float) ($inv_row['total_bales'] ?? 0);
$inv_total_value = (float) ($inv_row['est_value'] ?? 0);

// WIP inventory (plant pipeline kg)
$wip_row = or_fetch_one($con, "
    SELECT
        COALESCE(SUM(CASE WHEN status='Field' THEN reweight ELSE 0 END), 0) AS cuplump_kg,
        COALESCE(SUM(CASE WHEN status='Milling' THEN crumbed_weight ELSE 0 END), 0) AS crumb_kg,
        COALESCE(SUM(CASE WHEN status='Drying' THEN dry_weight ELSE 0 END), 0) AS blanket_kg
    FROM planta_recording
    WHERE reweight > 0 OR crumbed_weight > 0 OR dry_weight > 0
");
$wip_total_kg = (float) ($wip_row['cuplump_kg'] ?? 0) + (float) ($wip_row['crumb_kg'] ?? 0) + (float) ($wip_row['blanket_kg'] ?? 0);

// ── Production YTD ──
$prod_row = or_fetch_one($con, "
    SELECT COALESCE(SUM(produce_total_weight), 0) AS total_kg,
           COALESCE(SUM(total_production_cost), 0) AS total_cost
    FROM planta_recording WHERE YEAR(receiving_date) = {$year_sql}
");
$total_production_kg = (float) ($prod_row['total_kg'] ?? 0);
$total_production_cost = (float) ($prod_row['total_cost'] ?? 0);

// Unit cost by source (actual production cost per kg — no arbitrary add-ons)
$unit_costs = [];
$unit_cost_rows = or_fetch_all($con, "
    SELECT TRIM(source) AS source,
           SUM(produce_total_weight) AS produced,
           SUM(total_production_cost) AS cost
    FROM planta_recording
    WHERE YEAR(receiving_date) = {$year_sql} AND produce_total_weight > 0
    GROUP BY TRIM(source)
");
foreach ($unit_cost_rows as $row) {
    $src = $row['source'] ?: 'Unknown';
    $unit_costs[$src] = (float) $row['cost'] / (float) $row['produced'];
}
$avg_unit_cost = $total_production_kg > 0 ? $total_production_cost / $total_production_kg : 0;
$avg_sell_price_kg = $total_sales_kg > 0 ? ($bales_revenue + $cuplump_revenue) / $total_sales_kg : 0;

// ── Source profitability (bales + cuplump merged) ──
$source_performance = [];
$source_rows = or_fetch_all($con, "
    SELECT src, SUM(revenue) AS revenue, SUM(gross_profit) AS gross_profit
    FROM (
        SELECT UPPER(TRIM(source)) AS src,
               SUM(total_sales) AS revenue,
               SUM(gross_profit) AS gross_profit
        FROM bales_sales_record
        WHERE YEAR(transaction_date) = {$year_sql}
        GROUP BY UPPER(TRIM(source))
        UNION ALL
        SELECT UPPER(TRIM(source)) AS src,
               SUM(sales_proceed) AS revenue,
               SUM(gross_profit) AS gross_profit
        FROM sales_cuplump_record
        WHERE YEAR(transaction_date) = {$year_sql}
        GROUP BY UPPER(TRIM(source))
    ) s
    GROUP BY src
    ORDER BY revenue DESC
");
foreach ($source_rows as $row) {
    $src = $row['src'] ?: 'UNKNOWN';
    $rev = (float) $row['revenue'];
    $gp = (float) $row['gross_profit'];
    if (!isset($source_performance[$src])) {
        $source_performance[$src] = ['sales' => 0, 'profit' => 0, 'margin' => 0];
    }
    $source_performance[$src]['sales'] += $rev;
    $source_performance[$src]['profit'] += $gp;
}
foreach ($source_performance as $src => &$perf) {
    $perf['margin'] = $perf['sales'] > 0 ? ($perf['profit'] / $perf['sales']) * 100 : 0;
}
unset($perf);

// ── Top buyers ──
$top_buyers = or_fetch_all($con, "
    SELECT buyer_name, SUM(revenue) AS total_bought
    FROM (
        SELECT buyer_name, total_sales AS revenue FROM bales_sales_record
        WHERE YEAR(transaction_date) = {$year_sql} AND buyer_name IS NOT NULL AND buyer_name != ''
        UNION ALL
        SELECT buyer_name, sales_proceed AS revenue FROM sales_cuplump_record
        WHERE YEAR(transaction_date) = {$year_sql} AND buyer_name IS NOT NULL AND buyer_name != ''
    ) b
    GROUP BY buyer_name
    ORDER BY total_bought DESC
    LIMIT 8
");

// ── Expenses by category (report year) ──
$expenses_by_cat = [];
$exp_cat_rows = or_fetch_all($con, "
    SELECT category, SUM(total_amount) AS amount
    FROM ledger_expenses
    WHERE date REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}'
      AND CAST(LEFT(date, 4) AS UNSIGNED) = {$year_sql}
      AND category IS NOT NULL AND category != ''
    GROUP BY category
");
foreach ($exp_cat_rows as $row) {
    $expenses_by_cat[$row['category']] = (float) $row['amount'];
}
arsort($expenses_by_cat);
$top_expenses = array_slice($expenses_by_cat, 0, 6, true);

// ── Chart arrays ──
$chart_revenue = [];
$chart_profit = [];
$chart_expenses = [];
$chart_production = [];
$chart_sales_kg = [];
$chart_cogs = [];
foreach ($monthly as $m => $d) {
    $chart_revenue[] = round($d['revenue'], 2);
    $chart_profit[] = round($d['gross_profit'], 2);
    $chart_expenses[] = round($d['expenses'], 2);
    $chart_production[] = round($d['production_kg'], 2);
    $chart_sales_kg[] = round($d['sales_kg'], 2);
    $chart_cogs[] = round($d['cogs'] + $d['milling'] + $d['shipping'], 2);
}

// ── Prior-year monthly revenue (benchmark) ──
$prior_year = $year_sql - 1;
$prior_monthly_revenue = array_fill(1, 12, 0.0);
$prior_rows = or_fetch_all($con, "
    SELECT month_num, SUM(revenue) AS revenue FROM (
        SELECT MONTH(transaction_date) AS month_num, SUM(total_sales) AS revenue
        FROM bales_sales_record WHERE YEAR(transaction_date) = {$prior_year}
        GROUP BY MONTH(transaction_date)
        UNION ALL
        SELECT MONTH(transaction_date), SUM(sales_proceed)
        FROM sales_cuplump_record WHERE YEAR(transaction_date) = {$prior_year}
        GROUP BY MONTH(transaction_date)
    ) p GROUP BY month_num
");
foreach ($prior_rows as $row) {
    $m = (int) $row['month_num'];
    if ($m >= 1 && $m <= 12) {
        $prior_monthly_revenue[$m] = (float) $row['revenue'];
    }
}

// ── Forecast & inventory metrics ──
$months_with_sales = array_filter($monthly, fn($d) => $d['revenue'] > 0);
$recent_months = array_slice($months_with_sales, -3, 3, true);
$forecast_revenue = count($recent_months) > 0
    ? array_sum(array_column($recent_months, 'revenue')) / count($recent_months)
    : 0;

$months_elapsed = max(1, (int) date('n'));
if ($report_year < (int) date('Y')) {
    $months_elapsed = 12;
} elseif ($report_year > (int) date('Y')) {
    $months_elapsed = 1;
}
$avg_monthly_sales_kg = $total_sales_kg / $months_elapsed;
$daily_sales_kg = $avg_monthly_sales_kg / 30;
$days_inventory = $daily_sales_kg > 0 ? $inv_total_kg / $daily_sales_kg : 0;

$avg_monthly_production = $total_production_kg / $months_elapsed;
$inventory_net_change = $avg_monthly_production - $avg_monthly_sales_kg;

// ── Action plan (data-driven) ──
$action_plan = [];

if ($net_after_expenses < 0) {
    $action_plan[] = [
        'priority' => 'Critical',
        'issue' => 'Operating loss after expenses',
        'action' => 'Review ledger expenses and low-margin sales contracts. Gross profit does not cover operating costs.',
        'impact' => 'High',
    ];
} elseif ($gross_margin_pct < 5) {
    $action_plan[] = [
        'priority' => 'High',
        'issue' => 'Low gross margin (' . number_format($gross_margin_pct, 1) . '%)',
        'action' => 'Focus on higher-margin cuplump/bale contracts and reduce production unit costs.',
        'impact' => 'High',
    ];
}

if ($total_revenue > 0 && ($total_receivables / $total_revenue) > 0.15) {
    $action_plan[] = [
        'priority' => 'High',
        'issue' => 'High receivables (' . number_format(($total_receivables / $total_revenue) * 100, 1) . '% of revenue)',
        'action' => 'Prioritize collection on outstanding buyer balances.',
        'impact' => 'High',
    ];
}

if ($total_revenue > 0 && ($total_shipping / $total_revenue) > 0.12) {
    $action_plan[] = [
        'priority' => 'Medium',
        'issue' => 'Shipping exceeds 12% of revenue',
        'action' => 'Review freight routes, container utilization, and shipping contracts.',
        'impact' => 'Medium',
    ];
}

if ($inventory_net_change > 50000) {
    $action_plan[] = [
        'priority' => 'Medium',
        'issue' => 'Production outpacing sales (~' . number_format($inventory_net_change, 0) . ' kg/mo)',
        'action' => 'Increase sales push or adjust production scheduling to avoid overstock.',
        'impact' => 'Medium',
    ];
} elseif ($days_inventory > 0 && $days_inventory < 20) {
    $action_plan[] = [
        'priority' => 'Medium',
        'issue' => 'Low bale inventory runway (~' . number_format($days_inventory, 0) . ' days)',
        'action' => 'Ensure milling and bale production keep pace with confirmed orders.',
        'impact' => 'Medium',
    ];
}

// Available years for filter (ignore malformed ledger dates)
$current_yr = (int) date('Y');
$year_options = or_fetch_all($con, "
    SELECT DISTINCT yr FROM (
        SELECT YEAR(transaction_date) AS yr FROM bales_sales_record WHERE transaction_date >= '2020-01-01'
        UNION SELECT YEAR(transaction_date) FROM sales_cuplump_record WHERE transaction_date >= '2020-01-01'
        UNION SELECT CAST(LEFT(date, 4) AS UNSIGNED) FROM ledger_expenses
            WHERE date REGEXP '^[0-9]{4}-' AND CAST(LEFT(date, 4) AS UNSIGNED) BETWEEN 2020 AND {$current_yr}
        UNION SELECT YEAR(receiving_date) FROM planta_recording WHERE receiving_date >= '2020-01-01'
    ) y WHERE yr BETWEEN 2020 AND " . ($current_yr + 1) . " ORDER BY yr DESC
");
if (empty($year_options)) {
    $year_options = [['yr' => (int) date('Y')]];
}
