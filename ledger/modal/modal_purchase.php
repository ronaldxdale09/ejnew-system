<?php
$dateNow = date('Y-m-d');
?>
<!-- Add Purchase -->
<div class="modal fade ledger-modal" id="purchase-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-cart-shopping me-2"></i>New Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="purchase-form" method="POST">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="date">Date</label>
                            <input class="form-control" value="<?php echo $dateNow; ?>" type="date" id="date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="p_voucher">Voucher No.</label>
                            <input type="text" id="p_voucher" name="p_voucher" class="form-control" required autocomplete="off" placeholder="e.g. 1001">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="pur_category">Category</label>
                            <select class="form-select pur_category" name="pur_category" id="pur_category" required>
                                <option value="" disabled selected>Select category</option>
                                <?php echo $purCatList; ?>
                            </select>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Supplier & Weight</div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Supplier Name</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="Customer / supplier name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" id="p_net-kilos" name="net_kilo" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="price" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Deductions & Adjustments</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Cash Advance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="cash_advance" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tax</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="tax" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Others</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="others" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                            </div>
                            <input type="text" name="description" class="form-control form-control-sm mt-1" placeholder="Description (optional)" autocomplete="off">
                        </div>
                    </div>

                    <div class="ledger-modal-totals mt-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Gross Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" name="total_amount" readonly class="form-control text-end bg-light">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Net Total Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text ledger-modal-totals__accent">₱</span>
                                    <input type="text" name="net_total_amount" class="form-control total-field text-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Save Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Purchase -->
<div class="modal fade ledger-modal ledger-modal--danger" id="removePurchase" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deletePurchaseForm" method="POST">
                <input type="hidden" id="my_id" name="my_id">
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-2x text-danger mb-3 d-block opacity-75"></i>
                    <p class="mb-1">Delete this purchase entry?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Purchase -->
<div class="modal fade ledger-modal" id="updatePurchase" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pen-to-square me-2"></i>Update Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatePurchaseForm" method="POST">
                <input type="hidden" id="p_id" name="p_id">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class="form-control" type="date" id="u_date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" id="u_voucher" name="u_voucher" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="pur_category" id="u_category" required>
                                <option value="" disabled>Select category</option>
                                <?php echo $purCatList; ?>
                            </select>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Supplier & Weight</div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Supplier Name</label>
                            <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" id="u_net_kilo" name="u_net_kilo" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="u_price" id="u_price" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Deductions & Adjustments</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Cash Advance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="u_cash_advance" id="u_cash_advance" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tax</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="u_tax" id="u_tax" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Others</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="u_others" id="u_others" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                            <input type="text" name="u_description" id="u_description" class="form-control form-control-sm mt-1" placeholder="Description" autocomplete="off">
                        </div>
                    </div>

                    <div class="ledger-modal-totals mt-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Gross Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" name="u_total_amount" id="u_total_amount" readonly class="form-control text-end bg-light">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Net Total Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text ledger-modal-totals__accent">₱</span>
                                    <input type="text" name="u_net_total_amount" id="u_net_total_amount" class="form-control total-field text-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/ledger-purchase-modals.js?v=<?php echo filemtime(__DIR__ . '/../js/ledger-purchase-modals.js'); ?>"></script>
