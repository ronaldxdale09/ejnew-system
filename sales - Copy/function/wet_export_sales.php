<?php 
include('../../function/db.php');



// Get values from the form

$sale_id = $_POST["sale_id"];


$ship_date = $_POST["ship_date"];
$sale_buyer = $_POST["sale_buyer"];
$van_no = $_POST["van_no"];
$sale_type = $_POST["sale_type"];
$info_lading = $_POST["info_lading"];
$sale_destination = $_POST["sale_destination"];
$voyage = $_POST["voyage"];
$source = $_POST["source"];
$vessel = $_POST["vessel"];
$cuplumps_total_cost = str_replace(',', '', $_POST["cuplumps_total_cost"]);
$cuplumps_total_weight = str_replace(',', '', $_POST["cuplumps_total_weight"]);
$cuplumps_average_per_kilo = str_replace(',', '', $_POST["cuplumps_average_per_kilo"]);

$sale_currency = str_replace(',', '', $_POST["sale_currency"]);
$exchange_rate = str_replace(',', '', $_POST["exchange_rate"]);
$wet_kilo_price = str_replace(',', '', $_POST["wet_kilo_price"]);
$ship_exp_freight = str_replace(',', '', $_POST["ship_exp_freight"]);
$ship_exp_loading = str_replace(',', '', $_POST["ship_exp_loading"]);
$ship_exp_processing = str_replace(',', '', $_POST["ship_exp_processing"]);
$ship_exp_trucking = str_replace(',', '', $_POST["ship_exp_trucking"]);
$ship_exp_cranage = str_replace(',', '', $_POST["ship_exp_cranage"]);
$ship_exp_misc = str_replace(',', '', $_POST["ship_exp_misc"]);
$sales_total = str_replace(',', '', $_POST["sales"]);
$total_wet_cost = str_replace(',', '', $_POST["total_wet_cost"]);
$total_ship_exp = str_replace(',', '', $_POST["total_ship_exp"]);
$net_gain = str_replace(',', '', $_POST["net_gain"]);
$payment_sales = str_replace(',', '', $_POST["payment_sales"]);
$amount_unpaid = str_replace(',', '', $_POST["amount_unpaid"]);
$pay_date = $_POST["pay_date"];
$pay_details = $_POST["pay_details"];
$paid_amount = str_replace(',', '', $_POST["paid_amount"]);

echo "Sale ID: " . $sale_id . "<br>";
echo "Ship Date: " . $ship_date . "<br>";
echo "Sale Buyer: " . $sale_buyer . "<br>";
echo "Van No: " . $van_no . "<br>";
echo "Sale Type: " . $sale_type . "<br>";
echo "Info Lading: " . $info_lading . "<br>";
echo "Sale Destination: " . $sale_destination . "<br>";
echo "Voyage: " . $voyage . "<br>";
echo "Source: " . $source . "<br>";
echo "Vessel: " . $vessel . "<br>";
echo "Cuplumps Total Cost: " . $cuplumps_total_cost . "<br>";
echo "Cuplumps Total Weight: " . $cuplumps_total_weight . "<br>";
echo "Cuplumps Average per Kilo: " . $cuplumps_average_per_kilo . "<br>";
echo "Sale Currency: " . $sale_currency . "<br>";
echo "Exchange Rate: " . $exchange_rate . "<br>";
echo "Wet Kilo Price: " . $wet_kilo_price . "<br>";
echo "Ship Exp Freight: " . $ship_exp_freight . "<br>";
echo "Ship Exp Loading: " . $ship_exp_loading . "<br>";
echo "Ship Exp Processing: " . $ship_exp_processing . "<br>";
echo "Ship Exp Trucking: " . $ship_exp_trucking . "<br>";
echo "Ship Exp Cranage: " . $ship_exp_cranage . "<br>";
echo "Ship Exp Misc: " . $ship_exp_misc . "<br>";
echo "Sales Total: " . $sales_total . "<br>";
echo "Total Wet Cost: " . $total_wet_cost . "<br>";
echo "Total Ship Exp: " . $total_ship_exp . "<br>";
echo "Net Gain: " . $net_gain . "<br>";
echo "Payment Sales: " . $payment_sales . "<br>";
echo "Paid Total: " . $paid_total . "<br>";
echo "Amount Unpaid: " . $amount_unpaid . "<br>";
echo "Pay Date: " . $pay_date . "<br>";
echo "Pay Details: " . $pay_details . "<br>";
echo "Paid Amount: " . $paid_amount . "<br>";


$sql = "UPDATE sales_cuplumps_rec SET 
    ship_date = '$ship_date',
    sale_buyer = '$sale_buyer',
    van_no = '$van_no',
    sale_type = '$sale_type',
    info_lading = '$info_lading',
    sale_destination = '$sale_destination',
    voyage = '$voyage',
    source = '$source',
    vessel = '$vessel',
    cuplumps_total_cost = '$cuplumps_total_cost',
    cuplumps_total_weight = '$cuplumps_total_weight',
    cuplumps_average_per_kilo = '$cuplumps_average_per_kilo',
    sale_currency = '$sale_currency',
    exchange_rate = '$exchange_rate',
    wet_kilo_price = '$wet_kilo_price',
    ship_exp_freight = '$ship_exp_freight',
    ship_exp_loading = '$ship_exp_loading',
    ship_exp_processing = '$ship_exp_processing',
    ship_exp_trucking = '$ship_exp_trucking',
    ship_exp_cranage = '$ship_exp_cranage',
    ship_exp_misc = '$ship_exp_misc',
    sales_total = '$sales_total',
    net_gain = '$net_gain',
    payment_sales = '$payment_sales',
    amount_unpaid = '$amount_unpaid',
    pay_date = '$pay_date',
    pay_details = '$pay_details',
    paid_amount = '$paid_amount',
    total_ship_exp ='$total_ship_exp',
    total_wet_cost ='$total_wet_cost',
    status ='Completed'
WHERE sale_id = $sale_id";



if ($con->query($sql) === true) {

   // Get all the recording_id and weight_selected values associated with the current sales_id
   $sql2 = "SELECT recording_id, weight_selected FROM sales_cuplump_selected_inventory WHERE sales_id = $sale_id";
   $result = $con->query($sql2);

   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $recording_id = $row["recording_id"];
           $weight_selected = $row["weight_selected"];

           // Get reweight and cuplump_remaining_weight for the current recording_id
           $sql3 = "SELECT reweight, cuplump_remaining_weight FROM planta_recording WHERE recording_id = $recording_id";
           $result3 = $con->query($sql3);
           $row3 = $result3->fetch_assoc();
           $reweight = $row3["reweight"];
           $cuplump_remaining_weight = $row3["cuplump_remaining_weight"];

           // Check if cuplump_remaining_weight is not equal to reweight
           if ($cuplump_remaining_weight != $reweight) {
               // Update planta_recording table's cuplump_remaining_weight for each recording_id
               $sql4 = "UPDATE planta_recording SET cuplump_remaining_weight = reweight - $weight_selected WHERE recording_id = $recording_id";
           } else {
               // Update planta_recording table's cuplump_remaining_weight for each recording_id
               $sql4 = "UPDATE planta_recording SET cuplump_remaining_weight = cuplump_remaining_weight - $weight_selected WHERE recording_id = $recording_id";
           }
           if (!$con->query($sql4)) {
               $response = array('success' => false, 'error' => $con->error);
               echo json_encode($response);
               $con->close();
               exit();
           }
       }
   }
    $response = array('success' => true);
    echo json_encode($response);
} else {
    $response = array('success' => false, 'error' => $con->error);
    echo json_encode($response);
}

$con->close();
?>