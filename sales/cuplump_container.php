<?php
include('include/header.php');
include "include/navbar.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM sales_cuplump_container WHERE container_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $container_no = isset($record['container_no']) ? $record['container_no'] : '';
        $date = isset($record['loading_date']) ? $record['loading_date'] : '';
        $remarks = isset($record['remarks']) ? $record['remarks'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';


        echo "
            <script>
                $(document).ready(function() {
                    $('#container_id').val('" . $id . "');
                    $('#container_no').val('" . $container_no . "');
                    $('#remarks').val('" . $remarks . "');
                    $('#date').val('" . $date . "');
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



                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">CUPLUMP </font>
                        <font color="#046D56"> CONTAINER </font>
                    </b>
                </h2>

                <br>
                <form method='POST' action='function/cuplump_inventory.php' id='container_form'>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary text-white vouchBtn" onclick="goBack()">
                                        <span class="fas fa-arrow-left"></span> Return
                                    </button>
                                    <button type="button" class="btn btn-dark text-white printBtn" id='printBtn'>
                                        <span class="fa fa-print"></span> Print
                                    </button>
                                    <button type="button" class="btn btn-dark text-white pdfBtn" id='pdftBtn'>
                                        <span class="fa fa-file"></span> PDF
                                    </button>
                                    <button type="button" class="btn btn-primary" id="btnConfirmContainer"><span class="fas fa-check"></span>
                                        Complete</button>
                                </div>
                            </div>

                            <br>

                            <div class="card">
                                <div class="card-body">
                                    <h4>Container Information</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-2">
                                            <label style='font-size:15px' class="col-md-12">Ref No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_id' id='container_id' readonly autocomplete='off' style="width: 100px;" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">Container
                                                No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_no' id='container_no' tabindex="7" autocomplete='off' style="width: 100px;" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">Loading
                                                Date</label>
                                            <div class="col-md-12">
                                                <input type="date" class='form-control' id="date" value="<?php echo $today; ?>" name="date">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">Remarks</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='remarks' id='remarks' tabindex="7" autocomplete='off' style="width: 100px;" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label style='font-size:15px' class="col-md-12">Recorded by</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='recorded_by' id='recorded_by' tabindex="7" autocomplete='off' style="width: 100px;" />
                                            </div>
                                        </div>
                                    </div>
                </form>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4>Cuplump Inventory</h4>
                <button type='button' id="addRow" class="btn btn-success">+ Add Inventory</button>
            </div>
            <div class="card-body">
                <div id='container_listing'> </div>


            </div>
        </div>
    </div>



    <br>
</body>


<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Submission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit the form?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitForm">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnConfirmContainer').click(function() {
            // Show the confirmation modal
            $('#confirmModal').modal('show');
        });

        // When the user confirms, submit the form
        $('#submitForm').click(function() {
            $('#container_form').submit();
        });
    });

    function fetch_container() {

        $.ajax({
            url: "table/cuplump_container_listing.php",
            method: "POST",
            data: {
                container_id: <?php echo $id ?>,

            },
            success: function(data) {
                $('#container_listing').html(data);
                // Update the hidden input fields
                // $('#hidden_cuplumps_total_cost').val($('#cuplumps_total_cost').val());
                // $('#hidden_cuplumps_total_weight').val($('#cuplumps_total_weight').val());
                // $('#hidden_cuplumps_average_per_kilo').val($('#cuplumps_average_per_kilo').val());
            }
        });
    }
    fetch_container();
</script>