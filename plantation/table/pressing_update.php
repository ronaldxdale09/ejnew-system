<?php  
include('../function/db.php');

$recording_id = $_POST['recording_id'];
 

$sql  = "SELECT * from planta_bales_production
WHERE recording_id='$recording_id' "; 
$output='';


$result = mysqli_query($con, $sql);  
$output = '
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
                    <select class="form-select" name="kilo_bale_'.$arr['bales_type'].'" id="kilo_bale_'.$arr['bales_type'].'" style="text-align:center;">
                        <option value="" selected disabled>Select</option>
                        <option value="0" >Empty</option>
                        <option value="35" '.($arr["kilo_per_bale"] == "35" ? "selected" : "").'>35 kg</option>
                        <option value="33.33" '.($arr["kilo_per_bale"] == "33.33" ? "selected" : "").'>33.33 kg</option>
                    </select>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="weight_'.$arr['bales_type'].'" id="weight_'.$arr['bales_type'].'" value="'.$arr["rubber_weight"].'"
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="bale_num_'.$arr['bales_type'].'" id="bale_num_'.$arr['bales_type'].'" value="'.$arr["number_bales"].'"
                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="excess_'.$arr['bales_type'].'" id="excess_'.$arr['bales_type'].'" value="'.$arr["bales_excess"].'"
                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                        <span class="input-group-text">kg</span>
                    </div>
                </td>
            </tr>';
        }
    }

$output .= '
    </tbody>
</table>';

echo $output;
 ?>



<script>
$(document).ready(function() {
    $('select[name^="kilo_bale_"]').change(function() {
        var bales_type = $(this).attr("id").replace('kilo_bale_', '');
        var weight_input = $('input[name="weight_' + bales_type + '"]');
        if ($(this).val() == 0) {
            weight_input.attr('readonly', true);
            weight_input.val('');
        } else {
            weight_input.attr('readonly', false);
        }
    });
});

function validateTable() {
    // Get the table element
    var table = document.getElementById("rubber-table");

    // Loop through the rows and check if any of them has some data
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var weight = row.querySelector("input[name^='weight']");
        var baleNum = row.querySelector("input[name^='bale_num']");
        var excess = row.querySelector("input[name^='excess']");

        if (weight.value || baleNum.value || excess.value) {
            return true; // At least one row has data
        }
    }

    // If no row has data, show an error message
    alert("Please enter some data in the table.");
    return false;
}




$("#kilo_bale_manhattan").on("change", function() {
    computeBalesData()
});


$("#kilo_bale_showa").on("change", function() {
    computeBalesData()
});


$("#kilo_bale_dunlop").on("change", function() {
    computeBalesData()
});


$("#kilo_bale_crown").on("change", function() {
    computeBalesData()
});


$("#kilo_bale_spr").on("change", function() {
    computeBalesData()
});





$(function() {
    $("#weight_manhattan,#weight_showa,#weight_dunlop,#weight_crown,#weight_spr").keyup(function() {
        computeBalesData()
    });

});

function computeBalesData() {
    // Update computation for Manhattan
    var kilo_bale_manhattan = $("#kilo_bale_manhattan").val() ? parseFloat($("#kilo_bale_manhattan").val().replace(/,/g,
        '')) : 0;
    var weight_manhattan = $("#weight_manhattan").val() ? parseFloat($("#weight_manhattan").val().replace(/,/g, '')) :
        0;

    // Update computation for Showa
    var kilo_bale_showa = $("#kilo_bale_showa").val() ? parseFloat($("#kilo_bale_showa").val().replace(/,/g, '')) : 0;
    var weight_showa = $("#weight_showa").val() ? parseFloat($("#weight_showa").val().replace(/,/g, '')) : 0;

    // Update computation for Dunlop
    var kilo_bale_dunlop = $("#kilo_bale_dunlop").val() ? parseFloat($("#kilo_bale_dunlop").val().replace(/,/g, '')) :
        0;
    var weight_dunlop = $("#weight_dunlop").val() ? parseFloat($("#weight_dunlop").val().replace(/,/g, '')) : 0;

    // Update computation for Crown
    var kilo_bale_crown = $("#kilo_bale_crown").val() ? parseFloat($("#kilo_bale_crown").val().replace(/,/g, '')) : 0;
    var weight_crown = $("#weight_crown").val() ? parseFloat($("#weight_crown").val().replace(/,/g, '')) : 0;

    // Update computation for SPR
    var kilo_bale_spr = $("#kilo_bale_spr").val() ? parseFloat($("#kilo_bale_spr").val().replace(/,/g, '')) : 0;
    var weight_spr = $("#weight_spr").val() ? parseFloat($("#weight_spr").val().replace(/,/g, '')) : 0;



    var entry_weight = $("#press_u_entry").val() ? parseFloat($("#press_u_entry").val().replace(/,/g, '')) : 0;

    updateComputeBales(kilo_bale_manhattan, weight_manhattan, kilo_bale_showa, weight_showa, kilo_bale_dunlop,
        weight_dunlop, kilo_bale_crown, weight_crown, kilo_bale_spr, weight_spr, entry_weight);
}


function updateComputeBales(kiloBaleManhattan, weightManhattan, kiloBaleShowa, weightShowa, kiloBaleDunlop,
    weightDunlop, kiloBaleCrown, weightCrown, kiloBaleSpr, weightSpr, entry_weight) {
    const getBalesAndExcessKilo = (kiloBale, weight) => {
        if (kiloBale && weight) {
            const bales = Math.floor(weight / kiloBale);
            const excessKilo = (weight % kiloBale).toFixed(2);
            return [bales, excessKilo];
        }
        return [0, 0];
    };

    const [mBales, excessManhattan] = getBalesAndExcessKilo(kiloBaleManhattan, weightManhattan);
    $("#bale_num_manhattan").val(mBales.toLocaleString());
    $("#excess_manhattan").val(excessManhattan.toLocaleString());

    const [sBales, excessShowa] = getBalesAndExcessKilo(kiloBaleShowa, weightShowa);
    $("#bale_num_showa").val(sBales.toLocaleString());
    $("#excess_showa").val(excessShowa).toLocaleString();

    const [dBales, excessDunlop] = getBalesAndExcessKilo(kiloBaleDunlop, weightDunlop);
    $("#bale_num_dunlop").val(dBales.toLocaleString());
    $("#excess_dunlop").val(excessDunlop.toLocaleString());

    const [cBales, excessCrown] = getBalesAndExcessKilo(kiloBaleCrown, weightCrown);
    $("#bale_num_crown").val(cBales.toLocaleString());
    $("#excess_crown").val(excessCrown.toLocaleString());

    const [sprBales, excessSpr] = getBalesAndExcessKilo(kiloBaleSpr, weightSpr);
    $("#bale_num_spr").val(sprBales.toLocaleString());
    $("#excess_spr").val(excessSpr.toLocaleString());


    var totalWeight = weightManhattan + weightShowa + weightDunlop + weightCrown + weightSpr;

    rubber_drc = (totalWeight / entry_weight) * 100


    $("#press_u_total_weight").val(totalWeight.toLocaleString());

    $("#press_u_drc").val(rubber_drc.toFixed(2));




}
/**
 * Get number of bales and excess kilo for a given weight and kilo per bale.
 *
 * @param {number} kiloBale - The weight of a single bale in kilograms.
 * @param {number} weight - The total weight in kilograms.
 * @returns {[number, number]} - An array containing the number of bales and the excess kilo, respectively.
 */
function getBalesAndExcessKilo(kiloBale, weight) {
    let numBales, excessKilo;
    if (kiloBale && weight) {
        numBales = Math.floor(weight / kiloBale);
        excessKilo = (weight % kiloBale);
    } else {
        numBales = 0;
        excessKilo = 0;
    }
    return [numBales, excessKilo];
}
</script>