<style>
.bales-column {
    background-color: rgb(230, 236, 245) !important;
    font-weight:bold;
}
.remaining-column {
    background-color: rgb(245, 230, 236) !important;
    font-weight:bold;
}
</style>

<div class="table-responsive">
    <br>
    <div id="datatable_filter">
        <label>From: <input type="text" class='form-control' id="min" name="min"></label>
        <label>To: <input type="text" class='form-control' id="max" name="max"></label>
        <button class='btn btn-primary' id="today">Today</button>
        <button class='btn btn-secondary' id="this-week">This Week</button>
        <button class='btn btn-dark' id="this-month">This Month</button>
    </div>
    <hr>
    <table class="table table-bordered table-hover table-striped table-responsive" style='width:100%'
        id="recording_table-produced">

        <?php
       $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
       LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
       WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null) and remaining_bales !='0'
       ORDER BY planta_bales_production.recording_id ASC ");
             ?>


        <thead class="table-dark" style='font-size:13px'>
            <tr>
                <th>Status</th>
                <th>Bale ID</th>
                <th>Date Produced</th>
                <th>Quality</th>
                <th>Kilo</th>
                <th>Supplier</th>
                <th>Lot No.</th>
                <th>Bales</th>
                <th>Bales in Container</th>
                <th>Excess</th>
                <th>Bale Weight</th>
                <th>DRC</th>
                <!-- <th>Overhead</th> -->
                <th>Description</th>
                <!-- <th>Cost</th> -->
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
                    <?php elseif ($row['status'] == 'Purchase'): ?>
                    <span class="badge bg-info"><?php echo $row['status']?></span>
                    <?php elseif ($row['status'] == 'For Sale'): ?>
                    <span class="badge bg-primary"><?php echo $row['status']?></span>
                    <?php else: ?>
                    <span class="badge"><?php echo $row['status']?></span>
                    <?php endif; ?>
                </td>

                <td>
                    <span class="badge bg-secondary"><?php echo $row['bales_prod_id']?></span>
                </td>
                <td>
                    <?php 
                        $date = new DateTime($row['production_date']);
                        echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                    ?>
                </td>
                <td><?php echo $row['bales_type']?></td>
                <td class="number-cell"> <?php echo $row['kilo_per_bale']?> kg</td>
                <td><?php echo $row['supplier']?></td>
                <td><?php echo $row['lot_num']?></td>
                <td class="number-cell bales-column"> <?php echo number_format($row['number_bales'], 0, '.', ',')?> pcs </td>
                <td class="number-cell remaining-column"> <?php echo number_format($row['number_bales'] - $row['remaining_bales'], 0, '.', ',')?> pcs </td>
                <td class="number-cell"> <?php echo number_format($row['bales_excess'], 0, '.', ',')?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['rubber_weight'], 0, '.', ',')?> kg</td>
                <td class="number-cell"><?php echo number_format($row['drc'],2)?> %</td>
                <!-- <td class="number-cell">₱ <?php echo number_format($row['mill_cost'],2)?></td> -->
                <td><?php echo $row['description']?></td>
                <td class="text-center">
                    <button type="button" data-recording_id='<?php echo $row['recording_id']?>'
                        class="btn btn-success btn-sm btnProducedView">
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


    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[3]);

            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    $("#min").datepicker({
        onSelect: function() {
            table.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function() {
            table.draw();
        },
        changeMonth: true,
        changeYear: true
    });

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

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function() {
        table.draw();
    });

    // Quick date filters
    $('#today').on('click', function() {
        var today = new Date();
        $('#min, #max').datepicker('setDate', today);
        table.draw();
    });

    $('#this-week').on('click', function() {
        var today = new Date();
        var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
            .getDay());
        $('#min').datepicker('setDate', firstDayOfWeek);
        $('#max').datepicker('setDate', today);
        table.draw();
    });

    $('#this-month').on('click', function() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        $('#min').datepicker('setDate', firstDayOfMonth);
        $('#max').datepicker('setDate', today);
        table.draw();
    });


});
</script>
<script>
$('.btnProducedView').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    var recording = $(this).data('recording_id');

    $('#prod_trans_id').val(data[1]);
    $('#prod_trans_date').val(data[2]);
    $('#prod_trans_supplier').val(data[3]);
    $('#prod_trans_loc').val(data[4]);
    $('#prod_trans_lot').val(data[5]);


    $('#prod_trans_entry').val(parseFloat(data[6]).toLocaleString());

    $('#prod_trans_drc').val(data[12]);
    $('#prod_trans_total_weight').val(data[8]);


    function fetch_record() {

        $.ajax({
            url: "table/pressing_data.php",
            method: "POST",
            data: {
                recording_id: recording,

            },
            success: function(data) {
                $('#produced_modal_table').html(data);
                $('#modal_produced_record').modal('show');

            }
        });
    }
    fetch_record();


});
</script>