<?php
include('include/header.php');
include "include/navbar.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id =  preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM sales_cuplump_record WHERE cuplump_sales_id  = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $sale_contract = isset($record['sale_contract']) ? $record['sale_contract'] : '';
        $purchase_contract = isset($record['purchase_contract']) ? $record['purchase_contract'] : '';
        $sale_type = isset($record['sale_type']) ? $record['sale_type'] : '';
        $transaction_date = isset($record['transaction_date']) ? $record['transaction_date'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';
        $remarks = isset($record['remarks']) ? $record['remarks'] : '';


        $sale_buyer = isset($record['buyer_name']) ? htmlspecialchars($record['buyer_name'], ENT_QUOTES, 'UTF-8') : '';
        $shipping_date = isset($record['shipping_date']) ? htmlspecialchars($record['shipping_date'], ENT_QUOTES, 'UTF-8') : '';
        $sale_source = isset($record['source']) ? htmlspecialchars($record['source'], ENT_QUOTES, 'UTF-8') : '';
        $sale_destination = isset($record['destination']) ? htmlspecialchars($record['destination'], ENT_QUOTES, 'UTF-8') : '';
        $contract_container_num = isset($record['contract_container_num']) ? htmlspecialchars($record['contract_container_num'], ENT_QUOTES, 'UTF-8') : '';
        $contract_quantity = isset($record['contract_quantity']) ? htmlspecialchars($record['contract_quantity'], ENT_QUOTES, 'UTF-8') : '';
        $sale_currency = isset($record['currency']) ? htmlspecialchars($record['currency'], ENT_QUOTES, 'UTF-8') : '';
        $contract_price = isset($record['contract_price']) ? htmlspecialchars($record['contract_price'], ENT_QUOTES, 'UTF-8') : '';
        $other_terms = isset($record['other_terms']) ? htmlspecialchars($record['other_terms'], ENT_QUOTES, 'UTF-8') : '';


        $total_sales = isset($record['total_sales']) ? htmlspecialchars($record['total_sales'], ENT_QUOTES, 'UTF-8') : '0';
        $tax_rate = isset($record['tax_rate']) ? htmlspecialchars($record['tax_rate'], ENT_QUOTES, 'UTF-8') : '1';
        $tax_amount = isset($record['tax_amount']) ? htmlspecialchars($record['tax_amount'], ENT_QUOTES, 'UTF-8') : '';

        echo "
            <script>
                $(document).ready(function() {
                    $('#sales_id').val('" . $id . "');
                    $('#sale_type').val('" . $sale_type . "');
                    $('#sale_contract').val('" . $sale_contract . "');
                    $('#purchase_contract').val('" . $purchase_contract . "');
                    $('#trans_date').val('" . $transaction_date . "');
                    $('#sale_buyer').val('" . $sale_buyer . "');
                    $('#shipping_date').val('" . $shipping_date . "');
                    $('#sale_source').val('" . $sale_source . "');
                    $('#sale_destination').val('" . $sale_destination . "');
                    $('#contract_contaier').val('" . $contract_container_num . "');
                    $('#contract_quantity').val('" . $contract_quantity . "');
     
                    $('#contract_price').val('" . $contract_price . "');
                    $('#other_terms').val('" . $other_terms . "');
                    $('#total_sale').val('" . number_format($total_sales, 2) . "');

                    $('#tax_rate').val('" . number_format($tax_rate, 2) . "');
                    $('#tax_amount').val('" . number_format($tax_amount, 2) . "');



                    $('#sale_currency').val('" . $sale_currency . "');


                    var selectedCurrency = $('#sale_currency').val();

                    // Update the span tag's content
                    $('#currency_selected_sales').text(selectedCurrency);
                    $('#currency_selected_paid').text(selectedCurrency);
                    $('#currency_selected_balance').text(selectedCurrency);
                    $('#currency_selected_price').text(selectedCurrency);
                    

                    

                });
                </script>
            ";
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .trans-btn {
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 14px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    }

    .trans-btn:hover {
        background-color: #2c3e50;
        box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
        color: #fff;
        transform: translateY(-7px);
    }

    /* For the font awesome icons */
    .fas {
        margin-right: 10px;
    }

    .payment-table thead {
        font-weight: normal;
        background-color: red !important;

    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <br>
            <h1 class="page-title" style="text-align: center;"><B>
                    <font color="#0C0070"> RUBBER CUPLUMP </font>
                    <font color="#046D56"> SALE </font>
                </b></h1>
            <hr>
            <div class="row">
                <div class="col-8">
                    <button type="button" class="btn trans-btn btn-secondary btnReturn">
                        <span class="fas fa-arrow-left"></span> Return
                    </button>
                    <button type="button" class="btn trans-btn btn-danger btnVoid"> <span class="fas fa-times"></span>
                        Void</button>
                    <button type="button" class="btn trans-btn btn-warning btnDraft"><span class="fas fa-info-circle"></span> Save as Draft</button>
                    <button type="button" class="btn trans-btn btn-primary confirmSales" id="confirmSales"><span class="fas fa-check"></span>
                        Confirm
                        Sales</button>
                </div>
                <div class="col"></div>
                <div class="col">

                    <button type="button" class="btn btn-dark btnPrint"><span class="fas fa-print"></span> Print
                    </button>

                </div>
            </div>
            <br>
            <form id="salesForm" action="" method="post">
                <div id='print_content'>
                    <div class="card">
                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="card-body">
                            <h4>Sale Contract</h4>
                            <hr size="10" noshade />

                            <div class="row">
                                <div class="col-1">
                                    <label style='font-size:15px' class="col-md-12"> Sales ID
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sales_id' id='sales_id' readonly autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_contract' id='sale_contract' autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='purchase_contract' id='purchase_contract' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Sale Type</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_type" name="sale_type" required>
                                            <option selected disabled>Select...</option>
                                            <option value="EXPORT">Export</option>
                                            <option value="LOCAL">Local</option>
                                        </select>
                                    </div>
                                </div>





                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Transaction Date </label>
                                    <div class="col-md-12">
                                        <input type="date" class='form-control' id="trans_date" name="trans_date" required>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_buyer' id='sale_buyer' tabindex="7" autocomplete='off' style="width: 100px;" required />
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
                                        <input type="text" class="form-control" name='sale_source' id='sale_source' tabindex="7" autocomplete='off' style="width: 100px;" required />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_destination' id='sale_destination' tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">No. of Containers (Contract)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='contract_contaier' id='contract_contaier' tabindex="7" autocomplete='off' style="width: 100px;" required />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Kilo Quantity (e.g 21,000)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='contract_quantity' id='contract_quantity' tabindex="7" autocomplete='off' style="width: 100px;" />
                                        <span class="input-group-text"> kg</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Currency</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="sale_currency" name="sale_currency" style="width: 100px;" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="PHP">PHP ₱</option>
                                            <option value="USD">USD $</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Price per Kilo</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id='currency_selected_price'></span>
                                        <input type="number" class="form-control contract_price" name='contract_price' id='contract_price' required>
                                    </div>
                                </div>
                                <div class="col-5">
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
                                    <h4>Cuplump Volume and Costing</h4>
                                    <button type='button' id='btnContainer' class="btn btn-warning btnContainer">
                                        <i class="fas fa-box"></i> Select Container
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div id='container_selected'></div>


                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">No. of Containers (Actual)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='number_container' id='number_container' style="width: 100px;" readonly />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Cuplump Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='total_cuplump_weight' id='total_cuplump_weight' style="width: 100px;" readonly />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Overall Average Cost per
                                        Kilo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">≈ ₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='overall_ave_kiloCost' id='overall_ave_kiloCost' style="width: 100px;" readonly />
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
                                        <input type="text" class="form-control" name="sales_proceeds" id="sales_proceeds" readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px" class="col-md-12">Tax Rate</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="tax_rate" id="tax_rate" style="width: 100px;" />
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px" class="col-md-12">Withholding Tax Amount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name="tax_amount" readonly id="tax_amount" style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Cuplump Cost</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name='total_cuplump_cost' id='total_cuplump_cost' style="width: 100px;" readonly />
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
                                <div class="col-4">
                                    <!-- SUM OF TOTAL BALE AND PRODUCTION COST AND TOTAL SHIPPING EXPENSE -->
                                    <label style="font-size:15px" class="col-md-12">OVERALL COST</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name="over_all_cost" id="over_all_cost" readonly style="width: 100px;" />
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
                                        <input type="text" class="form-control" name="gross_profit" id="gross_profit" style='font-size:20px' readonly style="width: 100px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                    </div>
                    <br>
                </div>
            </form>
        </div>

    </div>

</body>

</html>

<?php include "sales_modal/bale_sales.php"; ?>



<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Sales Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete the sales record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmButton">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Draft Modal -->
<div class="modal fade" id="draftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-save me-2"></i>Store Sales Draft
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="fas fa-question-circle fa-4x mb-3 animate__animated animate__wobble"></i>
                </p>
                <p class="text-center">
                    Are you sure you want to save the current state as a draft?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-warning saveDraftBtn" id="saveDraftBtn">
                    <i class="fas fa-check me-2"></i>Yes, Save Draft
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal -->
<div class="modal" tabindex="-1" role="dialog" id="confirmReturnModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to return?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmReturn">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>



<script>
    // Function to change the background color of the input field
    function changeGrossProfitColor() {
        // Get the value of gross profit input, remove commas and convert to a number
        var gross_profit_value = Number($("#gross_profit").val().replace(/,/g, ""));

        // Change the background color of the input field based on the value
        if (gross_profit_value <= 0) {
            $("#gross_profit").css('backgroundColor', 'lightcoral');
        } else if (gross_profit_value >= 0) {
            $("#gross_profit").css('backgroundColor', 'lightgreen');
        }
    }
    // Call the function when the page loads
    changeGrossProfitColor();

    function fetch_container() {
        var sales_id = <?php echo $id ?>;

        $.ajax({
            url: "table/cuplump_sales_container.php",
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
            url: "table/cuplump_sales_payment.php",
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




    $(document).on('click', '#confirmButton', function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Set the form action to the desired URL
        $('#salesForm').attr('action', 'function/cuplump_sale/sales.confirm.php');

        // Submit the form asynchronously using AJAX
        $.ajax({
            type: "POST",
            url: $('#salesForm').attr('action'),
            data: $('#salesForm').serialize(),
            success: function(response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Sale transaction completed!',
                    });

                    // Set all inputs to readonly
                    $('#salesForm input').prop('readonly', true);
                    $('#salesForm textarea').prop('readonly', true);
                    $('#salesForm select').prop('disabled', true); //use 'disabled' for select elements
                    // Disable all buttons inside the form
                    // Temporarily hide the buttons
                    $("#print_content button").hide();
                    $('#confirmModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle the error response
                // Display SweetAlert error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Form submission failed!',
                });
            }
        });
    });



    $(document).on('click', '#saveDraftBtn', function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Set the form action to the desired URL
        $('#salesForm').attr('action', 'function/cuplump_sale/sales.draft.php');

        // Submit the form asynchronously using AJAX
        $.ajax({
            type: "POST",
            url: $('#salesForm').attr('action'),
            data: $('#salesForm').serialize(),
            success: function(response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Success',
                        text: 'Sale Transaction saved as draft!',
                    });

                    // Set all inputs to readonly
                    $('#salesForm input').prop('readonly', true);
                    $('#salesForm textarea').prop('readonly', true);
                    $('#salesForm select').prop('disabled', true); //use 'disabled' for select elements
                    // Disable all buttons inside the form
                    // Temporarily hide the buttons
                    $("#print_content button").hide();
                    $('#draftModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle the error response
                // Display SweetAlert error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Form submission failed!',
                });
            }
        });
    });



    $(document).on('click', '.confirmSales, .btnDraft, .btnVoid', function(e) {
        // Check if 'sale_buyer' input is readonly
        if ($('#sale_buyer').prop('readonly')) {
            // If readonly, show alert and return
            Swal.fire({
                icon: 'warning',
                title: 'Form Completed',
                text: 'This action is not allowed after the form is completed.',
            });
            return;
        }

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var sales_id = <?php echo  $id ?>;

        if ($(this).hasClass('confirmSales')) {
            $('#confirmModal').modal('show');
        } else if ($(this).hasClass('btnDraft')) {
            $('#draftModal').modal('show');
        }
        // add similar if conditions for other buttons if needed
    });




    //RETURN JS
    $('.btnReturn').on('click', function() {
        $('#confirmReturnModal').modal('show');
    });
    $('#confirmReturn').on('click', function() {
        window.location.href = "cuplump_sale_record.php";
    })

    $('.btnContainer').on('click', function() {

        // TABLE TO DISPLAY THE SELECTED CONTAINER
        function fetch_container_list() {
            var sales_id = <?php echo $id ?>;

            $.ajax({
                url: "table/cuplump_sales_container_selection.php",
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
        $("#currency_selected_sales").text(selectedCurrency);
        $("#currency_selected_paid").text(selectedCurrency);
        $("#currency_selected_balance").text(selectedCurrency);
        $("#currency_selected_price").text(selectedCurrency);


        // Update currency symbol in each payment row
        $(".payment-currency-symbol").text(selectedCurrency);
    });


    $(document).on("keyup", "#contract_price, #total_cuplump_weight, #tax_rate", function() {
        calculateSalesTotals();
    });

    
function calculateSalesTotals() {
    var contract_price = parseFloat($("#contract_price").val().replace(/,/g, "")) || 0;
    var total_bale_weight = parseFloat($("#total_cuplump_weight").val().replace(/,/g, "")) || 0;
    var sales_proceeds = parseFloat($("#sales_proceeds").val().replace(/,/g, "")) || 0;
    var tax_rate = parseFloat($("#tax_rate").val().replace(/,/g, "")) || 0;

    var total_sale = total_bale_weight * contract_price;
    var tax_amount = sales_proceeds * (tax_rate / 100); // computed tax amount, tax rate should be in percentage.
    var gross_profit = sales_proceeds - tax_amount; // Compute gross profit based on the current sales proceeds and tax amount

    $("#total_sale").val(total_sale.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    // Update the tax amount field
    $("#tax_amount").val(tax_amount.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    $("#gross_profit").val(gross_profit.toLocaleString('en-US', {
        minimumFractionDigits: 2
    }));

    changeGrossProfitColor();
}


    $(document).on('click', '.btnPrint', function(e) {
        // Check if 'sale_buyer' input is readonly
        if (!$('#sale_buyer').prop('readonly')) {
            // If not readonly, show alert and return
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Form',
                text: 'Please complete the form before printing.',
            });
            return;
        }

        console.log('hello');

        // Temporarily hide the buttons
        $("#print_content button").hide();

        html2canvas(document.querySelector("#print_content")).then(canvas => {
            var myImage = canvas.toDataURL("image/png");
            var tWindow = window.open("");
            $(tWindow.document.body)
                .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                .ready(function() {
                    tWindow.focus();
                    tWindow.print();
                });

            // Show the buttons again
            $("#print_content button").show();
        });
    });
</script>