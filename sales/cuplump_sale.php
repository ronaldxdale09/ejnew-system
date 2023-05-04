<?php 
   include('include/header.php');
   include "include/navbar.php";
?>

<style>
.number-cell {
    text-align: right;
}
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56"> SALE CONTRACT </font>
                            </b>
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary confirmSales"
                                            id="someButton">Confirm Sales</button>
                                        <button type="button" class="btn btn-dark text-white receiptBtn"
                                            id='receiptBtn'>
                                            <span class="fa fa-print"></span> Print Receipt </button>
                                        <button type="button" class="btn btn-secondary text-white vouchBtn"
                                            id='vouchBtn'>
                                            <span class="fa fa-print"></span> Print Voucher </button>

                                    </div>

                                </div>


                                <div class="card">
                                    <div class="card-body">
                                        <h4>Sales Contract</h4>
                                        <hr>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">EN Sale Contract
                                                    No.</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='sale_id' id='sale_id'
                                                        value='<?php echo $id?>' readonly autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Purchase Contract
                                                    No.</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="sale_type" name="sale_type"
                                                        style="width: 100px;">
                                                        <option selected>Choose...</option>
                                                        <option value="EXPORT">Export</option>
                                                        <option value="LOCAL">Local</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Type </label>
                                                <div class="col-md-12">
                                                    <input type="date" class='form-control' id="ship_date"
                                                        value="<?php echo $today; ?>" name="ship_date">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Transaction Date
                                                </label>
                                                <div class="col-md-12">
                                                    <input type="date" class='form-control' id="ship_date"
                                                        value="<?php echo $today; ?>" name="ship_date">
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Company
                                                    Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='sale_buyer'
                                                        id='sale_buyer' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Shipping
                                                    Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='info_lading'
                                                        id='info_lading' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Quantity</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='info_lading'
                                                        id='info_lading' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Price</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Address</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='sale_destination'
                                                        id='sale_destination' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Shipping
                                                    Port</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='info_lading'
                                                        id='info_lading' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Containers</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Packing</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Contact
                                                    Information</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Destination</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label style='font-size:15px' class="col-md-12">Other Terms</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Containers</h4>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col">Actions</th>
                                                        <th scope="col">Shipment No.</th>
                                                        <th scope="col">Container No.</th>
                                                        <th scope="col">Total Kilo</th>
                                                        <th scope="col">Loading Reweight</th>
                                                        <th scope="col">Buyer Reweight</th>
                                                        <th scope="col">DRC</th>
                                                        <th scope="col">Total Sale</th>
                                                        <th scope="col">Total COGS</th>
                                                        <th scope="col">Shipment Expenses</th>
                                                        <th scope="col">Profit/Loss</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><button>Inventory</button></td>
                                                        <td><input type="text" readonly></td>
                                                        <td><input type="text" placeholder="Container No."></td>
                                                        <td class="number-cell"><input type="number"
                                                                placeholder="Total Kilo" step="0.01">
                                                            kg</td>
                                                        <td class="number-cell"><input type="number"
                                                                placeholder="Loading Reweight" step="0.01"> kg</td>
                                                        <td class="number-cell"><input type="number"
                                                                placeholder="Buyer Reweight" step="0.01"> kg</td>
                                                        <td class="number-cell"><input type="number" placeholder="DRC"
                                                                step="0.01">
                                                            %
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Total Sale" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Total Cost" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Profit/Loss" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Profit/Loss" step="0.01">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h5>Payment Details</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Sales</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Amount Paid</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Amount in Peso</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Remaining
                                                    Balance</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Details</th>
                                                        <th scope="col">Amounts Paid</th>
                                                        <th scope="col">Exchange Rate</th>
                                                        <th scope="col">Peso Equivalent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" placeholder="Container No."></td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Total Sale" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Total Cost" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Profit/Loss" step="0.01">
                                                        </td>
                                                        <td class="number-cell">₱<input type="number"
                                                                placeholder="Profit/Loss" step="0.01">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Sales Summary</h4>
                                        <hr>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Shipment No.</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Kilo</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Loading
                                                    Reweight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Buyer
                                                    Reweight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Sale
                                                    ($)</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Peso
                                                    Sale</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Shipping
                                                    Expenses</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks' id='remarks'>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <center>
                                                <div class="col-6">
                                                    <label style='font-size:15px' class="col-md-12">NET
                                                        PROFIT/LOSS</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='remarks'
                                                            id='remarks'>
                                                    </div>
                                                </div>
                                            </center>
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

</body>

<script src="js/recording.js"></script>

</html>