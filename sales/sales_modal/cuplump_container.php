<?php
$today = date('Y-m-d');
?>

<!-- New Container Modal -->
<div class="modal fade sales-modal" id="newContainer" tabindex="-1" aria-labelledby="newCuplumpContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered sales-modal-dialog--wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCuplumpContainerLabel">New Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/cuplump_container.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_van_no">Van No.</label>
                            <input type="text" class="form-control form-control-sm" name="van_no" id="new_van_no" tabindex="7" autocomplete="off">
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_loading_date">Loading Date</label>
                            <input type="date" class="form-control form-control-sm" name="date" id="new_loading_date" value="<?php echo $today; ?>">
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="ship_user">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="ship_user" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>" tabindex="7" autocomplete="off">
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="new_location">Location</label>
                            <input type="text" class="form-control form-control-sm" name="location" id="new_location" value="<?php echo htmlspecialchars(trim($_SESSION['loc'] ?? $_SESSION['source'] ?? ''), ENT_QUOTES); ?>" required>
                        </div>
                        <div class="col-12 sales-field">
                            <label for="new_remarks">Remarks</label>
                            <input type="text" class="form-control form-control-sm" name="remarks" id="new_remarks" autocomplete="off" placeholder="Optional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success" name="add">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Container Modal -->
<div class="modal fade sales-modal" id="viewContainer" tabindex="-1" aria-labelledby="viewCuplumpContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCuplumpContainerLabel">Container Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/cuplump_container.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-2 sales-field">
                            <label for="v_id">Container ID</label>
                            <input type="text" class="form-control form-control-sm" id="v_id" name="id" tabindex="7" autocomplete="off" readonly>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="v_van_no">Van No.</label>
                            <input type="text" class="form-control form-control-sm" id="v_van_no" readonly>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="v_location">Location</label>
                            <input type="text" class="form-control form-control-sm" id="v_location" readonly>
                        </div>
                        <div class="col-6 col-md-3 sales-field">
                            <label for="v_date">Loading Date</label>
                            <input type="text" class="form-control form-control-sm" id="v_date" readonly>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="v_recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" id="v_recorded_by" tabindex="7" autocomplete="off" readonly>
                        </div>
                        <div class="col-12 sales-field">
                            <label for="v_remarks">Remarks</label>
                            <input type="text" class="form-control form-control-sm" id="v_remarks" autocomplete="off" readonly>
                        </div>
                    </div>

                    <p class="sales-modal-section">Container Records</p>
                    <div id="container_details" class="sales-modal-table-wrap"></div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="viewContainerEditLink" class="btn btn-sm btn-warning"><i class="fas fa-pencil"></i> Open to Edit</a>
                    <button type="submit" id="editBtn" name="edit" class="btn btn-sm btn-outline-warning" style="display:none;"><i class="fas fa-pencil"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
