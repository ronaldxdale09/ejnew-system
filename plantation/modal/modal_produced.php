<div class="modal fade" id="modal_produced_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"> Production Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">

                    <div class="row no-gutters">

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <input type="text" style='text-align:center' name='supplier' id='prod_trans_supplier' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <input type="text" style='text-align:center' name='loc' id='prod_trans_loc' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-md-12">Lot No.</label>
                            <input type="text" style='text-align:center' name='lot_no' id='prod_trans_lot' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                        </div>

                    </div>
                    <hr>


                    <div id='produced_modal_table'></div>
                    <hr>

                    <div class="row mb-3">

                        <div class="col-5">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" class="form-control" name="drc" id="prod_trans_drc" style='text-align:right' readonly>

                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>



<?php
$today = date('Y-m-d');


$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
?>
<div class="modal fade" id="baleExcessModal" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Bale Excess </h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/bale_excess.php" method="POST">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12"> Type</label>
                            <div class="input-group mb-3">
                                <input type="text" class='form-control' value="Excess" name="purchase_type" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12"> Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' value="<?php echo $today; ?>" name="n_date" require>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' value='<?php echo $name ?>' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <label style='font-size:15px' class="col-md-12">Supplier</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='supplier' value='Bale Excess' readonly autocomplete='off' style="width: 100px;" required />
                                <div class="input-group-append">
                                    <div class="input-group-text"><br>
                                        <input   type="checkbox" id="toggleReadonly" checked style="transform: scale(1.5);"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Location</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='location' autocomplete='off' style="width: 100px;" value='<?php echo $loc?>'readonly />
                            </div>
                        </div>

                    </div>

                    <div id='table_bales_excess'></div>

                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Unit Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" onkeypress="return CheckNumeric()" 
                                onkeyup="FormatCurrency(this)" id="excess_unit_cost"  name="excess_unit_cost"  required>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name='total_weight' id="total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                        <div class="col">
                            <label class="form-label">Milling Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" onkeypress="return CheckNumeric()" 
                                onkeyup="FormatCurrency(this)" id="excess_mill_cost"  name="excess_mill_cost"  value ='12' required>
                            </div>
                        </div>
                        


                        <div class="col" hidden>
                            <label class="form-label">Total Cost </label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px'  readonly class="form-control text-center" 
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"  name="excess_total_cost" id="excess_total_cost" required>
                            </div>
                        </div>
                    </div>
                    <br>
                   
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Remarks:</label>
                        <div class="input-group mb-3">
                            <textarea type="text" name="remarks" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name='new'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#toggleReadonly').change(function() {
            var readonly = $(this).is(':checked');
            $('input[name="supplier"]').prop('readonly', readonly);
        });
    });
</script>