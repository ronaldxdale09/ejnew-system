<?php
/**
 * Rubber UI helpers — extends admin design system
 */
require_once __DIR__ . '/../../admin/include/adm-helpers.php';

if (!function_exists('rubber_loc_sql')) {
    function rubber_loc_sql(): string
    {
        return str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    }
}

if (!function_exists('rubber_root_path')) {
    function rubber_root_path(string $relative = ''): string
    {
        $root = dirname(__DIR__);
        if ($relative === '') {
            return $root;
        }
        return $root . '/' . ltrim($relative, '/');
    }
}

if (!function_exists('rubber_mtime')) {
    /** Cache-bust token from file modification time (changes when asset changes). */
    function rubber_mtime(string $absolutePath): string
    {
        return is_file($absolutePath) ? (string) filemtime($absolutePath) : '1';
    }
}

if (!function_exists('rubber_asset')) {
    /** Relative path from rubber module root, e.g. css/rubber-theme.css */
    function rubber_asset(string $relativePath, string $base = ''): string
    {
        $ver = rubber_mtime(rubber_root_path($relativePath));
        return $base . ltrim($relativePath, '/') . '?v=' . $ver;
    }
}

if (!function_exists('rubber_nocache_headers')) {
    function rubber_nocache_headers(): void
    {
        if (headers_sent()) {
            return;
        }
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
    }
}

if (!function_exists('rubber_logout_url')) {
    function rubber_logout_url(): string
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        if (str_contains($script, '/record/') || str_contains($script, 'bales_inventory')) {
            return '../function/logout.php';
        }
        return 'function/logout.php';
    }
}

if (!function_exists('rubber_require_auth')) {
    function rubber_require_auth(): string
    {
        if (empty($_SESSION['user']) || empty($_SESSION['loc'])) {
            header('Location: ' . rubber_logout_url());
            exit();
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'rubber') {
            header('Location: ' . rubber_logout_url());
            exit();
        }
        return rubber_loc_sql();
    }
}

if (!function_exists('rubber_nav_active')) {
    function rubber_nav_active($pages, string $currentPage): string
    {
        return in_array($currentPage, (array) $pages, true) ? ' active' : '';
    }
}

if (!function_exists('rubber_resolve_topbar_title')) {
    function rubber_resolve_topbar_title(string $currentPage): string
    {
        if (!empty($GLOBALS['rubber_topbar_title'])) {
            return (string) $GLOBALS['rubber_topbar_title'];
        }
        $map = [
            'dry_receiving_record.php' => 'DRY Receiving',
            'ejn_rubber_record.php' => 'EJN Rubber',
            'cuplumps_purchase_record.php' => 'Cuplump Purchasing',
            'wet_rubber.php' => 'Cuplump Purchase',
            'bales_purchase_record.php' => 'Bales Purchasing',
            'bales_rubber.php' => 'Bale Purchase',
            'bale_record.php' => 'Bale Record',
            'inv_bale.php' => 'Bale Inventory',
            'inv_cuplump.php' => 'Cuplump Inventory',
            'inventory_bale.php' => 'Bale Inventory',
            'inventory_cuplump.php' => 'Cuplump Inventory',
            'contract-purchase.php' => 'Purchase Contract',
            'cash-advance.php' => 'Cash Advance',
            'seller.php' => 'Sellers',
            'dashboard.php' => 'Home',
            'bales_record.php' => 'Bale Purchase Record',
            'wet_record.php' => 'Cuplump Purchase Record',
        ];
        return $map[$currentPage] ?? 'EJN Rubber';
    }
}

if (!function_exists('rubber_shell_open')) {
    function rubber_shell_open(string $title, string $subtitle = '', array $badges = []): void
    {
        echo '<div class="main-content admin-page rubber-page">';
        adm_page_header($title, $subtitle, $badges);
    }
}

if (!function_exists('rubber_page_begin')) {
    function rubber_page_begin(string $title, string $subtitle = '', string $panelTitle = ''): void
    {
        rubber_shell_open($title, $subtitle);
        if ($panelTitle !== '') {
            adm_panel_open($panelTitle);
            $GLOBALS['rubber_panel_open'] = true;
        } else {
            $GLOBALS['rubber_panel_open'] = false;
        }
    }
}

if (!function_exists('rubber_page_end')) {
    function rubber_page_end(bool $closePanel = true): void
    {
        if ($closePanel && !empty($GLOBALS['rubber_panel_open'])) {
            adm_panel_close();
            $GLOBALS['rubber_panel_open'] = false;
        }
        rubber_shell_close();
    }
}

if (!function_exists('rubber_kpi_row')) {
    function rubber_kpi_row(array $items): void
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

if (!function_exists('rubber_shell_close')) {
    function rubber_shell_close(): void
    {
        echo '</div></body></html>';
    }
}

if (!function_exists('rubber_planta_status_badge')) {
    function rubber_planta_status_badge($plantaStatus): string
    {
        $isEjn = (int) $plantaStatus === 1;
        $label = $isEjn ? 'EJN' : 'PLANTA';
        $class = $isEjn ? 'bg-success' : 'bg-warning text-dark';
        return '<span class="badge ' . $class . '">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>';
    }
}

if (!function_exists('rubber_seller_options')) {
    function rubber_seller_options(mysqli $con, string $loc): string
    {
        $html = '';
        $locEsc = mysqli_real_escape_string($con, $loc);
        $result = mysqli_query($con, "SELECT name FROM rubber_seller WHERE loc='$locEsc' ORDER BY name ASC");
        if (!$result) {
            return $html;
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $name = htmlspecialchars($row['name'] ?? '', ENT_QUOTES, 'UTF-8');
            if ($name !== '') {
                $html .= '<option value="' . $name . '">' . $name . '</option>';
            }
        }
        return $html;
    }
}

if (!function_exists('rubber_wet_contract_options')) {
    function rubber_wet_contract_options(mysqli $con, string $loc): string
    {
        $html = '';
        $locEsc = mysqli_real_escape_string($con, $loc);
        $sql = "SELECT contract_no, seller FROM rubber_contract
                WHERE loc='$locEsc' AND type='WET' AND (status='PENDING' OR status='UPDATED')
                ORDER BY contract_no ASC";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            return $html;
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $no = htmlspecialchars($row['contract_no'] ?? '', ENT_QUOTES, 'UTF-8');
            $seller = htmlspecialchars($row['seller'] ?? '', ENT_QUOTES, 'UTF-8');
            if ($no !== '') {
                $html .= '<option value="' . $no . '">[ ' . $no . ' ] ' . $seller . '</option>';
            }
        }
        return $html;
    }
}

if (!function_exists('rubber_transaction_status_badge')) {
    function rubber_transaction_status_badge(string $status): string
    {
        $status = strtoupper(trim($status));
        if ($status === 'COMPLETED') {
            return '<span class="badge bg-success rubber-status-badge" id="trans_status">COMPLETED</span>';
        }
        return '<span class="badge bg-danger rubber-status-badge" id="trans_status">ONGOING</span>';
    }
}
