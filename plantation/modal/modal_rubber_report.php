<?php

$sql = "SELECT id, seller FROM rubber_transaction";
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Transaction Report
                </h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/receiving_function.php" method="POST">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">

                                <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">ID</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" style='text-align:left' id='recording_id'
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" style='text-align:left' name='seller'
                                                id='record_supplier' class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" style='text-align:left' name='location'
                                                id='record_loc' class="form-control">
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
                                            <input readonly type="text" style='text-align:left' name='lot_num'
                                                id='record_lot' class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Driver</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" style='text-align:left' name='driver'
                                                id="record_driver" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Truck No.</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" style='text-align:left' name='driver'
                                                id="record_truck" class="form-control">
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
                                                    <input readonly type="text" class='form-control' id="date_purchased"
                                                        name="purchasing_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Cuplump Weight</label>
                                                <input readonly type="text" style='text-align:right' name='weight'
                                                    id='wet_weight' class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
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
                                                    <input readonly type="text" class='form-control' id="date_received"
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
                                                    <span class="input-group-text">kg</span>
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
                                                <input readonly type="text" style='text-align:right'
                                                    name='crumbed_weight' id='crumbed_weight' class="form-control"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
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
                                                    <input readonly type="text" class='form-control' id="dry_date"
                                                        name="milling_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Blanket Weight</label>
                                                <input readonly type="text" style='text-align:right' name='dry_weight'
                                                    id='dry_weight' class="form-control"
                                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </center>

                            <hr>

                            <center>

                                <div class="form-group">
                                    <div class="row no-gutters">

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label style='font-size:15px' class="col-md-12">Date Produced </label>
                                                <div class="col-md-12">
                                                    <input readonly type="text" class='form-control'
                                                        id="production_date" name="milling_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Bale Weight</label>
                                                <input readonly type="text" style='text-align:right' name='bale_weight'
                                                    id='bale_weight' class="form-control"
                                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">DRC</label>
                                                <input readonly type="text" style='text-align:right' name='drc' id='drc'
                                                    class="form-control" onkeypress="return CheckNumeric()"
                                                    onkeyup="FormatCurrency(this)" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div id='pressing_modal_update_table'></div>
                        </div>

                        <div class="col" hidden>
                            <center> <H5>Milling Record</H5></center>
                            <div id='milling_record'></div>
                            <br> <hr> <br>
                            <center> <H5>Drying Record</H5></center>
                            <div id='dry_table_record'></div>
                            
                        </div>
                    </div>
                    <!-- ... START -->




                    <!-- <hr>
                   
                    <hr> -->
                    <br>

                    <hr>

            </div>

            </center>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
</div>