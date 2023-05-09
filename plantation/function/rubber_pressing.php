<?php
  include('db.php');
    

    // UPDATE PRESSING

    if (isset($_POST['pressing_update'])) {
        $id = $_POST['recording_id'];
        $type = $_POST['type'];
    
        $entry_weight = str_replace(',', '', $_POST['entry_weight']);
    
        $total_kilo_bale = 0;
        $total_weight = 0;
        $total_bale_num = 0;
        $total_excess = 0;
        $total_weight = 0;
    
        foreach ($type as $index => $bales_type) {
            $formatted_bales_type = str_replace(['-', ' '], '_', $bales_type);
            $kilo_bale = str_replace(',', '', $_POST['kilo_bale_' . $formatted_bales_type]);
            $weight = str_replace(',', '', $_POST['weight_' . $formatted_bales_type]);
            $bale_num = str_replace(',', '', $_POST['bale_num_' . $formatted_bales_type]);
            $excess = str_replace(',', '', $_POST['excess_' . $formatted_bales_type]);
            $description = $_POST['description'][$index];
        
            if ($kilo_bale == 0) {
                $kilo_bale = 0;
                $weight = 0;
                $bale_num = 0;
                $excess = 0;
            }
    
            // $kilo_bale = preg_replace('/[^0-9.]/', '', $kilo_bale);
            // $weight = preg_replace('/[^0-9.]/', '', $weight);
            // $bale_num = preg_replace('/[^0-9.]/', '', $bale_num);
            // $excess = preg_replace('/[^0-9.]/', '', $excess);
            
            $total_kilo_bale += $kilo_bale;
            $total_weight += $weight;
            $total_bale_num += $bale_num;
            $total_excess += $excess;
            
    
            echo "Debugging data: <br>";
            echo "bales_type: $bales_type <br>";
            echo "kilo_bale: $kilo_bale <br>";
            echo "weight: $weight <br>";
            echo "bale_num: $bale_num <br>";
            echo "excess: $excess <br>";
            echo "------------------------- <br>";
    
           // Commenting out the SQL query
            $sql = "UPDATE planta_bales_production SET kilo_per_bale='$kilo_bale', rubber_weight='$weight',
            description='$description',number_bales='$bale_num', bales_excess='$excess' WHERE recording_id='$id' AND bales_type='$bales_type'";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error updating data: ' . mysqli_error($con));
            }
        }
   
    
        echo "Total weight: " . $total_weight;

        $rubber_drc = ($total_weight / $entry_weight) * 100;

        


        $query = "UPDATE `planta_recording` SET `drc`='$rubber_drc', `produce_total_weight`='$total_weight'
        WHERE recording_id='$id'";
        $result = mysqli_query($con, $query);
        header("Location: ../recording.php?tab=4");
    }
    




?>