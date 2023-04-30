<body>

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
    <br>

    <div class="card">
        <div class="card-body">
            <h4>Sales Information</h4>
            <hr>
            <div class="row">
                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Reference No.</label>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" name='sale_id' id='sale_id'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Sale Type</label>
                    <div class="input-group mb-3">
                        <select class="form-select" id="sale_type" name="sale_type" style="width: 100px;">
                            <option selected>Choose...</option>
                            <option value="bales_export">Export Sale</option>
                            <option value="bales_local">Local Sale</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Van No. </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='bales_container' id='first_price'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Shipment Date </label>
                    <div class="col-md-12">
                        <input type="date" class='form-control' id="ship_date" value="<?php echo $today; ?>"
                            name="ship_date">

                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Buyer</label>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" name='sale_buyer' id='sale_buyer'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Destination</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='sale_destination' id='sale_destination'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Voyage</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='bales_container' id='first_price'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Vessel</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='bales_container' id='first_price'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Bill of Lading</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='info_lading' id='info_lading'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Source</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='bales_container' id='first_price'
                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="7"
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>

                <div class="col-6">
                    <label style='font-size:15px' class="col-md-12">Remarks </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name='bales_container' id='first_price'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <!-- RUBBER QUALITY -->

    <!-- SAMPLE STRUCTURE NG TABLE -->
    <h2>SAMPLE TABLE TEMPLATE</h2>
    <div class="row">
        <div class="col" hidden>
            <!-- HIDE ID LANG -->
            <label for="bales_quality" class="form-label">ID</label>
            <input type="text" class="form-control" id="bales_quality">
        </div>

        <div class="col-2">
            <!-- COMBINATION NG SELLER AT LOT NO. -->
            <label for="bales_quality" class="form-label">Source</label>
            <input type="text" class="form-control" id="bales_quality" readonly>
        </div>
        <div class="col">
            <!-- no decimal but with comma #,###-->
            <label for="bales_num" class="form-label">No. of Bales</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_num" readonly>
                <span class="input-group-text">pcs</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- 35 OR 33.33 TO DITO -->
            <label for="bales_weight" class="form-label">Bale Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- = NO. OF BALES * BALE WEIGHT -->
            <label for="bales_weight" class="form-label">Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <label for="bales_kilo" class="form-label">Cost per Kilo</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- - WEIGHT * COST PER KILO -->
            <label for="bales_kilo" class="form-label">Total Cost</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" hidden>
            <label for="bales_quality" class="form-label">ID</label>
            <input type="text" class="form-control" id="bales_quality">
        </div>
        <div class="col-2">
            <label for="bales_quality" class="form-label">Source</label>
            <input type="text" class="form-control" id="bales_quality" readonly>
        </div>
        <!-- <div class="col">
            <label for="bales_quality" class="form-label">Quality</label>
            <input type="text" class="form-control" id="bales_quality" readonly>
        </div> -->
        <div class="col">
            <label for="bales_num" class="form-label">No. of Bales</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_num" readonly>
                <span class="input-group-text">pcs</span>
            </div>
        </div>
        <div class="col">
            <label for="bales_weight" class="form-label">Bale Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <label for="bales_weight" class="form-label">Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <label for="bales_kilo" class="form-label">Cost per Kilo</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
        <div class="col">
            <label for="bales_kilo" class="form-label">Cost</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
    </div>

    <hr>

    <!-- ACTUAL NA ROW TO, SUMMARY -->
    <div class="row">
        <div class="col">
            <!-- BASED SA EXCEL KO DITO, ISANG TYPE LANG DAPAT LAHAT-->
            <label for="bales_num" class="form-label">Quality</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_num" readonly>
            </div>
        </div>
        <div class="col">
            <!-- #,### NO DECIMAL -->
            <!-- ADD LAHAT NG BALE PCS -->
            <label for="bales_num" class="form-label">Total Bales</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_num" readonly>
                <span class="input-group-text">pcs</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- ADD LAHAT NG WEIGHT -->
            <label for="bales_weight" class="form-label">Total Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- = TOTAL COST / TOTAL WEIGHT -->
            <label for="bales_kilo" class="form-label">Ave. Cost per Kilo</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- ADD LAHAT NG COST -->
            <label for="bales_kilo" class="form-label">Total Bale Cost</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_kilo" readonly>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="row align-items-center">
                    <div class="col-10">
                        <h4 class="card-title">Bale Weight</h4>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success text-white confirm" data-toggle="modal"
                            data-target="#inventoryModal">
                            <i class="fa fa-plus"></i> Add Inventory
                        </button>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row " id="bales-row">
                <div class="col-md-6 mb-3">
                    <label for="bales_quality" class="form-label">Quality</label>
                    <input type="text" class="form-control" id="bales_quality">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bales_num" class="form-label">No. of Bales</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bales_num">
                        <span class="input-group-text">bales</span>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="bales_kilo" class="form-label">Weight per Bale</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bales_kilo">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bales_weight" class="form-label">Weight</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="bales_weight" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="toggle-row">
                    View Details <i class="fa fa-chevron-down"></i>
                </button>
            </div>
        </div>
    </div>


    <br>


    <div class="card">
        <div class="card-body">

            <h4>Financial Metrics</h4>

            <hr>

            <div class="row">
                <div class="col">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <h5>Bale Pricing</h5>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_currency" name="sale_currency"
                                            style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="bales_local">PHP ₱</option>
                                            <option value="bales_export">USD $</option>
                                            <option value="bales_local">RUB ₽</option>
                                            <option value="bales_local">CNY ¥</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Price per Kilo </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='kilo_price' id='kilo_price'
                                            style="width: 100px;" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Exchange Rate</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='forex' id='forex'
                                            style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Peso Price</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='kilo_milling_fee'
                                            id='kilo_milling_fee' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL SALES</label>
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='sales' id='sales' readonly
                                            style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <div class="card-body">
                        <h5>Bale Costing</h5>

                        <div class="row">
                            <div class="col">
                                <label style='font-size:15px' class="col-md-12">Milling Fee per Kilo </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" name='kilo_milling_fee'
                                        id='kilo_milling_fee' style="width: 100px;" />
                                </div>
                            </div>
                            <div class="col">
                                <label style='font-size:15px;' class="col-md-12">Total Weight</label>
                                <div class="input-group mb-3">

                                    <input type="text" style='text-align:right' id='total_weight' class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total Milling
                                    Fee</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" name='total_milling_fee'
                                        id='total_milling_fee' readonly style="width: 100px;" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label style='font-size:15px' class="col-md-12"><b>Total Bale Cost</b> (See Above)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name='total_bale_cost' id='total_bale_cost'
                                    readonly style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <h5> Shipping Expenses</h5>

            <div class="row">

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Loading & Unloading</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='ship_exp_loading' id='ship_exp_loading'
                            style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Trucking</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='ship_exp_trucking' id='ship_exp_trucking'
                            style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Zambo to Manila Freight</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='ship_exp_zmfreight' id='ship_exp_zmfreight'
                            style="width: 100px;" />
                    </div>
                </div>

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

            </div>

            <div class="row">
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

                <div class="col-6">
                    <label style='font-size:15px;font-weight:bold' class="col-md-12">Total Shipping
                        Expenses</label>
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
                <div class="col-6">
                    <label style='font-size:15px;font-weight:bold' class="col-md-12">GROSS PROFIT</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='net_gain' id='net_gain' readonly
                            style="width: 100px;" />
                    </div>
                </div>
            </div>

            <br>

            <h5 class="card-title">Payment Details</h5>

            <hr>

            <div class="row">
                <div class="col-2">
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

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">Amount</label>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='paid_amount' id='paid_amount' autocomplete='off'
                            style="width: 100px;" />
                    </div>
                </div>

                <div class="col">
                    <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid' readonly
                            autocomplete='off' style="width: 100px;" />
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script>
    // hide all rows except the first and second ones
    var rows = document.querySelectorAll("#bales-row > div");
    for (var i = 2; i < rows.length; i++) {
        rows[i].style.display = "none";
    }

    // toggle row visibility when the user clicks on the button
    document.getElementById("toggle-row").addEventListener("click", function() {
        var rows = document.querySelectorAll("#bales-row > div");
        if (rows[2].style.display === "none") {
            // show all rows
            for (var i = 0; i < rows.length; i++) {
                rows[i].style.display = "block";
            }
        } else {
            // hide all rows except the first and second ones
            for (var i = 2; i < rows.length; i++) {
                rows[i].style.display = "none";
            }
        }
    });
    </script>