<?php
include 'include/header.php';
include 'include/navbar.php';

$loc = plantation_loc_sql();

plantation_shell_open('Container', 'Bale container withdrawal and release records', [$locDisplay ?: 'Plantation']);
include 'modal/modal_container.php';
?>

<style>.number-cell { text-align: right; }</style>

<?php adm_panel_open('Bale Container'); ?>
<div class="d-flex flex-wrap gap-2 mb-3">
    <button type="button" class="plantation-btn plantation-btn--primary" data-bs-toggle="modal" data-bs-target="#newContainer">
        <i class="fas fa-plus"></i> New Container
    </button>
</div>
<div class="table-responsive">
    <?php
    $results = mysqli_query($con, "SELECT *, bales_container_record.container_id as con_id,
        bales_container_record.num_bales as total_bales,
        bales_container_record.total_bale_weight as total_weight
        FROM bales_container_record
        LEFT JOIN bales_container_selection ON bales_container_selection.container_id = bales_container_record.container_id
        WHERE status !='Void' AND source = '$loc'
        GROUP BY bales_container_record.container_id");
    ?>
    <table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Ref No.</th>
                <th scope="col">Withdrawal Date</th>
                <th scope="col">Van No.</th>
                <th scope="col">Bale Quality</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Bale Cost</th>
                <th scope="col" hidden>Milling Cost</th>
                <th scope="col">Particulars</th>
                <th scope="col" hidden>Recorded By</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_array($results)) {
            $status_color = match ($row['status']) {
                'Draft' => 'bg-info',
                'In Progress' => 'bg-warning',
                'Awaiting Release' => 'bg-secondary',
                'Released' => 'bg-primary',
                'Shipped Out' => 'bg-dark',
                'Sold', 'Sold-Update' => 'bg-success',
                default => 'bg-secondary',
            };
            ?>
            <tr>
                <td><span class="badge <?php echo $status_color; ?>"><?php echo $row['status']; ?></span></td>
                <td><?php echo $row['con_id']; ?></td>
                <td><?php echo date('M d, Y', strtotime($row['withdrawal_date'])); ?></td>
                <td><?php echo $row['van_no']; ?></td>
                <td><?php echo $row['quality']; ?></td>
                <td class="number-cell"><?php echo $row['kilo_bale']; ?></td>
                <td class="number-cell"><?php echo number_format($row['total_bales'], 0, '.', ','); ?> pcs</td>
                <td class="number-cell"><?php echo number_format($row['total_weight'], 0, '.', ','); ?> kg</td>
                <td class="number-cell">₱<?php echo number_format($row['total_bale_cost'], 0, '.', ','); ?></td>
                <td class="number-cell" hidden>₱<?php echo number_format($row['total_milling_cost'], 2, '.', ','); ?></td>
                <td><?php echo $row['remarks']; ?></td>
                <td hidden><?php echo $row['recorded_by']; ?></td>
                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="<?php echo htmlspecialchars($row['status'], ENT_QUOTES); ?>">
                        <i class="fas fa-book"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php adm_panel_close(); ?>

<script>
$(document).ready(function () {
    $('#recording_table-receiving').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        order: [[1, 'desc']],
        buttons: ['excelHtml5', 'pdfHtml5', 'print'],
        columnDefs: [{ orderable: false, targets: -1 }],
        lengthChange: false,
        orderCellsTop: true,
        paging: false,
        info: false
    });

    $(document).on('click', '.btnViewRecord', function () {
        var $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function () { return $(this).text(); }).get();
        var status = $(this).data('status');

        $('#v_id').val((data[1] || '').trim());
        $('#v_date').val((data[2] || '').trim());
        $('#v_van').val((data[3] || '').trim());
        $('#v_quality').val((data[4] || '').trim());
        $('#v_kilo').val((data[5] || '').trim());
        $('#v_remarks').val((data[10] || '').trim());
        $('#v_recorded').val((data[11] || '').trim());

        if (status === 'Awaiting Release') {
            $('#releaseButton').show();
        } else {
            $('#releaseButton').hide();
        }

        var containerId = (data[1] || '').trim();
        $.ajax({
            url: 'table/contaner_bales_record.php',
            method: 'POST',
            data: { container_id: containerId },
            success: function (html) { $('#bales_container_record').html(html); }
        });

        PlantationModal.show('#viewContainer');
    });
});
</script>
<?php plantation_shell_close(); ?>
