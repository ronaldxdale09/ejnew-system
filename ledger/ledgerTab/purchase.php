<?php
$source = $_SESSION['loc'] ?? '';
$categories_query = mysqli_query($con, "SELECT DISTINCT category FROM ledger_purchase WHERE location='" . mysqli_real_escape_string($con, $source) . "'");
$categories = mysqli_fetch_all($categories_query, MYSQLI_ASSOC);
$category_totals = [];
$overall_total = 0;
foreach ($categories as $category) {
    $category_name = mysqli_real_escape_string($con, $category['category']);
    $total_query = mysqli_query($con, "SELECT COALESCE(SUM(total_amount),0) AS category_total FROM ledger_purchase WHERE category='{$category_name}' AND location='" . mysqli_real_escape_string($con, $source) . "'");
    $result = mysqli_fetch_array($total_query);
    $category_totals[$category['category']] = (float) ($result['category_total'] ?? 0);
    $overall_total += $category_totals[$category['category']];
}
?>
<div class="ledger-toolbar mb-3">
    <div class="ledger-toolbar__actions">
        <button type="button" class="ledger-btn ledger-btn--primary" data-bs-toggle="modal" data-bs-target="#purchase-modal">
            <i class="fas fa-plus"></i> Add Purchase
        </button>
    </div>
    <div class="ledger-toolbar__filters">
        <div class="ledger-filter-field">
            <label>Quick range</label>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle w-100" type="button" id="dateDropdown" data-bs-toggle="dropdown">
                    Select range
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" type="button" id="today">Today</button></li>
                    <li><button class="dropdown-item" type="button" id="this-week">This Week</button></li>
                    <li><button class="dropdown-item" type="button" id="this-month">This Month</button></li>
                </ul>
            </div>
        </div>
        <div class="ledger-filter-field">
            <label for="category_filter">Category</label>
            <select class="form-select form-select-sm" id="category_filter">
                <option value="" selected>All categories</option>
                <?php echo $purCatList; ?>
            </select>
        </div>
        <div class="ledger-filter-field">
            <label for="min">From</label>
            <input type="text" id="min" class="form-control form-control-sm datepicker" placeholder="yyyy-mm-dd" autocomplete="off">
        </div>
        <div class="ledger-filter-field">
            <label for="max">To</label>
            <input type="text" id="max" class="form-control form-control-sm datepicker" placeholder="yyyy-mm-dd" autocomplete="off">
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-9">
        <div class="table-responsive">
            <table class="table table-hover w-100" id="purchase_table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Voucher</th>
                        <th>Category</th>
                        <th>Customer</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Net Kg</th>
                        <th class="text-end">Net Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ledger-cat-panel">
            <div class="ledger-cat-panel__head">Category Breakdown</div>
            <div class="ledger-cat-panel__body">
                <?php if (empty($category_totals)): ?>
                    <p class="text-muted small mb-0">No purchase data yet.</p>
                <?php else: ?>
                    <?php foreach ($category_totals as $category => $total):
                        $pct = $overall_total > 0 ? ($total / $overall_total) * 100 : 0;
                    ?>
                    <div class="ledger-cat-panel__item">
                        <div class="ledger-cat-panel__row">
                            <span><?php echo adm_esc($category); ?></span>
                            <strong><?php echo adm_peso($total, 0); ?></strong>
                        </div>
                        <div class="progress ledger-cat-panel__bar">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo round($pct, 1); ?>%;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="js/ledger-purchase.js?v=<?php echo filemtime(__DIR__ . '/../js/ledger-purchase.js'); ?>"></script>
