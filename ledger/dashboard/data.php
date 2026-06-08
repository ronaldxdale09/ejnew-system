<?php
/**
 * Ledger dashboard — aggregated metrics & chart data
 */

function ledger_dash_scalar(mysqli $con, string $sql): float
{
    $res = mysqli_query($con, $sql);
    if (!$res) {
        return 0.0;
    }
    $row = mysqli_fetch_assoc($res);
    if (!$row) {
        return 0.0;
    }
    return (float) (reset($row) ?: 0);
}

function ledger_dash_count(mysqli $con, string $sql): int
{
    return (int) ledger_dash_scalar($con, $sql);
}

function ledger_dash_month_series(mysqli $con, string $sql): array
{
    $labels = [];
    $values = [];
    $res = mysqli_query($con, $sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $labels[] = $row['label'] ?? '';
            $values[] = (float) ($row['total'] ?? 0);
        }
    }
    return ['labels' => $labels, 'values' => $values];
}

function ledger_dashboard_data(mysqli $con, string $location): array
{
    $loc = mysqli_real_escape_string($con, $location);
    $year = (int) date('Y');
    $month = (int) date('m');

    // ── KPIs (current month, location-scoped where applicable) ──
    $expenseMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_expenses
        WHERE location='{$loc}' AND MONTH(`date`)={$month} AND YEAR(`date`)={$year}");
    $expenseToday = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_expenses
        WHERE location='{$loc}' AND DATE(`date`)=CURDATE()");
    $expenseYear = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_expenses
        WHERE location='{$loc}' AND YEAR(`date`)={$year}");

    $purchaseMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase
        WHERE location='{$loc}' AND MONTH(`date`)={$month} AND YEAR(`date`)={$year}");
    $purchaseToday = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase
        WHERE location='{$loc}' AND DATE(`date`)=CURDATE()");
    $purchaseYear = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase
        WHERE location='{$loc}' AND YEAR(`date`)={$year}");

    $maloongMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(ejn_total),0) FROM ledger_maloong
        WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}");
    $maloongYear = ledger_dash_scalar($con, "SELECT COALESCE(SUM(ejn_total),0) FROM ledger_maloong WHERE YEAR(`date`)={$year}");

    $buahanMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(ejn_total),0) FROM ledger_buahantoppers
        WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}");
    $buahanYear = ledger_dash_scalar($con, "SELECT COALESCE(SUM(ejn_total),0) FROM ledger_buahantoppers WHERE YEAR(`date`)={$year}");

    $caMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(amount),0) FROM ledger_cashadvance
        WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}");
    $caToday = ledger_dash_scalar($con, "SELECT COALESCE(SUM(amount),0) FROM ledger_cashadvance WHERE DATE(`date`)=CURDATE()");
    $caPending = ledger_dash_count($con, "SELECT COUNT(*) FROM ledger_cashadvance WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}");

    $coffeeMonth = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM coffee_sale
        WHERE MONTH(sale_date)={$month} AND YEAR(sale_date)={$year}");
    $coffeeYear = ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM coffee_sale WHERE YEAR(sale_date)={$year}");

    // ── Charts ──
    $monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $expenseMonthly = array_fill(0, 12, 0.0);
    $purchaseMonthly = array_fill(0, 12, 0.0);
    $maloongMonthly = array_fill(0, 12, 0.0);
    $buahanMonthly = array_fill(0, 12, 0.0);

    $res = mysqli_query($con, "SELECT MONTH(`date`) AS m, SUM(total_amount) AS t FROM ledger_expenses
        WHERE location='{$loc}' AND YEAR(`date`)={$year} GROUP BY MONTH(`date`)");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $expenseMonthly[(int) $r['m'] - 1] = (float) $r['t'];
        }
    }
    $res = mysqli_query($con, "SELECT MONTH(`date`) AS m, SUM(total_amount) AS t FROM ledger_purchase
        WHERE location='{$loc}' AND YEAR(`date`)={$year} GROUP BY MONTH(`date`)");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $purchaseMonthly[(int) $r['m'] - 1] = (float) $r['t'];
        }
    }
    $res = mysqli_query($con, "SELECT MONTH(`date`) AS m, SUM(ejn_total) AS t FROM ledger_maloong
        WHERE YEAR(`date`)={$year} GROUP BY MONTH(`date`)");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $maloongMonthly[(int) $r['m'] - 1] = (float) $r['t'];
        }
    }
    $res = mysqli_query($con, "SELECT MONTH(`date`) AS m, SUM(ejn_total) AS t FROM ledger_buahantoppers
        WHERE YEAR(`date`)={$year} GROUP BY MONTH(`date`)");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $buahanMonthly[(int) $r['m'] - 1] = (float) $r['t'];
        }
    }

    // Expense by category (YTD)
    $expenseCategories = ['labels' => [], 'values' => []];
    $res = mysqli_query($con, "SELECT category, SUM(total_amount) AS t FROM ledger_expenses
        WHERE location='{$loc}' AND YEAR(`date`)={$year} GROUP BY category ORDER BY t DESC LIMIT 8");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $expenseCategories['labels'][] = $r['category'] ?: 'Uncategorized';
            $expenseCategories['values'][] = (float) $r['t'];
        }
    }

    // Cash advance by station (YTD)
    $caStations = ['labels' => [], 'values' => []];
    $res = mysqli_query($con, "SELECT buying_station, SUM(amount) AS t FROM ledger_cashadvance
        WHERE YEAR(`date`)={$year} AND buying_station IS NOT NULL AND buying_station != ''
        GROUP BY buying_station ORDER BY t DESC LIMIT 8");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $caStations['labels'][] = $r['buying_station'];
            $caStations['values'][] = (float) $r['t'];
        }
    }

    // Purchase by category (YTD)
    $purchaseCategories = ['labels' => [], 'values' => []];
    $res = mysqli_query($con, "SELECT category, SUM(total_amount) AS t FROM ledger_purchase
        WHERE location='{$loc}' AND YEAR(`date`)={$year} GROUP BY category ORDER BY t DESC LIMIT 8");
    if ($res) {
        while ($r = mysqli_fetch_assoc($res)) {
            $purchaseCategories['labels'][] = $r['category'] ?: 'Uncategorized';
            $purchaseCategories['values'][] = (float) $r['t'];
        }
    }

    return [
        'year' => $year,
        'month_label' => date('F'),
        'kpis' => [
            'expense_today' => $expenseToday,
            'expense_month' => $expenseMonth,
            'expense_year' => $expenseYear,
            'purchase_today' => $purchaseToday,
            'purchase_month' => $purchaseMonth,
            'purchase_year' => $purchaseYear,
            'maloong_month' => $maloongMonth,
            'maloong_year' => $maloongYear,
            'buahan_month' => $buahanMonth,
            'buahan_year' => $buahanYear,
            'ca_today' => $caToday,
            'ca_month' => $caMonth,
            'ca_count' => $caPending,
            'coffee_month' => $coffeeMonth,
            'coffee_year' => $coffeeYear,
        ],
        'charts' => [
            'month_labels' => $monthNames,
            'expenses' => $expenseMonthly,
            'purchases' => $purchaseMonthly,
            'maloong' => $maloongMonthly,
            'buahan' => $buahanMonthly,
            'expense_categories' => $expenseCategories,
            'ca_stations' => $caStations,
            'purchase_categories' => $purchaseCategories,
        ],
    ];
}

function ledger_ca_kpis(mysqli $con): array
{
    $year = (int) date('Y');
    $month = (int) date('m');
    return [
        'today' => ledger_dash_scalar($con, 'SELECT COALESCE(SUM(amount),0) FROM ledger_cashadvance WHERE DATE(`date`)=CURDATE()'),
        'month' => ledger_dash_scalar($con, "SELECT COALESCE(SUM(amount),0) FROM ledger_cashadvance WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'count_year' => ledger_dash_count($con, "SELECT COUNT(*) FROM ledger_cashadvance WHERE YEAR(`date`)={$year}"),
    ];
}

function ledger_purchase_kpis(mysqli $con, string $location): array
{
    $loc = mysqli_real_escape_string($con, $location);
    $year = (int) date('Y');
    $month = (int) date('m');
    return [
        'today' => ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase WHERE location='{$loc}' AND DATE(`date`)=CURDATE()"),
        'month' => ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase WHERE location='{$loc}' AND MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'year' => ledger_dash_scalar($con, "SELECT COALESCE(SUM(total_amount),0) FROM ledger_purchase WHERE location='{$loc}' AND YEAR(`date`)={$year}"),
    ];
}

function ledger_topper_kpis(mysqli $con, string $table): array
{
    $table = $table === 'buahan' ? 'ledger_buahantoppers' : 'ledger_maloong';
    $grossCol = $table === 'ledger_maloong' ? 'topper_gross' : 'gross_amount';
    $year = (int) date('Y');
    $month = (int) date('m');
    $prevMonth = $month === 1 ? 12 : $month - 1;
    $prevYear = $month === 1 ? $year - 1 : $year;

    $cur = fn($sql) => ledger_dash_scalar($con, $sql);
    $cnt = fn($sql) => ledger_dash_count($con, $sql);

    return [
        'transactions' => $cnt("SELECT COUNT(*) FROM {$table} WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'transactions_prev' => $cnt("SELECT COUNT(*) FROM {$table} WHERE MONTH(`date`)={$prevMonth} AND YEAR(`date`)={$prevYear}"),
        'kilos' => $cur("SELECT COALESCE(SUM(net_kilos),0) FROM {$table} WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'kilos_prev' => $cur("SELECT COALESCE(SUM(net_kilos),0) FROM {$table} WHERE MONTH(`date`)={$prevMonth} AND YEAR(`date`)={$prevYear}"),
        'ejn_revenue' => $cur("SELECT COALESCE(SUM(ejn_total),0) FROM {$table} WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'ejn_revenue_prev' => $cur("SELECT COALESCE(SUM(ejn_total),0) FROM {$table} WHERE MONTH(`date`)={$prevMonth} AND YEAR(`date`)={$prevYear}"),
        'topper_gross' => $cur("SELECT COALESCE(SUM({$grossCol}),0) FROM {$table} WHERE MONTH(`date`)={$month} AND YEAR(`date`)={$year}"),
        'topper_gross_prev' => $cur("SELECT COALESCE(SUM({$grossCol}),0) FROM {$table} WHERE MONTH(`date`)={$prevMonth} AND YEAR(`date`)={$prevYear}"),
    ];
}

function ledger_empty_table_row(int $cols, string $msg = 'No records found.'): string
{
    return '<tr><td colspan="' . $cols . '" class="text-center text-muted py-3">' . adm_esc($msg) . '</td></tr>';
}
