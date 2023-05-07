<div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> CUPLUMP SALE CONTRACT</h5>
            </div>
            <form method='POST' action='function/cuplump_sale_contract.php'>

                <div class="modal-body">


                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">EN Sale Contract
                                No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_info_lading' id='wet_info_lading'
                                    tabindex="7" autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Transaction Date
                            </label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="wet_ship_date" value="<?php echo $today; ?>"
                                    name="wet_ship_date" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract
                                No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_buyer_contract_no'
                                    id='wet_buyer_contract_no' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="wet_sale_type" name="wet_sale_type"
                                    style="width: 100px;">
                                    <option value="EXPORT">Export</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Buyer Company
                                Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_sale_buyer' id='wet_sale_buyer'
                                    tabindex="7" autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipping
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="wet_ship_date" value="<?php echo $today; ?>"
                                    name="wet_ship_date">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Address</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_sale_destination'
                                    id='wet_sale_destination' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipping
                                Port</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_info_lading' id='wet_info_lading'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Contact
                                Information</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_voyage' id='wet_voyage' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_source' id='wet_source' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Quantity</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_quantity' id='wet_quantity'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Packing</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_packing' id='wet_packing' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Containers</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_containers' id='wet_containers'
                                    tabindex="7" autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>


                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Other Terms</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='wet_remarks' id='wet_remarks'>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" name='wet_price' id='wet_price' required>
                            </div>
                        </div>

                        <div class="col">
                            <label for="product_name" class="form-label">Recorded By</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="wet_recorded_by" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name='new' class="btn btn-success">Confirm</button>

                    </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id='inventoryModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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

                <div id='inventory_table'> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="confirmSalesModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Sales</h5>
                <button type="button" class="btn-close text-light" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-5 text-center">Are you sure you want to confirm this transaction?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name='new' class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>