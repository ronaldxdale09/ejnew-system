<style>
    #rubber-table th,
    #rubber-table td {
        font-weight: normal;
    }
</style>

<?php
include('../function/db.php');

$container_id = $_POST['container_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM sales_cuplump_inventory WHERE sales_cuplump_id = '$container_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '
<table class="table"  id="rubber-table" >
    <thead style="font-weight: normal;">
        <tr style="font-weight: normal;">
            <th scope="col" width="15%">Supplier</th>
            <th scope="col" >Loading Weight</th>
            <th scope="col"width="12%"> Type</th>
            <th scope="col">Wet Cost</th>
            <th scope="col">Dry Cost</th>
            <th scope="col">DRC</th>
            <th scope="col">Cuplump Cost</th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    $output .= '<td><input type="text"  readonly class="form-control " name="supplier[]" readonly value="' . $row['supplier'] . '"></td>';
    $output .= '<td><input type="text"  readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"class="form-control weight"   value="' . number_format($row['loading_weight'],2) . '"></td>';
    $output .= '<td><select class="form-control kilo_bale" name="cost_type[]" readonly>';
    $costType = ['WET', 'DRY'];
    foreach ($costType as $type) {
        if ($type == $row['cost_type']) {
            $output .= '<option value="' . $type . '">' . $type . '</option>';
        } else {
            $output .= '<option value="' . $type . '">' . $type . '</option>';
        }
    }
    $output .= '</select></td>';

    $output .= '<td><input type="text" readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control wetInput" readonly value="' . $row['wet_cost'] . '"></td>';
    $output .= '<td><input type="text"  readonly onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control dryInput" value="' . $row['dry_cost'] . '"></td>';
    $output .= '<td>
            <div class="input-group">
                <input type="text" readonly  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control drcInput"  value="' . $row['drc'] . '">
                <span class="input-group-text">%</span>
            </div>
        </td>';
    $output .= '<td><input type="text" readonly class="form-control cuplump_cost"  value="' . number_format($row['cuplump_cost'],2). '"></td>';

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
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control" id="total-cuplump-weight" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control"  id="total-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Average Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control"  id="average-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
</div>


';

echo $output;
?>


<script>
    $(document).ready(function() {
        computeTotalsAndAverage();


        function computeTotalsAndAverage() {
            var totalWeight = 0;
            var totalCost = 0;
            var averageCost = 0;
            var rowCount = 0;

            $("#rubber-table tbody tr").each(function() {
                var weight = parseFloat($(this).find('.weight').val().replace(/,/g, '')) || 0;
                var cost = parseFloat($(this).find('.cuplump_cost').val().replace(/,/g, '')) || 0;

                totalWeight += weight;
                totalCost += cost;
                rowCount++;
            });

            // Compute average cost if possible
            if (rowCount > 0) {
                averageCost = totalCost / totalWeight;
            }

            // Update the total and average fields
            // Update the total and average fields
            $('#total-cuplump-weight').val(totalWeight.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#total-cuplump-cost').val(totalCost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#average-cuplump-cost').val(averageCost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));

        }




    });
</script>