<?php
include('../../function/db.php');
$output = '';
$sales_id = isset($_POST['sales_id']) ? mysqli_real_escape_string($con, $_POST['sales_id']) : '';

$result = mysqli_query($con, "SELECT * FROM sales_cuplump_selected_container
LEFT JOIN sales_cuplump_container ON sales_cuplump_container.container_id =  sales_cuplump_selected_container.container_id
WHERE cuplump_sales_id = '$sales_id'");
$total_cuplump_weight = 0;
$total_cuplump_selling_weight = 0;
$total_cuplump_cost = 0;
$total_ship_exp = 0;
$number_container = 0;

$output .= '<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
    <thead class="table-dark" style="font-size: 12px !important" >
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Van No.</th>
            <th scope="col">Location</th>
            <th scope="col">Loading Date</th>
            <th scope="col">Cuplump Weight</th>
            <th scope="col" width="15%">Sale Weight</th>
            <th scope="col">Cuplump Cost</th>
            <th scope="col">Ship Expense</th>
            <th scope="col">Ave. Cost</th>
            <th scope="col" hidden>Recorded</th>
            <th ></th>
        </tr>
    </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_cuplump_weight += $row['total_weight'];
        $total_cuplump_selling_weight += $row['cuplump_selling_weight'];
        $total_cuplump_cost += $row["total_cuplump_cost"];
        $total_ship_exp += $row["ship_expense"];
        $number_container++;
        $output .= '
        <tr>
            <td class="nowrap">' . $row["container_id"] . '</td>
            <td class="nowrap">' . $row["van_no"] . '</td>
            <td class="nowrap">' . $row["location"] . '</td>
            <td class="nowrap">' . date("M. j, Y", strtotime($row["loading_date"])) . '</td>
            <td class="nowrap number-cell">' . number_format($row["total_weight"], 0, ".", ",") . ' kg</td>
            <td class="nowrap number-cell">
                <div class="input-group mb-3">
                  <input type="text" class="form-control selling-weight" value="' . number_format($row["cuplump_selling_weight"]) . '"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"/>
                <span class="input-group-text">kg</span>
                </div>
           
                </td>
            <td class="nowrap number-cell">₱ ' . number_format($row["total_cuplump_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell">₱ ' . number_format($row["ship_expense"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell">₱ ' . number_format($row["ave_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap" hidden>' . $row["recorded_by"] . '</td>
            <td><button type="button" id="removeContainer" class="btn btn-danger btn-sm removeContainer"><i class="fa fa-trash"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr><td colspan="10">No data available</td></tr>';
}

$overall_cost = $total_cuplump_cost + $total_ship_exp;
$overall_ave_cost = $total_cuplump_selling_weight > 0 ? $overall_cost / $total_cuplump_selling_weight : 0;

$output .= '</table>';
echo $output;
?>

<script>
    $(document).ready(function () {

        function calculateTotalSaleWeightAndUpdateCost() {
            let totalSaleWeight = 0;
            let totalCuplumpCost = parseFloat($('#total_cuplump_cost').val().replace(/,/g, '')) || 0;
            let overallCost = totalCuplumpCost + parseFloat($('#total_ship_exp').val().replace(/,/g, '')) || 0;

            // Loop through each selling weight input and add its value to the total
            $('.selling-weight').each(function () {
                let weightStr = $(this).val().replace(/,/g, '');
                let weight = parseFloat(weightStr) || 0;
                totalSaleWeight += weight;
            });

            // Update the total sale weight input field
            $('#total_selling_weight').val(totalSaleWeight.toFixed(2));

            // Calculate and update overall average cost per kilo
            let overallAverageCost = totalSaleWeight > 0 ? overallCost / totalSaleWeight : 0;
            $('#overall_ave_kiloCost').val(overallAverageCost.toFixed(2));
        }

        // Attach the calculation function to the keyup and change events of the selling weight inputs
        $(document).on('keyup change', '.selling-weight', calculateTotalSaleWeightAndUpdateCost);

        // Initial calculation on page load
        calculateTotalSaleWeightAndUpdateCost();


        // Set the values using PHP variables
        $('#number_container').val("<?php echo $number_container; ?>");
        $('#total_cuplump_weight').val("<?php echo number_format($total_cuplump_weight, 2); ?>");
        $('#total_cuplump_selling_weight').val("<?php echo number_format($total_cuplump_selling_weight, 2); ?>");
        $('#total_cuplump_cost').val("<?php echo number_format($total_cuplump_cost, 2); ?>");
        $('#total_ship_exp').val("<?php echo number_format($total_ship_exp, 2); ?>");
        $('#overall_ave_kiloCost').val("<?php echo number_format($overall_ave_cost, 2); ?>");
        $('#over_all_cost').val("<?php echo number_format($overall_cost, 2); ?>");

        $('.removeContainer').on('click', function () {
            var $tr = $(this).closest('tr');
            var containerId = $tr.find("td").first().text();

            $.ajax({
                method: "POST",
                url: "table/button/cuplump_sales_remove_container.php",
                data: {
                    container_id: containerId,
                    sales_id: "<?php echo $sales_id; ?>"
                },
                success: function (response) {
                    console.log('success');
                    console.log(response);
                    fetch_container();
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Container Removed!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });
    });
</script>