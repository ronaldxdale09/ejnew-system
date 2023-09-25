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
                <input type="number" class="form-control" name="qty[]" value="' . $row["unit"] . '" style="width: 100px;">

                </div>
        </td>
        <td>
            <div class="input-group">
                <input type="number" readonly class="form-control" name="total_qty[]" value="' . $row["total_qty"] . '" style="width: 100px;">
                <span class="input-group-text">pcs</span>

            </div>
         </td>
        <td>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="amount[]" readonly value="' . number_format($row["amount"], 2) . '" style="width: 100px;" readonly>
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
