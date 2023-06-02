<?php
include('../function/db.php');

$purchase_id = $_POST['purchase_id'];
$sql  = "SELECT * FROM bales_purchase_inventory "; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

$output = '
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-weight:bold;" >
            <tr> <b>
            <th scope="col">ID</th>
            <th scope="col">Quality</th>
            <th scope="col">Kilo per Bale</th>
            <th scope="col">Weight.</th>
            <th scope="col">Excess</th>
          
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  

        $output .= '
        <tr>
            <td>'.$arr["bales_id"].'</td>
            <td>'.$arr["type"].'</td>
            <td>'.number_format($arr['kilo_bale'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['weight'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['excess'], 0, '.', ',').' kg</td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>';

echo $output;
?>
