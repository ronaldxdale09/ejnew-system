<?php
/**
 * Sales UI helpers — extends admin design system
 */
require_once __DIR__ . '/../../admin/include/adm-helpers.php';

if (!function_exists('sales_loc_sql')) {
    function sales_loc_sql(): string
    {
        return str_replace(' ', '', (string) ($_SESSION['loc'] ?? $_SESSION['source'] ?? ''));
    }
}

if (!function_exists('sales_require_auth')) {
    function sales_require_auth(): string
    {
        if (empty($_SESSION['user'])) {
            header('Location: function/logout.php');
            exit();
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'sales') {
            header('Location: function/logout.php');
            exit();
        }
        return sales_loc_sql();
    }
}

if (!function_exists('sales_nav_active')) {
    function sales_nav_active($pages, string $currentPage): string
    {
        return in_array($currentPage, (array) $pages, true) ? ' active' : '';
    }
}

if (!function_exists('sales_topbar_title')) {
    function sales_topbar_title(string $title): void
    {
        $GLOBALS['sales_topbar_title'] = $title;
    }

    function sales_resolve_topbar_title(string $currentPage): string
    {
        if (!empty($GLOBALS['sales_topbar_title'])) {
            return (string) $GLOBALS['sales_topbar_title'];
        }
        $map = [
            'dashboard.php' => 'Home',
            'bale_sale_record.php' => 'Rubber Bale Sale',
            'bale_sales.php' => 'Bale Sale Detail',
            'bale_container_record.php' => 'Bale Container',
            'bale_shipment_record.php' => 'Bale Shipment',
            'bale_shipment.php' => 'Bale Shipment Detail',
            'cuplump_sale_record.php' => 'Cuplump Sale',
            'cuplump_sale.php' => 'Cuplump Sale Detail',
            'cuplump_container_record.php' => 'Cuplump Container',
            'cuplump_container.php' => 'Cuplump Container Detail',
            'cuplump_shipment_record.php' => 'Cuplump Shipment',
            'cuplump_shipment.php' => 'Cuplump Shipment Detail',
            'inventory_bale.php' => 'Bale Inventory',
            'inventory_cuplump.php' => 'Cuplump Inventory',
            'report_bales.php' => 'Bale Sales Report',
            'report_cuplump.php' => 'Cuplump Sales Report',
        ];
        return $map[$currentPage] ?? 'Sales';
    }
}

function sales_shell_open(string $title, string $subtitle = '', array $badges = []): void
{
    echo '<div class="main-content admin-page sales-page">';
    adm_page_header($title, $subtitle, $badges);
}

function sales_shell_close(): void
{
    echo '</div></body></html>';
}

function sales_status_badge(string $status, array $map = []): string
{
    $default = [
        'Draft' => 'bg-info',
        'In Progress' => 'bg-warning text-dark',
        'Complete' => 'bg-success',
        'Sold' => 'bg-success',
        'Shipped Out' => 'bg-dark text-white',
        'Released' => 'bg-primary',
        'Awaiting Release' => 'bg-secondary',
    ];
    $map = $map + $default;
    $class = $map[$status] ?? 'bg-secondary';
    return '<span class="badge ' . $class . '">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
}

function sales_filter_options(mysqli $con, string $sql, string $column): string
{
    $html = '';
    $result = mysqli_query($con, $sql);
    if (!$result) {
        return $html;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $val = htmlspecialchars($row[$column] ?? '', ENT_QUOTES, 'UTF-8');
        if ($val !== '') {
            $html .= '<option value="' . $val . '">' . $val . '</option>';
        }
    }
    return $html;
}
