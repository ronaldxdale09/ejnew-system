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
                            <div class="col-8">
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
                            <div class="col-4">
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Date</span>
                                    </div>
                                    <input type="date" style='text-align:left' name='date' id='r_date'
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

                                <div class="col-6">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='supplier' id='r_supplier'
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='location' id='r_location'
                                                 class="form-control">
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
                                                <input type="text" style='text-align:right' name='truck_num'  class="form-control" required>
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
                            <div class="row no-gutters">

                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Weight</label>

                                        <input type="text" style='text-align:right' name='weight' id='r_weight' readonly
                                            class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>

                                    </div>
                                </div>

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
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-4">
                        </div>
                        <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">LOT #</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='lot_num' id='r_lot_num'
                                                 class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                        <div class="col-5">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Reweight</label>
                                <input type="text" style='text-align:right' name='reweight' id='reweight'
                                    class="form-control" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <!--  end-->

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


<div class="modal fade" id="modal_drying" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Process</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='p_recording_id' hidden readonly
                        class="form-control">
                    <h5 style="text-align:center"> Are you sure to process : </h5>
                    <hr>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>

                                        <input type="text" style='text-align:center' name='weight' id='process_supplier'
                                            readonly class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>


                                    </div>
                                </div>

                                <div class="col">
                                    <label class="col-md-12">Reweight </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">

                                            <input type="text" style='text-align:right' name='cost' id='process_weight'
                                                readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="drying" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_mil_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Update</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">
                    <input type="text" style='text-align:left' name='recording_id' id='p_recording_id' hidden readonly
                        class="form-control">


                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Date Received</label>

                                        <input type="text" style='text-align:center' name='weight' id='m_received_date'
                                            readonly class="form-control">


                                    </div>
                                </div>

                                <div class="col">
                                    <label class="col-md-12">Milling Date </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">

                                            <input type="text" style='text-align:right' name='cost' id='m_milling_date'
                                                readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">

                                <div class="col-8">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Supplier</label>

                                        <input type="text" style='text-align:center' name='weight' id='supplier'
                                            readonly class="form-control" >


                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="col-md-12">LOT # </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">

                                            <input type="text" style='text-align:right' name='cost' id='m_lot_no'
                                                readonly class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <h5 style='text-align:center'>Input total crumbed weight: </h5>
                    </center>


                    <div class="input-group mb-1">

                        <input type="text" style='text-align:right;font-size:23px' name='crumbed_weight'
                            id='crumbed_weight' class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text" style='font-size:23px'>Kg</span>
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="drying" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
    </div>
</div>