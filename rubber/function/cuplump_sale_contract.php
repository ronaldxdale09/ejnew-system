<?php

include "db.php";

if (isset($_POST["new"])) {
    $en_sale_contract_no = $_POST["wet_info_lading"];
    $transaction_date = $_POST["wet_ship_date"];
    $buyer_purchase_contract_no = $_POST["wet_buyer_contract_no"];
    $type = $_POST["wet_sale_type"];
    $buyer_company_name = $_POST["wet_sale_buyer"];
    $shipping_date = $_POST["wet_ship_date"];
    $address = $_POST["wet_sale_destination"];
    $shipping_port = $_POST["wet_info_lading"];
    $contact_information = $_POST["wet_voyage"];
    $destination = $_POST["wet_source"];
    $quantity = $_POST["wet_quantity"];
    $packing = $_POST["wet_packing"];
    $containers = $_POST["wet_containers"];
    $other_terms = $_POST["wet_remarks"];
    $price = $_POST["wet_price"];
    $recorded_by = $_POST["wet_recorded_by"];

    $query = "INSERT INTO sale_cuplump_contract 
    (en_sale_contract_no, transaction_date, buyer_purchase_contract_no, type, buyer_company_name, shipping_date, address, shipping_port, 
    contact_information, destination, quantity, packing, containers, other_terms, price, recorded_by) 
    VALUES 
    ('$en_sale_contract_no', '$transaction_date', '$buyer_purchase_contract_no', '$type', '$buyer_company_name', '$shipping_date', '$address', '$shipping_port', 
    '$contact_information', '$destination', '$quantity', '$packing', '$containers', '$other_terms', '$price', '$recorded_by')";

    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../cuplump_contract.php?id=$last_id");
        $_SESSION["seller"] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
    exit();
}





?>