<style>
    #rubber-table th,
    #rubber-table td,
    #rubber-table input,
    #rubber-table select {
        font-weight: normal !important;
    }
</style>

<?php
include('../function/db.php');

$container_id = $_POST['container_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM sales_cuplump_container_inv WHERE sales_cuplump_id = '$container_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<button type="button" id="addRow" class="btn btn-success">+ Add Inventory</button>
<table class="table"  id="rubber-table" >
    <thead style="font-weight: normal !important;">
        <tr style="font-weight: normal;">
            <th scope="col" width="15%">Supplier</th>
            <th scope="col">Location</th>
            <th scope="col" >Loading Weight</th>
            <th scope="col"width="8%"> Type</th>
            <th scope="col">Wet Cost (₱)</th>
            <th scope="col">Dry Cost (₱)</th>
            <th scope="col">DRC</th>
            <th scope="col">Total Cost (₱)</th>
            <th scope="col">Amount Paid (₱)</th>
        </tr>
    </thead>
    <tbody   style="font-weight: normal !important;">';

// Fetch the data from the database and output each row
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    $output .= '<td><input type="text" class="form-control " name="supplier[]" readonly value="' . $row['supplier'] . '"></td>';
    $output .= '<td><input type="text" class="form-control " name="location[]" readonly value="' . $row['location'] . '"></td>';
    $output .= '<td>
    <div class="input-group">
    <input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"class="form-control weight" name="loading_weight[]"  value="' . $row['loading_weight'] . '">
    <span class="input-group-text">kg</span>
    </div>
    </td>';
    $output .= '<td><select class="form-control kilo_bale" name="cost_type[]">';
    $costType = ['WET', 'DRY'];
    foreach ($costType as $type) {
        if ($type == $row['cost_type']) {
            $output .= '<option value="' . $type . '">' . $type . '</option>';
        } else {
            $output .= '<option value="' . $type . '">' . $type . '</option>';
        }
    }
    $output .= '</select></td>';

    $output .= '<td><input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control wetInput" name="wet_cost[]" readonly value="' . $row['wet_cost'] . '"></td>';
    $output .= '<td><input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control dryInput" name="dry_cost[]" value="' . $row['dry_cost'] . '"></td>';
    $output .= '<td>
            <div class="input-group">
                <input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control drcInput" name="drc[]" value="' . $row['drc'] . '">
                <span class="input-group-text">%</span>
            </div>
        </td>';
    $output .= '<td><input type="text" class="form-control cuplump_cost" name="cuplump_cost[]" value="' . $row['cuplump_cost'] . '"></td>';
    $output .= '<td><input type="text" class="form-control amount_paid" name="amount_paid[]" value="' . $row['amount_paid'] . '"></td>';
    $output .= '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>';

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
        <input type="text" class="form-control" name="total_cuplump_weight" id="total-cuplump-weight" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
        <span class="input-group-text">kg</span>
        </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Total Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control" name="total_cuplump_cost" id="total-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
<div class="col">
    <label style="font-size:15px" class="col-md-12">Average Cuplump
        Cost</label>
    <div class="input-group mb-3">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control" name="average_cuplump_cost" id="average-cuplump-cost" tabindex="7" autocomplete="off" style="width: 100px;" readonly />
    </div>
</div>
</div>


';

echo $output;
?>


<script>
    $(document).ready(function() {
        computeTotalsAndAverage();
        var counter = 0;

        $("#addRow").on("click", function() {
            var newRow = $('<tr>' +
                '<td><input type="text" class="form-control " name="supplier[]" ></td>' +
                '<td><input type="text" class="form-control " name="location[]" ></td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"  class="form-control weight" name="loading_weight[]" >' +
                '<span class="input-group-text">kg</span>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<select class="form-control type" name="cost_type[]">' +
                '<option selected="selected" disabled value="">Select...</option>' +
                '<option value="WET">WET</option>' +
                '<option value="DRY">DRY</option>' +
                '</select>' +
                '</td>' +
                '<td><input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control wetInput" name="wet_cost[]" ></td>' +
                '<td><input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control dryInput" name="dry_cost[]"></td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control drcInput" name="drc[]">' +
                '<span class="input-group-text">%</span>' +
                '</div>' +
                '</td>' +
                '<td><input type="text" class="form-control cuplump_cost" name="cuplump_cost[]" readonly></td>' +
                '<td><input type="text" class="form-control amount_paid"   onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"  name="amount_paid[]" ></td>' +
                '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');
            counter++;
            computeTotalsAndAverage();
            $("#rubber-table tbody").append(newRow);
        });

        $(document).on("change", ".type", function() {
            var row = $(this).closest("tr");
            var selectedType = row.find(".type").val();
            var dryInput = row.find(".dryInput").val("");
            var wetInput = row.find(".wetInput").val("");
            var drcInput = row.find(".drcInput").val("");


            if (selectedType == 'DRY') {
                wetInput.prop("readonly", true);
                wetInput.val(''); // Clear the value
                dryInput.prop("readonly", false);
                drcInput.prop("readonly", false);
            } else {
                wetInput.prop("readonly", false);
                dryInput.prop("readonly", true);
                dryInput.val(''); // Clear the value
                drcInput.prop("readonly", true);
                drcInput.val(''); // Clear the value
            }
        });

        $(document).on("keyup", ".wetInput, .dryInput, .drcInput, .weight", function() {
            calculateCuplumpCost($(this));
        });
        $(document).on('keyup', ".wetInput, .dryInput, .drcInput, .weight", function() {
            computeTotalsAndAverage();
        });

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
            $('#total-cuplump-weight').val(totalWeight.toLocaleString('en-US'));
            $('#total-cuplump-cost').val(totalCost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#average-cuplump-cost').val(averageCost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));

        }



        // Remove row on click
        $(document).on("click", ".removeRow", function() {
            event.preventDefault();

            var row = $(this).closest("tr");
            row.remove();
            computeTotalsAndAverage();
        });
    });

    function calculateCuplumpCost(inputField) {
        var row = inputField.closest("tr");
        var type = row.find(".type").val();
        var weight = parseFloat(row.find('.weight').val().replace(/,/g, '')) || 0;
        var wetCost = parseFloat(row.find('.wetInput').val().replace(/,/g, '')) || 0;
        var dryCost = parseFloat(row.find('.dryInput').val().replace(/,/g, '')) || 0;
        var drc = parseFloat(row.find('.drcInput').val().replace(/,/g, '')) || 0;
        var cuplumpCostInput = row.find('.cuplump_cost');

        console.log(wetCost)
        console.log(dryCost)
        console.log(drc)
        if (type == 'WET') {
            let cost = weight * wetCost;
            cuplumpCostInput.val(cost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            console.log(weight * wetCost)


        } else if (type == 'DRY') {
            let cost = (weight * dryCost) * (drc / 100);
            cuplumpCostInput.val(cost.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            console.log(weight * dryCost) * (drc / 100);
        }
    }
</script>