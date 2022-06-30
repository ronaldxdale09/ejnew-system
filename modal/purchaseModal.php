<!-- Modal -->
<div class="modal" id="purchase-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">PURCHASE</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addPurchase.php" id='submitPurchase' method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">DATE</label>
                        <div class="col-md-12">
                            <input class='datepicker' type="date" id="date" name="date" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Voucher</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_voucher' id='p_voucher'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <select class='pur_category' name='pur_category' id='pur_category' style='width:200px'
                                    required>
                                    <option disabled="disabled" selected="selected">Select Category</option>
                                    <?php echo $purCatList; ?>
                                </select>
                            </div>

                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Customer Name</label>
                        <div class="col-md-8">
                            <input type="text" name='p_name' id='p_name' class="form-control form-control-line"
                                required>
                        </div>
                    </div>
                    <!-- net kilos -->
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-12 col-md-12">
                                <!--  -->
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Net Kilos</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_net-kilos' id='p_net-kilos'
                                        class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- end net kilos -->
                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Price: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_price' id='p_price'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end price -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Adjustment Price :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='p_adjustprice' name='p_adjustprice'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Less :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_less' id='p_less'
                                        class="form-control">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>

                    <!-- END Partial Payment -->

                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Partial Payment: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_partial_payment'
                                        id='p_partial_payment' onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end partial payment -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Net Total :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='p_net_total' name='p_net_total'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_total_amount'
                                        id='p_total_amount' class="form-control">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>

                    <!-- END Price -->

                    <!-- end net total and amount -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name='submit' id='submit' class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
</div>
</div>