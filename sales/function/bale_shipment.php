<?php 
    include('db.php');
    if (isset($_POST['new'])) {

        $type = $_POST['type'];
        $ship_date = $_POST['n_date'];
        $destination = $_POST['destination'];
        $source = $_POST['source'];
        $vessel = $_POST['vessel'];
        $bill_lading = $_POST['info_lading'];
        $remarks = $_POST['remarks'];
        $recorded_by = $_POST['recorded_by'];
    
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
        $query = "INSERT INTO bale_shipment_record (type, ship_date, destination, source, vessel, bill_lading, remarks, recorded_by, freight, loading_unloading, processing_fee, trucking_expense, cranage_fee, miscellaneous, total_shipping_expense, no_containers, ship_cost_container) 
                                VALUES ('$type', '$ship_date', '$destination', '$source', '$vessel', '$bill_lading', '$remarks', '$recorded_by', '$freight', '$loading_unloading', '$processing_fee', '$trucking_expense', '$cranage_fee', '$miscellaneous', '$total_shipping_expense', '$no_containers', '$ship_cost_container')";
    
        // Executing the query
        $results = mysqli_query($con, $query);
    
        if ($results) {
            $last_id = $con->insert_id;
            header("Location: ../bale_shipment.php?id=$last_id");  // Change this to your desired location
            exit();
        } else {
            echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
        }
        exit();
    }

//     if (isset($_POST['edit'])) {

//          $id = $_POST['id'];
//          echo $id;

//         $sql = "UPDATE container_record SET 
//         status = 'In Progress'
//         WHERE container_id = '$id'";
//         mysqli_query($con, $sql);

//         header("Location: ../container.php?id=$id");  // Change this to your desired location
//             exit();
        
//     }

//     if (isset($_POST['draft'])) {

//         $id = $_POST['id'];
//         echo $id;

//        $sql = "UPDATE container_record SET 
//        status = 'In Progress'
//        WHERE container_id = '$id'";
//        mysqli_query($con, $sql);

//        header("Location: ../container_record.php");  // Change this to your desired location
//            exit();
       
//    }
//    if (isset($_POST['released'])) {

//     $id = $_POST['id'];
//     echo $id;

//    $sql = "UPDATE container_record SET 
//    status = 'Released'
//    WHERE container_id = '$id'";
//    mysqli_query($con, $sql);

//    header("Location: ../container_record.php");  // Change this to your desired location
//        exit();
   
// }

   
?>