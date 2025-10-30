<style>
    .bales-column {
        background-color: rgb(230, 236, 245) !important;
        font-weight: bold;
    }

    .remaining-column {
        background-color: rgb(245, 230, 236) !important;
        font-weight: bold;
    }

    .bg-orange {
        background-color: orange;
    }
</style>

<div class="table-responsive">
   
    <hr>
    <table class="table table-bordered table-hover table-striped table-responsive" style='width:100%' id="recording_table-completed">

        <?php
        $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
       LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
       WHERE planta_bales_production.status='Produced' and (rubber_weight !='0' or rubber_weight !=null) and (remaining_bales !='0' and planta_recording.source='$loc')
       ORDER BY planta_bales_production.recording_id ASC ");
        ?>


        <thead class="table-dark" style='font-size:13px'>
            <tr>

                <th class="text-center">Action</th>
                <th>Status</th>
                <th hidden>Rec. ID</th>
                <th>Bale ID</th>
                <th>Date Produced</th>
                <th>Quality</th>
                <th>Kilo</th>
                <th>Supplier</th>
                <th>Lot No.</th>
                <th>Bales Produced</th>
                <th>Bales Remaining</th>
                <th>Excess</th>
                <th>Bale Weight</th>
                <th>DRC</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody style='font-size:13px'>
            <?php while ($row = mysqli_fetch_array($results)) {
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
                        $status_color = 'bg-warning text-dark';
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
                        $status_color = 'bg-orange text-dark'; // Assuming you have an orange class defined in your CSS
                        break;
                }
            ?>
                <tr>
                    <td>
                        <button type="button" data-recording_id='<?php echo $row['recording_id'] ?>' data-bale='<?php echo json_encode($row); ?>' class="btn btn-primary btn-sm btnProducedView">
                            <i class="fas fa-book"></i> view
                        </button>
                    </td>
                    <td> <span class="badge <?php echo $status_color; ?>">
                            <?php echo $row['status'] ?>
                        </span>
                    </td>
                    <td hidden>
                        <span class="badge bg-success"><?php echo $row['recording_id'] ?></span>
                    </td>
                    <td>
                        <span class="badge bg-secondary"><?php echo $row['bales_prod_id'] ?></span>
                    </td>
                    <td>
                        <?php
                        $date = new DateTime($row['production_date']);
                        echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                        ?>
                    </td>
                    <td><?php echo $row['bales_type'] ?></td>
                    <td class="number-cell"> <?php echo $row['kilo_per_bale'] ?> kg</td>
                    <td><?php echo $row['supplier'] ?></td>
                    <td><?php echo $row['lot_num'] ?></td>
                    <td class="number-cell bales-column"> <?php echo number_format($row['number_bales'], 0, '.', ',') ?> pcs </td>
                    <td class="number-cell remaining-column"> <?php echo number_format($row['remaining_bales'], 0, '.', ',') ?> pcs </td>
                    <td class="number-cell"> <?php echo number_format($row['bales_excess'], 0, '.', ',') ?> kg</td>
                    <td class="number-cell"> <?php echo number_format($row['rubber_weight'], 0, '.', ',') ?> kg</td>
                    <td class="number-cell"><?php echo number_format($row['drc'], 2) ?>%</td>

                    <td><?php echo $row['description'] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



<script>
    $(document).ready(function() {


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min').datepicker("getDate");
                var max = $('#max').datepicker("getDate");
                var startDate = new Date(data[4]);

                if (min == null && max == null) return true;
                if (min == null && startDate <= max) return true;
                if (max == null && startDate >= min) return true;
                if (startDate <= max && startDate >= min) return true;
                return false;
            }
        );

        $("#min").datepicker({
            onSelect: function() {
                table_produced.draw();
            },
            changeMonth: true,
            changeYear: true
        });
        $("#max").datepicker({
            onSelect: function() {
                table_produced.draw();
            },
            changeMonth: true,
            changeYear: true
        });

        var table_produced = $('#recording_table-completed').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            order: [
                [3, 'desc']
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


        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').change(function() {
            table_produced.draw();
        });

        // Quick date filters
        $('#today').on('click', function() {
            var today = new Date();
            $('#min, #max').datepicker('setDate', today);
            table_produced.draw();
        });

        $('#this-week').on('click', function() {
            var today = new Date();
            var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
                .getDay());
            $('#min').datepicker('setDate', firstDayOfWeek);
            $('#max').datepicker('setDate', today);
            table_produced.draw();
        });

        $('#this-month').on('click', function() {
            var today = new Date();
            var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            $('#min').datepicker('setDate', firstDayOfMonth);
            $('#max').datepicker('setDate', today);
            table_produced.draw();
        });


    });
</script>
<script>
    $('.btnProducedView').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var bale = $(this).data('bale');

        var recording = bale.recording_id;
        $('#prod_rec_id').val(bale.recording_id);


        $('#prod_purchased_id').val(bale.purchased_id);
        $('#prod_recording_id').val(bale.recording_id);

        $('#prod_trans_date').val(bale.production_date);
        $('#prod_trans_supplier').val(bale.supplier);
        $('#prod_trans_loc').val(bale.location);
        $('#prod_trans_lot').val(bale.lot_num);


        $('#prod_unit_cost').val(parseFloat(bale.bales_average_cost).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#prod_trans_entry').val(parseFloat(bale.rubber_weight).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#prod_trans_total_weight').val(parseFloat(bale.produce_total_weight).toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }));

        $('#prod_trans_drc').val(bale.drc);
        $('#prod_expense_desc').val(bale.prod_expense_desc);

        $('#prod_expense').val(parseFloat(bale.production_expense).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#prod_mill_cost').val(parseFloat(bale.milling_cost).toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }));


        function fetch_record() {

            $.ajax({
                url: "table/pressing_data.php",
                method: "POST",
                data: {
                    recording_id: recording,

                },
                success: function(data) {
                    $('#produced_modal_table').html(data);
                    $('#modal_produced_record').modal('show');

                }
            });
        }
        fetch_record();


    });


    $('.btnExcess').on('click', function() {

        function fetch_record() {

            $.ajax({
                url: "table/bales_excess_select.php",
                method: "POST",
                success: function(data) {
                    $('#table_bales_excess').html(data);
                    $('#baleExcessModal').modal('show');

                }
            });
        }
        fetch_record();
        // Swal.fire({
        //     icon: 'info',
        //     title: 'Under Development!',
        //     showConfirmButton: false,
        //     timer: 1500
        // })


    });

    document.getElementById('btnMarkCompleteBale').addEventListener('click', function() {


        var recording_id = parseFloat($("#prod_rec_id").val().replace(/,/g, "")) || 0;

        console.log(recording_id)

        Swal.fire({
            title: 'Confirm Completion',
            text: 'Are you sure you want to finalize this bale production recording? Completing this process will remove all remaining bale pieces for this record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Complete It',
            cancelButtonText: 'No, Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "function/completeBaleRecord.php",
                    method: "POST",
                    data: {
                        recording_id: recording_id,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Bale has been set as Complete',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function() {
                            location.reload(); // This will refresh the page
                        });
                    }
                });
            }
        });


    });

    document.getElementById('btnProdTransPressing').addEventListener('click', function() {

        var recording_id = parseFloat($("#prod_rec_id").val().replace(/,/g, "")) || 0;

        // Check if the recording_id is in a container
        $.ajax({
            url: "fetch/checkBaleInContainer.php",
            method: "POST",
            data: {
                recording_id: recording_id,
            },
            success: function(data) {
                if (data == 'in_container') { // Assuming this is the response for a bale in container
                    Swal.fire({
                        icon: 'error',
                        title: 'Bale in Container',
                        text: 'Some of the bales with this recording ID are already in the container. Please remove the bale selection from the container before proceeding to transfer to pressing again.',
                        showConfirmButton: true
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Transfer Bale Record Back to Pressing',
                        text: 'Are you sure you want to transfer this bale record back to pressing? This action will affect the related production process.',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Transfer',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "function/prodBaleTransferPressing.php",
                                method: "POST",
                                data: {
                                    recording_id: recording_id,
                                },
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Bale has been Transfered to Pressing',
                                        showConfirmButton: true,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.href = 'recording.php?tab=4'; // Redirect to the specified URL
                                    });
                                }
                            });
                        }
                    });
                }
            }
        });
    });
</script>