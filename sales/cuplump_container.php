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

        $van_no = isset($record['van_no']) ? $record['van_no'] : '';
        $date = isset($record['loading_date']) ? $record['loading_date'] : '';
        $remarks = isset($record['remarks']) ? $record['remarks'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';
        $location = isset($record['location']) ? $record['location'] : '';

        echo "
            <script>
                $(document).ready(function() {
                    $('#container_id').val('" . $id . "');
                    $('#van_no').val('" . $van_no . "');
                    $('#remarks').val('" . $remarks . "');
                    $('#date').val('" . $date . "');
                    $('#recorded_by').val('" . $recorded_by . "');
                    $('#container_loc').val('" . $location . "');
                    

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
                                    <button type="button" class="btn btn-primary confirmContainer" id="btnConfirmContainer"><span class="fas fa-check"></span>
                                        Complete</button>
                                </div>
                            </div>

                            <br>

                            <div class="card">
                                <div style="background-color: #2452af; height: 5px;"></div><!-- This is the blue bar -->
                                <div class="card-body">
                                    <h4>Container Information</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-12 col-md-1">
                                            <label style='font-size:15px'>Ref No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_id' id='container_id' readonly autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Van No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='van_no' id='van_no' autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Location</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_loc' id='container_loc'  autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Loading Date</label>
                                            <div>
                                                <input type="date" class='form-control' id="date" value="<?php echo $today; ?>" name="date">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md">
                                            <label style='font-size:15px'>Remarks</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='remarks' id='remarks' tabindex="7" autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Recorded by</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='recorded_by' id='recorded_by' tabindex="7" autocomplete='off' />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="card">
                                <div style="background-color: #2452af; height: 5px;"></div><!-- This is the blue bar -->
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Cuplump Inventory</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div id='container_listing'> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
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
                <button type="button" class="btn btn-primary" id="confirmButton">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.confirmContainer', function(e) {
        // Check if 'sale_buyer' input is readonly
        if ($('#sale_buyer').prop('readonly')) {
            // If readonly, show alert and return
            Swal.fire({
                icon: 'warning',
                title: 'Form Completed',
                text: 'This action is not allowed after the form is completed.',
            });
            return;
        }

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var sales_id = <?php echo  $id ?>;

        if ($(this).hasClass('confirmContainer')) {
            $('#confirmModal').modal('show');
        } else if ($(this).hasClass('btnDraft')) {
            $('#draftModal').modal('show');
        }

    });


    $(document).on('click', '#confirmButton', function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Set the form action to the desired URL
        $('#container_form').attr('action', 'function/cuplump_container/container.confirm.php');

        // Submit the form asynchronously using AJAX
        $.ajax({
            type: "POST",
            url: $('#container_form').attr('action'),
            data: $('#container_form').serialize(),
            success: function(response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Sale transaction completed!',
                    });

                    // Set all inputs to readonly
                    $('#container_form input').prop('readonly', true);
                    $('#container_form textarea').prop('readonly', true);
                    $('#container_form select').prop('disabled', true); //use 'disabled' for select elements
                    // Disable all buttons inside the form
                    // Temporarily hide the buttons
                    $("#print_content button").hide();
                    $('#confirmModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle the error response
                // Display SweetAlert error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Form submission failed!',
                });
            }
        });
    });





    function fetch_container() {

        $.ajax({
            url: "table/cuplump_container_record.php",
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