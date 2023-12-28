<?php
include('../../../function/db.php');


require 'PHPMailer/PHPMailerAutoload.php';


// Retrieve values from the form
$sales_id = $_POST['sales_id'];
$sale_contract = $_POST['sale_contract'];
$purchase_contract = $_POST['purchase_contract'];
$sale_type = $_POST['sale_type'];
$contract_quality = $_POST['contract_quality'];
$trans_date = $_POST['trans_date'];
$sale_buyer = $_POST['sale_buyer'];
$shipping_date = $_POST['shipping_date'];
$sale_source = $_POST['sale_source'];
$sale_destination = $_POST['sale_destination'];
$contract_contaier = $_POST['contract_contaier'];
$contract_quantity = $_POST['contract_quantity'];
$sale_currency = $_POST['sale_currency'];
$contract_price = $_POST['contract_price'];
$other_terms = $_POST['other_terms'];
$number_container = isset($_POST['number_container']) ? preg_replace("/[^0-9.-]/", "", $_POST['number_container']) : '';
$total_num_bales = isset($_POST['total_num_bales']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_num_bales']) : '';
$total_bale_weight = isset($_POST['total_bale_weight']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_bale_weight']) : '';
$overall_ave_kiloCost = isset($_POST['overall_ave_kiloCost']) ? preg_replace("/[^0-9.-]/", "", $_POST['overall_ave_kiloCost']) : '';
$total_bale_cost = isset($_POST['total_bale_cost']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_bale_cost']) : '';
$total_milling_cost = isset($_POST['total_milling_cost']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_milling_cost']) : '';
$total_ship_exp = isset($_POST['total_ship_exp']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_ship_exp']) : '';
$total_sale = isset($_POST['total_sale']) ? preg_replace("/[^0-9.-]/", "", $_POST['total_sale']) : '';
$amount_unpaid = isset($_POST['amount_unpaid']) ? preg_replace("/[^0-9.-]/", "", $_POST['amount_unpaid']) : '';
$unpaid_balance = isset($_POST['unpaid_balance']) ? preg_replace("/[^0-9.-]/", "", $_POST['unpaid_balance']) : '';
$sales_proceeds = isset($_POST['sales_proceeds']) ? preg_replace("/[^0-9.-]/", "", $_POST['sales_proceeds']) : '';
$over_all_cost = isset($_POST['over_all_cost']) ? preg_replace("/[^0-9.-]/", "", $_POST['over_all_cost']) : '';
$gross_profit = isset($_POST['gross_profit']) ? preg_replace("/[^0-9.-]/", "", $_POST['gross_profit']) : '';

$tax_rate = isset($_POST['tax_rate']) ? preg_replace("/[^0-9.]/", "", $_POST['tax_rate']) : '';
$tax_amount = isset($_POST['tax_amount']) ? preg_replace("/[^0-9.]/", "", $_POST['tax_amount']) : '';


// echo "Sales ID: " . $sales_id . "<br>";
// echo "Sale Contract: " . $sale_contract . "<br>";
// echo "Buyer Contract: " . $purchase_contract . "<br>";
// echo "Sale Type: " . $sale_type . "<br>";
// echo "Contract Quality: " . $contract_quality . "<br>";
// echo "Transaction Date: " . $trans_date . "<br>";
// echo "Sale Buyer: " . $sale_buyer . "<br>";
// echo "Shipping Date: " . $shipping_date . "<br>";
// echo "Sale Source: " . $sale_source . "<br>";
// echo "Sale Destination: " . $sale_destination . "<br>";
// echo "Contract Containers: " . $contract_contaier . "<br>";
// echo "Contract Quantity: " . $contract_quantity . "<br>";
// echo "Sale Currency: " . $sale_currency . "<br>";
// echo "Contract Price: " . $contract_price . "<br>";
// echo "Other Terms: " . $other_terms . "<br>";
// echo "Number of Containers: " . $number_container . "<br>";
// echo "Total Number of Bales: " . $total_num_bales . "<br>";
// echo "Total Bale Weight: " . $total_bale_weight . "<br>";
// echo "Overall Average Cost per Kilo: " . $overall_ave_kiloCost . "<br>";
// echo "Total Bale Cost: " . $total_bale_cost . "<br>";
// echo "Total Production Cost: " . $total_production_cost . "<br>";
// echo "Total Shipping Expense: " . $total_ship_exp . "<br>";
// echo "Total Sale: " . $total_sale . "<br>";
// echo "Amount Paid: " . $amount_unpaid . "<br>";
// echo "Unpaid Balance: " . $unpaid_balance . "<br>";
// echo "Sales Proceeds: " . $sales_proceeds . "<br>";
// echo "Overall Cost: " . $over_all_cost . "<br>";
// echo "Gross Profit/Loss: " . $gross_profit . "<br>";


// PAYMENT



$query = "UPDATE `bales_sales_record` 
        SET `status`='Complete',
            `sale_contract`='$sale_contract',
            `purchase_contract`='$purchase_contract',
            `buyer_name`='$sale_buyer',
            `currency`='$sale_currency',
            `sale_type`='$sale_type',
            `contract_quality`='$contract_quality',
            `transaction_date`='$trans_date',
            `shipping_date`='$shipping_date',
            `source`='$sale_source',
            `destination`='$sale_destination',
            `contract_quantity`='$contract_quantity',
            `contract_container_num`='$contract_contaier',
            `contract_price`='$contract_price',
            `other_terms`='$other_terms',
            `no_containers`='$number_container',
            `total_num_bales`='$total_num_bales',
            `total_bale_weight`='$total_bale_weight',
            `total_bale_cost`='$total_bale_cost',
            `total_milling_cost`='$total_milling_cost',
            `total_ship_expense`='$total_ship_exp',
            `overall_ave_cost_kilo`='$overall_ave_kiloCost',
            `total_sales`='$total_sale',
            `tax_rate`='$tax_rate',
            `tax_amount`='$tax_amount',
            `amount_paid`='$amount_unpaid',
            `unpaid_balance`='$unpaid_balance',
            `sales_proceed`='$sales_proceeds',
            `overall_cost`='$over_all_cost',
            `gross_profit`='$gross_profit'
        WHERE `bales_sales_id`='$sales_id'";


if (mysqli_query($con, $query)) {



    // Only process payment information if it's been provided
    if (isset($_POST['pay_date'])) {
        // Fetch existing payment_id values from the database
        $existingPayments = array();
        $fetchSql = "SELECT payment_id FROM bales_sales_payment WHERE sales_id = '$sales_id'";
        $fetchResult = mysqli_query($con, $fetchSql);
        if (!$fetchResult) {
            die('Error fetching existing payments: ' . mysqli_error($con));
        } else {
            while ($row = mysqli_fetch_assoc($fetchResult)) {
                $existingPayments[] = $row['payment_id'];
            }
        }

        $pay_date = $_POST['pay_date'];
        $pay_details = $_POST['pay_details'];
        $pay_amount = $_POST['pay_amount'];
        $pay_rate = $_POST['pay_rate'];
        $peso_equivalent = $_POST['peso_equivalent'];
        $payment_id = $_POST['payment_id'];

        foreach ($pay_details as $index => $details) {
            $id = isset($payment_id[$index]) ? $payment_id[$index] : '';
            $date = isset($pay_date[$index]) ? $pay_date[$index] : '';
            $amount = isset($pay_amount[$index]) ? floatval(str_replace(',', '', $pay_amount[$index])) : 0;
            $rate = isset($pay_rate[$index]) ? floatval(str_replace(',', '', $pay_rate[$index])) : 0;
            $equivalent = isset($peso_equivalent[$index]) ? floatval(str_replace(',', '', $peso_equivalent[$index])) : 0;

            // Check if this payment already exists
            $checkSql = "SELECT * FROM bales_sales_payment WHERE sales_id = '$sales_id' AND payment_id = '$id'";
            $checkResult = mysqli_query($con, $checkSql);

            if (mysqli_num_rows($checkResult) > 0) {
                // Update existing row
                $sql = "UPDATE bales_sales_payment 
                SET currency='$sale_currency', date='$date', details='$details', amount_paid='$amount', 
                    rate='$rate', pesos_equivalent='$equivalent'
                WHERE sales_id = '$sales_id' AND payment_id = '$id'";
            } else {
                // Insert new row
                $sql = "INSERT INTO bales_sales_payment 
                (sales_id, payment_id, currency, date, details, amount_paid, rate, pesos_equivalent)
                VALUES ('$sales_id', '$id', '$sale_currency',  '$date', '$details', '$amount', '$rate', '$equivalent')";
            }

            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error inserting or updating data: ' . mysqli_error($con));
            }

            // Remove payment_id from existingPayments array
            $existingPayments = array_diff($existingPayments, array($id));
        }

        // Any payment_ids still in $existingPayments were not in the submitted data and should be deleted
        foreach ($existingPayments as $id) {
            $deleteSql = "DELETE FROM bales_sales_payment WHERE sales_id = '$sales_id' AND payment_id = '$id'";
            if (!mysqli_query($con, $deleteSql)) {
                die('Error deleting old data: ' . mysqli_error($con));
            }
        }
    }

    // SQL to get all container_id for a given sales_id
    $sql = "SELECT sales_id,container_id FROM bales_sales_container WHERE sales_id = '$sales_id'";
    // Execute the query
    $result = mysqli_query($con, $sql);

    // For each container_id, update the status in bales_container_record
    while ($row = mysqli_fetch_assoc($result)) {
        $container_id = $row['container_id'];
        // SQL to update the status of the corresponding container_id
        $update = "UPDATE bales_container_record SET status = 'Sold' WHERE container_id = '$container_id'";
        // Execute the update query
        mysqli_query($con, $update);
    }



    try {

        $total_bale_weight = number_format($total_bale_weight, 2);
        $total_bale_cost = number_format($total_bale_cost, 2);
        $total_milling_cost = number_format($total_milling_cost, 2);
        $total_ship_exp = number_format($total_ship_exp, 2);
        $total_sale = number_format($total_sale, 2);
        $amount_unpaid = number_format($amount_unpaid, 2);
        $unpaid_balance = number_format($unpaid_balance, 2);
        $sales_proceeds = number_format($sales_proceeds, 2);
        $over_all_cost = number_format($over_all_cost, 2);
        $gross_profit = number_format($gross_profit, 2);
        $tax_rate = number_format($tax_rate, 2);
        $tax_amount = number_format($tax_amount, 2);


        $emailBody = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .table { border-collapse: collapse; width: 100%; }
                .table th, .table td { border: 1px solid #ddd; padding: 8px; }
                .table th { text-align: left; background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h2>Bales Sales Confirmation</h2>
            <table class='table'>
                <tr><th>Sales ID</th><td>{$sales_id}</td></tr>
                <tr><th>Sale Contract</th><td>{$sale_contract}</td></tr>
                <tr><th>Purchase Contract</th><td>{$purchase_contract}</td></tr>
                <tr><th>Sale Type</th><td>{$sale_type}</td></tr>
                <tr><th>Contract Quality</th><td>{$contract_quality}</td></tr>
                <tr><th>Transaction Date</th><td>{$trans_date}</td></tr>
                <tr><th>Sale Buyer</th><td>{$sale_buyer}</td></tr>
                <tr><th>Shipping Date</th><td>{$shipping_date}</td></tr>
                <tr><th>Sale Source</th><td>{$sale_source}</td></tr>
                <tr><th>Sale Destination</th><td>{$sale_destination}</td></tr>
                <tr><th>Contract Containers</th><td>{$contract_contaier}</td></tr>
                <tr><th>Contract Quantity</th><td>{$contract_quantity} kg</td></tr>
                <tr><th>Sale Currency</th><td>{$sale_currency}</td></tr>
                <tr><th>Contract Price</th><td>{$contract_price}</td></tr>
            </table>

            <h3>Additional Information</h3>
            <p>Other Terms: {$other_terms}</p>
            <p>Number of Containers: <em>{$number_container}</em></p>
            <p>Total Number of Bales: <em>{$total_num_bales}</em></p>
            <p>Total Bale Weight: <em>{$total_bale_weight} kg</em></p>
            <p>Total Bale Cost:₱ <em>{$total_bale_cost}</em></p>
            <p>Total Milling Cost:₱ <em>{$total_milling_cost}</em></p>
            <p>Total Shipping Expense:₱ <em>{$total_ship_exp}</em></p>
            <p>Total Sale: {$sale_currency} <em>{$total_sale}</em></p>
            <p>Amount Unpaid: {$sale_currency} <em>{$amount_unpaid}</em></p>
            <p>Unpaid Balance: {$sale_currency} <em>{$unpaid_balance}</em></p>
            <p>Sales Proceeds:₱ <em>{$sales_proceeds}</em></p>
            <p>Overall Cost:₱ <em>{$over_all_cost}</em></p>
            <p>Tax Rate: <em>{$tax_rate}%</em></p>
            <p>Tax Amount:₱ <em>{$tax_amount}</em></p>
            <p><b> Gross Profit/Loss:₱ {$gross_profit}</b></p>
            

        </body>
        </html>";


        $phpmailer = new PHPMailer();
        

        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.hostinger.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'notif@en-rubber.online';
        $phpmailer->Password = 'Aetherio@2023';

        // Check if the email address is valid
    // Check if the email addresses are valid
if (!PHPMailer::validateAddress('ronaldxdale@gmail.com') || !PHPMailer::validateAddress('richardbnew@gmail.com')) {
    throw new Exception("Invalid email address");
}

        $phpmailer->setFrom('notif@en-rubber.online', 'EJN SYSTEM');
        $phpmailer->addAddress('ronaldxdale@gmail.com');
        $phpmailer->addAddress('richardbnew@gmail.com.com'); // Add the second email address here

        //Attachments
        //$phpmailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      
        // Content
        $phpmailer->isHTML(true);
        $phpmailer->Subject = 'Bales Sales Confirmation | EN-RUBBER SYSTEM';
        $phpmailer->Body = $emailBody;

        $phpmailer->send();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }





    echo 'success';
} else {
    echo 'Update query failed: ' . mysqli_error($con);
    exit();
}



