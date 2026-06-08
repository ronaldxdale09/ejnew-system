<?php
$today = date('Y-m-d');
?>

<!-- New Cuplump Shipment -->
<div class="modal fade sales-modal" id="newShipment" tabindex="-1" aria-labelledby="newCuplumpShipmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sales-modal-dialog--wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCuplumpShipmentLabel">New Cuplump Shipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/cuplump_shipment.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_cuplump_type">Type</label>
                            <select class="form-select form-select-sm" name="type" id="new_cuplump_type" required>
                                <option value="" selected disabled>Select…</option>
                                <option value="EXPORT">Export</option>
                                <option value="LOCAL">Local</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_cuplump_date">Shipment Date</label>
                            <input type="date" class="form-control form-control-sm" name="n_date" id="new_cuplump_date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_cuplump_source">Source</label>
                            <input type="text" class="form-control form-control-sm" name="source" id="new_cuplump_source" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_cuplump_destination">Destination</label>
                            <input type="text" class="form-control form-control-sm" name="destination" id="new_cuplump_destination" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="new_cuplump_particular">Particular</label>
                            <input type="text" class="form-control form-control-sm" name="particular" id="new_cuplump_particular" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_cuplump_recorded">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="new_cuplump_recorded" autocomplete="off" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>">
                        </div>
                        <div class="col-12 sales-field">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control form-control-sm" name="remarks" id="remarks" autocomplete="off" placeholder="Optional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success" name="new">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Container Selection Modal -->
<div class="modal fade sales-modal" id="containerModal" tabindex="-1" aria-labelledby="containerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="containerModalLabel">Select Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body sales-modal-body--compact">
                <div id="container_list" class="sales-modal-table-wrap"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Cuplump Shipment Record -->
<div class="modal fade sales-modal" id="cuplumpShipmentModal" tabindex="-1" aria-labelledby="cuplumpShipmentRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cuplumpShipmentRecordLabel">Cuplump Shipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/cuplump_shipment.php" method="POST">
                <div id="print_content">
                    <div class="modal-body sales-modal-body--compact">
                        <input type="text" class="form-control form-control-sm" id="v_ship_id" name="ship_id" hidden autocomplete="off">

                        <div class="row g-2 sales-modal-grid">
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_type">Type</label>
                                <input type="text" class="form-control form-control-sm" id="v_type" readonly>
                            </div>
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_date">Shipment Date</label>
                                <input type="date" class="form-control form-control-sm" id="v_date" readonly>
                            </div>
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_destination">Destination</label>
                                <input type="text" class="form-control form-control-sm" id="v_destination" readonly>
                            </div>
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_source">Source</label>
                                <input type="text" class="form-control form-control-sm" id="v_source" readonly>
                            </div>
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_vessel">Vessel</label>
                                <input type="text" class="form-control form-control-sm" id="v_vessel" readonly>
                            </div>
                            <div class="col-6 col-md-2 sales-field">
                                <label for="v_info_lading">Bill of Lading</label>
                                <input type="text" class="form-control form-control-sm" id="v_info_lading" readonly>
                            </div>
                            <div class="col-6 col-md-6 sales-field">
                                <label for="v_remarks">Remarks</label>
                                <input type="text" class="form-control form-control-sm" id="v_remarks" readonly>
                            </div>
                            <div class="col-6 col-md-3 sales-field">
                                <label for="v_recorded_by">Recorded By</label>
                                <input type="text" class="form-control form-control-sm" id="v_recorded_by" readonly>
                            </div>
                        </div>

                        <p class="sales-modal-section">Container Records</p>
                        <div id="shipment_container_record" class="sales-modal-table-wrap"></div>

                        <p class="sales-modal-section">Shipping Expenses</p>
                        <div class="row g-2 sales-modal-grid">
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_freight">Freight (All In)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="freight" id="ship_exp_freight" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_loading">Loading &amp; Unloading</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="loading_expense" id="ship_exp_loading" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_processing">Processing Fee (Phytosanitary)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="ship_exp_processing" id="ship_exp_processing" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_trucking">Trucking Expense</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="ship_exp_trucking" id="ship_exp_trucking" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_cranage">Cranage Fee (Arrastre)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="ship_exp_cranage" id="ship_exp_cranage" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 sales-field sales-field--currency">
                                <label for="ship_exp_misc">Miscellaneous Expenses</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="ship_exp_misc" id="ship_exp_misc" placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="sales-modal-summary">
                            <div class="sales-field sales-field--currency">
                                <label for="total-cuplump-weight">Total Cuplump Weight <span class="sales-field__suffix">kg</span></label>
                                <input type="text" class="form-control form-control-sm" name="total_cuplump_weight" id="total-cuplump-weight" tabindex="7" autocomplete="off" readonly>
                            </div>
                            <div class="sales-field sales-field--currency sales-field--highlight">
                                <label for="total_ship_exp">Total Shipping Expense</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="total_ship_exp" id="total_ship_exp" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="sales-field">
                                <label for="number_container">No. of Containers</label>
                                <input type="text" class="form-control form-control-sm" name="number_container" id="number_container" placeholder="0.00" readonly>
                            </div>
                            <div class="sales-field sales-field--currency">
                                <label for="ship_cost_per_container">Shipping Expense per Container</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control form-control-sm" name="ship_cost_per_container" id="ship_cost_per_container" placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="editBtn" name="edit" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
