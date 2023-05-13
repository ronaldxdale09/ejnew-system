<?php
include "db.php";
if (isset($_POST["new"])) {
    $sale_contract_no = $_POST["wet_sale_id"];
    $transaction_date = $_POST["wet_ship_date"];
    $purchase_contract_no = $_POST["wet_buyer_contract"];
    $wet_sale_type = $_POST["wet_sale_type"];
    $buyer_company = $_POST["wet_sale_buyer"];
    $shipping_date = $_POST["shipping_date"];
    $address = $_POST["sale_destination"];
    $shipping_port = $_POST["info_lading"];
    $contact = $_POST["contact_information"];
    $destination = $_POST["destination"];
    $quantity = $_POST["wet_quantity"];
    $wet_packing = $_POST["packing"];
    $wet_containers = $_POST["container"];
    $other_terms = $_POST["remarks"];
    $wet_price = $_POST["wet_price"];
    $wet_recorded_by = $_POST["wet_recorded_by"];

    $query = "INSERT INTO sale_cuplump_contract 
    (sale_contract_no, transaction_date, purchase_contract_no, wet_sale_type, buyer_company, shipping_date, address, shipping_port, 
    contact, destination, quantity, wet_packing, wet_containers, other_terms, wet_price, wet_recorded_by) 
    VALUES 
    ('$sale_contract_no', '$transaction_date', '$purchase_contract_no', '$wet_sale_type', '$buyer_company', '$shipping_date', '$address', '$shipping_port', 
    '$contact', '$destination', '$quantity', '$wet_packing', '$wet_containers', '$other_terms', '$wet_price', '$wet_recorded_by')";

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
