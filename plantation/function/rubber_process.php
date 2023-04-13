<?php 
    include('db.php');
    
    //TRANSFER FROM RECEIVING TO MILLING
    if (isset($_POST['milling'])) {
        $id = $_POST['recording_id'];
        $query = "UPDATE `planta_recording` SET `status`='Milling',`milling_date`=NOW() WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  
            header("Location: ../recording.php?tab=2");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }



// UPDATE CRUMBED WEIGHT IN MILLING
    if (isset($_POST['milling_update'])) {
        $id = $_POST['recording_id'];
        $crumbed_weight = $_POST['crumbed_weight'];
        $date = $_POST['date'];


        $query = "UPDATE `planta_recording` SET `crumbed_weight`='$crumbed_weight',`milling_date`=NOW() WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  
            header("Location: ../recording.php?tab=2");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }


// TRANSFER MILLING TO DRYING

    if (isset($_POST['mil_trans'])) {
        $id = $_POST['recording_id'];
        $query = "UPDATE `planta_recording` SET `status`='Drying',`production_date`=NOW() WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  
            header("Location: ../recording.php?tab=3");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }


    // DRYING


    // UPDATE DRY WEIGHT IN MILLING
    if (isset($_POST['dry_update'])) {
        $id = $_POST['recording_id'];
        $dry_weight = $_POST['dry_weight'];
        $date = $_POST['date'];


        $query = "UPDATE `planta_recording` SET `dry_weight`='$dry_weight',`drying_date`=NOW() WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  
            header("Location: ../recording.php?tab=3");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }


    // TRANSFER  DRYING TO PRESSING

    if (isset($_POST['dry_transfer'])) {
        $id = $_POST['recording_id'];

        $kilo_bale = $_POST['kilo_bale'];
        $quality = $_POST['quality'];


        $query = "UPDATE `planta_recording` SET `status`='Pressing',`pressing_date`=NOW()
        WHERE recording_id='$id'";
                             
        if(mysqli_query($con, $query)) {  


            // Define an array of rubber types
        $rubberTypes = ['Manhattan', 'Showa', 'Dunlop', 'Crown', 'SPR10'];

        // Loop over the rubber types and insert the data into the database
        foreach ($rubberTypes as $type) {
            // Set the default values to 0
            $kilo_bale = 0;
            $weight = 0;
            $bale_num = 0;
            $excess = 0;

            // Insert the data into the database using the appropriate SQL statement
            $sql = "INSERT INTO planta_bales_production (recording_id, bales_type, kilo_per_bale, rubber_weight, number_bales, bales_excess, status) 
                    VALUES ('$id', '$type', '$kilo_bale', '$weight', '$bale_num', '$excess', 'Production')";

            // Execute the SQL statement
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error inserting data: ' . mysqli_error($con));
            }
        }





            header("Location: ../recording.php?tab=4");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }



?>