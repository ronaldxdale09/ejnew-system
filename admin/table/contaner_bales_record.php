<?php
include('../../function/db.php');

$container_id = $_POST['container_id'];
$sql  = "SELECT * FROM bales_container_selection 
LEFT JOIN planta_bales_production ON bales_container_selection.bales_id = planta_bales_production.bales_prod_id
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
 where container_id ='$container_id'"; 

$total_bales_count = 0;
$total_weight=0;
$unit_cost =0;
$total_unit_cost =0;
$total_bale_cost =0;

$milling_cost =0;
$total_milling_cost =0;

$overall_milling_cost =0;
$average_kilo_cost = 0;
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

<div class="table-responsive">                                       
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-size: 10px !important" >
        <tr>
        <th scope="col">Supplier</th>
        <th scope="col">LOT</th>
        <th scope="col">Lot No.</th>
        <th scope="col">Quality</th>
        <th scope="col">Kilo per Bale</th>
        <th scope="col">Withdrawal Bales</th>
        <th scope="col">Bale Weight</th>
        <th scope="col">Bale Unit Cost</th>
        <th scope="col">Total Bale Cost</th>

        <th scope="col">Milling Cost</th>
        <th scope="col">Total Milling Cost</th>
     

        </tr>
    </thead>
    <tbody>';

if(mysqli_num_rows($result) > 0) {  
    while($arr = mysqli_fetch_assoc($result)) {  
        $remaining= $arr["remaining_bales"] - $arr["num_bales"];
        $weight= $arr["num_bales"] * $arr["kilo_per_bale"];

        $total_bales_count += $arr['num_bales'];
        $total_weight += $weight;

        $unit_cost = $arr['total_production_cost'] / $arr['produce_total_weight'];
        $total_unit_cost = $unit_cost * $weight;
        $total_bale_cost += $total_unit_cost;
     

        $milling_cost = $arr['milling_cost'];
        $total_milling_cost = $arr['milling_cost'] * $weight ;

        $overall_milling_cost += $total_milling_cost;

        $output .= '
        <tr style="font-weight:bold" data-bales_id="'.$arr['bales_id'].'"> 
            <td>'.$arr["supplier"].'</td>
            <td>'.$arr["lot_num"].'</td>
            <td>'.$arr["recording_id"].'</td>
            <td>'.$arr["bales_type"].'</td>
            <td>'.$arr["kilo_per_bale"].' kg</td>
            <td>'.$arr["num_bales"].' pcs</td>
            <td>'.number_format( $weight,2, '.', ',').' kg</td>
            <td>≈ ₱ '.number_format($unit_cost,2).' </td>
            <td>₱ '.number_format($total_unit_cost,2).' </td>

            <td>₱ '.number_format($milling_cost,2).' </td>
            <td>₱ '.number_format($total_milling_cost,0).' </td>
        </tr>';
    }
    $average_kilo_cost = ($total_bale_cost + $overall_milling_cost ) / $total_weight;

}

$output .= '
    </tbody>
</table> 
</div>
<hr>

<div class="row">
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Bale Cost</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="total_bale_cost" id="total_bale_cost" autocomplete="off"
                style="width: 100px;" readonly />
        </div>
    </div>
     <div class="col">
        <label style="font-size:15px" class="col-md-12">Average Kilo Cost</label>
        <div class="input-group mb-3">
             <input type="text" class="form-control" name="average_cost" id="average_cost" autocomplete="off"
                style="width: 100px;" readonly />
         </div>
    </div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Milling Cost</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="total_milling_cost" id="total_milling_cost" autocomplete="off"
                style="width: 100px;" readonly />
        </div>
    </div>

</div>


<script>
    document.getElementById("num_bales").value = "' . $total_bales_count . ' pcs";
    document.getElementById("total_bale_weight").value = "' . number_format($total_weight,2) . ' kg";

    document.getElementById("total_bale_cost").value = "₱ ' . number_format($total_bale_cost,2) . '";
    document.getElementById("total_milling_cost").value = "₱ ' . number_format($overall_milling_cost,2) . '";
    document.getElementById("average_cost").value = "₱ ' . number_format($average_kilo_cost ,2) . '";
</script>
';



echo $output;
?>