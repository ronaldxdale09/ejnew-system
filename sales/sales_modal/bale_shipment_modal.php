<?php
$today = date('Y-m-d');
?>

<!-- New Bale Shipment -->
<div class="modal fade sales-modal" id="newShipment" tabindex="-1" aria-labelledby="newBaleShipmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sales-modal-dialog--wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBaleShipmentLabel">New Bales Shipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/bale_shipment.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_ship_type">Type</label>
                            <select class="form-select form-select-sm" name="type" id="new_ship_type" required>
                                <option value="" selected disabled>Select…</option>
                                <option value="EXPORT">Export</option>
                                <option value="LOCAL">Local</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_ship_date">Shipment Date</label>
                            <input type="date" class="form-control form-control-sm" name="n_date" id="new_ship_date" value="<?php echo $today; ?>" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_ship_source">Source</label>
                            <input type="text" class="form-control form-control-sm" name="source" id="new_ship_source" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_ship_destination">Destination</label>
                            <input type="text" class="form-control form-control-sm" name="destination" id="new_ship_destination" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="new_ship_buyer">Particular / Buyer</label>
                            <input type="text" class="form-control form-control-sm" name="n_buyer" id="new_ship_buyer" required>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="new_ship_recorded">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="new_ship_recorded" autocomplete="off" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>">
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
<div class="modal fade sales-modal" id="containerModal" tabindex="-1" aria-labelledby="baleContainerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="baleContainerModalLabel">Selected Inventory</h5>
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

<!-- Bale Shipment Record -->
<div class="modal fade sales-modal" id="baleShipmentModal" tabindex="-1" aria-labelledby="baleShipmentRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="baleShipmentRecordLabel">Bale Shipment Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/bale_shipment.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <input type="text" class="form-control form-control-sm" id="v_ship_id" name="ship_id" autocomplete="off" hidden>

                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_type">Type</label>
                            <input type="text" class="form-control form-control-sm" id="v_type" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_source">Source</label>
                            <input type="text" class="form-control form-control-sm" id="v_source" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_destination">Destination</label>
                            <input type="text" class="form-control form-control-sm" id="v_destination" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_date">Shipment Date</label>
                            <input type="text" class="form-control form-control-sm" id="v_date" readonly>
                        </div>
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_vessel">Vessel</label>
                            <input type="text" class="form-control form-control-sm" id="v_vessel" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_bill_lading">Bill of Lading</label>
                            <input type="text" class="form-control form-control-sm" id="v_bill_lading" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="v_remarks">Remarks</label>
                            <input type="text" class="form-control form-control-sm" id="v_remarks" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="v_recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" id="v_recorded_by" autocomplete="off" readonly>
                        </div>
                    </div>

                    <p class="sales-modal-section">Container Records</p>
                    <div id="shipment_container_record" class="sales-modal-table-wrap"></div>

                    <div class="sales-modal-summary">
                        <div class="sales-field">
                            <label for="v_total_num_bales">No. of Bales</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="v_total_num_bales" tabindex="7" autocomplete="off" readonly>
                                <span class="input-group-text">pcs</span>
                            </div>
                        </div>
                        <div class="sales-field sales-field--currency">
                            <label for="v_total_bale_weight">Total Bale Weight <span class="sales-field__suffix">kg</span></label>
                            <input type="text" class="form-control form-control-sm" id="v_total_bale_weight" tabindex="7" autocomplete="off" readonly>
                        </div>
                        <div class="sales-field sales-field--currency" hidden>
                            <label for="v_total_bale_cost">Total Bale Cost</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_total_bale_cost" tabindex="7" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>

                    <p class="sales-modal-section">Shipping Expenses</p>
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_freight">Freight (All In)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_freight" readonly>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_loading">Loading &amp; Unloading</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_loading" readonly>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_processing">Processing Fee (Phytosanitary)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_processing" readonly>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_trucking">Trucking Expense</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_trucking" readonly>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_cranage">Cranage Fee (Arrastre)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_cranage" readonly>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 sales-field sales-field--currency">
                            <label for="v_ship_exp_misc">Miscellaneous Expenses</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_exp_misc" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="sales-modal-summary">
                        <div class="sales-field sales-field--currency sales-field--highlight">
                            <label for="v_total_ship_exp">Total Shipping Expense</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_total_ship_exp" readonly>
                            </div>
                        </div>
                        <div class="sales-field">
                            <label for="v_number_container">No. of Containers</label>
                            <input type="text" class="form-control form-control-sm" id="v_number_container" readonly>
                        </div>
                        <div class="sales-field sales-field--currency">
                            <label for="v_ship_cost_per_container">Shipping Expense per Container</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm" id="v_ship_cost_per_container" placeholder="0.00" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-warning" name="edit" id="editButton"><i class="fas fa-pencil"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
