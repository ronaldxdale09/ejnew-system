<?php
/**
 * Shared helpers for plantation DataTables server-side processing.
 */

if (!function_exists('plantation_ssp_require_auth')) {
    function plantation_ssp_require_auth(): string
    {
        require_once __DIR__ . '/plantation-helpers.php';
        if (empty($_SESSION['loc'])) {
            plantation_ssp_json_error('Session expired.', 401);
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'planta') {
            plantation_ssp_json_error('Unauthorized.', 403);
        }
        return plantation_loc_sql();
    }
}

if (!function_exists('plantation_ssp_json_error')) {
    function plantation_ssp_json_error(string $message, int $httpCode = 400): void
    {
        http_response_code($httpCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'draw' => intval($_POST['draw'] ?? 0),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'error' => $message,
        ]);
        exit;
    }
}

if (!function_exists('plantation_ssp_paging')) {
    function plantation_ssp_paging(array $request, int $default = 25, int $max = 500): array
    {
        $start = max(0, intval($request['start'] ?? 0));
        $length = intval($request['length'] ?? $default);
        if ($length < 0) {
            $length = $max;
        }
        if ($length === 0) {
            $length = $default;
        }
        if ($length > $max) {
            $length = $max;
        }
        return [$start, $length];
    }
}

if (!function_exists('plantation_ssp_sort')) {
    function plantation_ssp_sort(array $request, array $columns, string $defaultCol, string $defaultDir = 'DESC'): array
    {
        $order = $request['order'] ?? [];
        $columnIndex = intval($order[0]['column'] ?? 0);
        $dir = (isset($order[0]['dir']) && strtolower($order[0]['dir']) === 'asc') ? 'ASC' : 'DESC';
        $columnName = $columns[$columnIndex] ?? $defaultCol;
        if (!in_array($columnName, $columns, true)) {
            $columnName = $defaultCol;
            $dir = $defaultDir;
        }
        return [$columnName, $dir];
    }
}

if (!function_exists('plantation_ssp_response')) {
    function plantation_ssp_response(array $request, int $total, int $filtered, array $data): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'draw' => intval($request['draw'] ?? 0),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data,
        ]);
        exit;
    }
}

if (!function_exists('plantation_transaction_status_badge')) {
    function plantation_transaction_status_badge(string $status): string
    {
        $map = [
            'Complete' => 'bg-success',
            'Field' => 'bg-info',
            'Milling' => 'bg-secondary',
            'Drying' => 'bg-warning text-dark',
            'Pressing' => 'bg-danger',
            'Produced' => 'bg-primary',
            'Sold' => 'bg-dark text-white',
            'For Sale' => 'bg-dark text-light',
            'Purchase' => 'bg-warning text-dark',
        ];
        $class = $map[$status] ?? 'bg-secondary';
        return '<span class="badge ' . $class . '">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
    }
}

if (!function_exists('plantation_record_status_badge')) {
    function plantation_record_status_badge(string $status): string
    {
        if ($status === 'For Sale') {
            return '<span class="badge bg-primary">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
        }
        if ($status === 'Complete') {
            return '<span class="badge bg-success">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
        }
        if ($status === 'Pressing') {
            return '<span class="badge bg-danger">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
        }
        if ($status === 'Purchase') {
            return '<span class="badge bg-info">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
        }
        return '<span class="badge bg-secondary">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
    }
}

if (!function_exists('plantation_trans_type_production_badge')) {
    function plantation_trans_type_production_badge(string $transType): string
    {
        if ($transType === 'OUTSOURCE') {
            return '<span class="badge bg-danger">Outsourced</span>';
        }
        return '<span class="badge bg-success">EJN Produced</span>';
    }
}

if (!function_exists('plantation_trans_type_purchase_badge')) {
    function plantation_trans_type_purchase_badge(string $transType): string
    {
        return match ($transType) {
            'OUTSOURCE' => '<span class="badge bg-danger">Outsourced</span>',
            'DRY' => '<span class="badge bg-dark">Dry/Bale Purchase</span>',
            'SALE' => '<span class="badge bg-success">Cuplump/Wet Purchase</span>',
            'EJN' => '<span class="badge bg-warning text-dark">EJN Rubber</span>',
            'Excess' => '<span class="badge bg-primary">Production Excess</span>',
            default => '<span class="badge bg-secondary">' . htmlspecialchars($transType, ENT_QUOTES, 'UTF-8') . '</span>',
        };
    }
}
