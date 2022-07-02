<?php 
 $contract = mysqli_query($con, "SELECT  COUNT(*) from cash_agreement  "); 
 $contractNo = mysqli_fetch_array($contract);

 $ContractCount= sprintf("%'03d", $contractNo[0]);
?>
<div class="modal fade" id="newContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CASH AGREEMENT</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
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
                                        value='<?php echo  $ContractCount ?>'
                                        readonly>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <input type="date" id="date" name="date" class='datepicker' required>
                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <label class="col-md-12">Seller</label>
                            <div class="col-md-8">
                                <select class='select_seller' name='name' id='name'>
                                    <option disabled="disabled" selected="selected">Select Seller</option>
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
                                    <input type="number" style='text-align:right' name='quantity' id='quantity'
                                        class="form-control">
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
                                            style='color:black;font-weight: bold;'>Amount of CA</span>
                                    </div>
                                    <input type="number" style='text-align:right' name='ca' id='ca'
                                        class="form-control">
                                  
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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