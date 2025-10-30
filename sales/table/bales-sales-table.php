<?php

include('../../function/db.php');
$output = '';
$sales_id = $_POST['sales_id'];

$result = mysqli_query($con, "SELECT DISTINCT sales_bales_selected_inventory.*, planta_bales_production.*,
 rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight, planta_recording.status as prod_status ,
 planta_recording.reweight,rubber_transaction.total_amount,planta_recording.location as source
 
 FROM sales_bales_selected_inventory
LEFT JOIN planta_bales_production ON sales_bales_selected_inventory.bales_prod_id = planta_bales_production.bales_prod_id 
LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
 LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
where sales_bales_selected_inventory.sales_id ='$sales_id'");
$total_cost = 0.0;
$total_weight = 0.0;
$cost_per_kilo = 0.0;
$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
       <thead class="table-dark" style="font-size: 12px !important" >
       <tr>
       <th>ID</th>
       <th>Source</th>
       <th>No. of Bales</th>
       <th>Bale Weight</th>
       <th>Weight</th>
       <th>Cost per Kilo</th>
       <th>Total Cost</th>
       <th>Select Num. Bales</th>
   </tr>
       </thead>';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_cost += floatval($row['total_amount']);
        $total_weight += floatval($row['reweight']);
        $weight = $row["reweight"];
        $bales_prod_id = $row["bales_prod_id"];
        $cost_per_kilo = floatval($row['total_amount']) / floatval($row['net_weight']);

        $output .= '
       <tr>
          <td class="bales_id">' . $row["bales_prod_id"] . '</td>
          <td class="bales_source">' . $row["source"] . '</td>
          <td class="bales_num">' . $row["bales_number"] . '</td>
          <td class="bales_weight">' . $row["bale_weight"] . '</td>
          <td class="bales_total_weight">' . $row["reweight"] . '</td>
          <td class="bales_cost_per_kilo">' . number_format($cost_per_kilo, 2) . '</td>
          <td class="bales_total_cost">' . $row["total_amount"] . '</td>
          <td >' . $row["bales_number"] . '</td>
       </tr>
       ';
    }
} else {
    $output .= '<tr>
   <td colspan="4">No data available</td>
</tr>';
}

$output .= '</table>
</div>
    <div class="row">
    <div class="col">
        <!-- BASED SA EXCEL KO DITO, ISANG TYPE LANG DAPAT LAHAT-->
        <label for="bales_quality" class="form-label">Quality</label>
        <div class="input-group">
            <input type="text" class="form-control" id="bales_quality" readonly>
        </div>
    </div>
    <div class="col">
        <!-- #,### NO DECIMAL -->
        <!-- ADD LAHAT NG BALE PCS -->
        <label for="bales_total_num" class="form-label">Total Bales</label>
        <div class="input-group">
            <input type="text" class="form-control" id="bales_total_num" readonly>
            <span class="input-group-text">pcs</span>
        </div>
    </div>
    <div class="col">
        <!-- #,###.## -->
        <!-- ADD LAHAT NG WEIGHT -->
        <label for="bales_total_weight" class="form-label">Total Weight</label>
        <div class="input-group">
            <input type="text" class="form-control" id="bales_total_weight" readonly>
            <span class="input-group-text">kg</span>
        </div>
    </div>
    <div class="col">
        <!-- #,###.## -->
        <!-- = TOTAL COST / TOTAL WEIGHT -->
        <label for="bales_avg_cost_per_kilo" class="form-label">Ave. Cost per Kilo</label>
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control" id="bales_avg_cost_per_kilo" readonly>
        </div>
    </div>
    <div class="col">
        <!-- #,###.## -->
        <!-- ADD LAHAT NG COST -->
        <label for="bales_total_cost" class="form-label">Total Bale Cost</label>
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control" id="bales_total_cost" readonly>
        </div>
    </div>
    </div>';

    echo $output;
    
    ?>