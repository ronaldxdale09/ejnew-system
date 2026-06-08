<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/plantation-helpers.php';

if (empty($_SESSION['loc'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$container_id = (int) ($_POST['container_id'] ?? 0);
$container_id_esc = (int) $container_id;

$sql = "SELECT bcs.*, p.bales_type, p.kilo_per_bale, p.remaining_bales,
               r.total_production_cost, r.produce_total_weight, r.milling_cost,
               r.supplier, r.lot_num, r.recording_id
        FROM bales_container_selection bcs
        LEFT JOIN planta_bales_production p ON bcs.bales_id = p.bales_prod_id
        LEFT JOIN planta_recording r ON p.recording_id = r.recording_id
        WHERE bcs.container_id = '{$container_id_esc}'";

$result = mysqli_query($con, $sql);
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$total_bales_count = 0;
$total_weight = 0;
$total_bale_cost = 0;
$overall_milling_cost = 0;
$rows_html = '';

while ($arr = mysqli_fetch_assoc($result)) {
    $missingInfo = empty($arr['supplier']) || empty($arr['lot_num']) || empty($arr['num_bales']);
    $rowClass = $missingInfo ? ' class="table-warning"' : '';
    $weight = (float) $arr['num_bales'] * (float) $arr['kilo_per_bale'];
    $unit_cost = ((float) ($arr['produce_total_weight'] ?? 0)) != 0
        ? (float) $arr['total_production_cost'] / (float) $arr['produce_total_weight']
        : 0;
    $line_cost = $unit_cost * $weight;
    $line_milling = (float) ($arr['milling_cost'] ?? 0) * $weight;

    $total_bales_count += (float) $arr['num_bales'];
    $total_weight += $weight;
    $total_bale_cost += $line_cost;
    $overall_milling_cost += $line_milling;

    $rows_html .= '<tr' . $rowClass . ' data-bales-id="' . (int) $arr['bales_id'] . '">'
        . '<td>' . (int) $arr['bales_id'] . '</td>'
        . '<td><strong>' . adm_esc($arr['supplier'] ?? '—') . '</strong></td>'
        . '<td>' . adm_esc($arr['lot_num'] ?? '—') . '</td>'
        . '<td>' . adm_esc($arr['bales_type'] ?? '—') . '</td>'
        . '<td class="text-end">' . adm_esc($arr['kilo_per_bale']) . ' kg</td>'
        . '<td class="text-end"><strong>' . number_format((float) $arr['num_bales'], 0) . ' pcs</strong></td>'
        . '<td class="text-end">' . number_format($weight, 2) . ' kg</td>'
        . '<td class="text-end">≈ ₱ ' . number_format($unit_cost, 2) . '</td>'
        . '<td class="text-end">₱ ' . number_format($line_cost, 2) . '</td>'
        . '<td class="text-end">₱ ' . number_format((float) ($arr['milling_cost'] ?? 0), 2) . '</td>'
        . '<td class="text-end"><button type="button" class="btn btn-sm btn-outline-danger btn-remove-inventory">Remove</button></td>'
        . '</tr>';
}

$average_kilo_cost = $total_weight > 0 ? ($total_bale_cost + $overall_milling_cost) / $total_weight : 0;
?>
<div class="plantation-container-summary adm-kpi-grid adm-kpi-grid--strip mb-3">
    <div class="adm-kpi">
        <div class="adm-kpi__label">No. of Bales</div>
        <div class="adm-kpi__value" id="summary_num_bales"><?php echo number_format($total_bales_count, 0); ?> <small>pcs</small></div>
        <input type="hidden" name="num_bales" id="num_bales" value="<?php echo (int) $total_bales_count; ?>">
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Total Weight</div>
        <div class="adm-kpi__value" id="summary_total_weight"><?php echo number_format($total_weight, 2); ?> <small>kg</small></div>
        <input type="hidden" name="total_bale_weight" id="total_bale_weight" value="<?php echo number_format($total_weight, 2, '.', ''); ?>">
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Bale Cost</div>
        <div class="adm-kpi__value" id="summary_bale_cost">₱ <?php echo number_format($total_bale_cost, 2); ?></div>
        <input type="hidden" name="total_bale_cost" id="total_bale_cost" value="<?php echo number_format($total_bale_cost, 2, '.', ''); ?>">
    </div>
    <div class="adm-kpi adm-kpi--gold">
        <div class="adm-kpi__label">Avg Kilo Cost</div>
        <div class="adm-kpi__value" id="summary_avg_cost">₱ <?php echo number_format($average_kilo_cost, 2); ?></div>
        <input type="hidden" name="average_cost" id="average_cost" value="<?php echo number_format($average_kilo_cost, 2, '.', ''); ?>">
    </div>
    <div class="adm-kpi">
        <div class="adm-kpi__label">Milling Cost</div>
        <div class="adm-kpi__value" id="summary_milling_cost">₱ <?php echo number_format($overall_milling_cost, 2); ?></div>
        <input type="hidden" name="total_milling_cost" id="total_milling_cost" value="<?php echo number_format($overall_milling_cost, 2, '.', ''); ?>">
    </div>
</div>

<?php if ($rows_html === '') : ?>
    <div class="plantation-empty-state" id="container-empty-state">
        No bales selected yet. Click <strong>Select Inventory</strong> to add bales to this container.
    </div>
<?php else : ?>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover plantation-detail-table" id="container-selected-table">
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
                    <th class="text-end">Milling</th>
                    <th></th>
                </tr>
            </thead>
            <tbody><?php echo $rows_html; ?></tbody>
        </table>
    </div>
<?php endif; ?>
