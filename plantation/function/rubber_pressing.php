<?php
    include('db.php');
    
    // UPDATE PRESSING
    if (isset($_POST['pressing_update'])) {
        $id = $_POST['recording_id'];


          // Delete all existing rows with this recording_id
          $deleteSql = "DELETE FROM planta_bales_production WHERE recording_id = '$id'";
          if (!mysqli_query($con, $deleteSql)) {
              die('Error deleting old data: ' . mysqli_error($con));
          }



        $type = $_POST['type'];
    
        $entry_weight = str_replace(',', '', $_POST['entry_weight']);
    
        $total_weight = 0;
    
        foreach ($type as $index => $bales_type) {
            $kilo_bale = isset($_POST['kilo_bale'][$index]) ? floatval(str_replace(',', '', $_POST['kilo_bale'][$index])) : 0;
            $weight = isset($_POST['weight'][$index]) ? floatval(str_replace(',', '', $_POST['weight'][$index])) : 0;
            $bale_num = isset($_POST['bale_num'][$index]) ? floatval(str_replace(',', '', $_POST['bale_num'][$index])) : 0;
            $excess = isset($_POST['excess'][$index]) ? floatval(str_replace(',', '', $_POST['excess'][$index])) : 0;
            
            $description = $_POST['description'][$index];

            
            if ($kilo_bale == 0 || $weight == 0 || $bale_num == 0) {
                continue; // Skip this iteration if kilo_bale, weight, or bale_num is zero
            }

        
            if ($kilo_bale == 0) {
                $kilo_bale = 0;
                $weight = 0;
                $bale_num = 0;
                $excess = 0;
            }
            
            $total_weight += $weight;
            
            // Debugging data
            echo "Debugging data: <br>";
            echo "bales_type: $bales_type <br>";
            echo "kilo_bale: $kilo_bale <br>";
            echo "weight: $weight <br>";
            echo "bale_num: $bale_num <br>";
            echo "excess: $excess <br>";
            echo "------------------------- <br>";
                
                    // Insert SQL query
            $sql = "INSERT INTO planta_bales_production (recording_id, bales_type, kilo_per_bale, rubber_weight, description, number_bales, bales_excess,status)
            VALUES ('$id', '$bales_type', '$kilo_bale', '$weight', '$description', '$bale_num', '$excess','Produced')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
            die('Error inserting data: ' . mysqli_error($con));
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