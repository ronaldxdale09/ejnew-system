<?php
  include('db.php');
    

    // UPDATE PRESSING

    if (isset($_POST['pressing_update'])) {
        $id = $_POST['recording_id'];
        $type = $_POST['type'];
    
        $entry_weight = $_POST['entry_weight'];
        $drc = $_POST['drc'];


        $total_kilo_bale = 0;
        $total_weight = 0;
        $total_bale_num = 0;
        $total_excess = 0;

        $total_weight = 0;

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'kilo_bale') !== false) {
                $bales_type = str_replace('kilo_bale_', '', $key);
                $kilo_bale = $value;
                $weight = $_POST['weight_'.$bales_type];
                $bale_num = $_POST['bale_num_'.$bales_type];
                $excess = $_POST['excess_'.$bales_type];
        
                if ($kilo_bale == 0) {
                    $kilo_bale = 0;
                    $weight = 0;
                    $bale_num = 0;
                    $excess = 0;
                }
        
                $total_kilo_bale += $kilo_bale;
                $total_weight += $weight;
                $total_bale_num += $bale_num;
                $total_excess += $excess;
        
                $sql = "UPDATE planta_bales_production SET kilo_per_bale='$kilo_bale', rubber_weight='$weight', number_bales='$bale_num', bales_excess='$excess' WHERE recording_id='$id' AND bales_type='$bales_type'";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    die('Error updating data: ' . mysqli_error($con));
                }
            }
        }
        
        echo "Total weight: " . $total_weight;


        $query = "UPDATE `planta_recording` SET `drc`='$drc', `bale_total_kilo`='$bale_total_kilo'
        WHERE recording_id='$id'";



        header("Location: ../recording.php?tab=4");
    
    }




?>