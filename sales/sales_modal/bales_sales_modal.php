<?php
$today = date('Y-m-d');
?>

<!-- create Table Row -->
<div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW BALES EXPORT TRANSACTION</h5>
            </div>
            <form method='POST' action='function/bale_sales.php'>

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
                            <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7"
                                autocomplete='off' style="width: 100px;" required />
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
                            <label style='font-size:15px' class="col-md-12">Quality</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="quality" tabindex="7" required>
                                    <option disabled selected>Select...</option>
                                    <option value="SPR5">5L</option>
                                    <option value="SPR5">SPR-5</option>
                                    <option value="SPR10">SPR-10</option>
                                    <option value="SPR20">SPR-20</option>
                                    <option value="Offcolor">Off Color</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Kilo per Bale</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="kilo_bale" style="width: 100px;" required>
                                    <option selected disabled>Select...</option>
                                    <option value="35">35.00 kg</option>
                                    <option value="33.33">33.33 kg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
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
                        <div class="col-3">
                            <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control contract_price" name='contract_price'
                                    id='contract_price' required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="product_name" class="form-label">Remarks</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="remarks" placeholder="Enter Remark">
                            </div>
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


                                    <button type="button" class="btn btn-dark btnPrint" id="btnPrint"><span
                                            class="fas fa-print"></span> Print </button>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12"> Sales ID
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='sales_id'
                                                id='sales_id' readonly autocomplete='off' style="width: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='sale_contract'
                                                autocomplete='off' style="width: 100px;">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label style='font-size:15px' class="col-md-12"> Purchase Contract</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='buyer_contract'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Sale Type</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" id='sale_type'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Quality</label>
                                        <div class="input-group mb-3">

                                            <input type="text" readonly class="form-control" id='contract_quality'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label style='font-size:15px' class="col-md-12">Transaction Date </label>
                                        <div class="col-md-12">
                                            <input type="date" class='form-control' id="trans_date" name="trans_date">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='sale_buyer'
                                                id='sale_buyer' tabindex="7" autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='shipping_date'
                                                id='shipping_date' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Source</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='sale_source'
                                                id='sale_source' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Destination</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='sale_destination'
                                                id='sale_destination' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Containers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='contract_contaier'
                                                id='contract_contaier' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-3">
                                        <label style='font-size:15px' class="col-md-12">Quantity</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" readonly name='contract_quantity'
                                                id='contract_quantity' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />
                                            <span class="input-group-text"> kg</span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Currency</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" readonly name='sale_currency'
                                                id='sale_currency' tabindex="7" autocomplete='off'
                                                style="width: 100px;" />

                                        </div>
                                    </div>


                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                                        <div class="input-group mb-3">
                                            <input type="number" readonly class="form-control contract_price"
                                                name='contract_price' id='contract_price'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label style='font-size:15px' class="col-md-12">Other Terms
                                            (Optional)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly class="form-control" name='other_terms'
                                                id='other_terms'>
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

                                    </div>
                                </div>

                                <hr>

                                <div id='container_selected'></div>


                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">No. of Containers</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='number_container'
                                                id='number_container' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total No. of Bales</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='total_num_bales'
                                                id='total_num_bales' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Bale Weight</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='total_bale_weight'
                                                id='total_bale_weight' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Overall Average Cost per
                                            Kilo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">≈ ₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='overall_ave_kiloCost'
                                                id='overall_ave_kiloCost' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Bale Cost</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name='total_bale_cost'
                                                id='total_bale_cost' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Milling/Production
                                            Cost</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='total_production_cost'
                                                id='total_production_cost' style="width: 100px;" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Total Shipping Expense</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='total_ship_exp'
                                                id='total_ship_exp' style="width: 100px;" readonly />
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
                                        <h4>Payment and Sale Proceeds</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">TOTAL SALES</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_sales'></span>
                                            <input type="text" class="form-control" id='total_sale'
                                                readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_paid'></span>
                                            <input type="text" class="form-control" id='amount_unpaid' readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id='currency_selected_balance'></span>
                                            <input type="text" class="form-control" name='unpaid_balance'
                                                id='unpaid_balance' readonly autocomplete='off' style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div id='payment_list_table'> </div>

                                <div class="row">
                                    <div class="col">
                                        <!-- SUM OF ALL PESOS EQUIVALENT AMOUNT PAID -->
                                        <label style="font-size:15px" class="col-md-12">SALE PROCEEDS</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name="sales_proceeds"
                                                id="sales_proceeds" readonly style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                        <label style="font-size:15px" class="col-md-12">OVERALL COST</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name="over_all_cost"
                                                id="over_all_cost" readonly style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                        <label style="font-size:15px" class="col-md-12">GROSS PROFIT/LOSS</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name="gross_profit"
                                                id="gross_profit" readonly style="width: 100px;" />
                                        </div>
                                    </div>
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