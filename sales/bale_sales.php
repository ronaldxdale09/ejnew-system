<?php
include('include/header.php');
include "include/navbar.php";


$id = '';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id']);
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/record-tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">
                    <h2 class="page-title"><B>
                            <font color="#0C0070"> RUBBER BALE </font>
                            <font color="#046D56"> SALE </font>
                        </b></h2>
                    <?php


                    $id = '';
                    if (isset($_GET['id'])) {
                        $id = filter_var($_GET['id']);
                    }


                    ?>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary confirmSales" id="someButton">Confirm Sales</button>
                            <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                <span class="fa fa-print"></span> Print Receipt </button>
                            <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                <span class="fa fa-print"></span> Print Voucher </button>

                        </div>

                    </div>
                    <br>   <br>

                    <div class="card">
                        <div class="card-body">
                            <h4>Sale Contract</h4>
                            <hr size="10" noshade/>

                            <div class="row">
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12"> Sales ID
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sales_id' id='sales_id' value='' readonly autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='en_bale_contract' id='en_bale_contract' value='' autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='buyer_bale_contract' id='buyer_bale_contract' value='' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Sale Type</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_type" name="sale_type" style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="EXPORT">Dry Export</option>
                                            <option value="LOCAL">Bale Local</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Quality</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="quality" name="quality" style="width: 100px;">
                                            <option selected>Choose...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">Transaction Date </label>
                                    <div class="col-md-12">
                                        <input type="date" class='form-control' id="bale_sale_date" value="<?php echo $today; ?>" name="bale_sale_date">
                                    </div>
                                </div>
                            </div>
                            <hr size="10" noshade/>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='shipping_date' value='' id='shipping_date' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                          
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_destination' id='sale_destination' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_destination' id='sale_destination' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Containers</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='containers' id='containers' value='' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='quantity' value='' id='quantity' tabindex="7" autocomplete='off' style="width: 100px;" />
                                        <span class="input-group-text"> kg</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_currency" name="sale_currency" style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="bales_local">PHP ₱</option>
                                            <option value="bales_export">USD $</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Price</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='price' value='' id='price'>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label style='font-size:15px' class="col-md-12">Other Terms
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='other_terms' value='' id='other_terms'>
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
                                        <i class="fas fa-box"></i> Select Inventory
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div id='container_selected'></div>

                            <hr>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">No. of Containers</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='price_per_kilo' id='price_per_kilo' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total No. of Bales</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='price_per_kilo' id='price_per_kilo' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Bale Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='price_per_kilo' id='price_per_kilo' style="width: 100px;" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Bale and Production Cost</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='peso_price' id='peso_price' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Shipping Expense</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='peso_price' id='peso_price' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Overall Average Cost per Kilo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='peso_price' id='peso_price' style="width: 100px;" readonly />
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
                                    <button id="printButton" class="btn btn-warning btnInventory">
                                        <i class="fas fa-money"></i> Add Payment
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">TOTAL SALES</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-2">
                                    <label style='font-size:15px' class="col-md-12">Date of Payment </label>
                                    <div class="col-md-12">
                                        <input type="date" class='form-control' id="pay_date" value="<?php echo $today; ?>" name="pay_date">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label style='font-size:15px' class="col-md-12">Details</label>
                                    <div class="input-group mb-3">

                                        <input type="text" class="form-control" name='pay_details' id='pay_details' autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Amount Paid</label>
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <!-- <span class="input-group-text">symbol here</span> -->
                                        </div>
                                        <input type="text" class="form-control" name='paid_amount' id='paid_amount' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col-1">
                                    <label style='font-size:15px' class="col-md-12">Rate</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='paid_amount' id='paid_amount' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">Peso Equivalent</label>
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input readonly type="text" class="form-control" name='paid_amount' id='paid_amount' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <!-- SUM OF ALL PESOS EQUIVALENT AMOUNT PAID -->
                                    <label style='font-size:15px' class="col-md-12">SALE PROCEEDS</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='payment_sales' id='payment_sales' readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                    <label style='font-size:15px' class="col-md-12">OVERALL COST</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='payment_sales' id='payment_sales' readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                    <label style='font-size:15px' class="col-md-12">GROSS PROFIT/LOSS</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='payment_sales' id='payment_sales' readonly style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include "sales_modal/bale_sales.php"; ?>
<script>
    $(document).ready(function() {





        $('.btnContainer').on('click', function() {

            // TABLE TO DISPLAY THE SELECTED CONTAINER
            function fetch_container_list() {

                $.ajax({
                    url: "table/bales_container_selection_sales.php",
                    method: "POST",
                    success: function(data) {
                        $('#container_selection_modal').html(data);
                    }
                });
            }
            fetch_container_list();

            $('#containerListModal').modal('show');

        });



    });
</script>