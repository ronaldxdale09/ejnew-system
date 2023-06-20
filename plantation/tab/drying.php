
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-drying'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Drying' and planta_recording.source='$loc'"); ?>
        <thead class="table-dark">


            <tr>

                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Drying Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Cuplump Reweight</th>
                <th scope="col">Dry Weight</th>

                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>


                <td>
                    <span class="badge bg-warning"> <?php echo $row['status']?> </spa>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo date('M d, Y', strtotime($row['milling_date'])); ?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td class="number-cell"> <?php echo number_format($row['reweight'], 0, '.', ',')?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['dry_weight'], 0, '.', ',')?> kg</td>


                <!-- AGE, COUNT DAYS FROM TRANSFERRED TO TODAY -->
                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm btnDryUpdate" id='btnDryUpdate'>
                        <i class="fas fa-edit"></i> </button>
                    <button type="button" class="btn btn-warning btn-sm btnDryTransfer">
                        <i class="fas fa-chevron-right"></i> </button>
                    <button type="button" class="btn btn-dark btn-sm btnViewRecordDrying">
                        <i class="fas fa-book"></i> </button>
                </td>



            </tr> <?php } ?> </tbody>
    </table>
</div>


<script>
$('.btnDryUpdate').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#dry_u_recording_id').val(data[1]);
    $('#dry_u_supplier').val(data[3]);
    $('#dry_u_loc').val(data[4]);
    $('#dry_u_lot').val(data[5]);

    $('#modal_drying_update').modal('show');


});


$('.btnDryTransfer').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#trans_dry_id').val(data[1]);
    $('#trans_dry_date').val(data[2]);
    $('#trans_dry_supplier').val(data[3]);

    $('#trans_dry_loc').val(data[4]);
    $('#trans_dry_lot_no').val(data[5]);


    $('#trans_dry_crumbed_weight').val(data[6]);
    $('#trans_dry_weight').val(data[7]);


    dry_weight = parseFloat(data[7].match(/\d+\.?\d*/));


    if (dry_weight === 0) {
        Swal.fire({
            title: 'Proceed with zero crumb weight?',
            confirmButtonText: 'Update',
            confirmButtonColor: '#3085d6',
            showConfirmButton: false,
            html: ` <br> <br>
        <div class="text-center">
           
            <button id="updateButtonDry" class="btn btn-success mr-2">Update</button>
            <button id="proceedButtonDry" class="btn btn-warning mr-2">Proceed</button>
            <button id="closeButtonDry" class="btn btn-secondary">Close</button>
        </div>
    `
        });
    } else {
        Swal.fire({
            title: 'Transfer to Pressing',
            confirmButtonText: 'Update',
            confirmButtonColor: '#3085d6',
            showConfirmButton: false,
            html: ` <br> <br>
        <div class="text-center">
           
            <button id="updateButtonDry" class="btn btn-success mr-2">Update</button>
            <button id="proceedButtonDry" class="btn btn-warning mr-2">Proceed</button>
            <button id="closeButtonDry" class="btn btn-secondary">Close</button>
        </div>
    `
        });
    }

    // Add a click event listener to the "Proceed" button
    document.getElementById('proceedButtonDry').addEventListener('click', function() {
        Swal.close();
        $('#modal_drying_transfer').modal('show');


        function fetch_table() {

            var recording_id = (data[1]);
            $.ajax({
                url: "table/dry_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,

                },
                success: function(data) {
                    $('#dry_table_record_trans').html(data);
                }
            });
        }
        fetch_table();
    });

    // Add a click event listener to the "Update" button
    document.getElementById('updateButtonDry').addEventListener('click', function() {
        document.getElementById('btnDryUpdate').click();
        Swal.close();

    });

    // Add a click event listener to the "Close" button
    document.getElementById('closeButtonDry').addEventListener('click', function() {
        // Your function to execute when "Close" button is clicked
        Swal.close();
    });






});



$('.btnViewRecordDrying').on('click', function() {
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
</script>