<?php

$sql = mysqli_query($con, "SELECT SUM(remaining_bales * kilo_per_bale) as inventory,planta_recording.status as planta_status  from  planta_bales_production
   LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
    where planta_bales_production.remaining_bales !=0  AND planta_recording.source='Basilan'");
$bales_basilan = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(remaining_bales) as inventory from  planta_bales_production 
     LEFT JOIN planta_recording on planta_bales_production.recording_id = planta_recording.recording_id
   where  planta_bales_production.remaining_bales !=0 AND planta_recording.source='Basilan' ");
$balesCount_basilan = mysqli_fetch_array($sql);





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
        (planta_bales_production.remaining_bales !=0 AND planta_recording.source='Basilan') AND planta_recording.status = 'For Sale'
    ) AS subquery");


$data = mysqli_fetch_array($sql);
$ave_kilo_cost_basilan = ($data['total_bale_cost']) / $data['total_weight'];
$ave_kilo_cost_basilan_wMill = ($data['total_bale_cost'] + $data['overall_milling_cost']) / $data['total_weight'];








?>
<br>
<div class="row">
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (KG)</p>
                <h4>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($bales_basilan['inventory'] ?? 0, 0) ?> kg
                </h4>
                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--primary">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-weight"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY </p>
                <h4>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($balesCount_basilan['inventory'] ?? 0, 0) ?> pcs
                </h4>
                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-cube"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>AVERAGE</b> INVENTORY COST
                    <span data-toggle="tooltip" data-placement="left"
                        title="Average cost of bale inventory for sale only." style="cursor: pointer; font-size: 15px;">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </p>

                <h5>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($ave_kilo_cost_basilan ?? 0, 2) ?>
                </h5>
                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-calculator"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>TOTAL AVERAGE</b> COST <span data-toggle="tooltip"
                        data-placement="left" title="Average cost of bale inventory for sale only."
                        style="cursor: pointer; font-size: 15px;">
                        <i class="fas fa-info-circle"></i>
                    </span></p>
                <h5>
                    <i class="text-success font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format($ave_kilo_cost_basilan_wMill ?? 0, 2) ?>
                </h5>
                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-info"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<table class="table table-bordered table-hover table-striped table-responsive" style='width:100%'
    id="recording_table-produced-basilan">

    <?php
    $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                                   LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                                   WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null) 
                                   and (remaining_bales !='0' and 
                                   planta_recording.source='Basilan')
                                   ORDER BY planta_bales_production.recording_id ASC ");
    ?>


    <thead class="table-dark" style='font-size:13px'>
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
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td>
                    <?php if ($row['status'] == 'For Sale'): ?>
                        <span class="badge bg-primary">
                            <?php echo $row['status'] ?>
                        </span>

                    <?php elseif ($row['status'] == 'Drying'): ?>
                        <span class="badge bg-warning">
                            <?php echo $row['status'] ?>
                        </span>

                    <?php elseif ($row['status'] == 'Pressing'): ?>
                        <span class="badge bg-danger">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Purchase'): ?>
                        <span class="badge bg-info">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Complete'): ?>
                        <span class="badge bg-success">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php else: ?>
                        <span class="badge">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php endif; ?>
                </td>
                <td>
                    <span class="badge bg-secondary">
                        <?php echo $row['bales_prod_id'] ?>
                    </span>
                </td>
                <td>
                    <?php echo date('M d, Y', strtotime($row['production_date'])); ?>
                </td>
                <td>
                    <?php echo $row['supplier'] ?>
                </td>
                <td>
                    <?php echo $row['lot_num'] ?>
                </td>
                <td>
                    <?php echo $row['bales_type'] ?>
                </td>
                <td class="number-cell">
                    <?php echo $row['kilo_per_bale'] ?> kg
                </td>
                <td class="number-cell bales-column">
                    <?php echo number_format($row['number_bales'], 0, '.', ',') ?> pcs
                </td>
                <td class="number-cell remaining-column">
                    <?php echo number_format($row['remaining_bales'], 0, '.', ',') ?> pcs
                </td>
                <td class="number-cell">
                    <?php echo number_format($row['reweight'], 0, '.', ',') ?> kg
                </td>
                <td class="number-cell">
                    <?php echo number_format($row['rubber_weight'], 0, '.', ',') ?> kg
                </td>

                <td class="number-cell">
                    <?php echo number_format($row['drc'], 2) ?> %
                </td>
                <td>
                    <?php echo $row['description'] ?>
                </td>
                <?php if ($row['status'] == 'For Sale'): ?>
                    <td>₱
                        <?php echo number_format($row['milling_cost']) ?>
                    </td>
                    <td>₱
                        <?php echo number_format($row['total_production_cost'] / $row['produce_total_weight'], 2) ?>
                    </td>
                <?php else: ?>
                    <td>-</td>
                    <td>-</td>
                <?php endif; ?>


            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        var table = $('#recording_table-produced-basilan').DataTable({
            "order": [
                [1, 'desc']
            ],
            "pageLength": -1,
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
            "responsive": true,
            "buttons": [{
                extend: 'excelHtml5',
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });
</script>