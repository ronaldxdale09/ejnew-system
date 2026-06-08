<?php
/**
 * Copra purchase record — KPI metrics.
 * @return array<string, mixed>
 */
function copra_record_kpis(mysqli $con, ?int $year = null): array
{
    $year = $year ?? (int) date('Y');
    $yearEsc = (int) $year;
    $month = (int) date('n');

    $defaults = [
        'year' => $yearEsc,
        'total_purchase' => 0,
        'total_weight' => 0,
        'avg_purchase' => 0,
        'avg_per_kg' => 0,
        'total_tax' => 0,
        'total_transactions' => 0,
        'month_purchase' => 0,
        'month_transactions' => 0,
        'recent_amount' => 0,
        'recent_date' => '',
        'pending_ca_count' => 0,
        'outstanding_ca' => 0,
    ];

    $q = mysqli_query($con, "SELECT 
        COALESCE(SUM(amount_paid), 0) AS total_purchase,
        COALESCE(SUM(rese_weight_1 + rese_weight_2), 0) AS total_weight,
        COALESCE(AVG(amount_paid), 0) AS avg_purchase,
        COALESCE(SUM(tax_amount), 0) AS total_tax,
        COUNT(*) AS total_transactions
        FROM copra_transaction WHERE YEAR(date) = {$yearEsc}");
    if ($q && ($row = mysqli_fetch_assoc($q))) {
        $defaults = array_merge($defaults, $row);
        $weight = (float) ($row['total_weight'] ?? 0);
        $defaults['avg_per_kg'] = $weight > 0 ? ((float) $row['total_purchase'] / $weight) : 0;
    }

    $qMonth = mysqli_query($con, "SELECT COALESCE(SUM(amount_paid), 0) AS month_purchase, COUNT(*) AS month_transactions
        FROM copra_transaction WHERE YEAR(date) = {$yearEsc} AND MONTH(date) = {$month}");
    if ($qMonth && ($m = mysqli_fetch_assoc($qMonth))) {
        $defaults['month_purchase'] = $m['month_purchase'];
        $defaults['month_transactions'] = $m['month_transactions'];
    }

    $qRecent = mysqli_query($con, "SELECT amount_paid, date FROM copra_transaction ORDER BY date DESC, id DESC LIMIT 1");
    if ($qRecent && ($r = mysqli_fetch_assoc($qRecent))) {
        $defaults['recent_amount'] = $r['amount_paid'];
        $defaults['recent_date'] = $r['date'];
    }

    $qCa = mysqli_query($con, "SELECT COUNT(*) AS pending_ca_count FROM copra_cashadvance WHERE status = 'PENDING'");
    if ($qCa && ($ca = mysqli_fetch_assoc($qCa))) {
        $defaults['pending_ca_count'] = (int) $ca['pending_ca_count'];
    }

    $qOut = mysqli_query($con, "SELECT COALESCE(SUM(cash_advance), 0) AS outstanding_ca FROM copra_seller");
    if ($qOut && ($o = mysqli_fetch_assoc($qOut))) {
        $defaults['outstanding_ca'] = $o['outstanding_ca'];
    }

    return $defaults;
}

function copra_record_years(mysqli $con): array
{
    $years = [];
    $q = mysqli_query($con, "SELECT DISTINCT YEAR(date) AS y FROM copra_transaction WHERE date IS NOT NULL ORDER BY y DESC");
    if ($q) {
        while ($row = mysqli_fetch_assoc($q)) {
            if (!empty($row['y'])) {
                $years[] = (int) $row['y'];
            }
        }
    }
    if (empty($years)) {
        $years[] = (int) date('Y');
    }
    return $years;
}

function copra_record_sellers(mysqli $con): array
{
    $sellers = [];
    $q = mysqli_query($con, "SELECT name, code FROM copra_seller ORDER BY name ASC");
    if ($q) {
        while ($row = mysqli_fetch_assoc($q)) {
            $sellers[] = $row;
        }
    }
    return $sellers;
}
