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
                <h5 class="modal-title" id="exampleModalLabel">Rubber | New Receiving </h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/receiving_function.php" method="POST">
                    <!-- ... START -->

                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-5">
                                <div class="input-group mb-12">
                                    <label class="col-md-12"></label>
                                    <div class="col-md-12">
                                        <select required="required" class='source col-md-12 r_select_purchase'
                                            name='purchased_id' id='r_select_purchase'>
                                            <option disabled="disabled" selected="selected" value="">Select Invoice
                                            </option>
                                            <!-- INVOICE DITO NOT SELLER -->
                                            <?php echo $listPurchased; ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;'>Date</span>
                                    </div>
                                    <input type="datetime-local" style='text-align:left' name='date' id='r_date'
                                        value='<?php echo $dateNow?>' class="form-control"
                                        style='background-color:white;border:0px solid #ffffff;'>
                                </div>
                            </div>

                          
                            <!--end  -->
                            <div class="col-6 col-md-6">

                            </div>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='supplier' id='r_supplier'
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='location' id='r_location'
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Lot No.</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='lot_num' id='r_lot_num'
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </center>

                    <div class="form-group">
                        <center>
                            <div class="form-group">
                                <div class="row no-gutters">
                                    <div class="col">
                                        <div class="input-group mb-12">
                                            <label class="col-md-12">Driver</label>
                                            <div class="col-md-12">
                                                <input type="text" style='text-align:left' name='driver' required
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <!--end  -->
                                    <div class="col">
                                        <label class="col-md-12"> </label>
                                        <div class="input-group mb-1">
                                            <div class="input-group mb-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                                        style='color:black;'>Truck #</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='truck_num'
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    <!--  end-->


                    <hr>
                    <div class="form-group">
                        <div class="form-group">
                            <center style="margin: 0px 60px;">
                                <div class="row no-gutters">
                                    <div class="col">
                                        <div class="input-group mb-12">
                                            <label class="col-md-12">Weight</label>

                                            <input type="text" style='text-align:right' name='weight' id='r_weight'
                                                readonly class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">kg</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- 
                                <div class="col-3">
                                    <label class="col-md-12">Kilo Cost</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>₱</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='cost' id='r_kilo_cost'
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <label class="col-md-12">Total Cost</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>₱</span>
                                            </div>
                                            <input type="text" style='text-align:right' name=' total_cost'
                                                id='r_total_cost' readonly class="form-control">
                                        </div>
                                    </div>
                                </div> -->

                                    <div class="col">
                                        <div class="input-group mb-12">
                                            <label class="col-md-12">Reweight</label>
                                            <input type="text" style='text-align:right' name='reweight' id='reweight'
                                                class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal_transMil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Transfer to Milling</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Date Received</label>
                                    <input type="text" style="text-align:center" id="rt_receiving_date" readonly
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col">
                            </div>


                            <div class="col-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" style="text-align:center" name="recording_id" id="rt_receving_id"
                                        readonly class="form-control">
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" style="text-align:center" id="rt_supplier" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" style="text-align:center" id="rt_location" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Lot No.</label>
                                    <input type="text" style="text-align:center" id="rt_lot_no" readonly
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <div class="input-group mb-1">
                                        <input type="text" style="text-align:right" id="rt_weight" readonly
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Reweight</label>
                                    <div class="input-group mb-1">
                                        <input type="text" style="text-align:right" name="reweight" id="rt_reweight"
                                            readonly class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="milling" class="btn btn-warning text-dark">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>