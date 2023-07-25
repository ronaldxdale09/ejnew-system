<div class="modal fade" id="newCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW | COFFEE SALE</h5>
                <button type="button" class="btn btn-success" onclick="addItemLine()">+ ITEM LINE</button>
            </div>
            <form action='function/coffee_sale.php' method='POST'>
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
                    <option >Select...</option>
                    <?php
                    // Retrieve coffee names from the coffee_products table
                    $sql = "SELECT coffee_name FROM coffee_products";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $coffeeName = $row['coffee_name'];
                            echo "<option value='$coffeeName'>$coffeeName</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="unit[]" style="width: 100px;">
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

        const coffeeNameField = itemLine.querySelector('select[name="product[]"]');
        const unitField = itemLine.querySelector('input[name="unit[]"]');
        const priceField = itemLine.querySelector('input[name="price[]"]');
        const amountField = itemLine.querySelector('input[name="amount[]"]');

        coffeeNameField.addEventListener('change', () => {
    // Retrieve the selected coffee name
    const selectedCoffeeName = coffeeNameField.value;

    if (selectedCoffeeName === 'Select...') {
        // Set unitField, priceField, and amountField to 0
        unitField.value = 0;
        priceField.value = 0;
        amountField.value = 0;
    } else {
        // Make an AJAX call to the server to get the price for the selected coffee
        fetch(`function/coffee_fetch_product_data.php?coffee_name=${selectedCoffeeName}`)
            .then(response => response.json())
            .then(data => {
                // Update the price field with the fetched price
                priceField.value = data.price;
                recalculateLine.call(priceField); // Trigger recalculation
            })
            .catch(error => {
                console.error('Error fetching coffee price:', error);
                // You can set a default or handle the error as needed.
            });
    }
});



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
</script>