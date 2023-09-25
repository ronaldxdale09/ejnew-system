<?php
include('../../function/db.php');

$sales_id = $_POST['sale_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM coffee_sale_line WHERE sale_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table table-hover table-bordered table-striped "  id="new_sale_table" >
    <thead class="table-warning">
        <tr>
        <th scope="col" hidden></th>

            <th class="text-center" style="font-weight:bold;">Product</th>
            <th class="text-center" style="font-weight:bold;">Price</th>
            <th class="text-center" style="font-weight:bold;">Specification</th>
            <th class="text-center" style="font-weight:bold;">Qty</th>
            <th class="text-center" style="font-weight:bold;">Total Qty.</th>
            <th class="text-center" style="font-weight:bold;">Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row


while ($row = mysqli_fetch_assoc($result)) {

    // Get the product dropdown
    $productDropdown = '<select class="form-select product-dropdown" name="product[]">>';
    $productDropdown .= '<option selected disabled>Select...</option>';

    $coffeeSql = "SELECT coffee_name, coffee_id, weight, weight_unit,case_quantity
    FROM coffee_products";
    $coffeeResult = mysqli_query($con, $coffeeSql);
    if ($coffeeResult) {
        while ($coffeeRow = mysqli_fetch_assoc($coffeeResult)) {
            $coffeeName = $coffeeRow['coffee_name'] . '-' . $coffeeRow['weight'] . '' . $coffeeRow['weight_unit'];
            $coffee_id = $coffeeRow['coffee_id'];
            $selected = $coffeeRow['coffee_id'] == $row['coffee_id'] ? 'selected' : '';
            $case_qty = $coffeeRow['case_quantity'];

            $weight = $coffeeRow['weight'];
            $weight_unit = $coffeeRow['weight_unit'];
            $productDropdown .= "<option value='" . $coffee_id . "'  data-case_qty='" . $case_qty . "'  data-weight='" . $weight . "' data-unit='" . $weight_unit . "' $selected>" . $coffeeName . "</option>";
        }
    }
    $productDropdown .= '</select>';
    $specification = $row['specification'];
    $pcsSelected = ($specification == 'PCS') ? 'selected' : '';
    $caseSelected = ($specification == 'CASE') ? 'selected' : '';

    // Append row data to output
    $output .= '
    <tr>
    <td hidden><input type="text"  class="form-control payment_id" name="product_id[]" value="' . $row['sale_line_id'] . '" ></td>

        <td>
            <div class="input-group">
                ' . $productDropdown . '
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="price[]" value="' . number_format($row["price"], 2) . '" style="width: 100px;">
            </div>
        </td>
        <td>
        <select class="form-select" name="spec[]">
            <option value="PCS" ' . $pcsSelected . '>PCS</option>
            <option value="CASE" ' . $caseSelected . '>CASE</option>
        </select>
    </td>
        <td>
            <div class="input-group">
                <input type="number" class="form-control qty-input" name="qty[]" value="' . $row["unit"] . '" style="width: 100px;">
                </div>
        </td>
        <td>
            <div class="input-group">
                <input type="number" readonly class="form-control total-qty-input" name="total_qty[]" value="' . $row["total_qty"] . '" style="width: 100px;">
                <span class="input-group-text">pcs</span>

            </div>
         </td>
        <td>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="amount[]" readonly value="' . number_format($row["amount"], 2) . '" style="width: 100px;" readonly>
            </div>
        </td>
        
        <td>
            <div class="input-group">
                <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
            </div>
        </td>
    </tr>
    ';
}

$output .= '
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-warning text-dark" id="addProduct">+ Add Product</button>

';

echo $output;
?>


<script>
    $(document).ready(function() {

        function calculateAmount(row) {
            var price = parseFloat($(row).find("input[name='price[]']").val().replace(/,/g, ''));
            var total_qty = parseInt($(row).find("input[name='total_qty[]']").val().replace(/,/g, ''));
            return !isNaN(price) && !isNaN(total_qty) ? price * total_qty : 0;
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
                <div class="input-group">
                <select class="form-select product-dropdown" name="product[]" style="width: 100px;">
                    <option value="">Select...</option>
                    <?php
                    $sql = "SELECT unit_price,coffee_name, coffee_id, weight, weight_unit ,case_quantity
                    FROM coffee_products";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $coffeeName = $row['coffee_name'] . '-' . $row['weight'] . '' . $row['weight_unit'];
                            $coffee_id = $row['coffee_id'];
                            $price = $row['unit_price'];

                            $case_qty = $row['case_quantity'];

                            $weight = $row['weight'];
                            $weight_unit = $row['weight_unit'];
                            echo "<option value='$coffee_id'  data-case_qty='$case_qty' data-price='$price' data-weight='$weight' data-unit='$weight_unit'>$coffeeName </option>";
                        }
                    }
                    ?>
                </select>
                </div>
            </td>
        
            <td>
                <div class="input-group">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="price[]"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" style="width: 100px;">
                </div>
            </td>
            <td>
                <select class="form-select" name="spec[]">
                    <option value="PCS" selected>PCS</option> <!-- Set "PCS" as default -->
                    <option value="CASE">CASE</option>
                </select>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control qty-input" name="qty[]" style="width: 100px;">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" readonly class="form-control total-qty-input" name="total_qty[]" style="width: 100px;">
                    <span class="input-group-text">pcs</span>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text">₱</span>
                    <input type="text" class="form-control" name="amount[]"  readonly style="width: 100px;" readonly>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                </div>
            </td>
        </tr>
    `;
            $("#new_sale_table tbody").append(newRow);

            // Initialize the new row's "spec[]" dropdown
            var $newRow = $("#new_sale_table tbody tr:last");
            $newRow.find('.product-dropdown').chosen({
                width: "100%"
            });


            // Update total quantity for the new row
            $newRow.find('.qty-input').trigger('input');



        });

        // Event delegation for quantity input change in the entire table
        $("#new_sale_table tbody").on('input', '.qty-input', function() {
            // Find the parent row of the changed input
            var $currentRow = $(this).closest('tr');

            // Get the selected specification (PCS or CASE)
            var selectedSpec = $currentRow.find('select[name="spec[]"]').val();

            // Get the quantity value from the input field
            var quantity = parseFloat($(this).val()) || 0;

            // Get the case quantity from the selected product's data attribute
            var caseQty = parseFloat($currentRow.find('.product-dropdown option:selected').data('case_qty')) || 0;

            // Calculate the total quantity based on the selected specification
            var totalQty = (selectedSpec === 'PCS') ? quantity : quantity * caseQty;

            // Set the calculated total quantity in the corresponding input field
            $currentRow.find('.total-qty-input').val(totalQty);

            updateTotalAmount();
            updateTotalPaidAndBalance();
        });
        $("#addPayment").click(function() {

            // Append the row
            var newRow = `
                <tr>
                    <td><input type="date" class="form-control" name="pay_date[]"></td>
                    <td><input type="text" class="form-control weight" name="pay_details[]"></td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-text payment-currency-symbol">₱</span>
                            <input type="text" class="form-control"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="pay_amount[]">
                        </div>
                    </td>
              
                    <td><button class="btn btn-danger removePayment" id="removePayment"><i class="fas fa-trash"></i></button></td>
                </tr>
                `;
            $("#new_payment_table tbody").append(newRow);
        });;


        $("#new_sale_table tbody").on('change', '.product-dropdown', function() {
            // Get the selected price from the data-price attribute
            var selectedPrice = $(this).find('option:selected').data('price');

            updateTotalAmount();
            updateTotalPaidAndBalance();

            // Format the price if needed (e.g., number_format in PHP, but here, you might want to use JavaScript)

            // Set the price in the corresponding input field
            $(this).closest('tr').find('input[name="price[]"]').val(selectedPrice);
        });

        // Event handler for the "spec[]" dropdown change
        $("#new_sale_table tbody").on('change', 'select[name="spec[]"]', function() {
            var selectedSpec = $(this).val();
            var $row = $(this).closest('tr');

            // Get the selected quantity value
            var selectedQty = parseFloat($row.find('input[name="qty[]"]').val()) || 0;

            // Get the selected case quantity value from data-case_qty attribute
            var caseQty = parseFloat($row.find('.product-dropdown option:selected').data('case_qty')) || 0;

            // Calculate the Total Qty based on "spec[]" selection
            var totalQty = (selectedSpec === 'PCS') ? selectedQty : selectedQty * caseQty;

            // Set the calculated Total Qty in the corresponding input field
            $row.find('input[name="total_qty[]"]').val(totalQty);
            updateTotalAmount();
            updateTotalPaidAndBalance();

        });

    });
</script>