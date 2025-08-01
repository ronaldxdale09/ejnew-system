<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $year . "-" . $month . "-" . $day;

?>
<!-- Modal -->

<div class="modal fade" id="purchase-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Purchase</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addPurchase.php" id='submitPurchase' method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input class='form-control' value="<?php echo $dateNow; ?>" type="date" id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="p_voucher">Voucher</label>
                                <input type="text" id='p_voucher' name='p_voucher' class="form-control" required autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pur_category">Category</label>
                                <select class='form-select' name='pur_category' id='pur_category' required>
                                    <option disabled="disabled" value='' selected="selected">Select Category</option>
                                    <?php echo $purCatList; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="p_name">Supplier Name</label>
                                <input type="text" name='name' class="form-control" autocomplete='off' required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="p_net-kilos">Net Kilos</label>
                                <div class="input-group">
                                    <input type="text" id='p_net-kilos' name='net_kilo' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">Price: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='price' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control" autocomplete='off'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end price -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Cash Advance :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='cash_advance' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Tax :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='tax' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Partial Payment -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Others :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='others' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12"></label>
                                <!-- new column -->
                                <div class="input-group mb-3">

                                    <input type="text" style='text-align:center' name='description' class="form-control" placeholder="Description" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>

                        </div>
                    </div>
                    <!-- end partial payment -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='total_amount' readonly class="form-control">
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Net Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='net_total_amount' class="form-control">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Price -->
                    <!-- end net total and amount -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name='add' class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll("[name='net_kilo'], [name='price'], [name='cash_advance'], [name='tax'], [name='others']");

        for (let input of inputs) {
            input.addEventListener("input", computeTotal);
        }
        
        // Add separate event listener for net_total_amount
        document.querySelector("[name='net_total_amount']").addEventListener("input", function() {
            let netTotalValue = parseFloat(this.value.replace(/,/g, '')) || 0;
            let formattedValue = parseFloat(netTotalValue.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='total_amount']").value = formattedValue;
        });

        function computeTotal() {
            let netKilos = parseFloat(document.querySelector("[name='net_kilo']").value.replace(/,/g, '')) || 0;
            let price = parseFloat(document.querySelector("[name='price']").value.replace(/,/g, '')) || 0;
            let cashAdvance = parseFloat(document.querySelector("[name='cash_advance']").value.replace(/,/g, '')) || 0;
            let tax = parseFloat(document.querySelector("[name='tax']").value.replace(/,/g, '')) || 0;
            let others = parseFloat(document.querySelector("[name='others']").value.replace(/,/g, '')) || 0;

            let net_total = (netKilos * price) - cashAdvance - tax - others;
            let totalAmount = (netKilos * price);

            let formattedNet = parseFloat(net_total.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='net_total_amount']").value = formattedNet;

            let formattedTotalAmount = parseFloat(totalAmount.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='total_amount']").value = formattedTotalAmount;
        }
    });
</script>


<!-- MODAL OF REMOVE EXPENSES -->
<div class="modal fade" id="removePurchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px; font-weight: 600;">Remove Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 16px; padding: 20px;">
                <form action="function/ledger/removePurchase.php" method="POST">
                    <input type="text" id="my_id" name="my_id" hidden> <!-- Use 'hidden' instead of inline styles -->
                    <p style="margin-bottom: 20px;">Are you sure you want to remove this purchase entry?</p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-danger">
                    <!-- You can add an icon here -->
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade" id="updatePurchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Purchase</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addPurchase.php" id='submitPurchase' method="POST">
                <input class='form-control' id="p_id" name="p_id" hidden>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input class='form-control' type="date" id="u_date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="p_voucher">Voucher</label>
                                <input type="text" id='u_voucher' name='u_voucher' class="form-control" required autocomplete='off'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pur_category">Category</label>
                                <select class='form-select' name='pur_category' id='u_category' required>
                                    <option disabled="disabled" value="" selected="selected">Select Category</option>
                                    <?php echo $purCatList; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="p_name">Supplier Name</label>
                                <input type="text" name='name' id='name' class="form-control" autocomplete='off' required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="p_net-kilos">Net Kilos</label>
                                <div class="input-group">
                                    <input type="text" id='u_net_kilo' name='u_net_kilo' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label style='font-size:15px;font-weight: bold;' class="col-md-12">Price: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_price' id='u_price' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control" autocomplete='off'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end price -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Cash Advance :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_cash_advance' id='u_cash_advance' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Tax :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_tax' id='u_tax' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Partial Payment -->
                    <div class="form-group">
                        <div class="row no-gutters">

                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Others :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_others' id='u_others' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12"></label>
                                <!-- new column -->
                                <div class="input-group mb-3">

                                    <input type="text" style='text-align:center' name='u_description' id='u_description' class="form-control" placeholder="Description" autocomplete='off'>
                                </div>
                                <!--  -->
                            </div>

                        </div>
                    </div>
                    <!-- end partial payment -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_total_amount' id='u_total_amount' readonly class="form-control">
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Net Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='u_net_total_amount' id='u_net_total_amount' class="form-control">
                                </div>
                                <!--  -->
                            </div>

                        </div>
                    </div>
                    <!-- END Price -->
                    <!-- end net total and amount -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name='update' class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll("[name='u_net_kilo'], [name='u_price'], [name='u_cash_advance'], [name='u_tax'], [name='u_others']");

        for (let input of inputs) {
            input.addEventListener("input", u_computeTotal);
        }
        
        // Add separate event listener for u_net_total_amount
        document.querySelector("[name='u_net_total_amount']").addEventListener("input", function() {
            let netTotalValue = parseFloat(this.value.replace(/,/g, '')) || 0;
            let formattedValue = parseFloat(netTotalValue.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_total_amount']").value = formattedValue;
        });

        function u_computeTotal() {
            console.log("Computing totals..."); // Debug log
            let netKilos = parseFloat(document.querySelector("[name='u_net_kilo']").value.replace(/,/g, '')) || 0;
            let price = parseFloat(document.querySelector("[name='u_price']").value.replace(/,/g, '')) || 0;
            let cashAdvance = parseFloat(document.querySelector("[name='u_cash_advance']").value.replace(/,/g, '')) || 0;
            let tax = parseFloat(document.querySelector("[name='u_tax']").value.replace(/,/g, '')) || 0;
            let others = parseFloat(document.querySelector("[name='u_others']").value.replace(/,/g, '')) || 0;

            let net_total = (netKilos * price) - cashAdvance - tax - others;
            let totalAmount = (netKilos * price);

            console.log("Net Kilos:", netKilos);
            console.log("Price:", price);
            console.log("Cash Advance:", cashAdvance);
            console.log("Tax:", tax);
            console.log("Others:", others);
            console.log("Net Total:", net_total);
            console.log("Total Amount:", totalAmount);

            let formattedNet = parseFloat(net_total.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_net_total_amount']").value = formattedNet;

            let formattedTotalAmount = parseFloat(totalAmount.toFixed(2)).toLocaleString('en-US');
            document.querySelector("[name='u_total_amount']").value = formattedTotalAmount;
        }
    });
</script>