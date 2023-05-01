<div class="modal fade" id="modalSalesRecord" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close text-light" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <h3>CUPLUMP SALES RECORD</h3>
                                    <div class="btn-group">
                                        <button  id='editButton' class="btn btn-warning" >
                                            <i class="fas fa-print"></i> Edit Sales
                                        </button>
                                        <button id="printButton" class="btn btn-primary">
                                            <i class="fas fa-print"></i> Export to PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div id='transaction_record'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-body">
                                                <form method='POST' id='m_transaction_form'>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px' class="col-md-12">Sales
                                                                ID.</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='sale_id' id='m_sale_id' readonly
                                                                    autocomplete='off' style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px' class="col-md-12">Shipment
                                                                Date
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input type="text" class='form-control' id="m_ship_date"
                                                                    name="ship_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px'
                                                                class="col-md-12">Buyer</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='sale_buyer' id='m_sale_buyer'
                                                                    autocomplete='off' style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px' class="col-md-12">Van No.
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='van_no' id='m_van_no' autocomplete='off'
                                                                    style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px' class="col-md-12">Sale
                                                                Type</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='m_sale_type' id='m_sale_type'
                                                                    autocomplete='off' style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px' class="col-md-12">Bill of
                                                                Lading</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='info_lading' id='m_info_lading'
                                                                    autocomplete='off' style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px'
                                                                class="col-md-12">Destination</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='sale_destination' id='m_sale_destination'
                                                                    autocomplete='off' style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px'
                                                                class="col-md-12">Voyage</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='voyage' id='m_voyage' autocomplete='off'
                                                                    style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px'
                                                                class="col-md-12">Source</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='source' id='m_source' autocomplete='off'
                                                                    style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style='font-size:15px'
                                                                class="col-md-12">Vessel</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" readonly
                                                                    name='vessel' id='m_vessel' autocomplete='off'
                                                                    style="width: 100px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- RUBBER WEIGHT -->
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">Cost & Weight</h5>
                                            </div>
                                            <hr>
                                            <div id='m_cost_weight_table'></div>
                                            <input type="hidden" name="cuplumps_total_cost"
                                                id="m_hidden_cuplumps_total_cost" />
                                            <input type="hidden" name="cuplumps_total_weight"
                                                id="m_hidden_cuplumps_total_weight" />
                                            <input type="hidden" name="cuplumps_average_per_kilo"
                                                id="m_hidden_cuplumps_average_per_kilo" />
                                            <br>
                                            <h5 class="card-title">Pricing</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" readonly
                                                            name='m_sale_currency' id='m_sale_currency'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Price per
                                                        Kilo</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" readonly
                                                            name='wet_kilo_price' id='m_wet_kilo_price'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Exchange Rate
                                                    </label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" readonly
                                                            name='exchange_rate' id='m_exchange_rate'
                                                            style="width: 100px;" value='1' />
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <br> <br>
                                <div class="card">
                                    <div class="card-body">
                                        <!-- SHIPPING EXPENSES -->
                                        <h5> Shipping Expenses </h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <label style='font-size:15px' class="col-md-12">Freight (All
                                                    In)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_freight' id='m_ship_exp_freight'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label style='font-size:15px' class="col-md-12">Loading &
                                                    Unloading</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_loading' id='m_ship_exp_loading'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label style='font-size:15px' class="col-md-12">Processing Fee
                                                    (Phytosanitary)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_processing' id='m_ship_exp_processing'
                                                        style="width: 100px;" />
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
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_trucking' id='m_ship_exp_trucking'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Cranage Fee
                                                    (Arrastre)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_cranage' id='m_ship_exp_cranage'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Miscellaneous
                                                    Expenses :
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_exp_misc' id='m_ship_exp_misc'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PROFIT/LOSS -->
                                        <br>
                                        <h5> Profit/Loss Computation </h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL
                                                    SALES</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly name='sales'
                                                        id='m_sales' readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL
                                                    CUPLUMP
                                                    COST</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='total_wet_cost' id='m_total_wet_cost' readonly
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL
                                                    SHIPPING
                                                    EXPENSES</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly
                                                        name='total_ship_exp' id='m_total_ship_exp' readonly
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">NET
                                                    GAIN</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly name='net_gain'
                                                        id='m_net_gain' readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- PAYMENT DETAILS -->
                            <div class="card" style=" border: 1px solid green;">
                                <div class="card-body">
                                    <h5 class="card-title">Payment Details</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">SALES</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control" readonly name='payment_sales'
                                                    id='m_payment_sales' readonly style="width: 100px;" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control" readonly name='amount_unpaid'
                                                    id='m_amount_unpaid' readonly autocomplete='off'
                                                    style="width: 100px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label style='font-size:15px' class="col-md-12">Date of Payment </label>
                                            <div class="col-md-12">
                                                <input type="text" class='form-control' id="m_pay_date" name="pay_date"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <label style='font-size:15px' class="col-md-12">Details</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" readonly name='pay_details'
                                                    id='m_pay_details' autocomplete='off' style="width: 100px;" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label style='font-size:15px' class="col-md-12">Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control" readonly name='paid_amount'
                                                    id='m_paid_amount' style="width: 100px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>