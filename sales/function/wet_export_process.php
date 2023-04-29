<?php
include "db.php";
if (isset($_POST["new"])) {
    echo "hello";
    $date = $_POST["date"];
    $recorded_by = $_POST["recorded_by"];

    // $name = $_POST['name'];
    // $address = $_POST['address'];
    // $contact = $_POST['contact'];
    // $loc = $_SESSION['loc'];
    $query = "INSERT INTO sales_cuplumps_rec (sales_date,recorded_by) 
                    VALUES ('$date','$recorded_by')";
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../sales_wet.php?id=$last_id");
        $_SESSION["seller"] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " .
            mysqli_error($con);
    }
    exit();
}

if (isset($_POST["add_inventory"])) {
    echo "hello";
    $date = $_POST["date"];
    $recorded_by = $_POST["recorded_by"];

    // $name = $_POST['name'];
    // $address = $_POST['address'];
    // $contact = $_POST['contact'];
    // $loc = $_SESSION['loc'];
    $query = "INSERT INTO sales_cuplumps_rec (sales_date,recorded_by) 
                            VALUES ('$date','$adrecorded_bydress')";
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../sales_wet.php?id=$last_id");
        $_SESSION["seller"] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " .
            mysqli_error($con);
    }
    exit();
}


?>
