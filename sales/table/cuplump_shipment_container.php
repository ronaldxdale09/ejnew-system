<?php
include('../../function/db.php');

$shipment_id = isset($_POST['shipment_id']) ? (int) $_POST['shipment_id'] : 0;
$excludeSql = "
    SELECT sc.container_id FROM sales_cuplump_shipment_container sc
    INNER JOIN sales_cuplump_shipment s ON s.shipment_id = sc.shipment_id
    WHERE s.status IN ('In Progress', 'Draft')
      AND sc.shipment_id != '$shipment_id'
";
$result = mysqli_query($con, "
    SELECT * FROM cuplump_container
    WHERE status = 'Awaiting Shipment'
      AND container_id NOT IN ($excludeSql)
    ORDER BY container_id DESC
");

if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}

$rowCount = mysqli_num_rows($result);
if ($rowCount === 0) {
    echo '<div class="sales-inv-empty"><i class="fas fa-inbox"></i><p>No containers awaiting shipment.</p></div>';
    exit;
}

$rowsHtml = '';
while ($row = mysqli_fetch_assoc($result)) {
    $loadingDate = $row['loading_date'] ?? '';
    $rowsHtml .= '<tr'
        . ' data-container-id="' . (int) $row['container_id'] . '"'
        . ' data-van-no="' . htmlspecialchars($row['van_no'] ?? '', ENT_QUOTES) . '"'
        . ' data-loading-date="' . htmlspecialchars($loadingDate, ENT_QUOTES) . '"'
        . ' data-total-weight="' . (float) ($row['total_cuplump_weight'] ?? 0) . '"'
        . ' data-ave-cost="' . (float) ($row['ave_cuplump_cost'] ?? 0) . '"'
        . ' data-total-cost="' . (float) ($row['total_cuplump_cost'] ?? 0) . '"'
        . '>';
    $rowsHtml .= '<td>' . (int) $row['container_id'] . '</td>';
    $rowsHtml .= '<td>' . htmlspecialchars($row['van_no'] ?? '', ENT_QUOTES) . '</td>';
    $rowsHtml .= '<td>' . ($loadingDate ? date('M j, Y', strtotime($loadingDate)) : '—') . '</td>';
    $rowsHtml .= '<td class="text-end">' . number_format((float) ($row['total_cuplump_weight'] ?? 0), 2) . ' kg</td>';
    $rowsHtml .= '<td class="text-end">₱' . number_format((float) ($row['ave_cuplump_cost'] ?? 0), 2) . '</td>';
    $rowsHtml .= '<td class="text-end">₱' . number_format((float) ($row['total_cuplump_cost'] ?? 0), 2) . '</td>';
    $rowsHtml .= '<td>' . htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES) . '</td>';
    $rowsHtml .= '<td>' . htmlspecialchars($row['recorded_by'] ?? '', ENT_QUOTES) . '</td>';
    $rowsHtml .= '<td class="text-center"><button type="button" class="btn btn-success btn-sm addCuplump"><i class="fas fa-plus"></i></button></td>';
    $rowsHtml .= '</tr>';
}
?>

<div class="sales-inv-table-wrap">
    <table class="table table-sm sales-inv-table mb-0" id="recording_table-receiving">
        <thead>
            <tr>
                <th>ID</th>
                <th>Van No.</th>
                <th>Loading</th>
                <th class="text-end">Weight</th>
                <th class="text-end">Avg ₱/kg</th>
                <th class="text-end">Total ₱</th>
                <th>Remarks</th>
                <th>Recorded</th>
                <th></th>
            </tr>
        </thead>
        <tbody><?php echo $rowsHtml; ?></tbody>
    </table>
</div>
