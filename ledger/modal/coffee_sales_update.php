<div class="modal fade" id="updateCoffeeSale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
    $(document).ready(function () {
        $(".btnViewRecord").click(function () {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            coffeeId = data[0];
            coffeeNo = data[2];
            coffeeCustomer = data[4];
            coffeeDate = data[3];
            coffeeTotalAmount = data[5];
            coffeePaid = data[6];
            coffeeBalance = data[7];

            console.log(coffeeId)
            $.ajax({
                url: "modal/coffee_table/coffee_sale_line.php", // Adjust this path as needed
                method: "POST",
                data: {
                    coffee_id: coffeeId
                },
                success: function (data) {
                    // Remove existing item lines
                    $('#itemLines').empty();
                    // Add item lines based on data
                    for (let line of data) {
                        // addItemLine is a function that creates a new item line
                        // and populates it with the data from the line object
                        addItemLine(line);
                    }
                }
            });



            $("#updateCoffeeSale input[name='sale_id']").val(coffeeId);
            $("#updateCoffeeSale input[name='coffee_no']").val(coffeeNo);
            $("#updateCoffeeSale select[name='coffee_customer']").val(coffeeCustomer);
            $("#updateCoffeeSale input[name='coffee_date']").val(new Date(coffeeDate).toISOString().split("T")[0]);
            $("#updateCoffeeSale input[name='coffee_total_amount']").val(coffeeTotalAmount.replace(/[^0-9\.]/g, ''));
            $("#updateCoffeeSale input[name='coffee_paid']").val(coffeePaid.replace(/[^0-9\.]/g, ''));
            $("#updateCoffeeSale input[name='coffee_balance']").val(coffeeBalance.replace(/[^0-9\.]/g, ''));

            // Show the modal
            $("#updateCoffeeSale").modal('show');
        });
    });
</script>