<?php
include('include/header.php');
include "include/navbar.php";

if (!isset($_GET['id'])) {
    exit('Invalid request');
}

// Validate and sanitize input using prepared statement
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
    exit('Invalid ID format');
}

try {
    // Prepare the statement
    $stmt = $con->prepare("SELECT 
        bales_sales_id,
        sale_contract,
        purchase_contract,
        sale_type,
        contract_quality,
        transaction_date,
        recorded_by,
        remarks,
        contract_kiloPerBale,
        buyer_name,
        shipping_date,
        source,
        destination,
        contract_container_num,
        contract_quantity,
        currency,
        contract_price,
        other_terms,
        total_sales,
        tax_rate,
        tax_amount
    FROM bales_sales_record 
    WHERE bales_sales_id = ? 
    LIMIT 1");

    if (!$stmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt->close();
        exit('Record not found');
    }

    $record = $result->fetch_assoc();
    $stmt->close();

    // Prepare data for JSON
    $formData = [
        'sales_id' => $id,
        'sale_type' => $record['sale_type'] ?? '',
        'sale_contract' => $record['sale_contract'] ?? '',
        'purchase_contract' => $record['purchase_contract'] ?? '',
        'contract_quality' => $record['contract_quality'] ?? '',
        'trans_date' => $record['transaction_date'] ?? '',
        'sale_buyer' => htmlspecialchars($record['buyer_name'] ?? '', ENT_QUOTES, 'UTF-8'),
        'shipping_date' => htmlspecialchars($record['shipping_date'] ?? '', ENT_QUOTES, 'UTF-8'),
        'sale_source' => htmlspecialchars($record['source'] ?? '', ENT_QUOTES, 'UTF-8'),
        'sale_destination' => htmlspecialchars($record['destination'] ?? '', ENT_QUOTES, 'UTF-8'),
        'contract_contaier' => htmlspecialchars($record['contract_container_num'] ?? '', ENT_QUOTES, 'UTF-8'),
        'contract_quantity' => htmlspecialchars($record['contract_quantity'] ?? '', ENT_QUOTES, 'UTF-8'),
        'contract_kilo' => $record['contract_kiloPerBale'] ?? '',
        'contract_price' => htmlspecialchars($record['contract_price'] ?? '', ENT_QUOTES, 'UTF-8'),
        'other_terms' => htmlspecialchars($record['other_terms'] ?? '', ENT_QUOTES, 'UTF-8'),
        'total_sale' => number_format((float)($record['total_sales'] ?? 0), 2),
        'tax_rate' => number_format((float)($record['tax_rate'] ?? 1), 2),
        'tax_amount' => number_format((float)($record['tax_amount'] ?? 0), 2),
        'sale_currency' => htmlspecialchars($record['currency'] ?? '', ENT_QUOTES, 'UTF-8')
    ];

    // Output JavaScript with single DOM ready callback
    ?>
    <script>
    $(document).ready(function() {
        // Use const for data that won't change
        const formData = <?php echo json_encode($formData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
        
        // Batch DOM operations
        const updates = {
            // Form field updates
            '#sales_id': formData.sales_id,
            '#sale_type': formData.sale_type,
            '#sale_contract': formData.sale_contract,
            '#purchase_contract': formData.purchase_contract,
            '#contract_quality': formData.contract_quality,
            '#trans_date': formData.trans_date,
            '#sale_buyer': formData.sale_buyer,
            '#shipping_date': formData.shipping_date,
            '#sale_source': formData.sale_source,
            '#sale_destination': formData.sale_destination,
            '#contract_contaier': formData.contract_contaier,
            '#contract_quantity': formData.contract_quantity,
            '#contract_kilo': formData.contract_kilo,
            '#contract_price': formData.contract_price,
            '#other_terms': formData.other_terms,
            '#total_sale': formData.total_sale,
            '#tax_rate': formData.tax_rate,
            '#tax_amount': formData.tax_amount,
            '#sale_currency': formData.sale_currency
        };

        // Batch update form fields
        Object.entries(updates).forEach(([selector, value]) => {
            $(selector).val(value);
        });

        // Update currency displays
        const currencySelectors = [
            '#currency_selected_sales',
            '#currency_selected_paid',
            '#currency_selected_balance',
            '#currency_selected_price'
        ];
        
        currencySelectors.forEach(selector => {
            $(selector).text(formData.sale_currency);
        });
    });
    </script>
    <?php

} catch (Exception $e) {
    // Log error and show generic message
    error_log("Error in bales_sales_record.php: " . $e->getMessage());
    exit('An error occurred while processing your request');
}
?>

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

/* CSS for loading overlay */
/* CSS for loading overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    /* Semi-transparent black background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    font-size: 24px;
    /* Adjust the size of the spinner */
    color: #ffffff;
    /* Text color (white) */
    padding: 20px;
    /* Add some padding around the spinner */
    background-color: #333;
    /* Background color for the spinner */
    border-radius: 8px;
    /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    /* Box shadow for a subtle effect */
}
</style>

<link rel="stylesheet" href="css/bale_sales.css">

<body>

    <!-- Loading overlay -->
    <div id="loadingOverlay" class="overlay">
        <div class="loading-spinner">
            <i class="fas fa-spinner fa-spin"></i> Loading...
        </div>
    </div>


    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <br>
            <h1 class="page-title" style="text-align: center;"><B>
                    <font color="#0C0070"> RUBBER BALE </font>
                    <font color="#046D56"> SALE </font>
                </b></h1>
            <hr>
            <div class="row">
                <div class="col-8">
                    <a href="bale_sale_record.php" type="button" class="btn trans-btn btn-secondary ">
                        <span class="fas fa-arrow-left"></span> Return
                    </a>
                    <button type="button" class="btn trans-btn btn-danger btnVoid"> <span class="fas fa-times"></span>
                        Void</button>
                    <button type="button" class="btn trans-btn btn-warning btnDraft"><span
                            class="fas fa-info-circle"></span> Save as Draft</button>
                    <button type="button" class="btn trans-btn btn-primary confirmSales" id="confirmSales"><span
                            class="fas fa-check"></span>
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
                                        <input type="text" class="form-control" name='sales_id' id='sales_id' readonly
                                            autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_contract' id='sale_contract'
                                            autocomplete='off' style="width: 100px;">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='purchase_contract'
                                            id='purchase_contract' style="width: 100px;" />
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

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Quality</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="contract_quality" id="contract_quality"
                                            required>
                                            <option selected disabled>Select...</option>
                                            <option value="5L">5L</option>
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
                                        <select class="form-select" name="contract_kilo" id="contract_kilo" required>
                                            <option selected disabled>Select...</option>
                                            <option value="35">35.00 kg</option>
                                            <option value="33.33">33.33 kg</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Transaction Date </label>
                                    <div class="col-md-12">
                                        <input type="date" class='form-control' id="trans_date" name="trans_date"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_buyer' id='sale_buyer'
                                            tabindex="7" autocomplete='off' style="width: 100px;" required />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='shipping_date' id='shipping_date'
                                            tabindex="7" autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>

                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_source' id='sale_source'
                                            tabindex="7" autocomplete='off' style="width: 100px;" required />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='sale_destination'
                                            id='sale_destination' tabindex="7" autocomplete='off'
                                            style="width: 100px;" />
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">No. of Containers</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='contract_contaier'
                                            id='contract_contaier' tabindex="7" autocomplete='off' style="width: 100px;"
                                            required />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label style='font-size:15px' class="col-md-12">Kilo Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name='contract_quantity'
                                            id='contract_quantity' tabindex="7" autocomplete='off'
                                            style="width: 100px;" />
                                        <span class="input-group-text"> kg</span>
                                    </div>
                                </div>

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
                                        <span class="input-group-text" id='currency_selected_price'></span>
                                        <input type="number" class="form-control contract_price" name='contract_price'
                                            id='contract_price' required>
                                    </div>
                                </div>
                                <div class="col-4">
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
                                        <input type="text" class="form-control" name='total_sale' id='total_sale'
                                            readonly autocomplete='off' style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">AMOUNT PAID</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id='currency_selected_paid'></span>
                                        <input type="text" class="form-control" name='amount_unpaid' id='amount_unpaid'
                                            readonly autocomplete='off' style="width: 100px;" />
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
                                        <input type="text" class="form-control" name="sales_proceeds"
                                            id="sales_proceeds" readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px" class="col-md-12">Tax Rate</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="tax_rate" id="tax_rate"
                                            style="width: 100px;" />
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px" class="col-md-12">Withholding Tax Amount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name="tax_amount" readonly
                                            id="tax_amount" style="width: 100px;" />
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
                                        <input type="text" class="form-control" name="over_all_cost" id="over_all_cost"
                                            readonly style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Bale Cost</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name='total_bale_cost'
                                            id='total_bale_cost' style="width: 100px;" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Total Milling Cost</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" name='total_milling_cost'
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
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <!-- DIFFERENCE SALE PROCEEDS AND OVERALL COST -->
                                    <label style="font-size:15px" class="col-md-12">GROSS PROFIT/LOSS</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style='font-size:20px'>₱</span>
                                        </div>
                                        <input type="text" class="form-control" name="gross_profit" id="gross_profit"
                                            style='font-size:20px' readonly style="width: 100px;" />
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
<script src="js/compute_bale_sales.js"></script>



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
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
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
// Run the functions when the window loads
window.onload = function() {
    computeGrossSales();
    changeGrossProfitColor();
    computeSalesProceeds();
}
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
            success: function (data) {
                $('#payment_list_table').html(data);
            }
        });
    }
    fetch_payment();


$('#loadingOverlay').hide();

$(document).on('click', '#confirmButton', function(e) {
    // Prevent the default form submission
    e.preventDefault();

    // Set the form action to the desired URL
    $('#salesForm').attr('action', 'function/sales/sales.confirm.php');
    // Show the loading overlay
    $('#loadingOverlay').show();
    // Submit the form asynchronously using AJAX
    $.ajax({
        type: "POST",
        url: $('#salesForm').attr('action'),
        data: $('#salesForm').serialize(),
        success: function(response) {
            if (response.trim() === 'success') {
                // Hide the loading overlay when the AJAX request is complete
                $('#loadingOverlay').hide();
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
            // Hide the loading overlay when the AJAX request is error
            $('#loadingOverlay').hide();


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
    $('#salesForm').attr('action', 'function/sales/sales.draft.php');

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

    var sales_id = <?php echo $id ?>;

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
    window.location.href = "bale_sale_record.php";
})
$('.btnContainer').on('click', function() {
    var sales_id = <?php echo intval($id); ?>;

    $.ajax({
        url: "table/bales_sales_container_selection.php",
        method: "POST",
        data: {
            sales_id: sales_id
        },
        success: function(data) {
            $('#container_selection_modal').html(data);
            $('#containerListModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Failed to load container list:", error);
            alert("Failed to load container list. Please try again.");
        }
    });
});

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