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
    <!-- Supplier Filter -->
    <div class="filter-container">
        <label>Supplier:</label>
        <select id="filterSupplier" class="w-auto filterSupplier">
            <option value="">All</option>
            <?php
            $result = mysqli_query($con, "SELECT DISTINCT name FROM rubber_seller");
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Year Filter -->
    <div class="filter-container">
        <label for="filterYear">Year:</label>
        <select id="filterYear" class="form-select d-inline-block w-auto">
            <option value="">All</option>
            <?php
            $currentYear = date("Y");
            $startYear = 2022; // Adjust if needed
            for ($i = $startYear; $i <= $currentYear; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Month Filter -->
    <div class="filter-container">
        <label for="filterMonth">Month:</label>
        <select id="filterMonth" class="form-select d-inline-block w-auto">
            <option value="">All</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Date Range Filter -->
    <div class="filter-container">
        <label>Date Range:</label>
        <input type="date" id="startDate" class="form-control d-inline-block w-auto"> to
        <input type="date" id="endDate" class="form-control d-inline-block w-auto">
    </div>
</div>

<hr>

<table class="table table-bordered table-hover table-striped" style='width:100%' id="bale_record_basilan">
    <?php
    $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                                   LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                                   WHERE planta_recording.source='Basilan'
                                   ORDER BY planta_bales_production.recording_id DESC"); // Changed to DESC for latest records
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
                <td>
                    <?php echo date('M d, Y', strtotime($row['production_date'])); ?>
                </td>
                <td>
                    <?php echo $row['supplier'] ?>
                </td>
                <td style="width:10%">
                    <?php
                    if ($row['lot_num'] == "Outsourced") {
                        echo "OS";
                    } else {
                        echo $row['lot_num'];
                    }
                    ?>
                </td>
                <td>
                    <?php echo $row['bales_type'] ?>
                </td>
                <td class="number-cell">
                    <?php echo $row['kilo_per_bale'] ?> kg
                </td>
                <td class="number-cell bales-column">
                    <?php echo number_format($row['number_bales'], 0, '.', ',') ?> pcs
                </td>
                <td class="number-cell remaining-column">
                    <?php echo number_format($row['remaining_bales'], 0, '.', ',') ?> pcs
                </td>
                <td class="number-cell">
                    <?php echo number_format($row['reweight'], 0, '.', ',') ?> kg
                </td>
                <td class="number-cell">
                    <?php echo number_format($row['rubber_weight'], 0, '.', ',') ?> kg
                </td>

                <td class="number-cell">
                    <?php echo number_format($row['drc'], 2) ?> %
                </td>
                <td>
                    <?php echo $row['description'] ?>
                </td>
                <?php if ($row['status'] == 'For Sale'): ?>
                    <td>₱
                        <?php echo number_format($row['milling_cost']) ?>
                    </td>
                    <td>₱
                        <?php echo number_format($row['total_production_cost'] / $row['produce_total_weight'], 2) ?>
                    </td>
                <?php else: ?>
                    <td>-</td>
                    <td>-</td>
                <?php endif; ?>

                <td>
                    <?php if ($row['status'] == 'For Sale'): ?>
                        <span class="badge bg-primary">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Drying'): ?>
                        <span class="badge bg-warning">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Pressing'): ?>
                        <span class="badge bg-danger">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Purchase'): ?>
                        <span class="badge bg-info">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php elseif ($row['status'] == 'Complete'): ?>
                        <span class="badge bg-success">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php else: ?>
                        <span class="badge">
                            <?php echo $row['status'] ?>
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $(".filterSupplier").chosen({
            search_contains: true,
            no_results_text: "Oops, nothing found!"
        });

        var table = $('#bale_record_basilan').DataTable({
            "order": [
                [0, 'desc']
            ],
            "pageLength": 10, // Default to 10 for better load
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Added info and pagination
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

        // Search Filter Logic
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                // Check if this search function is for our table
                if (settings.nTable.id !== 'bale_record_basilan') {
                    return true;
                }

                var year = parseInt($('#filterYear').val(), 10);
                var month = parseInt($('#filterMonth').val(), 10);
                var min = $('#startDate').val() ? new Date($('#startDate').val()) : null;
                var max = $('#endDate').val() ? new Date($('#endDate').val()) : null;
                var dateStr = data[1]; // Date Produced is column index 1
                var date = new Date(dateStr);

                // Year Filter
                if (!isNaN(year) && date.getFullYear() !== year) {
                    return false;
                }

                // Month Filter
                if (!isNaN(month) && date.getMonth() + 1 !== month) {
                    return false;
                }

                // Date Range Filter
                if (min && date < min) return false;
                if (max && date > max) return false;

                return true;
            }
        );

        // Event Listeners
        $('#filterSupplier').on('change', function () {
            table.column(2).search(this.value).draw();
        });

        $('#filterYear, #filterMonth, #startDate, #endDate').on('change', function () {
            table.draw();
        });

    });
</script>