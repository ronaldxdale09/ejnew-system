<?php
  include('db.php');
    

    // UPDATE PRESSING

    if (isset($_POST['pressing_update'])) {
        
        
        $id = $_POST['recording_id'];

        $kilo_bale_manhattan = $_POST['kilo_bale_manhattan'];
        $quality_manhattan = $_POST['quality_manhattan'];
        $weight_manhattan = $_POST['weight_manhattan'];
        $bale_num_manhattan = $_POST['bale_num_manhattan'];
        $excess_manhattan = $_POST['excess_manhattan'];
    
        $kilo_bale_showa = $_POST['kilo_bale_showa'];
        $quality_showa = $_POST['quality_showa'];
        $weight_showa = $_POST['weight_showa'];
        $bale_num_showa = $_POST['bale_num_showa'];
        $excess_showa = $_POST['excess_showa'];
    
        $kilo_bale_dunlop = $_POST['kilo_bale_dunlop'];
        $quality_dunlop = $_POST['quality_dunlop'];
        $weight_dunlop = $_POST['weight_dunlop'];
        $bale_num_dunlop = $_POST['bale_num_dunlop'];
        $excess_dunlop = $_POST['excess_dunlop'];
    
        $kilo_bale_crown = $_POST['kilo_bale_crown'];
        $quality_crown = $_POST['quality_crown'];
        $weight_crown = $_POST['weight_crown'];
        $bale_num_crown = $_POST['bale_num_crown'];
        $excess_crown = $_POST['excess_crown'];
    
        $kilo_bale_spr = $_POST['kilo_bale_spr'];
        $quality_spr = $_POST['quality_spr'];
        $weight_spr = $_POST['weight_spr'];
        $bale_num_spr = $_POST['bale_num_spr'];
        $excess_spr = $_POST['excess_spr'];
    


        $query = "UPDATE `planta_recording` SET `status`='Pressing',`pressing_date`='$date',
        `bale_total_kilo`='$bales_weight',`bale_excess`='$bale_excess',drc='$drc',bale_no='$bale_num'
        WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  
            header("Location: ../recording.php?tab=4");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }




?>