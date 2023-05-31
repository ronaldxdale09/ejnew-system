<?php
include('../function/db.php');

$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM container_bales_selection 
LEFT JOIN planta_bales_production ON container_bales_selection.bales_id = planta_bales_production.bales_prod_id where container_id ='$container_id'"; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 14px !important" >
        <tr>
        <th scope="col" hidden>Date Produced</th>
        <th scope="col">Supplier</th>
        <th scope="col">Lot No.</th>
        <th scope="col">Quality</th>
        <th scope="col">No. of Bales</th>
        <th scope="col">Kilo per Bale</th>
        <th scope="col">Total Weight</th>
        <th scope="col" hidden>DRC</th>
        <th scope="col">Description</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  

        $output .= '
        <tr data-entry-weight="'.number_format($arr['weight'], 0, '.', ',').'"
        data-recording_id="'.$arr['recording_id'].'"
        data-lot_num="'.$arr['lot_num'].'"
        data-receiving_date="'.$arr['receiving_date'].'"
        data-net-weight="'.number_format($arr['produce_total_weight'], 0, '.', ',').'">
            <td>'.$arr["status"].'</td>
            <td>'.$arr["recording_id"].'</td>
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["location"].'</td>
            <td>'.$arr["lot_num"].'</td>
            <td>'.number_format($arr['weight'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['produce_total_weight'], 0, '.', ',').' kg</td>
            <td>'.($arr['drc'] ? number_format($arr['drc'], 2) : '-').' %</td>
            <td scope="col">  <button type="button" class="btn btn-warning text-dark btnSelectTrans"
            id="receiptBtn">Select</button></td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>';

echo $output;
?>