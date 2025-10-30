<?php
include('../../function/db.php');


$loc = str_replace(' ', '', $_SESSION['loc']);
$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM planta_bales_production 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
WHERE ( planta_recording.status='For Sale' ) and (rubber_weight !='0' or rubber_weight IS NOT NULL) and (remaining_bales !='0'  and planta_recording.source='$loc')
ORDER BY planta_bales_production.recording_id ASC ";

$result = mysqli_query($con, $sql);
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<div class="dropdown">
                    <select class="form-select" name="kilobale_filter" id="kilobale_filter" style="width: 157px;">
                        <option disabled="disabled" selected>Select Kilo per Bale</option>
                        <option value="">All</option>
                        <option value="35 kg">35 kg</option>
                        <option value="33.33 kg">33.33 kg</option>
                        <!--PHP echo-->
                    </select>
                </div>
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

if (mysqli_num_rows($result) > 0) {
    while ($arr = mysqli_fetch_assoc($result)) {

        $output .= '
        <tr >
             <td width="5%">' . $arr["bales_prod_id"] . '</td>
            <td> <span class="badge bg-primary">' . $arr["status"] . '</span></td>
            <td>' . $arr["bales_type"] . '</td>
            <td>' . $arr["kilo_per_bale"] . ' kg</td>
            <td>' . $arr["supplier"] . '</td>
            <td style="font-weight:bold">' . $arr["lot_num"] . '</td>
            <td>' . number_format($arr['produce_total_weight'], 0, '.', ',') . ' kg</td>
            <td hidden>' . ($arr['drc'] ? number_format($arr['drc'], 2) : '-') . ' %</td>
            <td><b>' . number_format($arr['remaining_bales'], 0, '.', ',') . ' pcs </b></td>
            <td hidden>' . $arr["recording_id"] . '</td>
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


<script>$('.addInventory').on('click', function() {
    var $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text().trim();
    }).get();

    var num_bales = parseInt($tr.find(".keyvalue input").val(), 10);
    var max_bales = parseInt($tr.find("td:nth-child(9)").text().replace(/[^\d]/g, ''), 10);

    console.log("Input bales:", num_bales);
    console.log("Max bales:", max_bales);

    if (isNaN(num_bales) || num_bales <= 0) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Number of bales must be greater than zero',
            showConfirmButton: true,
        });
        return;
    }

    if (num_bales > max_bales) {
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
    var total_weight = parseFloat(data[6].replace(/[^\d.]/g, ''));
    var container_id = <?php echo json_encode($_POST['container_id']); ?>;

    console.log("Bales ID:", bales_id);
    console.log("Planta ID:", planta_id);
    console.log("Total Weight:", total_weight);
    console.log("Container ID:", container_id);

    $.ajax({
        method: "POST",
        url: "table/container/addInventory.php",
        data: {
            container_id: container_id,
            bales_id: bales_id,
            num_bales: num_bales,
            planta_id: planta_id,
            total_weight: total_weight
        },
        success: function(response) {
            fetch_data();

            console.log("Server response:", response);
            if (response.trim() === 'Bales Added!') {
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
                    title: response,
                    showConfirmButton: true,
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'An error occurred while processing your request',
                showConfirmButton: true,
            });
        }
    });
});



    var table = $('#bales-inventory').DataTable({
        dom: "frltip",
        "pageLength": 50,

    });

    $('#kilobale_filter').on('change', function() {
        var tosearch = this.value;
        table.search(tosearch).draw();
    });
</script>