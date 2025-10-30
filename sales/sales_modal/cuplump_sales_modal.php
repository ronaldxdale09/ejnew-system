<?php
$today = date('Y-m-d');
?>

<!-- create Table Row -->
<div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW CUPLUMP EXPORT TRANSACTION</h5>
            </div>
            <form method='POST' action='function/cuplump_sales.php'>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date" value="<?php echo $today; ?>"
                                    required placeholder="Date of Transaction">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By"
                                    value='<?php echo $name ?>' required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Sale Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="sale_type" style="width: 100px;" required>
                                    <option selected disabled>Select...</option>
                                    <option value="EXPORT">Export</option>
                                    <option value="LOCAL">Local</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='contract' autocomplete='off'
                                    style="width: 100px;" required>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Contract</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='purchase_contract' style="width: 100px;"
                                    required />
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' autocomplete='off'
                                style="width: 100px;" required />
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Currency</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="sale_currency" name="sale_currency"
                                    style="width: 100px;" required>
                                    <option selected disabled>Choose...</option>
                                    <option value="PHP">PHP ₱</option>
                                    <option value="USD">USD $</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control contract_price" name='contract_price'
                                    id='contract_price' required>
                            </div>
                        </div>

                    </div>

                    <div class="col">
                        <label for="product_name" class="form-label">Remarks</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="remarks" placeholder="Enter Remark">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name='new' class="btn btn-success">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id='viewSalesRecord' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CUPLUMP SALE RECORD</h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action='function/cuplump_sales.php'>
                <div class="modal-body">
                    <div id='print_content'>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Sale Contract</h4>


                                    <button type="button" class="btn btn-dark btnPrint" id="btnPrint"><span
                                            class="fas fa-print"></span> Print </button>
                                </div>
                                <div id='print_content'>
                                    <div class="card">
                                        <div style="background-color: #2452af; height: 6px;"></div>
                                        <!-- This is the blue bar --> <br>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-1">
                                                    <label style='font-size:15px' class="col-md-12"> Sales ID
                                                    </label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='sales_id'
                                                            id='sales_id' readonly autocomplete='off'
                                                            style="width: 100px;">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">EN Sale
                                                        Contract</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_sale_contract'
                                                            readonly style="width: 100px;">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Buyer Purchase
                                                        Contract</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_purchase_contract'
                                                            readonly style="width: 100px;" />
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Sale Type</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class='form-control' id="v_sale_type"
                                                            readonly>
                                                    </div>
                                                </div>





                                                <div class="col-2">
                                                    <label style='font-size:15px' class="col-md-12">Transaction Date
                                                    </label>
                                                    <div class="col-md-12">
                                                        <input type="text" class='form-control' id="v_trans_date"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_sale_buyer'
                                                            autocomplete='off' style="width: 100px;" readonly />
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Shipping
                                                        Date</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_shipping_date'
                                                            autocomplete='off' style="width: 100px;" readonly />
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_sale_source'
                                                            autocomplete='off' style="width: 100px;" readonly />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_sale_destination'
                                                            autocomplete='off' style="width: 100px;" readonly />
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row">


                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_currency'
                                                            readonly>
                                                    </div>
                                                </div>


                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Price per
                                                        Kilo</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"
                                                            id='currency_selected_price'></span>
                                                        <input type="number" class="form-control" id='v_contract_price'
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Other Terms
                                                        (Optional)</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_other_terms'
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="card">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-between align-items-center">
                                                    <h4>Cuplump Volume and Costing</h4>

                                                </div>
                                            </div>

                                            <div id='container_cuplump_list'></div>


                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">No. of
                                                        Containers</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='v_number_container'
                                                            style="width: 100px;" readonly />
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                        Weight</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            id='v_total_cuplump_weight' style="width: 100px;"
                                                            readonly />
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style="font-size:15px" class="col-md-12">Total Selling
                                                        Weight</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" readonly
                                                            class="form-control small-font-input total_selling_weight"
                                                            name="total_selling_weight" id="total_selling_weight"
                                                            tabindex="7" autocomplete="off" style="width: 100px;" />
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Overall Average Cost
                                                        per
                                                        Kilo</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">≈ ₱</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            id='v_overall_ave_kiloCost' style="width: 100px;"
                                                            readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <br>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-between align-items-center">
                                                    <h4>Payment Details</h4>


                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">TOTAL SALES</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"
                                                            id='currency_selected_sales'></span>
                                                        <input type="text" class="form-control" id='v_total_sale'
                                                            readonly autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"
                                                            id='currency_selected_paid'></span>
                                                        <input type="text" class="form-control" id='v_amount_paid'
                                                            readonly autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">UNPAID
                                                        BALANCE</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"
                                                            id='currency_selected_balance'></span>
                                                        <input type="text" class="form-control" id='v_unpaid_balance'
                                                            readonly autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div id='payment_list_table'> </div>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-between align-items-center">
                                                    <h4>Sale Proceeds</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <label style="font-size:15px" class="col-md-12">SALE
                                                        PROCEEDS</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="v_sales_proceeds"
                                                            readonly style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style="font-size:15px" class="col-md-12">Tax Rate</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id="v_tax_rate"
                                                            style="width: 100px;" readonly />
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style="font-size:15px" class="col-md-12">Withholding Tax
                                                        Amount</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">₱</span>
                                                        <input type="text" class="form-control" readonly
                                                            id="v_tax_amount" style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                        Cost</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">₱</span>
                                                        <input type="text" class="form-control"
                                                            id='v_total_cuplump_cost' style="width: 100px;" readonly />
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Total Shipping
                                                        Expense</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id='v_total_ship_exp'
                                                            style="width: 100px;" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                                    <label style="font-size:15px" class="col-md-12">OVERALL COST</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="v_over_all_cost"
                                                            readonly style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-center">
                                                <div class="col-6">
                                                    <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                                    <label style="font-size:15px" class="col-md-12">GROSS
                                                        PROFIT/LOSS</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                style='font-size:20px'>₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="v_gross_profit"
                                                            style='font-size:20px' readonly style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="background-color: #2452af; height: 6px;"></div>
                                        <!-- This is the blue bar -->
                                    </div>
                                    <br>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='editBtn' name='edit' class="btn btn-warning"> <span
                            class="fas fa-pencil"></span> Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
        </form>
    </div>
</div>