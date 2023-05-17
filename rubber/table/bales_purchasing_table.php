<?php
include('../function/db.php');

$sql  = "SELECT * FROM planta_bales_production 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
WHERE planta_recording.status='Purchase' and (rubber_weight !='0' or rubber_weight IS NOT NULL)
ORDER BY planta_bales_production.recording_id ASC "; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 14px !important" >
            <tr>
            <th scope="col">Status</th>
            <th scope="col">ID</th>
            <th scope="col">Supplier</th>
            <th scope="col">Location</th>
            <th scope="col">Lot No.</th>
            <th scope="col">Entry Weight</th>
            <th scope="col">Total Weight</th>
            <th scope="col">DRC</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  

        $output .= '
        <tr data-entry-weight="'.number_format($arr['weight'], 0, '.', ',').'"
        data-recording_id="'.$arr['recording_id'].'"
        data-lot_num="'.$arr['lot_num'].'"
        data-receiving_date="'.$arr['receiving_date'].'"
        data-net-weight="'.number_format($arr['produce_total_weight'], 0, '.', ',').'">
            <td>'.$arr["status"].'</td>
            <td>'.$arr["recording_id"].'</td>
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["location"].'</td>
            <td>'.$arr["lot_num"].'</td>
            <td>'.number_format($arr['weight'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['produce_total_weight'], 0, '.', ',').' kg</td>
            <td>'.($arr['drc'] ? number_format($arr['drc'], 2) : '-').' %</td>
            <td scope="col">  <button type="button" class="btn btn-warning text-dark btnSelectTrans"
            id="receiptBtn">Select</button></td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>';

echo $output;
?>

<script>
$('.btnSelectTrans').on('click', function() {
    var $tr = $(this).closest('tr');
    var entryWeight = $tr.data('entry-weight');
    var netWeight = $tr.data('net-weight');
    var recording_id = $tr.data('recording_id');
    var lot_number = $tr.data('lot_num');
    var receiving_date = new Date($tr.data('receiving_date')).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

     
    // Insert the data into the input fields
    $('#entry').val(entryWeight);
    $('#net_weight_1').val(netWeight).trigger('keyup');
    $('#recording_id').val(recording_id);
    $('#m_lot_number').val(lot_number);
    $('#m_delivery_date').val(receiving_date);
    $('#m_prod_id').val(recording_id);

    // Close the modal
    $('#modal_produced_record').modal('hide');
});
</script>