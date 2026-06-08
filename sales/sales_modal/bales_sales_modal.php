<?php
$today = date('Y-m-d');
?>

<!-- New Bale Sale -->
<div class="modal fade sales-modal" id="newWetExport" tabindex="-1" aria-labelledby="newBaleSaleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sales-modal-dialog--wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBaleSaleLabel">New Bale Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/bale_sales.php">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_date">Transaction Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" id="new_date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="new_recorded_by" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>" required>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_sale_type">Sale Type</label>
                            <select class="form-select form-select-sm" name="sale_type" id="new_sale_type" required>
                                <option value="" selected disabled>Select…</option>
                                <option value="EXPORT">Export</option>
                                <option value="LOCAL">Local</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_contract">EN Sale Contract</label>
                            <input type="text" class="form-control form-control-sm" name="contract" id="new_contract" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_purchase_contract">Purchase Contract</label>
                            <input type="text" class="form-control form-control-sm" name="purchase_contract" id="new_purchase_contract" required>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_buyer">Buyer Name</label>
                            <input type="text" class="form-control form-control-sm" name="sale_buyer" id="sale_buyer" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_quality">Quality</label>
                            <select class="form-select form-select-sm" name="quality" id="new_quality" required>
                                <option value="" disabled selected>Select…</option>
                                <option value="SPR5">5L / SPR-5</option>
                                <option value="SPR10">SPR-10</option>
                                <option value="SPR20">SPR-20</option>
                                <option value="Offcolor">Off Color</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_kilo">Kilo per Bale</label>
                            <select class="form-select form-select-sm" name="kilo_bale" id="new_kilo" required>
                                <option value="" selected disabled>Select…</option>
                                <option value="35">35.00 kg</option>
                                <option value="33.33">33.33 kg</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="sale_currency">Currency</label>
                            <select class="form-select form-select-sm" id="sale_currency" name="sale_currency" required>
                                <option value="" selected disabled>Choose…</option>
                                <option value="PHP">PHP ₱</option>
                                <option value="USD">USD $</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="contract_price">Price per Kilo</label>
                            <input type="number" class="form-control form-control-sm contract_price" name="contract_price" id="contract_price" step="0.01" required>
                        </div>
                        <div class="col-12 sales-field">
                            <label for="new_remarks">Remarks</label>
                            <input type="text" class="form-control form-control-sm" name="remarks" id="new_remarks" placeholder="Optional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new" class="btn btn-sm btn-success">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Bale Sale Record -->
<div class="modal fade sales-modal" id="viewSalesRecord" tabindex="-1" aria-labelledby="viewBaleSaleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBaleSaleLabel">Bale Sale Record</h5>
                <div class="sales-modal-actions ms-auto me-2">
                    <button type="button" class="btn btn-sm btn-light btnPrint" id="btnPrint"><i class="fas fa-print"></i> Print</button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/bale_sales.php">
                <div class="modal-body sales-modal-body--compact">
                    <div id="print_content">
                        <ul class="nav nav-tabs sales-modal-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="bale-tab-contract" data-bs-toggle="tab" data-bs-target="#bale-pane-contract" type="button" role="tab">Contract</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bale-tab-volume" data-bs-toggle="tab" data-bs-target="#bale-pane-volume" type="button" role="tab">Volume &amp; Cost</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bale-tab-payment" data-bs-toggle="tab" data-bs-target="#bale-pane-payment" type="button" role="tab">Payment &amp; Profit</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Contract -->
                            <div class="tab-pane fade show active sales-modal-pane" id="bale-pane-contract" role="tabpanel">
                                <div class="row g-2 sales-modal-grid">
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_sale_id">Sales ID</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_id" name="sale_id">
                                    </div>
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_sale_contract">EN Contract</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_contract">
                                    </div>
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_purchase_contract">Purchase Contract</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_purchase_contract">
                                    </div>
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_sale_type">Sale Type</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_type">
                                    </div>
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_contract_quality">Quality</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_contract_quality">
                                    </div>
                                    <div class="col-4 col-md-2 sales-field">
                                        <label for="v_trans_date">Transaction Date</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_trans_date">
                                    </div>
                                    <div class="col-6 col-md-3 sales-field">
                                        <label for="v_sale_buyer">Buyer</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_buyer">
                                    </div>
                                    <div class="col-6 col-md-3 sales-field">
                                        <label for="v_shipping_date">Shipping Date</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_shipping_date">
                                    </div>
                                    <div class="col-6 col-md-2 sales-field">
                                        <label for="v_sale_source">Source</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_source">
                                    </div>
                                    <div class="col-6 col-md-2 sales-field">
                                        <label for="v_sale_destination">Destination</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_sale_destination">
                                    </div>
                                    <div class="col-6 col-md-2 sales-field">
                                        <label for="v_contract_container">Containers</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_contract_container">
                                    </div>
                                    <div class="col-6 col-md-3 sales-field sales-field--currency">
                                        <label for="v_contract_quantity">Quantity <span class="sales-field__suffix">kg</span></label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_contract_quantity">
                                    </div>
                                    <div class="col-6 col-md-2 sales-field">
                                        <label for="v_currency">Currency</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_currency">
                                    </div>
                                    <div class="col-6 col-md-3 sales-field sales-field--currency">
                                        <label for="v_contract_price">Price / Kilo</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text" id="currency_selected_price"></span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_contract_price">
                                        </div>
                                    </div>
                                    <div class="col-12 sales-field">
                                        <label for="v_other_terms">Other Terms</label>
                                        <input type="text" readonly class="form-control form-control-sm" name="other_terms" id="v_other_terms">
                                    </div>
                                </div>
                            </div>

                            <!-- Volume -->
                            <div class="tab-pane fade sales-modal-pane" id="bale-pane-volume" role="tabpanel">
                                <div class="sales-modal-section__row">
                                    <p class="sales-modal-section">Bale Volume &amp; Costing</p>
                                    <button type="button" id="btnContainer" class="btn btn-sm btn-outline-warning btnContainer"><i class="fas fa-box"></i> Select Container</button>
                                </div>
                                <div id="container_selected" class="sales-modal-table-wrap"></div>
                                <div class="sales-modal-summary">
                                    <div class="sales-field" hidden>
                                        <label for="v_number_container">Containers</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_number_container">
                                    </div>
                                    <div class="sales-field">
                                        <label for="v_total_num_bales">Total Bales</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_total_num_bales">
                                    </div>
                                    <div class="sales-field sales-field--currency">
                                        <label for="v_total_bale_weight">Total Weight <span class="sales-field__suffix">kg</span></label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_total_bale_weight">
                                    </div>
                                    <div class="sales-field sales-field--currency">
                                        <label for="v_overall_ave_kiloCost">Avg Cost / Kilo</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">≈ ₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_overall_ave_kiloCost">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="tab-pane fade sales-modal-pane" id="bale-pane-payment" role="tabpanel">
                                <div class="sales-modal-section__row">
                                    <p class="sales-modal-section">Payment Details</p>
                                    <button type="button" id="addPayment" class="btn btn-sm btn-outline-warning addPayment"><i class="fas fa-money-bill"></i> Add Payment</button>
                                </div>
                                <div class="sales-modal-summary">
                                    <div class="sales-field sales-field--currency">
                                        <label for="v_total_sale">Total Sales</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text" id="currency_selected_sales"></span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_total_sale">
                                        </div>
                                    </div>
                                    <div class="sales-field sales-field--currency">
                                        <label for="v_amount_paid">Amount Paid</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text" id="currency_selected_paid"></span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_amount_paid">
                                        </div>
                                    </div>
                                    <div class="sales-field sales-field--currency">
                                        <label for="v_unpaid_balance">Unpaid Balance</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text" id="currency_selected_balance"></span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_unpaid_balance">
                                        </div>
                                    </div>
                                </div>
                                <div id="payment_list_table" class="sales-modal-table-wrap"></div>

                                <p class="sales-modal-section">Sale Proceeds &amp; Profit</p>
                                <div class="row g-2 sales-modal-grid">
                                    <div class="col-6 col-md-3 sales-field sales-field--currency">
                                        <label for="v_sales_proceeds">Sale Proceeds</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_sales_proceeds">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 sales-field">
                                        <label for="v_tax_rate">Tax Rate <span class="sales-field__suffix">%</span></label>
                                        <input type="text" readonly class="form-control form-control-sm" id="v_tax_rate">
                                    </div>
                                    <div class="col-6 col-md-3 sales-field sales-field--currency">
                                        <label for="v_tax_amount">Withholding Tax</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_tax_amount">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 sales-field sales-field--currency">
                                        <label for="v_total_bale_cost">Bale Cost</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_total_bale_cost">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 sales-field sales-field--currency">
                                        <label for="v_total_milling_cost">Milling Cost</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_total_milling_cost">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 sales-field sales-field--currency">
                                        <label for="v_total_ship_exp">Ship Expense</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_total_ship_exp">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 sales-field sales-field--currency">
                                        <label for="v_over_all_cost">Overall Cost</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_over_all_cost">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 sales-field sales-field--highlight">
                                        <label for="v_gross_profit">Gross Profit / Loss</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" readonly class="form-control form-control-sm" id="v_gross_profit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="editBtn" name="edit" class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
