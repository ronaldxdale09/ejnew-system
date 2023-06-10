<?php 
    include('db.php');
    if (isset($_POST['new'])) {

        $container_no = $_POST['container_no'];
        $withdrawal_date = $_POST['n_date'];
        $quality = $_POST['quality'];
        $kilo_bale = $_POST['kilo_bale'];
        $remarks = $_POST['remarks'];
        $recorded = $_POST['recorded'];
        $van_no = $_POST['van_no'];
        // Creating the SQL query
        $query = "INSERT INTO container_record (container_no, withdrawal_date, quality, kilo_bale, remarks, recorded_by,status,van_no) 
                                VALUES ('$container_no', '$withdrawal_date', '$quality', '$kilo_bale', '$remarks', '$recorded', 'Draft','$van_no')";

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

        $sql = "UPDATE container_record SET 
        status = 'In Progress'
        WHERE container_id = '$id'";
        mysqli_query($con, $sql);

        header("Location: ../container.php?id=$id");  // Change this to your desired location
            exit();
        
    }

    if (isset($_POST['void'])) {

        $id = $_POST['id'];
        echo $id;

       $sql = "UPDATE container_record SET 
       status = 'Void'
       WHERE container_id = '$id'";
       mysqli_query($con, $sql);

       header("Location: ../container_record.php");  // Change this to your desired location
           exit();
            
        }


   if (isset($_POST['released'])) {

    $id = $_POST['id'];
    echo $id;

   $sql = "UPDATE container_record SET 
   status = 'Released'
   WHERE container_id = '$id'";
   mysqli_query($con, $sql);

   header("Location: ../container_record.php");  // Change this to your desired location
       exit();
   
}

   
?>