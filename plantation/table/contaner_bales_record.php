<?php
include __DIR__ . '/../../function/db.php';
require_once __DIR__ . '/../include/plantation-helpers.php';

if (empty($_SESSION['loc'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$container_id = (int) ($_POST['container_id'] ?? 0);
if ($container_id <= 0) {
    echo '<div class="plantation-empty-state">Invalid container.</div>';
    exit;
}

$sql = "SELECT bcs.*, p.bales_type, p.kilo_per_bale, p.remaining_bales,
               r.total_production_cost, r.produce_total_weight, r.milling_cost,
               r.supplier, r.lot_num
        FROM bales_container_selection bcs
        LEFT JOIN planta_bales_production p ON bcs.bales_id = p.bales_prod_id
        LEFT JOIN planta_recording r ON p.recording_id = r.recording_id
        WHERE bcs.container_id = {$container_id}";

$result = mysqli_query($con, $sql);
if (!$result) {
    http_response_code(500);
    exit('Error loading bales.');
}

$total_bales_count = 0;
$total_weight = 0;
$total_bale_cost = 0;
$overall_milling_cost = 0;
$rows_html = '';

while ($arr = mysqli_fetch_assoc($result)) {
    $weight = (float) ($arr['num_bales'] ?? 0) * (float) ($arr['kilo_per_bale'] ?? 0);
    $produceWeight = (float) ($arr['produce_total_weight'] ?? 0);
    $unit_cost = $produceWeight != 0
        ? (float) ($arr['total_production_cost'] ?? 0) / $produceWeight
        : 0;
    $line_cost = $unit_cost * $weight;
    $milling_rate = (float) ($arr['milling_cost'] ?? 0);
    $line_milling = $milling_rate * $weight;

    $total_bales_count += (float) ($arr['num_bales'] ?? 0);
    $total_weight += $weight;
    $total_bale_cost += $line_cost;
    $overall_milling_cost += $line_milling;

    $rows_html .= '<tr>'
        . '<td><span class="plantation-view-bale-id">' . (int) ($arr['bales_id'] ?? 0) . '</span></td>'
        . '<td><strong>' . adm_esc($arr['supplier'] ?? '—') . '</strong></td>'
        . '<td>' . adm_esc($arr['lot_num'] ?? '—') . '</td>'
        . '<td><span class="badge bg-light text-dark border">' . adm_esc($arr['bales_type'] ?? '—') . '</span></td>'
        . '<td class="text-end">' . adm_esc($arr['kilo_per_bale'] ?? '—') . ' <small class="text-muted">kg</small></td>'
        . '<td class="text-end"><strong>' . number_format((float) ($arr['num_bales'] ?? 0), 0) . '</strong> <small class="text-muted">pcs</small></td>'
        . '<td class="text-end">' . number_format($weight, 2) . ' <small class="text-muted">kg</small></td>'
        . '<td class="text-end">≈ ₱ ' . number_format($unit_cost, 2) . '</td>'
        . '<td class="text-end">₱ ' . number_format($line_cost, 2) . '</td>'
        . '<td class="text-end">₱ ' . number_format($milling_rate, 2) . '</td>'
        . '<td class="text-end">₱ ' . number_format($line_milling, 2) . '</td>'
        . '</tr>';
}

$average_kilo_cost = $total_weight > 0 ? ($total_bale_cost + $overall_milling_cost) / $total_weight : 0;
?>

<div class="plantation-container-view-summary adm-kpi-grid adm-kpi-grid--strip">
    <div class="adm-kpi">
        <div class="adm-kpi__label">No. of Bales</div>
        <div class="adm-kpi__value"><?php echo number_format($total_bales_count, 0); ?> <small>pcs</small></div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Total Weight</div>
        <div class="adm-kpi__value"><?php echo number_format($total_weight, 2); ?> <small>kg</small></div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Total Bale Cost</div>
        <div class="adm-kpi__value">₱ <?php echo number_format($total_bale_cost, 2); ?></div>
    </div>
    <div class="adm-kpi adm-kpi--gold">
        <div class="adm-kpi__label">Avg Kilo Cost</div>
        <div class="adm-kpi__value">₱ <?php echo number_format($average_kilo_cost, 2); ?></div>
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Total Milling</div>
        <div class="adm-kpi__value">₱ <?php echo number_format($overall_milling_cost, 2); ?></div>
    </div>
</div>

<?php if ($rows_html === '') : ?>
<div class="plantation-empty-state">No bales recorded in this container.</div>
<?php else : ?>
<div class="plantation-modal-table-wrap plantation-view-bales__table">
    <table class="table table-sm table-hover plantation-detail-table mb-0">
        <thead>
            <tr>
                <th>Bale ID</th>
                <th>Supplier</th>
                <th>Lot</th>
                <th>Quality</th>
                <th class="text-end">Kilo/Bale</th>
                <th class="text-end">Withdrawn</th>
                <th class="text-end">Weight</th>
                <th class="text-end">Unit Cost</th>
                <th class="text-end">Line Cost</th>
                <th class="text-end">Milling/kg</th>
                <th class="text-end">Total Milling</th>
            </tr>
        </thead>
        <tbody><?php echo $rows_html; ?></tbody>
        <tfoot>
            <tr class="plantation-detail-table__foot">
                <td colspan="5"><strong>Totals</strong></td>
                <td class="text-end"><strong><?php echo number_format($total_bales_count, 0); ?></strong> <small class="text-muted">pcs</small></td>
                <td class="text-end"><strong><?php echo number_format($total_weight, 2); ?></strong> <small class="text-muted">kg</small></td>
                <td colspan="2" class="text-end"><strong>₱ <?php echo number_format($total_bale_cost, 2); ?></strong></td>
                <td></td>
                <td class="text-end"><strong>₱ <?php echo number_format($overall_milling_cost, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>
<?php endif; ?>
