<div class="modal fade" id="newCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW | COFFEE SALE</h5>
                <button type="button" class="btn btn-success" onclick="addItemLine()">+ ITEM LINE</button>
            </div>
            <form id="newCoffeeSaleForm">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Invoice No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='coffee_no' id='coffee_no' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col-5">
                            <label style='font-size:15px' class="col-md-12">Customer Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='coffee_customer' id='coffee_customer'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col-4">
                            <label style='font-size:15px' class="col-md-12">Transaction Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="coffee_date" value="<?php echo $today; ?>"
                                    name="coffee_date">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row" id="itemLines">
                        <!-- Item Line Fields (Dynamic) -->
                        <div class="item-line">
                            <div class="row">
                                <div class="col-5">
                                    <label style='font-size:15px' class="col-md-12">Product</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="product[]" style="width: 100px;">
                                            <option>Select...</option>
                                            <option value="LC_W_CASE">LC Powder - Wholesale (1 Case)</option>
                                            <option value="LC_W_KG">LC Powder - Wholesale (1 KG)</option>
                                            <option value="LC_R">LC Powder - Retail (1KG)</option>
                                            <option value="LC_W_HALF_KG">LC Powder - Retail (1/2 KG)</option>
                                            <option value="LC_W_QUARTER_KG">LC Powder - Retail (1/4 KG)</option>
                                            <option value="HB_W_CASE">HB Roasted - Wholesale (1 Case)</option>
                                            <option value="HB_W_KG">HB Roasted - Wholesale (1 KG)</option>
                                            <option value="HB_W_KG">HB Roasted - Retail (1 KG)</option>
                                            <option value="HB_W_HALF_KG">HB Roasted - Retail (1/2 KG)</option>
                                            <option value="HB_W_QUARTER_KG">HB Roasted - Retail (1/4 KG)</option>
                                            <option value="HB_A">HB Roasted - Arabica (1 KG)</option>
                                            <option value="HB_E">HB Roasted - Excelsa (1 KG)</option>
                                            <option value="HB_O">HB Roasted - Robusta (1 KG)</option>
                                            <option value="HB_U">HB Roasted - Arabusta (1 KG)</option>
                                            <option value="KK_A">Kalunkopi - Arabica (1 KILO)</option>
                                            <option value="KK_H">Kalunkopi - House Blend (1 KILO)</option>
                                            <option value="KK_R">Kalunkopi - Robusta (1 KILO)</option>
                                            <option value="KK_U">Kalunkopi - Arabusta (1 KILO)</option>
                                            <option value="KK_A_250G">Kalunkopi - Arabica (250G)</option>
                                            <option value="KK_H_250G">Kalunkopi - House Blend (250G)</option>
                                            <option value="KK_R_250G">Kalunkopi - Robusta (250G)</option>
                                            <option value="KK_U_250G">Kalunkopi - Arabusta (250G)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <label style='font-size:15px' class="col-md-12">Qty</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="unit[]" tabindex="7"
                                            autocomplete="off" style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name="price[]" tabindex="7"
                                            autocomplete="off" style="width: 100px;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <label style='font-size:15px' class="col-md-12">Amount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" name="amount[]" tabindex="7"
                                            autocomplete="off" style="width: 100px;" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Total Amount Due</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='coffee_total_amount'
                                    id='coffee_total_amount' tabindex="7" autocomplete='off' style="width: 100px;"
                                    readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Amount Paid</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='coffee_paid' id='coffee_paid' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remaining Balance</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name='coffee_balance' id='coffee_balance'
                                    tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
        </div>
        </form>
    </div>
</div>


<script>
function addItemLine() {
    const itemLine = document.createElement('div');
    itemLine.classList.add('item-line');
    itemLine.innerHTML = `
    <div class="row">
        <div class="col-5">
            <div class="input-group mb-3">
                <select class="form-select" name="product[]" style="width: 100px;">
                    <option>Select...</option>
                    <option value="LC_W_CASE">LC Powder - Wholesale (1 Case)</option>
                    <option value="LC_W_KG">LC Powder - Wholesale (1 KG)</option>
                    <option value="LC_R">LC Powder - Retail (1KG)</option>
                    <option value="LC_W_HALF_KG">LC Powder - Retail (1/2 KG)</option>
                    <option value="LC_W_QUARTER_KG">LC Powder - Retail (1/4 KG)</option>
                    <option value="HB_W_CASE">HB Roasted - Wholesale (1 Case)</option>
                    <option value="HB_W_KG">HB Roasted - Wholesale (1 KG)</option>
                    <option value="HB_W_KG">HB Roasted - Retail (1 KG)</option>
                    <option value="HB_W_HALF_KG">HB Roasted - Retail (1/2 KG)</option>
                    <option value="HB_W_QUARTER_KG">HB Roasted - Retail (1/4 KG)</option>
                    <option value="HB_A">HB Roasted - Arabica (1 KG)</option>
                    <option value="HB_E">HB Roasted - Excelsa (1 KG)</option>
                    <option value="HB_O">HB Roasted - Robusta (1 KG)</option>
                    <option value="HB_U">HB Roasted - Arabusta (1 KG)</option>
                    <option value="KK_A">Kalunkopi - Arabica (1 KILO)</option>
                    <option value="KK_H">Kalunkopi - House Blend (1 KILO)</option>
                    <option value="KK_R">Kalunkopi - Robusta (1 KILO)</option>
                    <option value="KK_U">Kalunkopi - Arabusta (1 KILO)</option>
                    <option value="KK_A_250G">Kalunkopi - Arabica (250G)</option>
                    <option value="KK_H_250G">Kalunkopi - House Blend (250G)</option>
                    <option value="KK_R_250G">Kalunkopi - Robusta (250G)</option>
                    <option value="KK_U_250G">Kalunkopi - Arabusta (250G)</option>
                </select>
            </div>
        </div>
        <div class="col-1">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="unit[]" tabindex="7"
                    autocomplete="off" style="width: 100px;" />
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="price[]" tabindex="7"
                    autocomplete="off" style="width: 100px;" />
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="amount[]" tabindex="7"
                    autocomplete="off" style="width: 100px;" readonly />
            </div>
        </div>
    </div>
    `;

    const itemLines = document.getElementById('itemLines');
    itemLines.appendChild(itemLine);

    const unitField = itemLine.querySelector('input[name="unit[]"]');
    const priceField = itemLine.querySelector('input[name="price[]"]');
    const amountField = itemLine.querySelector('input[name="amount[]"]');

    unitField.addEventListener('input', () => recalculateLine(unitField, priceField, amountField));
    priceField.addEventListener('input', () => recalculateLine(unitField, priceField, amountField));

    updateTotalAmountDue();
}

window.addEventListener('DOMContentLoaded', (event) => {
    const itemLines = document.querySelectorAll('.item-line');

    itemLines.forEach(itemLine => {
        const unitField = itemLine.querySelector('input[name="unit[]"]');
        const priceField = itemLine.querySelector('input[name="price[]"]');
        const amountField = itemLine.querySelector('input[name="amount[]"]');

        unitField.addEventListener('input', () => recalculateLine(unitField, priceField, amountField));
        priceField.addEventListener('input', () => recalculateLine(unitField, priceField, amountField));
    });

    const paidField = document.querySelector('input[name="coffee_paid"]');
    paidField.addEventListener('input', updateRemainingBalance);

    updateTotalAmountDue();
});

function recalculateLine(unitField, priceField, amountField) {
    const qty = parseFloat(unitField.value) || 0;
    const price = parseFloat(priceField.value) || 0;

    const amount = qty * price;
    amountField.value = amount.toFixed(2);

    updateTotalAmountDue();
}

function updateTotalAmountDue() {
    const amountFields = Array.from(document.querySelectorAll('input[name="amount[]"]'));
    const totalAmountField = document.querySelector('input[name="coffee_total_amount"]');
    let totalAmount = 0;

    amountFields.forEach(field => {
        const amount = parseFloat(field.value) || 0;
        totalAmount += amount;
    });

    totalAmountField.value = totalAmount.toFixed(2);
    updateRemainingBalance();
}

function updateRemainingBalance() {
    const totalAmountField = document.querySelector('input[name="coffee_total_amount"]');
    const amountPaidField = document.querySelector('input[name="coffee_paid"]');
    const balanceField = document.querySelector('input[name="coffee_balance"]');

    const totalAmount = parseFloat(totalAmountField.value) || 0;
    const amountPaid = parseFloat(amountPaidField.value) || 0;

    const balance = totalAmount - amountPaid;
    balanceField.value = balance.toFixed(2);
}

$(document).ready(function() {
    $('#newCoffeeSaleForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'function/newCoffeeSale.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response,
                    onClose: function() {
                        location.reload();
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while submitting the form.',
                });
            }
        });
    });
});
</script>