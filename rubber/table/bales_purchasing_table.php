<?php
include('../function/db.php');


                            $loc = $_SESSION["loc"];
$purchase_id = $_POST['purchase_id'];
$sql  = "SELECT *,dry_price_transfer.price as dry_price FROM planta_recording 
LEFT JOIN dry_price_transfer ON planta_recording.purchased_id = dry_price_transfer.dry_id
WHERE planta_recording.status='Purchase' and (produce_total_weight !='0' or produce_total_weight IS NOT NULL) and planta_recording.source='$loc'
ORDER BY planta_recording.recording_id ASC "; 

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
        data-supplier="'.$arr['supplier'].'"
        data-location="'.$arr['location'].'"
        data-drc="'.$arr['drc'].'"
        data-total_weight="'.$arr['produce_total_weight'].'"
        data-receiving_date="'.$arr['receiving_date'].'"
        data-dry_price="'.$arr['dry_price'].'"
        data-lot_num="'.$arr['lot_num'].'"

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
    var purchase_id = <?php echo $purchase_id?>;

    console.log(purchase_id)
    var $tr = $(this).closest('tr');
    var entryWeight = $tr.data('entry-weight');
    var netWeight = $tr.data('net-weight');
    var drc = $tr.data('drc');
    var total_weight = $tr.data('total_weight');

    var recording_id = $tr.data('recording_id');
    var lot_number = $tr.data('lot_num');
    var receiving_date = new Date($tr.data('receiving_date')).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

    var dry_price = $tr.data('dry_price');
    var supplier = $tr.data('supplier');
    var location = $tr.data('v');
    $('#name').val(supplier).trigger('chosen:updated');
    // Insert the data into the input fields
    $('#entry').val(entryWeight);
    $('#drc').val(drc);
    $('#total_net_weight').val(total_weight);
    $('#price_1').val(dry_price);
    $('#weight_1').val(total_weight);
    
    $('#recording_id').val(recording_id);
    $('#m_lot_number').val(lot_number);
    ('#lot_code').val(lot_number);
    $('#m_delivery_date').val(receiving_date);
    $('#m_prod_id').val(recording_id);


    $.ajax({
        url: 'table/fetch/balesGetInventory.php', // Path to the PHP script
        type: 'POST',
        data: { 
            'recording_id': recording_id,
           'purchase_id' : purchase_id
        },
        success: function(response) {
            // Do something on success
            console.log('Data successfully inserted!');

            nameChange(supplier);
            fetch_record();
            computeBalesRubber()
        },
        error: function(error) {
            // Do something on error
            console.log('Error:', error);
        }
    });



    // Close the modal
    $('#modal_produced_record').modal('hide');
});
</script>