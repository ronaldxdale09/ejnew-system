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
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <h4>Sales Information</h4>
            <hr>
            <form method='POST' id='transaction_form'>
                <div class="row">

                    <div class="col-1">
                        <label style='font-size:15px' class="col-md-12">Sales ID.</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" name='sale_id' id='sale_id' value='<?php echo $id?>'
                                readonly autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>

                    <div class="col-5">
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
                        <label style='font-size:15px' class="col-md-12">Remarks</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='remarks' id='remarks' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<br>

<!-- FINANCIAL METRICS -->

<div class="card">
    <div class="card-body">

        <h4>Financial Metrics</h4>

        <hr>

        <div class="row">
            <div class="col">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h5>Cuplump Pricing</h5>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <label style='font-size:15px' class="col-md-12">Currency</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" id="sale_currency" name="sale_currency"
                                        style="width: 100px;">
                                        <option selected>Choose...</option>
                                        <option value="USD">USD $</option>
                                        <option value="RUB">RUB ₽</option>
                                        <option value="MYR">MYR RM</option>
                                        <option value="CNY">CNY ¥</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name='wet_kilo_price' id='wet_kilo_price'
                                        style="width: 100px;" />
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col">
                                <label style='font-size:15px' class="col-md-12">Exchange Rate</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name='exchange_rate' id='exchange_rate'
                                        style="width: 100px;" value='1' />
                                </div>
                            </div>

                            <div class="col">
                                <label style='font-size:15px' class="col-md-12">Peso Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" name='n/a' id='n/a' style="width: 100px;" />
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
                                    <input type="text" class="form-control" name='sales' id='sales' readonly
                                        style="width: 100px;" />
                                </div>
                            </div>
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
                        <input type="text" class="form-control" name='ship_exp_processing' id='ship_exp_processing' style="width: 100px;" />
                    </div>
                </div>
            </div>


            <div class="col">

                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name='ship_exp_trucking' id='ship_exp_trucking'  style="width: 100px;" />
                    </div>

                    <div id='cost_weight_table'></div>
                    <input type="hidden" name="cuplumps_total_cost" id="hidden_cuplumps_total_cost" />
                    <input type="hidden" name="cuplumps_total_weight" id="hidden_cuplumps_total_weight" />
                    <input type="hidden" name="cuplumps_average_per_kilo" id="hidden_cuplumps_average_per_kilo" />

                </div>

                <div class="row">
                    <label style='font-size:15px;font-weight:bold' class="col-md-12">TOTAL CUPLUMP
                        COST</label>
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
                        <input type="text" class="form-control" name='ship_exp_misc' id='ship_exp_misc' style="width: 100px;" />
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
            </div>
        </div>

        <br>
        <h5> Shipping Expenses </h5>
        <hr>


        <div class="row">

            <div class="col">
                <label style='font-size:15px' class="col-md-12">Freight (All In)</label>
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                    </div>
                    <input type="text" class="form-control" name='ship_exp_freight' id='ship_exp_freight'
                        style="width: 100px;" />
                </div>
            </div>

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
                <label style='font-size:15px' class="col-md-12">Processing Fee
                    (Phytosanitary)</label>
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                    </div>
                    <input type="text" class="form-control" name='ship_exp_processing' id='ship_exp_processing'
                        style="width: 100px;" />
                </div>
            </div>

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
        </div>

        <div class="row">
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
                <label style='font-size:15px' class="col-md-12">Miscellaneous Expenses :
                </label>
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                    </div>
                    <input type="text" class="form-control" name='ship_exp_misc' id='ship_exp_misc'
                        style="width: 100px;" />
                </div>
            </div>

            <div class="col-6">
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

        <hr>

        <div class="row">
            <div class="col">
            </div>
            <div class="col">
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
            <div class="col">
                <label style='font-size:15px' class="col-md-12">TOTAL AMOUNT</label>
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
                    <input type="date" class='form-control' id="pay_date" value="<?php echo $today; ?>" name="pay_date">
                </div>
            </div>

            <div class="col-sm-5">
                <label style='font-size:15px' class="col-md-12">Details</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" name='pay_details' id='pay_details' autocomplete='off'
                        style="width: 100px;" />
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

    </form>



    <?php    include "fetch/wet_export_fill_data.php";?>
    <script>
    $(document).ready(function() {

        async function fetchExchangeRate(baseCurrency, targetCurrency) {
            const url =
                `https://api.frankfurter.app/latest?from=${baseCurrency}&to=${targetCurrency}`;

            try {
                const response = await fetch(url);
                const data = await response.json();
                return data.rates[targetCurrency];
            } catch (error) {
                console.error('Error fetching exchange rate:', error);
                return null;
            }
        }

        document.getElementById('wet_kilo_price').disabled = true;
        document.getElementById('exchange_rate').disabled = true;

        document.getElementById('sale_currency').addEventListener('change', async function() {
            const selectedCurrency = this.value;
            if (selectedCurrency !== 'Choose...') {
                document.getElementById('wet_kilo_price').disabled = false;
                document.getElementById('exchange_rate').disabled = false;

                if (selectedCurrency !== 'PHP') {
                    const exchangeRate = await fetchExchangeRate(selectedCurrency,
                        'PHP');
                    if (exchangeRate) {
                        document.getElementById('exchange_rate').value =
                            exchangeRate;
                    } else {
                        document.getElementById('exchange_rate').value = '';
                    }
                } else {
                    document.getElementById('exchange_rate').value = '1';
                }
            } else {
                document.getElementById('wet_kilo_price').disabled = true;
                document.getElementById('exchange_rate').disabled = true;
            }
        });



        const formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        // Compute expenses
        function calculateTotalShippingExpenses() {
            const freight = parseFloat(document.getElementById('ship_exp_freight').value
                .replace(/,/g,
                    '')) || 0;
            const loading = parseFloat(document.getElementById('ship_exp_loading').value
                .replace(/,/g,
                    '')) || 0;
            const processing = parseFloat(document.getElementById('ship_exp_processing').value
                    .replace(/,/g,
                        '')) ||
                0;
            const trucking = parseFloat(document.getElementById('ship_exp_trucking').value
                .replace(/,/g,
                    '')) || 0;
            const cranage = parseFloat(document.getElementById('ship_exp_cranage').value
                .replace(/,/g,
                    '')) || 0;
            const misc = parseFloat(document.getElementById('ship_exp_misc').value.replace(/,/g,
                '')) || 0;


            const cuplump_cost = parseFloat(document.getElementById('cuplumps_total_cost').value
                .replace(
                    /,/g,
                    '')) || 0;
            document.getElementById('total_wet_cost').value = formatter.format(cuplump_cost);


            const total = freight + loading + processing + trucking + cranage + misc;
            document.getElementById('total_ship_exp').value = formatter.format(total);

            calculateNetGain();
        }

        const shippingInputs = document.querySelectorAll(
            '#ship_exp_freight, #ship_exp_loading, #ship_exp_processing, #ship_exp_trucking, #ship_exp_cranage, #ship_exp_misc'
        );
        shippingInputs.forEach(input => {
            input.addEventListener('input', calculateTotalShippingExpenses);
        });


        // Compute total sales
        function calculateTotalSales() {
            const totalWeight = parseFloat(document.getElementById('cuplumps_total_weight')
                .value.replace(
                    /,/g,
                    '')) || 0;
            const pricePerKilo = parseFloat(document.getElementById('wet_kilo_price').value) ||
                0;
            const exchangeRate = parseFloat(document.getElementById('exchange_rate').value) ||
                1;

            const totalSales = totalWeight * pricePerKilo * exchangeRate;
            document.getElementById('sales').value = formatter.format(totalSales);

            // payment details
            document.getElementById('payment_sales').value = formatter.format(totalSales);





            const cuplump_cost = parseFloat(document.getElementById('cuplumps_total_cost').value
                .replace(
                    /,/g,
                    '')) || 0;
            document.getElementById('total_wet_cost').value = formatter.format(cuplump_cost);

            calculateNetGain();
        }

        const salesInputs = document.querySelectorAll('#wet_kilo_price, #exchange_rate');
        salesInputs.forEach(input => {
            input.addEventListener('input', calculateTotalSales);
        });

        function calculateNetGain() {
            const totalSales = parseFloat(document.getElementById('sales').value.replace(/,/g,
                '')) || 0;
            const cuplumpCost = parseFloat(document.getElementById('total_wet_cost').value
                .replace(/,/g,
                    '')) || 0;
            const shippingExpenses = parseFloat(document.getElementById('total_ship_exp').value
                .replace(
                    /,/g,
                    '')) || 0;

            const netGain = totalSales - cuplumpCost - shippingExpenses;
            document.getElementById('net_gain').value = formatter.format(netGain);

            if (netGain < 0) {
                document.getElementById('net_gain').style.backgroundColor = 'lightcoral';
            } else {
                document.getElementById('net_gain').style.backgroundColor = 'lightgreen';
            }
        }

        function calculateBalance() {
            const paid_amount = parseFloat(document.getElementById('paid_amount').value.replace(
                /,/g,
                '')) || 0;
            const payment_sales = parseFloat(document.getElementById('payment_sales').value
                .replace(/,/g,
                    '')) || 0;

            const balance = payment_sales - paid_amount;


            document.getElementById('amount_unpaid').value = formatter.format(balance);
        }

        const amountPaidInputs = document.querySelectorAll('#paid_amount');
        amountPaidInputs.forEach(input => {
            input.addEventListener('input', calculateBalance);
        });




        $('.btnInventory').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            var sales_id = <?php echo $id ?>

            function fetch_data() {

                $.ajax({
                    url: "table/field-inventory.php",
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