<?php
include('../function/db.php');


$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM planta_bales_production 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
WHERE (planta_recording.status='Purchase' or planta_recording.status='For Sale' ) and (rubber_weight !='0' or rubber_weight IS NOT NULL)
ORDER BY planta_bales_production.recording_id ASC "; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 14px !important" >
            <tr>
            <th scope="col">BALE ID</th>
            <th scope="col">Status</th>
            <th scope="col">Type</th>
            <th scope="col">Supplier</th>
            <th scope="col">Location</th>
            <th scope="col">Lot No.</th>
            <th scope="col">Total Weight</th>
            <th scope="col">DRC</th>
            <th scope="col"> Num Bales</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  

        $output .= '
        <tr>
             <td>'.$arr["bales_prod_id"].'</td>
            <td>'.$arr["status"].'</td>
            <td>'.$arr["bales_type"].'</td>
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["location"].'</td>
            <td>'.$arr["lot_num"].'</td>
            <td>'.number_format($arr['produce_total_weight'], 0, '.', ',').' kg</td>
            <td>'.($arr['drc'] ? number_format($arr['drc'], 2) : '-').' %</td>
            <td><b>'.number_format($arr['number_bales'], 0, '.', ',').' pcs </b></td>
            <td class="keyvalue" > <input type="number" class="form-control quantity" placeholder="Quantity"  id="quantity" name="quantity"></td>
            <td><button type="button" id="addProduct" class="btn btn-warning btn-sm addProduct"><i
            class="fa fa-plus-circle"></i></button> </td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>';

echo $output;
?>


<script>
var container_id = <?php echo $_POST['container_id'] ?>;


$('.btnSelectTrans').on('click', function() {


    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $tr.each(function() {
        var quantity = $(this).find(".keyvalue input").val();

        console.log(quantity);



        var bales_id = data[0];

        var voucher = <?php echo $voucher ?>;


        $.ajax({
            method: "POST",
            url: "table/contailer/addInventory.php",
            data: {
                receiving_id: receiving_id,
                product_id: product_id,

            },
            success: function(data) {
                console.log('success');
                console.log(data);
                fetch_list();

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Product Added!',
                    showConfirmButton: false,
                    timer: 600
                })


            }

        });
    });


});


var table = $('#p_record_table').DataTable({
    dom: "frltip",

});
</script>