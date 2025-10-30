
<div class="modal fade" id="cuplumpShipmentRecord" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Cuplump Shipment</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/cuplump_shipment.php" method="POST">
                <div id="print_content">
                    <div class="modal-body">
                        <input type="text" class="form-control" id="v_ship_id" name="ship_id" hidden
                            autocomplete="off" />

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Type</label>
                                <input type="text" class="form-control" id="v_type" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Shipment Date</label>
                                <input type="date" class="form-control" id="v_date" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Destination</label>
                                <input type="text" class="form-control" id="v_destination" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Source</label>
                                <input type="text" class="form-control" id="v_source" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Vessel</label>
                                <input type="text" class="form-control" id="v_vessel" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Bill of Lading</label>
                                <input type="text" class="form-control" id="v_info_lading" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Remarks</label>
                                <input type="text" class="form-control" id="v_remarks" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Recorded by:</label>
                                <input type="text" class="form-control" id="v_recorded_by" readonly />
                            </div>
                        </div>

                        <div id="shipment_container_record"></div>

                        <div class="card-body">
                                <h4>Shipping Expenses</h4>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Freight (All
                                            In)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='freight' id='ship_exp_freight'
                                                placeholder="0.00" style="width: 100px;" readonly/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Loading &
                                            Unloading</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='loading_expense'
                                                id='ship_exp_loading' placeholder="0.00" style="width: 100px;"readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Processing Fee
                                            (Phytosanitary)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='ship_exp_processing'
                                                id='ship_exp_processing' placeholder="0.00" style="width: 100px;"  readonly/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Trucking
                                            Expense</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='ship_exp_trucking'
                                                id='ship_exp_trucking' placeholder="0.00" style="width: 100px;"  readonly/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Cranage Fee
                                            (Arrastre)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='ship_exp_cranage'
                                                id='ship_exp_cranage' placeholder="0.00" style="width: 100px;"readonly  />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Miscellaneous
                                            Expenses:</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='ship_exp_misc'
                                                id='ship_exp_misc' placeholder="0.00" style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size:15px" class="col-md-12">Total Cuplump
                                            Weight</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="total_cuplump_weight"
                                                id="total-cuplump-weight" tabindex="7" autocomplete="off"
                                                style="width: 100px;" readonly />
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                            Shipping Expense</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" readonly class="form-control" name='total_ship_exp'
                                                id='total_ship_exp' placeholder="0.00" style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label style='font-size:15px;font-weight:bold' class="col-md-12">No.
                                            of
                                            Containers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" readonly name='number_container'
                                                id='number_container' placeholder="0.00" style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px;font-weight:bold' class="col-md-12">Shipping
                                            Expense per Container</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='ship_cost_per_container'
                                                id='ship_cost_per_container' placeholder="0.00" readonly
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
                </div>
            </form>
        </div>
    </div>
</div>



