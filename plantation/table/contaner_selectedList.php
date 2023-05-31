<?php
include('../function/db.php');

$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM container_bales_selection 
LEFT JOIN planta_bales_production ON container_bales_selection.bales_id = planta_bales_production.bales_prod_id
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
 where container_id ='$container_id'"; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 12px !important" >
        <tr>
        <th scope="col">Supplier</th>
        <th scope="col">Location</th>
        <th scope="col">Lot No.</th>
        <th scope="col">Quality</th>
        <th scope="col">Kilo per Bale</th>
        <th scope="col">Remaining Bales</th>
        <th scope="col">Withdrawal Bales</th>
        <th scope="col"> Weight</th>
        <th scope="col"></th>

        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  
        $remaining= $arr["number_bales"] - $arr["num_bales"];
        $weight= $arr["num_bales"] * $arr["kilo_per_bale"];
        $output .= '
        <tr style="font-weight:bold" data-bales_id="'.$arr['bales_id'].'"> 
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["location"].'</td>
            <td>'.$arr["recording_id"].'</td>
            <td>'.$arr["bales_type"].'</td>
            <td>'.$arr["kilo_per_bale"].' kg</td>
            <td>'.$remaining.'</td>
            <td>'.$arr["num_bales"].'</td>
            <td>'.number_format( $weight, 0, '.', ',').' kg</td>
            <td >  <button type="button" class="btn btn-sm btn-warning text-dark removeBtn " >REMOVE</button></td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table> 


';

// $total_bales = 0;
// $total_weight = 0;

// // Run another query to compute the total number of bales and total weight
// $total_sql = "SELECT SUM(num_bales) as total_bales, SUM(num_bales * kilo_per_bale) as total_weight FROM container_bales_selection 
// LEFT JOIN planta_bales_production ON container_bales_selection.bales_id = planta_bales_production.bales_prod_id
// where container_id ='$container_id'";

// $total_result = mysqli_query($con, $total_sql);

// if(mysqli_num_rows($total_result) > 0) {  
//     $total_arr = mysqli_fetch_assoc($total_result);
//     $total_bales = $total_arr["total_bales"];
//     $total_weight = $total_arr["total_weight"];
// }

// $response = array(
//     'output' => $output,
//     'total_bales' => $total_bales,
//     'total_weight' => $total_weight,
// );

echo $output;
?>
