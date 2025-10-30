<?php
 include('../../../function/db.php');

function removeCharacters($string)
{
    $string = preg_replace('/[^0-9]/', '', $string);
    return $string;
}

if (isset($_POST['add'])) {
    $date = $_POST['date'];
    $vouch = removeCharacters($_POST['voucher']);
    $particular = $_POST['particular'];
    $category = $_POST['category'];
    $modetransac = $_POST['mode_transaction'];
    $remark = $_POST['remarks'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $amount = str_replace(',', '', $_POST['amount']);
    $less = str_replace(',', '', $_POST['less']);
    $total_amount = str_replace(',', '', $_POST['total_amount']);

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
    $query = "INSERT INTO ledger_expenses (date,voucher_no,particulars,category,mode_transact,remarks,amount,less,total_amount,location,type_expense) 
              VALUES ('$date','$vouch','$particular','$category','$modetransac','$remark','$amount','$less','$total_amount','$location','$type')";
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
