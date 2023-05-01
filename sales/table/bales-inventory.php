

<?php
include "../function/db.php";
$output = '';
$sales_id = $_POST['sales_id'];


$result = mysqli_query($con, "SELECT DISTINCT planta_bales_production.*, planta_recording.supplier as supplier,planta_recording.status as status
,planta_recording.production_date,rubber_transaction.total_amount as total_amount,rubber_transaction.net_weight as net_weight
FROM planta_bales_production
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
WHERE planta_recording.status ='Produced' and rubber_weight !=0");

$total_cost = 0.0;
$total_weight = 0.0;
$total_bales = 0.0;
$cost_per_kilo = 0.0;

$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th>ID</th>
           <th>Source</th>
           <th>Date Produced</th>
           <th>Quality</th>
           <th>No. of Bales</th>
           <th>Bale Weight</th>
           <th>Weight</th>
           <th>Total Cost</th>
           <th>Cost per Kilo</th>
    
           <th width="8%">Select Num. Bales</th>
           <th></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_weight += floatval($row['rubber_weight']);
        $total_bales += floatval($row['number_bales']);

        $output .= '
        <tr>
            <td>' . $row["bales_prod_id"] . '</td>
            <td>' . $row["supplier"] . '</td>
            <td>' . $row["production_date"] . '</td>
            <td>' . $row["bales_type"] . ' </td>
            <td>' . $row["number_bales"] . ' PCS</td>
            <td>' . $row["kilo_per_bale"] . '</td>
            <td>' . $row["rubber_weight"] . '</td>
            <td>₱ '.number_format(($row['total_amount']), 2, '.', ',').' </td>
            <td>₱ '.number_format(($row['total_amount']/ $row['net_weight']), 2, '.', ',').' </td>
            <td> <input  class="form-control" id="bales_num_' . $row["bales_prod_id"] . '" name="bales_num[]" value="' . number_format($row["number_bales"], 0, '.', ',') . '" />
            </td>
            <td><button type="button" id="addProduct" class="btn btn-warning btn-sm addProduct"><i
            class="fa fa-plus-circle"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">Nothings in the cart</td>
 </tr>';
}

$output .= '</table>';

echo $output;

?>


<script>
$(document).ready(function() {


    $('.addProduct').on('click', function() {


        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $tr.each(function() {
            var quantity = $(this).find(".keyvalue input").val();
            var inputBales = parseFloat($(this).find("input[name='bales_num[]']").val().replace(/,/g, ''));
            console.log(quantity);



            var bales_id = data[0];

            var sales_id = <?php echo $sales_id ?>;


            console.log(sales_id)

            console.log(bales_id)
            $.ajax({
                method: "POST",
                url: "table/button/bales_add_inventory.php",
                data: {
                    bales_id: bales_id,
                    sales_id: sales_id,
                    input_bales_number: inputBales
                },
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    fetch_cost_weight();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Inventory Added!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        });


    });


});
</script>