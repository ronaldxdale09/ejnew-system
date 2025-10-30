<?php
include('../../function/db.php');
if (isset($_POST['add'])) {

    $van_no = $_POST['van_no'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];
    $recorded = $_POST['recorded_by'];


    $query = "INSERT INTO cuplump_container (van_no,loading_date,remarks,recorded_by,status) 
                                        VALUES ('$van_no','$date','$remarks','$recorded','In Progress')";
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../cuplump_container.php?id=$last_id");
        $_SESSION['contract'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
    exit();
}



if (isset($_POST['edit'])) {
    $id = $_POST['id'] ?? '';


    $query = "UPDATE cuplump_container SET status='In Progress'
      WHERE container_id  = '$id'";

    // Executing the query
    $results = mysqli_query($con, $query);
    header("Location: ../cuplump_container.php?id=$id");

}
