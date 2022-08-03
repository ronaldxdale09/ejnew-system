<!-- Modal -->
<div class="modal fade" id="cashadvanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">CASH ADVANCE</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addCashAdvance.php" id='myform' method="POST">
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
                                                    id="date" name="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' class="form-control form-control-line"
                                                    autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">PARTICULARS</label>
                                            <div class="col-md-12">
                                                <input type="text" name='particular'
                                                    class="form-control form-control-line" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">BUYING STATION</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="datalistOptions" name='station'
                                                    id="station" placeholder="Select Buying Station" autocomplete='off'>
                                                <datalist id="datalistOptions"> <?php echo $buyingStation; ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Subject</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="typeCA" name='category' id="category"
                                                    placeholder="Select Subject" autocomplete='off'>
                                                <datalist id='typeCA'>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Customer">Customer</option>
                                                    <option value="Karpentero">Karpentero</option>
                                                    <option value="Topper">Topper</option>
                                                    <option value="Maloong Contractual">Maloong Contractual</option>
                                                </datalist>
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
                                                    class="col-md-12">Amount: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='amount'
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