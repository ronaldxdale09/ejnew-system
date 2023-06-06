<?php 
   include('include/header.php');
   include "include/navbar.php";

$sql = mysqli_query($con, "SELECT SUM(produce_total_weight) as inventory from  planta_recording where status='For Sale' or status='Purchase'  "); 
$bales = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(number_bales) as inventory from  planta_bales_production where status !='Sold'   "); 
$balesCount = mysqli_fetch_array($sql);

?>

<style>
.number-cell {
    text-align: right;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">Bale</font>
                                <font color="#046D56"> Inventory </font>
                            </b>
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY (KG)</p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($bales['inventory'] ?? 0, 0) ?> kg
                                        </h3>
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
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>BALE</b> INVENTORY </p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($balesCount['inventory'] ?? 0, 0) ?> pcs
                                        </h3>
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
                        </div>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-striped table-responsive"
                                    style='width:100%' id="recording_table-produced">

                                    <?php
                    $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                    LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                    WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null)
                    ORDER BY planta_bales_production.recording_id ASC ");
                    ?>


                                    <thead class="table-dark" style='font-size:13px'>
                                        <tr>
                                            <th>Status</th>
                                            <th>Wet ID</th>
                                            <th>Bale ID</th>
                                            <th>Date Produced</th>
                                            <th>Supplier</th>
                                            <th>Lot No.</th>
                                            <th>Quality</th>
                                            <th>Bale Kilo</th>
                                            <th>No. of Bales</th>
                                            <th>Excess Kilo</th>
                                            <th>Total Weight</th>
                                            <th>DRC</th>
                                            <th>Description (Buyer) </th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php if ($row['status'] == 'For Sale'): ?>
                                                <span class="badge bg-primary"><?php echo $row['status']?></span>
                                                <?php elseif ($row['status'] == 'Pressing'): ?>
                                                <span class="badge bg-danger"><?php echo $row['status']?></span>
                                                <?php elseif ($row['status'] == 'Purchase'): ?>
                                                <span class="badge bg-info"><?php echo $row['status']?></span>
                                                <?php else: ?>
                                                <span class="badge bg-success"><?php echo $row['status']?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?php echo $row['purchased_id']?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-secondary"><?php echo $row['bales_prod_id']?></span>
                                            </td>
                                            <td><?php echo date('M d, Y H:i', strtotime($row['production_date']))?>
                                            </td>
                                            <td><?php echo $row['supplier']?></td>
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td class="number-cell"> <?php echo $row['kilo_per_bale']?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['number_bales'], 0, '.', ',')?> pcs</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['bales_excess'], 0, '.', ',')?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['rubber_weight'], 0, '.', ',')?> kg</td>

                                            <td class="number-cell"><?php echo number_format($row['drc'],2)?> %</td>
                                            <td><?php echo $row['description']?></td>
                                            <td> ₱
                                                <?php echo number_format($row['total_production_cost']/$row['produce_total_weight'],2)?>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                            <script>
                            $(document).ready(function() {
                                var table = $('#recording_table-produced').DataTable({
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>