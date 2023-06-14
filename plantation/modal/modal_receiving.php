<?php

$sql = "
(SELECT id, seller, type, net_weight as weight FROM rubber_transaction WHERE planta_status = 1 AND supplier_type = 0)
UNION ALL
(SELECT ejn_id as id, supplier as seller, type, total_buying_weight as weight FROM ejn_rubber_transfer WHERE planta_status = 1)
UNION ALL
(SELECT dry_id as id, seller as seller, type, net as weight FROM dry_price_transfer WHERE planta_status = 1)
ORDER BY id;
";

$result = mysqli_query($con, $sql);

if ($result) {
    $listPurchased = '';

    while ($arr = mysqli_fetch_assoc($result)) {
        $invoice = htmlspecialchars($arr['id'], ENT_QUOTES);
        $seller = htmlspecialchars($arr['seller'], ENT_QUOTES);
        $type = htmlspecialchars($arr['type'], ENT_QUOTES);

        $weight = number_format(htmlspecialchars($arr['weight'], ENT_QUOTES));


        // Combine 'id' and 'type' to be the 'value' of this option:
        $listPurchased .= '<option value="' . $type . ',' . $arr['id'] . '">' . $type . ' #' . $invoice . ' - ' . $seller . ' - ' . $weight . ' kg </option>';
    }
} else {
    echo "Error querying database: " . mysqli_error($con);
}

?>

<div class="modal fade" id="newReceiving" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="input-group mb-12">
                                <label class="col-md-12"></label>
                                <div class="col-md-12 text-center">
                                    <select required="required" class='source col-md-12 r_select_purchase' name='purchased_id' id='r_select_purchase' required>
                                        <option disabled="disabled" selected="selected" value="">Select Receiving
                                        </option>
                                        <?php echo $listPurchased; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <br>

                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='supplier' id='r_supplier' readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='location' id='r_location' class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Lot No.</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='lot_num' id='r_lot_num' class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="r_date">Date and Time</label>
                                    <input type="datetime-local" style='text-align:left' name='date' id='r_date' required value='' class="form-control" style='background-color:white;border:0px solid #ffffff;'>
                                </div>

                                <div class="col">
                                    <label for="driver">Driver</label>
                                    <input type="text" style='text-align:left' name='driver' class="form-control">
                                </div>

                                <div class="col-3">
                                    <label for="truck_num">Truck No.</label>
                                    <input type="text" style='text-align:right' name='truck_num' class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <center style="margin: 0px 60px;">
                                    <div class="row no-gutters">
                                        <div class="col" hidden>
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Total Purchase Cost</label>
                                                <span class="input-group-text">₱</span>
                                                <input type="text" style='text-align:right' name='total_cost' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id='purchase_total_cost' readonly class="form-control">
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Buying Weight</label>

                                                <input type="text" style='text-align:right' name='weight' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id='r_weight' readonly class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Reweight</label>
                                                <input type="text" style='text-align:right' name='reweight' id='reweight' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' required>
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
                <button type="submit" name='add' class="btn btn-success text-white">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateReceiving" tabindex="-1" role="dialog" aria-labelledby="updateReceivingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateReceivingLabel">Rubber | Update Receiving</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/receiving_function.php" method="POST">
                    <!-- ... START -->
                    <input type="text" style='text-align:left' name='recording_id' id='ru_recording_id' class="form-control" hidden>
                    <!-- Your form content -->
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='ru_supplier' id='ru_supplier' class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='ru_location' id='ru_location' class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Lot No.</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='ru_lot_num' id='ru_lot_num' class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ru_date">Date and Time</label>
                                    <input type="datetime-local" name='ru_date' id='ru_date' value='' class="form-control" style='text-align:left; background-color:white; border:1px solid'>
                                </div>
                                <div class="col">
                                    <label for="ru_driver">Driver</label>
                                    <input type="text" style='text-align:left' name='ru_driver' id='ru_driver' required class="form-control">
                                </div>

                                <div class="col-3">
                                    <label for="ru_truck_num">Truck No.</label>
                                    <input type="text" style='text-align:right' name='ru_truck_num' id='ru_truck_num' class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-group">
                                <center style="margin: 0px 60px;">
                                    <div class="row no-gutters">

                                        <div class="col" hidden>
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Total Purchase Cost</label>
                                                <span class="input-group-text">₱</span>
                                                <input type="text" style='text-align:right' name='total_cost' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id='ru_total_cost' class="form-control" readonly>
                                                <div class="input-group-append">

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Entry Weight</label>

                                                <input type="text" style='text-align:right' name='ru_weight' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" id='ru_weight' class="form-control" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-12">
                                                <label class="col-md-12">Reweight</label>
                                                <input type="text" style='text-align:right' name='ru_reweight' id='ru_reweight' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
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
                <button type="submit" name='update' class="btn btn-success text-white">Submit</button>
                <button type="submit" name='delete' class="btn btn-danger text-white">Remove</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_transMil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" style="text-align:center" name="recording_id" id="rt_receving_id" readonly class="form-control" hidden>
                        <!-- <div class="row">
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
                                   
                                </div>
                            </div>
                        </div>

                        <br> -->
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" style="text-align:center" id="rt_supplier" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" style="text-align:center" id="rt_location" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Lot No.</label>
                                    <input type="text" style="text-align:center" id="rt_lot_no" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <div class="input-group mb-1">
                                        <input type="text" style="text-align:right" id="rt_weight" readonly class="form-control">
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
                                        <input type="text" style="text-align:right" name="reweight" id="rt_reweight" readonly class="form-control">
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