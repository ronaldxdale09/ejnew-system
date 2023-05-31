<?php 
    include('db.php');
    if (isset($_POST['new'])) {

        $container_no = $_POST['container_no'];
        $withdrawal_date = $_POST['n_date'];
        $quality = $_POST['quality'];
        $kilo_bale = $_POST['kilo_bale'];
        $remarks = $_POST['remarks'];
        $recorded = $_POST['recorded'];

        // Creating the SQL query
        $query = "INSERT INTO container_record (container_no, withdrawal_date, quality, kilo_bale, remarks, recorded_by) 
                                VALUES ('$container_no', '$withdrawal_date', '$quality', '$kilo_bale', '$remarks', '$recorded')";

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
?>