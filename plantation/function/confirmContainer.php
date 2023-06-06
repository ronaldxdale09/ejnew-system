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
              status = 'Awaiting Shipment' 
              WHERE container_id  = '$ref_no'";

    $results = mysqli_query($con, $query);

    if ($results) {

        $query_select_bales = "SELECT bales_id,num_bales FROM container_bales_selection WHERE container_id  = '$ref_no'";
        $selected_bales = mysqli_query($con, $query_select_bales);
        
        while ($row = mysqli_fetch_assoc($selected_bales)) {
            $bales_id = $row['bales_id'];
            $num_bales = $row['num_bales'];

            $sql = "SELECT number_bales FROM planta_bales_production WHERE bales_prod_id  = '$bales_id'";
            $res = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($res);
            $prev_bales = $data['number_bales'];
            $planta_id = $data['recording_id'];


            $remaining_bales= $prev_bales - $num_bales;

            $query_update_bales = "UPDATE planta_bales_production SET 
            status = 'Produced',remaining_bales = '$remaining_bales'
             WHERE bales_prod_id = '$bales_id'";
            mysqli_query($con, $query_update_bales);


            if ($remaining_bales ==0){
                $sql = "UPDATE planta_bales_production SET 
                status = 'Container'
                WHERE bales_prod_id = '$bales_id'";
                mysqli_query($con, $sql);
            }
        }


        header("Location: ../container_record.php");
        $_SESSION['contract']= "Update successful";
        exit();
    } else {
        echo "ERROR: Could not execute $query. ".mysqli_error($con);
    }
    exit();

?>