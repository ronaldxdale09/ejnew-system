<div class="copra-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_seller1">
        <i class="fas fa-plus me-1"></i> Add Seller
    </button>
    <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#copraCashAdvance1">
        <i class="fas fa-plus me-1"></i> Cash Advance
    </button>
    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#newContract1">
        <i class="fas fa-plus me-1"></i> Contract
    </button>
    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target=".viewTransaction">
        <i class="fas fa-book me-1"></i> History
    </button>
</div>

<div class="copra-purchase">
    <aside class="copra-purchase__sidebar">
        <div class="copra-purchase__status">
            <span class="copra-purchase__status-label">Status</span>
            <span id="trans_status" class="badge bg-danger">ONGOING</span>
        </div>

        <div class="copra-field-row">
            <div class="copra-field copra-field--grow">
                <label for="invoice">Invoice</label>
                <input type="number" name="invoice" id="invoice" value="<?php echo htmlspecialchars($invoiceCount, ENT_QUOTES, 'UTF-8'); ?>" class="form-control form-control-sm" readonly>
            </div>
            <div class="copra-field copra-field--action">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal_new_transact">
                    <i class="fas fa-file-circle-plus me-1"></i> New
                </button>
            </div>
        </div>

        <div class="copra-field">
            <label for="date">Date</label>
            <input type="date" class="form-control form-control-sm datepicker" id="date" value="<?php echo htmlspecialchars($today, ENT_QUOTES, 'UTF-8'); ?>" name="date">
        </div>

        <div class="copra-field">
            <label for="contract">Contract</label>
            <select class="form-select form-select-sm" name="contract" id="contract">
                <option disabled>Select contract</option>
                <option value="SPOT" selected>SPOT</option>
                <?php echo $contractList; ?>
            </select>
        </div>

        <div class="copra-field">
            <label for="name">Seller</label>
            <select class="select_seller" name="name" id="name">
                <option disabled selected>Select seller</option>
                <?php echo $sellerList; ?>
            </select>
        </div>

        <div class="copra-field">
            <label for="address">Address</label>
            <select name="address" id="address" class="form-select form-select-sm" disabled></select>
        </div>

        <div id="contract-form" class="copra-purchase__extras">
            <div class="copra-field" id="quantity_textbox">
                <label for="quantity">Contract quantity</label>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control text-end" name="quantity" id="quantity" readonly>
                    <span class="input-group-text">kg</span>
                </div>
            </div>
            <div class="copra-field" id="balance_textbox">
                <label for="balance">Balance</label>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control text-end" name="balance" id="balance" readonly>
                    <span class="input-group-text">kg</span>
                </div>
            </div>
        </div>

        <div id="cash_advance-form" class="copra-purchase__extras">
            <div class="copra-field">
                <label for="total_ca">Available cash advance</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control text-end" name="total_ca" id="total_ca" readonly>
                </div>
            </div>
        </div>
    </aside>

    <div class="copra-purchase__main">
        <section class="copra-calc-section">
            <h4 class="copra-calc-section__title">Weight</h4>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="copra-calc-label" for="noSack">No. of sack</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="noSack" name="noSack" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="1" autocomplete="off">
                        <span class="input-group-text">sk</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="gross">Gross weight</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="gross" name="gross" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="2" autocomplete="off">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="tare">Deductable tare</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="tare" name="tare" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="3" autocomplete="off">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-12">
                    <label class="copra-calc-label" for="net">Net weight</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control text-end copra-readonly" name="net" id="net" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="copra-calc-section">
            <h4 class="copra-calc-section__title">Deductions</h4>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="copra-calc-label" for="dust">Dust</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="dust" name="dust" tabindex="4" autocomplete="off">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="new">New</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="new" name="new" tabindex="5">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="total-dust">Total dust</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control text-end copra-readonly" id="total-dust" name="total-dust" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="moisture">Moisture</label>
                    <input type="text" class="form-control form-control-sm" name="moisture" id="moisture" onkeyup="GetDetail(this.value)" tabindex="6" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="discount_reading">P / D</label>
                    <input type="text" class="form-control form-control-sm" name="discount_reading" id="discount_reading" tabindex="7" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label class="copra-calc-label" for="total-moisture">Total moisture</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control text-end copra-readonly" id="total-moisture" name="total-moisture" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
                <div class="col-12">
                    <label class="copra-calc-label" for="total-res">Net resecada weight</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control text-end copra-readonly fw-semibold" id="total-res" name="total-res" readonly>
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="copra-calc-section">
            <h4 class="copra-calc-section__title">Resecada pricing</h4>
            <div class="copra-rese-grid">
                <span class="copra-rese-grid__head"></span>
                <span class="copra-rese-grid__head">Price</span>
                <span class="copra-rese-grid__head">Weight</span>
                <span class="copra-rese-grid__head">Subtotal</span>

                <span class="copra-rese-grid__label">1st rese</span>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="first-res" id="first-res" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8" autocomplete="off">
                </div>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control text-end copra-readonly" id="1rese-weight" readonly>
                    <span class="input-group-text">kg</span>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control text-end copra-readonly" id="total-1res" readonly>
                </div>

                <span class="copra-rese-grid__label">2nd rese</span>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control copra-readonly" id="second-res" name="second-rese" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="9" autocomplete="off" readonly>
                </div>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control text-end copra-readonly" id="2rese-weight" readonly>
                    <span class="input-group-text">kg</span>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control text-end copra-readonly" name="total-2res" id="total-2res" readonly>
                </div>
            </div>
        </section>

        <section class="copra-calc-section copra-calc-section--payment">
            <h4 class="copra-calc-section__title">Payment</h4>
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="copra-calc-label" for="total-amount">Total amount</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control text-end copra-readonly" id="total-amount" name="total-amount" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="copra-calc-label" for="cash_advance">Less: cash advance</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control text-end" id="cash_advance" name="cash_advance" value="0" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="10" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="copra-calc-label" for="tax">Withholding tax</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control text-end" id="tax" name="tax" value="1" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="11" autocomplete="off">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="copra-calc-label" for="tax-amount">Tax amount</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control text-end copra-readonly" name="tax-amount" id="tax-amount" readonly>
                    </div>
                </div>
                <div class="col-12">
                    <label class="copra-calc-label" for="amount-paid">Amount paid</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control text-end copra-amount-paid copra-readonly fw-bold" name="amount-paid" id="amount-paid" readonly>
                    </div>
                    <input type="text" name="amount-paid-words" id="amount-paid-words" class="d-none" readonly>
                </div>
            </div>
        </section>
    </div>

    <footer class="copra-purchase__footer">
        <button type="button" class="btn btn-success btn-sm confirm" id="confirm">
            <i class="fas fa-check me-1"></i> Confirm Transaction
        </button>
        <button type="button" class="btn btn-dark btn-sm receiptBtn" id="receiptBtn">
            <i class="fas fa-print me-1"></i> Print Receipt
        </button>
        <button type="button" class="btn btn-outline-secondary btn-sm vouchBtn" id="vouchBtn">
            <i class="fas fa-print me-1"></i> Print Voucher
        </button>
    </footer>
</div>
