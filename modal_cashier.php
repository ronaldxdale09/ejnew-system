<style>
.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

<!-- BARCODE -->
<form action="function/cashierVerifyProd.php" id='myForm' method="POST">
    <div class="modal fade" id="verify_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CASHIER</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ... START -->
                    <center>
                        <input type="text" id='cart_id' name='cart_id' hidden>
                        <input type="text" id='prod_id' name='prod_id' hidden>
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"
                                                style='color:black;font-weight: bold;'>Barcode</span>
                                        </div>
                                        <input type="number" style='text-align:left' id='inputed_barcode'
                                            name='quantity' class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                    <br>
                    <!--  -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Product Name</span>
                                    </div>
                                    <input type="text" style='text-align:left' name='scanned_name' id='scanned_name'
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!--  -->
                    <div class="row">
                        <div class="column">
                            <div class="form-group">
                                <div class="row no-gutters">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="input-group mb-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>Quantity</span>
                                            </div>
                                            <input type="number" style='text-align:left' name='scanned_quantity'
                                                id='scanned_quantity' class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="form-group">
                                <div class="row no-gutters">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <div class="input-group mb-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>Each: ₱ </span>
                                            </div>
                                            <input type="text" style='text-align:left' name='each_price'
                                                id='each_price' class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                        <br>
                        <hr>
                        <br>
                        <!--  -->
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="input-group mb-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"
                                                style='color:black;font-weight: bold;'>Total ₱ </span>
                                        </div>
                                        <input type="text" style='text-align:left' name='scanned_price' id='scanned_price'
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!--  -->
                </div>
                <div class="modal-footer">
                    <button type="submit" id='confirmCashier' name='confirmCashier'
                        class="btn btn-success text-white">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END -->