<?php  
include('../function/db.php');

$recording_id = $_POST['recording_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM planta_bales_production WHERE recording_id = '$recording_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if(!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
$output = '
<table class="table table-bordered" id="rubber-table">
    <thead>
        <tr>
            <th scope="col" width="15%">Quality</th>
            <th scope="col" width="15%">Kilo Per Bale</th>
            <th scope="col">Weight (kg)</th>
            <th scope="col">No. of Bale</th>
            <th scope="col">Excess</th>
            <th scope="col" width="22%">Description (Buyer)</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

    // Fetch the data from the database and output each row
    while($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>";

        $output .= '<td><select class="form-control type" name="type[]" autocomplete="off" step="any">';
        foreach ($rubberTypes as $type) {
            if ($type == $row['bales_type']) {
                $output .= '<option selected="selected" value="'.$type.'">'.$type.'</option>';
            } else {
                $output .= '<option value="'.$type.'">'.$type.'</option>';
            }
        }
        $output .= '</select></td>';

        $output .= '<td><select class="form-control kilo_bale" name="kilo_bale[]">';
        $kiloBales = ['35', '33.33'];
        foreach ($kiloBales as $kilo) {
            if ($kilo == $row['kilo_per_bale']) {
                $output .= '<option value="'.$kilo.'">'.$kilo.' kg</option>';
            } else {
                $output .= '<option value="'.$kilo.'">'.$kilo.' kg</option>';
            }
        }
        $output .= '</select></td>';

        $output .= '<td><input type="text" class="form-control weight" name="weight[]" readonly value="'.$row['rubber_weight'].'"></td>';
        $output .= '<td><input type="text" class="form-control bale_num" name="bale_num[]" value="'.$row['number_bales'].'"></td>';
        $output .= '<td>
            <div class="input-group">
                <input type="text" class="form-control excess" name="excess[]" value="'.$row['bales_excess'].'">
                <span class="input-group-text">kg</span>
            </div>
        </td>';
        $output .= '<td><input type="text" class="form-control" name="description[]" value="'.$row['description'].'"></td>';
        $output .= '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>';

        $output .= "</tr>";
    }

$output .= '
    </tbody>
</table>
<button class="btn btn-warning" type="button" id="addRow">Add Bale Production</button>
';

echo $output;
?>
<script>
$(document).ready(function() {
    var counter = 0;
    var rubberTypes = <?php echo json_encode($rubberTypes); ?>;
    $("#addRow").on("click", function() {
        var selectOptions = rubberTypes.map(function(type) {
            return '<option value="' + type + '">' + type + '</option>';
        }).join('');

        var newRow = $('<tr>' +
                '<td>' +
                '<select class="form-control type" name="type[]" autocomplete="off" step="any" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Choose Quality </option>' +
                selectOptions + '</select>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<select class="form-control kilo_bale" name="kilo_bale[]" id="kilo_bale_new' + counter + '" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Choose Kilo</option>' +
                '<option value="35">35 kg</option>' +
                '<option value="33.33">33.33 kg</option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control weight" name="weight[]" id="weight_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control bale_num" name="bale_num[]" id="bale_num_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" disabled>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control excess" name="excess[]" id="excess_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" disabled>' +
                '<span class="input-group-text">kg</span>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="description[]" autocomplete="off" step="any">' +
                '</td>' +
                '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');
        counter++;
        $("#rubber-table tbody").append(newRow);
        $(document).on("change", ".type, .kilo_bale", function() {
            var row = $(this).closest("tr");
            var selectedType = row.find(".type").val();
            var selectedKilo = row.find(".kilo_bale").val();
            var baleNumInput = row.find(".bale_num");
            var excessInput = row.find(".excess");

            if (selectedType && selectedKilo) {
                baleNumInput.prop("disabled", false);
                excessInput.prop("disabled", false);
            } else {
                baleNumInput.prop("disabled", true);
                excessInput.prop("disabled", true);
            }
        });
        
    });

    // Remove row on click
    $(document).on("click", ".removeRow", function() {
        event.preventDefault();

        row = $(this).closest("tr");
        row.remove();

        calculateTotals();
    });
});
</script>


<script>
$(document).on("keyup", ".bale_num, .excess", function() {
    var row = $(this).closest("tr");
    var kiloBale = parseFloat(row.find(".kilo_bale").val()) || 0;
    var baleNum = parseFloat(row.find(".bale_num").val().replace(/[^0-9.]/g, '')) || 0;
    var excess = parseFloat(row.find(".excess").val().replace(/[^0-9.]/g, '')) || 0;

    // Compute and update the weight values
    var weight = (baleNum * kiloBale) + excess;
    row.find(".weight").val(weight.toFixed(2));

    // Calculate total weight and rubber_drc
    calculateTotals();
});


function calculateTotals() {
    var totalWeight = 0;
    var entry_weight = parseFloat($("#press_u_entry").val().replace(/[^0-9.]/g, '')) || 0;

    $(".weight").each(function() {
        totalWeight += parseFloat($(this).val().replace(/[^0-9.]/g, '')) || 0;
    });

    var rubber_drc = (totalWeight / entry_weight) * 100;

    // Update the corresponding fields with the calculated values
    $("#press_u_total_weight").val(totalWeight.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));

    $("#press_u_drc").val(rubber_drc.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
}
</script>