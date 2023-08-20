<?php 
include('../../function/db.php');

if (isset($_POST['add'])) {
    $source = $_SESSION['loc'];

    $supplier = $_POST['supplier'];
    $location = $_POST['loc'];
    $date = $_POST['date'];
    // Remove any comma in the 'net_weight' data
    $total_buying_weight = str_replace(',', '', $_POST['net_weight']);
    
    // Remove any comma in the 'purchase_cost' data
    $total_purchase_cost = str_replace(',', '', $_POST['purchase_cost']);
    
    // Remove any comma in the 'ave_cost' data
    $ave_kiloCost = str_replace(array(',', '₱'), '', $_POST['ave_cost']);

    
    $remarks = $_POST['remarks'];
    $recorded_by = $_POST['recorded_by'];
    

    $query = "INSERT INTO ejn_rubber_transfer (type,date,supplier, location, total_buying_weight, total_purchase_cost, ave_kiloCost, remarks, recorded_by,planta_status,source) 
              VALUES ('EJN','$date','$supplier', '$location', '$total_buying_weight', '$total_purchase_cost', '$ave_kiloCost', '$remarks', '$recorded_by','1','$source')";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../ejn_rubber_record.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $supplier = $_POST['supplier'];
    $location = $_POST['loc'];
    $date = $_POST['date'];
    
    // Remove any comma in the 'net_weight' data
    $total_buying_weight = str_replace(',', '', $_POST['weight']);
    
    // Remove any comma in the 'purchase_cost' data
    $total_purchase_cost = str_replace(',', '', $_POST['cost']);
    
    // Remove any comma in the 'ave_cost' data
    $ave_kiloCost = str_replace(array(',', '₱'), '', $_POST['aveCost']);
    
    $remarks = $_POST['remarks'];
    $recorded_by = $_POST['recorded_by'];

    $query = "UPDATE ejn_rubber_transfer SET date='$date', supplier='$supplier', location='$location', 
    total_buying_weight='$total_buying_weight', total_purchase_cost='$total_purchase_cost', ave_kiloCost='$ave_kiloCost', remarks='$remarks',
     recorded_by='$recorded_by' WHERE ejn_id='$id'";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../ejn_rubber_record.php");
        $_SESSION['seller'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
}


if (isset($_POST['delete'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    // Assuming 'dry_id' is passed from the form

    // Debugging: Echo dry_id
    echo " ID to delete: " . $id . "<br>";

    $query = "DELETE FROM ejn_rubber_transfer WHERE ejn_id = '$id'";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../ejn_rubber_record.php");
        $_SESSION['message'] = "Record successfully deleted";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}
?>