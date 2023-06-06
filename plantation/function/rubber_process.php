<?php 
    include('db.php');
    
    //TRANSFER FROM RECEIVING TO MILLING
    if (isset($_POST['milling'])) {
        if (!isset($_POST['recording_id'])) {
            echo "Error: recording_id is not set.";
            exit();
        }
    
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

            header("Location: ../recording.php?tab=4");
            exit();
        } else {  
            echo "ERROR: Could not execute $query. " . mysqli_error($con); 
        }  
    }

    if (isset($_POST['press_transfer'])) {
        $id = $_POST['recording_id'];
    
        // Fetch the prod_type for the given recording_id
        $query_fetch = "SELECT prod_type FROM planta_recording WHERE recording_id='$id'";
        $result = mysqli_query($con, $query_fetch);
    
        if($result){
            $row = mysqli_fetch_assoc($result);
            $prod_type = $row['prod_type'];
    
            // Based on prod_type, decide the status to set
            $status = 'For Sale';  // Default status
            if($prod_type == 'PURCHASE') {
                $status = 'Purchase';
            }
    
            // Update the status
            $query_update = "UPDATE `planta_recording` SET `status`='$status' WHERE recording_id='$id'";
    
            if(mysqli_query($con, $query_update)) {  
                header("Location: ../recording.php?tab=5");
                exit();
            } else {  
                echo "ERROR: Could not execute $query_update. " . mysqli_error($con); 
            }
        } else {
            echo "ERROR: Could not execute $query_fetch. " . mysqli_error($con);
        }
    }
    



?>