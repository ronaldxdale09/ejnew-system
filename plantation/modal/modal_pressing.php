<div class="modal fade" id="modal_press_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Pressing | Update</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_pressing.php" method="POST">


                    <input type="text" class="form-control" name='recording_id' id="press_u_id" hidden readonly>
                    <input type="text" class="form-control" name='reweight' id="press_u_reweight" hidden readonly>
                    <div class="row mb">
                        <div class="col-5">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="press_u_supplier" readonly>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" id="press_u_loc" readonly>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Lot No.</label>
                            <input type="text" class="form-control" name="lot_no" id="press_u_lot" readonly>
                        </div>
                    </div> <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" name='entry_weight'
                                    id="press_u_entry" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                        <div class="col">
                            <label class="form-label">Crumbed Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" id="press_u_crumbed_weight"
                                    readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Dry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-center" id="press_u_dry_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id='pressing_modal_update_table'></div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="press_u_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name="drc"
                                    id="press_u_drc" style='text-align:right' readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    name='expense_desc' id="u_expense_desc" placeholder='Expense Description'>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="u_expense" name='expense' onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Milling Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="press_u_mill_cost" name='mill_cost' >
                            </div>
                        </div>
                    </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="pressing_update" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



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
                    <input type="text" style='text-align:center' name='recording_id' id='press_trans_id' readonly
                        class="form-control" hidden>

                    <div class="row no-gutters">

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <input type="text" style='text-align:center' name='supplier' id='press_trans_supplier'
                                    readonly class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <input type="text" style='text-align:center' name='loc' id='press_trans_loc' readonly
                                    class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-md-12">Lot No.</label>
                            <input type="text" style='text-align:center' name='lot_no' id='press_trans_lot' readonly
                                class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                required>
                        </div>

                    </div>

                    <hr>

                    <div id='pressing_modal_trans_table'></div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name='entry_weight' id="press_trans_entry"
                                    readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="press_trans_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" class="form-control" name="drc" id="press_trans_drc"
                                    style='text-align:right' readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="t_expense_desc" placeholder='Description' readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="t_expense" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Milling Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center"
                                    id="mill_cost" readonly>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="press_transfer" class="btn btn-warning text-dark">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$today = date('Y-m-d');


$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
?>
<div class="modal fade" id="balesExcess" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Bale Outside Purchase</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/balePurchase.php" method="POST">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Type</label>
                            <div class="input-group mb-3">
                                <input type="text" class='form-control' value="Outsource" name="purchase_type" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' value="<?php echo $today; ?>" name="n_date" require>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' value='<?php echo $name?>'autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <label style='font-size:15px' class="col-md-12">Supplier</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='supplier' autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Location</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='location' autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Driver (Optional)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='driver' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Truck Number (Optional)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='truck_num' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                   
                   
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Purchase Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="purchase_cost" required>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name='total_weight' id="total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name='expense_desc'  placeholder='Expense Description'>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" name='expense' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>

                    </div>
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
