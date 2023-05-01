<?php 


$id= '';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id']) ;
}


?>
<?php    include "sales_modal/wet_modal_sales.php";?>
<?php    include "js/fetch_cost_weight.php";?>
<div class="row">
    <div class="col-12">
        <br>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary confirmSales" id="someButton">Confirm Sales</button>
                <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                    <span class="fa fa-print"></span> Print Receipt </button>
                <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                    <span class="fa fa-print"></span> Print Voucher </button>

            </div>

        </div>
        <hr>

        <div class="card">
            <div class="card-body">
                <h4>Sales Information</h4>
                <hr>
                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Reference No.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='sale_id' id='sale_id' value='<?php echo $id?>' readonly
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Sale Type</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="sale_type" name="sale_type" style="width: 100px;">
                                <option selected>Choose...</option>
                                <option value="EXPORT">Export</option>
                                <option value="LOCAL">Local</option>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Van No. </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='van_no' id='van_no' tabindex="7"
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
                            <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Destination</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='sale_destination' id='sale_destination'
                                tabindex="7" autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Voyage</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='voyage' id='voyage' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Vessel</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='vessel' id='vessel' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Bill of Lading</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='info_lading' id='info_lading' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Source</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='source' id='source' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label style='font-size:15px' class="col-md-12">Remarks </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='remarks' id='remarks'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- SAMPLE STRUCTURE NG TABLE -->

                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h5 style='font-weight:bold;'>SELECTED INVENTORY</h5>
                            <button id="printButton" class="btn btn-warning btnInventory">
                                <i class="fas fa-box"></i> Select Inventory
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>
               
              <div id='inventory_selected'></div>

            </div>
        </div>


        <br>
        <div class="card">
            <div class="card-body">
                <!-- SHIPPING EXPENSES -->
                <h4>Financial Metrics</h4>

                <hr>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5>Bale Pricing</h5>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Currency</label>
                                        <div class="input-group mb-3">
                                            <select class="form-select" id="sale_currency" name="sale_currency"
                                                style="width: 100px;">
                                                <option selected>Choose...</option>
                                                <option value="PHP">PHP ₱</option>
                                                <option value="USD">USD $</option>
                                                <option value="RUB">RUB ₽</option>
                                                <option value="MYR">MYR RM</option>
                                                <option value="CNY">CNY ¥</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Price per Kilo </label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='price_per_kilo'
                                                id='price_per_kilo' style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Exchange Rate</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name='exchange_rate'
                                                id='exchange_rate' style="width: 100px;" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style='font-size:15px' class="col-md-12">Peso Price</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='peso_price' id='peso_price'
                                                style="width: 100px;" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL
                                            SALES</label>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name='total_sales' id='total_sales'
                                                readonly style="width: 100px;" />
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
                                        <input type="text" class="form-control" name='milling_fee_per_kilo'
                                            id='milling_fee_per_kilo' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px;' class="col-md-12">Total Weight</label>
                                    <div class="input-group mb-3">

                                        <input type="text" style='text-align:right' id='total_weight'
                                            name='total_weight' class="form-control">
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
                                <label style='font-size:15px' class="col-md-12"><b>Total Bale Cost</b> (See
                                    Above)</label>
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
                <hr>
                <h5> Shipping Expenses </h5>
                <hr>

                <div class="row">

                    <div class="col-4">
                        <label style='font-size:15px' class="col-md-12">Freight (All In)</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_freight' id='ship_exp_freight'
                                style="width: 100px;" />
                        </div>
                    </div>

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
                        <label style='font-size:15px' class="col-md-12">Processing Fee (Phytosanitary)</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='ship_exp_processing' id='ship_exp_processing'
                                style="width: 100px;" />
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
                            <input type="text" class="form-control" name='ship_exp_trucking' id='ship_exp_trucking'
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
                                style="width: 100px;" />
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

                <!-- PROFIT/LOSS -->

                <br>
                <h5> Profit/Loss Computation </h5>
                <hr>

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

                    <div class="col">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL CUPLUMP COST</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='total_wet_cost' id='total_wet_cost' readonly
                                style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col">
                        <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL SHIPPING
                            EXPENSES</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" name='total_ship_exp' id='total_ship_exp' readonly
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>

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
        </div>

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
                            <input type="text" class="form-control" name='payment_sales' id='payment_sales' readonly
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
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'
                                style="width: 100px;" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>

    </div>
</div>
</form>
<?php    include "fetch/wet_export_fill_data.php";?>
<script>
$(document).ready(function() {

   



    $('.btnInventory').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();


        var sales_id = <?php echo $id ?>

        function fetch_data() {

            $.ajax({
                url: "table/bales_cost_weight.php",
                method: "POST",
                data: {
                    sales_id: sales_id,

                },
                success: function(data) {
                    $('#inventoryModal').modal('show');
                    $('#inventory_table').html(data);


                }
            });
        }
        fetch_data();
    });


    $('.confirmSales').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#confirmSalesModal').modal('show');

    });



});
</script>