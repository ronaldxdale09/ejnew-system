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
        $expense_desc = $_POST['expense_desc'];
        $expense = $_POST['expense'];
    
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
            echo "expense: $expense <br>";
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
        $rubber_drc = (floatval($total_weight) / floatval($entry_weight)) * 100;

        


        $query_fetch = "SELECT recording_id,purchase_cost,production_expense FROM planta_recording WHERE recording_id='$id'";
        $result = mysqli_query($con, $query_fetch);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $purchase_cost = $row['purchase_cost'];
        

            $total_production_cost = floatval($purchase_cost) + floatval($expense);
            echo "total purchase Cost: $total_production_cost <br>";
        } else {
            echo "Error: Query did not return a result.";
        }

        $query = "UPDATE `planta_recording` SET `drc`='$rubber_drc', `produce_total_weight`='$total_weight',`production_expense`='$expense',`prod_expense_desc`='$expense_desc',
        `total_production_cost` = '$total_production_cost'
        WHERE recording_id='$id'";
       $result = mysqli_query($con, $query);
    
       if ($result) {
        header("Location: ../recording.php?tab=4");
       } else {
           echo "Error updating record: " . mysqli_error($con);
       }

    }
?>