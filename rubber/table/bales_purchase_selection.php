<?php
include('../../function/db.php');

$purchase_id = $_POST['purchase_id'];
$sql  = "SELECT * FROM bales_purchase_inventory where purchase_id='$purchase_id' "; 

$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}
$total_bales_count =0;
$total_excess =0;
$output = '
<div class="row no-gutters">
    <div class="col-4">
        
    </div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Bales</label>
        <div class="input-group">

            <input type="text" style="text-align:right"
                name="bales_count" id="bales_count"
                class="form-control" readonly>
            <div class="input-group-append">
                <span class="input-group-text">pcs</span>
            </div>
        </div>
    </div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Excess</label>
        <div class="input-group">

            <input type="text" style="text-align:right"
                name="excess" id="excess"
                class="form-control" readonly>
            <div class="input-group-append">
                <span class="input-group-text"> kg</span>
            </div>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-weight:bold;" >
            <tr> <b>
            <th scope="col">ID</th>
            <th scope="col">Quality</th>
            <th scope="col">Kilo per Bale</th>
            <th scope="col">Bale Quantity</th>
            <th scope="col">Weight.</th>
            <th scope="col">Excess</th>
          
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  
        $total_bales_count += $arr['number_bales'];
        $total_excess += $arr['excess'];
        $output .= '
        <tr>
            <td>'.$arr["bales_id"].'</td>
            <td>'.$arr["type"].'</td>
            <td>'.number_format($arr['kilo_bale'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['number_bales'], 0, '.', ',').' pcs</td>
            <td>'.number_format($arr['weight'], 0, '.', ',').' kg</td>
            <td>'.number_format($arr['excess'], 0, '.', ',').' kg</td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>

<script>
    document.getElementById("bales_count").value = ' . $total_bales_count . ';
    document.getElementById("excess").value = ' . $total_excess . ';
</script>
';

echo $output;
?>
