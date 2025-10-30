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
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {

    $coffee_unit = $row['c_weight'] . ' ' . $row['c_weight_unit'];
    // Get the product dropdown
    $productDropdown = '<select class="form-select u_product-dropdown" name="product[]" disabled>';
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
            <input readonly type="text" class="form-control weight-input" name="weight[]" value=" ' . $coffee_unit  . '"autocomplete="off" placeholder="Quantity" readonly>
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <input readonly type="text" class="form-control total-weight-input" name="u_total_weight[]" value="' . $row['total_weight']  . ' kg" autocomplete="off"  readonly>
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <input readonly type="number" class="form-control qty-input" name="qty[]" value="' . $row['qty'] . '" autocomplete="off" placeholder="Quantity">
        </div>
    </td>
</tr>
    ';
}

$output .= '
    </tbody>
</table>

';

echo $output;
?>



