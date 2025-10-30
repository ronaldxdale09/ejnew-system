<?php
include('include/header.php');
include "include/navbar.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM cuplump_container WHERE container_id = $id";
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

<style>
    .trans-btn {
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 14px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    }

    .trans-btn:hover {
        background-color: #2c3e50;
        box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
        color: #fff;
        transform: translateY(-7px);
    }

    /* For the font awesome icons */
    .fas {
        margin-right: 10px;
    }

    .payment-table thead {
        font-weight: normal;
        background-color: red !important;

    }
</style>


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
                <div class="row">
                    <div class="col-12">
                        <div class="col-8">
                            <a href="cuplump_container_record.php" type="button" class="btn trans-btn btn-secondary ">
                                <span class="fas fa-arrow-left"></span> Return
                            </a>
                            <button type="button" class="btn trans-btn btn-danger btnVoid"> <span
                                    class="fas fa-times"></span>
                                    Delete Record</button>
                            <button type="button" class="btn trans-btn btn-warning btnDraft"><span
                                    class="fas fa-info-circle"></span> Save as Draft</button>
                            <button type="button" class="btn trans-btn btn-primary confirmContainer"
                                id="confirmContainer"><span class="fas fa-check"></span>
                                Confirm
                                Container</button>
                        </div>
                        <br>

                        <form method='POST' action='function/cuplump_container/container.confirm.php'
                            id='container_form'>
                            <div class="card">
                                <div style="background-color: #2452af; height: 5px;"></div><!-- This is the blue bar -->
                                <div class="card-body">
                                    <h4>Container Information</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-12 col-md-1">
                                            <label style='font-size:15px'>Ref No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_id'
                                                    id='container_id' readonly autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Van No.</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='van_no' id='van_no'
                                                    autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Location</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='container_loc'
                                                    id='container_loc' autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Loading Date</label>
                                            <div>
                                                <input type="date" class='form-control' id="date"
                                                    value="<?php echo $today; ?>" name="date">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md">
                                            <label style='font-size:15px'>Remarks</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='remarks' id='remarks'
                                                    tabindex="7" autocomplete='off' />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label style='font-size:15px'>Recorded by</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name='recorded_by'
                                                    id='recorded_by' tabindex="7" autocomplete='off' />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="card">
                                <div style="background-color: #2452af; height: 5px;"></div><!-- This is the blue bar -->
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Cuplump Purchase Details</h4>
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



<!-- Draft Modal -->
<div class="modal fade" id="draftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-save me-2"></i>Store Container as Draft?
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="fas fa-question-circle fa-4x mb-3 animate__animated animate__wobble"></i>
                </p>
                <p class="text-center">
                    Are you sure you want to save the current state as a draft?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-warning saveDraftBtn" id="saveDraftBtn">
                    <i class="fas fa-check me-2"></i>Yes, Save Draft
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal -->
<div class="modal" tabindex="-1" role="dialog" id="confirmReturnModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to return?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmReturn">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).on('click', ' .btnDraft, .btnVoid', function (e) {
        // Check if 'sale_buyer' input is readonly
        if ($('#van_no').prop('readonly')) {
            // If readonly, show alert and return
            Swal.fire({
                icon: 'warning',
                title: 'Form Completed',
                text: 'This action is not allowed after the form is completed.',
            });
            return;
        }

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var sales_id = <?php echo $id ?>;

        if ($(this).hasClass('btnDraft')) {
            $('#draftModal').modal('show');
        }
        // add similar if conditions for other buttons if needed
    });

    //RETURN JS
    $('.btnReturn').on('click', function () {
        $('#confirmReturnModal').modal('show');
    });
    $('#confirmReturn').on('click', function () {
        window.location.href = "cuplump_container_record.php";
    })

    $(document).on('click', '#confirmContainer', function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Set the form action to the desired URL
        $('#container_form').attr('action', 'function/cuplump_container/container.confirm.php');

        // Submit the form asynchronously using AJAX
        $.ajax({
            type: "POST",
            url: $('#container_form').attr('action'),
            data: $('#container_form').serialize(),
            success: function (response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Your cuplump container has been saved!',
                    });

                    // Set all inputs to readonly
                    $('#container_form input').prop('readonly', true);
                    $('#container_form textarea').prop('readonly', true);
                    $('#container_form button').prop('hidden', true);
                    $('#container_form select').prop('disabled', true); //use 'disabled' for select elements
                    // Disable all buttons inside the form
                    // Temporarily hide the buttons
                    $("#print_content button").hide();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response,
                    });
                }
            },
            error: function (xhr, status, error) {
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


    $(document).on('click', '#saveDraftBtn', function (e) {
        e.preventDefault();

        $('#container_form').attr('action', 'function/cuplump_container/container.draft.php');

        $.ajax({
            type: "POST",
            url: $('#container_form').attr('action'),
            data: $('#container_form').serialize(),
            success: function (response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Draft Saved',
                        text: 'Your cuplump container draft has been saved!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to the cuplump_container_record.php page
                            window.location.href = 'cuplump_container_record.php';
                        }
                    });

                    $('#container_form input').prop('readonly', true);
                    $('#container_form textarea').prop('readonly', true);
                    $('#container_form button').prop('hidden', true);
                    $('#container_form select').prop('disabled', true);
                    $("#print_content button").hide();
                    $('#draftModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response,
                    });
                }
            },
            error: function (xhr, status, error) {
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
            success: function (data) {
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