<!-- Modal -->
<div class="modal fade" id="modalBuahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">BUAHAN TOPPERS</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addBuahan.php" id='myform' method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">DATE</label>
                                            <div class="col-md-12">
                                                <input class='datepicker' value="<?php echo $today; ?>" type="date"
                                                    id="date" name="date" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' autocomplete='off' class="form-control form-control-line"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group mb-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                                        style='color:black;font-weight: bold;'>Net Kilos</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='net_kilos'
                                                    id='net_kilos' class="form-control"
                                                    onkeypress="return CheckNumeric()" autocomplete='off'  onkeyup="FormatCurrency(this)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Price: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='price' id='price'
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Total: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='total'  id='total' 
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END BALANCE -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
</div>
</div>