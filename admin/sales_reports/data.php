<?php
/**
 * Sales Reports — data layer
 */

function sr_month_keys(): array
{
    return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Decem'];
}

function sr_empty_months(): array
{
    return array_fill(1, 12, 0.0);
}

function sr_month_from_key(string $key): int
{
    $map = ['Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6,
        'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Decem' => 12];
    return $map[$key] ?? 0;
}

/** @return array{months: array<int,float>, total: float} */
function sr_row_from_db(?array $row): array
{
    $months = sr_empty_months();
    $total = 0.0;
    if (!$row) {
        return ['months' => $months, 'total' => 0.0];
    }
    foreach (sr_month_keys() as $i => $key) {
        $m = $i + 1;
        $val = isset($row[$key]) ? (float) $row[$key] : 0.0;
        $months[$m] = $val;
    }
    $total = (float) ($row['total'] ?? array_sum($months));
    return ['months' => $months, 'total' => $total];
}

function sr_fetch_one(mysqli $con, string $sql): ?array
{
    $res = mysqli_query($con, $sql);
    if (!$res) {
        return null;
    }
    $row = mysqli_fetch_assoc($res);
    return $row ?: null;
}

function sr_add_months(array $a, array $b): array
{
    $out = sr_empty_months();
    for ($i = 1; $i <= 12; $i++) {
        $out[$i] = ($a[$i] ?? 0) + ($b[$i] ?? 0);
    }
    return $out;
}

function sr_build_report(mysqli $con, int $year): array
{
    $year = max(2020, min($year, (int) date('Y') + 1));
    $prevYear = $year - 1;

    $years = [];
    $yRes = mysqli_query($con, "SELECT DISTINCT YEAR(transaction_date) AS y FROM bales_sales_record
        UNION SELECT DISTINCT YEAR(transaction_date) FROM sales_cuplump_record ORDER BY y DESC");
    if ($yRes) {
        while ($r = mysqli_fetch_assoc($yRes)) {
            if (!empty($r['y'])) {
                $years[] = (int) $r['y'];
            }
        }
    }
    if (empty($years)) {
        $years[] = (int) date('Y');
    }

    $rows = [];
    $netSales = sr_empty_months();
    $totalNetSales = 0.0;

    // ── Sales lines ──
    $salesTypes = ['LOCAL' => 'Bale Local Sales', 'EXPORT' => 'Bale Export Sales'];
    foreach ($salesTypes as $type => $label) {
        $row = sr_fetch_one($con, "SELECT 
            sum(CASE WHEN MONTH(transaction_date)=1 THEN sales_proceed END) AS Jan,
            sum(CASE WHEN MONTH(transaction_date)=2 THEN sales_proceed END) AS Feb,
            sum(CASE WHEN MONTH(transaction_date)=3 THEN sales_proceed END) AS Mar,
            sum(CASE WHEN MONTH(transaction_date)=4 THEN sales_proceed END) AS Apr,
            sum(CASE WHEN MONTH(transaction_date)=5 THEN sales_proceed END) AS May,
            sum(CASE WHEN MONTH(transaction_date)=6 THEN sales_proceed END) AS Jun,
            sum(CASE WHEN MONTH(transaction_date)=7 THEN sales_proceed END) AS Jul,
            sum(CASE WHEN MONTH(transaction_date)=8 THEN sales_proceed END) AS Aug,
            sum(CASE WHEN MONTH(transaction_date)=9 THEN sales_proceed END) AS Sep,
            sum(CASE WHEN MONTH(transaction_date)=10 THEN sales_proceed END) AS Oct,
            sum(CASE WHEN MONTH(transaction_date)=11 THEN sales_proceed END) AS Nov,
            sum(CASE WHEN MONTH(transaction_date)=12 THEN sales_proceed END) AS Decem,
            SUM(sales_proceed) AS total
            FROM bales_sales_record WHERE YEAR(transaction_date)={$year} AND sale_type='{$type}'");
        $parsed = sr_row_from_db($row);
        $rows[] = ['section' => 'sales', 'variant' => 'detail', 'label' => $label, 'months' => $parsed['months'], 'total' => $parsed['total']];
        $netSales = sr_add_months($netSales, $parsed['months']);
        $totalNetSales += $parsed['total'];
    }

    $cuplumpSales = sr_fetch_one($con, "SELECT 
        sum(CASE WHEN MONTH(transaction_date)=1 THEN sales_proceed END) AS Jan,
        sum(CASE WHEN MONTH(transaction_date)=2 THEN sales_proceed END) AS Feb,
        sum(CASE WHEN MONTH(transaction_date)=3 THEN sales_proceed END) AS Mar,
        sum(CASE WHEN MONTH(transaction_date)=4 THEN sales_proceed END) AS Apr,
        sum(CASE WHEN MONTH(transaction_date)=5 THEN sales_proceed END) AS May,
        sum(CASE WHEN MONTH(transaction_date)=6 THEN sales_proceed END) AS Jun,
        sum(CASE WHEN MONTH(transaction_date)=7 THEN sales_proceed END) AS Jul,
        sum(CASE WHEN MONTH(transaction_date)=8 THEN sales_proceed END) AS Aug,
        sum(CASE WHEN MONTH(transaction_date)=9 THEN sales_proceed END) AS Sep,
        sum(CASE WHEN MONTH(transaction_date)=10 THEN sales_proceed END) AS Oct,
        sum(CASE WHEN MONTH(transaction_date)=11 THEN sales_proceed END) AS Nov,
        sum(CASE WHEN MONTH(transaction_date)=12 THEN sales_proceed END) AS Decem,
        SUM(sales_proceed) AS total
        FROM sales_cuplump_record WHERE YEAR(transaction_date)={$year}");
    $cuParsed = sr_row_from_db($cuplumpSales);
    $rows[] = ['section' => 'sales', 'variant' => 'detail', 'label' => 'Cuplump Sales', 'months' => $cuParsed['months'], 'total' => $cuParsed['total']];
    $netSales = sr_add_months($netSales, $cuParsed['months']);
    $totalNetSales += $cuParsed['total'];

    $rows[] = ['section' => 'sales', 'variant' => 'subtotal', 'label' => 'Net Sales', 'months' => $netSales, 'total' => $totalNetSales];

    // ── COGS ──
    $cogs = sr_empty_months();
    $totalCogs = 0.0;
    $rows[] = ['section' => 'cogs', 'variant' => 'header', 'label' => 'COGS', 'months' => sr_empty_months(), 'total' => 0];

    $cogsTypes = ['LOCAL' => 'Bale Local COGS', 'EXPORT' => 'Bale Export COGS'];
    foreach ($cogsTypes as $type => $label) {
        $row = sr_fetch_one($con, "SELECT 
            sum(CASE WHEN MONTH(transaction_date)=1 THEN total_bale_cost END) AS Jan,
            sum(CASE WHEN MONTH(transaction_date)=2 THEN total_bale_cost END) AS Feb,
            sum(CASE WHEN MONTH(transaction_date)=3 THEN total_bale_cost END) AS Mar,
            sum(CASE WHEN MONTH(transaction_date)=4 THEN total_bale_cost END) AS Apr,
            sum(CASE WHEN MONTH(transaction_date)=5 THEN total_bale_cost END) AS May,
            sum(CASE WHEN MONTH(transaction_date)=6 THEN total_bale_cost END) AS Jun,
            sum(CASE WHEN MONTH(transaction_date)=7 THEN total_bale_cost END) AS Jul,
            sum(CASE WHEN MONTH(transaction_date)=8 THEN total_bale_cost END) AS Aug,
            sum(CASE WHEN MONTH(transaction_date)=9 THEN total_bale_cost END) AS Sep,
            sum(CASE WHEN MONTH(transaction_date)=10 THEN total_bale_cost END) AS Oct,
            sum(CASE WHEN MONTH(transaction_date)=11 THEN total_bale_cost END) AS Nov,
            sum(CASE WHEN MONTH(transaction_date)=12 THEN total_bale_cost END) AS Decem,
            SUM(total_bale_cost) AS total
            FROM bales_sales_record WHERE YEAR(transaction_date)={$year} AND sale_type='{$type}'");
        $parsed = sr_row_from_db($row);
        $rows[] = ['section' => 'cogs', 'variant' => 'detail', 'label' => $label, 'months' => $parsed['months'], 'total' => $parsed['total']];
        $cogs = sr_add_months($cogs, $parsed['months']);
        $totalCogs += $parsed['total'];
    }

    $cuCogs = sr_fetch_one($con, "SELECT 
        sum(CASE WHEN MONTH(transaction_date)=1 THEN total_cuplump_cost END) AS Jan,
        sum(CASE WHEN MONTH(transaction_date)=2 THEN total_cuplump_cost END) AS Feb,
        sum(CASE WHEN MONTH(transaction_date)=3 THEN total_cuplump_cost END) AS Mar,
        sum(CASE WHEN MONTH(transaction_date)=4 THEN total_cuplump_cost END) AS Apr,
        sum(CASE WHEN MONTH(transaction_date)=5 THEN total_cuplump_cost END) AS May,
        sum(CASE WHEN MONTH(transaction_date)=6 THEN total_cuplump_cost END) AS Jun,
        sum(CASE WHEN MONTH(transaction_date)=7 THEN total_cuplump_cost END) AS Jul,
        sum(CASE WHEN MONTH(transaction_date)=8 THEN total_cuplump_cost END) AS Aug,
        sum(CASE WHEN MONTH(transaction_date)=9 THEN total_cuplump_cost END) AS Sep,
        sum(CASE WHEN MONTH(transaction_date)=10 THEN total_cuplump_cost END) AS Oct,
        sum(CASE WHEN MONTH(transaction_date)=11 THEN total_cuplump_cost END) AS Nov,
        sum(CASE WHEN MONTH(transaction_date)=12 THEN total_cuplump_cost END) AS Decem,
        SUM(total_cuplump_cost) AS total
        FROM sales_cuplump_record WHERE YEAR(transaction_date)={$year}");
    $cuCogsParsed = sr_row_from_db($cuCogs);
    $rows[] = ['section' => 'cogs', 'variant' => 'detail', 'label' => 'Cuplump COGS', 'months' => $cuCogsParsed['months'], 'total' => $cuCogsParsed['total']];
    $cogs = sr_add_months($cogs, $cuCogsParsed['months']);
    $totalCogs += $cuCogsParsed['total'];
    $rows[] = ['section' => 'cogs', 'variant' => 'subtotal', 'label' => 'Total COGS', 'months' => $cogs, 'total' => $totalCogs];

    // ── Milling ──
    $millingRow = sr_fetch_one($con, "SELECT 
        sum(CASE WHEN MONTH(transaction_date)=1 THEN total_milling_cost END) AS Jan,
        sum(CASE WHEN MONTH(transaction_date)=2 THEN total_milling_cost END) AS Feb,
        sum(CASE WHEN MONTH(transaction_date)=3 THEN total_milling_cost END) AS Mar,
        sum(CASE WHEN MONTH(transaction_date)=4 THEN total_milling_cost END) AS Apr,
        sum(CASE WHEN MONTH(transaction_date)=5 THEN total_milling_cost END) AS May,
        sum(CASE WHEN MONTH(transaction_date)=6 THEN total_milling_cost END) AS Jun,
        sum(CASE WHEN MONTH(transaction_date)=7 THEN total_milling_cost END) AS Jul,
        sum(CASE WHEN MONTH(transaction_date)=8 THEN total_milling_cost END) AS Aug,
        sum(CASE WHEN MONTH(transaction_date)=9 THEN total_milling_cost END) AS Sep,
        sum(CASE WHEN MONTH(transaction_date)=10 THEN total_milling_cost END) AS Oct,
        sum(CASE WHEN MONTH(transaction_date)=11 THEN total_milling_cost END) AS Nov,
        sum(CASE WHEN MONTH(transaction_date)=12 THEN total_milling_cost END) AS Decem,
        SUM(total_milling_cost) AS total
        FROM bales_sales_record WHERE YEAR(transaction_date)={$year}");
    $milling = sr_row_from_db($millingRow);
    $monthMilling = $milling['months'];
    $totalMillingCost = $milling['total'];
    $rows[] = ['section' => 'cogs', 'variant' => 'detail', 'label' => 'Milling Cost', 'months' => $monthMilling, 'total' => $totalMillingCost];

    // ── Shipping ──
    $rows[] = ['section' => 'shipping', 'variant' => 'header', 'label' => 'Shipping Expenses', 'months' => sr_empty_months(), 'total' => 0];

    $shipFields = [
        'freight' => 'Freight (All In)',
        'loading_unloading' => 'Loading & Unloading',
        'processing_fee' => 'Processing Fee (Phytosanitary)',
        'trucking_expense' => 'Trucking Expense',
        'cranage_fee' => 'Cranage Fee',
        'miscellaneous' => 'Miscellaneous',
    ];

    foreach ($shipFields as $field => $label) {
        $row = sr_fetch_one($con, "SELECT 
            sum(CASE WHEN MONTH(ship_date)=1 THEN {$field} END) AS Jan,
            sum(CASE WHEN MONTH(ship_date)=2 THEN {$field} END) AS Feb,
            sum(CASE WHEN MONTH(ship_date)=3 THEN {$field} END) AS Mar,
            sum(CASE WHEN MONTH(ship_date)=4 THEN {$field} END) AS Apr,
            sum(CASE WHEN MONTH(ship_date)=5 THEN {$field} END) AS May,
            sum(CASE WHEN MONTH(ship_date)=6 THEN {$field} END) AS Jun,
            sum(CASE WHEN MONTH(ship_date)=7 THEN {$field} END) AS Jul,
            sum(CASE WHEN MONTH(ship_date)=8 THEN {$field} END) AS Aug,
            sum(CASE WHEN MONTH(ship_date)=9 THEN {$field} END) AS Sep,
            sum(CASE WHEN MONTH(ship_date)=10 THEN {$field} END) AS Oct,
            sum(CASE WHEN MONTH(ship_date)=11 THEN {$field} END) AS Nov,
            sum(CASE WHEN MONTH(ship_date)=12 THEN {$field} END) AS Decem,
            SUM({$field}) AS total
            FROM (
                SELECT ship_date, {$field} FROM sales_cuplump_shipment WHERE YEAR(ship_date)={$year}
                UNION ALL
                SELECT ship_date, {$field} FROM bale_shipment_record WHERE YEAR(ship_date)={$year}
            ) AS combined");
        $parsed = sr_row_from_db($row);
        $rows[] = ['section' => 'shipping', 'variant' => 'detail', 'label' => $label, 'months' => $parsed['months'], 'total' => $parsed['total']];
    }

    $shipTotalRow = sr_fetch_one($con, "SELECT 
        sum(CASE WHEN MONTH(ship_date)=1 THEN total_shipping_expense END) AS Jan,
        sum(CASE WHEN MONTH(ship_date)=2 THEN total_shipping_expense END) AS Feb,
        sum(CASE WHEN MONTH(ship_date)=3 THEN total_shipping_expense END) AS Mar,
        sum(CASE WHEN MONTH(ship_date)=4 THEN total_shipping_expense END) AS Apr,
        sum(CASE WHEN MONTH(ship_date)=5 THEN total_shipping_expense END) AS May,
        sum(CASE WHEN MONTH(ship_date)=6 THEN total_shipping_expense END) AS Jun,
        sum(CASE WHEN MONTH(ship_date)=7 THEN total_shipping_expense END) AS Jul,
        sum(CASE WHEN MONTH(ship_date)=8 THEN total_shipping_expense END) AS Aug,
        sum(CASE WHEN MONTH(ship_date)=9 THEN total_shipping_expense END) AS Sep,
        sum(CASE WHEN MONTH(ship_date)=10 THEN total_shipping_expense END) AS Oct,
        sum(CASE WHEN MONTH(ship_date)=11 THEN total_shipping_expense END) AS Nov,
        sum(CASE WHEN MONTH(ship_date)=12 THEN total_shipping_expense END) AS Decem,
        SUM(total_shipping_expense) AS total
        FROM (
            SELECT ship_date, total_shipping_expense FROM bale_shipment_record WHERE YEAR(ship_date)={$year}
            UNION ALL
            SELECT ship_date, total_shipping_expense FROM sales_cuplump_shipment WHERE YEAR(ship_date)={$year}
        ) AS combined");
    $shipping = sr_row_from_db($shipTotalRow);
    $monthTotalShip = $shipping['months'];
    $totalShipping = $shipping['total'];
    $rows[] = ['section' => 'shipping', 'variant' => 'subtotal', 'label' => 'Total Shipping Expense', 'months' => $monthTotalShip, 'total' => $totalShipping];

    // ── Gross profit ──
    $grossProfit = sr_empty_months();
    for ($i = 1; $i <= 12; $i++) {
        $grossProfit[$i] = $netSales[$i] - $cogs[$i] - $monthMilling[$i] - $monthTotalShip[$i];
    }
    $totalGrossProfit = $totalNetSales - $totalCogs - $totalMillingCost - $totalShipping;
    $rows[] = ['section' => 'profit', 'variant' => 'total', 'label' => 'Gross Profit Sales', 'months' => $grossProfit, 'total' => $totalGrossProfit];

    // ── Extended KPIs ──
    $prevNet = sr_fetch_one($con, "SELECT SUM(v) AS total FROM (
        SELECT SUM(sales_proceed) AS v FROM bales_sales_record WHERE YEAR(transaction_date)={$prevYear}
        UNION ALL SELECT SUM(sales_proceed) FROM sales_cuplump_record WHERE YEAR(transaction_date)={$prevYear}
    ) t");
    $prevNetTotal = (float) ($prevNet['total'] ?? 0);
    $yoyGrowth = $prevNetTotal > 0 ? (($totalNetSales - $prevNetTotal) / $prevNetTotal) * 100 : null;

    $recvBales = sr_fetch_one($con, "SELECT SUM(unpaid_balance) AS t FROM bales_sales_record WHERE YEAR(transaction_date)={$year} AND unpaid_balance > 0");
    $recvCu = sr_fetch_one($con, "SELECT SUM(unpaid_balance) AS t FROM sales_cuplump_record WHERE YEAR(transaction_date)={$year} AND unpaid_balance > 0");
    $receivables = max(0, (float) ($recvBales['t'] ?? 0)) + max(0, (float) ($recvCu['t'] ?? 0));

    $localTotal = 0.0;
    $exportTotal = 0.0;
    foreach ($rows as $r) {
        if ($r['label'] === 'Bale Local Sales') {
            $localTotal = $r['total'];
        }
        if ($r['label'] === 'Bale Export Sales') {
            $exportTotal = $r['total'];
        }
    }

    $highestMonth = 1;
    $highestProfit = $grossProfit[1];
    for ($i = 2; $i <= 12; $i++) {
        if ($grossProfit[$i] > $highestProfit) {
            $highestProfit = $grossProfit[$i];
            $highestMonth = $i;
        }
    }

    $marginPct = $totalNetSales > 0 ? ($totalGrossProfit / $totalNetSales) * 100 : 0;

    $monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $monthlyCards = [];
    for ($i = 1; $i <= 12; $i++) {
        $rev = $netSales[$i];
        $profit = $grossProfit[$i];
        $monthlyCards[] = [
            'month' => $i,
            'label' => $monthLabels[$i - 1],
            'net_sales' => $rev,
            'gross_profit' => $profit,
            'margin_pct' => $rev > 0 ? ($profit / $rev) * 100 : 0,
        ];
    }

    return [
        'year' => $year,
        'prev_year' => $prevYear,
        'years' => $years,
        'rows' => $rows,
        'net_sales' => $netSales,
        'gross_profit' => $grossProfit,
        'summary' => [
            'net_sales' => $totalNetSales,
            'gross_profit' => $totalGrossProfit,
            'cogs' => $totalCogs,
            'milling' => $totalMillingCost,
            'shipping' => $totalShipping,
            'margin_pct' => $marginPct,
            'receivables' => $receivables,
            'local_sales' => $localTotal,
            'export_sales' => $exportTotal,
            'cuplump_sales' => $cuParsed['total'],
            'yoy_growth' => $yoyGrowth,
            'prev_net_sales' => $prevNetTotal,
            'highest_month' => $monthLabels[$highestMonth - 1],
            'highest_profit' => $highestProfit,
        ],
        'monthly_cards' => $monthlyCards,
        'chart' => [
            'labels' => $monthLabels,
            'net_sales' => array_values($netSales),
            'gross_profit' => array_values($grossProfit),
            'cost_split' => [
                'cogs' => $totalCogs,
                'milling' => $totalMillingCost,
                'shipping' => $totalShipping,
                'profit' => max(0, $totalGrossProfit),
            ],
        ],
    ];
}
