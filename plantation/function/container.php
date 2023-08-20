<?php
include('../../function/db.php');
if (isset($_POST['new'])) {
    $loc = str_replace(' ', '', $_SESSION['loc']);
    $container_no = $_POST['container_no'];
    $withdrawal_date = $_POST['n_date'];
    $quality = $_POST['quality'];
    $kilo_bale = $_POST['kilo_bale'];
    $remarks = $_POST['remarks'];
    $recorded = $_POST['recorded'];
    $van_no = $_POST['van_no'];
    // Creating the SQL query
    $query = "INSERT INTO bales_container_record (container_no, withdrawal_date, quality, kilo_bale, remarks, recorded_by,status,van_no,source) 
                                VALUES ('$container_no', '$withdrawal_date', '$quality', '$kilo_bale', '$remarks', '$recorded', 'Draft','$van_no','$loc')";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../container.php?id=$last_id");  // Change this to your desired location
        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}
if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    echo $id;

    $sql = "SELECT * FROM bales_container_record WHERE container_id  = '$id'";
    $result = mysqli_query($con, $sql);
    $record = mysqli_fetch_assoc($result);

    $currentStatus = $record['status'];

    if ($currentStatus !== 'Sold-Update' && $currentStatus !== 'Release' && $currentStatus !== 'Complete' && $currentStatus !== 'Sold' && $currentStatus !== 'Awaiting Release') {
        $sql = "UPDATE bales_container_record SET 
        status = 'In Progress'
        WHERE container_id = '$id'";
        mysqli_query($con, $sql);

        header("Location: ../container.php?id=$id");  // Change this to your desired location
        exit();
    } elseif ($currentStatus == 'Sold-Update') {
        $sql = "UPDATE bales_container_record SET 
            status = 'Sold-Update'
            WHERE container_id = '$id'";
        mysqli_query($con, $sql);

        header("Location: ../container.php?id=$id");  // Change this to your desired location
    } else {
        if ($currentStatus === 'Sold' || $currentStatus === 'Sold-Update') {
            $sql = "UPDATE bales_container_record SET 
                status = 'Sold-Update'
                WHERE container_id = '$id'";
            mysqli_query($con, $sql);
        } else {
            $sql = "UPDATE bales_container_record SET 
            status = 'In Progress'
            WHERE container_id = '$id'";
            mysqli_query($con, $sql);
        }
        header("Location: ../container.php?id=$id");  // Change this to your desired location
    }
}

if (isset($_POST['void'])) {

    $id = $_POST['id'];
    echo $id;

    $sql = "UPDATE bales_container_record SET 
       status = 'Void'
       WHERE container_id = '$id'";
    mysqli_query($con, $sql);

    header("Location: ../container_record.php");  // Change this to your desired location
    exit();
}


if (isset($_POST['released'])) {

    $id = $_POST['id'];
    echo $id;

    $sql = "UPDATE bales_container_record SET 
   status = 'Released'
   WHERE container_id = '$id'";
    mysqli_query($con, $sql);

    header("Location: ../container_record.php");  // Change this to your desired location
    exit();
}
