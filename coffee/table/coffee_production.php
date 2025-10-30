<?php
include('../../function/db.php');

$prod_id = $_POST['prod_id'];

// Query to get the bale info from the database
$query = "SELECT *,coffee_products.weight as c_weight,coffee_products.weight_unit as c_weight_unit
FROM coffee_production_list 
LEFT JOIN coffee_products on coffee_products.coffee_id = coffee_production_list.coffee_id
WHERE production_id = '$prod_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table "  id="coffee-listing-update" >
    <thead class="table-warning">
        <tr>
        <th scope="col" hidden></th>

            <th class="text-center" style="font-weight:bold;">Product</th>
            <th class="text-center" style="font-weight:bold;">Unit Weight</th>
            <th class="text-center" style="font-weight:bold;">Total Weight</th>
            <th class="text-center" style="font-weight:bold;">Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {

    $coffee_unit = $row['c_weight'] . ' ' . $row['c_weight_unit'];
    // Get the product dropdown
    $productDropdown = '<select class="form-select u_product-dropdown" name="product[]">>';
    $productDropdown .= '<option selected disabled>Select...</option>';

    $coffeeSql = "SELECT coffee_name, coffee_id, weight, weight_unit 
    FROM coffee_products";
    $coffeeResult = mysqli_query($con, $coffeeSql);
    if ($coffeeResult) {
        while ($coffeeRow = mysqli_fetch_assoc($coffeeResult)) {
            $coffeeName = $coffeeRow['coffee_name'] . '-' . $coffeeRow['weight'] . '' . $coffeeRow['weight_unit'];
            $coffee_id = $coffeeRow['coffee_id'];
            $selected = $coffeeRow['coffee_id'] == $row['coffee_id'] ? 'selected' : '';

            $weight = $coffeeRow['weight'];
            $weight_unit = $coffeeRow['weight_unit'];
            $productDropdown .= "<option value='" . $coffee_id . "' data-weight='" . $weight . "' data-unit='" . $weight_unit . "' $selected>" . $coffeeName . "</option>";
        }
    }

    $productDropdown .= '</select>';

    // Append row data to output
    $output .= '
    <tr>
    <td hidden><input type="text" class="form-control coffee_id" name="coffee_id[]" value="' . $row['coffee_id'] . '"></td>

    <td style="width:40%">
        <div class="input-group mb-3">
            ' . $productDropdown . '
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <input type="text" class="form-control weight-input" name="weight[]" value=" ' . $coffee_unit  . '"autocomplete="off" placeholder="Quantity" readonly>
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <input type="text" class="form-control total-weight-input" name="u_total_weight[]" value="' . $row['total_weight']  . ' kg" autocomplete="off"  readonly>
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <input type="number" class="form-control qty-input" name="qty[]" value="' . $row['qty'] . '" autocomplete="off" placeholder="Quantity">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
    </td>
</tr>
    ';
}

$output .= '
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-warning text-dark" id="addProductUpdate">+ Add Product</button>

';

echo $output;
?>




<script>
    $(document).ready(function() {
        $("#addProductUpdate").click(function() {
            var newRow = `
        <tr>
            <td hidden><input type="text" class="form-control coffee_id" name="coffee_id[]"></td>

            <td style="width:40%">
                <div class="input-group mb-3">
                    <select class="form-select u_product-dropdown" name="product[]">
                        <option value="" selected disabled>Select...</option>
                        <?php
                        $sql = "SELECT coffee_name, coffee_id, weight, weight_unit FROM coffee_products";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $coffeeName = $row['coffee_name'] . '-' . $row['weight'] . '' . $row['weight_unit'];
                                $coffee_id = $row['coffee_id'];
                                $weight = $row['weight'];
                                $weight_unit = $row['weight_unit'];
                                echo "<option value='$coffee_id' data-weight='$weight' data-unit='$weight_unit'>$coffeeName </option>";
                            }
                        }
                        ?>

                    </select>
                </div>
            </td>
            <td>
        <div class="input-group mb-3">
            <input type="text" class="form-control weight-input" name="weight[]" autocomplete="off" placeholder="Quantity" readonly>
        </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <input type="text" class="form-control total-weight-input" name="u_total_weight[]"  autocomplete="off"  readonly>
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <input type="number" class="form-control qty-input" name="qty[]" autocomplete="off" placeholder="Quantity">
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-item-line" onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
    `;
            $("#coffee-listing-update tbody").append(newRow);

            $("#coffee-listing-update tbody tr:last .u_product-dropdown").chosen({
                // Optional: Add ChosenJS configurations here
                width: "100%"
            });
        });

        $("#coffee-listing-update tbody").on("click", ".remove-item-line", function() {
            $(this).closest('tr').remove();
            updateTotalWeight();
        });

        $(document).on('change', '.u_product-dropdown', function() {
            var $weightInput = $(this).closest('tr').find('.weight-input');
            var weight = $('option:selected', this).data('weight');
            var weight_unit = $('option:selected', this).data('unit');

            if (weight && weight_unit) {
                $weightInput.val(weight + ' ' + weight_unit);
            } else {
                $weightInput.val(''); // clear the weight input if no weight data is found
            }
            updateTotalWeight();
        });

        $(document).on('keyup', '.qty-input, #u_entry_weight', function() {
            updateTotalWeight();
        });

        function updateTotalWeight() {
            var totalWeight = 0;
            $("#coffee-listing-update tbody tr").each(function() {
                var $row = $(this);
                var weightValue = parseFloat($row.find('.weight-input').val()) || 0; // get weight value
                var qty = parseFloat($row.find('.qty-input').val()) || 0; // get quantity
                var rowTotalWeight = weightValue * qty; // compute total weight for this row

                // update the total weight input for this row
                $row.find('.total-weight-input').val(rowTotalWeight.toFixed(2) + ' kg');

                // update the global total weight
                totalWeight += rowTotalWeight;
            });

            $("#u_global_total_weight").val(totalWeight.toFixed(2) + ' kg');
            computeRecoveryWeight();
        }

        function computeRecoveryWeight() {
            let entryWeightValue = $("#u_entry_weight").val().replace(/,/g, ''); // Remove commas
            let entryWeight = parseFloat(entryWeightValue) || 0;

            let totalWeight = parseFloat($("#u_global_total_weight").val().split(" ")[0]) || 0;

            if (entryWeight === 0) {
                $("#u_recovery_weight").val("0");
                return;
            }

            let recoveryPercentage = (totalWeight / entryWeight) * 100;
            $("#u_recovery_weight").val(recoveryPercentage.toFixed(2));
        }
    });
</script>