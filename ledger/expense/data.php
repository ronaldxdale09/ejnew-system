<?php
/**
 * Ledger expense KPIs
 */

function ledger_expense_kpis(mysqli $con, string $location): array
{
    $location = mysqli_real_escape_string($con, $location);
    $currentMonth = (int) date('m');
    $currentYear = (int) date('Y');

    $today = 0.0;
    $res = mysqli_query($con, "SELECT COALESCE(SUM(total_amount), 0) AS t FROM ledger_expenses
        WHERE location='{$location}' AND DATE(`date`) = CURDATE()");
    if ($res && ($row = mysqli_fetch_assoc($res))) {
        $today = (float) $row['t'];
    }

    $month = 0.0;
    $res = mysqli_query($con, "SELECT COALESCE(SUM(total_amount), 0) AS t FROM ledger_expenses
        WHERE location='{$location}' AND MONTH(`date`) = {$currentMonth} AND YEAR(`date`) = {$currentYear}");
    if ($res && ($row = mysqli_fetch_assoc($res))) {
        $month = (float) $row['t'];
    }

    $year = 0.0;
    $res = mysqli_query($con, "SELECT COALESCE(SUM(total_amount), 0) AS t FROM ledger_expenses
        WHERE location='{$location}' AND YEAR(`date`) = {$currentYear}");
    if ($res && ($row = mysqli_fetch_assoc($res))) {
        $year = (float) $row['t'];
    }

    $countToday = 0;
    $res = mysqli_query($con, "SELECT COUNT(*) AS c FROM ledger_expenses
        WHERE location='{$location}' AND DATE(`date`) = CURDATE()");
    if ($res && ($row = mysqli_fetch_assoc($res))) {
        $countToday = (int) $row['c'];
    }

    return [
        'today' => $today,
        'month' => $month,
        'year' => $year,
        'count_today' => $countToday,
        'month_label' => date('F'),
        'year_label' => (string) $currentYear,
    ];
}

function ledger_expense_categories(mysqli $con, string $location): array
{
    $location = mysqli_real_escape_string($con, $location);
    $items = [];
    $res = mysqli_query($con, "SELECT id, category FROM category_expenses WHERE source='{$location}' ORDER BY category ASC");
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
    }
    return $items;
}

function ledger_expense_types(): array
{
    return [
        'Administrative Expenses' => 'Administrative',
        'Rubber Plant & Production' => 'Production',
        'RTL' => 'RTL',
        'Personal Expenses' => 'Personal',
        'Rubber Expenses' => 'Rubber',
        'Coffee Expenses' => 'Coffee',
        'Copra Expenses' => 'Copra',
        'NTC Expenses' => 'NTC',
        'Other Expenses' => 'Others',
    ];
}
