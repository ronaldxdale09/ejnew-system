<div class="modal fade" id="newCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW | COFFEE SALE</h5>
            </div>
            <form action='function/coffee_sale.php' method='POST'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>Invoice No.</label>
                            <input type="text" class="form-control" name="coffee_no" required>
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
                            <h4 class="header-design">Product List</h4>
                            <table class="table" id="new_sale_table">
                                <thead class='table-warning'>
                                    <tr>
                                        <th class="text-center" style="font-weight:bold;">Product</th>
                                        <th class="text-center" style="font-weight:bold;">Qty</th>
                                        <th class="text-center" style="font-weight:bold;">Price</th>
                                        <th class="text-center" style="font-weight:bold;">Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-warning text-dark" id="addProduct">+ Add Product</button>
                        </div>
                    </div> <br>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-design">Payment Details</h4>

                            <table class="table table-hover table-bordered table-striped" id="new_payment_table">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <button type="button" class="btn btn-sm btn-success" id="addPayment">Add Payment</button>
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
                            <label>Total Amount Paid</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" name="total_amount_paid" readonly>
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
    $(document).ready(function() {

        function calculateAmount(row) {
            var price = parseFloat($(row).find("input[name='price[]']").val().replace(/,/g, ''));
            var quantity = parseInt($(row).find("input[name='qty[]']").val().replace(/,/g, ''));
            return !isNaN(price) && !isNaN(quantity) ? price * quantity : 0;
        }

        function updateRowAmount(row) {
            var amount = calculateAmount(row);
            $(row).find("input[name='amount[]']").val(amount.toFixed(2));
            return amount;
        }

        function updateTotalAmount() {
            var totalAmount = 0;
            $("#new_sale_table tbody tr").each(function() {
                totalAmount += updateRowAmount(this);
            });
            $("input[name='coffee_total_amount']").val(formatWithComma(totalAmount.toFixed(2).toLocaleString('en-US')));
        }

        function calculateTotalPaid() {
            var totalPaid = 0;
            $("#new_payment_table tbody tr").each(function() {
                var paymentAmount = parseFloat($(this).find("input[name='pay_amount[]']").val().replace(/,/g, ''));
                if (!isNaN(paymentAmount)) {
                    totalPaid += paymentAmount;
                }
            });
            return totalPaid;
        }

        function updateTotalPaidAndBalance() {
            var totalAmountDue = parseFloat($("input[name='coffee_total_amount']").val().replace(/,/g, ''));
            var totalPaid = calculateTotalPaid();
            var remainingBalance = totalAmountDue - totalPaid;

            $("input[name='total_amount_paid']").val(formatWithComma(totalPaid.toFixed(2).toLocaleString('en-US')));
            $("input[name='coffee_balance']").val(formatWithComma(remainingBalance.toFixed(2).toLocaleString('en-US')));
        }


        updateTotalAmount();
        updateTotalPaidAndBalance();

        $("#addProduct, #addPayment").click(updateTotalAmount);

        $(document).on("input", "input[name='price[]'], input[name='qty[]'], input[name='pay_amount[]']", function() {
            updateTotalAmount();
            updateTotalPaidAndBalance();
        });

        $(document).on("click", ".remove-item-line, .removePayment", function(event) {
            event.preventDefault();
            $(this).closest("tr").remove();
            updateTotalAmount();
            updateTotalPaidAndBalance();
        });


        $("#addProduct").click(function() {

            // Append the row
            var newRow = `
                <tr>
                <td>
                    <div class="input-group mb-3">
                    <select class="form-select product-dropdown" name="product[]" style="width: 100px;">
                        <option value="">Select...</option>
                        <?php
                        $sql = "SELECT coffee_name, coffee_price FROM coffee_products";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $coffeeName = $row['coffee_name'];
                                $coffeePrice = $row['coffee_price'];
                                echo "<option value='$coffeeName' data-price='$coffeePrice'>$coffeeName</option>";
                            }
                        }

                        ?>
                    </select>
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="qty[]" style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="price[]"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="amount[]"  readonly style="width: 100px;" readonly>
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                    </div>
                </td>
            </tr>
                `;
            $("#new_sale_table tbody").append(newRow);
        });


        $("#addPayment").click(function() {

            // Append the row
            var newRow = `
                <tr>
                    <td><input type="date" class="form-control" name="pay_date[]"></td>
                    <td><input type="text" class="form-control weight" name="pay_details[]"></td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text payment-currency-symbol">₱</span>
                            <input type="text" class="form-control"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="pay_amount[]">
                        </div>
                    </td>
              
                    <td><button class="btn btn-danger removePayment" id="removePayment"><i class="fas fa-trash"></i></button></td>
                </tr>
                `;
            $("#new_payment_table tbody").append(newRow);
        });;



        // Using event delegation to ensure dynamically added elements also have the event listener
        $("#new_sale_table tbody").on('change', '.product-dropdown', function() {
            // Get the selected price from the data-price attribute
            var selectedPrice = $(this).find('option:selected').data('price');
            updateTotalAmount();
            updateTotalPaidAndBalance();
            // Format the price if needed (e.g., number_format in PHP, but here, you might want to use JavaScript)

            // Set the price in the corresponding input field
            $(this).closest('tr').find('input[name="price[]"]').val(selectedPrice);
        });

    });
</script>