<!-- Confirm Transaction -->
<form action="function/save_purchase.php" id='newPurchase' method="POST">
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confrim Transaction</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-4">

                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Invoice</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_invoice' id='m_invoice'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Contract</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_contract' id='m_contract'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                        readonly>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-4">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Date</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_date' id='m_date'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                        readonly>
                                </div>
                            </div>
                            <!--  end-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8">Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="m_name" id="m_name" class="form-control"
                                style='font-size:15px;background-color:white;border:0px solid #ffffff;' readonly>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-3">

                                <div class="input-group mb-1">

                                    <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='m_total-amount'
                                            name='m_total-amount' onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" readonly />
                                    </div>

                                </div>

                            </div>
                            <div class="col-6 col-md-4">

                                <div class="input-group mb-1">

                                    <label style='font-size:15px' class="col-md-12">Less :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='m_less' name='m_less' readonly
                                            onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                    </div>

                                </div>
                            </div>
                            <!--  total dust-->
                            <div class="col-6 col-md-4">
                                <div class="input-group mb-1">

                                    <label style='font-size:15px' class="col-md-12">Total Amount Paid :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="text" class="form-control" id='m_total-paid' name='m_total-paid'
                                            readonly onkeypress="return CheckNumeric()"
                                            onkeyup="FormatCurrency(this)" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end table -->
                    <input type="text" class="form-control" id='m_total-words' name='m_total-words' readonly />
                    <!-- hidden -->
                    <input name="m_noSack" id="m_noSack" hidden>
                    <input name="m_gross" id="m_gross" hidden>
                    <input name="m_tare" id="m_tare" hidden>
                    <input name="m_net" id="m_net" hidden>
                    <input name="m_dust" id="m_dust" hidden>
                    <input name="m_new-dust" id="m_new-dust" hidden>
                    <input name="m_total-dust" id="m_total-dust" hidden>
                    <input name="m_moisture" id="m_moisture" hidden>
                    <input name="m_total-moisture" id="m_total-moisture" hidden>
                    <input name="m_discount" id="m_discount" hidden>
                    <input name="m_net-resecada" id="m_net-resecada" hidden>
                    <input name="m_1resecada" id="m_1resecada" hidden>
                    <input name="m_2resecada" id="m_2resecada" hidden>
                    <input name="m_3resecada" id="m_3resecada" hidden>
                    <input name="m_total_1res" id="m_total_1res" hidden>
                    <input name="m_total_2res" id="m_total_2res" hidden>
                    <input name="m_total_3res" id="m_total_3res" hidden>
                    <input name="m_address" id="m_address" hidden>
                    <input name="m_quantity" id="m_quantity" hidden>
                    <input name="m_balance" id="m_balance" hidden>

                    <input name="m_1rese-weight" id="m_1rese-weight" hidden>
                    <input name="m_2rese-weight" id="m_2rese-weight" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type='submit' id='confirmPurchase' name='confirmPurchase'
                        class="btn btn-success text-white">Submit</button>
                </div>
</form>
</div>
</div>
</div>
</div>
<!--END Confirm Transaction -->
<script>
$('#newPurchase').submit(function() {
    return false;
});
$('#confirmPurchase').click(function() {
    $("#confirmModal").modal("hide");
    $.post($('#newPurchase').attr('action'), $('#newPurchase :input').serializeArray(), function(result) {
        $('#result').html(result);
        Swal.fire({
            title: "Good job!",
            text: "Transaction Was Successful!",
            type: "success"
        }).then(function() {
            document.getElementById("receiptBtn").click();
        });
    });
});
// INPUT BOX VALIDATION
</script>



<!-- PRINT Transaction -->
<div class="modal fade" id="print_vouch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRINT VOUCHER</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                        style='color:black;font-weight: bold;'>Contract</span>
                                </div>
                                <input type="text" style='text-align:right' name='v_contract' id='v_contract'
                                    class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                    readonly>
                            </div>
                        </div>
                        <!--end  -->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                        style='color:black;font-weight: bold;'>Date</span>
                                </div>
                                <input type="text" style='text-align:right' name='v_date' id='v_date'
                                    class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                    readonly>
                            </div>
                        </div>
                        <!--  end-->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-8">Vouch:</label>
                    <div class="col-md-4">
                        <textarea name="v_name" id="v_name" class="form-control"
                            style='font-size:15px;background-color:white;width:700px;height:100px;'></textarea>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-5 col-md-3">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='v_total-amount' name='v_total-amount'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>

                        </div>
                        <div class="col-6 col-md-4">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Less :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='v_less' name='v_less' readonly
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>
                        </div>
                        <!--  total dust-->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Total Amount Paid :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='v_total-paid' name='v_total-paid'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-5 col-md-3">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Approved By:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id='approved_by' name='approved_by'
                                        value='EFREN J. NEW' onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>

                        </div>
                        <div class="col-6 col-md-4">

                            <!-- empty -->
                        </div>
                        <!--  total dust-->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Recorded By :</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id='recorded_by' name='recorded_by'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end -->
                </div>
                <!-- end table -->
                <input type="text" class="form-control" id='v_total-words' name='v_total-words' readonly
                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id='print_voucher' name='print_voucher' class="btn btn-success text-white">Print</button>
            </div>
        </div>
    </div>
</div>
<!--END PRINT Transaction -->


<script type="text/javascript">
$(document).ready(function() {
    $('#print_voucher').click(function() {
        var name = document.getElementById("name").value;
        var date = document.getElementById("date").value;
        var address = document.getElementById("address").value;
        sessionStorage.setItem("name", name, "date", date, "address", address);


        var nw = window.open("voucher/print_voucher.php", "_blank", "height=623,width=812")




        setTimeout(function() {
            nw.print()
            setTimeout(function() {
                nw.close()
            }, 500)
        }, 1000)
    })
});
</script>


<!-- PRINT Transaction -->
<div class="modal fade" id="modal_receipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRINT RECEIPT</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                        style='color:black;font-weight: bold;'>Contract</span>
                                </div>
                                <input type="text" style='text-align:right' name='r_contract' id='r_contract'
                                    class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                    readonly>
                            </div>
                        </div>
                        <!--end  -->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                        style='color:black;font-weight: bold;'>Date</span>
                                </div>
                                <input type="text" style='text-align:right' name='r_date' id='r_date'
                                    class="form-control" style='background-color:white;border:0px solid #ffffff;'
                                    readonly>
                            </div>
                        </div>
                        <!--  end-->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-8">Vouch:</label>
                    <div class="col-md-4">
                        <textarea name="r_name" id="r_name" class="form-control"
                            style='font-size:15px;background-color:white;width:700px;height:100px;'></textarea>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-5 col-md-3">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='r_total-amount' name='r_total-amount'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>

                        </div>
                        <div class="col-6 col-md-4">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Less :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='r_less' name='r_less' readonly
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>
                        </div>
                        <!--  total dust-->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Total Amount Paid :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='r_total-paid' name='r_total-paid'
                                        readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-5 col-md-3">

                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Approved By:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id='approved_by' name='approved_by'
                                        value='EFREN J. NEW' onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>

                        </div>
                        <div class="col-6 col-md-4">

                            <!-- empty -->
                        </div>
                        <!--  total dust-->
                        <div class="col-6 col-md-4">
                            <div class="input-group mb-1">

                                <label style='font-size:15px' class="col-md-12">Recorded By :</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id='recorded_by' name='recorded_by'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end -->
                </div>
                <!-- end table -->
                <input type="text" class="form-control" id='r_total-words' name='r_total-words' readonly
                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id='print_receipt' name='print_receipt' class="btn btn-success text-white">Print</button>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
$(document).ready(function() {
    $('#print_receipt').click(function() {

        var nw = window.open("voucher/print_receipt.php", "_blank",
        "height=623,width=812")




        setTimeout(function() {
            nw.print()
            setTimeout(function() {
                nw.close()
            }, 500)
        }, 1000)
    })
});
</script>