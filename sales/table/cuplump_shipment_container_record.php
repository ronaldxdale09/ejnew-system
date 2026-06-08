<?php
include('../../function/db.php');

$shipment_id = isset($_POST['shipment_id']) ? (int) $_POST['shipment_id'] : 0;
$readonly = !empty($_POST['readonly']);
$query = "SELECT sales_cuplump_shipment_container.*, cuplump_container.remarks, cuplump_container.loading_date AS container_loading_date
    FROM sales_cuplump_shipment_container
    LEFT JOIN cuplump_container ON cuplump_container.container_id = sales_cuplump_shipment_container.container_id
    WHERE sales_cuplump_shipment_container.shipment_id = '$shipment_id'
    ORDER BY sales_cuplump_shipment_container.container_id ASC";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}

$rowCount = mysqli_num_rows($result);
$rowsHtml = '';

while ($row = mysqli_fetch_assoc($result)) {
    $loadingDate = $row['loading_date'] ?: ($row['container_loading_date'] ?? '');
    $loadingDisplay = $loadingDate ? date('M j, Y', strtotime($loadingDate)) : '—';
    $rowsHtml .= '<tr>';
    $rowsHtml .= '<td>' . (int) $row['container_id'] . '</td>';
    $rowsHtml .= '<td>' . htmlspecialchars($row['van_no'] ?? '', ENT_QUOTES) . '</td>';
    $rowsHtml .= '<td>' . htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES) . '</td>';
    $rowsHtml .= '<td>' . $loadingDisplay . '</td>';
    $rowsHtml .= '<td class="text-end">' . number_format((float) ($row['total_weight'] ?? 0), 2) . ' kg</td>';
    $rowsHtml .= '<td class="text-end d-none d-md-table-cell">₱' . number_format((float) ($row['ave_cost'] ?? 0), 2) . '</td>';
    $rowsHtml .= '<td class="text-end d-none d-md-table-cell">₱' . number_format((float) ($row['total_cost'] ?? 0), 2) . '</td>';
    if (!$readonly) {
        $rowsHtml .= '<td class="text-center"><button type="button" class="btn btn-outline-danger btn-sm removeContainer"><i class="fas fa-trash"></i></button></td>';
    }
    $rowsHtml .= '</tr>';
}

$emptyState = $rowCount === 0
    ? '<div class="sales-inv-empty"><i class="fas fa-box-open"></i><p>No containers selected. Click <strong>Select Container</strong> to assign awaiting-shipment containers.</p></div>'
    : '';
?>

<?php echo $emptyState; ?>
<?php if ($rowCount > 0): ?>
<div class="sales-inv-table-wrap">
    <table class="table table-sm sales-inv-table mb-0" id="container_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Van No.</th>
                <th>Particular</th>
                <th>Loading</th>
                <th class="text-end">Weight</th>
                <th class="text-end d-none d-md-table-cell">Avg ₱/kg</th>
                <th class="text-end d-none d-md-table-cell">Total ₱</th>
                <?php if (!$readonly): ?><th></th><?php endif; ?>
            </tr>
        </thead>
        <tbody><?php echo $rowsHtml; ?></tbody>
    </table>
</div>
<?php endif; ?>
