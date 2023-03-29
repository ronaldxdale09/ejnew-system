
<body>

    <div class="row">
        <div class="col-12">
            <br>

            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-success text-white confirm" id='confirm'>Confirm
                        Transaction</button>
                    <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                        <span class="fa fa-print"></span> Print Receipt </button>
                    <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                        <span class="fa fa-print"></span> Print Voucher </button>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">



                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Reference No.</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" name='bales_container'
                                                id='first_price' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Shipment Date </label>
                                        <div class="col-md-12">
                                            <input type="date" class='form-control' id="ship_date"
                                                value="<?php echo $today; ?>" name="date">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Buyer</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" name='sale_buyer'
                                                id='sale_buyer' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Van No. </label>
                                        <div class="input-group mb-3">


                                            <input type="text" class="form-control" name='bales_container'
                                                id='first_price' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Sale Type</label>

                                        <div class="input-group mb-3">
                                            <select class="form-select" id="sale_type" name="sale_type"
                                                style="width: 100px;">
                                                <option selected>Choose...</option>
                                                <option value="bales_export">Bales-Export</option>
                                                <option value="bales_local">Bales-Local</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Bill of Lading</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" name='info_lading'
                                                id='info_lading' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Destination</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='sale_destination'
                                                id='sale_destination' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Voyage</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" name='bales_container'
                                                id='first_price' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Source</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='bales_container'
                                                id='first_price' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label style='font-size:15px' class="col-md-12">Vessel</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control" name='bales_container'
                                                id='first_price' onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- RUBBER QUALITY -->

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rubber Weight</h5>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Quality</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="quality" name="quality"
                                            style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="cuplumps_export">SPR-20</option>
                                            <option value="bales_export">SPR-3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Quality</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="quality" name="quality"
                                            style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="cuplumps_export">SPR-20</option>
                                            <option value="bales_export">SPR-3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">No. of Bales </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_num'
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">bales</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">No. of Bales </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_num'
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">bales</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Weight per Bale </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_kilo'
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Weight per Bale </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_kilo'
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Weight </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_weight' readonly
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Weight </label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='bales_weight' readonly
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total Weight</label>
                                <div class="input-group mb-3">

                                    <input type="text" style='text-align:right' id='total_weight' readonly
                                        class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
<br>

                <h4> Revenue and Expenses </h4>
                <hr>
                <!-- COSTING -->
                <div class="row">
                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Price per Kilo </label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='kilo_price' id='kilo_price'
                                style="width: 100px;" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Bale Cost per Kilo </label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='bale_kilo_cost' id='bale_kilo_cost'
                                style="width: 100px;" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Milling Fee per Kilo </label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='kilo_milling_fee' id='kilo_milling_fee'
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL SALES</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='sales' id='sales' readonly
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-4">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL BALE COST</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='total_bale_cost' id='total_bale_cost' readonly
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-4">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL MILLING FEE</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='total_milling_fee' id='total_milling_fee' readonly
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>
                <br>
                <hr>

                <!-- SHIPPING EXPENSES -->
                <h6> Shipping Expenses:</h6>

                <div class="row">
                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Loading & Unloading</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_loading' id='ship_exp_loading'
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Trucking</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_trucking' id='ship_exp_trucking'
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Zambo to Manila Freight</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_zmfreight' id='ship_exp_zmfreight'
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Manila Trucking</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_mtrucking' id='ship_exp_mtrucking'
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Cranage Fee (Arrastre)</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_cranage' id='ship_exp_cranage'
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Miscellaneous Expenses : </label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_misc' id='ship_exp_misc'
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                    </div>
                    <div class="col-4">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL SHIPPING EXPENSES</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='total_ship_exp' id='total_ship_exp' readonly
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">NET GAIN</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='net_gain' id='net_gain' readonly
                                style="width: 100px;" />
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
                                <input type="text" class="form-control" name='sales' id='sales'readonly
                                    style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">TOTAL AMOUNT PAID</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name='paid_total' id='paid_total'readonly
                                    style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid'readonly
                                    autocomplete='off' style="width: 100px;"   />
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <label style='font-size:15px' class="col-md-12">Date of Payment </label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="pay_date" value="<?php echo $today; ?>"
                                    name="pay_date">
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <label style='font-size:15px' class="col-md-12">Details</label>
                            <div class="input-group mb-3">

                                <input type="text" class="form-control" name='pay_details' id='pay_details'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                        <div class="col-4">
                            <label style='font-size:15px' class="col-md-12">Amount</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name='paid_amount' id='paid_amount'
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="card" style=" border: 1px solid green;">
                <div class="card-body">
                    <h5 class="card-title">NOTES:</h5>
                    <hr>
                    <textarea class="form-control" rows="5" id="note" placeholder="Enter text here..."></textarea>
                </div>
            </div>
        </div>
</div>
