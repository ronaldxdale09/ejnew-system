<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

?>
<!-- Modal -->
<div class="modal fade" id="maloongToppers" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Maloong Toppers</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="function/ledger/addMaloong.php" id='myform' method="POST">
                <div class="modal-body p-4">

                    <div class="row">
                        <div class="col ">
                            <div class="form-group">
                                <label for="date">DATE</label>
                                <input class='form-control ' value="<?php echo $dateNow; ?>" type="date" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for='voucher'>VOUCHER #</label>
                                <input type="text" name='voucher' class="form-control" autocomplete='off' required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for='name'>Particulars</label>
                        <input type="text" name='name' id='name' class="form-control" autocomplete='off' required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for='net_kilos'>Net Kilos</label>
                            <div class="input-group">
                                <input type="text" name='net_kilos' id='net_kilos' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='ejn_price'>EJN Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='ejn_price' id='ejn_price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for='ejn_total'>EJN Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='ejn_total' id='ejn_total' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='topper_price'>Toppers Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='topper_price' id='topper_price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for='topper_gross'>Gross Amount</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" name='topper_gross' id='topper_gross' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="less_category">Less Category</label>
                            <input class="form-control" list="typeLess" name='less_category' id="less_category" placeholder="Select Subject" autocomplete='off'>
                            <datalist id='typeLess'>
                                <option value="No Deductions" selected>No Deductions</option>
                                <option value="Cash Advance">Cash Advance</option>
                                <option value="SSS">SSS</option>
                                <option value="Rice">Rice</option>
                            </datalist>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='less'>Less (Toppers)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='less' id='less' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for='topper_total'>Toppers Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='topper_total' id='topper_total' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="updateMaloong" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Update | Maloong Toppers</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="function/ledger/updateMaloong.php" id='myform' method="POST">
                <div class="modal-body p-4">
                    <input class='form-control' type="text" id="u_id" name="id" hidden>
                    <div class="row">
                        <div class="col ">
                            <div class="form-group">
                                <label for="date">DATE</label>
                                <input class='form-control ' type="date" id="u_date" name="date" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for='voucher'>VOUCHER #</label>
                                <input type="text" name='voucher' class="form-control" autocomplete='off' required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for='name'>Particulars</label>
                        <input type="text" name='name' id='u_name' class="form-control" autocomplete='off' required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for='net_kilos'>Net Kilos</label>
                            <div class="input-group">
                                <input type="text" name='net_kilos' id='u_net_kilos' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='ejn_price'>EJN Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='ejn_price' id='u_ejn_price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for='ejn_total'>EJN Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='ejn_total' id='u_ejn_total' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='topper_price'>Toppers Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='topper_price' id='u_topper_price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for='topper_gross'>Gross Amount</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" name='topper_gross' id='u_topper_gross' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="less_category">Less Category</label>
                            <input class="form-control" list="typeLess" name='less_category' id="u_less_category" placeholder="Select Subject" autocomplete='off'>
                            <datalist id='typeLess'>
                                <option value="No Deductions" selected>No Deductions</option>
                                <option value="Cash Advance">Cash Advance</option>
                                <option value="SSS">SSS</option>
                                <option value="Rice">Rice</option>
                            </datalist>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for='less'>Less (Toppers)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='less' id='u_less' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for='topper_total'>Toppers Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" name='topper_total' id='u_topper_total' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function() {
        $("#net_kilos, #ejn_price, #topper_price, #less").keyup(function() {
            let net_kilos = $("#net_kilos").val().replace(/,/g, ''),
                ejn_price = $("#ejn_price").val().replace(/,/g, ''),
                topper_price = $("#topper_price").val().replace(/,/g, ''),
                less = $("#less").val().replace(/,/g, '');

            maloongToppers(net_kilos, ejn_price, topper_price, less);
        });
    });

    function maloongToppers(net_kilos, ejn_price, topper_price, less) {
        let nf = new Intl.NumberFormat('en-US');

        let ejn_total = net_kilos * ejn_price;
        $("#ejn_total").val(nf.format(ejn_total));

        let topper_gross = net_kilos * topper_price;
        $("#topper_gross").val(nf.format(topper_gross));

        let topper_total = topper_gross - less;
        $("#topper_total").val(nf.format(topper_total));
    }


    $(function() {
        $("#u_net_kilos, #u_ejn_price, #u_topper_price, #u_less").keyup(function() {
            let net_kilos = $("#u_net_kilos").val().replace(/,/g, ''),
                ejn_price = $("#u_ejn_price").val().replace(/,/g, ''),
                topper_price = $("#u_topper_price").val().replace(/,/g, ''),
                less = $("#u_less").val().replace(/,/g, '');

            u_maloongToppers(net_kilos, ejn_price, topper_price, less);
        });
    });

    function u_maloongToppers(net_kilos, ejn_price, topper_price, less) {
        let nf = new Intl.NumberFormat('en-US');

        let ejn_total = net_kilos * ejn_price;
        $("#u_ejn_total").val(nf.format(ejn_total));

        let topper_gross = net_kilos * topper_price;
        $("#u_topper_gross").val(nf.format(topper_gross));

        let topper_total = topper_gross - less;
        $("#u_topper_total").val(nf.format(topper_total));
    }
</script>





<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="function/ledger/addMaloong.php" id='myform' method="POST">
                <div class="modal-header">

                    <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
                    <button type="button" class="btn text-light close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="text" id='d_id' name="id" hidden>
                <div class="modal-body">
                    Are you sure you want to delete this record? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name='delete'>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>