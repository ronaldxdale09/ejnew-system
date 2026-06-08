<?php
$month = date('m');
$day = date('d');
$year = date('Y');
$dateNow = $year . '-' . $month . '-' . $day;

$caCategories = [
    'Employee',
    'Rubber',
    'Coffee',
    'Copra',
    'Toppers',
    'Karpentero',
    'Maloong Contractual',
    'Others',
];

function ca_category_options(array $categories, string $selected = ''): string
{
    $html = '<option value="" disabled' . ($selected === '' ? ' selected' : '') . '>Select Category</option>';
    foreach ($categories as $cat) {
        $sel = ($selected === $cat) ? ' selected' : '';
        $html .= '<option value="' . adm_esc($cat) . '"' . $sel . '>' . adm_esc($cat) . '</option>';
    }
    return $html;
}
?>
<!-- Add Cash Advance -->
<div class="modal fade ledger-modal" id="cashadvanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>New Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cashadvance-form" method="POST">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="ca_date">Date</label>
                            <input class="form-control" id="ca_date" value="<?php echo $dateNow; ?>" type="date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="ca_voucher">Voucher No.</label>
                            <input type="text" name="voucher" id="ca_voucher" class="form-control" placeholder="e.g. CV-1001" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="ca_station">Station</label>
                            <input type="text" name="station" id="ca_station" class="form-control" list="ca_station_list" autocomplete="off" placeholder="Buying station">
                            <?php if (!empty($buyingStation)): ?>
                            <datalist id="ca_station_list"><?php echo $buyingStation; ?></datalist>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal-section">Particulars</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="ca_particular">Particular / Payee</label>
                            <input type="text" name="particular" id="ca_particular" class="form-control" placeholder="Name of person" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="ca_category">Category</label>
                            <select class="form-select" name="category" id="ca_category" required>
                                <?php echo ca_category_options($caCategories); ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-section">Financials</div>
                    <div class="ledger-modal-totals">
                        <label class="form-label" for="ca_amount">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text ledger-modal-totals__accent">₱</span>
                            <input type="text" name="amount" id="ca_amount" class="form-control text-end total-field"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Cash Advance -->
<div class="modal fade ledger-modal ledger-modal--danger" id="removeCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteCashAdvanceForm" method="POST">
                <input type="hidden" id="delete_ca_id" name="my_id">
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-2x text-danger mb-3 d-block opacity-75"></i>
                    <p class="mb-1">Delete cash advance record for:</p>
                    <p class="fw-bold text-danger mb-1" id="delete_ca_customer_name"></p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Cash Advance -->
<div class="modal fade ledger-modal" id="updateCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateCashAdvanceForm" method="POST">
                <input type="hidden" name="my_id" id="update_ca_id">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="u_ca_date">Date</label>
                            <input class="form-control" type="date" id="u_ca_date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="u_ca_voucher">Voucher No.</label>
                            <input type="text" name="voucher" id="u_ca_voucher" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="u_ca_station">Station</label>
                            <input type="text" name="station" id="u_ca_station" class="form-control" list="ca_station_list_update" autocomplete="off">
                            <?php if (!empty($buyingStation)): ?>
                            <datalist id="ca_station_list_update"><?php echo $buyingStation; ?></datalist>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal-section">Particulars</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="u_ca_particular">Particular / Payee</label>
                            <input type="text" name="particular" id="u_ca_particular" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="u_ca_category">Category</label>
                            <select class="form-select" name="category" id="u_ca_category" required>
                                <?php echo ca_category_options($caCategories); ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-section">Financials</div>
                    <div class="ledger-modal-totals">
                        <label class="form-label" for="u_ca_amount">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text ledger-modal-totals__accent">₱</span>
                            <input type="text" name="amount" id="u_ca_amount" class="form-control text-end total-field"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
