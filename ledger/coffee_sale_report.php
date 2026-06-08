<?php
include 'include/header.php';
include 'include/navbar.php';

$CurrentYear = (int) date('Y');
$SaleYear = isset($_GET['year']) ? (int) $_GET['year'] : $CurrentYear;
if ($SaleYear < 2000 || $SaleYear > $CurrentYear + 1) {
    $SaleYear = $CurrentYear;
}

ledger_shell_open('Coffee Sale Report', 'Annual sales breakdown by category (PHP).', ['Coffee']);
adm_panel_open('Monthly Sales by Category');
?>
<div class="table-responsive">
    <table id="coffee-sale-report" class="table table-hover w-100">
        <?php
        $yearEsc = (int) $SaleYear;
        $coffeesale = mysqli_query($con, "SELECT cp.coffee_product_category AS category,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 1 THEN csl.amount ELSE 0 END) AS JAN,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 2 THEN csl.amount ELSE 0 END) AS FEB,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 3 THEN csl.amount ELSE 0 END) AS MAR,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 4 THEN csl.amount ELSE 0 END) AS APR,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 5 THEN csl.amount ELSE 0 END) AS MAY,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 6 THEN csl.amount ELSE 0 END) AS JUN,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 7 THEN csl.amount ELSE 0 END) AS JUL,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 8 THEN csl.amount ELSE 0 END) AS AUG,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 9 THEN csl.amount ELSE 0 END) AS SEP,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 10 THEN csl.amount ELSE 0 END) AS OCT,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 11 THEN csl.amount ELSE 0 END) AS NOV,
            SUM(CASE WHEN MONTH(cs.coffee_date) = 12 THEN csl.amount ELSE 0 END) AS DECE,
            SUM(csl.amount) AS TOTAL
            FROM coffee_sale cs
            INNER JOIN coffee_sale_line csl ON cs.coffee_sale_id = csl.sale_id
            INNER JOIN coffee_products cp ON csl.coffee_id = cp.coffee_id
            WHERE YEAR(cs.coffee_date) = {$yearEsc}
            GROUP BY cp.coffee_product_category
            ORDER BY cp.coffee_product_category");
        ?>
        <thead>
            <tr>
                <th>
                    <select name="year" id="coffee_report_year" class="form-select form-select-sm" onchange="coffeeReportFilterYear()">
                        <?php for ($y = $CurrentYear; $y >= 2021; $y--): ?>
                        <option value="<?php echo $y; ?>"<?php echo $SaleYear === $y ? ' selected' : ''; ?>><?php echo $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </th>
                <th>Category</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sept</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($coffeesale): while ($row = mysqli_fetch_array($coffeesale)) { ?>
            <tr>
                <td></td>
                <td><?php echo adm_esc($row['category']); ?></td>
                <td class="text-end"><?php echo adm_peso($row['JAN'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['FEB'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['MAR'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['APR'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['MAY'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['JUN'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['JUL'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['AUG'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['SEP'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['OCT'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['NOV'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['DECE'], 2); ?></td>
                <td class="text-end"><strong><?php echo adm_peso($row['TOTAL'], 2); ?></strong></td>
            </tr>
            <?php } endif; ?>
        </tbody>
    </table>
</div>
<?php adm_panel_close(); ?>
<script>
function coffeeReportFilterYear() {
    var year = document.getElementById('coffee_report_year').value;
    var url = new URL(window.location.href);
    url.searchParams.set('year', year);
    window.location.href = url.toString();
}

$(function () {
    $('#coffee-sale-report').DataTable({
        dom: 'Bfrtip',
        paging: false,
        order: [[1, 'asc']],
        buttons: ['copy', 'excel', 'pdf', 'print']
    });
});
</script>
<?php ledger_shell_close(); ?>
