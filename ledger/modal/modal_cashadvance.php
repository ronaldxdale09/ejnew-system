<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

?>
<!-- NEW ADD CASH ADVANCE MODAL -->
<div class="modal fade" id="cashadvanceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-plus-circle me-2"></i>New Cash Advance</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id='cashadvance-form' method="POST">
                <div class="modal-body">
                    <!-- Section 1: Transaction Info -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Transaction Info</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class='form-control' value="<?php echo $dateNow; ?>" type="date" name="date"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" name='voucher' class="form-control" placeholder="e.g. CV-1001"
                                autocomplete='off' required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Station</label>
                            <input type="text" name='station' class="form-control" autocomplete='off'>
                        </div>
                    </div>

                    <!-- Section 2: Details -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Particulars</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Particular/Payee</label>
                            <input type="text" name='particular' class="form-control" placeholder="Name of person"
                                autocomplete='off' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category (Type)</label>
                            <select class='form-select' name='category' required>
                                <option value="" disabled selected>Select Category</option>
                                <option value='Employee'>Employee</option>
                                <option value='Rubber'>Rubber</option>
                                <option value='Coffee'>Coffee</option>
                                <option value='Copra'>Copra</option>
                                <option value='Toppers '>Toppers</option>
                                <option value="Karpentero">Karpentero</option>
                                <option value="Maloong Contractual">Maloong Contractual</option>
                                <option value='Others'>Others</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section 3: Financials -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Financials</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">₱</span>
                                <input type="text" style='text-align:right; font-size: 1.2rem; font-weight: bold;'
                                    name='amount' class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" autocomplete='off' required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name='submit' class="btn btn-success px-4">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REMOVE MODAL -->
<div class="modal fade" id="removeCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-exclamation-triangle me-2"></i>Confirm Deletion</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <form id="deleteCashAdvanceForm" method="POST">
                    <input type="hidden" id="my_id" name="my_id">
                    <div class="mb-3">
                        <i class="fa fa-trash fa-3x text-muted mb-3"></i>
                        <p class="mb-1">Are you sure you want to delete this cash advance record for:</p>
                        <h5 id="customer_name" class="fw-bold text-danger"></h5>
                        <p class="text-muted small">This action cannot be undone.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE MODAL -->
<div class="modal fade" id="updateCashAdvance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-edit me-2"></i>Update Cash Advance</h6>
                <!-- Note: Bootstrap 4 uses close class, 5 uses btn-close. Adjusting for compatibility if needed, but sticking to 5 structure -->
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id='updateCashAdvanceForm' method="POST">
                <div class="modal-body">
                    <input type="hidden" name="my_id" id="my_id">

                    <!-- Section 1: Transaction Info -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Transaction Info</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class='form-control' type="date" id="date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" name='voucher' id="voucher" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Station</label>
                            <input type="text" name='station' id="station" class="form-control">
                        </div>
                    </div>

                    <!-- Section 2: Details -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Particulars</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Particular/Payee</label>
                            <input type="text" name='particular' id="particular" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class='form-select' name='category' id='category' required>
                                <option value="" disabled>Select Category</option>
                                <option value='Employee'>Employee</option>
                                <option value='Rubber'>Rubber</option>
                                <option value='Coffee'>Coffee</option>
                                <option value='Copra'>Copra</option>
                                <option value='Toppers '>Toppers</option>
                                <option value="Karpentero">Karpentero</option>
                                <option value="Maloong Contractual">Maloong Contractual</option>
                                <option value='Others'>Others</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section 3: Financials -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Financials</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">₱</span>
                                <input type="text" style='text-align:right; font-size: 1.2rem; font-weight: bold;'
                                    name='amount' id="amount" class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>