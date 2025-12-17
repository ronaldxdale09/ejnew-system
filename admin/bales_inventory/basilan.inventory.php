<?php
// --- KPI DATA ---
// 1. Total Bale Inventory (KG)
$q_inv = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as total_kg, SUM(remaining_bales) as total_pcs FROM planta_bales_production 
    LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    WHERE planta_bales_production.remaining_bales !=0 AND planta_recording.source='Basilan'");
$inv_data = mysqli_fetch_array($q_inv);
$total_kg = $inv_data['total_kg'] ?? 0;
$total_pcs = $inv_data['total_pcs'] ?? 0;

// 2. Valuation
$q_val = mysqli_query($con, "SELECT 
    SUM((total_production_cost / produce_total_weight * remaining_bales * kilo_per_bale) + (milling_cost * remaining_bales * kilo_per_bale)) as total_value,
    SUM(remaining_bales * kilo_per_bale) as valuated_weight
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
          AND planta_recording.source='Basilan'
          AND planta_recording.total_production_cost > 0
    ) as sub");
$val_data = mysqli_fetch_array($q_val);
$total_value = $val_data['total_value'] ?? 0;
$valuated_weight = $val_data['valuated_weight'] ?? 0;
$avg_cost_per_kg = ($valuated_weight > 0) ? $total_value / $valuated_weight : 0;


// --- CHART DATA 1: Quality Breakdown ---
$q_qual = mysqli_query($con, "SELECT bales_type, SUM(remaining_bales) as count FROM planta_bales_production 
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
WHERE remaining_bales != 0 AND planta_recording.source='Basilan' GROUP BY bales_type");
$qual_labels = [];
$qual_data = [];
while ($row = mysqli_fetch_assoc($q_qual)) {
    $qual_labels[] = $row['bales_type'];
    $qual_data[] = $row['count'];
}

// --- CHART DATA 2: Top 5 Suppliers (by Volume) ---
$q_supp = mysqli_query($con, "SELECT supplier, SUM(remaining_bales * kilo_per_bale) as volume FROM planta_bales_production 
LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
WHERE remaining_bales != 0 AND planta_recording.source='Basilan' 
GROUP BY supplier ORDER BY volume DESC LIMIT 5");
$supp_labels = [];
$supp_data = [];
while ($row = mysqli_fetch_assoc($q_supp)) {
    $supp_labels[] = $row['supplier'];
    $supp_data[] = $row['volume'];
}

?>

<div class="row mb-4">
    <!-- KPI 1: Inventory KG -->
    <div class="col-md-3">
        <div class="stat-card p-3 h-100">
            <div class="d-flex align-items-center mb-2">
                <div class="stat-icon icon-primary me-3"><i class="fas fa-weight-hanging"></i></div>
                <div>
                    <h6 class="text-muted text-uppercase fs-7 mb-1">Stock (Weight)</h6>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_kg, 0); ?> <small
                            class="fs-6 text-muted">kg</small></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- KPI 2: Inventory Pcs -->
    <div class="col-md-3">
        <div class="stat-card p-3 h-100">
            <div class="d-flex align-items-center mb-2">
                <div class="stat-icon icon-success me-3"><i class="fas fa-cubes"></i></div>
                <div>
                    <h6 class="text-muted text-uppercase fs-7 mb-1">Stock (Bales)</h6>
                    <h3 class="fw-bold mb-0 text-dark"><?php echo number_format($total_pcs, 0); ?> <small
                            class="fs-6 text-muted">bales</small></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- KPI 3: Total Value -->
    <div class="col-md-3">
        <div class="stat-card p-3 h-100">
            <div class="d-flex align-items-center mb-2">
                <div class="stat-icon icon-warning me-3"><i class="fas fa-money-bill-wave"></i></div>
                <div>
                    <h6 class="text-muted text-uppercase fs-7 mb-1">Total Valuation</h6>
                    <h3 class="fw-bold mb-0 text-dark">₱<?php echo number_format($total_value, 0); ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- KPI 4: Avg Cost -->
    <div class="col-md-3">
        <div class="stat-card p-3 h-100">
            <div class="d-flex align-items-center mb-2">
                <div class="stat-icon icon-danger me-3"><i class="fas fa-tag"></i></div>
                <div>
                    <h6 class="text-muted text-uppercase fs-7 mb-1">Avg Cost / Kg</h6>
                    <h3 class="fw-bold mb-0 text-dark">₱<?php echo number_format($avg_cost_per_kg, 2); ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Table: Inventory List (Full Width) -->
    <div class="col-12 mb-4">
        <div class="stat-card h-100 chart-card">
            <div class="inv-header mb-3">
                <div class="inv-title">Bale Inventory Details</div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped w-100" id="basilan_inventory_table">
                        <thead class="table-dark small">
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
                        <tbody class="small align-middle">
                            <!-- Server Side -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart 1: Quality Distribution -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card h-100 chart-card">
            <div class="inv-header mb-3">
                <div class="inv-title">Bale Quality Composition</div>
            </div>
            <div class="card-body" style="height: 300px; position: relative;">
                <canvas id="basilanQualChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 2: Top Suppliers -->
    <div class="col-lg-6 mb-4">
        <div class="stat-card h-100 chart-card">
            <div class="inv-header mb-3">
                <div class="inv-title">Top Suppliers by Volume (Kg)</div>
            </div>
            <div class="card-body" style="height: 300px; position: relative;">
                <canvas id="basilanSuppChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
    // Chart 1: Quality
    const ctxBq = document.getElementById('basilanQualChart').getContext('2d');
    new Chart(ctxBq, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($qual_labels); ?>,
            datasets: [{
                data: <?php echo json_encode($qual_data); ?>,
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    // Chart 2: Suppliers
    const ctxBs = document.getElementById('basilanSuppChart').getContext('2d');
    new Chart(ctxBs, {
        type: 'bar', // Horizontal bar ? No, vertical for top 5 is fine, but horizontal is better for names
        indexAxis: 'y',
        data: {
            labels: <?php echo json_encode($supp_labels); ?>,
            datasets: [{
                label: 'Volume (Kg)',
                data: <?php echo json_encode($supp_data); ?>,
                backgroundColor: '#3b82f6',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // Table
    $(document).ready(function () {
        $('#basilan_inventory_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "fetch/fetchBaleInventory.php",
                "type": "POST",
                "data": { location: 'Basilan' }
            },
            "columns": [
                { "data": "status" },
                { "data": "bales_prod_id" },
                { "data": "date" },
                { "data": "supplier" },
                { "data": "lot_num" },
                { "data": "quality" },
                { "data": "kilo" },
                { "data": "produced", "className": "table-info fw-bold text-center" }, // Highlight produced
                { "data": "remaining", "className": "bg-success text-white fw-bold text-center" }, // Highlight remaining
                { "data": "reweight" },
                { "data": "rubber_weight" },
                { "data": "drc" },
                { "data": "description" },
                { "data": "mill_cost", "className": "text-end" },
                { "data": "unit_cost", "className": "text-end" },
                { "data": "total_cost", "className": "text-end" }
            ],
            "order": [[2, "desc"]],
            "pageLength": 10,
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            buttons: ['excel', 'print']
        });
    });
</script>