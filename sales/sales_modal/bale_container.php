<?php
$today = date('Y-m-d');
?>

<!-- View Container Modal -->
<div class="modal fade sales-modal" id="viewContainer" tabindex="-1" aria-labelledby="viewBaleContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBaleContainerLabel">Container Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="text" class="form-control form-control-sm" id="v_id" name="id" readonly hidden>
            <div class="modal-body sales-modal-body--compact">
                <div class="row g-2 sales-modal-grid">
                    <div class="col-6 col-md-3 sales-field">
                        <label for="v_van">Van No.</label>
                        <input type="text" class="form-control form-control-sm" id="v_van" tabindex="7" autocomplete="off" readonly>
                    </div>
                    <div class="col-6 col-md-3 sales-field">
                        <label for="v_date">Withdrawal Date</label>
                        <input type="text" class="form-control form-control-sm" id="v_date" readonly>
                    </div>
                    <div class="col-6 col-md-3 sales-field">
                        <label for="v_kilo">Bale Quality</label>
                        <input type="text" class="form-control form-control-sm" id="v_kilo" tabindex="7" autocomplete="off" readonly>
                    </div>
                    <div class="col-6 col-md-3 sales-field">
                        <label for="v_recorded">Recorded By</label>
                        <input type="text" class="form-control form-control-sm" id="v_recorded" tabindex="7" autocomplete="off" readonly>
                    </div>
                    <div class="col-12 sales-field">
                        <label for="v_remarks">Particulars</label>
                        <input type="text" class="form-control form-control-sm" id="v_remarks" tabindex="7" autocomplete="off" readonly>
                    </div>
                </div>

                <p class="sales-modal-section">Bale Records</p>
                <div id="bales_container_record" class="sales-modal-table-wrap"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
