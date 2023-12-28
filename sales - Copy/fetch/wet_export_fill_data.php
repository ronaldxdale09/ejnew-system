
<?php 
include('../../function/db.php');

$query = "SELECT * FROM sales_cuplumps_rec WHERE sale_id = $id";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Assign the retrieved values to variables for easier access
    $sale_id = $row['sale_id'];
    $ship_date = $row['ship_date'];
    $sale_buyer = $row['sale_buyer'];
    $van_no = $row['van_no'];
    $sale_type = $row['sale_type'];
    $info_lading = $row['info_lading'];
    $sale_destination = $row['sale_destination'];
    $voyage = $row['voyage'];
    $source = $row['source'];
    $vessel = $row['vessel'];
    $sales = number_format($row['sales_total'], 2, '.', ',');
    $total_wet_cost = number_format($row['total_wet_cost'], 2, '.', ',');
    $total_ship_exp = number_format($row['total_ship_exp'], 2, '.', ',');
    $net_gain = number_format($row['net_gain'], 2, '.', ',');
    $payment_sales = number_format($row['payment_sales'], 2, '.', ',');
    $amount_unpaid = number_format($row['amount_unpaid'], 2, '.', ',');
    $pay_date = $row['pay_date'];
    $pay_details = $row['pay_details'];
    $paid_amount = number_format($row['paid_amount'], 2, '.', ',');

    $notes = $row['notes'];
    $cuplumps_total_cost = $row['cuplumps_total_cost'];
    $cuplumps_total_weight = $row['cuplumps_total_weight'];
    $cuplumps_average_per_kilo = $row['cuplumps_average_per_kilo'];
    $sale_currency = $row['sale_currency'];
    $exchange_rate = $row['exchange_rate'];
    $wet_kilo_price = $row['wet_kilo_price'];
    $ship_exp_freight = number_format($row['ship_exp_freight'], 2, '.', ',');
    $ship_exp_loading = number_format($row['ship_exp_loading'], 2, '.', ',');
    $ship_exp_processing = number_format($row['ship_exp_processing'], 2, '.', ',');
    $ship_exp_trucking = number_format($row['ship_exp_trucking'], 2, '.', ',');
    $ship_exp_cranage = number_format($row['ship_exp_cranage'], 2, '.', ',');
    $ship_exp_misc = number_format($row['ship_exp_misc'], 2, '.', ',');


    // Wrap the JavaScript code inside a function
    echo "
    <script>
    
    function populateInputs() {
        document.getElementById('ship_date').value = '$ship_date';
        document.getElementById('sale_buyer').value = '$sale_buyer';
        document.getElementById('van_no').value = '$van_no';
        document.getElementById('sale_type').value = '$sale_type';
        document.getElementById('sale_currency').value = '$sale_currency';
        document.getElementById('exchange_rate').value = '$exchange_rate';
        document.getElementById('wet_kilo_price').value = '$wet_kilo_price';

        document.getElementById('info_lading').value = '$info_lading';
        document.getElementById('sale_destination').value = '$sale_destination';
        document.getElementById('voyage').value = '$voyage';
        document.getElementById('source').value = '$source';
        document.getElementById('vessel').value = '$vessel';
        document.getElementById('sales').value = '$sales';
        document.getElementById('total_wet_cost').value = '$total_wet_cost';
        document.getElementById('total_ship_exp').value = '$total_ship_exp';
        document.getElementById('net_gain').value = '$net_gain';
        document.getElementById('payment_sales').value = '$payment_sales';
        document.getElementById('amount_unpaid').value = '$amount_unpaid';
        document.getElementById('pay_date').value = '$pay_date';
        document.getElementById('pay_details').value = '$pay_details';
        document.getElementById('paid_amount').value = '$paid_amount';

        document.getElementById('ship_exp_freight').value = '$ship_exp_freight';
        document.getElementById('ship_exp_loading').value = '$ship_exp_loading';
        document.getElementById('ship_exp_processing').value = '$ship_exp_processing';
        document.getElementById('ship_exp_trucking').value = '$ship_exp_trucking';
        document.getElementById('ship_exp_cranage').value = '$ship_exp_cranage';
        document.getElementById('ship_exp_misc').value = '$ship_exp_misc';
    }
        window.onload = populateInputs;
    </script>
    ";
} else {
    echo "No sales data found.";
}


?>