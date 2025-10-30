<?php

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field' AND planta_recording.source='Basilan'   ");
$cuplumps_basilan = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling'  AND planta_recording.source='Basilan'   ");
$milling_basilan = mysqli_fetch_array($sql);


$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' AND planta_recording.source='Basilan'    ");
$drying_basilan = mysqli_fetch_array($sql);





?>
<br>
<br>
<div class="row">
    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                <h3>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($cuplumps_basilan['inventory'] ?? 0, 0) ?> kg
                </h3>
                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-weight" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>

                <h3>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($milling_basilan['inventory'] ?? 0, 0) ?> kg
                </h3>

                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--secondary">
                <div class="stat-card__icon-circle">
                    <i class="fas fa-tint"></i><i class="fas fa-wind"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>

                <h3>
                    <i class="text-danger font-weight-bold mr-1"></i>
                    <?php echo number_format($drying_basilan['inventory'] ?? 0, 0) ?> kg
                </h3>

                <div>
                    <span class="text-muted">
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-weight" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<table class="table table-bordered table-hover table-striped" id='inventory-table-basilan'>
    <?php
    $results  = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
                                    FROM planta_recording
                                    LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                    WHERE planta_recording.status = 'Field' AND planta_recording.source='Basilan' "); ?>
    <thead class="table-dark">
        <tr>

            <th scope="col">Status</th>
            <th scope="col">ID</th>
            <th scope="col">Date Received</th>
            <th scope="col">Supplier</th>
            <th scope="col">Lot No.</th>
            <th scope="col">Weight</th>
            <th scope="col">Reweight</th>

        </tr>
    </thead>
    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>

                <td><span class="badge bg-success"> <?php echo $row['status'] ?> </span></td>
                <td> <span class="badge bg-secondary"> <?php echo $row['trans_type'] ?> - <?php echo $row['recording_id'] ?></span>
                </td>
                <td> <?php echo date('M d, Y g:i A', strtotime($row['receiving_date'])); ?> </td>
                <td> <?php echo $row['supplier'] ?> </td>
                <td> <?php echo $row['lot_num'] ?> </td>
                <td class="number-cell">
                    <?php echo number_format($row['weight'], 0, '.', ',') ?> kg</td>
                <td class="number-cell">
                    <?php echo number_format($row['reweight'], 0, '.', ',') ?> kg</td>



            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#inventory-table-basilan').DataTable({
            "order": [
                [1, 'asc']
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