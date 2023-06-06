<?php
include('../function/db.php');

$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM container_bales_selection 
LEFT JOIN planta_bales_production ON container_bales_selection.bales_id = planta_bales_production.bales_prod_id
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
 where container_id ='$container_id'"; 

$total_bales_count = 0;
$total_weight=0;
$result = mysqli_query($con, $sql);  
if (!$result) {
    die('Error in query: ' . mysqli_error($con));
}

    $output = '
    <div class="row">
        <div class="col">
            <label style="font-size:15px" class="col-md-12">No. of Bales</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="num_bales"
                    id="num_bales" autocomplete="off" style="width: 100px;"
                    readonly />
            </div>
        </div>
        <div class="col">
            <label style="font-size:15px" class="col-md-12">Total Bale
                Weight</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="total_bale_weight"
                    id="total_bale_weight" autocomplete="off" style="width: 100px;"
                    readonly />
            </div>
        </div>
    </div>
<br>

                                        
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 12px !important" >
        <tr>
        <th scope="col">Supplier</th>
        <th scope="col">Location</th>
        <th scope="col">Lot No.</th>
        <th scope="col">Quality</th>
        <th scope="col">Kilo per Bale</th>
        <th scope="col">Withdrawal Bales</th>
        <th scope="col"> Weight</th>
     

        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  
        $remaining= $arr["number_bales"] - $arr["num_bales"];
        $weight= $arr["num_bales"] * $arr["kilo_per_bale"];

        $total_bales_count += $arr['number_bales'];
        $total_weight += $weight;


        $output .= '
        <tr style="font-weight:bold" data-bales_id="'.$arr['bales_id'].'"> 
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["location"].'</td>
            <td>'.$arr["recording_id"].'</td>
            <td>'.$arr["bales_type"].'</td>
            <td>'.$arr["kilo_per_bale"].' kg</td>
            <td>'.$arr["num_bales"].'</td>
            <td>'.number_format( $weight, 0, '.', ',').' kg</td>
          
        </tr>';
    }
}

$output .= '
    </tbody>
</table> 

<script>
    document.getElementById("num_bales").value = "' . $total_bales_count . ' pcs";
    document.getElementById("total_bale_weight").value = "' . number_format($total_weight) . ' kg";
</script>
';



echo $output;
?>
