<?php
$today = date('Y-m-d');
?>
<!-- Add New Container Modal -->
<div class="modal fade" id="newShipment" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">New Bales Shipment</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/bale_shipment.php" method="POST">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="type" style="width: 100px;" required>
                                    <option select disabled>Select</option>
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
                                    required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Particular/Buyer</label>
                            <div class="col-md-12">
                                <input type="text" class='form-control' name="n_buyer" required>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='destination' autocomplete='off'
                                    style="width: 100px;" required />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Source</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' autocomplete='off'
                                    style="width: 100px;" required />
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
                            <label style='font-size:15px' class="col-md-12">Recorded by</label>
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




<div class="modal fade" id='containerModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
</div>



<!-- Add New Container Modal -->
<div class="modal fade" id="baleShipmentModal" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Bale Shipment Record</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/bale_shipment.php" method="POST">

                <div class="modal-body">
                    <input type="text" class="form-control" id='v_ship_id' name='ship_id' autocomplete='off'
                        style="width: 100px;" hidden />
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_type' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Source</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_source' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_destination' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipment Date</label>
                            <div class="col-md-12">
                                <input type="text" class='form-control' id="v_date" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Vessel</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_vessel' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Bill of Lading</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_bill_lading' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remarks</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_remarks' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_recorded_by' autocomplete='off'
                                    style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <div id='shipment_container_record'> </div>

                            <div class="row">
                                <div class="col">
                                    <label style="font-size:15px;font-weight:bold" class="col-md-12">No. of
                                        Bales</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="v_total_num_bales" tabindex="7"
                                            autocomplete="off" style="width: 100px;" readonly>
                                        <span class="input-group-text"> pcs</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;font-weight:bold" class="col-md-12">Total
                                        Bale Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="v_total_bale_weight" tabindex="7"
                                            autocomplete="off" style="width: 100px;" readonly>
                                        <span class="input-group-text"> kg</span>
                                    </div>
                                </div>
                                <div class="col" hidden>
                                    <label style="font-size:15px;font-weight:bold" class="col-md-12">Total Bale
                                        Cost</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> ₱</span>
                                        <input type="text" class="form-control" id="v_total_bale_cost" tabindex="7"
                                            autocomplete="off" style="width: 100px;" readonly>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h4>Shipping Expenses</h4>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Freight (All In)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_freight' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Loading &
                                        Unloading</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_loading' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Processing Fee
                                        (Phytosanitary)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_processing' readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Trucking Expense</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_trucking' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Cranage Fee
                                        (Arrastre)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_cranage' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Miscellaneous
                                        Expenses:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_exp_misc' readonly />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                        Shipping Expense</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_total_ship_exp' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px;font-weight:bold' class="col-md-12">No. of
                                        Containers</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id='v_number_container' readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px;font-weight:bold' class="col-md-12">Shipping
                                        Expense per Container</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='v_ship_cost_per_container'
                                            placeholder="0.00" readonly style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" name='edit' id='editButton'>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>