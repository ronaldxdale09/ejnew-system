<?php 
    include('../../function/db.php');
    if (isset($_POST['new'])) {

        $type = $_POST['type'];
        $ship_date = $_POST['n_date'];
        $destination = $_POST['destination'];
        $source = $_POST['source'];
        $remarks = $_POST['remarks'];
        $recorded_by = $_POST['recorded_by'];
        $particular = $_POST['particular'];
        
        // Assuming you have default values or calculations for the following fields
        $freight = 0;
        $loading_unloading = 0;
        $processing_fee = 0;
        $trucking_expense = 0;
        $cranage_fee = 0;
        $miscellaneous = 0;
        $total_shipping_expense = 0;
        $no_containers = 0;
        $ship_cost_container = 0;
    
        // Creating the SQL query
        $query = "INSERT INTO sales_cuplump_shipment (status,type,particular, ship_date, destination, source, remarks, recorded_by, freight, loading_unloading, processing_fee, trucking_expense, cranage_fee, miscellaneous, total_shipping_expense, no_containers, ship_cost_container) 
                                VALUES ('In Progress','$type','$particular',  '$ship_date', '$destination', '$source', '$remarks', '$recorded_by', '$freight', '$loading_unloading', '$processing_fee', '$trucking_expense', '$cranage_fee', '$miscellaneous', '$total_shipping_expense', '$no_containers', '$ship_cost_container')";
    
        // Executing the query
        $results = mysqli_query($con, $query);
    
        if ($results) {
            $last_id = $con->insert_id;
            header("Location: ../cuplump_shipment.php?id=$last_id");  // Change this to your desired location
            exit();
        } else {
            echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
        }
        exit();
    }

    if (isset($_POST['edit'])) {
        $ship_id = $_POST['ship_id'] ?? '';


        $query = "UPDATE sales_cuplump_shipment SET status='In Progress'
          WHERE shipment_id  = '$ship_id'";
    
        // Executing the query
        $results = mysqli_query($con, $query);


        header("Location: ../cuplump_shipment.php?id=$ship_id");  // Change this to your desired location

    }
    

   
?>