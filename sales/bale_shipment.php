<?php
$id = '';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id']);
}
?>

<?php
include('include/header.php');
include "include/navbar.php";
include "sales_modal/bale_shipment_modal.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id =  preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM bale_shipment_record WHERE shipment_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $ship_id = isset($record['shipment_id']) ? $record['shipment_id'] : '';
        $type = isset($record['type']) ? $record['type'] : '';
        $ship_destination = isset($record['destination']) ? $record['destination'] : '';
        $ship_source = isset($record['source']) ? $record['source'] : '';
        $ship_date = isset($record['ship_date']) ? $record['ship_date'] : '';
        $ship_vessel = isset($record['vessel']) ? $record['vessel'] : '';
        $ship_info_lading = isset($record['bill_lading']) ? $record['bill_lading'] : '';
        $ship_remarks = isset($record['remarks']) ? $record['remarks'] : '';
        $ship_recorded = isset($record['recorded_by']) ? $record['recorded_by'] : '';

        // Assuming you have default values for the following fields
        $ship_exp_freight = isset($record['freight']) ? $record['freight'] : '';
        $ship_exp_loading = isset($record['loading_unloading']) ? $record['loading_unloading'] : '';
        $ship_exp_processing = isset($record['processing_fee']) ? $record['processing_fee'] : '';
        $ship_exp_trucking = isset($record['trucking_expense']) ? $record['trucking_expense'] : '';
        $ship_exp_cranage = isset($record['cranage_fee']) ? $record['cranage_fee'] : '';
        $ship_exp_misc = isset($record['miscellaneous']) ? $record['miscellaneous'] : '';
        $total_ship_exp = isset($record['total_shipping_expense']) ? $record['total_shipping_expense'] : '';
        $ship_no_container = isset($record['no_containers']) ? $record['no_containers'] : '';
        $container_ship_exp = isset($record['ship_cost_container']) ? $record['ship_cost_container'] : '';

        echo "
            <script>
                $(document).ready(function() {
                    $('#ship_id').val('" . $ship_id . "');
                    $('#type').val('" . $type . "');
                    $('#ship_destination').val('" . $ship_destination . "');
                    $('#ship_source').val('" . $ship_source . "');
                    $('#ship_date').val('" . $ship_date . "');
                    $('#ship_vessel').val('" . $ship_vessel . "');
                    $('#ship_info_lading').val('" . $ship_info_lading . "');
                    $('#ship_remarks').val('" . $ship_remarks . "');
                    $('#ship_recorded').val('" . $ship_recorded . "');
                    if($ship_exp_freight) $('#ship_exp_freight').val($ship_exp_freight);
                    if($ship_exp_loading) $('#ship_exp_loading').val($ship_exp_loading);
                    if($ship_exp_processing) $('#ship_exp_processing').val($ship_exp_processing);
                    if($ship_exp_trucking) $('#ship_exp_trucking').val($ship_exp_trucking);
                    if($ship_exp_cranage) $('#ship_exp_cranage').val($ship_exp_cranage);
                    if($ship_exp_misc) $('#ship_exp_misc').val($ship_exp_misc);
                    if($total_ship_exp) $('#total_ship_exp').val($total_ship_exp);
                    if($ship_no_container) $('#ship_no_container').val($ship_no_container);
                    if($container_ship_exp) $('#ship_cost_per_container').val($container_ship_exp);
                  

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
                                <font color="#046D56"> SHIPMENT </font>
                            </b>
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-secondary text-white vouchBtn" onclick="goBack()">
                                            <span class="fas fa-arrow-left"></span> Return
                                        </button>
                                        <button type="button" class="btn btn-warning btnDraft"><span class="fas fa-info-circle"></span> Save as Draft</button>

                                        <button type="button" class="btn btn-danger btnVoid"> <span class="fas fa-times"></span> Void Shipment</button>
                                        <button type="button" class="btn btn-primary confirmShipment" id="confirmShipment"><span class="fas fa-check"></span>
                                        Confirm
                                            Shipment</button>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Shipment Information</h4>
                                        <hr>
                                        <form id="shipmentForm" action="" method="post">
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Shipping ID</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_id' id='ship_id' value='<?php echo $id ?>' readonly autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Type</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" id="type" name="type" style="width: 100px;">
                                                            <option>Select</option>
                                                            <option value="EXPORT">Export</option>
                                                            <option value="LOCAL">Local</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_destination' id='ship_destination' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_source' id='ship_source' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Shipment
                                                        Date</label>
                                                    <div class="col-md-12">
                                                        <input type="date" class='form-control' id="ship_date" value="<?php echo $today; ?>" name="ship_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Vessel</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_vessel' id='ship_vessel' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Bill of
                                                        Lading</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_info_lading' id='ship_info_lading' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Remarks</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_remarks' id='ship_remarks' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Recorded by</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_recorded' id='ship_recorded' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Containers</h4>
                                        <button type='button' id="add-row-btn" class="btn btn-success selectContainer">Select Container</button>
                                    </div>
                                    <div class="card-body">
                                        <div id="selected_container_list"> </div>
                                        <div class="row">
                                            <div class="col" >
                                                <label style="font-size:15px;font-weight:bold" class="col-md-12">No. of
                                                    Bales</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="total_num_bales" id="total_num_bales" tabindex="7" autocomplete="off" style="width: 50px;" readonly>
                                                    <span class="input-group-text"> pcs</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style="font-size:15px;font-weight:bold" class="col-md-12">Total
                                                    Bale Weight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="total_bale_weight" id="total_bale_weight" tabindex="7" autocomplete="off" style="width: 50px;" readonly>
                                                    <span class="input-group-text"> kg</span>
                                                </div>
                                            </div>
                                            <div class="col" hidden>
                                                <label style="font-size:15px;font-weight:bold" class="col-md-12">Total Bale Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"> ₱</span>
                                                    <input type="text" class="form-control" name="total_bale_cost" id="total_bale_cost" tabindex="7" autocomplete="off" style="width: 50px;" readonly>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Shipping Expenses</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Freight (All In)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='freight' id='ship_exp_freight' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Loading &
                                                    Unloading</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='loading_expense' id='ship_exp_loading' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Processing Fee
                                                    (Phytosanitary)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_processing' id='ship_exp_processing' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Trucking Expense</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_trucking' id='ship_exp_trucking' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Cranage Fee
                                                    (Arrastre)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_cranage' id='ship_exp_cranage' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Miscellaneous
                                                    Expenses:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_misc' id='ship_exp_misc' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                                    Shipping Expense</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" readonly class="form-control" name='total_ship_exp' id='total_ship_exp' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">No. of
                                                    Containers</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" readonly name='number_container' id='number_container' placeholder="0.00" style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Shipping
                                                    Expense per Container</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_cost_per_container' id='ship_cost_per_container' placeholder="0.00" readonly style="width: 100px;" />
                                                </div>
                                            </div>
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
    </div>
    <br>
</body>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Shipment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete the shipment record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmButton">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="draftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-save me-2"></i>Save Shipment Draft
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
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




<script>
    // Handle Form Submission

    $(document).on('click', '#saveDraftBtn', function(e) {
        // Set the form action to the desired url
        $('#shipmentForm').attr('action', 'function/bale_shipment_draft.php');

        // Submit the form
        $('#shipmentForm').submit();

    });


    $(document).on('click', '#confirmButton', function(e) {
        // Set the form action to the desired url
        $('#shipmentForm').attr('action', 'function/bale_shipment_confirm.php');

        // Submit the form
        $('#shipmentForm').submit();

    });


    // TABLE TO DISPLAY THE SELECTED CONTAINER
    function fetch_container_list() {

        var shipment_id = <?php echo $id; ?>;
        $.ajax({
            url: "table/bales_shipment_container.php",
            method: "POST",
            data: {
                shipment_id: shipment_id
            },
            success: function(data) {
                $('#selected_container_list').html(data);
            }
        });
    }
    fetch_container_list();


    // BUTTON SCRIPT TO DISPLAY THE AVAILABLE BALES CONTAINER
    $('.selectContainer').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var shipment_id = <?php echo $id ?>;

        function fetch_table() {
            $.ajax({
                url: "table/bales_container_selection.php",
                method: "POST",
                data: {
                    shipment_id: shipment_id,
                },
                success: function(data) {
                    $('#container_list').html(data);
                }
            });
        }
        fetch_table();
        $('#containerModal').modal('show');

    });

    $('.confirmShipment').on('click', function() {
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


        var container_id = <?php echo  $id ?>;

        $('#draftModal').modal('show');

    });



    function calculateShippingExpenses() {
        // get the values of the input fields
        var freight = parseFloat(document.getElementById('ship_exp_freight').value) || 0;
        var loading = parseFloat(document.getElementById('ship_exp_loading').value) || 0;
        var processing = parseFloat(document.getElementById('ship_exp_processing').value) || 0;
        var trucking = parseFloat(document.getElementById('ship_exp_trucking').value) || 0;
        var cranage = parseFloat(document.getElementById('ship_exp_cranage').value) || 0;
        var misc = parseFloat(document.getElementById('ship_exp_misc').value) || 0;

        // calculate total shipping expense
        var totalExpense = freight + loading + processing + trucking + cranage + misc;

        document.getElementById('total_ship_exp').value = totalExpense.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        // get the number of containers
        var numContainers = parseFloat(document.getElementById('number_container').value) || 1;

        // calculate shipping expense per container
        var costPerContainer = totalExpense / numContainers;
        
        document.getElementById('ship_cost_per_container').value = costPerContainer.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // call the function when any of the input values change
    document.getElementById('ship_exp_freight').addEventListener('input', calculateShippingExpenses);
    document.getElementById('ship_exp_loading').addEventListener('input', calculateShippingExpenses);
    document.getElementById('ship_exp_processing').addEventListener('input', calculateShippingExpenses);
    document.getElementById('ship_exp_trucking').addEventListener('input', calculateShippingExpenses);
    document.getElementById('ship_exp_cranage').addEventListener('input', calculateShippingExpenses);
    document.getElementById('ship_exp_misc').addEventListener('input', calculateShippingExpenses);
    document.getElementById('number_container').addEventListener('input', calculateShippingExpenses);

</script>