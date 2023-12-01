<?php
include 'include/header.php';
include 'include/navbar.php';


?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'modal/cuplump_container.php'; ?>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>
                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newContainer">NEW CONTAINER</button>
                            <hr>
                            <div class="mb-3">

                                <!-- Filters -->
                                <div class="row">
                                    <!-- Payee Filter -->
                                    <!-- <div class="col-md-3 mb-3">
                                        <label for="filterBuyer">Particular:</label>
                                        <select class="form-control" id="filterBuyer">
                                            <option value="">All</option>
                                            <?php
                                            $remarksResults = mysqli_query($con, "SELECT DISTINCT remarks FROM bales_container_record WHERE remarks IS NOT NULL AND remarks != ''");
                                            while ($remark = mysqli_fetch_array($remarksResults)) {
                                                echo '<option value="' . $remark['remarks'] . '">' . $remark['remarks'] . '</option>';
                                            }
                                            ?>
                                        </select>


                                    </div> -->

                                    <!-- Check Status Filter -->
                                    <div class="col-md-3 mb-3">
                                        <label for="filterStatus"> Status:</label>
                                        <select id="filterStatus" class="form-control">
                                            <option value="">All</option>
                                            <option value="Shipped Out">Shipped Out</option>
                                            <option value="Sold">Sold</option>
                                            <option value="In Progress">In Progress</option>

                                        </select>
                                    </div>


                                    <!-- Month Filter -->
                                    <div class="col-md-3 mb-3">
                                        <label for="filterMonth">Month:</label>
                                        <select id="filterMonth" class="form-control">
                                            <option value="">All</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="filterYear">Year:</label>
                                        <select id="filterYear" class="form-control">
                                            <option value="">All</option>
                                            <?php
                                            $currentYear = date("Y");
                                            $startYear = 2022;
                                            for ($i = $startYear; $i <= $currentYear; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Date Range Filter - Start Date -->
                                    <div class="col-md-3 mb-3">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" id="startDate" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" id="endDate" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <?php
                                $results  = mysqli_query($con, "SELECT * from sales_cuplump_container ");

                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Loading Date</th>
                                            <th scope="col">Van No.</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Total Cuplump Cost</th>
                                            <th scope="col">Average Cost</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Recorded by</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) {

                                            $status_color = '';
                                            switch ($row['status']) {
                                                case "Draft":
                                                    $status_color = 'bg-info';
                                                    break;
                                                case "In Progress":
                                                    $status_color = 'bg-warning';
                                                    break;
                                                case "Awaiting Shipment":
                                                    $status_color = 'bg-secondary';
                                                    break;
                                                case "Released":
                                                    $status_color = 'bg-primary';
                                                    break;
                                                case "Shipped Out":
                                                    $status_color = 'bg-dark';
                                                    break;

                                                case "Sold":
                                                    $status_color = 'bg-success';
                                                    break;
                                                case "Sold-Update":
                                                    $status_color = 'bg-success';
                                                    break;
                                                case "Complete":
                                                    $status_color = 'bg-success';
                                                    break;
                                            }


                                        ?>
                                            <tr>
                                                <td> <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $row['container_id']; ?></td>
                                                <td><?php echo date('M j, Y', strtotime($row['loading_date'])); ?></td>
                                                <td><?php echo $row['van_no']; ?></td>
                                                <td class="number-cell"><?php echo number_format($row['total_cuplump_weight'], 0, '.', ','); ?> kg</td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['total_cuplump_cost'], 0, '.', ','); ?>
                                                </td>
                                                <td class="number-cell">₱
                                                    <?php
                                                    if ($row['total_cuplump_weight'] != 0) {
                                                        echo number_format($row['ave_cuplump_cost'], 2, '.', ',');
                                                    } else {
                                                        echo "0";
                                                    }

                                                    ?>
                                                </td>
                                                <td><?php echo $row['remarks']; ?></td>
                                                <td><?php echo $row['recorded_by']; ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="<?php echo $row['status']; ?>">
                                                        <i class="fas fa-book"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#recording_table-receiving').DataTable({
                dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                order: [
                    [1, 'desc']
                ],
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
                lengthChange: false,
                orderCellsTop: true,
                paging: false,
                info: false,
            });



            // Filter by Payee
            // $('#filterBuyer').on('change', function() {
            //     table.column(7).search(this.value).draw(); // Assuming Payee is the 5th column
            // });
            // Filter by Status
            $('#filterStatus').on('change', function() {
                table.column(0).search(this.value).draw(); // Assuming Payee is the 5th column
            });
            // Filter by Month
            $('#filterMonth').on('change', function() {
                var month = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[2]); // Assuming Date Issued is the 3rd column
                        return isNaN(month) || month === dateIssued.getMonth() + 1;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });

            // Filter by Date Range
            $('#startDate, #endDate').on('change', function() {
                var startDate = $('#startDate').val() ? new Date($('#startDate').val()) : null;
                var endDate = $('#endDate').val() ? new Date($('#endDate').val()) : null;

                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[2]); // Assuming Date Issued is the 3rd column
                        if (startDate && dateIssued < startDate) {
                            return false;
                        }
                        if (endDate && dateIssued > endDate) {
                            return false;
                        }
                        return true;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });
            // Filter by Year
            $('#filterYear').on('change', function() {
                var year = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateIssued = new Date(data[2]); // Assuming Date Issued is the 3rd column
                        return isNaN(year) || year === dateIssued.getFullYear();
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });


        });


        $('.btnViewRecord').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#v_id').val(data[1]);
            $('#v_date').val(data[2]);
            $('#v_van_no').val(data[3]);

            $('#v_remarks').val(data[7]);
            $('#v_recorded_by').val(data[8]);

            var status = $(this).data('status');

            // if (status == "Draft" || status == "In Progress") {
            //     $('#editBtn').show();
            // } else {
            //     $('#editBtn').hide();
            // }




            function fetch_table() {

                var container_id = (data[1]);
                $.ajax({
                    url: "table/cuplump_container_listing.php",
                    method: "POST",
                    data: {
                        container_id: container_id,

                    },
                    success: function(data) {
                        $('#container_details').html(data);
                    }
                });
            }
            fetch_table();

            $('#viewContainer').modal('show');


        });
    </script>
</body>

</html>