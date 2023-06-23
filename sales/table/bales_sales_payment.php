<style>
    #rubber-table th,
    #rubber-table td {
        font-weight: normal;
    }
</style>

<?php
include('../function/db.php');

$sales_id = $_POST['sales_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM bales_sales_payment WHERE sales_id = '$sales_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}


$output = '

<table class="table"  id="rubber-table" >
    <thead style="font-weight: normal;">
        <tr style="font-weight: normal;">
            <th scope="col" width="15%">Date of Payment </th>
            <th scope="col" >Details</th>
            <th scope="col"> Amount Paid</th>
            <th scope="col">Rate</th>
            <th scope="col">Peso Equivalent</th>
        </tr>
    </thead>
    <tbody>';

// Fetch the data from the database and output each row
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";

    $output .= '<td><input type="text" class="form-control " name="supplier[]" readonly value="' . $row['supplier'] . '"></td>';
    $output .= '<td><input type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"class="form-control weight" name="loading_weight[]"  value="' . $row['loading_weight'] . '"></td>';
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
    $output .= '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>';

    $output .= "</tr>";
}

$output .= '
    </tbody>
</table>
<br>


';

echo $output;
?>


<script>
    $(document).ready(function() {
        computeTotalsAndAverage();
        var counter = 0;

        $("#addRow").on("click", function() {
            var newRow = $('<tr>' +
                '<td><input type="date" class="form-control " name="pay_date[]" ></td>' +
                '<td><input type="text"  class="form-control weight" name="pay_details[]" ></td>' +
                '<td><input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control payAmount" name="pay_amount[]" ></td>' +
                '<td><input type="text"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control payRate" name="pay_rate[]"></td>' +
                '<td><input type="text" class="form-control cuplump_cost" name="peso_equivalent[]" readonly></td>' +
                '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');
            counter++;
            computeTotalsAndAverage();
            $("#rubber-table tbody").append(newRow);
        });



        $(document).on("keyup", ".wetInput, .dryInput, .drcInput, .weight", function() {
            calculateCuplumpCost($(this));
        });
        $(document).on('keyup', ".wetInput, .dryInput, .drcInput, .weight", function() {
            computeTotalsAndAverage();
        });


        // Remove row on click
        $(document).on("click", ".removeRow", function() {
            event.preventDefault();

            var row = $(this).closest("tr");
            row.remove();

        });
    });

</script>