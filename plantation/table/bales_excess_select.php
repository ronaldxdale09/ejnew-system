<?php
include('../../function/db.php');




$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
$output = '
<table class="table table-bordered" id="rubber-table">
    <thead style="font-size:13px">
        <tr>
        <th scope="col" hidden></th>
            <th scope="col" width="15%">Quality</th>
            <th scope="col" width="15%">Kilo Per Bale</th>
            <th scope="col">Weight (kg)</th>
            <th scope="col">No. of Bale</th>
            <th scope="col" width="22%">Description</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';



$output .= '
    </tbody>
</table>
<button class="btn btn-warning" type="button" id="addRow">Add Bale Production</button>
<div id="totalBales" style="display:inline-block; float:right;font-weight:bold">Total Bales: 0 pcs</div>
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
                '<td hidden ><input type="text"  class="form-control bales_id" name="bales_id[]" " ></td>' +
                '<td>' +
                '<select class="form-control type" name="type[]" autocomplete="off" step="any" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Choose Quality </option>' +
                selectOptions + '</select>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<select class="form-control kilo_bale" name="kilo_bale[]"  id="kilo_bale_new' + counter + '" style="font-weight:normal;">' +
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

                if (selectedType && selectedKilo) {
                    baleNumInput.prop("disabled", false);
                } else {
                    baleNumInput.prop("disabled", true);
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
    $(document).on("keyup", ".bale_num", function() {
        var row = $(this).closest("tr");
        var kiloBale = parseFloat(row.find(".kilo_bale").val()) || 0;
        var baleNum = parseFloat(row.find(".bale_num").val().replace(/[^0-9.]/g, '')) || 0;

        // Compute and update the weight values
        var weight = (baleNum * kiloBale);
        row.find(".weight").val(weight.toFixed(2));

        // Calculate total weight and rubber_drc
        calculateTotals();
    });

    // Country dependent ajax
    $(".kilo_bale").on("change", function() {
        var row = $(this).closest("tr");
        var kiloBale = parseFloat(row.find(".kilo_bale").val()) || 0;
        var baleNum = parseFloat(row.find(".bale_num").val().replace(/[^0-9.]/g, '')) || 0;

        // Compute and update the weight values
        var weight = (baleNum * kiloBale);
        row.find(".weight").val(weight.toFixed(2));

        // Calculate total weight and rubber_drc
        calculateTotals();
    });

    $(document).on("keyup", "#excess_unit_cost", function() {
        calculateTotals();
    });


    function calculateTotals() {
        var totalWeight = 0;

        $(".weight").each(function() {
            totalWeight += parseFloat($(this).val().replace(/[^0-9.]/g, '')) || 0;
        });

        // Update the corresponding fields with the calculated values
        $("#total_weight").val(totalWeight.toLocaleString("en-US"));



        var unitCost = parseFloat($("#excess_unit_cost").val().replace(/[^0-9.]/g, '')) || 0;
        var totalWeight = parseFloat($("#total_weight").val().replace(/[^0-9.]/g, '')) || 0;

        // Compute total cost
        var totalCost = (unitCost * totalWeight);

        // Update the total cost field
        $("#excess_total_cost").val(totalCost.toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));


        var totalBales = 0;

        $(".bale_num").each(function() {
            var baleNum = Number($(this).val());
            if (!isNaN(baleNum)) {
                totalBales += baleNum;
            }
        });

        $("#totalBales").text("Total Bales: " + totalBales);

    }
</script>