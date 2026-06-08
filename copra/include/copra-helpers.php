<?php
/**
 * Copra UI helpers — extends admin design system
 */
require_once __DIR__ . '/../../admin/include/adm-helpers.php';

if (!function_exists('copra_logout_url')) {
    function copra_logout_url(): string
    {
        return 'function/logout.php';
    }
}

if (!function_exists('copra_require_auth')) {
    function copra_require_auth(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . copra_logout_url());
            exit();
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'copra') {
            header('Location: ' . copra_logout_url());
            exit();
        }
    }
}

if (!function_exists('copra_nav_active')) {
    function copra_nav_active($pages, string $currentPage): string
    {
        return in_array($currentPage, (array) $pages, true) ? ' active' : '';
    }
}

if (!function_exists('copra_resolve_topbar_title')) {
    function copra_resolve_topbar_title(string $currentPage): string
    {
        if (!empty($GLOBALS['copra_topbar_title'])) {
            return (string) $GLOBALS['copra_topbar_title'];
        }
        $map = [
            'transaction.php' => 'Purchase Entry',
            'transaction_history.php' => 'Transaction Record',
            'seller.php' => 'Sellers',
            'seller_profile.php' => 'Seller Profile',
            'contract-purchase.php' => 'Purchase Contract',
            'copra-ca.php' => 'Cash Advance',
            'dashboard.php' => 'Home',
        ];
        return $map[$currentPage] ?? 'EJN Copra';
    }
}

if (!function_exists('copra_shell_open')) {
    function copra_shell_open(string $title, string $subtitle = '', array $badges = []): void
    {
        echo '<div class="main-content admin-page copra-page">';
        adm_page_header($title, $subtitle, $badges);
    }
}

if (!function_exists('copra_page_begin')) {
    function copra_page_begin(string $title, string $subtitle = '', string $panelTitle = ''): void
    {
        copra_shell_open($title, $subtitle);
        if ($panelTitle !== '') {
            adm_panel_open($panelTitle);
            $GLOBALS['copra_panel_open'] = true;
        } else {
            $GLOBALS['copra_panel_open'] = false;
        }
    }
}

if (!function_exists('copra_page_end')) {
    function copra_page_end(bool $closePanel = true): void
    {
        if ($closePanel && !empty($GLOBALS['copra_panel_open'])) {
            adm_panel_close();
            $GLOBALS['copra_panel_open'] = false;
        }
        copra_shell_close();
    }
}

if (!function_exists('copra_kpi_row')) {
    function copra_kpi_row(array $items): void
    {
        echo '<div class="adm-kpi-grid">';
        foreach ($items as $item) {
            $variant = $item['variant'] ?? '';
            $class = $variant ? ' adm-kpi--' . $variant : '';
            echo '<div class="adm-kpi' . $class . '">';
            echo '<div class="adm-kpi__label">' . adm_esc($item['label'] ?? '') . '</div>';
            echo '<div class="adm-kpi__value">' . ($item['value'] ?? '') . '</div>';
            if (!empty($item['sub'])) {
                echo '<div class="adm-kpi__sub">' . adm_esc($item['sub']) . '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
}

if (!function_exists('copra_shell_close')) {
    function copra_shell_close(): void
    {
        echo '</div></body></html>';
    }
}

if (!function_exists('copra_contract_status_badge')) {
    function copra_contract_status_badge(string $status): string
    {
        $map = [
            'PENDING' => 'warning',
            'UPDATED' => 'primary',
            'COMPLETED' => 'success',
        ];
        $class = $map[$status] ?? 'secondary';
        $label = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
        return '<span class="badge bg-' . $class . '">' . $label . '</span>';
    }
}

if (!function_exists('copra_seller_options')) {
    function copra_seller_options(mysqli $con): string
    {
        $html = '';
        $result = mysqli_query($con, 'SELECT name, code FROM copra_seller ORDER BY name ASC');
        if (!$result) {
            return $html;
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $name = htmlspecialchars($row['name'] ?? '', ENT_QUOTES, 'UTF-8');
            $code = htmlspecialchars($row['code'] ?? '', ENT_QUOTES, 'UTF-8');
            if ($name !== '') {
                $html .= '<option value="' . $name . '">[ ' . $code . ' ] ' . $name . '</option>';
            }
        }
        return $html;
    }
}

if (!function_exists('copra_next_seller_code')) {
    function copra_next_seller_code(mysqli $con): string
    {
        $get = mysqli_query($con, 'SELECT COUNT(*) AS total FROM copra_seller');
        $row = mysqli_fetch_array($get);
        $seq = sprintf("%'03d", intval($row[0] ?? 0) + 1);
        return date('Y') . '-' . $seq;
    }
}

if (!function_exists('copra_format_money')) {
    function copra_format_money($value, int $decimals = 2): string
    {
        return '₱ ' . number_format(floatval($value ?? 0), $decimals);
    }
}

if (!function_exists('copra_format_kg')) {
    function copra_format_kg($value, int $decimals = 0): string
    {
        return number_format(floatval($value ?? 0), $decimals) . ' kg';
    }
}

if (!function_exists('copra_ca_category_label')) {
    function copra_ca_category_label(string $category): string
    {
        $map = [
            'copra' => 'Copra',
            'ntc' => 'NTC',
            'trucking' => 'Trucking',
            'others' => 'Others',
            'other' => 'Others',
        ];
        $key = strtolower(trim($category));
        return $map[$key] ?? ucfirst($category);
    }
}

if (!function_exists('copra_ca_category_badge')) {
    function copra_ca_category_badge(string $category): string
    {
        $map = [
            'copra' => 'primary',
            'ntc' => 'info',
            'trucking' => 'warning',
            'others' => 'secondary',
            'other' => 'secondary',
        ];
        $key = strtolower(trim($category));
        $class = $map[$key] ?? 'secondary';
        $label = htmlspecialchars(copra_ca_category_label($category), ENT_QUOTES, 'UTF-8');
        return '<span class="badge bg-' . $class . '">' . $label . '</span>';
    }
}

if (!function_exists('copra_dashboard_stats')) {
    function copra_dashboard_stats(mysqli $con): array
    {
        $year = (int) date('Y');
        $month = (int) date('m');
        $periodLabel = date('F Y');

        $stats = [
            'period_label' => $periodLabel,
            'month_labels' => [],
            'month_kg' => [],
            'month_amount' => [],
        ];

        $q = mysqli_query(
            $con,
            "SELECT MONTHNAME(date) AS monthname,
                    MONTH(date) AS month_num,
                    SUM(net_res) AS month_kg,
                    SUM(amount_paid) AS month_amount
             FROM copra_transaction
             WHERE YEAR(date) = '$year'
             GROUP BY MONTH(date), MONTHNAME(date)
             ORDER BY month_num ASC"
        );
        if ($q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $stats['month_labels'][] = $row['monthname'] ?? '';
                $stats['month_kg'][] = floatval($row['month_kg'] ?? 0);
                $stats['month_amount'][] = floatval($row['month_amount'] ?? 0);
            }
        }

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COUNT(*) AS total_tx,
                    SUM(amount_paid) AS total_paid,
                    SUM(net_res) AS total_kg,
                    SUM(tax_amount) AS total_tax,
                    AVG(amount_paid) AS avg_paid
             FROM copra_transaction
             WHERE YEAR(date) = '$year' AND MONTH(date) = '$month'"
        )) ?: [];

        $stats['mtd_tx'] = intval($row['total_tx'] ?? 0);
        $stats['mtd_paid'] = floatval($row['total_paid'] ?? 0);
        $stats['mtd_kg'] = floatval($row['total_kg'] ?? 0);
        $stats['mtd_tax'] = floatval($row['total_tax'] ?? 0);
        $stats['mtd_avg'] = floatval($row['avg_paid'] ?? 0);

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT SUM(amount_paid) AS total_paid, SUM(net_res) AS total_kg, COUNT(*) AS total_tx FROM copra_transaction'
        )) ?: [];
        $stats['all_paid'] = floatval($row['total_paid'] ?? 0);
        $stats['all_kg'] = floatval($row['total_kg'] ?? 0);
        $stats['all_tx'] = intval($row['total_tx'] ?? 0);

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT SUM(cash_advance) AS outstanding, COUNT(*) AS sellers,
                    SUM(CASE WHEN cash_advance > 0 THEN 1 ELSE 0 END) AS with_balance
             FROM copra_seller'
        )) ?: [];
        $stats['outstanding_ca'] = floatval($row['outstanding'] ?? 0);
        $stats['seller_count'] = intval($row['sellers'] ?? 0);
        $stats['sellers_with_ca'] = intval($row['with_balance'] ?? 0);

        $stats['pending_contracts'] = intval(mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COUNT(*) AS total FROM copra_contract WHERE status IN ('PENDING','UPDATED')"
        ))['total'] ?? 0);

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT amount_paid, date, seller, invoice FROM copra_transaction ORDER BY id DESC LIMIT 1'
        )) ?: [];
        $stats['recent_paid'] = floatval($row['amount_paid'] ?? 0);
        $stats['recent_date'] = $row['date'] ?? '—';
        $stats['recent_seller'] = $row['seller'] ?? '';
        $stats['recent_invoice'] = $row['invoice'] ?? '';

        return $stats;
    }
}

if (!function_exists('copra_ca_page_stats')) {
    function copra_ca_page_stats(mysqli $con): array
    {
        $year = (int) date('Y');
        $month = (int) date('m');
        $periodLabel = date('F Y');

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT SUM(cash_advance) AS outstanding,
                    SUM(CASE WHEN cash_advance > 0 THEN 1 ELSE 0 END) AS with_balance,
                    COUNT(*) AS sellers
             FROM copra_seller'
        )) ?: [];

        $ledger = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT COUNT(*) AS records,
                    SUM(CAST(amount AS DECIMAL(12,2))) AS total_issued
             FROM copra_cashadvance'
        )) ?: [];

        $mtd = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COUNT(*) AS records,
                    SUM(CAST(amount AS DECIMAL(12,2))) AS total_issued
             FROM copra_cashadvance
             WHERE YEAR(date) = '$year' AND MONTH(date) = '$month'"
        )) ?: [];

        $recent = mysqli_fetch_assoc(mysqli_query(
            $con,
            'SELECT amount, date, seller, category FROM copra_cashadvance ORDER BY id DESC LIMIT 1'
        )) ?: [];

        return [
            'period_label' => $periodLabel,
            'outstanding' => floatval($row['outstanding'] ?? 0),
            'with_balance' => intval($row['with_balance'] ?? 0),
            'seller_count' => intval($row['sellers'] ?? 0),
            'ledger_records' => intval($ledger['records'] ?? 0),
            'ledger_issued' => floatval($ledger['total_issued'] ?? 0),
            'mtd_records' => intval($mtd['records'] ?? 0),
            'mtd_issued' => floatval($mtd['total_issued'] ?? 0),
            'recent_amount' => floatval($recent['amount'] ?? 0),
            'recent_date' => $recent['date'] ?? '—',
            'recent_seller' => $recent['seller'] ?? '',
            'recent_category' => $recent['category'] ?? '',
        ];
    }
}

if (!function_exists('copra_consume_flashes')) {
    function copra_consume_flashes(): void
    {
        $messages = [
            'seller' => ['success', 'Seller saved successfully'],
            'contract' => ['success', 'Contract saved successfully'],
            'copra_ca' => ['success', 'Cash advance recorded'],
            'new' => ['success', 'Cash advance added'],
            'update' => ['success', 'Record updated successfully'],
            'deleted' => ['success', 'Contract deleted'],
            'record_deleted' => ['success', 'Transaction deleted'],
        ];

        foreach ($messages as $key => [$icon, $title]) {
            if (!isset($_SESSION[$key])) {
                continue;
            }
            unset($_SESSION[$key]);
            $iconJs = json_encode($icon, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
            $titleJs = json_encode($title, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
            echo '<script>Swal.fire({ position: "top-end", icon: ' . $iconJs . ', title: ' . $titleJs . ', showConfirmButton: false, timer: 1800 });</script>';
        }
    }
}
