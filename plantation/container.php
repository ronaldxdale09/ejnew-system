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
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> CONTAINER </font>
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
                                        <h4>Container Information</h4>
                                        <hr>
                                        <form method='POST' id='transaction_form'>
                                            <div class="row">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Ref No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_id'
                                                            id='ship_id' value='<?php echo $id?>' readonly
                                                            autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Container
                                                        No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_destination'
                                                            id='ship_destination' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Loading
                                                        Date</label>
                                                    <div class="col-md-12">
                                                        <input type="date" class='form-control' id="ship_date"
                                                            value="<?php echo $today; ?>" name="ship_date">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Van
                                                        No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_destination'
                                                            id='ship_destination' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <!-- if and only if one quality -->
                                                    <label style='font-size:15px' class="col-md-12">Quality</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='ship_info_lading'
                                                            id='ship_info_lading' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <!-- if and only if one kilo per bale -->
                                                    <label style='font-size:15px' class="col-md-12">Kilo per
                                                        Bale</label>
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
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Bale Inventory</h4>
                                        <button id="add-row-btn" class="btn btn-success">Select Inventory</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">No. of Bales</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='ship_info_lading'
                                                        id='ship_info_lading' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Bale
                                                    Weight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='ship_vessel'
                                                        id='ship_vessel' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="container-table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col" hidden>Date Produced</th>
                                                        <th scope="col">Supplier</th>
                                                        <th scope="col">Lot No.</th>
                                                        <th scope="col">Quality</th>
                                                        <th scope="col">No. of Bales</th>
                                                        <th scope="col">Kilo per Bale</th>
                                                        <th scope="col">Total Weight</th>
                                                        <th scope="col" hidden>DRC</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td hidden>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td hidden>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                data-bs-toggle="modal">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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