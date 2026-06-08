<?php $dateNow = date('Y-m-d'); ?>

<!-- Add Buahan -->
<div class="modal fade ledger-modal" id="buahanToppers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-boxes-stacked me-2"></i>New Buahan Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/ledger/addBuahan.php" id="buahanAddForm" method="POST">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class="form-control" value="<?php echo $dateNow; ?>" type="date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" name="voucher" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Particulars</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="Customer / description">
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Weight & Pricing</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" name="net_kilos" id="net_kilos" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="price" id="price" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                            <input type="hidden" name="total" id="total">
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Revenue Split</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">EJN Percent (%)</label>
                            <input type="text" name="ejn_percent" id="ejn_percent" class="form-control text-end"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Toppers Percent (%)</label>
                            <input type="text" name="topper_percent" id="topper_percent" class="form-control text-end"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">EJN Total</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="ejn_total" id="ejn_total" class="form-control text-end bg-light" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Toppers Gross</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="topper_gross" id="topper_gross" class="form-control text-end bg-light" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Deductions</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Less Category</label>
                            <input class="form-control" list="buahanLessList" name="less_category" id="less_category" autocomplete="off">
                            <datalist id="buahanLessList">
                                <option value="Cash Advance">
                                <option value="SSS">
                                <option value="Rice">
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Less (Toppers)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="less" id="less" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Toppers Total</label>
                            <div class="input-group">
                                <span class="input-group-text ledger-modal-totals__accent">₱</span>
                                <input type="text" name="topper_total" id="topper_total" class="form-control total-field text-end" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Buahan -->
<div class="modal fade ledger-modal" id="updateBuahan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pen-to-square me-2"></i>Update Buahan Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/ledger/addBuahan.php" id="buahanUpdateForm" method="POST">
                <input type="hidden" id="u_id" name="id">
                <div class="modal-body">
                    <div class="modal-section">Transaction Details</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class="form-control" type="date" id="u_date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" name="voucher" id="u_voucher" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Particulars</label>
                            <input type="text" name="name" id="u_name" class="form-control" autocomplete="off" required>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Weight & Pricing</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" name="net_kilos" id="u_net_kilos" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="price" id="u_price" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                            <input type="hidden" name="total" id="u_total">
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Revenue Split</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">EJN Percent (%)</label>
                            <input type="text" name="ejn_percent" id="u_ejn_percent" class="form-control text-end"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Toppers Percent (%)</label>
                            <input type="text" name="topper_percent" id="u_topper_percent" class="form-control text-end"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">EJN Total</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="ejn_total" id="u_ejn_total" class="form-control text-end bg-light" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Toppers Gross</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="topper_gross" id="u_topper_gross" class="form-control text-end bg-light" readonly>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="modal-section">Deductions</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Less Category</label>
                            <input class="form-control" list="buahanLessListUpdate" name="less_category" id="u_less_category" autocomplete="off">
                            <datalist id="buahanLessListUpdate">
                                <option value="Cash Advance">
                                <option value="SSS">
                                <option value="Rice">
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Less (Toppers)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" name="less" id="u_less" class="form-control text-end"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Toppers Total</label>
                            <div class="input-group">
                                <span class="input-group-text ledger-modal-totals__accent">₱</span>
                                <input type="text" name="topper_total" id="u_topper_total" class="form-control total-field text-end" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-success"><i class="fas fa-save me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Buahan -->
<div class="modal fade ledger-modal ledger-modal--danger" id="deleteRecord" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/ledger/addBuahan.php" method="POST">
                <input type="hidden" id="d_id" name="id">
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-2x text-danger mb-3 d-block opacity-75"></i>
                    <p class="mb-0">Delete this buahan record? This cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/ledger-buahan-modals.js?v=<?php echo @filemtime(__DIR__ . '/../js/ledger-buahan-modals.js') ?: time(); ?>"></script>
