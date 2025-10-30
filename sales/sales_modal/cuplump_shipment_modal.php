<?php
$today = date('Y-m-d');
?>
<!-- Add New Container Modal -->
<div class="modal fade modal-custom" id="newShipment" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="newContainerLabel">New Cuplump Shipment</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/cuplump_shipment.php" method="POST">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="type" style="width: 100px;">
                                    <option>Select</option>
                                    <option value="EXPORT">Export</option>
                                    <option value="LOCAL">Local</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipment Date
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' value="<?php echo $today; ?>" name="n_date"
                                    require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Particular</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='particular' autocomplete='off'
                                    style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='destination' autocomplete='off'
                                    style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Source</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' autocomplete='off'
                                    style="width: 100px;" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remarks</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' id='remarks' autocomplete='off'
                                    style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' autocomplete='off'
                                    value='<?php echo $name ?>' style="width: 100px;" />
                            </div>
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




<!-- <div class="modal fade" id='cuplumpShipmentModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selected Inventory</h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id='container_list'> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div> -->
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
                    <button type="submit" id="editBtn" name="edit" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



