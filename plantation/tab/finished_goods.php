<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="recording_table-produced">
        <?php
        $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
            LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
            WHERE planta_bales_production.status='Production' and (rubber_weight !='0' or rubber_weight !=null)  ");
    ?>


        <thead class="table-dark">
            <tr>
                <th>Status</th>
                <th>Bale ID</th>
                <th>Date Produced</th>
                <th>Supplier</th>
                <th>Location</th>
                <th>Quality</th>
                <th>Kilo per Bale</th>
                <th>Bale Weight</th>
                <th>Bales</th>
                <th>Excess</th>
                <th>DRC</th>
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
                        class="badge bg-dark"><?php echo substr($row['bales_type'], 0, 3).'-'.$row['recording_id']?></span>
                </td>
                <td><?php echo $row['production_date']?></td>
                <td><?php echo $row['supplier']?></td>
                <td> <?php echo $row['location']?> </td>
                <td><?php echo $row['bales_type']?></td>
                <td class="number-cell"> <?php echo $row['kilo_per_bale']?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['rubber_weight'], 0, '.', ',')?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['number_bales'], 0, '.', ',')?></td>
                <td class="number-cell"><?php echo $row['bales_excess']?> kg</td>
                <td class="number-cell"><?php echo $row['drc']?>%</td>
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