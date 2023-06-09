<?php 
    include('db.php');

    $ref_no = $_POST['ref_no'];
    $container_no = $_POST['container_no'];
    $van_no = $_POST['van_no'];
    $withdrawal_date = $_POST['withdrawal_date'];
    $quality = $_POST['quality'];
    $remarks = $_POST['remarks'];
    $recorded_by = $_POST['recorded_by'];

    $total_bale_weight = preg_replace("/[^0-9\.]/", "", $_POST['total_bale_weight']);
    $num_bales = preg_replace("/[^0-9\.]/", "", $_POST['num_bales']);
    $kilo_bale = preg_replace("/[^0-9\.]/", "", str_replace(',', '', $_POST['kilo_bale']));

    $query = "UPDATE container_record SET 
              container_no = '$container_no', 
              van_no = '$van_no', 
              withdrawal_date = '$withdrawal_date', 
              quality = '$quality', 
              kilo_bale = '$kilo_bale', 
              remarks = '$remarks', 
              recorded_by = '$recorded_by', 
              num_bales = '$num_bales', 
              total_bale_weight = '$total_bale_weight' ,
              status = 'In Progress' 
              WHERE container_id  = '$ref_no'";

    $results = mysqli_query($con, $query);

    if ($results) {

        $query_select_bales = "SELECT bales_id,num_bales FROM container_bales_selection WHERE container_id  = '$ref_no'";
        $selected_bales = mysqli_query($con, $query_select_bales);
        
        // Removed the calculation and update of the remaining_bales

        header("Location: ../container_record.php");
        $_SESSION['contract']= "Update successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. ".mysqli_error($con);
    }
    exit();
?>
