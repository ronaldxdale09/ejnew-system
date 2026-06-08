<?php
$sql = "SELECT id, seller FROM rubber_transaction";
$result = mysqli_query($con, $sql);
$listPurchased = '';
while ($arr = mysqli_fetch_assoc($result)) {
    $invoice = htmlspecialchars($arr['id'], ENT_QUOTES);
    $seller = htmlspecialchars($arr['seller'], ENT_QUOTES);
    $listPurchased .= '<option value="' . $arr['id'] . '">INVOICE #' . $invoice . ' - ' . $seller . '</option>';
}
?>

<div class="modal fade plantation-modal" id="transactionReportModal" tabindex="-1" aria-labelledby="transactionReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionReportLabel">Transaction Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="plantation-modal-section">Record Details</p>
                <div class="row g-2 g-md-3 plantation-modal-grid">
                    <div class="col-6 col-md-3 plantation-field">
                        <label for="recording_id">ID</label>
                        <input readonly type="text" id="recording_id" class="form-control form-control-sm">
                    </div>
                    <div class="col-6 col-md-3 plantation-field">
                        <label for="record_supplier">Supplier</label>
                        <input readonly type="text" id="record_supplier" class="form-control form-control-sm">
                    </div>
                    <div class="col-6 col-md-3 plantation-field">
                        <label for="record_loc">Location</label>
                        <input readonly type="text" id="record_loc" class="form-control form-control-sm">
                    </div>
                    <div class="col-6 col-md-3 plantation-field">
                        <label for="record_lot">Lot No.</label>
                        <input readonly type="text" id="record_lot" class="form-control form-control-sm">
                    </div>
                    <div class="col-6 col-md-6 plantation-field">
                        <label for="record_driver">Driver</label>
                        <input readonly type="text" id="record_driver" class="form-control form-control-sm">
                    </div>
                    <div class="col-6 col-md-6 plantation-field">
                        <label for="record_truck">Truck No.</label>
                        <input readonly type="text" id="record_truck" class="form-control form-control-sm">
                    </div>
                </div>

                <p class="plantation-modal-section">Processing Timeline</p>
                <div class="row g-2 plantation-modal-grid">
                    <div class="col-12 col-sm-6 plantation-field">
                        <label for="date_purchased">Date Purchased</label>
                        <input readonly type="text" id="date_purchased" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="wet_weight">Cuplump Weight <span class="plantation-field__suffix">kg</span></label>
                        <input readonly type="text" id="wet_weight" class="form-control form-control-sm text-end">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field">
                        <label for="date_received">Date Received</label>
                        <input readonly type="text" id="date_received" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="reweight">Reweight <span class="plantation-field__suffix">kg</span></label>
                        <input readonly type="text" id="reweight" class="form-control form-control-sm text-end">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field">
                        <label for="milling_date">Date Milled</label>
                        <input readonly type="text" id="milling_date" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="crumbed_weight">Crumbed Weight <span class="plantation-field__suffix">kg</span></label>
                        <input readonly type="text" id="crumbed_weight" class="form-control form-control-sm text-end">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field">
                        <label for="dry_date">Date Dried</label>
                        <input readonly type="text" id="dry_date" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="dry_weight">Blanket Weight <span class="plantation-field__suffix">kg</span></label>
                        <input readonly type="text" id="dry_weight" class="form-control form-control-sm text-end">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field">
                        <label for="production_date">Date Produced</label>
                        <input readonly type="text" id="production_date" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="bale_weight">Bale Weight <span class="plantation-field__suffix">kg</span></label>
                        <input readonly type="text" id="bale_weight" class="form-control form-control-sm text-end">
                    </div>
                    <div class="col-12 col-sm-6 plantation-field plantation-field--unit">
                        <label for="drc">DRC <span class="plantation-field__suffix">%</span></label>
                        <input readonly type="text" id="drc" class="form-control form-control-sm text-end">
                    </div>
                </div>

                <p class="plantation-modal-section">Bale Production</p>
                <div id="pressing_modal_update_table" class="plantation-modal-table-wrap table-responsive"></div>

                <div class="d-none" aria-hidden="true">
                    <div id="milling_record"></div>
                    <div id="dry_table_record"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
