<?php
 $month = date("m");
 $day = date("d");
 $year = date("Y");
 $dateNow = $year . "-" . $month . "-" . $day;
 
?>
<!-- Modal -->
<div class="modal fade" id="maloongToppers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Buahan Toppers</h5>
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
                                                <input class='datepicker' value="<?php echo $dateNow; ?>" type="date"
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

                                <div class="form-group">
                                    <label class="col-md-12">Particulars</label>
                                    <div class="col-md-12">
                                        <input type="text" name='name' id='name' class="form-control form-control-line"
                                            autocomplete='off' required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group mb-12">
                                                        <label style='font-size:15px;font-weight: bold;'
                                                            class="col-md-12">
                                                            Net Kilos:
                                                        </label>
                                                        <input type="text" style='text-align:right' name='net_kilos'
                                                            id='net_kilos' class="form-control"
                                                            onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off'>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">
                                                    Price:
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='price'
                                                            id='price' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row no-gutters">
                                        <label style='font-size:15px;font-weight: bold;' class="col-md-12">
                                            Total:
                                        </label>
                                        <div class="col-12">
                                            <!--  -->
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='total'
                                                    id='total' onkeypress="return CheckNumeric()"
                                                    onkeyup="FormatCurrency(this)" class="form-control"
                                                    autocomplete='off' readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">EJN
                                                    Percent (%):
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">

                                                        <input type="text" style='text-align:right' name='ejn_percent'
                                                            id='ejn_percent' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off'>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Toppers Percent (%):
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">

                                                        <input type="text" style='text-align:right' name='topper_percent'
                                                            id='topper_percent' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off'>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">EJN
                                                    Total:
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='ejn_total'
                                                            id='ejn_total' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off' readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">Gross
                                                    Amount:
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='topper_gross'
                                                            id='topper_gross' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off' reaonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">Less Category</label>
                                                    <div class="col-md-12">
                                                        <input class="form-control" list="typeLess" name='less_category'
                                                            id="less_category" placeholder="Select Subject"
                                                            autocomplete='off'>
                                                        <datalist id='typeLess'>
                                                            <option value="Cash Advance">Cash Advance</option>
                                                            <option value="SSS">SSS</option>
                                                            <option value="Rice">Rice</option>

                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">Less
                                                    (Toppers)
                                                </label>
                                                <div class="col-12">
                                                    <!--  -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='less'
                                                            id='less' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            autocomplete='off'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <label style='font-size:15px;font-weight: bold;'
                                                            class="col-md-12">Toppers Total: </label>
                                                        <div class="col-md-12">
                                                            <!--  -->
                                                            <div class="input-group mb-5">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    name='topper_total' id='topper_total'
                                                                    class="form-control"
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" autocomplete='off'
                                                                    readonly>
                                                            </div>
                                                        </div>
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