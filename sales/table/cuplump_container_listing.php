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
$query = "SELECT * FROM cuplump_container_inv 
LEFT JOIN cuplump_container ON cuplump_container_inv.container_id = cuplump_container.container_id
WHERE cuplump_container_inv.container_id = '$container_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table custom-table"  id="rubber-table" >
    <thead style="font-weight: normal !important;">
    <tr>
        <th scope="col" hidden></th>
        <th scope="col">Supplier</th>
        <th scope="col">Buying Weight</th>
        <th scope="col">Final DRC</th>
        <th scope="col">Dry/Selling Weight</th>
        <th scope="col">Cost Per Kilo (₱)</th>
        <th scope="col">Total Cost (₱)</th>
        <th scope="col">Amount Paid (₱)</th>
        <th scope="col">Ship. Exp. (₱)</th>

        <th scope="col" hidden>Remarks</th>
    </tr>

    </thead>
    <tbody   style="font-weight: normal !important;">';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    // Each column now displays data as text instead of inputs
    $output .= '<td hidden>' . $row['cuplump_inventory_id'] . '</td>';
    $output .= '<td>' . $row['supplier'] . '</td>';
    $output .= '<td>' . number_format($row['buying_weight'], 2) . ' kg</td>';
    $output .= '<td>' . number_format($row['drc'], 2) . '%</td>';
    $output .= '<td>' . number_format($row['dry_weight'], 2) . ' kg</td>';
    $output .= '<td>₱' . number_format($row['cost_per_kilo'], 2) . '</td>';
    $output .= '<td>₱' . number_format($row['total_cost'], 2) . '</td>';
    $output .= '<td>₱' . number_format($row['amount_paid'], ) . '</td>';
    $output .= '<td>₱' . number_format($row['ship_exp'], ) . '</td>';

    $output .= '<td  hidden>' . $row['inv_remarks'] . '</td>';

    $output .= "</tr>";
}

$output .= '
    </tbody>
</table>

<div class="row">
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Cuplump
        Weight</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control small-font-input" name="total_cuplump_weight" id="total-cuplump-weight" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
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

        function calculateTotalsAndAverages() {
            var totalWeight = 0;
            var totalCost = 0;
            var rowCount = 0;

            // Loop through each row of the table to sum up the weights and costs
            $('#rubber-table tbody tr').each(function () {
                var weightStr = $(this).find('td:nth-child(3)').text().replace(' kg', '').replace(/,/g, '');
                var costStr = $(this).find('td:nth-child(7)').text().replace('₱', '').replace(/,/g, '');

                var weight = parseFloat(weightStr);
                var cost = parseFloat(costStr);

                if (!isNaN(weight) && weight > 0) {
                    totalWeight += weight;
                    rowCount++;
                }

                if (!isNaN(cost) && cost > 0) {
                    totalCost += cost;
                }
            });

            // Calculate the average cost
            var averageCost = rowCount > 0 ? totalCost / totalWeight : 0;

            // Update the total and average fields with comma separators
            $('#total-cuplump-weight').val(totalWeight.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' kg');
            $('#total-cuplump-cost').val('₱' + totalCost.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            $('#average-cuplump-cost').val('₱' + averageCost.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        }

        // Initial calculation on page load
        calculateTotalsAndAverages();

    });
</script>
