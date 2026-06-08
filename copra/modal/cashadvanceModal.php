<?php
$today = date('Y-m-d');
$sellerList = copra_seller_options($con);
?>
<div class="modal fade copra-modal" id="copraCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-money-bill-wave me-1"></i> New Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newCA.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 copra-modal-grid">
                        <div class="col-6 copra-field">
                            <label for="ca_date">Date</label>
                            <input type="date" class="form-control form-control-sm" id="ca_date" name="date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 copra-field">
                            <label for="ca_category">Category</label>
                            <select class="form-select form-select-sm" name="ca_category" id="ca_category" required>
                                <option value="" disabled selected>Select category</option>
                                <option value="copra">Copra</option>
                                <option value="ntc">NTC</option>
                                <option value="trucking">Trucking</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="col-12 copra-field">
                            <label for="ca_seller_name">Seller</label>
                            <select class="ca_seller form-select form-select-sm" name="name" id="ca_seller_name" required>
                                <option value="" disabled selected>Select seller</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <div id="ca_current_balance" class="copra-ca-current-balance d-none">
                                Current balance: <strong id="ca_current_balance_value">₱ 0.00</strong>
                            </div>
                        </div>
                        <div class="col-12 copra-field">
                            <label for="ca_amount">Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" name="ca_amount" id="ca_amount" required onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
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

<div class="modal fade copra-modal" id="editCA" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pen me-1"></i> Update Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newCA.php" method="POST">
                <input type="hidden" id="e_id" name="id">
                <div class="modal-body">
                    <div class="row g-2 copra-modal-grid">
                        <div class="col-6 copra-field">
                            <label>Seller</label>
                            <input type="text" class="form-control form-control-sm" id="e_name" readonly>
                        </div>
                        <div class="col-6 copra-field">
                            <label>Address</label>
                            <input type="text" class="form-control form-control-sm" id="e_address" readonly>
                        </div>
                        <div class="col-12 copra-field">
                            <label for="cash_advance">Cash advance balance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" id="cash_advance" name="cash_advance" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
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

<script>
$('#copraCashAdvance').on('shown.bs.modal', function () {
    $('.ca_seller', this).chosen({ width: '100%', search_threshold: 10 });
});

$('#ca_seller_name').on('change', function () {
    var seller = $(this).val();
    var $wrap = $('#ca_current_balance');
    var $value = $('#ca_current_balance_value');
    if (!seller) {
        $wrap.addClass('d-none');
        return;
    }
    $.post('include/fetch/fetchCopraCashAdvance.php', { name: seller }, function (amount) {
        var parsed = parseFloat(String(amount || '0').replace(/,/g, '')) || 0;
        $value.text('₱ ' + parsed.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $wrap.removeClass('d-none');
    });
});
</script>
