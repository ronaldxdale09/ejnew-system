<?php 
include('../../function/db.php');

if (isset($_POST['new'])) {
    $date = $_POST['date'];
    $seller = $_POST['name'];
    $address = $_POST['address'];
    $price = str_replace(',', '', $_POST['price']);
    $net = str_replace(',', '', $_POST['net']);
    $cash_advance = str_replace(',', '', $_POST['cash_advance']);
    
    $recorded_by = $_POST['recorded_by'];
    $type = 'DRY';
    $loc = $_SESSION["loc"];



    // Debugging: Echo all data
    echo "Date: " . $date . "<br>";
    echo "Recorded by: " . $recorded_by . "<br>";
    echo "Type: " . $type . "<br>";
    echo "Location: " . $loc . "<br>";

    $query = "INSERT INTO dry_price_transfer (date, seller, address, net,price,cash_advance,planta_status,recorded_by,loc,type) 
              VALUES ('$date', '$seller', '$address', '$net', '$price', '$cash_advance', '1', '$recorded_by', '$loc','DRY')";
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../dry_receiving_record.php");
        $_SESSION['dry_success'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}
    
    if (isset($_POST['update'])) {
        $dry_id = $_POST['dry_id'];  // Assuming 'dry_id' is passed from the form
        $date = $_POST['date'];
        $seller = $_POST['name'];
        $address = $_POST['address'];
        $price = str_replace(',', '', $_POST['price']);
        $net = str_replace(',', '', $_POST['net']);
        $cash_advance = str_replace(',', '', $_POST['cash_advance']);
        $recorded_by = $_POST['recorded_by'];
        $type = 'DRY';
        $loc = $_SESSION["loc"];
    
        // Debugging: Echo all data
        echo "Dry ID: " . $dry_id . "<br>";
        echo "Date: " . $date . "<br>";
        echo "Recorded by: " . $recorded_by . "<br>";
        echo "Type: " . $type . "<br>";
        echo "Location: " . $loc . "<br>";
    
        $query = "UPDATE dry_price_transfer 
                  SET date = '$date', seller = '$seller', address = '$address', net = '$net', price = '$price', cash_advance = '$cash_advance', planta_status = '1', recorded_by = '$recorded_by', loc = '$loc', type = 'DRY' 
                  WHERE dry_id = '$dry_id'";
        $results = mysqli_query($con, $query);
    
        if ($results) {
            header("Location: ../dry_receiving_record.php");
            $_SESSION['dry_update'] = "successful";
            exit();
        } else {
            echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
        }
    }
    if (isset($_POST['delete'])) {
        $dry_id = $_POST['dry_id'];  // Assuming 'dry_id' is passed from the form
    
        // Debugging: Echo dry_id
        echo "Dry ID to delete: " . $dry_id . "<br>";
    
        $query = "DELETE FROM dry_price_transfer WHERE dry_id = '$dry_id'";
        $results = mysqli_query($con, $query);
    
        if ($results) {
            header("Location: ../dry_receiving_record.php");
            $_SESSION['message'] = "Record successfully deleted";
            exit();
        } else {
            echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
        }
    }
?>