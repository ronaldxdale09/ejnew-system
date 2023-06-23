<?php
include "../function/db.php";
$output = '';
$sales_id = $_POST['sales_id'];

$result  = mysqli_query($con, "SELECT * from bales_sales_container
LEFT JOIN bales_container_record ON bales_container_record.container_id =  bales_sales_container.container_id
Where sales_id = '$sales_id'  ");
$total_bales = 0;
$total_weight = 0;
$total_bale_cost = 0;
$number_container = 0;
$total_ship_exp = 0;
$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th scope="col">Ref No.</th>
           <th scope="col">Van No.</th>
           <th scope="col">Withdrawal Date</th>
           <th scope="col">Quality</th>
           <th scope="col">Kilo per Bale</th>
           <th scope="col">No. of Bales</th>
           <th scope="col">Total Weight</th>
           <th scope="col" >Bale Cost</th>
           <th scope="col" >Milling Cost</th>
           <th scope="col" >Ship Exp.</th>
           <th scope="col">Remarks</th>
           <th scope="col">Recorded</th>
    
           <th ></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_bales +=  preg_replace("/[^0-9\.]/", "", $row['num_bales']);
        $total_bale_cost +=  preg_replace("/[^0-9\.]/", "", $row['total_bale_cost']);
        $total_weight += $row["total_weight"];
        $total_ship_exp += $row["ship_expense"];
       
        $number_container++;
        $output .= '
        <tr>
        <td class="nowrap">' . $row["container_id"] . '</td>
        <td class="nowrap">' . $row["van_no"] . '</td>
        <td>' .  date("F j, Y", strtotime($row["withdrawal_date"])). '</td>
        <td class="nowrap">' . $row["quality"] . '</td>
        <td class="nowrap number-cell">' . $row["kilo_bale"] . ' kg</td>
        <td class="nowrap number-cell">' . number_format($row["num_bales"], 0, ".", ",") . ' pcs</td>
        <td class="nowrap number-cell">' . number_format($row["total_bale_weight"], 0, ".", ",") . ' kg</td>
        <td class="nowrap number-cell">≈ ₱ ' . number_format($row["average_kilo_cost"]-($row["total_milling_cost"]/$row["total_bale_weight"]), 2, ".", ",") . '</td>
        <td class="nowrap number-cell">₱ ' .number_format($row["total_milling_cost"]/$row["total_bale_weight"], 2, ".", ","). ' </td>
        <td class="nowrap number-cell">₱ ' . number_format($row["ship_expense"], 2, ".", ",") . ' </td>
        <td class="nowrap">' . $row["remarks"] . '</td>
        <td class="nowrap">' . $row["recorded_by"] . '</td>
            <td><button type="button" id="removeContainer" class="btn btn-danger btn-sm removeContainer"><i
            class="fa fa-trash"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">No row data</td>
 </tr>';
}
$ave_cost = ($total_bale_cost + $total_ship_exp) / $total_weight;
$output .= '</table>
<hr>
    

    <script>
    document.getElementById("total_num_bales").value = "' . number_format($total_bales) . ' ";
    document.getElementById("total_bale_weight").value = "' . number_format($total_weight) . ' ";
    document.getElementById("total_bale_cost").value = " ' . number_format($total_bale_cost,2) . '";
    document.getElementById("total_ship_exp").value = " ' . number_format($total_ship_exp,2) . '";
    document.getElementById("overall_ave_kiloCost").value = " ' . number_format($ave_cost,2) . '";

    document.getElementById("number_container").value = "' . $number_container . '";

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
                    url: "table/button/bales_sales_remove_container.php",
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