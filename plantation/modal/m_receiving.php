<div class="modal fade" id="newReceiving" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubber | Purchase Contract</h5>
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
                                <div class="input-group mb-12">
                                    <input type="date" style='text-align:left' name='v_contact' id='v_contact'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">

                            </div>
                        </div>
                    </div>
                    <br>
                    <center>
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-4 col-md-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12"></label>
                                        <div class="col-md-12">
                                            <select required="required" class='select_seller col-md-12' name='source'
                                                id='source'>
                                                <option disabled="disabled" selected="selected" value="">Select Seller
                                                </option>
                                                <?php echo $sellerList; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!--end  -->
                                <div class="col-4 col-md-4">
                                    <div class="input-group mb-1">
                                        <label class="col-md-12"></label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>ADDRESS</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='ca' id='ca'
                                                class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)">
                                        </div>
                                    </div>
                                </div>
                                <!--  end-->
                                <div class="col-4 col-md-4">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12"></label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>LOT</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='ca' id='ca'
                                                class="form-control" onkeypress="return CheckNumeric()"
                                                onkeyup="FormatCurrency(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </center>
                    <div class="form-group">
                        <center>
                            <div class="form-group">
                                <div class="row no-gutters">
                                    <div class="col-4 col-md-4">
                                        <div class="input-group mb-12">
                                            <label class="col-md-12">Driver</label>
                                            <div class="col-md-12">
                                                <input type="text" style='text-align:left' name='ca' id='ca'
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <!--end  -->
                                    <div class="col-4 col-md-4">
                                        <label class="col-md-12"> </label>
                                        <div class="input-group mb-1">
                                            <div class="input-group mb-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                                        style='color:black;font-weight: bold;'>Truck #</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='ca' id='ca'
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  end-->
                                    <div class="col-4 col-md-4">

                                    </div>
                                </div>
                                <br>
                        </center>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row no-gutters">
                                <div class="col-5 col-md-5">
                                    <div class="input-group mb-12">
                                        <label class="col-md-12">Actual Kilo</label>
                                    
                                        <input type="text" style='text-align:right' name='quantity' id='quantity'
                                            class="form-control" onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>

                                    </div>
                                </div>
                                <!--end  -->
                                <div class="col-4 col-md-4">
                                    <label class="col-md-12"> </label>
                                    <div class="input-group mb-1">
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"
                                                    style='color:black;font-weight: bold;'>Truck #</span>
                                            </div>
                                            <input type="text" style='text-align:right' name='ca' id='ca'
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--  end-->
                                <div class="col-4 col-md-4">

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