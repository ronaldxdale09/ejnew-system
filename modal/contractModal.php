<?php 


 $contract = mysqli_query($con, "SELECT  COUNT(*) from contract_purchase  "); 
 $contractNo = mysqli_fetch_array($contract);

 $generate= sprintf("%'03d", $contractNo[0]+1);
 $today = date("Y");
 $code = $today .'-'. $generate;


 $ContractCount= sprintf("%'03d", $code[0]);

 $month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;


$seller = "SELECT * FROM seller ";
$result = mysqli_query($con, $seller);
$sellerList='';
while($arr = mysqli_fetch_array($result))
{
$sellerList .= '
<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
}


?>
<style>
select:invalid {
    height: 0px !important;
    opacity: 0 !important;
    position: absolute !important;
    display: flex !important;
}

select:invalid[multiple] {
    margin-top: 15px !important;
}
</style>
<div class="modal fade" id="newContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Contract</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newContract.php" method="POST">
                    <!-- ... START -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Contract</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='v_contact' id='v_contact'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                        value="<?php echo  $code ?>" readonly>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <input type="date" id="date" name="date" class='datepicker' value='<?php echo $dateNow?>' required>
                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <label class="col-md-12">Seller</label>
                            <div class="col-md-8">
                                <select required="required" class='select_seller' name='name' id='name'  >
                                    <option disabled="disabled" selected="selected" value="" >Select Seller</option>
                                    <?php echo $sellerList; ?>
                                </select>
                            </div>
                            <br>
                    </center>
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
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
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
                <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('#newContract').on('shown.bs.modal', function() {
    $('.select_seller', this).chosen();
});
</script>

<!--                       -->
<div class="modal fade" id="newContract1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Contract</h5>
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
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Contract</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='v_contact' id='v_contact'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                        value="<?php echo  $code ?>" readonly>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <input type="date" id="date" name="date" class='datepicker' value='<?php echo $dateNow?>' required>
                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <label class="col-md-12">Seller</label>
                            <div class="col-md-8">
                                <select required="required" class='contact_seller' name='name' id='name'  >
                                    <option disabled="disabled" selected="selected" value="" >Select Seller</option>
                                    <?php echo $sellerList; ?>
                                </select>
                            </div>
                            <br>
                    </center>
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
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" required>
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
</div>
<script>
$('#newContract1').on('shown.bs.modal', function() {
    $('.contact_seller', this).chosen();
});
</script>
