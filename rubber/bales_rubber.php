<?php
include "include/header.php";
include "include/navbar.php";

if (!isset($_GET['id'])) {
    header('Location: bales_purchase_record.php');
    exit;
}

$trans_id = (int) preg_replace('~\D~', '', (string) $_GET['id']);
if ($trans_id <= 0) {
    header('Location: bales_purchase_record.php');
    exit;
}

$locEsc = mysqli_real_escape_string($con, $loc);
$record = null;
$transactionStatus = 'ONGOING';

$sql = "SELECT * FROM bales_transaction WHERE id = $trans_id AND loc = '$locEsc' LIMIT 1";
$result = $con->query($sql);

if (!$result || $result->num_rows === 0) {
    header('Location: bales_purchase_record.php');
    exit;
}

$record = $result->fetch_assoc();
$sellerName = trim((string) ($record['seller'] ?? ''));
$totalAmount = (float) ($record['total_amount'] ?? 0);
$isCompleted = $sellerName !== '' && $totalAmount > 0;
$transactionStatus = $isCompleted ? 'COMPLETED' : 'ONGOING';

$_SESSION['transaction'] = $transactionStatus;

$currentContract = trim((string) ($record['contract'] ?? 'SPOT'));
$contractQuery = "SELECT * FROM rubber_contract
    WHERE type='BALES' AND loc='$locEsc' AND (status='PENDING' OR status='UPDATED')
    ORDER BY contract_no ASC";
$c_result = mysqli_query($con, $contractQuery);
$contractList = "";
$contractNos = [];
while ($arr = mysqli_fetch_array($c_result)) {
    $contractNos[] = $arr['contract_no'];
    $contractList .= '<option value="' . htmlspecialchars($arr['contract_no'], ENT_QUOTES, 'UTF-8') . '">[ '
        . htmlspecialchars($arr['contract_no'], ENT_QUOTES, 'UTF-8') . ' ]  '
        . htmlspecialchars($arr['seller'], ENT_QUOTES, 'UTF-8') . '</option>';
}

if ($isCompleted && $currentContract !== '' && strcasecmp($currentContract, 'SPOT') !== 0 && !in_array($currentContract, $contractNos, true)) {
    $curEsc = mysqli_real_escape_string($con, $currentContract);
    $curResult = mysqli_query($con, "SELECT contract_no, seller FROM rubber_contract WHERE contract_no='$curEsc' AND type='BALES' AND loc='$locEsc' LIMIT 1");
    if ($curResult && ($cur = mysqli_fetch_assoc($curResult))) {
        $contractList .= '<option value="' . htmlspecialchars($cur['contract_no'], ENT_QUOTES, 'UTF-8') . '">[ '
            . htmlspecialchars($cur['contract_no'], ENT_QUOTES, 'UTF-8') . ' ]  '
            . htmlspecialchars($cur['seller'], ENT_QUOTES, 'UTF-8') . ' (current)</option>';
    }
}

$balesFormInit = [
    'invoice' => (string) $trans_id,
    'date' => (string) ($record['date'] ?? date('Y-m-d')),
    'contract' => (string) ($record['contract'] ?? 'SPOT'),
    'seller' => $sellerName,
    'lot_code' => (string) ($record['lot_code'] ?? ''),
    'production_id' => (string) ($record['production_id'] ?? ''),
    'address' => (string) ($record['address'] ?? ''),
    'entry' => (string) ($record['entry'] ?? ''),
    'total_net_weight' => (string) ($record['total_net_weight'] ?? ''),
    'price_1' => (string) ($record['price_1'] ?? ''),
    'first_total' => (string) ($record['first_total'] ?? ''),
    'price_2' => (string) ($record['price_2'] ?? ''),
    'second_total' => (string) ($record['second_total'] ?? ''),
    'total_amount' => (string) ($record['total_amount'] ?? ''),
    'cash_advance' => (string) ($record['less'] ?? ''),
    'amount_paid' => (string) ($record['amount_paid'] ?? ''),
    'amount_words' => (string) ($record['words_amount'] ?? ''),
    'drc' => (string) ($record['drc'] ?? ''),
    'status' => $transactionStatus,
    'is_edit' => $isCompleted,
    'original' => [
        'seller' => $sellerName,
        'contract' => $currentContract,
        'less' => (string) ($record['less'] ?? ''),
        'amount_paid' => (string) ($record['amount_paid'] ?? ''),
        'total_net_weight' => (string) ($record['total_net_weight'] ?? ''),
        'production_id' => (string) ($record['production_id'] ?? ''),
    ],
];

$sellerQuery = "SELECT name FROM rubber_seller WHERE loc='$locEsc' ORDER BY name ASC";
$sellerResult = mysqli_query($con, $sellerQuery);
$sellerList = "";
while ($arr = mysqli_fetch_array($sellerResult)) {
    $sellerList .= '<option value="' . htmlspecialchars($arr['name'], ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($arr['name'], ENT_QUOTES, 'UTF-8') . '</option>';
}

$today = date('Y-m-d');
$confirmButtonLabel = $isCompleted ? 'Update Transaction' : 'Confirm Transaction';
$confirmModalTitle = $isCompleted ? 'Update Purchase' : 'Confirm Transaction';
?>
<script>
window.BALES_FORM_INIT = <?php echo json_encode($balesFormInit, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
window.BALES_PURCHASE_ID = <?php echo (int) $trans_id; ?>;
</script>

<?php rubber_page_begin('Bale Purchase', $isCompleted ? 'Edit completed bale purchase' : 'Enter bale purchase transaction', 'Purchase Entry'); ?>
<script>
window.RUBBER_CA_AJAX = true;
window.RUBBER_CA_DEFAULTS = {
    category: 'Rubber',
    type: 'BALES',
    sellerSelector: '#name'
};
</script>
<?php if ($isCompleted): ?>
<div class="alert alert-info py-2 mb-3">
    <i class="fas fa-pen me-1"></i> Editing a completed purchase. Changes will adjust contract balance, cash advance, and production costs automatically.
</div>
<?php endif; ?>
<input type="hidden" id="selected-cart" value="">
<div class="rubber-toolbar text-end mb-3">
    <button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modal_new_transact">New Transaction</button>
    <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#add_seller1">
        <span class="fa fa-plus text-white"></span> Add Seller
    </button>
    <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#copraCashAdvance">
        <span class="fa fa-plus text-white"></span> New Cash Advance
    </button>
    <button type="button" class="btn btn-dark btn-sm text-white" data-bs-toggle="modal" data-bs-target="#newContract1">
        <span class="fa fa-plus text-white"></span> New Contract
    </button>
</div>
<div class="row rubber-entry-grid g-2">
                                <div class="col-lg-4 col-xlg-3 col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-text">Transaction Status: <span id='trans_status' class="badge <?php echo $transactionStatus === 'COMPLETED' ? 'bg-success' : 'bg-danger'; ?>"><?php echo htmlspecialchars($transactionStatus, ENT_QUOTES, 'UTF-8'); ?></span></h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12"></label>
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default" style='color:black'>ID
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" id="invoice" name="invoice" readonly />
                                                            <input type="hidden" id="bales_purchase_id" name="purchase_id" value="<?php echo (int) $trans_id; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label class="col-md-12">Date</label>
                                                        <div class="col-md-12 ">
                                                            <input type="date" class='datepicker' id="date" value="<?php echo $today; ?>" name="date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Contract</label>
                                                <select class='form-select' name='contract' id='contract'>
                                                    <option disabled="disabled">Select Contract </option>
                                                    <option value="SPOT" selected="selected">SPOT </option>
                                                    <?php echo $contractList; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Seller </label>
                                                <select class='select_seller col-md-10' name='name' id='name'>
                                                    <option disabled="disabled" selected="selected">Select Seller
                                                    </option>
                                                    <?php echo $sellerList; ?>
                                                </select>
                                            </div>
                                            <!-- select seller -->
                                            <div class="form-group">
                                                <label class="col-md-12">Address</label>
                                                <div class="col-md-12">
                                                    <input type="text" class='form-control' id="address" name="address">
                                                </div>
                                            </div>
                                            <div id='contract-form'>
                                                <div class="form-group" id='quantity_textbox'>
                                                    <label class="col-md-12">Contract </label>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Quantity</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='quantity' id='quantity' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="form-group" id='balance_textbox'>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Balance</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='balance' id='balance' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id='cash_advance-form'>
                                                <div class="form-group" id='quantity_textbox'>
                                                    <label class="col-md-12">Available Cash Advance (Bales + Cuplump)</label>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='total_ca' id='total_ca' class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-success text-white confirm" id="confirm"><?php echo htmlspecialchars($confirmButtonLabel, ENT_QUOTES, 'UTF-8'); ?></button>
                                            <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                                <span class="fa fa-print"></span> Print Receipt </button>
                                            <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                                <span class="fa fa-print"></span> Print Voucher </button>

                                        </div>

                                    </div>
                                </div>

                                <!-- Column -->
                                <div class="col-lg-8 col-xlg-9 col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <button type="button" class="btn btn-dark text-white btnSelectTrans" id="btnSelectInventory">
                                                    <span class="fa fa-book"></span> Select Inventory</button>
                                                <button type="button" class="btn btn-secondary text-white btnClear" id='btnClear'>
                                                    <span class="fa fa-eraser"></span> Clear Inventory</button>
                                                <hr>
                                                <!-- -->
                                                <input type="hidden" id="lot_code" name="lot_code">
                                                <input type="hidden" id="recording_id" name="recording_id">
                                                <input type="hidden" id="prod_id" name="prod_id">
                                                <br>
                                                <div id='selected_inventory_bales'></div> <br>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col">
                                                            <label style='font-size:15px' class="col-md-12">Entry
                                                                Weight
                                                                (WET)</label>
                                                            <!-- new column -->
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id='entry' name='entry' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="1" autocomplete='off' readonly />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label style='font-size:15px' class="col-md-12">DRC</label>
                                                            <div class="input-group">

                                                                <input type="text" style='text-align:right' name='drc' id='drc' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label style='font-size:15px' class="col-md-12">Total Net
                                                                Weight</label>
                                                            <div class="input-group">

                                                                <input type="text" style='text-align:right' name='total_net_weight' id='total_net_weight' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>





                                                    <!--  -->

                                                    <!-- RASE-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px' class="col-md-12">
                                                                Price :</label>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name='price_1' id='price_1' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="4" autocomplete='off' />
                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <div class="input-group">
                                                                    <input type="text" style='text-align:right' name='weight_1' id='weight_1' class="form-control" readonly>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Kg</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="input-group mb">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:right' id='first_total' class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px' class="col-md-12">Contact
                                                                Price
                                                                :</label>
                                                            <div class="col">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name='price_2' id='price_2' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="4" autocomplete='off' disabled />
                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <div class="input-group">
                                                                    <input type="text" style='text-align:right' name='weight_2' id='weight_2' class="form-control" readonly>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Kg</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                            <div class="col">
                                                                <!-- new column -->
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:right' id='second_total' class="form-control" readonly>

                                                                </div>
                                                                <!--  -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <!-- start-->
                                                    <!-- RASE 3-->

                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Total
                                                                            Amount ₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id='total_amount' name='total_amount' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly />

                                                                </div>
                                                                <!--  -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <!--  -->
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Less:
                                                                            Cash Advance
                                                                            ₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:left' id='cash_advance' name='cash_advance' class="form-control" tabindex="9" autocomplete='off' inputmode="decimal" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Amount
                                                                            Paid ₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:left' name='amount_paid' id='amount_paid' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control" readonly />

                                                                </div>
                                                                <hr>
                                                                <input type="text" style='text-align:center' name='amount-paid-words' id='amount-paid-words' class="form-control" readonly>
                                                                <!--  -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="clearInventoryModal" tabindex="-1" role="dialog" aria-labelledby="clearInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clearInventoryModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to clear the inventory?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btnConfirmClear">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.fetch_bales_inventory = function () {
        var purchase_id = <?php echo (int) $trans_id; ?>;
        $.ajax({
            url: "table/bales_purchase_selection.php",
            method: "POST",
            data: { purchase_id: purchase_id },
            success: function (data) {
                $('#selected_inventory_bales').html(data);
            }
        });
    };

    $(function () {
        var init = window.BALES_FORM_INIT || {};
        window.BALES_IS_EDIT = !!init.is_edit;
        window.BALES_ORIGINAL = init.original || {};
        window.BALES_CONFIRM_TITLE = init.is_edit ? 'Update Purchase' : 'Confirm Transaction';
        $('#invoice').val(init.invoice || '');
        $('#date').val(init.date || '');
        $('#contract').val(init.contract || 'SPOT').trigger('change');
        if (init.seller) {
            $('#name').val(init.seller).trigger('chosen:updated');
        }
        $('#lot_code').val(init.lot_code || '');
        $('#prod_id').val(init.production_id || '');
        $('#recording_id').val(init.production_id || '');
        $('#address').val(init.address || '');
        $('#entry').val(init.entry || '');
        $('#total_net_weight').val(init.total_net_weight || '');
        $('#price_1').val(init.price_1 || '');
        $('#first_total').val(init.first_total || '');
        $('#price_2').val(init.price_2 || '');
        $('#second_total').val(init.second_total || '');
        $('#total_amount').val(init.total_amount || '');
        $('#cash_advance').val(init.cash_advance || '');
        if (init.cash_advance && parseFloat(String(init.cash_advance).replace(/,/g, '')) > 0) {
            window.BALES_CA_TOUCHED = true;
            window.BALES_CA_PREFILLED_FOR = init.seller || '';
        }
        $('#amount_paid').val(init.amount_paid || '');
        $('#amount-paid-words').val(init.amount_words || '');
        $('#drc').val(init.drc || '');
        if (init.seller) {
            fetchAddress(init.seller);
            fetchCashAdvance(init.seller);
        }
        window.fetch_bales_inventory();
    });

    $('.btnClear').on('click', function() {
        // Open the modal
        $('#clearInventoryModal').modal('show');
    });

    $('.btnConfirmClear').on('click', function() {
        var purchase_id = <?php echo (int) $trans_id; ?>;
        console.log('Clearing inventory for Purchase ID: ' + purchase_id);

        $.ajax({
            url: 'table/fetch/baleRemoveInventory.php', // Path to the PHP script
            type: 'POST',
            data: {
                'purchase_id': purchase_id
            },
            success: function(response) {
                window.fetch_bales_inventory();
                $('#entry').val('');
                $('#drc').val('');
                $('#total_net_weight').val('');
                $('#price_1').val('');
                $('#weight_1').val('');
                $('#lot_code').val('');
                $('#prod_id').val('');
                $('#recording_id').val('');
                $('#m_lot_number').val('');
                $('#m_delivery_date').val('');
                $('#m_prod_id').val('');
                computeBalesRubber();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });

        // Close the modal
        $('#clearInventoryModal').modal('hide');
    });
</script>

<script type="text/javascript" src="js/bales_rubber.js"></script>
<?php

include "modal/balesModal.php";
include "modal/balesModalScript.php";
include "modal/balePurchase.php";
include "modal/contractModal.php";
include "modal/cashadvanceModal.php";
include "modal/addseller_modal.php";
include "include/bales_script.php";
?>
<script type="text/javascript" src="js/rubber-cash-advance-modal.js"></script>
<script type="text/javascript" src="js/rubber-bales-purchase-entry.js"></script>


<script>
    $(function() {
        $(".select_seller").chosen({ search_threshold: 10 });
    });
</script>
<?php rubber_page_end(); ?>