<?php
$today = date('Y-m-d');
?>



<div class="modal fade" id='viewSalesRecord' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">BALE SALE RECORD</h5>
                <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action='function/bale_sales.php'>
                <div class="modal-body">
                    <div id='print_content'>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Sale Contract</h4>

                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12"> Sales ID
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_sale_id' name='sale_id' readonly autocomplete='off' style="width: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_sale_contract' autocomplete='off' style="width: 100px;">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12"> Purchase Contract</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_purchase_contract' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Sale Type</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_sale_type' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Quality</label>
                                        <div class="input-group mb-3">

                                            <input type="text" readonly class="form-control" id='v_contract_quality' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label style='font-size:15px' class="col-md-12">Transaction Date </label>
                                        <div class="col-md-12">
                                            <input type="text" class='form-control' id="v_trans_date">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_sale_buyer'  autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_shipping_date'  autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Source</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control"  id='v_sale_source'  autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Destination</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_sale_destination'  autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Containers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='v_contract_contaier'  autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-3">
                                        <label style='font-size:15px' class="col-md-12">Quantity</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" readonly id='v_contract_quantity'  autocomplete='off' style="width: 100px;" />
                                            <span class="input-group-text"> kg</span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Currency</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" readonly id='v_currency'  autocomplete='off' style="width: 100px;" />

                                        </div>
                                    </div>


                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                                        <div class="input-group mb-3">
                                            <input type="number" readonly class="form-control contract_price" id='v_contract_price'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label style='font-size:15px' class="col-md-12">Other Terms
                                            (Optional)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='other_terms' id='v_other_terms'>
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
                                        <h4>Bale Volume and Costing</h4>
                                        <button type='button' id='btnContainer' class="btn btn-warning btnContainer">
                                            <i class="fas fa-box"></i> Select Container
                                        </button>
                                    </div>
                                </div>

                                <hr>

                                <div id='container_selected'></div>


                                <div class="row">
                                    <div class="col" hidden>
                                        <label style='font-size:15px' class="col-md-12">No. of Containers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id='v_number_container' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total No. of Bales</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"  id='v_total_num_bales' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Bale Weight</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id='v_total_bale_weight' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Overall Average Cost per
                                            Kilo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">≈ ₱</span>
                                            </div>
                                            <input type="text" class="form-control"  id='v_overall_ave_kiloCost' style="width: 100px;" readonly />
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
                                        <button type="button" id="addPayment" class="btn btn-warning addPayment">
                                            <i class="fas fa-money"></i> Add Payment
                                        </button>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">TOTAL SALES</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_sales'></span>
                                            <input type="text" class="form-control"  id='v_total_sale' readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_paid'></span>
                                            <input type="text" class="form-control"  id='v_amount_paid' readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_balance'></span>
                                            <input type="text" class="form-control"  id='v_unpaid_balance' readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>

                                <hr>
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
                                        <label style="font-size:15px" class="col-md-12">SALE PROCEEDS</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" id="v_sales_proceeds" readonly style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style="font-size:15px" class="col-md-12">Tax Rate</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="v_tax_rate" style="width: 100px;" />
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style="font-size:15px" class="col-md-12">Withholding Tax Amount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" readonly id="v_tax_amount" style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                        <label style="font-size:15px" class="col-md-12">OVERALL COST</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control"  id="v_over_all_cost" readonly style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Bale Cost</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id='v_total_bale_cost' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Milling Cost</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" id='v_total_milling_cost' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Shipping Expense</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" id='v_total_ship_exp' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                        <label style="font-size:15px" class="col-md-12">GROSS PROFIT/LOSS</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style='font-size:20px'>₱</span>
                                            </div>
                                            <input type="text" class="form-control"  id="v_gross_profit" style='font-size:20px' readonly style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
        </form>
    </div>
</div>