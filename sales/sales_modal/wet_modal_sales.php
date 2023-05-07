<!-- create Table Row -->
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
                                <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Transaction Date
                            </label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="ship_date" value="<?php echo $today; ?>"
                                    name="ship_date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Contract
                                No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Buyer Company
                                Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipping
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="ship_date" value="<?php echo $today; ?>"
                                    name="ship_date">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Address</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='sale_destination' id='sale_destination'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipping
                                Port</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Contact
                                Information</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='voyage' id='voyage' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' id='source' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Quantity</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Packing</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' id='source' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Containers</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' id='source' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>


                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Other Terms</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' id='remarks'>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Price</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' id='remarks'>
                            </div>
                        </div>

                        <div class="col">
                            <label for="product_name" class="form-label">Recorded By</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By"
                                    required>
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
                <button type="submit"  name='new' class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>