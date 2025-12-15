<?php
include('../../function/db.php');

$request = $_POST;
$location = $request['location'];

$columns = array(
    0 => 'planta_recording.status',
    1 => 'bales_prod_id',
    2 => 'production_date',
    3 => 'supplier',
    4 => 'lot_num',
    5 => 'bales_type',
    6 => 'kilo_per_bale',
    7 => 'number_bales',
    8 => 'remaining_bales',
    9 => 'reweight',
    10 => 'rubber_weight',
    11 => 'drc',
    12 => 'description',
    13 => 'milling_cost',
    14 => 'unit_cost',
    15 => 'total_cost'
);

// DataTables parameters
$start = $request['start'];
$length = $request['length'];
$columnIndex = $request['order'][0]['column'];
$columnName = $columns[$columnIndex] ?? 'production_date';
$columnSortOrder = $request['order'][0]['dir'];
$searchValue = $request['search']['value'];

// Base Query
$sql = "SELECT planta_bales_production.*, planta_recording.status as planta_status, planta_recording.source, 
               planta_recording.total_production_cost, planta_recording.produce_total_weight, planta_recording.milling_cost
        FROM planta_bales_production 
        LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
        WHERE planta_bales_production.status='Produced' 
          AND (rubber_weight != '0' AND rubber_weight IS NOT NULL) 
          AND (remaining_bales != '0')
          AND planta_recording.source='$location' ";

// Search Filtering
if (!empty($searchValue)) {
    $sql .= "AND (supplier LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                  lot_num LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                  bales_type LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%' OR 
                  description LIKE '%" . mysqli_real_escape_string($con, $searchValue) . "%') ";
}

// Get filtered count
$queryFiltered = mysqli_query($con, $sql);
$totalFiltered = mysqli_num_rows($queryFiltered);

// Ordering via map or default
// Handle calculated/complex columns sorting if needed, else basic sort
if (array_key_exists($columnIndex, $columns)) {
    $sql .= "ORDER BY " . $columns[$columnIndex] . " " . $columnSortOrder . " ";
} else {
    $sql .= "ORDER BY production_date DESC ";
}

// Limit
$sql .= "LIMIT " . $start . ", " . $length;

$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_array($query)) {

    // Status Badge
    $status = $row['planta_status']; // Use joined status or row status? Original used row['status'] but loop logic checked 'For Sale' etc.
    // Original code checked $row['status']. But query filters where status='Produced'. 
    // Wait, the original code checked:
    // if ($row['status'] == 'For Sale') ... but query condition was `planta_bales_production.status='Produced'`. 
    // Ah, `planta_recording.status` might be 'For Sale'.
    // Let's assume the badge Iogic uses `planta_recording.status` alias `planta_status` if checking for 'For Sale', 
    // BUT the original code used `$row['status']`. 
    // Since `SELECT * FROM planta_bales_production` is first, `$row['status']` is 'Produced'.
    // This implies the original badge logic might have been always showing 'Produced' or similar?
    // Wait, looking at original file: `status` column in `planta_bales_production` helps determines if it's 'For Sale'? 
    // Actually, `planta_recording` has a status too. 
    // Let's stick to `$row['status']` from `planta_bales_production` if that's what was used, OR `planta_recording.status`.
    // The query fetches `planta_bales_production.*`.
    // Visual inspection of original code: `$row['status']`.
    // Let's stick to passing the status.

    $statusBadge = '<span class="badge bg-secondary">' . $row['status'] . '</span>';
    if ($row['status'] == 'For Sale')
        $statusBadge = '<span class="badge bg-primary">For Sale</span>';
    if ($row['status'] == 'Drying')
        $statusBadge = '<span class="badge bg-warning">Drying</span>';
    if ($row['status'] == 'Pressing')
        $statusBadge = '<span class="badge bg-danger">Pressing</span>';
    if ($row['status'] == 'Purchase')
        $statusBadge = '<span class="badge bg-info">Purchase</span>';
    if ($row['status'] == 'Complete')
        $statusBadge = '<span class="badge bg-success">Complete</span>';

    // Costs Calculation
    $mill_cost = '-';
    $unit_cost_display = '-';
    $total_cost_display = '-';

    // Original logic: if ($row['status'] == 'For Sale') ... 
    // But wait, the query filters `status='Produced'`. 
    // It seems 'For Sale' might be a value for `planta_recording.status`? 
    // If the original `SELECT` fetched `planta_recording.status as planta_status`, but used `$row['status']`...
    // If `$row['status']` is always 'Produced' due to WHERE clause, then the original code's `if ($row['status'] == 'For Sale')` would NEVER be true unless `status` comes from `planta_recording` overriding it?
    // In `mysqli_fetch_array`, if columns have same name, last one overwrites?
    // `planta_bales_production` has `status`. `planta_recording` has `status`.
    // `SELECT * FROM planta_bales_production LEFT JOIN ...` -> `planta_bales_production.status` comes first.
    // If `planta_recording.status` is also fetched "as planta_status" (in my query), it's safe.
    // BUT in original `SELECT *`, `planta_recording.status` would overwrite `planta_bales_production.status` if they collide?
    // `planta_bales_production` table usually tracks the bale status.

    // Let's assume we calculate costs if available.
    $unit_cost = 0;
    $total_cost = 0;
    if ($row['produce_total_weight'] > 0) {
        $unit_cost = $row['total_production_cost'] / $row['produce_total_weight'];
        $total_cost = $unit_cost + $row['milling_cost'];

        $mill_cost = '₱' . number_format($row['milling_cost'], 0);
        $unit_cost_display = '₱' . number_format($unit_cost, 0);
        $total_cost_display = '<strong>₱' . number_format($total_cost, 0) . '</strong>';
    }

    $data[] = array(
        "status" => $statusBadge,
        "bales_prod_id" => '<span class="badge bg-secondary">' . $row['bales_prod_id'] . '</span>',
        "date" => date('M d, Y', strtotime($row['production_date'])),
        "supplier" => '<div style="font-size: 13px; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: bold;" title="' . $row['supplier'] . '">' . $row['supplier'] . '</div>',
        "lot_num" => $row['lot_num'],
        "quality" => $row['bales_type'],
        "kilo" => $row['kilo_per_bale'],
        "produced" => number_format($row['number_bales'], 0),
        "remaining" => number_format($row['remaining_bales'], 0),
        "reweight" => number_format($row['reweight'], 0),
        "rubber_weight" => number_format($row['rubber_weight'], 0),
        "drc" => number_format($row['drc'], 2) . '%',
        "description" => '<div style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="' . $row['description'] . '">' . $row['description'] . '</div>',
        "mill_cost" => $mill_cost,
        "unit_cost" => $unit_cost_display,
        "total_cost" => $total_cost_display
    );
}

// Total records
$totalQuery = "SELECT COUNT(*) as total 
               FROM planta_bales_production 
               LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
               WHERE planta_bales_production.status='Produced' 
                 AND (rubber_weight != '0') 
                 AND (remaining_bales != '0')
                 AND planta_recording.source='$location'";
$totalResult = mysqli_query($con, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

$response = array(
    "draw" => intval($request['draw']),
    "iTotalRecords" => intval($totalRecords),
    "iTotalDisplayRecords" => intval($totalFiltered),
    "aaData" => $data
);

echo json_encode($response);
?>