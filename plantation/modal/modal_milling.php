<div class="modal fade" id="modal_mil_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Milling | Update</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='p_recording_id' hidden readonly
                        class="form-control">


                    <!-- START -->


                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <input type="text" style='text-align:center' name='weight' id='supplier'
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <input type="text" style='text-align:center' name='weight' id='supplier'
                                            readonly class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label class="col-md-12">Lot # </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='cost' id='m_lot_no'
                                                readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <center>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row no-gutters">

                                    <div class="col">
                                        <label class="col-md-12">Date </label>
                                        <div class="input-group mb-1">
                                            <div class="input-group mb-1">
                                                <input type="text" style='text-align:right' name='cost'
                                                    id='m_milling_date' readonly class="form-control">
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label class="col-md-12">Crumbed Weight </label>
                                        <div class="input-group mb-1">
                                            <div class="input-group mb-1">
                                                <input type="text" style='text-align:right' name='crumbed_weight'
                                                    id='crumbed_weight' class="form-control"
                                                    placeholder="Type weight here...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="drying" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="modal_milling_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Milling | Transfer to Drying</h5>
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
                                    <label class="col-md-12">Reweight</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' name='cost' id='process_weight'
                                                readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="col">
                                <label class="col-md-12">Crumbed Weight </label>
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