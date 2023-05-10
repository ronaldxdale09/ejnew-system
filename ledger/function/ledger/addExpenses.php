<?php
include('../db.php');

function removeCharacters($string)
{
    $string = preg_replace('/[^0-9]/', '', $string);
    return $string;
}

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $vouch = removeCharacters($_POST['voucher']);
    $particular = $_POST['particulars'];
    $category = $_POST['category'];
    $modetransac = $_POST['modeTransact'];
    $remark = $_POST['remarks'];
    $amount = str_replace(',', '', $_POST['amount']);

    // Check if the selected category already exists in the database
    $id = null;
    if (!empty($category)) {
        $query = "SELECT id FROM category_expenses WHERE category='$category'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
        }
    }

    // Insert the expense into the database
    $query = "INSERT INTO ledger_expenses (date,voucher_no,particulars,category,mode_transact,remarks,amount) 
              VALUES ('$date','$vouch','$particular','$category','$modetransac','$remark','$amount')";
    $results = mysqli_query($con, $query);

    if ($results) {
        header("Location: ../../ledger-expense.php");
        $_SESSION['expenses'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}
?>
