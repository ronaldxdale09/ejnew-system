<?php
$q_inv = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as total_kg, SUM(remaining_bales) as total_pcs FROM planta_bales_production 
    LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.remaining_bales !=0 AND planta_recording.source='Kidapawan'");
$inv_data = mysqli_fetch_array($q_inv);
$total_kg = $inv_data['total_kg'] ?? 0;
$total_pcs = $inv_data['total_pcs'] ?? 0;

$q_val = mysqli_query($con, "SELECT 
    SUM((total_production_cost / produce_total_weight * remaining_bales * kilo_per_bale) + (milling_cost * remaining_bales * kilo_per_bale)) as total_value
    FROM (
        SELECT 
            planta_bales_production.remaining_bales,
            planta_bales_production.kilo_per_bale,
            planta_recording.total_production_cost,
            planta_recording.produce_total_weight,
            planta_recording.milling_cost
        FROM planta_bales_production 
        LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
        WHERE planta_bales_production.remaining_bales !=0 
          AND planta_recording.source='Kidapawan'
          AND planta_recording.status = 'For Sale'
    ) as sub");
$val_data = mysqli_fetch_array($q_val);
$total_value = $val_data['total_value'] ?? 0;
$avg_cost_per_kg = ($total_kg > 0) ? $total_value / $total_kg : 0;

$q_qual = mysqli_query($con, "SELECT bales_type, SUM(remaining_bales) as count FROM planta_bales_production 
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
WHERE remaining_bales != 0 AND planta_recording.source='Kidapawan' GROUP BY bales_type");
$qual_labels = [];
$qual_data = [];
while ($row = mysqli_fetch_assoc($q_qual)) {
    $qual_labels[] = $row['bales_type'];
    $qual_data[] = $row['count'];
}

$q_supp = mysqli_query($con, "SELECT planta_recording.supplier, SUM(remaining_bales * kilo_per_bale) as volume FROM planta_bales_production 
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
WHERE remaining_bales != 0 AND planta_recording.source='Kidapawan' 
GROUP BY planta_recording.supplier ORDER BY volume DESC LIMIT 5");
$supp_labels = [];
$supp_data = [];
while ($row = mysqli_fetch_assoc($q_supp)) {
    $supp_labels[] = $row['supplier'] ?: 'Unknown';
    $supp_data[] = $row['volume'];
}
?>

<div class="ops-inv-kpi-grid">
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--primary"><i class="fas fa-weight-hanging"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Stock (Weight)</div>
            <div class="ops-inv-kpi__value"><?php echo number_format($total_kg, 0); ?> <small>kg</small></div>
        </div>
    </div>
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--success"><i class="fas fa-cubes"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Stock (Bales)</div>
            <div class="ops-inv-kpi__value"><?php echo number_format($total_pcs, 0); ?> <small>bales</small></div>
        </div>
    </div>
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--warning"><i class="fas fa-money-bill-wave"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Total Valuation</div>
            <div class="ops-inv-kpi__value"><?php echo adm_peso($total_value); ?></div>
        </div>
    </div>
    <div class="ops-inv-kpi">
        <div class="ops-inv-kpi__icon ops-inv-kpi__icon--danger"><i class="fas fa-tag"></i></div>
        <div>
            <div class="ops-inv-kpi__label">Avg Cost / Kg</div>
            <div class="ops-inv-kpi__value"><?php echo adm_peso($avg_cost_per_kg, 2); ?></div>
        </div>
    </div>
</div>

<div class="ops-inv-panel">
    <div class="ops-inv-panel__head">Bale Inventory Details — Kidapawan</div>
    <div class="ops-inv-panel__body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped w-100 mb-0" id="kidapawan_inventory_table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Bale ID</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Lot</th>
                        <th>Qual</th>
                        <th>Kg</th>
                        <th>Prod</th>
                        <th>Rem</th>
                        <th>Rewt</th>
                        <th>Rub.Wt</th>
                        <th>DRC</th>
                        <th>Desc</th>
                        <th>Mill</th>
                        <th>Unit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="ops-inv-charts">
    <div class="ops-inv-panel">
        <div class="ops-inv-panel__head">Bale Quality Composition</div>
        <div class="ops-inv-panel__body ops-inv-panel__body--chart">
            <canvas id="kidapawanQualChart"></canvas>
        </div>
    </div>
    <div class="ops-inv-panel">
        <div class="ops-inv-panel__head">Top Suppliers by Volume (Kg)</div>
        <div class="ops-inv-panel__body ops-inv-panel__body--chart">
            <canvas id="kidapawanSuppChart"></canvas>
        </div>
    </div>
</div>

<script>
window.__baleInvKidapawan = <?php echo json_encode([
    'qual' => ['labels' => $qual_labels, 'data' => $qual_data],
    'supp' => ['labels' => $supp_labels, 'data' => $supp_data],
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>
