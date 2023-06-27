<?php
include('../function/db.php');

$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM container_bales_selection 
LEFT JOIN planta_bales_production ON container_bales_selection.bales_id = planta_bales_production.bales_prod_id
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
 where container_id ='$container_id'";

$total_bales_count = 0;
$total_weight = 0;
$unit_cost = 0;
$total_unit_cost = 0;
$total_bale_cost = 0;

$milling_cost = 0;
$total_milling_cost = 0;

$overall_milling_cost = 0;
$average_kilo_cost = 0;
$result = mysqli_query($con, $sql);
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
    <div class="row" id="itemLines">

    <div class="col-4">Product
    </div>
    <div class="col-2">Qty
    </div>
    <div class="col">Price
    </div>
    <div class="col">Amount
    </div>

</div>';

if (mysqli_num_rows($result) > 0) {
    while ($arr = mysqli_fetch_assoc($result)) {

        $output .= '
        <div class="row">
            <div class="col-4">
                <div class="input-group mb-3">
                    <select class="form-select" name="product[]" style="width: 100px;">
                    <option>Select...</option>
                    <option value="LC_W_CASE">LC Powder - Wholesale (1 Case)</option>
                    <option value="LC_W_KG">LC Powder - Wholesale (1 KG)</option>
                    <option value="LC_R">LC Powder - Retail (1KG)</option>
                    <option value="LC_W_HALF_KG">LC Powder - Retail (1/2 KG)</option>
                    <option value="LC_W_QUARTER_KG">LC Powder - Retail (1/4 KG)</option>
                    <option value="HB_W_CASE">HB Roasted - Wholesale (1 Case)</option>
                    <option value="HB_W_KG">HB Roasted - Wholesale (1 KG)</option>
                    <option value="HB_W_KG">HB Roasted - Retail (1 KG)</option>
                    <option value="HB_W_HALF_KG">HB Roasted - Retail (1/2 KG)</option>
                    <option value="HB_W_QUARTER_KG">HB Roasted - Retail (1/4 KG)</option>
                    <option value="HB_A">HB Roasted - Arabica (1 KG)</option>
                    <option value="HB_E">HB Roasted - Excelsa (1 KG)</option>
                    <option value="HB_O">HB Roasted - Robusta (1 KG)</option>
                    <option value="HB_U">HB Roasted - Arabusta (1 KG)</option>
                    <option value="KK_A">Kalunkopi - Arabica (1 KILO)</option>
                    <option value="KK_H">Kalunkopi - House Blend (1 KILO)</option>
                    <option value="KK_R">Kalunkopi - Robusta (1 KILO)</option>
                    <option value="KK_U">Kalunkopi - Arabusta (1 KILO)</option>
                    <option value="KK_A_250G">Kalunkopi - Arabica (250G)</option>
                    <option value="KK_H_250G">Kalunkopi - House Blend (250G)</option>
                    <option value="KK_R_250G">Kalunkopi - Robusta (250G)</option>
                    <option value="KK_U_250G">Kalunkopi - Arabusta (250G)</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="unit[]" style="width: 100px;">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="price[]" style="width: 100px;">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="amount[]" style="width: 100px;" readonly>
                </div>
            </div>
        </div>
        
        ';
    }
}

$output .= '
    </tbody>
</table> 

<hr>

<div class="row">
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Bale Cost</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="total_bale_cost" id="total_bale_cost" autocomplete="off"
                style="width: 100px;" readonly />
        </div>
    </div>
     <div class="col">
        <label style="font-size:15px" class="col-md-12">Average Kilo Cost</label>
        <div class="input-group mb-3">
             <input type="text" class="form-control" name="average_cost" id="average_cost" autocomplete="off"
                style="width: 100px;" readonly />
         </div>
    </div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Milling Cost</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="total_milling_cost" id="total_milling_cost" autocomplete="off"
                style="width: 100px;" readonly />
        </div>
    </div>

</div>


<script>
    document.getElementById("num_bales").value = "' . $total_bales_count . ' pcs";
    document.getElementById("total_bale_weight").value = "' . number_format($total_weight, 2) . ' kg";

    document.getElementById("total_bale_cost").value = "₱ ' . number_format($total_bale_cost, 2) . '";
    document.getElementById("total_milling_cost").value = "₱ ' . number_format($overall_milling_cost, 2) . '";
    document.getElementById("average_cost").value = "₱ ' . number_format($average_kilo_cost, 2) . '";
</script>
';



echo $output;
?>
<script>
    $(".removeBtn").click(function() {
        var balesId = $(this).closest("tr").data("bales_id");
        $.ajax({
            url: "table/container/removeInventory.php",
            type: "POST",
            data: {
                bales_id: balesId
            },
            success: function(response) {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>