<!-- Confirm Transaction -->
<form action="function/wet_rubber_purchase.php" id='newPurchase' method="POST">
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM TRANSACTION | WET RECEIVING </h5>
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
                                        <span class="input-group-text" id="inputGroup-sizing-default">Invoice</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_invoice' id='m_invoice'
                                        class="form-control readonly-input" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Contract</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_contract' id='m_contract'
                                        class="form-control readonly-input" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='m_date' id='m_date'
                                        class="form-control readonly-input" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8">Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="m_name" id="m_name" class="form-control readonly-input" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-3">
                                <label class="col-md-12">Total Amount :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control readonly-input" id='m_total-amount'
                                        name='m_total-amount' readonly />
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="col-md-12">Less :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control readonly-input" id='m_less' name='m_less'
                                        readonly />
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="col-md-12">Total Amount Paid :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control readonly-input" id='m_total-paid'
                                        name='m_total-paid' readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control readonly-input" id='m_total-words' name='m_total-words'
                        readonly />

                  <input name="m_id" id="m_id"  hidden>
                    <input name="m_supplier_type" id="m_supplier_type"  hidden>
                    <!-- hidden -->
                    <input name="m_gross" id="m_gross" hidden>
                    <input name="m_tare" id="m_tare" hidden>
                    <input name="m_net" id="m_net" hidden>


                    <input name="drc" id="m_drc" hidden >
                    <input name="bale_weight" id="m_bale_weight" hidden>

                    <input name="m_1price" id="m_1price" hidden>
                    <input name="m_2price" id="m_2price" hidden>

                    <input name="m_total_first" id="m_total_first" hidden>
                    <input name="m_total_sec" id="m_total_sec" hidden>

                    <input name="m_weight_1" id="m_weight_1" hidden>
                    <input name="m_weight_2" id="m_weight_2" hidden>

                    <input name="m_address" id="m_address" hidden>
                    <input name="m_quantity" id="m_quantity" hidden>
                    <input name="m_balance" id="m_balance" hidden >
                </div>
                <div class="modal-footer">
                    <button type='submit' id='confirmPurchase' name='confirmPurchase'
                        class="btn btn-success text-white">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>



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
                <div class="col-6 col-md-4">
                    <div class="input-group mb-1">

                        <label style='font-size:15px' class="col-md-12">Seller :</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id='v_name' name='v_name'
                                onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly />
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-8">Voucher:</label>
                    <div class="col-md-4">
                        <textarea name="v_voucher" id="v_voucher" class="form-control"
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
                                        value='RICHARD J. NEW' onkeypress="return CheckNumeric()"
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
                                    <input type="text" class="form-control" id='recorded_by' name='recorded_by' />
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

        var voucher = document.getElementById("v_voucher").value;
        var approved = document.getElementById("approved_by").value;
        var recorded = document.getElementById("recorded_by").value;

        $.ajax({
            url: "voucher/fetchVouch.php",
            type: "POST",
            cache: false,
            data: {
                voucher: voucher,
                approved: approved,
                recorded: recorded,
            },
            cache: false,
            success: function(voucher) {


            }
        });


        var nw = window.open("voucher/print_voucher.php", "_blank", "height=623,width=850 ")




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
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRINT RECEIPT</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--  total dust-->
                <div class="col-6 col-md-4">
                    <div class="input-group mb-1">

                        <label style='font-size:15px' class="col-md-12">Confirm to print the transaction
                            receipt</label>

                    </div>
                </div>
                <!-- end -->

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


<!-- PRINT Transaction -->
<div class="modal fade" id="modal_new_transact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NEW TRANSACTION</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--  total dust-->
                <center>
                    <div class="col-6 col-md-12">
                        <div class="input-group mb-12">
                            <label style='font-size:25px' class="col-md-12">Confirm to create new
                                transaction</label>

                        </div>
                    </div>
                    <center>
                        <!-- end -->

            </div>
            <div class="modal-footer">
                <button onclick="location.href = 'wet_rubber.php';" class="btn btn-success text-white">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<script>
// Function to fetch the transaction status
function fetchTransactionStatus(ca, callback) {
    $.ajax({
        'async': false,
        url: "modal/fetch/fetch_status.php",
        type: "POST",
        data: {
            ca: ca
        },
        cache: false,
        success: function(state) {
            console.log(state);
            callback(state);
        }
    });
}

// Function to display a Swal message
function showSwalMessage(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    });
}

// Function to handle confirm button click
function handleConfirmButtonClick() {
    var ca = $("#cash_advance").val().replace(/,/g, '');
    var status = null;

    // Fetch transaction status
    fetchTransactionStatus(ca, function(response) {
        status = response;
    });

    if (!document.getElementById('total-amount').value || !document.getElementById('date').value || !$("#name").val()) {
        showSwalMessage('error', 'Oops...', 'Fill all the necessary fields');
    } else if (status == 'COMPLETED') {
        showSwalMessage('info', 'PLEASE CREATE NEW TRANSACTION', 'This transaction is already completed');
    } else {
        // Call function to show the modal and set the necessary fields
        showModalAndSetFields();
    }
}

// Function to show the modal and set the necessary fields
function showModalAndSetFields() {
    $('#confirmModal').modal('show');
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    // Setting up the modal fields
    $('#m_id').val($("#invoice").val());
    
    $('#m_name').val($("#name").val());
    $('#m_date').val($("#date").val());
    $('#m_address').val($("#address").val());
    $('#m_contract').val($("#contract").val());

    $('#m_drc').val($("#assumed_drc").val());
    $('#m_bale_weight').val($("#assumed_weight").val());

    var supplierType = $("#supplier_type").val();

    $('#m_supplier_type').val(supplierType);
    $('#m_quantity').val($("#quantity").val());
    $('#m_balance').val($("#balance").val());

    // Purchase info
    $('#m_gross').val($("#gross").val());
    $('#m_tare').val($("#tare").val());
    $('#m_net').val($("#net").val());

    $('#m_1price').val($("#first_price").val());
    $('#m_2price').val($("#second_price").val());

    // Total res
    $('#m_weight_1').val($("#first-weight").val());
    $('#m_weight_2').val($("#second-weight").val());

    $('#m_total_first').val($("#first_total").val());
    $('#m_total_sec').val($("#second_total").val());

    // 
    $('#m_total-amount').val($("#total-amount").val());
    $('#m_less').val($("#cash_advance").val());
    $('#m_total-paid').val($("#amount-paid").val());
    $('#m_total-words').val($("#amount-paid-words").val());
}

// Function to handle new purchase form submission
function handleNewPurchaseFormSubmission() {
    $("#confirmModal").modal("hide");

    $.post($('#newPurchase').attr('action'), $('#newPurchase :input').serializeArray(), function(result) {
        $('#result').html(result);
        showSwalMessage('success', 'Good job!', 'Transaction Was Successful!');

        // After successful submission
        $(document).ready(function() {
            const span = document.getElementById('trans_status');
            span.innerHTML = `<span class="badge alert-success">COMPLETED</span>`;
        });

        document.getElementById("receiptBtn").click();
        $_SESSION['transaction'] = 'COMPLETED';
    });
}
// Attach event handlers
$('#confirm').click(handleConfirmButtonClick);
$('#newPurchase').submit(function() {
    return false;
});
$('#confirmPurchase').click(handleNewPurchaseFormSubmission);
</script>

<!-- end -->

<script>
// validation

$('#vouchBtn').click(function() {

    if (!document.getElementById('total-amount').value ||
        !document.getElementById('date').value ||
        !$("#name").val()
    ) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill all the necessary fields ',
        })

    } else {
        $('#print_vouch').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#v_invoice').val($("#invoice").val());
        $('#v_name').val($("#name").val());
        $('#v_date').val($("#date").val());
        $('#v_address').val($("#address").val());
        $('#v_contract').val($("#contract").val());

        $('#v_quantity').val($("#quantity").val());
        $('#v_balance').val($("#balance").val());

        // purchase info

        $('#v_gross').val($("#gross").val());
        $('#v_tare').val($("#tare").val());
        $('#v_net').val($("#net").val());


        $('#v_1price').val($("#first_price").val());
        $('#v_2price').val($("#sec_price").val());

        // total res

        $('#v_weight_1').val($("#first-weight").val());
        $('#v_weight_2').val($("#second-weight").val());

        $('#v_total_first').val($("#first_total").val());
        $('#v_total_sec').val($("#sec_total").val());

        // 
        $('#v_total-amount').val($("#total-amount").val());
        $('#v_less').val($("#cash_advance").val());
        $('#v_total-paid').val($("#amount-paid").val());
        $('#v_total-words').val($("#amount-paid-words").val());

    }

});
</script>



<script>
// validation

$('#receiptBtn').click(function() {

    if (!document.getElementById('total-amount').value ||
        !document.getElementById('date').value ||
        !$("#name").val()
    ) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill all the necessary fields ',
        })

    } else {
        $('#modal_receipt').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#r_invoice').val($("#invoice").val());
        $('#r_name').val($("#name").val());
        $('#r_date').val($("#date").val());
        $('#r_address').val($("#address").val());
        $('#r_contract').val($("#contract").val());

        $('#r_quantity').val($("#quantity").val());
        $('#r_balance').val($("#balance").val());

        // purchase info

        $('#r_gross').val($("#gross").val());
        $('#r_tare').val($("#tare").val());
        $('#r_net').val($("#net").val());


        $('#r_1price').val($("#first_price").val());
        $('#r_2price').val($("#sec_price").val());

        // total res

        $('#r_weight_1').val($("#first-weight").val());
        $('#r_weight_2').val($("#second-weight").val());

        $('#r_total_first').val($("#first_total").val());
        $('#r_total_sec').val($("#sec_total").val());

        // 
        $('#r_total-amount').val($("#total-amount").val());
        $('#r_less').val($("#cash_advance").val());
        $('#r_total-paid').val($("#amount-paid").val());
        $('#r_total-words').val($("#amount-paid-words").val());

    }

});
</script>