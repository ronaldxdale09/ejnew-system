<?php
include('../../function/db.php');

$container_id = isset($_POST['container_id']) ? (int) $_POST['container_id'] : 0;
$query = "SELECT * FROM cuplump_container_inv WHERE container_id = '$container_id' ORDER BY cuplump_inventory_id ASC";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$rowsHtml = '';
$rowCount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $rowCount++;
    $supplier = htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES, 'UTF-8');
    $invRemarks = htmlspecialchars($row['inv_remarks'] ?? '', ENT_QUOTES, 'UTF-8');
    $rowsHtml .= '<tr>';
    $rowsHtml .= '<td class="d-none"><input type="hidden" name="inventory_id[]" value="' . (int) $row['cuplump_inventory_id'] . '"></td>';
    $rowsHtml .= '<td><input type="text" class="form-control form-control-sm" name="supplier[]" value="' . $supplier . '"></td>';
    $rowsHtml .= '<td><div class="input-group input-group-sm"><input type="text" class="form-control weight sales-num-input" name="buying_weight[]" value="' . number_format($row['buying_weight'], 0, '.', ',') . '"><span class="input-group-text">kg</span></div></td>';
    $rowsHtml .= '<td><div class="input-group input-group-sm"><input type="text" class="form-control drcInput sales-num-input" name="drc[]" value="' . number_format($row['drc'], 2) . '"><span class="input-group-text">%</span></div></td>';
    $rowsHtml .= '<td><div class="input-group input-group-sm"><input type="text" class="form-control dry_weight" name="dry_weight[]" readonly value="' . number_format($row['dry_weight'], 2) . '"><span class="input-group-text">kg</span></div></td>';
    $rowsHtml .= '<td><div class="input-group input-group-sm"><span class="input-group-text">₱</span><input type="text" class="form-control cost_per_kilo sales-num-input" name="cost_per_kilo[]" value="' . number_format($row['cost_per_kilo'], 2) . '"></div></td>';
    $rowsHtml .= '<td><div class="input-group input-group-sm"><span class="input-group-text">₱</span><input type="text" class="form-control total_cost" name="total_cost[]" readonly value="' . number_format($row['total_cost'], 2) . '"></div></td>';
    $rowsHtml .= '<td><input type="text" class="form-control form-control-sm amount_paid sales-num-input" name="amount_paid[]" value="' . number_format($row['amount_paid'], 2) . '"></td>';
    $rowsHtml .= '<td><input type="text" class="form-control form-control-sm" name="inv_remarks[]" value="' . $invRemarks . '"></td>';
    $rowsHtml .= '<td class="text-center"><button type="button" class="btn btn-outline-danger btn-sm removeRow"><i class="fas fa-trash"></i></button></td>';
    $rowsHtml .= '</tr>';
}

$emptyState = $rowCount === 0
    ? '<div class="sales-inv-empty"><i class="fas fa-box-open"></i><p>No inventory lines yet. Click <strong>Add Line</strong> to record cuplump purchases.</p></div>'
    : '';

echo $emptyState;
?>
<div class="sales-inv-table-wrap">
<table class="table table-sm sales-inv-table mb-0" id="cuplump_container">
    <thead>
        <tr>
            <th class="d-none"></th>
            <th>Supplier</th>
            <th>Buying Wt</th>
            <th>DRC</th>
            <th>Dry Wt</th>
            <th>₱/kg</th>
            <th>Total ₱</th>
            <th>Paid ₱</th>
            <th>Remarks</th>
            <th></th>
        </tr>
    </thead>
    <tbody><?php echo $rowsHtml; ?></tbody>
</table>
</div>

<div class="sales-inv-totals">
    <div class="sales-inv-total">
        <span class="sales-inv-total__label">Buying Weight</span>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" name="total_cuplump_weight" id="total-cuplump-weight" readonly>
            <span class="input-group-text">kg</span>
        </div>
    </div>
    <div class="sales-inv-total">
        <span class="sales-inv-total__label">Selling Weight</span>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" name="total_selling_weight" id="total_selling_weight" readonly>
            <span class="input-group-text">kg</span>
        </div>
    </div>
    <div class="sales-inv-total">
        <span class="sales-inv-total__label">Total Cost</span>
        <div class="input-group input-group-sm">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control" name="total_cuplump_cost" id="total-cuplump-cost" readonly>
        </div>
    </div>
    <div class="sales-inv-total sales-inv-total--accent">
        <span class="sales-inv-total__label">Avg Cost / kg</span>
        <div class="input-group input-group-sm">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control" name="average_cuplump_cost" id="average-cuplump-cost" readonly>
        </div>
    </div>
</div>
