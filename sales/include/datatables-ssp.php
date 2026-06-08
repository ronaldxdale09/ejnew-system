<?php

if (!function_exists('sales_ssp_require_auth')) {
    function sales_ssp_require_auth(): string
    {
        require_once __DIR__ . '/sales-helpers.php';
        if (empty($_SESSION['user'])) {
            sales_ssp_json_error('Session expired.', 401);
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'sales') {
            sales_ssp_json_error('Unauthorized.', 403);
        }
        return sales_loc_sql();
    }
}

if (!function_exists('sales_ssp_json_error')) {
    function sales_ssp_json_error(string $message, int $httpCode = 400): void
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

if (!function_exists('sales_ssp_paging')) {
    function sales_ssp_paging(array $request, int $default = 25, int $max = 500): array
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

if (!function_exists('sales_ssp_sort')) {
    function sales_ssp_sort(array $request, array $columns, string $defaultCol, string $defaultDir = 'DESC'): array
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

if (!function_exists('sales_ssp_response')) {
    function sales_ssp_response(array $request, int $total, int $filtered, array $data): void
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

if (!function_exists('sales_ssp_query')) {
    /** @return mysqli_result */
    function sales_ssp_query(mysqli $con, string $sql, array $request)
    {
        $result = mysqli_query($con, $sql);
        if ($result === false) {
            sales_ssp_json_error('Query failed: ' . mysqli_error($con), 500);
        }
        return $result;
    }
}

if (!function_exists('sales_ssp_scalar')) {
    function sales_ssp_scalar(mysqli $con, string $sql, array $request): int
    {
        $row = mysqli_fetch_assoc(sales_ssp_query($con, $sql, $request));
        return intval($row['total'] ?? 0);
    }
}

if (!function_exists('sales_ssp_filters')) {
    function sales_ssp_filters(array $request): array
    {
        return [
            'buyer' => trim($request['filterBuyer'] ?? ''),
            'status' => trim($request['filterStatus'] ?? ''),
            'month' => trim($request['filterMonth'] ?? ''),
            'year' => trim($request['filterYear'] ?? ''),
            'startDate' => trim($request['startDate'] ?? ''),
            'endDate' => trim($request['endDate'] ?? ''),
            'location' => trim($request['filterLocation'] ?? ''),
        ];
    }
}

if (!function_exists('sales_ssp_append_filters')) {
    function sales_ssp_append_filters(mysqli $con, array $filters, string $dateCol, array $searchCols, string &$searchSql): void
    {
        if ($filters['status'] !== '') {
            $s = mysqli_real_escape_string($con, $filters['status']);
            $searchSql .= " AND status = '$s'";
        }
        if ($filters['buyer'] !== '') {
            $s = mysqli_real_escape_string($con, $filters['buyer']);
            foreach ($searchCols as $col) {
                if (stripos($col, 'buyer') !== false || stripos($col, 'remarks') !== false || stripos($col, 'particular') !== false) {
                    $searchSql .= " AND $col = '$s'";
                    break;
                }
            }
            if (strpos($searchSql, $s) === false) {
                $searchSql .= " AND buyer_name = '$s'";
            }
        }
        if ($filters['location'] !== '') {
            $s = mysqli_real_escape_string($con, $filters['location']);
            $searchSql .= " AND source = '$s'";
        }
        if ($filters['month'] !== '') {
            $m = intval($filters['month']);
            if ($m >= 1 && $m <= 12) {
                $searchSql .= " AND MONTH($dateCol) = $m";
            }
        }
        if ($filters['year'] !== '') {
            $y = intval($filters['year']);
            if ($y > 2000) {
                $searchSql .= " AND YEAR($dateCol) = $y";
            }
        }
        if ($filters['startDate'] !== '') {
            $d = mysqli_real_escape_string($con, $filters['startDate']);
            $searchSql .= " AND DATE($dateCol) >= '$d'";
        }
        if ($filters['endDate'] !== '') {
            $d = mysqli_real_escape_string($con, $filters['endDate']);
            $searchSql .= " AND DATE($dateCol) <= '$d'";
        }
    }
}
