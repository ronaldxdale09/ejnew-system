<?php  
include('../../function/db.php');

$recording_id = $_POST['recording_id'];
 

$sql  = "SELECT * from planta_bales_production
WHERE recording_id='$recording_id' "; 
$output='';


$result = mysqli_query($con, $sql);  
$output = '
<table class="table table-bordered" id="rubber-record">
    <thead  class="table-success" style="font-size:13px">
        <tr>
        <th scope="col" width="8%">Bale ID</th>
            <th scope="col" width="22%">Quality</th>
            <th scope="col" width="20%">Kilo Per Bale</th>
            <th scope="col">Weight (kg)</th>
            <th scope="col">No. of Bale</th>
            <th scope="col">Excess</th>
            <th scope="col">Description (Buyer)</th>
        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_array($result)) {  
        $kilo_per_bale = $arr["kilo_per_bale"] == "0" ? "-" : $arr["kilo_per_bale"];
        $weight = $arr["rubber_weight"] == "0" ? "-" : $arr["rubber_weight"];
        $num_bales = $arr["number_bales"] == "0" ? "-" : $arr["number_bales"];
        $excess = $arr["bales_excess"] == "0" ? "-" : $arr["bales_excess"];

        $output .= '
        <tr>
        <td>
                <input type="text" class="form-control"  autocomplete="off" step="any"
                value="'.$arr["bales_prod_id"].'" style="border:none;" readonly>
            </td>
            <td>
                <input type="text" class="form-control"  autocomplete="off" step="any"
                value="'.$arr["bales_type"].'" style="border:none;" readonly>
            </td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" value="'.$kilo_per_bale.'" readonly>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" value="'.$weight.'"
                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" value="'.$num_bales.'"
                        onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" value="'.$excess.'"
                        onkeypress="return CheckNumeric()" readonly onkeyup="FormatCurrency(this)">
                    <span class="input-group-text">kg</span>
                </div>
            </td>
            <td>
            <input type="text" class="form-control"  autocomplete="off" step="any"
            value="'.$arr["description"].'" style="border:none;" readonly>
        </td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>';

echo $output;
?>



