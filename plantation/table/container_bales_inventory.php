<?php
include '../../function/db.php';
require_once __DIR__ . '/../include/plantation-helpers.php';

if (empty($_SESSION['loc'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$loc = plantation_loc_sql();
$locEsc = mysqli_real_escape_string($con, $loc);
$container_id = (int) ($_POST['container_id'] ?? 0);

$sql = "SELECT p.bales_prod_id, p.status, p.bales_type, p.kilo_per_bale, p.remaining_bales,
               p.recording_id, p.rubber_weight,
               r.produce_total_weight, r.drc,
               r.supplier, r.lot_num
        FROM planta_bales_production p
        INNER JOIN planta_recording r ON p.recording_id = r.recording_id
        WHERE COALESCE(p.remaining_bales, 0) > 0
          AND p.status IN ('Produced', 'For Sale')
          AND r.source = '{$locEsc}'
        ORDER BY p.recording_id ASC";

$result = mysqli_query($con, $sql);
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}
?>
<div class="plantation-container-picker__filter mb-2">
    <label for="kilobale_filter" class="form-label mb-1">Filter by kilo</label>
    <select class="form-select form-select-sm" id="kilobale_filter" style="max-width: 180px;">
        <option value="">All sizes</option>
        <option value="35">35 kg</option>
        <option value="33.33">33.33 kg</option>
    </select>
</div>
<div class="table-responsive plantation-modal-table-wrap">
    <table class="table table-sm table-bordered table-hover plantation-detail-table" id="bales-inventory" width="100%">
        <thead>
            <tr>
                <th>Bale ID</th>
                <th>Status</th>
                <th>Type</th>
                <th>Kilo</th>
                <th>Supplier</th>
                <th>Lot</th>
                <th class="text-end">Available</th>
                <th style="width: 90px;">Qty</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0) :
            while ($arr = mysqli_fetch_assoc($result)) : ?>
            <tr <?php echo plantation_tr_attrs([
                'bales-id' => $arr['bales_prod_id'],
                'planta-id' => $arr['recording_id'],
                'max-bales' => $arr['remaining_bales'],
                'total-weight' => $arr['produce_total_weight'],
                'kilo-bale' => $arr['kilo_per_bale'],
            ]); ?>>
                <td><?php echo (int) $arr['bales_prod_id']; ?></td>
                <td><span class="badge bg-primary"><?php echo adm_esc($arr['status']); ?></span></td>
                <td><?php echo adm_esc($arr['bales_type']); ?></td>
                <td><?php echo adm_esc($arr['kilo_per_bale']); ?> kg</td>
                <td><?php echo adm_esc($arr['supplier']); ?></td>
                <td><strong><?php echo adm_esc($arr['lot_num']); ?></strong></td>
                <td class="text-end"><strong><?php echo number_format((float) $arr['remaining_bales'], 0); ?> pcs</strong></td>
                <td><input type="number" class="form-control form-control-sm container-qty-input" min="1" step="1" placeholder="0"></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm btn-add-inventory" title="Add to container">
                        <i class="fa fa-plus"></i>
                    </button>
                </td>
            </tr>
            <?php endwhile;
        else : ?>
            <tr><td colspan="9" class="text-center text-muted py-3">No bales available for withdrawal.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
