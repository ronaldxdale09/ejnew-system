<?php

require_once __DIR__ . '/rubber-helpers.php';

if (!function_exists('rubber_ssp_require_auth')) {
    function rubber_ssp_require_auth(): string
    {
        if (empty($_SESSION['user']) || empty($_SESSION['loc'])) {
            rubber_ssp_json_error('Session expired.', 401);
        }
        return rubber_loc_sql();
    }
}

if (!function_exists('rubber_ssp_json_error')) {
    function rubber_ssp_json_error(string $message, int $httpCode = 400): void
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

if (!function_exists('rubber_ssp_paging')) {
    function rubber_ssp_paging(array $request, int $default = 25, int $max = 500): array
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

if (!function_exists('rubber_ssp_sort')) {
    function rubber_ssp_sort(array $request, array $columns, string $defaultCol, string $defaultDir = 'DESC'): array
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

if (!function_exists('rubber_ssp_response')) {
    function rubber_ssp_response(array $request, int $total, int $filtered, array $data): void
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

if (!function_exists('rubber_ssp_query')) {
    /** @return mysqli_result */
    function rubber_ssp_query(mysqli $con, string $sql, array $request)
    {
        $result = mysqli_query($con, $sql);
        if ($result === false) {
            rubber_ssp_json_error('Query failed: ' . mysqli_error($con), 500);
        }
        return $result;
    }
}

if (!function_exists('rubber_ssp_scalar')) {
    function rubber_ssp_scalar(mysqli $con, string $sql, array $request): int
    {
        $row = mysqli_fetch_assoc(rubber_ssp_query($con, $sql, $request));
        return intval($row['total'] ?? 0);
    }
}

if (!function_exists('rubber_ssp_filters')) {
    function rubber_ssp_filters(array $request): array
    {
        return [
            'seller' => trim($request['filterSeller'] ?? ''),
            'startDate' => trim($request['startDate'] ?? ''),
            'endDate' => trim($request['endDate'] ?? ''),
            'source' => trim($request['filterSource'] ?? ''),
        ];
    }
}

if (!function_exists('rubber_ssp_append_filters')) {
    function rubber_ssp_append_filters(mysqli $con, array $filters, string $dateCol, ?string $sellerCol, string &$filterSql): void
    {
        if ($sellerCol !== null && $filters['seller'] !== '') {
            $s = mysqli_real_escape_string($con, $filters['seller']);
            $filterSql .= " AND $sellerCol = '$s'";
        }
        if ($filters['startDate'] !== '') {
            $d = mysqli_real_escape_string($con, $filters['startDate']);
            $filterSql .= " AND DATE($dateCol) >= '$d'";
        }
        if ($filters['endDate'] !== '') {
            $d = mysqli_real_escape_string($con, $filters['endDate']);
            $filterSql .= " AND DATE($dateCol) <= '$d'";
        }
        if ($filters['source'] !== '') {
            $s = mysqli_real_escape_string($con, $filters['source']);
            $filterSql .= " AND source = '$s'";
        }
    }
}

if (!function_exists('rubber_ssp_search')) {
    function rubber_ssp_search(mysqli $con, string $searchValue, array $columns, string &$filterSql): void
    {
        if ($searchValue === '') {
            return;
        }
        $q = mysqli_real_escape_string($con, $searchValue);
        $parts = [];
        foreach ($columns as $col) {
            $parts[] = "$col LIKE '%$q%'";
        }
        if ($parts) {
            $filterSql .= ' AND (' . implode(' OR ', $parts) . ')';
        }
    }
}

if (!function_exists('rubber_bale_status_badge')) {
    function rubber_bale_status_badge(string $status): string
    {
        $map = [
            'For Sale' => 'bg-primary',
            'Pressing' => 'bg-danger',
            'Purchase' => 'bg-info',
            'Complete' => 'bg-success',
            'Produced' => 'bg-success',
        ];
        $class = $map[$status] ?? '';
        $label = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
        return $class !== ''
            ? '<span class="badge ' . $class . '">' . $label . '</span>'
            : '<span class="badge">' . $label . '</span>';
    }
}

if (!function_exists('rubber_contract_status_badge')) {
    function rubber_contract_status_badge(string $status): string
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
