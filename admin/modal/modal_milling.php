<div class="modal fade" id="modal_mil_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Milling | Update</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='mil_u_recording_id' hidden
                        readonly class="form-control">


                    <!-- START -->


                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <input type="text" style='text-align:center' name='weight' id='mil_u_supplier'
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <input type="text" style='text-align:center' id='mil_u_loc' readonly
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label class="col-md-12">Lot # </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' id='mil_u_lot' readonly
                                                class="form-control">
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
                                                <input type="date" style='text-align:center' name='date'
                                                    id='m_milling_date' class="form-control"
                                                    value="<?php echo date('Y-m-d'); ?>">
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col text-center">
                                        <label class="col-md-12">Crumbed Weight </label>
                                        <div class="input-group mb-1">
                                            <div class="input-group mb-1">
                                                <input type="text" style='text-align:center' name='crumbed_weight'
                                                    class="form-control" required placeholder="Type weight here...">
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
                <button type="submit" name="milling_update" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_milling_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Milling | Transfer to Drying</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                <input type="text" style='text-align:center' name='recording_id' id='trans_mill_id'
                                    readonly class="form-control" hidden>
<!-- 
                    <div class="row no-gutters">
                        <div class="col-5">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Date Received</label>
                                
                                <input type="text" style='text-align:center' name='weight' id='trans_mill_date' readonly
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col">
                        </div>

                        <div class="col-3">
                            <div class="input-group mb-12">
                                <label class="col-md-12">ID</label>
                             
                            </div>
                        </div>

                    </div>
                    <br> -->
                    <div class="row no-gutters">

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <input type="text" style='text-align:center' name='weight' id='trans_mill_supplier'
                                    readonly class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <input type="text" style='text-align:center' name='weight' id='trans_mill_loc' readonly
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-md-12">Lot No.</label>
                            <input type="text" style='text-align:center' name='lot_no' id='trans_mill_lot_no' readonly
                                class="form-control">
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
                                            <input type="text" style='text-align:right' id='trans_mill_reweight'
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
                                                id='trans_mill_crumbed_weight'
                                                style='text-align:center; background-color:lightgreen;' readonly
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </center>


                    </div>
                    <div id='mill_trans_table_record'></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="mil_trans" class="btn btn-warning text-dark">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_mil_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Milling | Update Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='mil_v_recording_id' hidden
                        readonly class="form-control">


                    <!-- START -->


                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <input type="text" style='text-align:center' name='weight' id='mil_v_supplier'
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <input type="text" style='text-align:center' id='mil_v_loc' readonly
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label class="col-md-12">Lot # </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <input type="text" style='text-align:right' id='mil_v_lot' readonly
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div id='mill_table_record'></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="milling_update" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>