<div class="modal fade" id="modal_produced_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"> Production Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary alert-dismissible">
                    <center> <strong>Reminder:</strong> Please double-check all data for accuracy before proceeding to any action. Thank you.</center>
                </div>
                <div class="row no-gutters">
                    <input type="text" id='prod_rec_id' readonly class="form-control" hidden>
                    <div class="col">
                        <div class="input-group mb-12">
                            <label class="col-md-12">Purchased ID</label>
                            <input type="text" style='text-align:center' id='prod_purchased_id' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-12">
                            <label class="col-md-12">Recording ID</label>
                            <input type="text" style='text-align:center' id='prod_recording_id' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-12">
                            <label class="col-md-12">Supplier</label>
                            <input type="text" style='text-align:center' id='prod_trans_supplier' readonly class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
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
                    <div class="col">
                        <label class="form-label">Entry Weight</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="prod_trans_entry" readonly>
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">Total Weight</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="prod_trans_total_weight" readonly>
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">DRC</label>

                        <div class="input-group">
                            <input type="text" class="form-control" id="prod_trans_drc" style='text-align:right' readonly>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Itemized Expenses</label>
                        <div class="input-group">
                            <input type="text" style='font-size:19px' class="form-control text-center" id="prod_expense_desc" placeholder='Description' readonly>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">Expense Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" style='font-size:19px' class="form-control text-center" id="prod_expense" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">Milling Cost</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" style='font-size:19px' class="form-control text-center" id="prod_mill_cost" readonly>
                        </div>
                    </div>



                </div>

                <div class="row mb-3">
                    <div class="col-5">
                        <center><label class="form-label">Unit/Bale Cost</label></center>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" style='font-size:19px' class="form-control text-center" id="prod_unit_cost" readonly>
                        </div> <br>




                    </div>

                </div>
                <div class="alert alert-warning alert-dismissible" style="font-size:13px; text-align:center;">
                    <p style="max-width: 90%; margin: 0 auto;">
                        <strong>Note:</strong> If Bale cost is zero, please contact the users in charge of Bale Purchasing to process the Production cost. Ensure data accuracy. Thank you.
                    </p>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" id='btnMarkCompleteBale'><i class="fas fa-check"></i> Mark as Complete</button>
                <button type="button" class="btn btn-warning text-dark" id='btnProdTransPressing'><i class="fas fa-toolbox"></i> Return to Pressing</button>

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
                                        <input type="checkbox" id="toggleReadonly" checked style="transform: scale(1.5);" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Location</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='location' autocomplete='off' style="width: 100px;" value='<?php echo $loc ?>' readonly />
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
                                <input type="text" style='font-size:19px' class="form-control text-center" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id="excess_unit_cost" name="excess_unit_cost" required>
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
                                <input type="text" style='font-size:19px' class="form-control text-center" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id="excess_mill_cost" name="excess_mill_cost" value='12' required>
                            </div>
                        </div>



                        <div class="col" hidden>
                            <label class="form-label">Total Cost </label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' readonly class="form-control text-center" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="excess_total_cost" id="excess_total_cost" required>
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