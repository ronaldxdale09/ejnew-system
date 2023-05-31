<?php 
$id = '';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id']);
}
?>

<?php 
include('include/header.php');
include "include/navbar.php";
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
                                <font color="#0C0070">CUPLUMP </font>
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
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Shipping ID.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_id'
                                                            id='ship_id' value='<?php echo $id?>' readonly
                                                            autocomplete='off' style="width: 100px;" />
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
                                                <div class="col">
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
                                                        name='ship_exp_misc' id='ship_exp_misc' style="width: 100px;" />
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
                                                    <input type="text" class="form-control" name='container_ship_exp'
                                                        id='container_ship_exp' readonly style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Containers</h4>
                                        <button id="add-row-btn" class="btn btn-success">Select Container</button>
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
                                                        <th scope="col">Loading Weight</th>
                                                        <th scope="col">Cost Type</th>
                                                        <th scope="col">Cost (Wet)</th>
                                                        <th scope="col">Cost (Dry)</th>
                                                        <th scope="col">DRC</th>
                                                        <th scope="col">Cuplump Cost</th>
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
                                                                <input type="text" class="form-control"
                                                                    name="total_kilo" autocomplete="off">
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    name="loading_reweight" autocomplete="off">
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="cost_type"
                                                                    name="cost_type" style="width: 100px;">
                                                                    <option>Select</option>
                                                                    <option value="DRY">Dry</option>
                                                                    <option value="WET">Wet</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="kilo_cost_wet" required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="kilo_cost_dry" required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="cost_drc"
                                                                    required>
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="total_cogs" required>
                                                            </div>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-4">
                                                <label style='font-size:15px;font-weight:bold' class="col-md-12">Total
                                                    Loading Weight</label>
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