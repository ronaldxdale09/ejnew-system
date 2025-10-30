<?php  
include('../../function/db.php');
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
<div class="table-responsive">
<table class="table table-bordered" id="rubber-table">
    <thead>
        <tr>
            <th scope="col" width="22%">Quality</th>
            <th scope="col" width="20%">Kilo Per Bale</th>
            <th scope="col">Weight (kg)</th>
            <th scope="col">No. of Bale</th>
            <th scope="col">Excess</th>
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
                    value="'.$arr["bales_type"].'" style="border:none;"readonly /> </td>
                <td>
                    <div class="input-group">
              
                    <input type="text" readonly class="form-control" name="kilo_bale_'.$arr['bales_type'].'" id="kilo_bale_'.$arr['bales_type'].'"  value="'.$arr["kilo_per_bale"].' kg" ">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="weight_'.$arr['bales_type'].'" id="weight_'.$arr['bales_type'].'" value="'.$arr["rubber_weight"].'"
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="bale_num_'.$arr['bales_type'].'" id="bale_num_'.$arr['bales_type'].'" value="'.$arr["number_bales"].'"
                            onkeypress="return CheckNumeric()"  onkeyup="FormatCurrency(this)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="excess_'.$arr['bales_type'].'" id="excess_'.$arr['bales_type'].'" value="'.$arr["bales_excess"].'"
                            onkeypress="return CheckNumeric()"  onkeyup="FormatCurrency(this)">
                        <span class="input-group-text">kg</span>
                    </div>
                </td>
            </tr>';
        }
    }

$output .= '
    </tbody>
</table>
</div>
';

echo $output;
 ?>



<script>
// Event listeners for bale number input fields
$("#bale_num_Manhattan, #bale_num_Showa, #bale_num_Dunlop, #bale_num_Crown, #bale_num_SPR10").on("input", function() {
    computeBalesData();
});

// Event listeners for excess input fields
$("#excess_Manhattan, #excess_Showa, #excess_Dunlop, #excess_Crown, #excess_SPR10").on("input", function() {
    computeBalesData();
});

function computeBalesData() {
    // Get kilo_per_bale values
    var kiloBaleManhattan = parseFloat($("#kilo_bale_Manhattan").val()) || 0;
    var kiloBaleShowa = parseFloat($("#kilo_bale_Showa").val()) || 0;
    var kiloBaleDunlop = parseFloat($("#kilo_bale_Dunlop").val()) || 0;
    var kiloBaleCrown = parseFloat($("#kilo_bale_Crown").val()) || 0;
    var kiloBaleSpr = parseFloat($("#kilo_bale_SPR10").val()) || 0;

    // Get bale_num values
    var baleNumManhattan = parseFloat($("#bale_num_Manhattan").val()) || 0;
    var baleNumShowa = parseFloat($("#bale_num_Showa").val()) || 0;
    var baleNumDunlop = parseFloat($("#bale_num_Dunlop").val()) || 0;
    var baleNumCrown = parseFloat($("#bale_num_Crown").val()) || 0;
    var baleNumSpr = parseFloat($("#bale_num_SPR10").val()) || 0;

    // Get excess values
    var excessManhattan = parseFloat($("#excess_Manhattan").val()) || 0;
    var excessShowa = parseFloat($("#excess_Showa").val()) || 0;
    var excessDunlop = parseFloat($("#excess_Dunlop").val()) || 0;
    var excessCrown = parseFloat($("#excess_Crown").val()) || 0;
    var excessSpr = parseFloat($("#excess_SPR10").val()) || 0;

    // Compute and update the weight values
    var weightManhattan = baleNumManhattan * kiloBaleManhattan + excessManhattan;
    $("#weight_Manhattan").val(weightManhattan.toFixed(2));

    var weightShowa = baleNumShowa * kiloBaleShowa + excessShowa;
    $("#weight_Showa").val(weightShowa.toFixed(2));

    var weightDunlop = baleNumDunlop * kiloBaleDunlop + excessDunlop;
    $("#weight_Dunlop").val(weightDunlop.toFixed(2));

    var weightCrown = baleNumCrown * kiloBaleCrown + excessCrown;
    $("#weight_Crown").val(weightCrown.toFixed(2));

    var weightSpr = baleNumSpr * kiloBaleSpr + excessSpr;
    $("#weight_SPR10").val(weightSpr.toFixed(2));

    // Get entry_weight value
    var entry_weight = parseFloat($("#entry_weight").val()) || 0;

    // Check if entry_weight is non-zero
    if (entry_weight === 0) {
        return;
    }

    // (Existing code for getting kilo_per_bale, bale_num, and excess values, and updating weight values)

    var totalWeight = weightManhattan + weightShowa + weightDunlop + weightCrown + weightSpr;
    var rubber_drc = (totalWeight / entry_weight) * 100;

    $("#press_u_total_weight").val('2');
    $("#press_u_drc").val(rubber_drc.toFixed(2));
}
</script>