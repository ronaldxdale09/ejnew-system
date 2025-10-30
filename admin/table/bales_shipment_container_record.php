<?php
include('../../function/db.php');
$output = '';
$shipment_id = $_POST['shipment_id'];

$result  = mysqli_query($con, "SELECT * from bales_shipment_container
LEFT JOIN bales_container_record ON bales_container_record.container_id =  bales_shipment_container.container_id
Where bales_shipment_container.shipment_id = '$shipment_id'  ");
$total_bales = 0;
$total_weight = 0;
$total_bale_cost = 0;
$number_container = 0;
$output .= '
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th scope="col">Ref No.</th>
           <th scope="col">Van No.</th>
           <th scope="col"> Date</th>
           <th scope="col">Quality</th>
           <th scope="col">Kilo per Bale</th>
           <th scope="col">No. of Bales</th>
           <th scope="col">Total Weight</th>
           <th scope="col">Remarks</th>
           <th scope="col">Recorded</th>
    
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_bales +=  preg_replace("/[^0-9\.]/", "", $row['num_bales']);
        $total_bale_cost +=  preg_replace("/[^0-9\.]/", "", $row['total_bale_cost']);
        $total_weight += $row["total_weight"];
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
        <td class="nowrap">' . $row["remarks"] . '</td>
        <td class="nowrap">' . $row["recorded_by"] . '</td>
     
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">No row data</td>
 </tr>';
}

$output .= '</table>
</div>
    

    <script>
    document.getElementById("v_total_num_bales").value = "' . number_format($total_bales) . ' ";
    document.getElementById("v_total_bale_weight").value = "' . number_format($total_weight) . '";
    document.getElementById("v_total_bale_cost").value = "₱ ' . number_format($total_bale_cost,2) . '";


    document.getElementById("v_number_container").value = "' . $number_container . '";

    </script>


';

echo $output;
