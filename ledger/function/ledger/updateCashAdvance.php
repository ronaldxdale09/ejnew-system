<?php
// updateCashAdvance.php
// Handles updating a cash advance record in the database

include('../../../function/db.php');

if (isset($_POST['submit'])) {
    $id = isset($_POST['my_id']) ? mysqli_real_escape_string($con, $_POST['my_id']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';
    $voucher = isset($_POST['voucher']) ? mysqli_real_escape_string($con, $_POST['voucher']) : '';
    $particular = isset($_POST['particular']) ? mysqli_real_escape_string($con, $_POST['particular']) : '';
    $station = isset($_POST['station']) ? mysqli_real_escape_string($con, $_POST['station']) : '';
    $category = isset($_POST['type']) ? mysqli_real_escape_string($con, $_POST['type']) : '';
    $amount = isset($_POST['amount']) ? str_replace(',', '', $_POST['amount']) : '';

    if ($id && $date && $voucher && $particular && $category && $amount) {
        $query = "UPDATE ledger_cashadvance SET date='$date', voucher='$voucher', customer='$particular', buying_station='$station', category='$category', amount='$amount' WHERE id='$id'";
        $results = mysqli_query($con, $query);
        if ($results) {
           header("Location: ../../ledger-ca.php");
            $_SESSION['ca'] = "updated";
        } else {
            echo "ERROR: Could not execute $query. ".mysqli_error($con);
        }
    } else {
        echo "ERROR: Missing required data.";
    }
}
?>
