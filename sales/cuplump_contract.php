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
                                                    <input type="text" class="form-control" name='wet_sale_id'
                                                        id='wet_sale_id' value='<?php echo $id?>' readonly
                                                        autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract
                                                    No.</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='wet_buyer_contract'
                                                        id='wet_buyer_contract' autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="wet_sale_type" name="wet_sale_type"
                                                        style="width: 100px;">
                                                        <option value="EXPORT">Export</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Transaction Date</label>
                                                <div class="col-md-12">
                                                    <input type="date" class='form-control' id="wet_ship_date"
                                                        value="<?php echo $today; ?>" name="wet_ship_date">
                                                </div>
                                            </div>
                                        </div>


                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Company
                                                    Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='wet_sale_buyer'
                                                        id='wet_sale_buyer' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name='wet_shipping_date'
                                                        id='wet_shipping_date' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Quantity</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='wet_quantity'
                                                        id='wet_quantity' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Price</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" name='wet_price'
                                                        id='wet_price'>
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
                                                <label style='font-size:15px' class="col-md-12">Shipping Port</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='info_lading'
                                                        id='info_lading_2' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Containers</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source_2'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Packing</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source_2'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Contact
                                                    Information</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='voyage' id='voyage_2'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Destination</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='source' id='source_3'
                                                        tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label style='font-size:15px' class="col-md-12">Other Terms</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='remarks'
                                                        id='remarks_2'>
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
                                                        <td><button>Update</button></td>
                                                        <td><input type="text" placeholder="Shipment No."></td>
                                                        <td><input type="text" placeholder="Container No."></td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    name='total_kilo' id='total_kilo' autocomplete='off'
                                                                    style="width: 100px;" />
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    name='loading_reweight' id='loading_reweight'
                                                                    autocomplete='off' style="width: 100px;" />
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    name='buyer_reweight' id='buyer_reweight'
                                                                    autocomplete='off' style="width: 100px;" />
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" name='drc'
                                                                    id='drc' autocomplete='off' style="width: 100px;" />
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" class="form-control"
                                                                    name='total_sale' id='total_sale' required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" class="form-control"
                                                                    name='total_cogs' id='total_cogs' required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" class="form-control"
                                                                    name='shipment_expenses' id='shipment_expenses'
                                                                    required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" class="form-control"
                                                                    name='profit/loss' id='profit/loss' required>
                                                            </div>
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