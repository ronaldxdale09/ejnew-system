<?php $month = date("m");
$day = date("d");
$year = date("Y");
$today = $year . "-" . $month . "-" . $day;
$today = $year . "-" . $month . "-" . $day;

$seller = "SELECT * FROM rubber_seller ";
$result = mysqli_query($con, $seller);
$sellerList='';
while($arr = mysqli_fetch_array($result))
{
$sellerList .= '
<option value="'.$arr["name"].'">[ '.$arr["id"].' ]      '.$arr["name"].'</option>';
}


?>
<div class="modal fade" id="copraCashAdvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RUBBER | CASH AGREEMENT</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newCA.php" method="POST">
                    <!-- ... START -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <input class='datepicker' value="<?php echo $today; ?>" type="date" id="date"
                                        name="date" required>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <select class="form-select" name='ca_category' id='ca_category' style='width:200px'
                                        required>
                                        <option disabled="disabled" selected="selected" value="">Select Category
                                        </option>
                                        <option value='copra'>Copra</option>
                                        <option value='ntc'>NTC</option>
                                        <option value='trucking'>Trucking</option>
                                        <option value='others'>Others</option>
                                        <option value='Rubber'>Rubber</option>
                                    </select>

                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <hr>
                    <center>
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-6 col-md-6">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Seller</label>
                                        <div class="col-md-12">
                                            <select required="required" class='ca_seller col-md-12' name='name'
                                                id='name'>
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
                                            <select required="required" class='ca_seller col-md-12' name='type'
                                                id='type'>
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
                    <hr>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-12">
                                <!--  -->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='ca_amount' id='ca_amount' required
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='submit' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$('#copraCashAdvance').on('shown.bs.modal', function() {
    $('.ca_seller', this).chosen();
});
</script>


<div class="modal fade" id="copraCashAdvance1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RUBBER | CASH AGREEMENT</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/transaction_new.php" method="POST">
                    <!-- ... START -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <input class='datepicker' value="<?php echo $today; ?>" type="date" id="date"
                                        name="date" required>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-5 col-md-5">
                                <div class="form-group">
                                    <select class="ca_category form-select " name='ca_category' id='ca_category'
                                        style='width:200px' required>
                                        <option disabled="disabled" selected="selected" value="">Select Category
                                        </option>
                                        <option value='Copra'>Copra</option>
                                        <option value='NTC'>NTC</option>
                                        <option value='Trucking'>Trucking</option>
                                        <option value='Others'>Others</option>
                                        <option value='Rubber'>Rubber</option>
                                    </select>

                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <hr>
                    <center>
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-6 col-md-6">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Seller</label>
                                        <div class="col-md-12">
                                            <select required="required" class='ca_seller1 col-md-12' name='name'
                                                id='name'>
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
                                            <select required="required" class='ca_seller1 col-md-12' name='type'
                                                id='type'>
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
                    <hr>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-12">
                                <!--  -->
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='ca_amount' id='ca_amount' required
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='new_ca' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$('#copraCashAdvance1').on('shown.bs.modal', function() {
    $('.ca_seller1', this).chosen();
});
</script>

<script>
$('#copraCashAdvance1').on('shown.bs.modal', function() {
    $('.ca_category', this).chosen();
});
</script>






<div class="modal fade" id="editCA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">UPDATE | CASH AGREEMENT</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newCA.php" method="POST">
                    <!-- ... START -->
                    <input type='text' class='form-control' id='e_id' name='id' readonly hidden>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                      <input type='text' class='form-control' id='e_name' readonly>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-5 col-md-5">
                                <input type='text' class='form-control' id='e_address' readonly>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <hr>
                    <center>
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-6 col-md-6">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">WET Cash Advance</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>₱</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='wet' id='e_wet_ca'
                                                required class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)">
                                        </div>

                                    </div>
                                </div>
                                <!--end  -->
                                <div class="col-6 col-md-6">
                                <div class="input-group mb-12">
                                        <label class="col-md-12">Bales Cash Advance</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>₱</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='bales' id='e_bales_ca'
                                                required class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)">
                                        </div>

                                    </div>
                                </div>
                                <!--  end-->
                            </div>
                        </div>
                    </center>
                    <hr>
                    
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='update' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>