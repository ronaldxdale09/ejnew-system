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
                                            <th>Location</th>
                                            <th>Quality</th>
                                            <th>Kilo per Bale</th>
                                            <th>Bale Weight</th>
                                            <th>Bales</th>
                                            <th>Excess</th>
                                            <th>Kilo Cost</th>

                                            <th class="text-center">Action</th>
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
                                            <td> <?php echo $row['location']?> </td>
                                            <td><?php echo $row['bales_type']?></td>
                                            <td class="number-cell"> <?php echo $row['kilo_per_bale']?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['rubber_weight'], 0, '.', ',')?> kg</td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['number_bales'], 0, '.', ',')?> pcs</td>
                                            <td class="number-cell"><?php echo $row['bales_excess']?> kg</td>
                                            <td class="number-cell">₱  <?php echo number_format(($row['total_amount']/   $row['produce_total_weight']), 2, '.', ',')?></td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btnProducedView">
                                                    <i class="fas fa-book"></i> View
                                                </button>
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
                                    "pageLength": 50,
                                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                                    "responsive": true
                                });
                            });
                            </script>
                            <script>
                            $('.producedView').on('click', function() {
                                $tr = $(this).closest('tr');

                                var data = $tr.children("td").map(function() {
                                    return $(this).text();
                                }).get();

                                $('#process_supplier').val(data[3]);
                                $('#process_weight').val(data[9]);
                                $('#p_recording_id').val(data[0]);

                                $('#modal_produced').modal('show');


                            });






                            $('.btnProducedView').on('click', function() {
                                $tr = $(this).closest('tr');

                                var data = $tr.children("td").map(function() {
                                    return $(this).text();
                                }).get();


                                $('#prod_trans_id').val(data[1]);
                                $('#prod_trans_date').val(data[2]);
                                $('#prod_trans_supplier').val(data[3]);
                                $('#prod_trans_loc').val(data[4]);
                                $('#prod_trans_lot').val(data[5]);


                                $('#prod_trans_entry').val(parseFloat(data[6]).toLocaleString());

                                $('#prod_trans_drc').val(data[8]);
                                $('#prod_trans_total_weight').val(data[7]);

                                function fetch_data() {

                                    var recording_id = data[1].replace(/\s+/g, '');
                                    $.ajax({
                                        url: "table/pressing_data.php",
                                        method: "POST",
                                        data: {
                                            recording_id: recording_id,

                                        },
                                        success: function(data) {
                                            $('#produced_modal_table').html(data);
                                            $('#modal_produced_record').modal('show');

                                        }
                                    });
                                }
                                fetch_data();

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