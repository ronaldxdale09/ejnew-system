<style>
    #rubber-table th,
    #rubber-table td,
    #rubber-table input,
    #rubber-table select {
        font-weight: normal !important;
    }
</style>

<?php
include('../../function/db.php');

$container_id = $_POST['container_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM cuplump_container_inv WHERE container_id= '$container_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<button type="button" id="addRow" class="btn btn-success">+ Add Inventory</button> <hr>
<table class="table custom-table cuplump_container"  id="cuplump_container" >
    <thead style="font-weight: normal !important;">
    <tr>
        <th scope="col" hidden></th>
        <th scope="col" width="15%" style="white-space: nowrap;">Supplier</th>
        <th scope="col" width="12%" style="white-space: nowrap;">Buying Weight</th>
        <th scope="col" width="9%"  style="white-space: nowrap;">Final DRC</th>
        <th scope="col" style="white-space: nowrap;">Dry/Selling Weight</th>
        <th scope="col" style="white-space: nowrap;">Cost Per Kilo (₱)</th>
        <th scope="col" style="white-space: nowrap;">Total Cost (₱)</th>

        <th scope="col" style="white-space: nowrap;">Amount Paid (₱)</th>
        <th scope="col" style="white-space: nowrap;">Remarks</th>
        <th scope="col"></th>
    </tr>

    </thead>
    <tbody   style="font-weight: normal !important;">';

// Fetch the data from the database and output each row
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    // Hidden inventory ID
    $output .= '<td hidden><input type="text" readonly class="form-control small-font-input" name="inventory_id[]" value="' . $row['cuplump_inventory_id'] . '"></td>';

    // Supplier
    $output .= '<td><input type="text" class="form-control small-font-input" name="supplier[]" value="' . $row['supplier'] . '"></td>';

    // Buying Weight with comma separator
    $output .= '<td>
    <div class="input-group">
    <input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control small-font-input weight" name="buying_weight[]" value="' . number_format($row['buying_weight'], 0) . '">
    <span class="input-group-text">kg</span>
    </div>
    </td>';

    // DRC
    $output .= '<td>
    <div class="input-group">
    <input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control small-font-input drcInput" name="drc[]" value="' . number_format($row['drc'], 2) . '">
    <span class="input-group-text">%</span>
    </div>
    </td>';

    // Dry Weight, Cost Per Kilo, Total Cost, and Amount Paid with comma separator
    $output .= '<td>
    <div class="input-group">
    <input type="text" class="form-control small-font-input dry_weight" name="dry_weight[]" readonly value="' . number_format($row['dry_weight'], 2) . '">
    <span class="input-group-text">kg</span>
    </div>
    </td>';
    $output .= '<td><input type="text" class="form-control small-font-input cost_per_kilo" name="cost_per_kilo[]" readonly value="' . number_format($row['cost_per_kilo'], 2) . '"></td>';
    $output .= '<td><input type="text" class="form-control small-font-input total_cost" name="total_cost[]" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' . number_format($row['total_cost'], 2) . '"></td>';
    $output .= '<td><input type="text" class="form-control small-font-input amount_paid" name="amount_paid[]" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="' . number_format($row['amount_paid'], 2) . '"></td>';

    // Remarks
    $output .= '<td><input type="text" class="form-control small-font-input remarks" name="inv_remarks[]" value="' . $row['inv_remarks'] . '"></td>';

    // Delete button
    $output .= '<td><button class="btn btn-sm btn-danger removeRow"><i class="fas fa-trash"></i></button></td>';

    $output .= "</tr>";
}


$output .= '
    </tbody>
</table>

<div class="row">
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Buying
        Weight</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control small-font-input" name="total_cuplump_weight" id="total-cuplump-weight" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
        <span class="input-group-text">kg</span>
        </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Selling
        Weight</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control small-font-input total_selling_weight" name="total_selling_weight" id="total_selling_weight" tabindex="7" autocomplete="off" style="width: 100px;"  />
        <span class="input-group-text">kg</span>
        </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control small-font-input" name="total_cuplump_cost" id="total-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Average Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control small-font-input" name="average_cuplump_cost" id="average-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
</div>


';

echo $output;
?>


<script>
    $(document).ready(function () {

      
        // Function to sanitize and validate input
        function sanitizeInput(value) {
            return parseFloat(value.replace(/,/g, '') || 0);
        }

        // Function to calculate Dry Weight
        function calculateDryWeight(buyingWeight, drc) {
            return buyingWeight * (drc / 100);
        }

        // Function to calculate Cost Per Kilo
        function calculateCostPerKilo(totalCost, buyingWeight) {
            return buyingWeight > 0 ? totalCost / buyingWeight : 0;
        }

        // Function to calculate totals and averages
        function calculateTotalsAndAverages() {
            var totalBuyingWeight = 0, totalSellingWeight = 0, totalCost = 0;

            // Loop through each row of the table to sum up the weights and costs
            $('#cuplump_container tbody tr').each(function () {
                var weight = sanitizeInput($(this).find('.weight').val());
                var sellingWeight = sanitizeInput($(this).find('.dry_weight').val());
                var cost = sanitizeInput($(this).find('.total_cost').val());

                if (!isNaN(sellingWeight) && sellingWeight > 0) {
                    totalSellingWeight += sellingWeight;
                }

                if (!isNaN(weight) && weight > 0) {
                    totalBuyingWeight += weight;
                }

                if (!isNaN(cost) && cost > 0) {
                    totalCost += cost;
                }
            });

            // Calculate the average cost (using totalBuyingWeight)
            var averageCost = totalBuyingWeight > 0 ? totalCost / totalBuyingWeight : 0;

            // Update the total and average fields
            $('#total-cuplump-weight').val(totalBuyingWeight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#total_selling_weight').val(totalSellingWeight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#total-cuplump-cost').val(totalCost.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            $('#average-cuplump-cost').val(averageCost.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }

        // Event handler for input changes
        $(document).on('input', '.weight, .drcInput, .total_cost', function () {
            var row = $(this).closest('tr');
            var buyingWeight = sanitizeInput(row.find('.weight').val());
            var drc = sanitizeInput(row.find('.drcInput').val());
            var totalCost = sanitizeInput(row.find('.total_cost').val());

            if (!isNaN(buyingWeight) && !isNaN(drc)) {
                var dryWeight = calculateDryWeight(buyingWeight, drc);
                row.find('.dry_weight').val(dryWeight.toFixed(2));
            }

            if (!isNaN(totalCost) && !isNaN(buyingWeight)) {
                var costPerKilo = calculateCostPerKilo(totalCost, buyingWeight);
                row.find('.cost_per_kilo').val(costPerKilo.toFixed(2));
            }

            calculateTotalsAndAverages();
        });



        var counter = 0;

        $("#addRow").on("click", function () {
            var newRow = $('<tr>' +
                '<td hidden><input type="text" class="form-control small-font-input" name="inventory_id[]" readonly value=""></td>' +
                '<td><input type="text" class="form-control small-font-input" name="supplier[]"></td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control small-font-input weight" name="buying_weight[]">' +
                '<span class="input-group-text">kg</span>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control small-font-input drcInput" name="drc[]">' +
                '<span class="input-group-text">%</span>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control small-font-input dry_weight" name="dry_weight[]" readonly value="">' +
                '<span class="input-group-text">kg</span>' +
                '</div>' +
                '</td>' +
                '<td><input type="text" class="form-control small-font-input cost_per_kilo" name="cost_per_kilo[]" readonly value=""></td>' +
                '<td><input type="text" class="form-control small-font-input total_cost" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="total_cost[]"></td>' +
                '<td><input type="text" class="form-control small-font-input amount_paid" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="amount_paid[]"></td>' +
                '<td><input type="text" class="form-control small-font-input remarks" name="inv_remarks[]"></td>' +
                '<td><button class="btn btn-sm btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');

            $("#cuplump_container tbody").append(newRow);
        });


        // Event handler for removing a row
        $(document).on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
            calculateTotalsAndAverages();
        });
  // Initial calculation on page load
  calculateTotalsAndAverages();

    });


</script>