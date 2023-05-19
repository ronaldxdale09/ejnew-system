<?php 
   include('include/header.php');
   include "include/navbar.php";
?>

<style>
.number-cell {
    text-align: right;
}
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> INVENTORY </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-striped table-responsive"
                                    style='width:100%' id="recording_table-produced">

                                    <?php
                             $results = mysqli_query($con, "SELECT planta_bales_production.*, planta_recording.*, rubber_transaction.total_amount as total_amount FROM planta_bales_production
                             LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                             LEFT JOIN rubber_transaction on planta_recording.purchased_id = rubber_transaction.id
                             WHERE (planta_bales_production.status='Production' AND planta_recording.status='Produced') and (rubber_weight !='0' or rubber_weight !=null)
                             ORDER BY planta_bales_production.recording_id ASC ");
                                ?>


                                    <thead class="table-dark">
                                        <tr>
                                            <th>Status</th>
                                            <th> ID</th>
                                            <th>Date Produced</th>
                                            <th>Supplier</th>
                                            <th>Lot No.</th>
                                            <th>Quality</th>
                                            <th>Kilo per Bale</th>
                                            <th>Bale Weight</th>
                                            <th>Bales</th>
                                            <th>Kilo Cost</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php if ($row['status'] == 'Produced'): ?>
                                                <span class="badge bg-primary"><?php echo $row['status']?></span>
                                                <?php elseif ($row['status'] == 'Pressing'): ?>
                                                <span class="badge bg-danger"><?php echo $row['status']?></span>
                                                <?php else: ?>
                                                <span class="badge"><?php echo $row['status']?></span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-secondary"><?php echo $row['recording_id']?></span>
                                            </td>

                                            <td><?php echo $row['production_date']?></td>
                                            <td><?php echo $row['supplier']?></td>
                                            <td> <?php echo $row['lot_num']?> </td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td class="number-cell" data-sort="<?php echo $row['kilo_per_bale']; ?>">
                                                <?php echo $row['kilo_per_bale']; ?> kg</td>
                                            <td class="number-cell" data-sort="<?php echo $row['rubber_weight']; ?>">
                                                <?php echo number_format($row['rubber_weight'], 0, '.', ','); ?> kg</td>
                                            <td class="number-cell" data-sort="<?php echo $row['number_bales']; ?>">
                                                <?php echo number_format($row['number_bales'], 0, '.', ','); ?> pcs</td>
                                            <td class="number-cell"
                                                data-sort="<?php echo $row['total_amount'] / $row['produce_total_weight']; ?>">
                                                ₱
                                                <?php echo number_format(($row['total_amount'] / $row['produce_total_weight']), 2, '.', ','); ?>
                                            </td>

                                            <td>Basilan</td>
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
<script src="js/recording.js"></script>

</html>