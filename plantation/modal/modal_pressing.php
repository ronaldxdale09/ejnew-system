<div class="modal fade" id="modal_press_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pressing | Update</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_pressing.php" method="POST">

                    <input type="text" class="form-control" name='reweight' id="press_u_reweight" hidden readonly>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name='recording_id' id="press_u_id" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="press_u_supplier" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" id="press_u_loc" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label">Lot No.</label>
                            <input type="text" class="form-control" name="lot_no" id="press_u_lot" readonly>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Quality</label>
                            <input type="text" class="form-control" id="press_u_quality" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label">Kilo Per Bale</label>
                            <input type="text" class="form-control" name="kilo_per_bale" id="press_u_kilo_per_bale"
                                readonly>
                        </div>
                    </div> -->
                    <hr>
                    <table class="table table-bordered" id='rubber-table'>
                        <thead>
                            <tr>
                                <th scope="col" width='22%'>Quality</th>
                                <th scope="col" width='20%'>Kilo Per Bale</th>
                                <th scope="col">Weight (kg)</th>
                                <th scope="col">No. of Bale</th>
                                <th scope="col">Excess</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Manhattan</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_manhattan" id="kilo_bale_manhattan"
                                             style='text-align:center;'>
                                            <option value='' selected disabled>Select</option>
                                            <option value='35'>35 kg</option>
                                            <option value='33.33'>33.33 kg</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='weight_manhattan'
                                            id="weight_manhattan" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='bale_num_manhattan'
                                            id="bale_num_manhattan" onkeypress="return CheckNumeric()" readonly
                                            onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='excess_manhattan'
                                            id="excess_manhattan" onkeypress="return CheckNumeric()" readonly
                                            onkeyup="FormatCurrency(this)">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Showa</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_showa" id="kilo_bale_showa" 
                                            style='text-align:center;'>
                                            <option value='' selected disabled>Select</option>
                                            <option value='35'>35 kg</option>
                                            <option value='33.33'>33.33 kg</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='weight_showa' id="weight_showa"
                                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='bale_num_showa'
                                            id="bale_num_showa" onkeypress="return CheckNumeric()" readonly
                                            onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='excess_showa' id="excess_showa"
                                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dunlop</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_dunlop" id="kilo_bale_dunlop"
                                             style='text-align:center;'>
                                            <option value='' selected disabled>Select</option>
                                            <option value='35'>35 kg</option>
                                            <option value='33.33'>33.33 kg</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='weight_dunlop' id="weight_dunlop"
                                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='bale_num_dunlop'
                                            id="bale_num_dunlop" onkeypress="return CheckNumeric()" readonly
                                            onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='excess_dunlop' id="excess_dunlop"
                                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Crown</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_crown" id="kilo_bale_crown" 
                                            style='text-align:center;'>
                                            <option value='' selected disabled>Select</option>
                                            <option value='35'>35 kg</option>
                                            <option value='33.33'>33.33 kg</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='weight_crown' id="weight_crown"
                                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='bale_num_crown'
                                            id="bale_num_crown" onkeypress="return CheckNumeric()" readonly
                                            onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='excess_crown' id="excess_crown"
                                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SPR-10</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_spr" id="kilo_bale_spr" 
                                            style='text-align:center;'>
                                            <option value='' selected disabled>Select</option>
                                            <option value='35'>35 kg</option>
                                            <option value='33.33'>33.33 kg</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='weight_spr' id="weight_spr"
                                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">

                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='bale_num_spr' id="bale_num_spr"
                                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name='excess_spr' id="excess_spr"
                                            onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="press_u_entry" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="press_u_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" class="form-control" name="drc" id="press_u_drc"
                                    style='text-align:right' readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
            </div>


            <div class=" modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="pressing_update"  onclick="return validateTable();" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

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



$(document).ready(function() {
    // Get all weight input fields
    const weightFields = $('input[name^="weight_"]');

    // Disable weight input fields by default
    weightFields.prop('disabled', true);

    // Add change event listener to all select elements
    $('select[name^="kilo_bale_"]').change(function() {
        // Get the corresponding weight input field
        const weightField = $(`input[name="weight_${$(this).attr('id').substring(10)}"]`);

        if ($(this).val() !== '') {
            // Enable weight input field if a kilo per bale option is selected
            weightField.prop('disabled', false);
        } else {
            // Disable weight input field if no kilo per bale option is selected
            weightField.prop('disabled', true);
        }
    });
});




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

<div class="modal fade" id="modal_press_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pressing | Production Complete</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='trans_recording_id' hidden
                        readonly class="form-control">

                    <div class="row no-gutters">

                        <div class="col-3">
                            <div class="input-group mb-12">
                                <label class="col-md-12">ID</label>
                                <input type="text" style='text-align:center' name='weight' id='process_supplier'
                                    readonly class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col">
                        </div>

                        <div class="col-5">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Date</label>
                                <!-- DATE TODAY/DATE OF TRANSFER, BUT EDITABLE. ALL ELSE IS NOT INPUT -->
                                <input type="text" style='text-align:center' name='weight' id='process_supplier'
                                    readonly class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                    </div>

                    <br>
                    <div class="row no-gutters">

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <input type="text" style='text-align:center' name='weight' id='trans_supplier' readonly
                                    class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <input type="text" style='text-align:center' name='weight' id='process_supplier'
                                    readonly class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-md-12">Lot No.</label>
                            <input type="text" style='text-align:center' name='lot_no' id='process_lot_no' readonly
                                class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                required>
                        </div>

                    </div>
                    <hr>

                    <div class="form-group">
                        <center>

                            <div class="row no-gutters">

                                <div class="col">
                                    <label class="col-md-12">Dry Weight </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='crumbed_weight'
                                                id='trans_crumbed_weight' readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label class="col-md-12">Bale Weight </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='crumbed_weight'
                                                id='trans_crumbed_weight' readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label class="col-md-12">DRC</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='drc' id='drc' readonly
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row no-gutters">

                                <div class="col">
                                    <label class="col-md-12">Quality </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='crumbed_weight'
                                                id='trans_crumbed_weight' readonly class="form-control">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label class="col-md-12">Kilo per Bale</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='crumbed_weight'
                                                id='trans_crumbed_weight' readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label class="col-md-12">No. of Bale</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='crumbed_weight'
                                                id='trans_crumbed_weight' readonly class="form-control">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </center>


                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="transfer_production" class="btn btn-warning text-dark">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal_dry_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Drying | Update Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='dry_v_recording_id' hidden
                        readonly class="form-control">


                    <!-- START -->


                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <input type="text" style='text-align:center' name='weight' id='dry_v_supplier'
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <input type="text" style='text-align:center' id='dry_v_loc' readonly
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label class="col-md-12">Lot # </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' id='dry_v_lot' readonly
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div id='dry_table_record'></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>