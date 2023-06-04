<?php 
include('include/header.php');
include "include/navbar.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $id=  preg_replace('~\D~', '', $id);

        $sql = "SELECT * FROM container_record WHERE container_id = $id";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            $record = $result->fetch_assoc();
            
            $container_no = isset($record['container_no']) ? $record['container_no'] : '';
            $van_no = isset($record['van_no']) ? $record['van_no'] : '';
            $withdrawal_date = isset($record['withdrawal_date']) ? $record['withdrawal_date'] : '';
            $quality = isset($record['quality']) ? $record['quality'] : '';
            $kilo_bale = isset($record['kilo_bale']) ? $record['kilo_bale'] : '';
            $remarks = isset($record['remarks']) ? $record['remarks'] : '';
            $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';

            echo "
                <script>
                    $(document).ready(function() {
                        $('#ref_no').val('" . $id . "');
                        $('#container_no').val('" . $container_no . "');
                        $('#ship_destination').val('" . $van_no . "');
                        $('#withdrawal_date').val('" . $withdrawal_date . "');
                        $('#quality').val('" . $quality . "');
                        $('#kilo_bale').val('" . $kilo_bale . "');
                        $('#remarks').val('" . $remarks . "');
                        $('#recorded_by').val('" . $recorded_by . "');
                    });
                </script>
            ";
        }
    }
?>


<body>
    <br>
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
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-secondary text-white voidContainer">
                                            <span class="fas fa-arrow-left"></span> Return
                                        </button>

                                        <button type="button" class="btn btn-primary confirmSales"><span
                                                class="fas fa-check"></span> Complete</button>
                                        <button type="button" class="btn btn-warning btnDraft"><span
                                                class="fas fa-info-circle"></span> Save as Draft</button>
                                    </div>
                                </div>

                                <br>
                                <form action="function/confirmContainer.php" method="POST" id='transaction_form'>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Container Information</h4>
                                            <hr>
                                            <form method='POST' id='transaction_form'>
                                                <div class="row">
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Ref No.</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='ref_no'
                                                                id='ref_no' value='<?php echo $id?>' readonly
                                                                style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Container
                                                            No.</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='container_no'
                                                                id='container_no' autocomplete='off'
                                                                style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Van
                                                            No.</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='van_no'
                                                                id='ship_destination' autocomplete='off'
                                                                style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Withdrawal
                                                            Date</label>
                                                        <div class="col-md-12">
                                                            <input type="date" class='form-control' id="withdrawal_date"
                                                                name="withdrawal_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- if and only if one quality -->
                                                        <label style='font-size:15px' class="col-md-12">Quality</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='quality'
                                                                id='quality' autocomplete='off' style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <!-- if and only if one kilo per bale -->
                                                        <label style='font-size:15px' class="col-md-12">Kilo per
                                                            Bale</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='kilo_bale'
                                                                id='kilo_bale' autocomplete='off'
                                                                style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Remarks</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='remarks'
                                                                id='remarks' autocomplete='off' style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Recorded
                                                            by:</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name='recorded_by'
                                                                id='recorded_by' autocomplete='off'
                                                                style="width: 100px;" />
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>

                                    <br>

                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <h4>Bale Inventory</h4>
                                            <button type="button" class="btn btn-dark text-white btnSelectTrans"
                                                id='receiptBtn'>
                                                <span class="fa fa-book"></span> Select Inventory</button>
                                        </div>
                                        <div class="card-body">

                                            <div id='selected_inventory'></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</body>



<div class="modal fade" id="modal_produced_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"> Production Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <hr>
                <div id='produced_modal_table'></div>
                <hr>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete the transaction?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Yes, Complete</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="draftModal" tabindex="-1" aria-labelledby="draftModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="draftModalLabel">
                    <i class="fas fa-file-alt"></i> Save as Draft
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/container.php" method="POST" id='transaction_form'>
                <div class="modal-body">
                    <input type="text" name='id' id='draft_id' hidden>
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Do you want to save your progress and continue editing later?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success" name='draft'>
                        <i class="fas fa-save"></i> Save as Draft
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$('.btnSelectTrans').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    var container_id = <?php echo  $id ?>;
    console.log(container_id);

    function fetch_record() {

        $.ajax({
            url: "table/container_bales_inventory.php",
            method: "POST",
            data: {
                container_id: container_id,

            },
            success: function(data) {
                $('#produced_modal_table').html(data);


            }
        });
    }
    fetch_record();
    $('#modal_produced_record').modal('show');

});


document.getElementById("confirmButton").addEventListener("click", function() {
    document.getElementById("transaction_form").submit();
});

$('.confirmSales').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    var container_id = <?php echo  $id ?>;

    $('#confirmModal').modal('show');

});



$('.btnDraft').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    var id=  <?php echo  $id ?>;
    
    $('#draft_id').val(id);

    $('#draftModal').modal('show');

});



function fetch_data() {
    var container_id = $('#ref_no').val();
    $.ajax({
        url: "table/contaner_selectedList.php",
        method: "POST",
        data: {
            container_id: container_id,
        },
        success: function(data) {
            $('#selected_inventory').html(data);

        }
    });
}
fetch_data();
</script>