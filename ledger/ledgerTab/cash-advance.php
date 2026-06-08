<div class="ledger-toolbar mb-3">
    <div class="ledger-toolbar__actions">
        <button type="button" class="ledger-btn ledger-btn--primary" data-bs-toggle="modal" data-bs-target="#cashadvanceModal">
            <i class="fas fa-plus"></i> Add Cash Advance
        </button>
    </div>
    <div class="ledger-toolbar__filters">
        <div class="ledger-filter-field">
            <label for="filterCategory">Category</label>
            <select class="form-select form-select-sm" id="filterCategory">
                <option value="">All Categories</option>
                <?php
                $res = mysqli_query($con, 'SELECT DISTINCT category FROM ledger_cashadvance ORDER BY category');
                while ($cat = mysqli_fetch_array($res)) {
                    echo '<option value="' . adm_esc($cat['category']) . '">' . adm_esc($cat['category']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="ledger-filter-field ledger-filter-field--sm">
            <label for="filterMonth">Month</label>
            <select id="filterMonth" class="form-select form-select-sm">
                <option value="">All Months</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo '<option value="' . $i . '">' . date('F', mktime(0, 0, 0, $i, 10)) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="ledger-filter-field">
            <label for="startDate">From</label>
            <input type="date" id="startDate" class="form-control form-control-sm">
        </div>
        <div class="ledger-filter-field">
            <label for="endDate">To</label>
            <input type="date" id="endDate" class="form-control form-control-sm">
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover w-100" id="ca_table">
        <thead>
            <tr>
                <th>Voucher #</th>
                <th>Date</th>
                <th>Particular</th>
                <th>Station</th>
                <th>Category</th>
                <th class="text-end">Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script src="js/ledger-cash-advance.js?v=<?php echo file_exists(__DIR__ . '/../js/ledger-cash-advance.js') ? filemtime(__DIR__ . '/../js/ledger-cash-advance.js') : '1'; ?>"></script>
