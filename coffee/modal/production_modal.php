<?php

$sql = mysqli_query($con, "SELECT  COUNT(*) from coffee_production_record  ");
$withdrawal = mysqli_fetch_array($sql);

$generate = sprintf("%'03d", $withdrawal[0] + 1);
$today = date("Y");
$code = 'P' . $today . $generate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>



<div class="modal fade" id="newProduction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title">Add Production</h5>

            </div>
            <div class="modal-body">
                <form method='POST' action='function/coffee_production.php'>


                    <div class="card">
                        <div class="card-body" style="background-color: #FBEFEF;">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Production Date</label>
                                        <input type="date" class="form-control" name="prod_date"  aria-describedby="amount" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Production Code</label>
                                        <input type="text" class="form-control gray-background" name="prod_code" value='<?php echo $code ?>' aria-describedby="amount" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Recorded By</label>
                                        <input type="text" class="form-control" name="recorded_by" value="<?php echo $_SESSION["full_name"];?>">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                 <div class="col-2">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Lot #</label>
                                            <input type="text" class="form-control"  name="lot_no" required>
                                        
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">No. Sack</label>
                                            <input type="text" class="form-control"  name="no_sack" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Entry Weight</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="entry_weight" name="entry_weight" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Produced Weight</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control gray-background" readonly id="global_total_weight" name="productio_totalWeight" aria-describedby="amount" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="amount" class="form-label d-block text-center">Recovery</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control gray-background" id="recovery_weight" name="recovery_weight" readonly aria-describedby="amount" required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body" style="background-color: #FDEEDD;">
                            <h4 class="header-design">Product List</h4>
                            <table class="table" id="new_sale_table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Unit Weight</th>
                                        <th class="text-center">Total Weight</th>

                                        <th class="text-center">Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <button type="button" class="btn btn-sm btn-warning text-dark" id="addProduct">+ Add Product</button>
                        </div>
                    </div>
                    <br>




            </div>
            <div class="modal-footer">
                <button type="submit" name='confirm' class="btn btn-dark">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<style>
    #new_sale_table tbody tr {
        margin: 0;
        /* Removes any margin around rows */
        padding: 0;
        /* Removes any padding around rows */
        border: none;
        /* Removes any border around rows */
    }

    #new_sale_table tbody tr td {
        border-top: none;
        /* Removes top border from table cells */
    }

    .text-center {
        font-weight: bold;
    }

    .product-dropdown {
        width: 100px;
    }

    .form-control[name="qty[]"] {
        width: 100px;
    }
</style>
<script>
    $("#addProduct").click(function() {
        // Append the row
        var newRow = `
        <tr>
            <td style="width:35%">
                <div class="input-group mb-3">
                    <select class="form-select product-dropdown" name="product[]">
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
                    <input type="text" class="form-control" name="weight[]" autocomplete="off" placeholder="Quantity" readonly>
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="r_total_weight[]" autocomplete="off"  readonly>
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="qty[]" autocomplete="off" placeholder="Qty.">
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-item-line" onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
    `;

        $("#new_sale_table tbody").append(newRow);

        $("#new_sale_table tbody tr:last .product-dropdown").chosen({
            // Optional: Add ChosenJS configurations here
            width: "100%"
        });
    });

    // Handle the 'Remove' button for dynamically added rows
    $("#new_sale_table tbody").on("click", ".remove-item-line", function() {
        $(this).closest('tr').remove();
        updateTotalWeight();
    });


    $(document).on('change', '.product-dropdown', function() {
        var $weightInput = $(this).closest('tr').find('input[name="weight[]"]');
        var weight = $('option:selected', this).data('weight');
        var weight_unit = $('option:selected', this).data('unit');

        if (weight && weight_unit) {
            $weightInput.val(weight + ' ' + weight_unit);
        } else {
            $weightInput.val(''); // clear the weight input if no weight data is found
        }
        updateTotalWeight();
    });

    function computeRecoveryWeight() {
        let entryWeightValue = $("#entry_weight").val().replace(/,/g, ''); // Remove commas
        let entryWeight = parseFloat(entryWeightValue) || 0;

        let totalWeight = parseFloat($("#global_total_weight").val().split(" ")[0]) || 0; // Getting the numeric part of "0.50 kg"

        if (entryWeight === 0) {
            $("#recovery_weight").val("0"); // If entry weight is 0, set recovery to 0
            return;
        }

        let recoveryPercentage = (totalWeight / entryWeight) * 100;
        $("#recovery_weight").val(recoveryPercentage.toFixed(2)); // Display up to 2 decimal places
    }


    $(document).on('keyup', 'input[name="qty[]"], #entry_weight', function() {
        // Update total weight after changing a product's quantity or the entry weight
        updateTotalWeight();
    });



    function updateTotalWeight() {
        var totalWeight = 0;

        // Loop through each row in the table
        $("#new_sale_table tbody tr").each(function() {
            var $row = $(this);

            // Find the weight, unit, and quantity input fields for this row
            var weightValue = $row.find('input[name="weight[]"]').val().split(' ')[0];
            var weightUnit = $row.find('input[name="weight[]"]').val().split(' ')[1];
            var weight = parseFloat(weightValue) || 0;
            var qty = parseFloat($row.find('input[name="qty[]"]').val()) || 0;

            // Convert the weight to kg if it's in grams
            if (weightUnit === "g") {
                weight = weight / 1000; // Convert grams to kilograms
            }

            // Calculate total weight for this product
            var rowTotalWeight = weight * qty;

            // Update the "Total Weight" field for this row with 'kg' appended
            $row.find('input[name="r_total_weight[]"]').val(rowTotalWeight.toFixed(2) + ' kg');

            // Add this row's total weight to the overall total weight
            totalWeight += rowTotalWeight;
        });

        // Update some global total weight field, if you have one
        // For demonstration purposes, let's assume you have a global input field with id "global_total_weight"
        $("#global_total_weight").val(totalWeight.toFixed(2) + ' kg');

        // Now you might want to update the recovery weight
        computeRecoveryWeight();
    }
</script>