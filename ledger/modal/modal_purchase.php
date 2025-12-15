<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

?>
<!-- Modal -->

<!-- ADD PURCHASE MODAL -->
<div class="modal fade" id="purchase-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-shopping-cart me-2"></i>New Purchase Entry</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id='purchase-form' method="POST">
                <div class="modal-body">
                    <!-- Section 1: Transaction Info -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Transaction Details</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class='form-control' value="<?php echo $dateNow; ?>" type="date" id="date"
                                name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" id='p_voucher' name='p_voucher' class="form-control" required
                                autocomplete='off'>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select class='form-select' name='pur_category' id='pur_category' required>
                                <option disabled selected>Select Category</option>
                                <?php echo $purCatList; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Section 2: Supplier & Scale -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Supplier & Weight</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Supplier Name</label>
                            <input type="text" name='name' class="form-control" autocomplete='off' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" id='p_net-kilos' name='net_kilo' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                                <span class="input-group-text fw-bold">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">₱</span>
                                <input type="text" style='text-align:right' name='price'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    class="form-control" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Deductions & Adjustments -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Deductions & Adjustments</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Cash Advance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='cash_advance' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tax</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='tax' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Others / Desc</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='others' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                            </div>
                            <input type="text" name='description' class="form-control mt-1 form-control-sm"
                                placeholder="Description (Optional)" autocomplete='off'>
                        </div>
                    </div>

                    <!-- Section 4: Totals -->
                    <div class="alert alert-light border">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label text-muted small text-uppercase">Gross Total</label>
                                <div class="input-group">
                                    <span
                                        class="input-group-text bg-transparent border-end-0 fw-bold text-muted">₱</span>
                                    <input type="text" style='text-align:right; font-weight: bold;' name='total_amount'
                                        readonly class="form-control border-start-0 bg-transparent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-primary small text-uppercase fw-bold">Net Total
                                    Amount</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-primary text-white border-0 fw-bold">₱</span>
                                    <input type="text" style='text-align:right; font-weight: 800; color: #0C0070;'
                                        name='net_total_amount' class="form-control border-primary">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4">Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REMOVE PURCHASE MODAL -->
<div class="modal fade" id="removePurchase" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-exclamation-triangle me-2"></i>Confirm Deletion</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <form id="deletePurchaseForm" method="POST">
                    <input type="hidden" id="my_id" name="my_id">
                    <div class="mb-3">
                        <i class="fa fa-trash fa-3x text-muted mb-3"></i>
                        <p class="mb-1">Are you sure you want to delete this purchase entry?</p>
                        <p class="text-muted small">This action cannot be undone.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE PURCHASE MODAL -->
<div class="modal fade" id="updatePurchase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-edit me-2"></i>Update Purchase Entry</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id='updatePurchaseForm' method="POST">
                <input class='form-control' id="p_id" name="p_id" hidden>
                <div class="modal-body">
                    <!-- Section 1: Transaction Info -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Transaction Details</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input class='form-control' type="date" id="u_date" name="date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Voucher No.</label>
                            <input type="text" id='u_voucher' name='u_voucher' class="form-control" required
                                autocomplete='off'>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select class='form-select' name='pur_category' id='u_category' required>
                                <option disabled value="">Select Category</option>
                                <?php echo $purCatList; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Section 2: Supplier & Scale -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Supplier & Weight</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Supplier Name</label>
                            <input type="text" name='name' id='name' class="form-control" autocomplete='off' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Net Kilos</label>
                            <div class="input-group">
                                <input type="text" id='u_net_kilo' name='u_net_kilo' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                                <span class="input-group-text fw-bold">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price per Kilo</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">₱</span>
                                <input type="text" style='text-align:right' name='u_price' id='u_price'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    class="form-control" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Deductions & Adjustments -->
                    <h6 class="text-muted text-uppercase mb-3 small fw-bold">Deductions & Adjustments</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Cash Advance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='u_cash_advance' id='u_cash_advance'
                                    class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tax</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='u_tax' id='u_tax' class="form-control"
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                    autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Others / Desc</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='text-align:right' name='u_others' id='u_others'
                                    class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                            <input type="text" style='text-align:center' name='u_description' id='u_description'
                                class="form-control mt-1 form-control-sm" placeholder="Description" autocomplete='off'>
                        </div>
                    </div>

                    <!-- Section 4: Totals -->
                    <div class="alert alert-light border">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label text-muted small text-uppercase">Gross Total</label>
                                <div class="input-group">
                                    <span
                                        class="input-group-text bg-transparent border-end-0 fw-bold text-muted">₱</span>
                                    <input type="text" style='text-align:right; font-weight: bold;'
                                        name='u_total_amount' id='u_total_amount' readonly
                                        class="form-control border-start-0 bg-transparent">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-primary small text-uppercase fw-bold">Net Total
                                    Amount</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-primary text-white border-0 fw-bold">₱</span>
                                    <input type="text" style='text-align:right; font-weight: 800; color: #0C0070;'
                                        name='u_net_total_amount' id='u_net_total_amount'
                                        class="form-control border-primary">
                                </div>
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



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputs = document.querySelectorAll("[name='u_net_kilo'], [name='u_price'], [name='u_cash_advance'], [name='u_tax'], [name='u_others']");

        for (let input of inputs) {
            input.addEventListener("input", u_computeTotal);
        }

        // Add separate event listener for u_net_total_amount
        document.querySelector("[name='u_net_total_amount']").addEventListener("input", function () {
            let netTotalValue = parseFloat(this.value.replace(/,/g, '')) || 0;
            let formattedValue = parseFloat(netTotalValue.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_total_amount']").value = formattedValue;
        });

        function u_computeTotal() {
            console.log("Computing totals..."); // Debug log
            let netKilos = parseFloat(document.querySelector("[name='u_net_kilo']").value.replace(/,/g, '')) || 0;
            let price = parseFloat(document.querySelector("[name='u_price']").value.replace(/,/g, '')) || 0;
            let cashAdvance = parseFloat(document.querySelector("[name='u_cash_advance']").value.replace(/,/g, '')) || 0;
            let tax = parseFloat(document.querySelector("[name='u_tax']").value.replace(/,/g, '')) || 0;
            let others = parseFloat(document.querySelector("[name='u_others']").value.replace(/,/g, '')) || 0;

            let net_total = (netKilos * price) - cashAdvance - tax - others;
            let totalAmount = (netKilos * price);

            console.log("Net Kilos:", netKilos);
            console.log("Price:", price);
            console.log("Cash Advance:", cashAdvance);
            console.log("Tax:", tax);
            console.log("Others:", others);
            console.log("Net Total:", net_total);
            console.log("Total Amount:", totalAmount);

            let formattedNet = parseFloat(net_total.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_net_total_amount']").value = formattedNet;

            let formattedTotalAmount = parseFloat(totalAmount.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_total_amount']").value = formattedTotalAmount;
        }
    });
</script>