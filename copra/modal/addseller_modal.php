<?php
$generate = copra_next_seller_code($con);
?>

<div class="modal fade copra-modal" id="add_seller" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus me-1"></i> New Seller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/newSeller.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 copra-modal-grid">
                        <div class="col-5 copra-field">
                            <label for="seller_code">Code</label>
                            <input type="text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($generate, ENT_QUOTES, 'UTF-8'); ?>" name="code" id="seller_code" readonly>
                        </div>
                        <div class="col-7 copra-field">
                            <label for="seller_name">Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="seller_name" required>
                        </div>
                        <div class="col-12 copra-field">
                            <label for="seller_address">Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="seller_address" required>
                        </div>
                        <div class="col-6 copra-field">
                            <label for="seller_contact">Contact</label>
                            <input type="text" class="form-control form-control-sm" name="contact" id="seller_contact" maxlength="11" placeholder="09XXXXXXXXX">
                        </div>
                        <div class="col-6 copra-field">
                            <label for="seller_cheque">Cheque name</label>
                            <input type="text" class="form-control form-control-sm" name="cheque" id="seller_cheque">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-sm btn-success">Save Seller</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade copra-modal" id="add_seller1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus me-1"></i> New Seller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/transaction_new.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 copra-modal-grid">
                        <div class="col-5 copra-field">
                            <label>Code</label>
                            <input type="text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($generate, ENT_QUOTES, 'UTF-8'); ?>" name="code" readonly>
                        </div>
                        <div class="col-7 copra-field">
                            <label>Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" required>
                        </div>
                        <div class="col-12 copra-field">
                            <label>Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" required>
                        </div>
                        <div class="col-6 copra-field">
                            <label>Contact</label>
                            <input type="text" class="form-control form-control-sm" name="contact" maxlength="11">
                        </div>
                        <div class="col-6 copra-field">
                            <label>Cheque name</label>
                            <input type="text" class="form-control form-control-sm" name="cheque">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="new_seller" class="btn btn-sm btn-success">Save &amp; Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
