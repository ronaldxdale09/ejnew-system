<?php
 include('../../../function/db.php');

function removeCharacters($string)
{
    $string = preg_replace('/[^0-9]/', '', $string);
    return $string;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $vouch = removeCharacters($_POST['voucher']);
    $particular = $_POST['particular'];
    $category = $_POST['category'];
    $modetransac = $_POST['mode_transaction'];
    $remark = $_POST['remarks'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $amount = str_replace(',', '', $_POST['amount']);

    $category = $_POST['category'];

    // Update the expense in the database
    $query = "UPDATE ledger_expenses SET 
              date='$date', 
              voucher_no='$vouch', 
              particulars='$particular', 
              category='$category', 
              mode_transact='$modetransac', 
              remarks='$remark', 
              amount='$amount', 
              location='$location', 
              type_expense='$type' 
              WHERE id = $id";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../../ledger-expense.php");
        $_SESSION['expenses'] = "Update successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}
?>
