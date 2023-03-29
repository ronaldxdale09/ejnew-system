<?php 


$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;





$seller = "SELECT * FROM planta_seller";
$result = mysqli_query($con, $seller);
$sellerList='';
while($arr = mysqli_fetch_array($result))
{
$sellerList .= '
<option value="'.$arr["name"].'">'.$arr["name"].'</option>';
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
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-12">
                                    <label class="col-md-12"></label>
                                    <div class="col-md-12">
                                        <select required="required" class='source col-md-12' name='source' id='source'>
                                            <option disabled="disabled" selected="selected" value="">Select Invoice
                                            </option>
                                            <!-- INVOICE DITO NOT SELLER -->
                                            <?php echo $sellerList; ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Date</span>
                                    </div>
                                    <input type="date" style='text-align:left' name='date' id='date'
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
                                            <input type="text" style='text-align:left' name='seller' id='seller'
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Location</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='location' id='location'
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Lot No.</label>
                                        <div class="col-md-12">
                                            <input type="text" style='text-align:left' name='lot_num' id='lot_num' readonly
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
                                                <input type="text" style='text-align:left' name='driver' id='driver'
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
                                                    id='truck_num' class="form-control">
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

                                        <input type="text" style='text-align:right' name='weight' id='weight' readonly
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
                                            <input type="text" style='text-align:right' name='cost' id='cost' readonly
                                                class="form-control">
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
                                            <input type="text" style='text-align:right' name='total_cost' id='total_cost' readonly
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr>

                            <div class="row">

                                <div class="col-7">
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

<script>
$('#newReceiving').on('shown.bs.modal', function() {
    $('.source', this).chosen();
});
</script>



<div class="modal fade" id="modal_process" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Purchase Contract</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/transaction_new.php" method="POST">
                    <!-- ... START -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <input type="date" id="date" name="date" class='datepicker' value='<?php echo $dateNow?>'
                                required>
                        </div>
                        <!--end  -->
                        <div class="col-6 col-md-6">

                        </div>
                        <!--  end-->
                    </div>
            </div>
            <center>
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-6 col-md-6">
                            <div class="input-group mb-12">
                                <label class="col-md-12">Seller</label>
                                <div class="col-md-12">
                                    <select required="required" class='contact_seller col-md-12' name='name' id='name'>
                                        <option disabled="disabled" selected="selected" value="">Select Seller
                                        </option>
                                        <?php echo $sellerList; ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!--end  -->
                        <div class="col-6 col-md-6">
                            <div class="input-group mb-1">
                                <label class="col-md-12">Type</label>
                                <div class="col-md-12">
                                    <select required="required" class='contact_seller col-md-12' name='type' id='type'>
                                        <option disabled="disabled" selected="selected" value="">Select Type
                                        </option>
                                        <option value="WET">WET</option>
                                        <option value="BALES">BALES</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--  end-->
                    </div>
                </div>
            </center>
            <br>
            <div class="form-group">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-5 col-md-12">
                        <!--  -->
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"
                                    style='color:black;font-weight: bold;'>Contract Quantity</span>
                            </div>
                            <input type="text" style='text-align:right' name='quantity' id='quantity'
                                class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-5 col-md-12">
                        <!--  -->
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"
                                    style='color:black;font-weight: bold;'>₱/KG</span>
                            </div>
                            <input type="text" style='text-align:right' name='ca' id='ca' class="form-control"
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
            <!-- END -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='new_contract' class="btn btn-success text-white">Submit</button>
            </form>
        </div>
    </div>
</div>