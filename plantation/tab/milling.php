<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='recording_table-milling'> <?php
        $results  = mysqli_query($con, "SELECT * from planta_recording WHERE status='Milling'"); ?>
        <thead class="table-dark">
            <tr>

                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Milling Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Lot No.</th>
                <th scope="col">Reweight</th>
                <th scope="col">Crumbed Weight</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>


                <td>
                    <span class="badge bg-secondary"> <?php echo $row['status']?> </span>
                </td>
                <td> <?php echo $row['recording_id']?> </td>
                <td> <?php echo $row['milling_date']?> </td>
                <td> <?php echo $row['supplier']?> </td>
                <td> <?php echo $row['location']?> </td>
                <td> <?php echo $row['lot_num']?> </td>
                <td class="number-cell"> <?php echo number_format($row['reweight'], 0, '.', ',')?> kg</td>
                <td class="number-cell"> <?php echo number_format($row['crumbed_weight'], 0, '.', ',')?> kg</td>


                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm btnMilUpdate" id='btnMilUpdate'>
                        <i class="fas fa-edit"></i> </button>
                    <button type="button" class="btn btn-warning btn-sm btnMilTransfer ">
                        <i class="fas fa-chevron-right"> </i> </button>
                    <button type="button" class="btn btn-primary btn-dark btn-sm btnViewRecordMilling">
                        <i class="fas fa-book"></i></button>
                </td>


            </tr> <?php } ?> </tbody>
    </table>
</div>


<script>
$('.btnMilUpdate').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#mil_u_recording_id').val(data[1]);
    $('#mil_u_supplier').val(data[3]);
    $('#mil_u_loc').val(data[4]);
    $('#mil_u_lot').val(data[5]);

    $('#modal_mil_update').modal('show');


});
$('.btnMilTransfer').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    $('#trans_mill_id').val(data[1]);
    $('#trans_mill_date').val(data[2]);
    $('#trans_mill_supplier').val(data[3]);

    $('#trans_mill_loc').val(data[4]);
    $('#trans_mill_lot_no').val(data[5]);

    $('#trans_mill_reweight').val(data[6]);
    $('#trans_mill_crumbed_weight').val(data[7]);

    crumbed_weight = parseFloat((data[7]).match(/[\d]+(\.[\d]+)?/)[0]);
    if (crumbed_weight === 0) {
    Swal.fire({
        title: 'Proceed with zero crumb weight?',
        confirmButtonText: 'Update',
        confirmButtonColor: '#3085d6',
        showConfirmButton: false,
        html: ` <br> <br>
        <div class="text-center">
           
            <button id="updateButton" class="btn btn-success mr-2">Update</button>
            <button id="proceedButton" class="btn btn-warning mr-2">Proceed</button>
            <button id="closeButton" class="btn btn-secondary">Close</button>
        </div>
    `
    });
}
else {
    Swal.fire({
        title: 'Transfer to Drying',
        confirmButtonText: 'Update',
        confirmButtonColor: '#3085d6',
        showConfirmButton: false,
        html: ` <br> <br>
        <div class="text-center">
           
            <button id="updateButton" class="btn btn-success mr-2">Update</button>
            <button id="proceedButton" class="btn btn-warning mr-2">Proceed</button>
            <button id="closeButton" class="btn btn-secondary">Close</button>
        </div>
    `
    });  
}

    // Add a click event listener to the "Proceed" button
    document.getElementById('proceedButton').addEventListener('click', function() {
        Swal.close();
        function fetch_table() {
            var recording_id = (data[1]);
            $.ajax({
                url: "table/milling_record_table.php",
                method: "POST",
                data: {
                    recording_id: recording_id,
                },
                success: function(data) {
                    $('#mill_trans_table_record').html(data);
                }
            });
        }
        fetch_table();

        $('#modal_milling_transfer').modal('show');
    });

    // Example function
    function functionToProceed() {
        console.log('Proceed button clicked');
    }

    // Add a click event listener to the "Update" button
    document.getElementById('updateButton').addEventListener('click', function() {
        // Your function to execute when "Update" button is clicked
        functionToUpdate();
    });

    // Example function
    function functionToUpdate() {
        Swal.close();
        document.getElementById('btnMilUpdate').click();
    }

    // Add a click event listener to the "Close" button
    document.getElementById('closeButton').addEventListener('click', function() {
        // Your function to execute when "Close" button is clicked
        Swal.close();
    });




});



$('.btnViewRecordMilling').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#mil_v_recording_id').val(data[1]);
    $('#mil_v_supplier').val(data[3]);
    $('#mil_v_loc').val(data[4]);
    $('#mil_v_lot').val(data[5]);



    function fetch_table() {

        var recording_id = (data[1]);
        $.ajax({
            url: "table/milling_record_table.php",
            method: "POST",
            data: {
                recording_id: recording_id,

            },
            success: function(data) {
                $('#mill_table_record').html(data);
            }
        });
    }
    fetch_table();




    $('#modal_mil_record').modal('show');


});


</script>