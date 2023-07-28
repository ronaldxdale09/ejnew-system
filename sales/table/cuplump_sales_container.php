<?php
include "../function/db.php";
$output = '';
$sales_id = $_POST['sales_id'];

$result  = mysqli_query($con, "SELECT * from sales_cuplump_selected_container
LEFT JOIN sales_cuplump_container ON sales_cuplump_container.container_id =  sales_cuplump_selected_container.container_id
Where cuplump_sales_id = '$sales_id'  ");
$total_cuplump_weight = 0;
$total_cuplump_cost = 0;
$overall_cost =0;
$number_container = 0;
$total_ship_exp = 0;
$overall_ave_cost = 0;
$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
    <thead class="table-dark" style="font-size: 12px !important" >
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Van No.</th>
            <th scope="col">Location</th>
            <th scope="col">Loading Date</th>
            <th scope="col">Total Cuplump Weight</th>
            <th scope="col">Total Cuplump Cost</th>
            <th scope="col" >Ave. Cuplump Cost</th>
            <th scope="col" >Ship Exp.</th>
            <th scope="col">Recorded</th>
            <th ></th>
        </tr>
    </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_cuplump_weight +=  $row['total_weight'];
        $total_cuplump_cost += $row["total_cuplump_cost"];
        $total_ship_exp += $row["ship_expense"];
        $number_container++;
        $output .= '
        <tr>
            <td class="nowrap">' . $row["container_id"] . '</td>
            <td class="nowrap">' . $row["van_no"] . '</td>
            <td class="nowrap">' . $row["location"] . '</td>
            <td class="nowrap">' .  date("F j, Y", strtotime($row["loading_date"])) . '</td>
            <td class="nowrap number-cell">' . number_format($row["total_weight"], 0, ".", ",") . ' kg</td>
            <td class="nowrap number-cell">₱ ' . number_format($row["total_cuplump_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell">₱ ' . number_format($row["ave_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell">₱ ' . number_format($row["ship_expense"], 2, ".", ",") . ' </td>
            <td class="nowrap">' . $row["recorded_by"] . '</td>
            <td><button type="button" id="removeContainer" class="btn btn-danger btn-sm removeContainer"><i class="fa fa-trash"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
        <td colspan="4">No row data</td>
    </tr>';
}

if($total_cuplump_weight != 0){
    $overall_ave_cost = $total_cuplump_cost / $total_cuplump_weight;
} else {
    $overall_ave_cost = 0;
}
$overall_cost = $total_cuplump_cost + $total_ship_exp;

$output .= '</table>
';


$output .= '
<!-- End of table code here -->
<script>
document.getElementById("number_container").value = "' . $number_container . '";
document.getElementById("total_cuplump_weight").value = "' . number_format($total_cuplump_weight, 2, '.', ',') . '";

document.getElementById("overall_ave_kiloCost").value = " ' . number_format($overall_ave_cost, 2) . '";


document.getElementById("total_cuplump_cost").value = " ' . number_format($total_cuplump_cost, 2) . '";
document.getElementById("total_ship_exp").value = " ' . number_format($total_ship_exp, 2) . '";

document.getElementById("over_all_cost").value = " ' . number_format($overall_cost, 2) . '";


</script>
';



echo $output;

?>

<script>
    $(document).ready(function() {


        $('.removeContainer').on('click', function() {


            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $tr.each(function() {
                ;

                var container_id = data[0];
                var sales_id = <?php echo $sales_id ?>;

                $.ajax({
                    method: "POST",
                    url: "table/button/cuplump_sales_remove_container.php",
                    data: {
                        container_id: container_id,
                        sales_id: sales_id,


                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container();
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Container Removed!',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });


        });


    });
</script>
