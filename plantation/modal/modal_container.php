<?php
$today = date('Y-m-d');
?>

<div class="modal fade plantation-modal" id="newContainer" tabindex="-1" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">New Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/container.php" method="POST">
                <div class="modal-body">
                    <div class="row g-2 plantation-modal-grid">
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="n_van">Van No.</label>
                            <input type="text" class="form-control form-control-sm" name="van_no" id="n_van" autocomplete="off" required>
                        </div>
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="date">Withdrawal Date</label>
                            <input type="date" class="form-control form-control-sm" id="date" value="<?php echo $today; ?>" name="n_date" required>
                        </div>
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="n_remarks">Particulars (Buyer)</label>
                            <input type="text" class="form-control form-control-sm" name="remarks" id="n_remarks" autocomplete="off">
                        </div>
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="n_recorded">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded" id="n_recorded" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>" required>
                        </div>
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="n_quality">Quality</label>
                            <select class="form-select form-select-sm" name="quality" id="n_quality" required>
                                <option disabled selected value="">Select quality…</option>
                                <option value="SPR5">5L</option>
                                <option value="SPR5">SPR-5</option>
                                <option value="SPR10">SPR-10</option>
                                <option value="SPR20">SPR-20</option>
                                <option value="Offcolor">Off Color</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 plantation-field">
                            <label for="n_kilo_bale">Kilo per Bale</label>
                            <select class="form-select form-select-sm" name="kilo_bale" id="n_kilo_bale" required>
                                <option disabled selected value="">Select kilo…</option>
                                <option value="35kg">35.00 kg</option>
                                <option value="33.33kg">33.33 kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="plantation-notice mt-3 mb-0" role="note">
                        <div><strong>Reminder:</strong> Double-check all data before proceeding.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="new">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade plantation-modal" id="viewContainer" tabindex="-1" aria-labelledby="viewContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewContainerLabel">Container Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/container.php" method="POST">
                <input type="hidden" id="v_id" name="id">
                <div class="modal-body">
                    <div class="row g-2 plantation-modal-grid">
                        <div class="col-6 col-md-3 plantation-field">
                            <label for="v_van">Van No.</label>
                            <input type="text" class="form-control form-control-sm" id="v_van" readonly>
                        </div>
                        <div class="col-6 col-md-3 plantation-field">
                            <label for="v_date">Withdrawal Date</label>
                            <input type="text" class="form-control form-control-sm" id="v_date" readonly>
                        </div>
                        <div class="col-6 col-md-3 plantation-field">
                            <label for="v_quality">Quality</label>
                            <input type="text" class="form-control form-control-sm" id="v_quality" readonly>
                        </div>
                        <div class="col-6 col-md-3 plantation-field">
                            <label for="v_kilo">Kilo per Bale</label>
                            <input type="text" class="form-control form-control-sm" id="v_kilo" readonly>
                        </div>
                        <div class="col-12 col-md-6 plantation-field">
                            <label for="v_remarks">Particulars</label>
                            <input type="text" class="form-control form-control-sm" id="v_remarks" readonly>
                        </div>
                        <div class="col-12 col-md-6 plantation-field">
                            <label for="v_recorded">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" id="v_recorded" readonly>
                        </div>
                    </div>
                    <p class="plantation-modal-section">Bales in Container</p>
                    <div id="bales_container_record" class="plantation-modal-table-wrap"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-warning" id="editButton" name="edit"><i class="fas fa-pen"></i> Edit</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="releaseButton" name="released"><i class="fas fa-shipping-fast"></i> Release</button>
                </div>
            </form>
        </div>
    </div>
</div>
