<!-- Confirm Transaction -->
<form action="function/confirmWetReceiving.php" id='newPurchase' method="POST">
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
                                        <span class="input-group-text" id="inputGroup-sizing-default">Ref #</span>
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

                  <input name="m_id" id="m_id" hidden  >
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
                    <button type='submit'  name='confirmPurchase'
                        class="btn btn-success text-white">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
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
    $('#m_invoice').val($("#invoice").val());
    
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
// Function to display a Swal message
function showSwalMessage(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    });
}


// Attach event handlers
$('#confirm').click(handleConfirmButtonClick);

</script>
