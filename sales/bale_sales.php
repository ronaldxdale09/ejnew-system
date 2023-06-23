<?php
include('include/header.php');
include "include/navbar.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id =  preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM bales_sales_record WHERE bales_sales_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $sale_contract = isset($record['sale_contract']) ? $record['sale_contract'] : '';
        $buyer_contract = isset($record['buyer_contract']) ? $record['buyer_contract'] : '';
        $sale_type = isset($record['sale_type']) ? $record['sale_type'] : '';
        $contract_quality = isset($record['contract_quality']) ? $record['contract_quality'] : '';
        $transaction_date = isset($record['transaction_date']) ? $record['transaction_date'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';
        $remarks = isset($record['remarks']) ? $record['remarks'] : '';

        echo "
            <script>
                $(document).ready(function() {
                    $('#sales_id').val('" . $id . "');
                    $('#sale_type').val('" . $sale_type . "');
                    $('#sale_contract').val('" . $sale_contract . "');
                    $('#buyer_contract').val('" . $buyer_contract . "');
                    $('#contract_quality').val('" . $contract_quality . "');
                    $('#trans_date').val('" . $transaction_date . "');
                  
                });
                </script>
            ";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">
                    <h2 class="page-title"><B>
                            <font color="#0C0070"> RUBBER BALE </font>
                            <font color="#046D56"> SALE </font>
                        </b></h2>

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary confirmSales" id="someButton">Confirm Sales</button>
                            <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                <span class="fa fa-print"></span> Print Receipt </button>
                            <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                <span class="fa fa-print"></span> Print Voucher </button>

                        </div>

                    </div>
                    <br> <br>

                    <div class="card">
                        <div class="card-body">
                            <h4>Sale Contract</h4>
                            <hr size="10" noshade />

                            <div class="row">
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12"> Sales ID
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sales_id' id='sales_id' readonly autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_contract' id='sale_contract' autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='buyer_contract' id='buyer_contract' style="width: 100px;" />
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
                                        <select class="form-select" name="contract_quality" id="contract_quality" tabindex="7" required>
                                            <option disabled selected>Select quality...</option>
                                            <option value="5L">5L</option>
                                            <option value="SPR5">SPR-5</option>
                                            <option value="SPR10">SPR-10</option>
                                            <option value="SPR20">SPR-20</option>
                                            <option value="Offcolor">Off Color</option>
                                        </select>
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
                                        <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='shipping_date' id='shipping_date' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_source' id='sale_source' tabindex="7" autocomplete='off' style="width: 100px;" />
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
                                        <input type="text" class="form-control" name='containers' id='containers' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='contract_quantity' id='contract_quantity' tabindex="7" autocomplete='off' style="width: 100px;" />
                                        <span class="input-group-text"> kg</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_currency" name="sale_currency" style="width: 100px;">
                                            <option selected>Choose...</option>
                                            <option value="₱">PHP ₱</option>
                                            <option value="$">USD $</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control contract_price" name='contract_price' id='contract_price'>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label style='font-size:15px' class="col-md-12">Other Terms
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='other_terms' id='other_terms'>
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


                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">No. of Containers</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='number_container' id='number_container' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total No. of Bales</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='total_num_bales' id='total_num_bales' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Bale Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='total_bale_weight' id='total_bale_weight' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Overall Average Cost per Kilo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='overall_ave_kiloCost' id='overall_ave_kiloCost' style="width: 100px;" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Bale Cost</label>
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name='total_bale_cost' id='total_bale_cost' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Production Cost</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='total_production_cost' id='total_production_cost' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Shipping Expense</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='total_ship_exp' id='total_ship_exp' style="width: 100px;" readonly />
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
                                        <input type="text" class="form-control" name='total_sale' id='total_sale' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id='currency_selected_paid'></span>
                                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">UNPAID BALANCE</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id='currency_selected_balance'></span>
                                        <input type="text" class="form-control" name='unpaid_balance' id='unpaid_balance' readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div id='payment_list_table'> </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <!-- SUM OF ALL PESOS EQUIVALENT AMOUNT PAID -->
                                    <label style="font-size:15px" class="col-md-12">SALE PROCEEDS</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name="sales_proceeds" id="sales_proceeds" readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                    <label style="font-size:15px" class="col-md-12">OVERALL COST</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name="over_all_cost" id="over_all_cost" readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                    <label style="font-size:15px" class="col-md-12">GROSS PROFIT/LOSS</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name="gross_profit" id="gross_profit" readonly style="width: 100px;" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>


</body>

</html>

<?php include "sales_modal/bale_sales.php"; ?>
<script>
    function fetch_container() {
        var sales_id = <?php echo $id ?>;

        $.ajax({
            url: "table/bales_sales_container.php",
            method: "POST",
            data: {
                sales_id: sales_id,
            },
            success: function(data) {
                $('#container_selected').html(data);
            }
        });
    }
    fetch_container();


    function fetch_payment() {
        var sales_id = <?php echo $id ?>;

        $.ajax({
            url: "table/bales_sales_payment.php",
            method: "POST",
            data: {
                sales_id: sales_id,
            },
            success: function(data) {
                $('#payment_list_table').html(data);
            }
        });
    }
    fetch_payment();


    $('.btnContainer').on('click', function() {

        // TABLE TO DISPLAY THE SELECTED CONTAINER
        function fetch_container_list() {
            var sales_id = <?php echo $id ?>;

            $.ajax({
                url: "table/bales_sales_container_selection.php",
                method: "POST",
                data: {
                    sales_id: sales_id,
                },
                success: function(data) {
                    $('#container_selection_modal').html(data);
                }
            });
        }
        fetch_container_list();

        $('#containerListModal').modal('show');

    });

    $("#sale_currency").change(function() {
        // Get selected value
        var selectedCurrency = $(this).val();

        // Update the span tag's content
        $("#currency_selected_sales").text(selectedCurrency);
        $("#currency_selected_paid").text(selectedCurrency);
        $("#currency_selected_balance").text(selectedCurrency);
    });


    $(document).on("keyup", "#contract_price, #total_bale_weight", function() {
        var contract_price = parseFloat($("#contract_price").val().replace(/,/g, "")) || 0;
        var total_bale_weight = parseFloat($("#total_bale_weight").val().replace(/,/g, "")) || 0;
        var total_sale = total_bale_weight * contract_price;
        $("#total_sale").val(total_sale.toLocaleString('en-US', {
            minimumFractionDigits: 2
        }));

    });
</script>