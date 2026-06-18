<?php
$today = date('Y-m-d');
$loc = str_replace(' ', '', $_SESSION['loc']);

$seller = "SELECT * FROM rubber_seller WHERE loc='$loc'";
$result = mysqli_query($con, $seller);
$sellerList = '';
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .= '<option value="' . htmlspecialchars($arr['name'], ENT_QUOTES) . '">' . htmlspecialchars($arr['name'], ENT_QUOTES) . '</option>';
}
?>

<!-- New Cash Advance -->
<div class="modal fade rubber-modal" id="copraCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newCA.php" method="POST">
                <input type="hidden" name="return_to" id="ca_return_to" value="">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label for="ca_date">Date</label>
                            <input type="date" class="form-control form-control-sm" id="ca_date" name="date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="ca_category">Category</label>
                            <select class="form-select form-select-sm" name="ca_category" id="ca_category" required>
                                <option value="" disabled selected>Select…</option>
                                <option value="copra">Copra</option>
                                <option value="ntc">NTC</option>
                                <option value="trucking">Trucking</option>
                                <option value="others">Others</option>
                                <option value="Rubber">Rubber</option>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="ca_name">Seller</label>
                            <select class="ca_seller form-control form-control-sm" name="name" id="ca_name" required>
                                <option value="" disabled selected>Select seller…</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="ca_type">Type</label>
                            <select class="form-select form-select-sm" name="type" id="ca_type" required>
                                <option value="" disabled selected>Select…</option>
                                <option value="WET">Cuplump (WET)</option>
                                <option value="BALES">Bales</option>
                            </select>
                        </div>
                        <div class="col-12 rubber-field">
                            <label for="ca_amount">Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="ca_amount" id="ca_amount" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-sm btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Cash Advance balances -->
<div class="modal fade rubber-modal" id="editCA" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newCA.php" method="POST">
                <input type="hidden" id="e_id" name="id">
                <input type="hidden" name="return_to" id="ca_edit_return_to" value="">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label>Seller</label>
                            <input type="text" class="form-control form-control-sm" id="e_name" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Address</label>
                            <input type="text" class="form-control form-control-sm" id="e_address" readonly>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="e_wet_ca">Cuplump CA</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="wet" id="e_wet_ca" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                        <div class="col-6 rubber-field">
                            <label for="e_bales_ca">Bales CA</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="bales" id="e_bales_ca" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-sm btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Legacy transaction_new CA modal -->
<div class="modal fade rubber-modal" id="copraCashAdvance1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newCA.php" method="POST">
                <input type="hidden" name="return_to" id="ca_return_to_legacy" value="">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-6 rubber-field">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Category</label>
                            <select class="form-select form-select-sm ca_category" name="ca_category" id="ca_category_legacy" required>
                                <option value="" disabled selected>Select…</option>
                                <option value="copra">Copra</option>
                                <option value="ntc">NTC</option>
                                <option value="trucking">Trucking</option>
                                <option value="others">Others</option>
                                <option value="Rubber">Rubber</option>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Seller</label>
                            <select class="ca_seller1 form-control form-control-sm" name="name" required>
                                <option value="" disabled selected>Select seller…</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-6 rubber-field">
                            <label>Type</label>
                            <select class="form-select form-select-sm" name="type" id="ca_type_legacy" required>
                                <option value="" disabled selected>Select…</option>
                                <option value="WET">Cuplump (WET)</option>
                                <option value="BALES">Bales</option>
                            </select>
                        </div>
                        <div class="col-12 rubber-field">
                            <label>Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="ca_amount" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function rubberCashAdvanceReturnUrl() {
    var path = window.location.pathname || '';
    var file = path.split('/').pop() || 'cash-advance.php';
    return '../' + file + (window.location.search || '');
}

function rubberPrefillCashAdvanceModal($modal, options) {
    options = options || {};
    var seller = $(options.sellerSelector || '#name').val();
    var returnInput = options.returnInput || '#ca_return_to';

    $modal.find(returnInput).val(rubberCashAdvanceReturnUrl());

    if (options.defaultCategory) {
        $modal.find(options.categorySelector || '#ca_category').val(options.defaultCategory);
    }
    if (options.defaultType) {
        $modal.find(options.typeSelector || '#ca_type').val(options.defaultType);
    }
    if (seller && String(seller).toLowerCase().indexOf('select') === -1) {
        $modal.find(options.sellerSelectorField || '#ca_name').val(seller).trigger('chosen:updated');
    }
}

$('#copraCashAdvance').on('shown.bs.modal', function () {
    $('.ca_seller', this).chosen({ width: '100%', search_threshold: 10 });
    rubberPrefillCashAdvanceModal($(this), {
        defaultCategory: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.category : 'Rubber',
        defaultType: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.type : 'BALES',
        sellerSelector: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.sellerSelector : '#name',
        returnInput: '#ca_return_to'
    });
});

$('#copraCashAdvance1').on('shown.bs.modal', function () {
    $('.ca_seller1, .ca_category', this).chosen({ width: '100%', search_threshold: 10 });
    rubberPrefillCashAdvanceModal($(this), {
        defaultCategory: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.category : 'Rubber',
        defaultType: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.type : 'BALES',
        sellerSelector: window.RUBBER_CA_DEFAULTS ? window.RUBBER_CA_DEFAULTS.sellerSelector : '#name',
        categorySelector: '#ca_category_legacy',
        typeSelector: '#ca_type_legacy',
        sellerSelectorField: '.ca_seller1',
        returnInput: '#ca_return_to_legacy'
    });
});

$('#editCA').on('shown.bs.modal', function () {
    $('#ca_edit_return_to').val(rubberCashAdvanceReturnUrl());
});
</script>
