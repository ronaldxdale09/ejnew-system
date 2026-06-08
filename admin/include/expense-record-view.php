<?php
/**
 * Shared expense record page (Basilan / Zamboanga / Kidapawan).
 * Required vars: $expenseLocation, $expensePageTitle
 */
if (!isset($expenseLocation, $expensePageTitle)) {
    exit('Expense page configuration missing.');
}

$source = $expenseLocation;
$currentMonth = date('n');
$currentYear = date('Y');

$sql = mysqli_query($con, "SELECT SUM(amount) AS total FROM ledger_expenses WHERE DATE(`date`) = CURDATE() AND location='$source'");
$expense_today = mysqli_fetch_array($sql);

$getMonthTotal = mysqli_query($con, "SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS month_total
    FROM ledger_expenses WHERE (MONTH(date) = '$currentMonth' AND YEAR(date) = '$currentYear') AND location='$source' GROUP BY YEAR(date), MONTH(date)");
$expense_month = mysqli_fetch_array($getMonthTotal);

$getYearTotal = mysqli_query($con, "SELECT SUM(amount) AS year_total FROM ledger_expenses WHERE YEAR(date) = '$currentYear' AND location='$source'");
$expense_year = mysqli_fetch_array($getYearTotal);

$res = mysqli_query($con, "SELECT * FROM category_expenses WHERE source='$source'");
$category = '';
while ($array = mysqli_fetch_array($res)) {
    $category .= '<option value="' . htmlspecialchars($array['category']) . '">' . htmlspecialchars($array['category']) . '</option>';
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

<div class="main-content admin-page">
    <?php adm_page_header($expensePageTitle, 'Track and filter operating expenses — all amounts in Philippine Peso (₱).', [$source]); ?>

    <?php adm_kpi_strip([
        ['label' => 'Today', 'value' => adm_peso($expense_today['total'] ?? 0), 'sub' => date('M j, Y'), 'variant' => 'green'],
        ['label' => 'This Month', 'value' => adm_peso($expense_month['month_total'] ?? 0), 'sub' => date('F'), 'variant' => 'red'],
        ['label' => 'This Year', 'value' => adm_peso($expense_year['year_total'] ?? 0), 'sub' => date('Y'), 'variant' => 'gold'],
    ]); ?>

    <div class="adm-toolbar">
        <div class="adm-toolbar__actions">
            <button type="button" class="btn btn-primary btn-sm btn-add-expense" data-toggle="modal" data-target="#addExpense">
                <i class="fa fa-plus"></i> Add Expense
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm btn-category-modal" data-toggle="modal" data-target="#categoryModal">
                <i class="fa fa-book"></i> Categories
            </button>
        </div>
        <div class="adm-toolbar__filters">
            <div class="adm-filter-field">
                <label for="monthFilter">Month</label>
                <select class="form-select form-select-sm" id="monthFilter" aria-label="Filter month">
                    <option value="" selected>All</option>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="adm-filter-field">
                <label for="yearFilter">Year</label>
                <select class="form-select form-select-sm" id="yearFilter" aria-label="Filter year">
                    <option value="" selected>All</option>
                    <?php for ($i = 2022; $i <= (int) date('Y'); $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="adm-filter-field">
                <label for="categoryFilter">Category</label>
                <select class="form-select form-select-sm" id="categoryFilter" aria-label="Filter category">
                    <option value="" selected>All</option>
                    <?php echo $category; ?>
                </select>
            </div>
            <div class="adm-filter-field adm-filter-field--date">
                <label for="fromDate">From</label>
                <input type="text" class="form-control form-control-sm datepicker" id="fromDate" autocomplete="off" placeholder="Start date">
            </div>
            <div class="adm-filter-field adm-filter-field--date">
                <label for="toDate">To</label>
                <input type="text" class="form-control form-control-sm datepicker" id="toDate" autocomplete="off" placeholder="End date">
            </div>
        </div>
    </div>

    <?php adm_panel_open('Expense Ledger'); ?>
    <div class="table-responsive adm-table-wrap">
        <table class="table table-hover table-sm" id="expenses_table" style="width:100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Voucher</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php adm_panel_close(); ?>
</div>

<script>
$(document).ready(function () {
    $('#fromDate, #toDate').datepicker({ dateFormat: 'yy-mm-dd' });
    $('#addExpense').on('shown.bs.modal', function () {
        $('.ex_category', this).chosen({ search_threshold: 10, width: '100%' });
    });

    var table = $('#expenses_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'fetch/fetchExpenseData.php',
            type: 'POST',
            data: function (data) {
                data.location = <?php echo json_encode($source); ?>;
                data.minDate = $('#fromDate').val();
                data.maxDate = $('#toDate').val();
                data.categoryFilter = $('#categoryFilter').val();
                data.selectedMonth = $('#monthFilter').val();
                data.selectedYear = $('#yearFilter').val();
            }
        },
        columns: [
            { data: 'date' },
            { data: 'particulars' },
            { data: 'voucher_no' },
            { data: 'category' },
            { data: 'type_expense' },
            { data: 'total_amount', className: 'text-end fw-semibold' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        dom: '<"adm-dt-top"lf>rt<"adm-dt-bottom"ip>',
        language: { search: '', searchPlaceholder: 'Search expenses…' }
    });

    $('#fromDate, #toDate, #categoryFilter, #monthFilter, #yearFilter').on('change', function () {
        table.ajax.reload();
    });
});
</script>

</body>
</html>
