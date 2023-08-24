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

<table class="table "  id="coffee-listing-table" >
    <thead class="table-warning">
        <tr>
        <th scope="col" hidden></th>

            <th class="text-center" style="font-weight:bold;">Product</th>
            <th class="text-center" style="font-weight:bold;">Qty</th>
            <th class="text-center" style="font-weight:bold;">Price</th>
            <th class="text-center" style="font-weight:bold;">Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row

while ($row = mysqli_fetch_assoc($result)) {

    // Get the product dropdown
    $productDropdown = '<select class="form-select u_product-dropdown" name="u_product[]" style="width: 100px;">';
    $productDropdown .= '<option selected disabled>Select...</option>';

    // Inner query to fetch coffee names
    $coffeeSql = "SELECT coffee_name, coffee_price FROM coffee_products";
    $coffeeResult = mysqli_query($con, $coffeeSql);
    if ($coffeeResult) {
        while ($coffeeRow = mysqli_fetch_assoc($coffeeResult)) {
            $selected = $coffeeRow['coffee_name'] == $row['product'] ? 'selected' : '';
            $coffeeName = $coffeeRow['coffee_name'];
            $coffeePrice = $coffeeRow['coffee_price'];
            $productDropdown .= "<option value='" . $coffeeName . "' data-price='" . $coffeePrice . "' $selected>" . $coffeeName . "</option>";
        }
    }
    $productDropdown .= '</select>';

    // Append row data to output
    $output .= '
    <tr>
    <td hidden><input type="text"  class="form-control payment_id" name="product_id[]" value="' . $row['sale_line_id'] . '" ></td>

        <td>
            <div class="input-group mb-3">
                ' . $productDropdown . '
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="u_qty[]" value="' . $row["unit"] . '" style="width: 100px;">
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="u_price[]" value="' . number_format($row["price"], 2) . '" style="width: 100px;">
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" name="u_amount[]" readonly value="' . number_format($row["amount"], 2) . '" style="width: 100px;" readonly>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
            </div>
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
        $("#addProductUpdate").click(function() {

            // Append the row
            var newRow = `
                <tr>
                
                <td hidden><input type="text" class="form-control product_id" name="product_id[]"></td>

                <td>
                    <div class="input-group mb-3">
                        <select class="form-select u_product-dropdown" name="u_product[]" style="width: 100px;">
                            <option selected disabled>Select...</option>
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
                        <input type="number" class="form-control" name="u_qty[]" style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="u_price[]"  style="width: 100px;">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" name="u_amount[]" readonly style="width: 100px;" readonly>
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                    </div>
                </td>
            </tr>
                `;
            $("#coffee-listing-table tbody").append(newRow);

            
        });


</script>