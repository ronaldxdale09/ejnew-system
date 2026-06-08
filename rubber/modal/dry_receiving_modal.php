<?php
$today = date('Y-m-d');
$recordedBy = htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['user'] ?? '', ENT_QUOTES, 'UTF-8');
$sellerOptions = rubber_seller_options($con, $rubber_loc);
?>

<!-- Create -->
<div class="modal fade rubber-modal" id="createDryTransfer" tabindex="-1" aria-labelledby="createDryTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDryTransferLabel">New DRY Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/newDryReceiving.php">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-md-6 rubber-field">
                            <label for="new_date">Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" id="new_date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="new_recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="new_recorded_by" value="<?php echo $recordedBy; ?>" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="new_seller">Seller</label>
                            <select class="select_seller form-control form-control-sm" name="name" id="new_seller" required>
                                <option value="" disabled selected>Select seller…</option>
                                <?php echo $sellerOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="new_address">Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="new_address" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="new_net">Net Cuplump Weight</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="net" id="new_net"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="new_price">Dry Price</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="price" id="new_price"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12 rubber-field">
                            <label for="new_cash_advance">Cash Advance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="cash_advance" id="new_cash_advance"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="new" class="btn btn-sm btn-success">Save Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update -->
<div class="modal fade rubber-modal" id="updateDryTransfer" tabindex="-1" aria-labelledby="updateDryTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDryTransferLabel">Edit DRY Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/newDryReceiving.php">
                <input type="hidden" name="dry_id" id="u_id">
                <div class="modal-body">
                    <div class="row g-2 rubber-modal-grid">
                        <div class="col-md-6 rubber-field">
                            <label for="u_date">Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" id="u_date" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="u_recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="u_recorded_by" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="u_seller">Seller</label>
                            <select class="select_seller form-control form-control-sm" name="name" id="u_seller" required>
                                <option value="" disabled>Select seller…</option>
                                <?php echo $sellerOptions; ?>
                            </select>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="u_address">Address</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="u_address" required>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="u_net">Net Cuplump Weight</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="net" id="u_net"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-6 rubber-field">
                            <label for="u_price">Dry Price</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="price" id="u_price"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12 rubber-field">
                            <label for="u_cash_advance">Cash Advance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="cash_advance" id="u_cash_advance"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
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

<!-- Delete -->
<div class="modal fade rubber-modal" id="deleteDryTransfer" tabindex="-1" aria-labelledby="deleteDryTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDryTransferLabel">Delete Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/newDryReceiving.php">
                <input type="hidden" name="dry_id" id="d_id">
                <div class="modal-body text-center">
                    <p class="mb-2"><i class="fas fa-exclamation-triangle rubber-delete-icon"></i></p>
                    <p class="mb-0">Delete this DRY transfer record?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
