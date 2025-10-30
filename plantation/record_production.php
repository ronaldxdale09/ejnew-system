<?php
include('include/header.php');
include "include/navbar.php";

$tab = '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']);
}

?>
<?php include('modal/modal_rubber_report.php'); ?>

<style>
    .number-cell {
        text-align: right;
    }
</style>
<link rel="stylesheet" href="css/record_tab.css" />

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
                        <div class="inventory-table">
                            <div class="container-fluid">
                                <div class="wrapper" id="myTab">
                                    <input type="radio" name="slider" id="home" checked>
                                    <input type="radio" name="slider" id="blog" <?php if ($tab == '2') {
                                                                                    echo 'checked';
                                                                                } else {
                                                                                    echo '';
                                                                                } ?>>

                                    <nav>
                                        <label for="home" class="home"><i class="fas fa-book"></i> Inventory Record</label>
                                        <label for="blog" class="blog"><i class="fas fa-list"></i> Container Bales </label>


                                        <div class="slider"></div>
                                    </nav>
                                    <section>
                                        <div class="content content-1">
                                            <?php include('record/record.php') ?>
                                        </div>
                                        <div class="content content-2">

                                        </div>


                                    </section>
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
        $('#reweight').val((data[6] ? data[6].replace(/\s+/g, '') : '-') || '-');

        $('#milling_date').val(date_milled || '-');
        $('#crumbed_weight').val(data[7] || '-');

        $('#dry_date').val(date_dryed || '-');
        $('#dry_weight').val((data[8] ? data[8].replace(/\s+/g, '') : '-') || '-');

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