<?php
include 'include/header.php';
include 'include/navbar.php';

$sql = 'SELECT * FROM coffee_customer';
$res = mysqli_query($con, $sql);
$customer_name = '';
while ($array = mysqli_fetch_array($res)) {
    $customer_name .= '<option value="' . adm_esc($array['cof_customer_name']) . '">' . adm_esc($array['cof_customer_name']) . '</option>';
}

include 'modal/coffee_sales.php';

ledger_shell_open('Coffee Sales', 'Record sales, payments, and customer balances.', ['Coffee']);
?>
<style>
    .number-cell { text-align: right; }
    .form-control-wide { width: 100%; padding: 0; margin: 0; }
</style>
<?php include 'statistical_card/coffee_sale_card.php'; ?>
<?php adm_panel_open('Sales Records'); ?>
    <div class="ledger-toolbar mb-3">
        <div class="ledger-toolbar__actions">
            <button type="button" class="ledger-btn ledger-btn--primary" data-bs-toggle="modal" data-bs-target="#newCoffeeSale">
                <i class="fas fa-plus"></i> New Sale
            </button>
        </div>
    </div>
    <div class="table-responsive">
<?php
$stmt = mysqli_prepare($con, 'SELECT coffee_sale_id, coffee_status, coffee_date, coffee_customer, coffee_total_amount, coffee_paid, coffee_balance FROM coffee_sale');
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);

if ($results):
?>
        <table class="table table-bordered table-hover table-striped coffee-sale-table">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Total</th>
                    <th scope="col">Paid</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($results)): ?>
                    <tr>
                        <td><?php echo adm_esc($row['coffee_sale_id']); ?></td>
                        <td>
                            <?php if ($row['coffee_status'] === 'In Progress'): ?>
                                <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> In Progress</span>
                            <?php elseif ($row['coffee_status'] === 'Paid'): ?>
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Paid</span>
                            <?php else: ?>
                                <?php echo adm_esc($row['coffee_status']); ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($row['coffee_date'])); ?></td>
                        <td><?php echo adm_esc($row['coffee_customer']); ?></td>
                        <td class="number-cell"><?php echo adm_peso($row['coffee_total_amount']); ?></td>
                        <td class="number-cell"><?php echo adm_peso($row['coffee_paid']); ?></td>
                        <td class="number-cell"><?php echo adm_peso($row['coffee_balance']); ?></td>
                        <td class="text-center">
                            <button type="button" data-coffee='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>' class="btn btn-success btn-sm btnViewRecord">Update</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
<?php else: ?>
        <p class="text-muted">Error loading sales: <?php echo adm_esc(mysqli_error($con)); ?></p>
<?php endif; ?>
    </div>
<?php adm_panel_close(); ?>
<?php include 'modal/coffee_sales_update.php'; ?>
<script>
    $(document).ready(function() {
        var table = $('.coffee-sale-table').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            order: [[0, 'desc']],
            buttons: ['excelHtml5', 'pdfHtml5', 'print'],
            columnDefs: [{ orderable: false, targets: -1 }],
            lengthChange: false,
            orderCellsTop: true,
            paging: false,
            info: false,
        });

        $('.btnViewRecord').on('click', function() {
            var coffee = $(this).data('coffee');
            var sale_id = coffee.coffee_sale_id;
            $('#coffee_id').val(coffee.coffee_sale_id);
            $('#customer_name').val(coffee.coffee_customer);
            $('#coffee_date').val(coffee.coffee_date);
            $('#coffee_total_amount').val(formatWithComma(coffee.coffee_total_amount));
            $('#total_amount_paid').val(formatWithComma(coffee.coffee_paid));
            $('#coffee_balance').val(formatWithComma(coffee.coffee_balance));

            function fetch_product() {
                $.ajax({
                    url: 'table/coffee_listing_record.php',
                    method: 'POST',
                    data: { sale_id: sale_id },
                    success: function(data) { $('#product_list_table').html(data); }
                });
            }
            fetch_product();

            function fetch_payment() {
                $.ajax({
                    url: 'table/coffee_payment_record.php',
                    method: 'POST',
                    data: { sale_id: sale_id },
                    success: function(data) { $('#payment_list_table').html(data); }
                });
            }
            fetch_payment();

            $('#record_table input').prop('readonly', true);
            $('#record_table textarea').prop('readonly', true);
            $('#record_table select').prop('disabled', true);
            $('#record_table button').hide();
            LedgerModal.show('#updateCoffeeModal');
        });
    });
</script>
<?php ledger_shell_close(); ?>
