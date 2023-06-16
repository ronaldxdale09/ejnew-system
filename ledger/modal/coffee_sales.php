    <div class="modal fade" id="newCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> NEW | COFFEE SALE</h5>
                    <button type="button" class="btn btn-success" onclick="addItemLine()">+ ITEM LINE</button>
                </div>
                <form action='function/newCoffeeSale.php' method='POST'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Invoice No.</label>
                                <input type="text" class="form-control" name="coffee_no">
                            </div>
                            <div class="col-5">
                                <label>Customer Name</label>
                                <select class="form-control" name="coffee_customer" required>
                                    <option value="" selected disabled hidden>Select...</option>
                                    <?php
                                        // Retrieve customer names from the coffee_customer table
                                        $sql = "SELECT cof_customer_name FROM coffee_customer";
                                        $result = mysqli_query($con, $sql);
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $customerName = $row['cof_customer_name'];
                                                echo "<option value='$customerName'>$customerName</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <label>Transaction Date</label>
                                <input type="date" class="form-control" name="coffee_date" required>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="modal-title">PRODUCTS</h6>
                                <hr>
                                <div class="row" id="itemLines">
                                    <div class="col-4">
                                        Name
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="product[]" style="width: 100px;">
                                                <option>Select...</option>
                                                <?php
                                                    $sql = "SELECT coffee_product_description, coffee_product_price FROM coffee_products";
                                                    $result = mysqli_query($con, $sql);
                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $productDescription = $row['coffee_product_description'];
                                                            $productPrice = $row['coffee_product_price'];
                                                            echo "<option value='$productDescription' data-price='$productPrice'>$productDescription</option>";                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        Price
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name="price[]" style="width: 100px;"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        Unit (Qty)
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="unit[]" style="width: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        Amount
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name="amount[]"
                                                style="width: 100px;" readonly>
                                        </div>
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
document.addEventListener('DOMContentLoaded', function() {
    // Get the select element
    var selectElement = document.querySelector('select[name="product[]"]');

    // Get the price input element
    var priceInput = document.querySelector('input[name="price[]"]');

    // Add event listener for change event
    selectElement.addEventListener('change', function() {
        // Get the selected option
        var selectedOption = this.options[this.selectedIndex];

        // Get the price value from the selected option's dataset
        var productPrice = selectedOption.dataset.price;

        // Set the price input value
        priceInput.value = productPrice;
    });
});
    </script>


    <script>
function addItemLine() {
    const itemLine = document.createElement('div');
    itemLine.classList.add('item-line');
    itemLine.innerHTML = `
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <select class="form-select product-select" name="product[]" style="width: 100px;">
                                <option>Select...</option>
                                <?php
                                $sql = "SELECT coffee_product_description, coffee_product_price FROM coffee_products";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $productDescription = $row['coffee_product_description'];
                                        $productPrice = $row['coffee_product_price'];
                                        echo "<option value='$productDescription' data-price='$productPrice'>$productDescription</option>";
                                    }
                                }                            
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control price-field" name="price[]" style="width: 100px;" readonly>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="unit[]" style="width: 100px;">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="amount[]" style="width: 100px;" readonly>
                        </div>
                    </div>
                </div>
            `;

    const itemLines = document.getElementById('itemLines');
    itemLines.appendChild(itemLine);

    const productSelect = itemLine.querySelector('.product-select');
    const priceField = itemLine.querySelector('.price-field');
    const unitField = itemLine.querySelector('input[name="unit[]"]');

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceField.value = price;
        unitField.value = '';
        recalculateLine.call(unitField);
    });

    unitField.addEventListener('input', function() {
        recalculateLine.call(this);
    });

    updateTotalAmountDue();
}

function recalculateLine() {
    const itemLine = this.closest('.item-line');
    const qty = parseFloat(this.value) || 0;
    const priceField = itemLine.querySelector('.price-field');
    const amountField = itemLine.querySelector('input[name="amount[]"]');

    const price = parseFloat(priceField.value) || 0;
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
    </script>