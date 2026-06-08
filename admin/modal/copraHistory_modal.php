<!-- View transaction modal -->
<div class="modal fade adm-copra-modal" id="viewHistory" tabindex="-1" aria-labelledby="copraModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header adm-copra-modal__header">
                <div>
                    <span class="adm-copra-modal__eyebrow">Copra purchase transaction</span>
                    <h5 class="modal-title" id="copraModalTitle">Transaction details</h5>
                    <p class="adm-copra-modal__subtitle" id="copraModalSubtitle">—</p>
                </div>
                <div class="adm-copra-modal__header-actions">
                    <button type="button" class="btn btn-print btnPrint" id="btnPrint">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button type="button" class="adm-copra-modal__close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <div id="copra_print_content">

                    <!-- Transaction info -->
                    <section class="adm-copra-modal__section">
                        <h6 class="adm-copra-modal__section-title"><i class="fas fa-file-invoice"></i> Transaction info</h6>
                        <div class="adm-copra-modal__grid adm-copra-modal__grid--4">
                            <div class="adm-copra-modal__field">
                                <label for="invoice">Invoice</label>
                                <input type="text" id="invoice" name="invoice" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field">
                                <label for="date">Date</label>
                                <input type="text" id="date" name="date" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field">
                                <label for="contract">Contract</label>
                                <input type="text" id="contract" name="contract" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--wide">
                                <label for="name">Seller</label>
                                <input type="text" id="name" name="name" class="form-control" readonly>
                            </div>
                            <input type="hidden" id="address" name="address">
                        </div>
                    </section>

                    <!-- Weights -->
                    <section class="adm-copra-modal__section">
                        <h6 class="adm-copra-modal__section-title"><i class="fas fa-weight-hanging"></i> Weights</h6>
                        <div class="adm-copra-modal__grid adm-copra-modal__grid--4">
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="sacks">
                                <label for="noSack">No. of sacks</label>
                                <input type="text" id="noSack" name="noSack" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="gross">Gross weight</label>
                                <input type="text" id="gross" name="gross" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="tare">Tare deduction</label>
                                <input type="text" id="tare" name="tare" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--highlight adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="net">Net weight</label>
                                <input type="text" id="net" name="net" class="form-control" readonly>
                            </div>
                        </div>
                    </section>

                    <!-- Quality adjustments -->
                    <section class="adm-copra-modal__section">
                        <h6 class="adm-copra-modal__section-title"><i class="fas fa-flask"></i> Quality adjustments</h6>
                        <div class="adm-copra-modal__grid adm-copra-modal__grid--3">
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="%">
                                <label for="dust">Dust</label>
                                <input type="text" id="dust" name="dust" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="new-dust">New dust</label>
                                <input type="text" id="new-dust" name="new-dust" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="total-dust">Total dust</label>
                                <input type="text" id="total-dust" name="total-dust" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field">
                                <label for="moisture">Moisture</label>
                                <input type="text" id="moisture" name="moisture" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field">
                                <label for="discount_reading">P / D reading</label>
                                <input type="text" id="discount_reading" name="discount_reading" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="total-moisture">Total moisture</label>
                                <input type="text" id="total-moisture" name="total-moisture" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--wide adm-copra-modal__field--highlight adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="total-res">Net resecada weight (total)</label>
                                <input type="text" id="total-res" name="total-res" class="form-control" readonly>
                            </div>
                        </div>
                    </section>

                    <!-- Resecada pricing -->
                    <section class="adm-copra-modal__section">
                        <h6 class="adm-copra-modal__section-title"><i class="fas fa-tags"></i> Resecada pricing</h6>

                        <div class="adm-copra-modal__resecada-row">
                            <span class="adm-copra-modal__resecada-label">1st resecada</span>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="1resecada">Price / kg</label>
                                <input type="text" id="1resecada" name="1resecada" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="1rese-weight">Weight</label>
                                <input type="text" id="1rese-weight" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="total_1res">Subtotal</label>
                                <input type="text" id="total_1res" name="total_1res" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="adm-copra-modal__resecada-row">
                            <span class="adm-copra-modal__resecada-label">2nd resecada</span>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="2resecada">Price / kg</label>
                                <input type="text" id="2resecada" name="2resecada" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__input-suffix" data-suffix="kg">
                                <label for="2rese-weight">Weight</label>
                                <input type="text" id="2rese-weight" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="total_2res">Subtotal</label>
                                <input type="text" id="total_2res" name="total_2res" class="form-control" readonly>
                            </div>
                        </div>
                    </section>

                    <!-- Payment summary -->
                    <section class="adm-copra-modal__section">
                        <h6 class="adm-copra-modal__section-title"><i class="fas fa-money-bill-wave"></i> Payment summary</h6>
                        <div class="adm-copra-modal__grid adm-copra-modal__grid--3">
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="total-amount">Total amount</label>
                                <input type="text" id="total-amount" name="total-amount" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="less">Less / cash advance</label>
                                <input type="text" id="less" name="less" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field">
                                <label for="tax">Withholding tax</label>
                                <input type="text" id="tax" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--money">
                                <label for="tax-amount">Tax amount</label>
                                <input type="text" id="tax-amount" class="form-control" readonly>
                            </div>
                            <div class="adm-copra-modal__field adm-copra-modal__field--wide adm-copra-modal__field--highlight adm-copra-modal__field--money">
                                <label for="amount-paid">Amount paid</label>
                                <input type="text" id="amount-paid" name="amount-paid" class="form-control" readonly>
                            </div>
                            <input type="hidden" id="total-paid" name="total-paid">
                            <input type="hidden" id="total-words" name="total-words">
                        </div>
                    </section>

                </div>
            </div>

            <div class="modal-footer">
                <div class="adm-copra-modal__footer-paid">
                    <span class="adm-copra-modal__footer-paid-label">Amount paid</span>
                    <span class="adm-copra-modal__footer-paid-value" id="copraModalAmountPaid">₱0</span>
                </div>
                <div class="adm-copra-modal__footer-actions">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete confirmation modal -->
<div class="modal fade adm-copra-delete" id="deleteRecord" tabindex="-1" aria-labelledby="deleteRecordTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRecordTitle">Delete record</h5>
                <button type="button" class="adm-copra-modal__close text-dark" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="function/copraDeleteRecord.php" method="POST">
                <div class="modal-body">
                    <div class="adm-copra-delete__icon"><i class="fas fa-trash-alt"></i></div>
                    <p class="adm-copra-delete__text">This will permanently delete the copra transaction. This action cannot be undone.</p>
                    <div class="adm-copra-delete__invoice" id="deleteInvoiceDisplay">—</div>
                    <input type="hidden" name="d_invoice" id="d_invoice">
                    <input type="hidden" name="d_id" id="d_id">
                    <input type="hidden" name="d_contract" id="d_contract">
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="remove" class="btn btn-danger btn-sm">Delete record</button>
                </div>
            </form>
        </div>
    </div>
</div>
