<div class="modal fade" id="updateCoffeeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> UPDATE | COFFEE SALE</h5>

            </div>
            <form action='function/coffee_sale_update.php' method='POST'>
                <div class="modal-body">
                    <input type="text" class="form-control" id='u_sale_id' name="sale_id" hidden>
                    <div class="row">
                        <div class="col">
                            <label>Invoice No.</label>
                            <input type="text" class="form-control" id='coffee_no' name="coffee_no">
                        </div>
                        <div class="col-5">
                            <label>Customer Name</label>
                            <select class='form-select category' name='coffee_customer' id='customer_name' required>
                                    <option disabled="disabled" value="" selected="selected">Select Category </option>
                                    <?php echo $customer_name ?>

                                    <!--PHP echo-->
                                </select>
                        </div>

                        <div class="col-4">
                            <label>Transaction Date</label>
                            <input type="date" class="form-control" id='coffee_date' name="coffee_date" required>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h4> Product List</h4>
                            <div id="product_list_table"></div>



                        </div>


                    </div>

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <h4> Payment Details</h4>
                            <div id="payment_list_table"></div>
                        </div>
                    </div>


                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Total Amount Due</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" id='coffee_total_amount' name="coffee_total_amount" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Total Amount Paid</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" id='total_amount_paid' name="total_amount_paid" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label>Remaining Balance</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control" id='coffee_balance' name="coffee_balance" readonly>
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

        function u_calculateAmount(row) {
            var price = parseFloat($(row).find("input[name='u_price[]']").val().replace(/,/g, '')) || 0;
            var quantity = parseInt($(row).find("input[name='u_qty[]']").val().replace(/,/g, '')) || 0;
            return price * quantity;
        }

        function u_updateRowAmount(row) {
            var amount = u_calculateAmount(row);
            $(row).find("input[name='u_amount[]']").val(formatWithComma(amount.toFixed(2)));
            return amount;
        }

        function u_updateTotal(selector, calculationFunction) {
            var total = 0;
            $(selector).each(function() {
                total += calculationFunction(this);
            });
            return total;
        }

        function u_updateTotalPaidAndBalance() {
            var totalAmountDue = parseFloat($("#coffee_total_amount").val().replace(/,/g, '')) || 0;
            var totalPaid = u_updateTotal("#coffee-payment-table tbody tr", function(row) {
                return parseFloat($(row).find("input[name='u_pay_amount[]']").val().replace(/,/g, '')) || 0;
            });
            var remainingBalance = totalAmountDue - totalPaid;

            $("#total_amount_paid").val(formatWithComma(totalPaid.toFixed(2).toLocaleString('en-US')));
            $("#coffee_balance").val(formatWithComma(remainingBalance.toFixed(2).toLocaleString('en-US')));
        }

        // Initialization
        $("#coffee_total_amount").val(u_updateTotal("#coffee-listing-table tbody tr", u_updateRowAmount).toFixed(2).toLocaleString('en-US'));
        u_updateTotalPaidAndBalance();

        // Event Listeners
        $(document).on("input", "input[name='u_price[]'], input[name='u_qty[]']", function() {
            $("#coffee_total_amount").val(u_updateTotal("#coffee-listing-table tbody tr", u_updateRowAmount).toFixed(2).toLocaleString('en-US'));
            u_updateTotalPaidAndBalance();
        });

        $(document).on("input", "input[name='u_pay_amount[]']", function() {
            u_updateTotalPaidAndBalance();
        });

        $(document).on("click", ".remove-item-line", function(event) {
            event.preventDefault();
            $(this).closest("tr").remove();
            $("#coffee_total_amount").val(u_updateTotal("#coffee-listing-table tbody tr", u_updateRowAmount).toFixed(2).toLocaleString('en-US'));
            u_updateTotalPaidAndBalance();
        });

    });
</script>