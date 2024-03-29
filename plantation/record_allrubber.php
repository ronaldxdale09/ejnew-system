<?php
include('include/header.php');
include "include/navbar.php";
$loc = str_replace(' ', '', $_SESSION['loc']);
?>
<?php include('modal/modal_rubber_report.php'); ?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<body>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <h2 class="page-title">
                        <br>
                        <b>
                            <font color="#0C0070"> RUBBER </font>
                            <font color="#046D56"> TRANSACTIONS </font>
                        </b>
                        <br>
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                            $results = mysqli_query($con, "SELECT planta_recording.recording_id,planta_recording.purchase_cost,planta_recording.trans_type, planta_recording.status, planta_recording.supplier,
                                        planta_recording.location, planta_recording.lot_num, planta_recording.weight, planta_recording.reweight,
                                        planta_recording.crumbed_weight, planta_recording.dry_weight, planta_recording.produce_total_weight,
                                        planta_recording.drc, planta_recording.driver, planta_recording.truck_num, planta_recording.receiving_date, 
                                        planta_recording.milling_date, planta_recording.drying_date, planta_recording.production_date, planta_recording.production_expense, planta_recording.milling_cost,
                                        rubber_transaction.date as purchased_date,rubber_transaction.net_weight as wet_net_weight
                                        FROM planta_recording
                                        LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
                                        WHERE trans_type !='OUTSOURCE' and source ='$loc'
                                        GROUP BY planta_recording.recording_id"); ?>
                                            <thead class="table-dark">
                                                <tr style='font-size:12px'>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Lot No.</th>
                                                    <th scope="col">Cuplump</th>
                                                    <th scope="col">Reweight</th>
                                                    <th scope="col" hidden>Crumbs</th>
                                                    <th scope="col" hidden>Blanket</th>
                                                    <th scope="col">Bale Weight</th>
                                                    <th scope="col">DRC</th>
                                                    <th scope="col">Purchase Cost</th>
                                                    <th scope="col">Expense</th>
                                                    <th scope="col">Overhead</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>

                                                        <?php
                                                        $status_color = '';
                                                        switch ($row['status']) {
                                                            case "Complete":
                                                                $status_color = 'bg-success';
                                                                break;
                                                            case "Field":
                                                                $status_color = 'bg-info';
                                                                break;
                                                            case "Milling":
                                                                $status_color = 'bg-secondary';
                                                                break;
                                                            case "Drying":
                                                                $status_color = 'bg-warning';
                                                                break;
                                                            case "Pressing":
                                                                $status_color = 'bg-danger';
                                                                break;
                                                            case "Produced":
                                                                $status_color = 'bg-primary';
                                                                break;

                                                            case "Sold":
                                                                $status_color = 'bg-dark text-white';
                                                                break;
                                                            case "For Sale":
                                                                $status_color = 'bg-dark text-light';
                                                                break;
                                                            case "Purchase":
                                                                $status_color = 'bg-warning text-dark';
                                                                break;
                                                        }

                                                        ?>
                                                        <td> <span class="badge <?php echo $status_color; ?>">
                                                                <?php echo $row['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td> <?php echo $row['recording_id'] ?> </td>
                                                        <td> <?php echo $row['supplier'] ?> </td>
                                                        <td> <?php echo $row['lot_num'] ?> </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['weight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['reweight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell" hidden>
                                                            <?php echo number_format($row['crumbed_weight'], 0, '.', ','); ?>
                                                            kg</td>
                                                        <td class="number-cell" hidden>
                                                            <?php echo number_format($row['dry_weight'], 0, '.', ','); ?> kg
                                                        </td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['produce_total_weight'], 0, '.', ','); ?>
                                                            kg</td>
                                                        <td class="number-cell">
                                                            <?php echo number_format($row['drc'], 2, '.', ','); ?> %</td>
                                                        <td class="number-cell">
                                                        ₱<?php echo number_format($row['purchase_cost'],0, '.', ','); ?></td>
                                                        <td class="number-cell">₱
                                                            <?php echo number_format($row['production_expense'], 0, '.', ','); ?></td>
                                                        <td class="number-cell">₱
                                                            <?php echo number_format($row['milling_cost'], 2, '.', ','); ?></td>

                                                        <td>
                                                            <button type="button" data-driver='<?php echo $row['driver']; ?>' data-truck='<?php echo $row['truck_num']; ?>' data-date_purchased='<?php echo $row['purchased_date']; ?>' data-wet_weight='<?php echo $row['wet_net_weight']; ?>' data-date_received='<?php echo $row['receiving_date']; ?>' data-date_milled='<?php echo $row['milling_date']; ?>' data-date_dryed='<?php echo $row['drying_date']; ?>' data-production_date='<?php echo $row['production_date']; ?>' class="btn btn-success text-white btnViewRecord">VIEW
                                                            </button>
                                                        </td>
                                                    </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script>
    $(document).ready(function() {
        var table = $('#sellerTable').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            "pageLength": 50,
            order: [
                [0, 'desc']
            ],
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    }
                },

            ],
            lengthChange: false,
            orderCellsTop: true,
        });
    });
</script>



<script>
    $('.btnViewRecord').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var driver = $(this).data('driver');
        var truck = $(this).data('truck');
        var date_purchased = $(this).data('date_purchased');
        var wet_weight = $(this).data('wet_weight');
        var date_received = $(this).data('date_received');

        var date_dryed = $(this).data('date_dryed');
        var date_milled = $(this).data('date_milled');
        var production_date = $(this).data('production_date');


        $('#recording_id').val(data[1] || '-');
        $('#record_supplier').val(data[2] || '-');
        $('#record_loc').val(data[3] || '-');
        $('#record_lot').val(data[4] || '-');

        $('#record_driver').val(driver || '-');
        $('#record_truck').val(truck || '-');

        $('#date_purchased').val(date_purchased || '-');
        $('#wet_weight').val(wet_weight || '-');

        $('#date_received').val(date_received || '-');
        $('#reweight').val((data[6] ? data[6].replace(/\D+/g, '') : '-') || '-');


        $('#milling_date').val(date_milled || '-');
        $('#crumbed_weight').val((data[7] ? data[7].replace(/\D+/g, '') : '-') || '-');

        $('#dry_date').val(date_dryed || '-');
        $('#dry_weight').val((data[8] ? data[8].replace(/\D+/g, '') : '-') || '-');

        $('#production_date').val(production_date || '-');
        $('#bale_weight').val((data[9] ? data[9].replace(/\s+/g, '') : '-') || '-');
        $('#drc').val(data[10] || '-');



        function fetch_data() {

            var recording_id = data[1].replace(/\s+/g, '');
            $.ajax({
                url: "table/pressing_data.php",
                method: "POST",
                data: {
                    recording_id: recording_id,

                },
                success: function(data) {
                    $('#pressing_modal_update_table').html(data);
                    $('#modal_press_update').modal('show');

                }
            });
        }
        fetch_data();



        function fetch_milling() {
            var recording_id = (data[1]);
            $.ajax({
                url: "table/milling_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,
                },
                success: function(data) {
                    $('#milling_record').html(data);
                }
            });
        }
        fetch_milling();



        function fetch_dry() {

            var recording_id = (data[1]);
            $.ajax({
                url: "table/dry_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,

                },
                success: function(data) {
                    $('#dry_table_record').html(data);
                }
            });
        }
        fetch_dry();

        $('#newReceiving').modal('show');


    });
</script>