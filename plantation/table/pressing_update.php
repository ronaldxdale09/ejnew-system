<?php  
include('../function/db.php');

// Report all PHP errors
error_reporting(E_ALL);

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



$recording_id = $_POST['recording_id'];
 

$sql  = "SELECT * from planta_bales_production
WHERE recording_id='$recording_id' "; 
$output='';


$result = mysqli_query($con, $sql);  
$output = '
<table class="table table-bordered" id="rubber-table">
    <thead>
        <tr>
            <th scope="col" width="15%">Quality</th>
            <th scope="col" width="20%">Kilo Per Bale</th>
            <th scope="col">Weight (kg)</th>
            <th scope="col">No. of Bale</th>
            <th scope="col">Excess</th>
            <th scope="col" width="22%">Description</th>
        </tr>
    </thead>
    <tbody>';

    if(mysqli_num_rows($result) > 0)  
    {  
         while($arr = mysqli_fetch_array($result))  
         {  
   



            $output .= '
            <tr>
                <td ><input type="text" class="form-control" name="type[]" autocomplete="off" step="any"
                    value="'.$arr["bales_type"].'" style="border:none;" readonly /> </td>
                <td>
                    <div class="input-group">
                        <input type="text" readonly class="form-control kilo_bale" name="kilo_bale_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" id="kilo_bale_'.str_replace(['-', ' '], '_', $arr['bales_type']).'"  value="'.$arr["kilo_per_bale"].' kg" ">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="weight_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" id="weight_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" value="'.$arr["rubber_weight"].'"
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="bale_num_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" id="bale_num_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" value="'.$arr["number_bales"].'"
                            onkeypress="return CheckNumeric()"  onkeyup="FormatCurrency(this)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="excess_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" id="excess_'.str_replace(['-', ' '], '_', $arr['bales_type']).'" value="'.$arr["bales_excess"].'"
                            onkeypress="return CheckNumeric()"  onkeyup="FormatCurrency(this)">
                        <span class="input-group-text">kg</span>
                    </div>
                </td>
                <td ><input type="text" class="form-control" name="description[]" autocomplete="off" step="any" style="border:1;"  /> </td>
            </tr>';
        }
    }

$output .= '
    </tbody>
</table>';

echo $output;
 ?>



<script>
$("#bale_num_5L, #bale_num_SPR_5, #bale_num_SPR_10, #bale_num_SPR_20, #bale_num_Off_Color").keyup(function() {
    computeBalesData();
});

$("#excess_5L, #excess_SPR_5, #excess_SPR_10, #excess_SPR_20, #excess_Off_Color").keyup(function() {
    computeBalesData();
});

function computeBalesData() {
    // Helper function to remove commas from a string
    function removeCommas(str) {
        return str.replace(/,/g, '');
    }
    // Helper function to remove "kg" from a string
    function removeKg(str) {
        return str.replace(/kg/g, '').trim();
    }
    // Get kilo_per_bale values
    var kiloBale5L = parseFloat(removeCommas(removeKg($("#kilo_bale_5L").val()))) || 0;
    var kiloBaleSPR_5 = parseFloat(removeCommas(removeKg($("#kilo_bale_SPR_5").val()))) || 0;
    var kiloBaleSPR_10 = parseFloat(removeCommas(removeKg($("#kilo_bale_SPR_10").val()))) || 0;
    var kiloBaleSPR_20 = parseFloat(removeCommas(removeKg($("#kilo_bale_SPR_20").val()))) || 0;
    var kiloBaleOff_Color = parseFloat(removeCommas(removeKg($("#kilo_bale_Off_Color").val()))) || 0;

    // Get bale_num values
    var baleNum5L = parseFloat(removeCommas($("#bale_num_5L").val())) || 0;
    var baleNumSPR_5 = parseFloat(removeCommas($("#bale_num_SPR_5").val())) || 0;
    var baleNumSPR_10 = parseFloat(removeCommas($("#bale_num_SPR_10").val())) || 0;
    var baleNumSPR_20 = parseFloat(removeCommas($("#bale_num_SPR_20").val())) || 0;
    var baleNumOff_Color = parseFloat(removeCommas($("#bale_num_Off_Color").val())) || 0;

    // Get excess values
    var excess5L = parseFloat(removeCommas($("#excess_5L").val())) || 0;
    var excessSPR_5 = parseFloat(removeCommas($("#excess_SPR_5").val())) || 0;
    var excessSPR_10 = parseFloat(removeCommas($("#excess_SPR_10").val())) || 0;
    var excessSPR_20 = parseFloat(removeCommas($("#excess_SPR_20").val())) || 0;
    var excessOff_Color = parseFloat(removeCommas($("#excess_Off_Color").val())) || 0;

    // Compute and update the weight values
    var weight5L = baleNum5L * kiloBale5L + excess5L;
    $("#weight_5L").val(weight5L.toFixed(2));

    var weightSPR_5 = baleNumSPR_5 * kiloBaleSPR_5 + excessSPR_5;
    $("#weight_SPR_5").val(weightSPR_5.toFixed(2));

    var weightSPR_10 = baleNumSPR_10 * kiloBaleSPR_10 + excessSPR_10;
    $("#weight_SPR_10").val(weightSPR_10.toFixed(2));

    var weightSPR_20 = baleNumSPR_20 * kiloBaleSPR_20 + excessSPR_20;
    $("#weight_SPR_20").val(weightSPR_20.toFixed(2));

    var weightOff_Color = baleNumOff_Color * kiloBaleOff_Color + excessOff_Color;
    $("#weight_Off_Color").val(weightOff_Color.toFixed(2));

    // Get entry_weight value
    var entry_weight = parseFloat($("#entry_weight").val()) || 0;


    // Calculate the total weight and rubber_drc
    var totalWeight = weight5L + weightSPR_5 + weightSPR_10 + weightSPR_20 + weightOff_Color;
    var rubber_drc = (totalWeight / entry_weight) * 100;

    // Update the corresponding fields with the calculated values
    $("#press_a_total_weight").val(totalWeight.toFixed(2));
    $("#press_u_drc").val(rubber_drc.toFixed(2));

    // Log the values for debugging purposes
    console.log('Rubber DRC:', rubber_drc);
    console.log('Total Weight:', totalWeight);
}
</script>