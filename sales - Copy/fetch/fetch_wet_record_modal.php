<?php 

include('../../function/db.php');
if (isset($_POST['sales_id'])) {
    $sales_id = $_POST['sales_id'];

    $query = "SELECT 
        sale_id,
        ship_date,
        sale_buyer,
        van_no,
        sale_type,
        sale_currency,
        exchange_rate,
        wet_kilo_price,
        info_lading,
        sale_destination,
        voyage,
        source,
        vessel,
        sales_total,
        total_wet_cost,
        total_ship_exp,
        net_gain,
        payment_sales,
        amount_unpaid,
        pay_date,
        pay_details,
        paid_amount,
        ship_exp_freight,
        ship_exp_loading,
        ship_exp_processing,
        ship_exp_trucking,
        ship_exp_cranage,
        ship_exp_misc
    FROM sales_cuplumps_rec
    WHERE sale_id = $sales_id";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'No data found for the given sales_id.'));
    }
} else {
    echo json_encode(array('error' => 'No sales_id provided.'));
}
?>