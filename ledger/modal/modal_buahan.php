<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

?>
<!-- Modal -->
<!-- Buahan Toppers Modal -->
<div class="modal fade" id="maloongToppers" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Buahan Toppers</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="function/ledger/addBuahan.php" id='myform' method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Date and Voucher Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">DATE</label>
                                    <input class='form-control' value="<?php echo $dateNow; ?>" type="date" id="date" name="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="voucher">VOUCHER #</label>
                                    <input type="text" name='voucher' class="form-control" autocomplete='off' required>
                                </div>
                            </div>
                        </div>

                        <!-- Particulars Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for='name'>Particulars</label>
                                    <input type="text" name='name' id='name' class="form-control" autocomplete='off' required>
                                </div>
                            </div>
                        </div>

                        <!-- Net Kilos and Price Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="net_kilos">Net Kilos</label>
                                    <div class="input-group">
                                        <input type="text" name='net_kilos' id='net_kilos' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" name='price' id='price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EJN and Topper Percent Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejn_percent">EJN Percent (%)</label>
                                    <input type="text" style='text-align:right' name='ejn_percent' id='ejn_percent' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_percent">Toppers Percent (%)</label>
                                    <input type="text" style='text-align:right' name='topper_percent' id='topper_percent' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- EJN Total and Topper Gross Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejn_total">EJN Total</label>
                                    <input type="text" style='text-align:right' name='ejn_total' id='ejn_total' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_gross">Gross Amount</label>
                                    <input type="text" style='text-align:right' name='topper_gross' id='topper_gross' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- Less Category and Less Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="less_category">Less Category</label>
                                    <input class="form-control" list="typeLess" name='less_category' id="less_category" placeholder="Select Subject" autocomplete='off'>
                                    <datalist id='typeLess'>
                                        <option value="Cash Advance">Cash Advance</option>
                                        <option value="SSS">SSS</option>
                                        <option value="Rice">Rice</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="less">Less (Toppers)</label>
                                    <input type="text" style='text-align:right' name='less' id='less' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- Topper Total Section -->
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_total">Toppers Total</label>
                                    <input type="text" style='text-align:right' name='topper_total' id='topper_total' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' readonly>
                                </div>
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



<!-- Buahan Toppers Modal -->
<div class="modal fade" id="updateBuahan" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Buahan Toppers</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="function/ledger/addBuahan.php" id='myform' method="POST">
                <input class='form-control' type="text" id="u_id" name="id" hidden>

                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Date and Voucher Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">DATE</label>
                                    <input class='form-control' type="date" id="u_date" name="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="voucher">VOUCHER #</label>
                                    <input type="text" name='voucher' ID='u_voucher' class="form-control" autocomplete='off' required>
                                </div>
                            </div>
                        </div>

                        <!-- Particulars Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for='name'>Particulars</label>
                                    <input type="text" name='name' id='u_name' class="form-control" autocomplete='off' required>
                                </div>
                            </div>
                        </div>

                        <!-- Net Kilos and Price Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="net_kilos">Net Kilos</label>
                                    <div class="input-group">
                                        <input type="text" name='net_kilos' id='u_net_kilos' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" name='price' id='u_price' class="form-control text-right" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EJN and Topper Percent Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejn_percent">EJN Percent (%)</label>
                                    <input type="text" style='text-align:right' name='ejn_percent' id='u_ejn_percent' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_percent">Toppers Percent (%)</label>
                                    <input type="text" style='text-align:right' name='topper_percent' id='u_topper_percent' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- EJN Total and Topper Gross Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ejn_total">EJN Total</label>
                                    <input type="text" style='text-align:right' name='ejn_total' id='u_ejn_total' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_gross">Gross Amount</label>
                                    <input type="text" style='text-align:right' name='topper_gross' id='u_topper_gross' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- Less Category and Less Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="less_category">Less Category</label>
                                    <input class="form-control" list="typeLess" name='less_category' id="u_less_category" placeholder="Select Subject" autocomplete='off'>
                                    <datalist id='typeLess'>
                                        <option value="Cash Advance">Cash Advance</option>
                                        <option value="SSS">SSS</option>
                                        <option value="Rice">Rice</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="less">Less (Toppers)</label>
                                    <input type="text" style='text-align:right' name='less' id='u_less' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                            </div>
                        </div>

                        <!-- Topper Total Section -->
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="topper_total">Toppers Total</label>
                                    <input type="text" style='text-align:right' name='topper_total' id='u_topper_total' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off' readonly>
                                </div>
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

        $("#net_kilos, #price, #ejn_percent, #topper_percent, #less").keyup(function() {

            let net_kilos = $("#net_kilos").val().replace(/,/g, ''),
                price = $("#price").val().replace(/,/g, ''),
                ejn_percent = $("#ejn_percent").val().replace(/,/g, ''),
                topper_percent = $("#topper_percent").val().replace(/,/g, ''),
                less = $("#less").val().replace(/,/g, '');

            buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);
        });

    });

    function buahanTopper(net_kilos, price, ejn_percent, topper_percent, less) {

        let nf = new Intl.NumberFormat('en-US');

        let total = net_kilos * price;
        $("#total").val(nf.format(total));

        let ejn_total = total * (ejn_percent / 100);
        $("#ejn_total").val(nf.format(ejn_total));

        let topper_gross = total * (topper_percent / 100);
        $("#topper_gross").val(nf.format(topper_gross));

        let topper_total = topper_gross - less;
        $("#topper_total").val(nf.format(topper_total));
    }

    $(function() {

        $("#u_net_kilos, #u_price, #u_ejn_percent, #u_topper_percent, #u_less").keyup(function() {

            let net_kilos = $("#u_net_kilos").val().replace(/,/g, ''),
                price = $("#u_price").val().replace(/,/g, ''),
                ejn_percent = $("#u_ejn_percent").val().replace(/,/g, ''),
                topper_percent = $("#u_topper_percent").val().replace(/,/g, ''),
                less = $("#u_less").val().replace(/,/g, '');

            u_buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);
        });

    });

    function u_buahanTopper(net_kilos, price, ejn_percent, topper_percent, less) {

        let nf = new Intl.NumberFormat('en-US');

        let total = net_kilos * price;
        $("#u_total").val(nf.format(total));

        let ejn_total = total * (ejn_percent / 100);
        $("#u_ejn_total").val(nf.format(ejn_total));

        let topper_gross = total * (topper_percent / 100);
        $("#u_topper_gross").val(nf.format(topper_gross));

        let topper_total = topper_gross - less;
        $("#u_topper_total").val(nf.format(topper_total));
    }
</script>



<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="function/ledger/addBuahan.php" id='myform' method="POST">
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