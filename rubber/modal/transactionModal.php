<!-- Confirm Transaction -->
<form action="function/wet_rubber_purchase.php" id="newPurchase" method="POST">
    <div class="modal fade rubber-modal" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <label class="form-label">Invoice</label>
                            <input type="text" class="form-control form-control-sm" name="m_invoice" id="m_invoice" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Contract</label>
                            <input type="text" class="form-control form-control-sm" name="m_contract" id="m_contract" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control form-control-sm" name="m_date" id="m_date" readonly>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Seller</label>
                        <input type="text" class="form-control form-control-sm" name="m_name" id="m_name" readonly>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label">Total Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" id="m_total-amount" name="m_total-amount" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Less (CA)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" id="m_less" name="m_less" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Amount Paid</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control fw-semibold" id="m_total-paid" name="m_total-paid" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control form-control-sm mt-2 text-center" id="m_total-words" name="m_total-words" readonly>

                    <input name="m_supplier_type" id="m_supplier_type" type="hidden">
                    <input name="m_gross" id="m_gross" type="hidden">
                    <input name="m_tare" id="m_tare" type="hidden">
                    <input name="m_net" id="m_net" type="hidden">
                    <input name="m_1price" id="m_1price" type="hidden">
                    <input name="m_2price" id="m_2price" type="hidden">
                    <input name="m_total_first" id="m_total_first" type="hidden">
                    <input name="m_total_sec" id="m_total_sec" type="hidden">
                    <input name="m_weight_1" id="m_weight_1" type="hidden">
                    <input name="m_weight_2" id="m_weight_2" type="hidden">
                    <input name="m_address" id="m_address" type="hidden">
                    <input name="m_quantity" id="m_quantity" type="hidden">
                    <input name="m_balance" id="m_balance" type="hidden">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmPurchase" name="confirmPurchase" class="btn btn-sm btn-success">Submit Transaction</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--END Confirm Transaction -->
<script>
(function ($) {
    'use strict';

    $('#newPurchase').on('submit', function (e) { e.preventDefault(); });

    function collectPurchasePayload() {
        var fields = [
            ['invoice', 'm_invoice'], ['name', 'm_name'], ['date', 'm_date'], ['address', 'm_address'],
            ['contract', 'm_contract'], ['supplier_type', 'm_supplier_type'], ['quantity', 'm_quantity'],
            ['balance', 'm_balance'], ['gross', 'm_gross'], ['tare', 'm_tare'], ['net', 'm_net'],
            ['first_price', 'm_1price'], ['second_price', 'm_2price'],
            ['first-weight', 'm_weight_1'], ['second-weight', 'm_weight_2'],
            ['first_total', 'm_total_first'], ['second_total', 'm_total_sec'],
            ['total-amount', 'm_total-amount'], ['cash_advance', 'm_less'],
            ['amount-paid', 'm_total-paid'], ['amount-paid-words', 'm_total-words']
        ];
        var data = {};
        fields.forEach(function (pair) {
            var val = $('#' + pair[0]).val();
            if (val !== undefined && val !== null) {
                data[pair[1]] = val;
            }
        });
        return data;
    }

    $('#confirmPurchase').off('click.wetSubmit').on('click.wetSubmit', function () {
        var $btn = $(this).prop('disabled', true);
        var url = (window.RUBBER_BASE || '') + 'function/wet_rubber_purchase.php';
        var payload = collectPurchasePayload();

        $.ajax({
            url: url,
            type: 'POST',
            data: payload,
            dataType: 'json',
            timeout: 30000
        }).done(function (data) {
            if (!data || data.result !== 'success') {
                Swal.fire({ icon: 'error', title: 'Failed', text: (data && data.message) || 'Transaction could not be saved.' });
                return;
            }
            RubberModal.hide('#confirmModal');
            Swal.fire({ icon: 'success', title: 'Success', text: data.message || 'Transaction was successful!' }).then(function () {
                var span = document.getElementById('trans_status');
                if (span) {
                    span.classList.remove('bg-danger');
                    span.classList.add('bg-success');
                    span.textContent = 'COMPLETED';
                }
                document.getElementById('receiptBtn').click();
            });
        }).fail(function (xhr) {
            var msg = 'Could not reach the server.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                try {
                    var parsed = JSON.parse(xhr.responseText);
                    if (parsed.message) msg = parsed.message;
                } catch (e) {
                    if (xhr.status === 500) msg = 'Server error while saving. Check required fields and try again.';
                }
            }
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
        }).always(function () {
            $btn.prop('disabled', false);
        });
    });
}(jQuery));
</script>



<!-- PRINT Voucher -->
<div class="modal fade rubber-modal" id="print_vouch" tabindex="-1" aria-labelledby="printVouchLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printVouchLabel">Print Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button id="print_voucher" name="print_voucher" class="btn btn-sm btn-success text-white">Print</button>
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


<!-- PRINT Receipt -->
<div class="modal fade rubber-modal" id="modal_receipt" tabindex="-1" aria-labelledby="modalReceiptLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReceiptLabel">Print Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body rubber-modal-confirm">
                <p class="mb-0">Confirm to print the transaction receipt.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button id="print_receipt" name="print_receipt" class="btn btn-sm btn-success text-white">Print</button>
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


<!-- New Transaction -->
<div class="modal fade rubber-modal" id="modal_new_transact" tabindex="-1" aria-labelledby="newTransactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTransactLabel">New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body rubber-modal-confirm text-center">
                <i class="fas fa-file-circle-plus text-success fa-2x mb-2"></i>
                <p class="mb-0">Start a new cuplump purchase transaction? Unsaved changes on this page will be lost.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-success text-white" id="wet_new_transact_confirm">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('wet_new_transact_confirm')?.addEventListener('click', function () {
    window.location.href = 'cuplumps_purchase_record.php';
});
</script>