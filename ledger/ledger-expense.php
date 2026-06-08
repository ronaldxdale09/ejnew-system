<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/expense/data.php';

$source = $_SESSION['loc'] ?? '';
$kpis = ledger_expense_kpis($con, $source);
$categories = ledger_expense_categories($con, $source);
$expenseTypes = ledger_expense_types();
?>

<div class="main-content admin-page ledger-page">
    <?php adm_page_header(
        'Expense Record',
        'Record and track daily expenses — filter by type, category, or date range.',
        array_filter([$source ? trim($source) : null, 'Finance'])
    ); ?>

    <div class="adm-kpi-grid adm-kpi-grid--strip" id="ledgerExpenseKpis">
        <div class="adm-kpi">
            <div class="adm-kpi__label">Today</div>
            <div class="adm-kpi__value" id="ledgerKpiToday"><?php echo adm_peso($kpis['today'], 0); ?></div>
            <div class="adm-kpi__sub" id="ledgerKpiTodaySub"><?php echo (int) $kpis['count_today']; ?> record<?php echo $kpis['count_today'] === 1 ? '' : 's'; ?> today</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo adm_esc($kpis['month_label']); ?> Total</div>
            <div class="adm-kpi__value" id="ledgerKpiMonth"><?php echo adm_peso($kpis['month'], 0); ?></div>
            <div class="adm-kpi__sub">This month</div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label"><?php echo adm_esc($kpis['year_label']); ?> Total</div>
            <div class="adm-kpi__value" id="ledgerKpiYear"><?php echo adm_peso($kpis['year'], 0); ?></div>
            <div class="adm-kpi__sub">Year to date</div>
        </div>
    </div>

    <?php adm_panel_open('Transactions'); ?>

    <div class="ledger-toolbar">
        <div class="ledger-toolbar__actions">
            <button type="button" class="ledger-btn ledger-btn--primary" data-bs-toggle="modal" data-bs-target="#addExpense">
                <i class="fas fa-plus"></i> New Expense
            </button>
            <button type="button" class="ledger-btn ledger-btn--ghost" data-bs-toggle="modal" data-bs-target="#categoryModal" title="Manage categories">
                <i class="fas fa-tags"></i>
            </button>
        </div>
        <div class="ledger-toolbar__filters">
            <div class="ledger-filter-field ledger-filter-field--sm">
                <label for="monthFilter">Month</label>
                <select class="form-select form-select-sm" id="monthFilter">
                    <option value="">All months</option>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1)); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="ledger-filter-field ledger-filter-field--sm">
                <label for="yearFilter">Year</label>
                <select class="form-select form-select-sm" id="yearFilter">
                    <option value="">All years</option>
                    <?php for ($y = 2022; $y <= (int) date('Y'); $y++): ?>
                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="ledger-filter-field">
                <label for="typeFilter">Type</label>
                <select class="form-select form-select-sm" id="typeFilter">
                    <option value="">All types</option>
                    <?php foreach ($expenseTypes as $val => $label): ?>
                        <option value="<?php echo adm_esc($val); ?>"><?php echo adm_esc($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="ledger-filter-field">
                <label for="categoryFilter">Category</label>
                <select class="form-select form-select-sm" id="categoryFilter">
                    <option value="">All categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo adm_esc($cat['category']); ?>"><?php echo adm_esc($cat['category']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="ledger-filter-field ledger-filter-field--sm">
                <label for="fromDate">From</label>
                <input type="text" class="form-control form-control-sm datepicker" id="fromDate" placeholder="yyyy-mm-dd" autocomplete="off">
            </div>
            <div class="ledger-filter-field ledger-filter-field--sm">
                <label for="toDate">To</label>
                <input type="text" class="form-control form-control-sm datepicker" id="toDate" placeholder="yyyy-mm-dd" autocomplete="off">
            </div>
        </div>
    </div>

    <p class="ledger-shortcut-hint"><kbd>`</kbd> quick-add expense</p>

    <div class="table-responsive">
        <table class="table table-hover w-100" id="expenses_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Voucher</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th class="text-end">Amount</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <?php adm_panel_close(); ?>
</div>

<?php include 'modal/modal_expenses.php'; ?>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script src="js/ledger-expenses.js?v=<?php echo filemtime(__DIR__ . '/js/ledger-expenses.js'); ?>"></script>
</body>
</html>
