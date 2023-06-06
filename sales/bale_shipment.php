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
    $id=  preg_replace('~\D~', '', $id);

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
        $ship_user = isset($record['recorded_by']) ? $record['recorded_by'] : '';

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
                    $('#ship_user').val('" . $ship_user . "');
                    $('#ship_exp_freight').val('" . $ship_exp_freight . "');
                    $('#ship_exp_loading').val('" . $ship_exp_loading . "');
                    $('#ship_exp_processing').val('" . $ship_exp_processing . "');
                    $('#ship_exp_trucking').val('" . $ship_exp_trucking . "');

                    $('#ship_exp_cranage').val('" . $ship_exp_cranage . "');
                    $('#ship_exp_misc').val('" . $ship_exp_misc . "');

                    $('#total_ship_exp').val('" . $total_ship_exp . "');
                    $('#ship_no_container').val('" . $ship_no_container . "');
                    $('#ship_cost_per_container').val('" . $container_ship_exp . "');
                  

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
                                        <button type="button" class="btn btn-primary confirmSales"
                                            id="btnConfirmShipment">Confirm
                                            Shipment</button>
                                        <button type="button" class="btn btn-dark text-white receiptBtn"
                                            id='receiptBtn'>
                                            <span class="fa fa-print"></span> Print Receipt
                                        </button>
                                        <button type="button" class="btn btn-secondary text-white vouchBtn"
                                            onclick="goBack()">
                                            <span class="fas fa-arrow-left"></span> Return
                                        </button>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Shipment Information</h4>
                                        <hr>
                                        <form method='POST' id='transaction_form'>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Shipping ID.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_id'
                                                            id='ship_id' value='<?php echo $id?>' readonly
                                                            autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Type</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" id="type" name="type"
                                                            style="width: 100px;">
                                                            <option>Select</option>
                                                            <option value="EXPORT">Export</option>
                                                            <option value="LOCAL">Local</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Destination</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_destination'
                                                            id='ship_destination' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Source</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_source'
                                                            id='ship_source' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label style='font-size:15px' class="col-md-12">Shipment
                                                        Date</label>
                                                    <div class="col-md-12">
                                                        <input type="date" class='form-control' id="ship_date"
                                                            value="<?php echo $today; ?>" name="ship_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Vessel</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_vessel'
                                                            id='ship_vessel' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Bill of
                                                        Lading</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_info_lading'
                                                            id='ship_info_lading' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Remarks</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_remarks'
                                                            id='ship_remarks' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_user'
                                                            id='ship_user' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                                    <input type="text" class="form-control" name='ship_exp_freight'
                                                        id='ship_exp_freight' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Loading &
                                                    Unloading</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_loading'
                                                        id='ship_exp_loading' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Processing Fee
                                                    (Phytosanitary)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_processing'
                                                        id='ship_exp_processing' style="width: 100px;" />
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
                                                    <input type="text" class="form-control" name='ship_exp_trucking'
                                                        id='ship_exp_trucking' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Cranage Fee
                                                    (Arrastre)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_cranage'
                                                        id='ship_exp_cranage' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Miscellaneous
                                                    Expenses:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='ship_exp_misc'
                                                        id='ship_exp_misc' style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                                    Shipping
                                                    Expenses</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='total_ship_exp'
                                                        id='total_ship_exp' readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">No. of
                                                    Containers</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" readonly
                                                        name='ship_no_container' id='ship_no_container'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px;font-weight:bold'
                                                    class="col-md-12">Shipping
                                                    Cost per Container</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        name='ship_cost_per_container' id='ship_cost_per_container'
                                                        readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Containers</h4>
                                        <button id="add-row-btn" class="btn btn-success selectContainer">Select Container</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="container-table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Container No.</th>
                                                        <th scope="col">Supplier</th>
                                                        <th scope="col">Lot No.</th>
                                                        <th scope="col">Quality</th>
                                                        <th scope="col">Bale Kilo</th>
                                                        <th scope="col">No. of Bales</th>
                                                        <th scope="col">Total Weight</th>
                                                        <th scope="col">Total Cost</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                data-bs-toggle="modal">Remove</button>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="supplier"
                                                                    autocomplete="off">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="lot_num"
                                                                    autocomplete="off">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="quality"
                                                                    autocomplete="off">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="bale_kilo"
                                                                    autocomplete="off">
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="bale_no"
                                                                    autocomplete="off">
                                                                <span class="input-group-text"> pcs</span>
                                                            </div>
                                                        </td>>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    name="total_bale_weight" required>
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="total_cogs" required>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">No. of
                                                    Bales</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='total_kilo'
                                                        id='total_kilo' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly>
                                                    <span class="input-group-text"> pcs</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                                    Bale Weight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='total_kilo'
                                                        id='total_kilo' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly>
                                                    <span class="input-group-text"> kg</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                                    Cuplump Cost</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='total_cogs'
                                                        id='total_cogs' readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


<script>

$('.selectContainer').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();



    function fetch_table() {

        var container_id = (data[0]);
        $.ajax({
            url: "table/bales_container_list.php",
            method: "POST",
            success: function(data) {
                $('#container_list').html(data);
            }
        });
    }
    fetch_table();




    $('#containerModal').modal('show');


});
</script>