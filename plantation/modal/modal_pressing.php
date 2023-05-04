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
                    </div>

                    <hr>
                    <div id='pressing_modal_update_table'></div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col" hidden>
                            <label class="form-label">Entry Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name='entry_weight' id="press_u_entry" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="press_a_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">DRC</label>

                            <div class="input-group">
                                <input type="text" class="form-control" name="drc" id="press_u_drc"
                                    style='text-align:right' readonly>
                                <span class="input-group-text"></span>
                            </div>
                        </div> -->
                    </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="pressing_update"
                    class="btn btn-success">Update</button>
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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="press_transfer" class="btn btn-warning text-dark">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>