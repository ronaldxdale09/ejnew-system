<?php
$today = date('Y-m-d');
$sellerList = copra_seller_options($con);
?>
<div class="modal fade copra-modal" id="copraCashAdvance1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-money-bill-wave me-1"></i> New Cash Advance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/transaction_new.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 copra-modal-grid">
                        <div class="col-6 copra-field">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 copra-field">
                            <label>Category</label>
                            <select class="form-select form-select-sm" name="ca_category" required>
                                <option value="" disabled selected>Select category</option>
                                <option value="copra">Copra</option>
                                <option value="ntc">NTC</option>
                                <option value="trucking">Trucking</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="col-12 copra-field">
                            <label>Seller</label>
                            <select class="ca_seller1" name="seller" required>
                                <option value="" disabled selected>Select seller</option>
                                <?php echo $sellerList; ?>
                            </select>
                        </div>
                        <div class="col-12 copra-field">
                            <label>Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control text-end" name="ca_amount" required onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="new_ca" class="btn btn-sm btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#copraCashAdvance1').on('shown.bs.modal', function () {
    $('.ca_seller1', this).chosen({ width: '100%', search_threshold: 10 });
});
</script>
