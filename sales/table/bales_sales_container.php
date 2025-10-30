<?php
include('../../function/db.php');
$output = '';
$sales_id = isset($_POST['sales_id']) ? mysqli_real_escape_string($con, $_POST['sales_id']) : '';

$result = mysqli_query($con, "SELECT * from bales_sales_container
LEFT JOIN bales_container_record ON bales_container_record.container_id =  bales_sales_container.container_id
WHERE sales_id = '$sales_id'");
$total_bales = 0;
$total_weight = 0;
$total_bale_cost = 0;
$total_production_cost = 0;
$number_container = 0;
$total_ship_exp = 0;

$output .= '<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th scope="col">ID</th>
           <th scope="col">Van No.</th>
           <th scope="col" hidden>Withdrawal Date</th>
           <th scope="col">Quality</th>
           <th scope="col">Kilo per Bale</th>
           <th scope="col">No. of Bales</th>
           <th scope="col">Total Weight</th>
           <th scope="col" >Bale Cost</th>
           <th scope="col" >Milling Cost</th>
           <th scope="col" >Total Bale Cost</th>
           <th scope="col" >Total Milling Cost</th>
           <th scope="col" >Ship Expense</th>
           <th scope="col">Remarks</th>
           <th scope="col" hidden>Recorded</th>
           <th ></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_bales += preg_replace("/[^0-9\.]/", "", $row['num_bales']);
        $total_bale_cost += floatval($row['total_bale_cost']);
        $total_weight += floatval($row["total_weight"]);
        $total_ship_exp += floatval($row["ship_expense"]);
        $total_production_cost += floatval($row["total_milling_cost"]);
        $number_container++;
        $output .= '
        <tr>
        <td class="nowrap">' . $row["container_id"] . '</td>
        <td class="nowrap">' . $row["van_no"] . '</td>
        <td hidden>' . date("F j, Y", strtotime($row["withdrawal_date"])) . '</td>
        <td class="nowrap">' . $row["quality"] . '</td>
        <td class="nowrap number-cell">' . $row["kilo_bale"] . ' kg</td>
        <td class="nowrap number-cell">' . number_format($row["num_bales"], 0, ".", ",") . ' pcs</td>
        <td class="nowrap number-cell">' . number_format($row["total_bale_weight"], 0, ".", ",") . ' kg</td>
        <td class="nowrap number-cell">≈ ₱ ' . number_format($row["average_kilo_cost"] - ($row["total_milling_cost"] / $row["total_bale_weight"]), 2, ".", ",") . '</td>
        <td class="nowrap number-cell">₱ ' . number_format($row["total_milling_cost"] / $row["total_bale_weight"], 2, ".", ",") . ' </td>
        <td class="nowrap number-cell" >₱ ' . number_format($row["total_bale_cost"], 2, ".", ",") . ' </td>
        <td class="nowrap number-cell" >₱ ' . number_format($row["total_milling_cost"], 2, ".", ",") . ' </td>
        <td class="nowrap number-cell">₱ ' . number_format($row["ship_expense"], 2, ".", ",") . ' </td>
        <td class="nowrap">' . $row["remarks"] . '</td>
        <td class="nowrap" hidden>' . $row["recorded_by"] . '</td>
        <td><button type="button" id="removeContainer" class="btn btn-danger btn-sm removeContainer"><i class="fa fa-trash"></i></button> </td>
        </tr>';
    }
} else {
    $output .= '<tr><td colspan="4">No row data</td></tr>';
}


// Calculate the overall cost and average cost per kilo
$overall_cost = $total_bale_cost  + $total_production_cost + $total_ship_exp;
$overall_ave_kilo_cost = $total_weight > 0 ? $overall_cost / $total_weight : 0;

$output .= '</table>';
echo $output;
?>

<script>
    $(document).ready(function () {
        // Use PHP variables directly
        $('#total_num_bales').val("<?php echo number_format($total_bales); ?>");
        $('#total_bale_weight').val("<?php echo number_format($total_weight, 2); ?>");
        $('#total_bale_cost').val("<?php echo number_format($total_bale_cost, 2); ?>");
        $('#total_ship_exp').val("<?php echo number_format($total_ship_exp, 2); ?>");
        $('#total_production_cost').val("<?php echo number_format($total_production_cost, 2); ?>");
        $('#number_container').val("<?php echo $number_container; ?>");

        // Use the computed overall cost and average kilo cost
        $('#over_all_cost').val("<?php echo number_format($overall_cost, 2); ?>");
        $('#overall_ave_kiloCost').val("<?php echo number_format($overall_ave_kilo_cost, 2); ?>");

        $('.removeContainer').on('click', function () {
            var $tr = $(this).closest('tr');
            var containerId = $tr.find("td").first().text();

            $.ajax({
                method: "POST",
                url: "table/button/bales_sales_remove_container.php",
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
