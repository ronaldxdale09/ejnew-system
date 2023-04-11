<?php

$sql = "SELECT id, invoice, seller FROM rubber_transaction";
$result = mysqli_query($con, $sql);
$listPurchased = '';
while ($arr = mysqli_fetch_assoc($result)) {
    $invoice = htmlspecialchars($arr['id'], ENT_QUOTES);
    $seller = htmlspecialchars($arr['seller'], ENT_QUOTES);
    $listPurchased .= '<option value="'.$arr['id'] . '">INVOICE #' . $invoice . ' - ' . $seller . '</option>';
}

?>

<div class="modal fade" id="newReceiving" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Transaction
                    <!-- INSERT ID NO. --> Report
                </h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/receiving_function.php" method="POST">


                    <!-- ... START -->


                    <div class="row">

                        <div class="col-3">
                            <div class="input-group mb-12">
                                <label class="col-md-12">ID</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='lot_num' id='r_lot_num'
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Supplier</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='seller' id='r_supplier'
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Location</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='location' id='r_location'
                                        class="form-control">
                                </div>
                            </div>
                        </div>



                    </div>

                    <br>

                    <div class="row">

                        <div class="col-3">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Lot No.</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='lot_num' id='r_lot_num'
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Driver</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='driver' id="driver"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Truck No.</label>
                                <div class="col-md-12">
                                    <input readonly type="text" style='text-align:left' name='driver' id="driver"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>


                    <center style="margin: 0px 40px;">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label style='font-size:15px' class="col-md-12">Date Purchased </label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class='form-control' id="purchasing_date"
                                                name="purchasing_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Cuplump Weight</label>
                                        <input readonly type="text" style='text-align:right' name='weight' id='r_weight'
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label style='font-size:15px' class="col-md-12">Date Received </label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class='form-control' id="receiving_date"
                                                name="receiving_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Reweight</label>
                                        <input readonly type="text" style='text-align:right' name='reweight'
                                            id='reweight' class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label style='font-size:15px' class="col-md-12">Date Milled </label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class='form-control' id="milling_date"
                                                name="milling_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Crumbed Weight</label>
                                        <input readonly type="text" style='text-align:right' name='crumbed_weight'
                                            id='crumbed_weight' class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label style='font-size:15px' class="col-md-12">Date Dried </label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class='form-control' id="milling_date"
                                                name="milling_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Dry Weight</label>
                                        <input readonly type="text" style='text-align:right' name='crumbed_weight'
                                            id='crumbed_weight' class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label style='font-size:15px' class="col-md-12">Date Produced </label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class='form-control' id="milling_date"
                                                name="milling_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Bale Weight</label>
                                        <input readonly type="text" style='text-align:right' name='crumbed_weight'
                                            id='crumbed_weight' class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </center>

                    <!-- NEW -->

                    <hr>

                    <center>

                        <div class="row no-gutters">

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label style='font-size:15px' class="col-md-12">Date Sold </label>
                                    <div class="col-md-12">
                                        <input readonly type="text" class='form-control' id="milling_date"
                                            name="milling_date">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">Total Cost</label>
                                    <input readonly type="text" style='text-align:right' name='bale_excess'
                                        id='bale_excess' class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">Cost per Kilo</label>
                                    <input readonly type="text" style='text-align:right' name='bale_excess'
                                        id='bale_excess' class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">DRC</label>
                                    <input readonly type="text" style='text-align:right' name='bale_excess'
                                        id='bale_excess' class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row no-gutters">

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">Bale Type</label>
                                    <input readonly type="text" style='text-align:right' name='bale_total_kilo'
                                        id='bale_total_kilo' class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">Kilo per Bale</label>
                                    <input readonly type="text" style='text-align:right' name='bale_kilo' id='bale_kilo'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">No. of Bales</label>
                                    <input readonly type="text" style='text-align:right' name='bale_no' id='bale_no'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>

                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <label class="col-md-12">Excess Kilo</label>
                                    <input readonly type="text" style='text-align:right' name='bale_total_kilo'
                                        id='bale_total_kilo' class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>

                        </div>


            </div>

            </center>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
</div>
</div>