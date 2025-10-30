<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-pressing'>
        <?php $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Pressing' and planta_recording.source='$loc'"); ?>
        <thead class="table-dark" style='font-size:13px'>


            <tr>
                <th scope="col">Status</th>
                <th scope="col">Rec. ID</th>
                <th scope="col">Pressing Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Entry Weight</th>
                <!-- <th scope="col" >WET Weight</th> -->
                <th scope="col"> Total Weight</th>
                <th scope="col"> DRC</th>
                <th scope="col">Expense</th>
                <th scope="col">Overhead</th>

                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                    <td>
                        <span class="badge bg-danger"> <?php echo $row['status'] ?> </span>
                    </td>
                    <td> <?php echo $row['recording_id'] ?> </td>
                    <td><?php echo date('M d, Y', strtotime($row['pressing_date'])); ?></td>
                    <td> <?php echo $row['supplier'] ?> </td>
                    <td> <?php echo $row['location'] ?> </td>
                    <td> <?php echo $row['lot_num'] ?> </td>
                    <td class="number-cell"> <?php echo number_format($row['weight'], 0, '.', ',') ?> kg</td>
                    <td class="number-cell"> <?php echo number_format($row['produce_total_weight'], 0, '.', ',') ?> kg</td>
                    <td class="number-cell"><?php echo $row['drc'] ? number_format($row['drc'], 2)  : '-' ?> %</td>
                    <td class="number-cell">₱ <?php echo number_format($row['production_expense'], 0, '.', ',') ?></td>
                    <td class="number-cell">₱ <?php echo number_format($row['milling_cost'], 0, '.', ',') ?></td>

                    <td class="text-center">
                        <div style="display: flex;">
                            <button type="button" data-crumbed='<?php echo $row['crumbed_weight'] ?>' data-expense_desc='<?php echo $row['prod_expense_desc'] ?>' data-dry='<?php echo $row['dry_weight'] ?>' class="btn btn-success btn-sm btnPressUpdate">
                                <i class="fas fa-book"></i>
                            </button>
                            <button type="button" data-expense_desc='<?php echo $row['prod_expense_desc'] ?>' class="btn btn-warning btn-sm btnCompletePressing">
                                <i class="fas fa-chevron-right"> </i>
                            </button>
                        </div>
                    </td>

                </tr> <?php } ?> </tbody>
    </table>
</div>




<script>
    $('.btnPressUpdate').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#press_u_id').val(data[1]);
        $('#press_u_supplier').val(data[3]);
        $('#press_u_loc').val(data[4]);
        $('#press_u_lot').val(data[5]);

        $('#press_u_quality').val(data[5]);

        $('#press_u_entry').val((data[6]));

        $('#press_u_drc').val(data[8]);
        $('#press_u_total_weight').val(data[7]);

        $mill_cost = data[10].match(/\d+/g);
        if ($mill_cost == 0 || $mill_cost == "" || $mill_cost == null) {
            $('#press_u_mill_cost').val(12);
        } else {
            $('#press_u_mill_cost').val(data[10].match(/\d+/g));
        }

        var crumbed = $(this).data('crumbed');
        var dry = $(this).data('dry');


        var expense_desc = $(this).data('expense_desc');
        $('#u_expense_desc').val(expense_desc);
        var numericalData = data[9].match(/\d+/g);
        if (numericalData !== null) {
            $('#u_expense').val(parseFloat(numericalData.join('')));
        }




        $('#press_u_crumbed_weight').val(crumbed ? crumbed : '0 ');
        $('#press_u_dry_weight').val(dry ? dry : '0 ');


        function fetch_data() {

            var recording_id = data[1].replace(/\s+/g, '');
            $.ajax({
                url: "table/pressing_update.php",
                method: "POST",
                data: {
                    recording_id: recording_id,

                },
                success: function(data) {

                    $('#pressing_modal_update_table').html(data);

                }
            });
        }
        fetch_data();
        $('#modal_press_update').modal('show');

    });







    $('.btnCompletePressing').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();


        $('#press_trans_id').val(data[1]);
        $('#press_trans_date').val(data[2]);
        $('#press_trans_supplier').val(data[3]);
        $('#press_trans_loc').val(data[4]);
        $('#press_trans_lot').val(data[5]);

        $('#mill_cost').val(data[10]);


        $('#press_trans_entry').val((data[6]));

        $('#press_trans_drc').val(data[8]);
        $('#press_trans_total_weight').val(data[7]);

        var expense_desc = $(this).data('expense_desc');
        $('#t_expense_desc').val(expense_desc);
        var numericalData = data[9].match(/\d+/g);
        if (numericalData !== null) {
            $('#t_expense').val(parseFloat(numericalData.join('')));
        }


        trans_drc = parseFloat((data[7]).match(/[\d]+(\.[\d]+)?/)[0]);
        if (trans_drc === 0) {
            Swal.fire({

                text: 'Please update pressing first.',
                icon: 'warning',
                confirmButtonText: 'Update',
                confirmButtonColor: '#3085d6',
                showConfirmButton: false,
            });
        } else {


            function fetch_data() {

                var recording_id = data[1].replace(/\s+/g, '');
                $.ajax({
                    url: "table/pressing_data.php",
                    method: "POST",
                    data: {
                        recording_id: recording_id,

                    },
                    success: function(data) {
                        $('#pressing_modal_trans_table').html(data);
                        $('#modal_press_transfer').modal('show');

                    }
                });
            }
            fetch_data();
        }





    });




    $('.btnViewRecordPressing').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#dry_v_recording_id').val(data[1]);
        $('#dry_v_supplier').val(data[3]);
        $('#dry_v_loc').val(data[4]);
        $('#dry_v_lot').val(data[5]);



        function fetch_table() {

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
        fetch_table();




        $('#modal_dry_record').modal('show');


    });




    var table_pressing = $('#recording_table-pressing').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },

        ],
        lengthChange: false,
        orderCellsTop: true,
        paging: false,
        info: false,
    });
</script>