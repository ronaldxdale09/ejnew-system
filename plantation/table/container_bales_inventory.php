<?php
include('../function/db.php');


$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM planta_bales_production 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
WHERE ( planta_recording.status='For Sale' ) and (rubber_weight !='0' or rubber_weight IS NOT NULL) and remaining_bales !='0'
ORDER BY planta_bales_production.recording_id ASC "; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<div class="table-responsive">  <!-- Add responsive class -->
    <table class="table table-bordered table-striped table-hover" id="bales-inventory" width="100%">  <!-- Add striped and hover classes -->
    <thead class="table-dark">
            <tr>
            <th scope="col" >BALE ID</th>
            <th scope="col">Status</th>
            <th scope="col">Type</th>
            <th scope="col">Kilo Bale</th>
            <th scope="col">Supplier</th>
            <th scope="col">Lot No.</th>
            <th scope="col">Total Weight</th>
            <th hidden scope="col">DRC</th>
            <th scope="col">Bales Available</th>
            <th scope="col" hidden></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody >';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  

        $output .= '
        <tr >
             <td width="5%">'.$arr["bales_prod_id"].'</td>
            <td> <span class="badge bg-primary">'.$arr["status"].'</span></td>
            <td>'.$arr["bales_type"].'</td>
            <td>'.$arr["kilo_per_bale"].' kg</td>
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["lot_num"].'</td>
            <td>'.number_format($arr['produce_total_weight'], 0, '.', ',').' kg</td>
            <td hidden>'.($arr['drc'] ? number_format($arr['drc'], 2) : '-').' %</td>
            <td><b>'.number_format($arr['remaining_bales'], 0, '.', ',').' pcs </b></td>
            <td hidden>'.$arr["recording_id"].'</td>
            <td class="keyvalue" width="12%"> <input type="number" class="form-control num_bales"   id="num_bales" name="num_bales"></td>
            <td><button type="button""  id="addInventory" class="btn btn-warning btn-sm addInventory"><i
            class="fa fa-plus-circle"></i></button> </td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>
</div>';

echo $output;
?>


<script>
$('.addInventory').on('click', function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $tr.each(function() {
        var num_bales = $(this).find(".keyvalue input").val();
        var max_bales = parseInt($(this).find("td:nth-child(9)")
            .text()); // Get the number of bales from the row

        if (num_bales > max_bales) {
            // If input is greater than available bales, show error and return
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Input exceeds available bales',
                showConfirmButton: true,
            });
            return;
        }

        var bales_id = data[0];
        var planta_id = data[9];
        var container_id = <?php echo $_POST['container_id'] ?>;

        console.log(num_bales);
        console.log(bales_id);
        console.log(container_id);
        $.ajax({
            method: "POST",
            url: "table/container/addInventory.php",
            data: {
                container_id: container_id,
                bales_id: bales_id,
                num_bales: num_bales,
                planta_id:planta_id
            },
            success: function(data) {
                console.log(data);
                fetch_data();
                if (data === 'Product Added!') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Product Added!',
                        showConfirmButton: false,
                        timer: 600
                    });

     

                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                    });
                }
            }
        });
    });
});



var table = $('#bales-inventory').DataTable({
    dom: "frltip",

});
</script>