<style>
    /* Add custom spacing for each filter container */
    .filter-container {
        display: inline-block;
        margin-right: 20px;
        /* Adjust the value as per your preference */
    }

    /* If you want to make sure the last filter doesn't have a right margin */
    .filter-container:last-child {
        margin-right: 0;
    }
</style>
<div class="mb-3">
    <!-- Payee Filter -->
    <div class="d-inline-block mr-4 filter-container"> <!-- Adjusted margin-right -->
        <label>Supplier:</label>
        <select id="filterSupplierKid" class="w-auto filterSupplierKid">
            <option value="">All</option>
            <?php
            $res = mysqli_query($con, "SELECT DISTINCT name FROM rubber_seller");
            while ($row = mysqli_fetch_array($res)) {
                echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Month Filter -->
    <div class="d-inline-block mr-4 filter-container"> <!-- Adjusted margin-right -->
        <label for="filterMonth">Month:</label>
        <select id="filterMonthKid" class="form-select d-inline-block w-auto">
            <option value="">All</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Date Range Filter -->
    <div class="d-inline-block filter-container">
        <label>Date Range:</label>
        <input type="date" id="startDateKid" class="form-control d-inline-block w-auto"> to
        <input type="date" id="endDateKid" class="form-control d-inline-block w-auto">
    </div>
</div>
<hr>

<table class="table table-bordered table-hover table-striped " style='width:100%' id="bale_record_kidapawan">

    <?php
    $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                                   LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                                   WHERE planta_recording.source='Kidapawan'
                                   ORDER BY planta_bales_production.recording_id ASC  ");
    ?>

    <thead class="table-dark" style='font-size:13px'>
        <tr>
            <th hidden>Bale ID</th>
            <th>Date Produced</th>
            <th>Supplier</th>
            <th>Lot No.</th>
            <th>Quality</th>
            <th>Kilo</th>
            <th>Produced Bales</th>
            <th>Remaining Bales</th>
            <th>Cuplump Weight</th>
            <th>Bale Weight</th>
            <th>DRC</th>
            <th>Description</th>
            <th>Mill Cost</th>
            <th>Unit Cost</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>

                <td hidden>
                    <?php echo $row['bales_prod_id'] ?>
                </td>
                <td><?php echo date('M d, Y', strtotime($row['production_date'])); ?></td>
                <td><?php echo $row['supplier'] ?></td>
                <td style="width:10%">
                    <?php
                    if ($row['lot_num'] == "Outsourced") {
                        echo "OS";
                    } else {
                        echo $row['lot_num'];
                    }
                    ?>
                </td>
                <td><?php echo $row['bales_type'] ?></td>
                <td class="number-cell"> <?php echo $row['kilo_per_bale'] ?> kg</td>
                <td class="number-cell bales-column"> <?php echo number_format($row['number_bales'], 0, '.', ',') ?> pcs </td>
                <td class="number-cell remaining-column"> <?php echo number_format($row['remaining_bales'], 0, '.', ',') ?> pcs </td>
                <td class="number-cell">
                    <?php echo number_format($row['reweight'], 0, '.', ',') ?> kg</td>
                <td class="number-cell">
                    <?php echo number_format($row['rubber_weight'], 0, '.', ',') ?> kg</td>

                <td class="number-cell"><?php echo number_format($row['drc'], 2) ?> %</td>
                <td><?php echo $row['description'] ?></td>
                <td> ₱
                    <?php echo number_format($row['milling_cost']) ?>
                </td>
                <td> ₱
                    <?php echo number_format($row['total_production_cost'] / $row['produce_total_weight'], 2) ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'For Sale') : ?>
                        <span class="badge bg-primary"><?php echo $row['status'] ?></span>
                    <?php elseif ($row['status'] == 'Pressing') : ?>
                        <span class="badge bg-danger"><?php echo $row['status'] ?></span>
                    <?php elseif ($row['status'] == 'Purchase') : ?>
                        <span class="badge bg-info"><?php echo $row['status'] ?></span>
                    <?php elseif ($row['status'] == 'Complete') : ?>
                        <span class="badge bg-success"><?php echo $row['status'] ?></span>
                    <?php else : ?>
                        <span class="badge"><?php echo $row['status'] ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        var table_k = $('#bale_record_kidapawan').DataTable({
            "order": [
                [1, 'asc']
            ],
            "pageLength": -1,
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
            "responsive": true,
            "buttons": [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        // Filter by Payee
        $('#filterSupplierKid').on('change', function() {
            table_k.column(2).search(this.value).draw(); // Assuming Payee is the 5th column
        });

        // Filter by Month
        $('#filterMonthKid').on('change', function() {
            var month = parseInt(this.value, 10);
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                    return isNaN(month) || month === dateIssued.getMonth() + 1;
                }
            );
            table_k.draw();
            $.fn.dataTable.ext.search.pop(); // Clear this specific filter
        });

        // Filter by Date Range
        $('#startDateKid, #endDateKid').on('change', function() {
            var startDate = $('#startDateKid').val() ? new Date($('#startDateKid').val()) : null;
            var endDate = $('#endDateKid').val() ? new Date($('#endDateKid').val()) : null;

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                    if (startDate && dateIssued < startDate) {
                        return false;
                    }
                    if (endDate && dateIssued > endDate) {
                        return false;
                    }
                    return true;
                }
            );
            table_k.draw();
            $.fn.dataTable.ext.search.pop(); // Clear this specific filter
        });

        

    });
</script>