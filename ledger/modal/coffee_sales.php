    <div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> NEW | COFFEE SALE</h5>
                <button type="button" class="btn btn-success">+ ITEM LINE</button>
                </div>
                <form method='POST' action='function/cuplump_sale_contract.php'>

                    <div class="modal-body">


                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Invoice No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='sale_contract_no' id='sale_contract_no'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col-5">
                            <label style='font-size:15px' class="col-md-12">Customer Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='purchase_contract_no'
                                    id='wet_buyer_contract_no' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col-4">
                            <label style='font-size:15px' class="col-md-12">Transaction Date
                            </label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="transaction_date"
                                    value="<?php echo $today; ?>" name="transaction_date">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-4">
                            <label style='font-size:15px' class="col-md-12">Product</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="wet_sale_type" name="wet_sale_type"
                                    style="width: 100px;">
                                    <option readonly>Select...</option>
                                    <option value="LC_W_CASE">LC Powder - Wholesale (1 Case)</option>
                                    <option value="LC_W_KG">LC Powder - Wholesale (1 KG)</option>
                                    <option value="LC_R">LC Powder - Retail (1KG)</option>
                                    <option value="LC_W_HALF_KG">LC Powder - Retail (1/2 KG)</option>
                                    <option value="LC_W_QUARTER_KG">LC Powder - Retail (1/4 KG)</option>
                                    <option value="HB_W_CASE">HB Roasted - Wholesale (1 Case)</option>
                                    <option value="HB_W_KG">HB Roasted - Wholesale (1 KG)</option>
                                    <option value="HB_W_KG">HB Roasted - Retail (1 KG)</option>
                                    <option value="HB_W_HALF_KG">HB Roasted - Retail (1/2 KG)</option>
                                    <option value="HB_W_QUARTER_KG">HB Roasted - Retail (1/4 KG)</option>
                                    <option value="HB_A">HB Roasted - Arabica (1 KG)</option>
                                    <option value="HB_E">HB Roasted - Excelsa (1 KG)</option>
                                    <option value="HB_O">HB Roasted - Robusta (1 KG)</option>
                                    <option value="HB_U">HB Roasted - Arabusta (1 KG)</option>
                                    <option value="KK_A">Kalunkopi - Arabica (1 KILO)</option>
                                    <option value="KK_H">Kalunkopi - House Blend (1 KILO)</option>
                                    <option value="KK_R">Kalunkopi - Robusta (1 KILO)</option>
                                    <option value="KK_U">Kalunkopi - Arabusta (1 KILO)</option>
                                    <option value="KK_A_250G">Kalunkopi - Arabica (250G)</option>
                                    <option value="KK_H_250G">Kalunkopi - House Blend (250G)</option>
                                    <option value="KK_R_250G">Kalunkopi - Robusta (250G)</option>
                                    <option value="KK_U_250G">Kalunkopi - Arabusta (250G)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <label style='font-size:15px' class="col-md-12">Unit (Qty)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='address' id='address' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='shipping_port' id='shipping_port'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Amount</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='shipping_port' id='shipping_port'
                                    tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Total Amount Due</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='contact' id='contact' tabindex="7"
                                    autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Amount Paid</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='destination' id='destination' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remaining Balance</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='destination' id='destination' tabindex="7"
                                    autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='new' class="btn btn-primary">Confirm</button>

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