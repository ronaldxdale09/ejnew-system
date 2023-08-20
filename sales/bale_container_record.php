<?php
include 'include/header.php';
include 'include/navbar.php';

?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<?php include 'sales_modal/bale_container.php'; ?>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>

                        <br>
                        <div class="row">
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CONTAINER</b> COMPLETED</p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--primary">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CONTAINER</b> IN PROGRESS </p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--success">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CONTAINER</b>SHIPPED </p>
                                        <h3>
                                            <i class="text-success font-weight-bold mr-1"></i>
                                            <i> Updating </i>
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--warning">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-ship"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">

                            <hr>
                            <div class="table-responsive">
                                <?php
                                $results  = mysqli_query($con, "SELECT *, bales_container_record.container_id as con_id,
                                bales_container_record.num_bales as total_bales ,
                                bales_container_record.total_bale_weight as total_weight 
                                from bales_container_record
                                LEFT JOIN bales_container_selection ON bales_container_selection.container_id =  bales_container_record.container_id
                                    where status !='Void'
                                GROUP BY bales_container_record.container_id");


                                ?>
                                <table class="table table-bordered table-hover table-striped" id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Contr ID</th>
                                            <th scope="col">Withdrawal Date</th>
                                            <th scope="col">Van No.</th>
                                            <th scope="col">Bale Quality</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col" hidden>Bale Cost</th>
                                            <th scope="col" hidden>Milling Cost</th>
                                            <th scope="col">Particulars</th>
                                            <th scope="col" hidden>Recorded By</th>
                                            <th scope="col">Source</th>
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
                                                case "Awaiting Release":
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
                                            }

                                            $source_color = '';
                                            switch ($row['source']) {
                                                case "Basilan":
                                                    $source_color = 'bg-info';
                                                    break;
                                                case "Kidapawan":
                                                    $source_color = 'bg-warning text-dark';
                                                    break;
                                            }
                                        ?>
                                            <tr>
                                                <td width='10%'>
                                                    <span class="badge <?php echo $status_color; ?>">
                                                        <?php
                                                        if ($row['status'] == "Shipped Out" && $row['shipment_id']) {
                                                            echo "Shipped Out - #" . $row['shipment_id'];
                                                        }
                                                        elseif ($row['status'] == "Sold") {
                                                            echo "Sold - Ship ID #" . $row['shipment_id'];
                                                        } else {
                                                            echo $row['status'];
                                                        }
                                                        ?>
                                                    </span>

                                                </td>
                                                <td class="text-center"><?php echo $row['con_id']; ?></td>
                                                <td class="text-center"><?php echo date('M j, Y', strtotime($row['withdrawal_date'])); ?></td>
                                                <td class="text-center"><?php echo $row['van_no']; ?></td>
                                                <td><?php echo $row['quality']; ?> @ <?php echo $row['kilo_bale']; ?> kg</td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_bales'], 0, '.', ','); ?> pcs
                                                </td>
                                                <td class="number-cell">
                                                    <?php echo number_format($row['total_weight'], 0, '.', ','); ?> kg
                                                </td>
                                                <td class="number-cell" hidden> ₱
                                                    <?php echo number_format($row['total_bale_cost'], 0, '.', ','); ?>
                                                </td>
                                                <td class="number-cell" hidden> ₱
                                                    <?php echo number_format($row['total_milling_cost'], 0, '.', ','); ?>
                                                </td>
                                                <td><?php echo $row['remarks']; ?></td>
                                                <td hidden><?php echo $row['recorded_by']; ?></td>
                                                <td> <span class="badge <?php echo $source_color; ?>">
                                                        <?php echo $row['source'] ?>
                                                    </span>
                                                </td>
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
                    [11, 'asc']
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
        });




        $('.btnViewRecord').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            $('#v_id').val(data[1]);

            $('#v_date').val(data[2]);
            $('#v_van').val(data[3]);
            $('#v_quality').val(data[4]);
            $('#v_kilo').val(data[4]);
            $('#v_remarks').val(data[9]);
            $('#v_recorded').val(data[10]);





            function fetch_table() {

                var container_id = (data[1]);
                $.ajax({
                    url: "table/contaner_bales_record.php",
                    method: "POST",
                    data: {
                        container_id: container_id,

                    },
                    success: function(data) {
                        $('#bales_container_record').html(data);
                    }
                });
            }
            fetch_table();




            $('#viewContainer').modal('show');


        });
    </script>


</body>

</html>