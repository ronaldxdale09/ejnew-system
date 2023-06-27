<?php 
    include('db.php');
    if (isset($_POST['new'])) {

        $date = $_POST['date'];
        $recorded_by = $_POST['recorded_by'];
        $contract = $_POST['contract'];
        $purchase_contract = $_POST['purchase_contract'];
        $sale_type = $_POST['sale_type'];
        $quality = $_POST['quality'];
        $remarks = $_POST['remarks'];
        $sale_buyer = $_POST['sale_buyer'];
    
        
        // Creating the SQL query
        $query = "INSERT INTO bales_sales_record (buyer_name,transaction_date,status,sale_contract,purchase_contract,contract_quality,sale_type,remarks,recorded_by) 
                                VALUES ('$sale_buyer','$date','In Progress','$contract', '$purchase_contract', '$quality', '$sale_type','$remarks', '$recorded_by')";
    
        // Executing the query
        $results = mysqli_query($con, $query);
    
        if ($results) {
            $last_id = $con->insert_id;
            header("Location: ../bale_sales.php?id=$last_id");  // Change this to your desired location
            exit();
        } else {
            echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
        }
        exit();
    }




   
?>