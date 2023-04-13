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
                <form action="function/rubber_process.php" method="POST">

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
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Quality</label>
                            <input type="text" class="form-control" id="press_u_quality" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label">Kilo Per Bale</label>
                            <input type="text" class="form-control" name="kilo_per_bale" id="press_u_kilo_per_bale"
                                readonly>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
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
                                            required style='text-align:center;'>
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
                                        <select class="form-select" name="kilo_bale_showa" id="kilo_bale_showa" required
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
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dunlop</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_dunlop" id="kilo_bale_dunlop"
                                            required style='text-align:center;'>
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
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Crown</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_crown" id="kilo_bale_crown" required
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
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SPR-10</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" name="kilo_bale_spr" id="kilo_bale_spr" required
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
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


            </div>

            <div class=" modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="pressing_update" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

$("#kilo_bale_manhattan").on("change", function() {
     updateComputeBales()
});



$("#kilo_bale_showa").on("change", function() {
    updateComputeBales()
});


$("#kilo_bale_dunlop").on("change", function() {
    updateComputeBales()
});


$("#kilo_bale_crown").on("change", function() {
    updateComputeBales()
});


$("#kilo_bale_spr").on("change", function() {
    updateComputeBales()
});





$(function() {
    $("#press_u_bale_weight").keyup(function() {
        updateComputeBales()
    });

});


function updateComputeBales() {

    // var bales_weight = parseFloat($("#press_u_bale_weight").val().replace(/,/g, '').match(/[\d]+(\.[\d]+)?/)[0]);
    // var kilo_bale = parseFloat($("#press_u_kilo_per_bale").val().replace(/,/g, '').match(/[\d]+(\.[\d]+)?/)[0]);


    // bales = Math.floor((+bales_weight) / (+kilo_bale));
    // bales_decimal = ((+bales_weight) / (+kilo_bale)).toFixed(2);
    // excess_kilo = ((+bales_weight) % (+kilo_bale));

    // $("#press_u_numBale").val(bales);
    // $("#press_u_excess").val(excess_kilo);



console.log('hhh')
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