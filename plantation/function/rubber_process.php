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

    if (mysqli_query($con, $query)) {
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
    $crumbed_weight = preg_replace("/[^0-9.]/", "", $crumbed_weight);
    $date = $_POST['date'];


    $query = "UPDATE `planta_recording` SET `crumbed_weight`='$crumbed_weight',`milling_date`=NOW() WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../recording.php?tab=2");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}


// TRANSFER MILLING TO DRYING

if (isset($_POST['mil_trans'])) {
    $id = $_POST['recording_id'];


    $entry_weight = $_POST['entry_weight'];
    $crumbed_weight = $_POST['crumbed_weight'];


    // Remove all symbols except period
    $entry_weight = preg_replace("/[^0-9.]/", "", $entry_weight);
    $crumbed_weight = preg_replace("/[^0-9.]/", "", $crumbed_weight);

    // Check if crumbed_weight is zero, empty or null
    if (empty($crumbed_weight) || $crumbed_weight == 0) {
        $crumbed_weight = $entry_weight;
    }




    $query = "UPDATE `planta_recording` SET `crumbed_weight`='$crumbed_weight',`status`='Drying',`production_date`=NOW() WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {
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
    $dry_weight = preg_replace("/[^0-9.]/", "", $dry_weight);

    $date = $_POST['date'];


    $query = "UPDATE `planta_recording` SET `dry_weight`='$dry_weight',`drying_date`=NOW() WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {
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


    $entry_weight = $_POST['entry_weight'];
    $crumbed_weight = $_POST['crumbed_weight'];
    $dry_weight = $_POST['dry_weight'];


    // Remove all symbols except period
    $entry_weight = preg_replace("/[^0-9.]/", "", $entry_weight);
    $crumbed_weight = preg_replace("/[^0-9.]/", "", $crumbed_weight);
    $dry_weight = preg_replace("/[^0-9.]/", "", $dry_weight);

    // Check if crumbed_weight and dry_weight are zero, empty or null
    if ((empty($crumbed_weight) || $crumbed_weight == 0) && (empty($dry_weight) || $dry_weight == 0)) {
        $dry_weight = $entry_weight;
    } else if ((empty($dry_weight) || $dry_weight == 0) && (!empty($crumbed_weight) && $crumbed_weight != 0)) {
        // If dry_weight is zero or empty and crumbed_weight has value
        $dry_weight = $crumbed_weight;
    }




    $query = "UPDATE `planta_recording` SET `dry_weight`='$dry_weight',`status`='Pressing',`pressing_date`=NOW()
        WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {

        header("Location: ../recording.php?tab=4");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}

if (isset($_POST['press_transfer'])) {
    $id = $_POST['recording_id'];

    // Fetch the prod_type for the given recording_id
    $query_fetch = "SELECT prod_type,produce_total_weight,production_expense,purchase_cost FROM planta_recording WHERE recording_id='$id'";
    $result = mysqli_query($con, $query_fetch);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $prod_type = $row['prod_type'];
        $unit_cost = 0;


        // Based on prod_type, decide the status to set
        $status = 'For Sale';  // Default status
        if ($prod_type == 'PURCHASE') {
            $status = 'Purchase';
        } else {

            $produce_total_weight = $row['produce_total_weight'];
            $expenses = $row['production_expense'];
            $purchase_cost = $row['purchase_cost'];

            $total_prod_cost = $purchase_cost + $expenses;
            $unit_cost = $total_prod_cost / $produce_total_weight;

            $status = 'For Sale';
        }

        // Update the status
        $query_update = "UPDATE `planta_recording` SET 
        bales_average_cost='$unit_cost',`status`='$status' WHERE recording_id='$id'";

        if (mysqli_query($con, $query_update)) {
            header("Location: ../recording.php?tab=5");
            exit();
        } else {
            echo "ERROR: Could not execute $query_update. " . mysqli_error($con);
        }
    } else {
        echo "ERROR: Could not execute $query_fetch. " . mysqli_error($con);
    }
}


if ($_POST['action'] == 'dry_milling') {

    $id = $_POST['recording_id'];

    $query = "UPDATE `planta_recording` SET `status`='Milling' WHERE recording_id='$id'";

    if (mysqli_query($con, $query)) {
        header("Location: ../recording.php?tab=2");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
