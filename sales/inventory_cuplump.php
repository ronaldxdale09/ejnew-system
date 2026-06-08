<?php
include 'include/header.php';
include 'include/navbar.php';

sales_shell_open('Cuplump Inventory', 'Field cuplump stock awaiting processing');
?>
<style>.number-cell { text-align: right; }</style>
<?php adm_panel_open('Cuplump Inventory'); ?>
<div class="table-responsive">
    <table class="table table-hover w-100" id="recording_table-receiving">
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Date Received</th>
                <th scope="col">Supplier</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Weight</th>
                <th scope="col">Reweight</th>
                <th scope="col">Kilo Cost</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $results = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
                FROM planta_recording
                LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                WHERE planta_recording.status = 'Field'");
            while ($results && ($row = mysqli_fetch_array($results))) {
                $kiloCost = !empty($row['net_weight']) ? ($row['total_amount'] / $row['net_weight']) : 0;
                ?>
                <tr>
                    <td><span class="badge bg-success"><?php echo htmlspecialchars($row['status'], ENT_QUOTES); ?></span></td>
                    <td><span class="badge bg-secondary"><?php echo (int) $row['recording_id']; ?></span></td>
                    <td><?php echo htmlspecialchars($row['receiving_date'] ?? '', ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($row['supplier'] ?? '', ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($row['lot_num'] ?? '', ENT_QUOTES); ?></td>
                    <td class="number-cell"><?php echo number_format((float) $row['weight'], 0); ?> kg</td>
                    <td class="number-cell"><?php echo number_format((float) $row['reweight'], 0); ?> kg</td>
                    <td class="number-cell">₱<?php echo number_format($kiloCost, 2); ?></td>
                    <td>Basilan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php if (isset($_SESSION['receiving'])): unset($_SESSION['receiving']); ?>
<script>Swal.fire({ position: 'top-end', icon: 'success', title: 'Cuplumps Received!', showConfirmButton: false, timer: 1500 });</script>
<?php endif; ?>
<script src="js/sales-datatables-common.js"></script>
<script>
$(function () {
    if (!$.fn.DataTable || !$('#recording_table-receiving').length) return;
    $('#recording_table-receiving').DataTable({
        dom: SalesDt.dom,
        order: [[1, 'desc']],
        paging: true,
        pageLength: 25,
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
});
</script>
<?php adm_panel_close(); ?>
<?php sales_shell_close(); ?>
