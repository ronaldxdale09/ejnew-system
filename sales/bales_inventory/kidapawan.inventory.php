<?php

$sql = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory,planta_recording.status as planta_status  from  planta_bales_production
   LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    where planta_bales_production.remaining_bales !=0  AND planta_recording.source='Kidapawan'");
$bales_Kidapawan = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
     LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
   where  planta_bales_production.remaining_bales !=0 AND planta_recording.source='Kidapawan' ");
$balesCount_Kidapawan  = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT 
    SUM(remaining_bales) AS total_bales_count,
    SUM(remaining_bales * kilo_per_bale) AS total_weight,
    SUM(total_production_cost / produce_total_weight * remaining_bales * kilo_per_bale) AS total_bale_cost,
    SUM(milling_cost * remaining_bales * kilo_per_bale) AS overall_milling_cost
    FROM (
        SELECT 
        planta_bales_production.remaining_bales,
            planta_bales_production.kilo_per_bale,
            planta_recording.total_production_cost,
            planta_recording.produce_total_weight,
            planta_recording.status,
            planta_recording.milling_cost
        FROM 
            bales_container_selection
            LEFT JOIN planta_bales_production 
                ON bales_container_selection.bales_id = planta_bales_production.bales_prod_id
            LEFT JOIN planta_recording 
                ON planta_bales_production.recording_id = planta_recording.recording_id
        WHERE 
        (planta_bales_production.remaining_bales !=0 AND planta_recording.source='Kidapawan') AND planta_recording.status = 'For Sale'
    ) AS subquery");

$data = mysqli_fetch_array($sql);
$ave_kilo_cost_kidapawan = !empty($data['total_weight']) ? ($data['total_bale_cost'] / $data['total_weight']) : 0;
$ave_kilo_cost_kidapawan_wMill  = !empty($data['total_weight']) ? (($data['total_bale_cost'] + $data['overall_milling_cost']) / $data['total_weight']) : 0;

?>
<div class="row sales-kpi-strip mb-3">
    <div class="col-md-3 col-6 mb-2">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (KG)</p>
                <h5><?php echo number_format($bales_Kidapawan['inventory'] ?? 0, 0); ?> kg</h5>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle"><i class="fa fa-weight"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY</p>
                <h5><?php echo number_format($balesCount_Kidapawan['inventory'] ?? 0, 0); ?> pcs</h5>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle"><i class="fa fa-cube"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>AVERAGE</b> INVENTORY COST</p>
                <h5>₱ <?php echo number_format($ave_kilo_cost_kidapawan ?? 0, 2); ?></h5>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle"><i class="fa fa-calculator"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-2">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>TOTAL AVERAGE</b> COST</p>
                <h5>₱ <?php echo number_format($ave_kilo_cost_kidapawan_wMill ?? 0, 2); ?></h5>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle"><i class="fa fa-info"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped w-100 bale-inventory-dt" style="width:100%"
        id="recording_table-produced-kidapawan" data-location="Kidapawan">
        <thead class="table-dark">
            <tr>
                <th>Status</th>
                <th>Bale ID</th>
                <th>Date Produced</th>
                <th>Supplier</th>
                <th>Lot No.</th>
                <th>Quality</th>
                <th>Kilo</th>
                <th>Produced Bales</th>
                <th>Remaining Bales</th>
                <th>Cuplump Weight</th>
                <th>Bale Weight</th>
                <th>DRC</th>
                <th>Description</th>
                <th>Mill Cost</th>
                <th>Unit Cost</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
