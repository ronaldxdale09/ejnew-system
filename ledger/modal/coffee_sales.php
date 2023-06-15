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
                            <label>Invoice No.</label>
                            <input type="text" class="form-control" name="coffee_no">
                        </div>
                        <div class="col-5">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" name="coffee_customer">
                        </div>
                        <div class="col-4">
                            <label>Transaction Date</label>
                            <input type="date" class="form-control" name="coffee_date">
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="row" id="itemLines">

                                <div class="col-4">Product
                                </div>
                                <div class="col-2">Qty
                                </div>
                                <div class="col">Price
                                </div>
                                <div class="col">Amount
                                </div>
                        
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Total Amount Due</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_total_amount" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Amount Paid</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_paid">
                            </div>
                        </div>
                        <div class="col">
                            <label>Remaining Balance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="coffee_balance" readonly>
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
</div>



<script>
function addItemLine() {
    const itemLine = document.createElement('div');
    itemLine.classList.add('item-line');
    itemLine.innerHTML = `
        <div class="row">
            <div class="col-4">
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
            <div class="col-2">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="unit[]" style="width: 100px;">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="price[]" style="width: 100px;">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="amount[]" style="width: 100px;" readonly>
                </div>
            </div>
        </div>
    `;

    const itemLines = document.getElementById('itemLines');
    itemLines.appendChild(itemLine);

    const unitField = itemLine.querySelector('input[name="unit[]"]');
    const priceField = itemLine.querySelector('input[name="price[]"]');
    const amountField = itemLine.querySelector('input[name="amount[]"]');

    unitField.addEventListener('input', recalculateLine);
    priceField.addEventListener('input', recalculateLine);

    updateTotalAmountDue();
}

document.addEventListener('DOMContentLoaded', () => {
    const itemLines = document.querySelectorAll('.item-line');

    itemLines.forEach(itemLine => {
        const unitField = itemLine.querySelector('input[name="unit[]"]');
        const priceField = itemLine.querySelector('input[name="price[]"]');
        const amountField = itemLine.querySelector('input[name="amount[]"]');

        unitField.addEventListener('input', recalculateLine);
        priceField.addEventListener('input', recalculateLine);
    });

    const paidField = document.querySelector('input[name="coffee_paid"]');
    paidField.addEventListener('input', updateRemainingBalance);

    updateTotalAmountDue();
});

function recalculateLine() {
    const itemLine = this.closest('.item-line');
    const qty = parseFloat(itemLine.querySelector('input[name="unit[]"]').value) || 0;
    const price = parseFloat(itemLine.querySelector('input[name="price[]"]').value) || 0;

    const amountField = itemLine.querySelector('input[name="amount[]"]');
    const amount = qty * price;
    amountField.value = amount.toFixed(2);

    updateTotalAmountDue();
}

function updateTotalAmountDue() {
    const amountFields = Array.from(document.querySelectorAll('input[name="amount[]"]'));
    const totalAmountField = document.querySelector('input[name="coffee_total_amount"]');
    const totalAmount = amountFields.reduce((total, field) => total + (parseFloat(field.value) || 0), 0);

    totalAmountField.value = totalAmount.toFixed(2);
    updateRemainingBalance();
}

function updateRemainingBalance() {
    const totalAmount = parseFloat(document.querySelector('input[name="coffee_total_amount"]').value) || 0;
    const amountPaid = parseFloat(document.querySelector('input[name="coffee_paid"]').value) || 0;
    const balanceField = document.querySelector('input[name="coffee_balance"]');
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