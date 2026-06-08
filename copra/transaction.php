<?php
include 'include/header.php';
include 'include/navbar.php';

if (isset($_GET['view'])) {
    $_SESSION['transaction'] = 'ONGOING';
    $view = $_GET['view'];

    $sql = mysqli_query($con, "SELECT  * from copra_transaction where invoice='$view'  ");
    $record = mysqli_fetch_array($sql);

    $invoiceCount = $record['invoice'];
    $today = $record['date'];

    $contract = "SELECT * FROM copra_contract where status='PENDING' OR status='UPDATED' ";
    $c_result = mysqli_query($con, $contract);
    $contractList = '';
    while ($arr = mysqli_fetch_array($c_result)) {
        $contractList .=
            '
            <option value="' .
            $arr['contract_no'] .
            '">[ ' .
            $arr['contract_no'] .
            ' ]  ' .
            $arr['seller'] .
            '</option>';
    }

    $seller = 'SELECT * FROM copra_seller ';
    $result = mysqli_query($con, $seller);
    $sellerList = '';
    while ($arr = mysqli_fetch_array($result)) {
        $sellerList .=
            '<option value="' .
            $arr['name'] .
            '">[ ' .
            $arr['code'] .
            ' ]      ' .
            $arr['name'] .
            '</option>';
    }
} else {
    $_SESSION['transaction'] = 'ONGOING';

    $contract = "SELECT * FROM copra_contract where status='PENDING' OR status='UPDATED' ";
    $c_result = mysqli_query($con, $contract);
    $contractList = '';
    while ($arr = mysqli_fetch_array($c_result)) {
        $contractList .=
            '
            <option value="' .
            $arr['contract_no'] .
            '">[ ' .
            $arr['contract_no'] .
            ' ]  ' .
            $arr['seller'] .
            '</option>';
    }

    $seller = 'SELECT * FROM copra_seller ';
    $result = mysqli_query($con, $seller);
    $sellerList = '';
    while ($arr = mysqli_fetch_array($result)) {
        $sellerList .=
            '<option value="' .
            $arr['name'] .
            '">[ ' .
            $arr['code'] .
            ' ]      ' .
            $arr['name'] .
            '</option>';
    }

    $invoice = mysqli_query($con, 'SELECT  COUNT(*) from copra_transaction  ');
    $getinvoice = mysqli_fetch_array($invoice);

    $invoiceCount = sprintf("%'03d", $getinvoice[0] + 1);

    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;
}

copra_shell_open('Purchase Entry', 'Copra purchase transaction');
include __DIR__ . '/include/transaction-form.php';
?>

<script type="text/javascript" src="js/copra_transaction.js"></script>
<script type="text/javascript" src="js/transaction_computation.js"></script>

<?php
include 'modal/viewTransactionModal.php';
include 'modal/transactionModal.php';
include 'modal/TransactionModalScript.php';
include 'modal/contractModal.php';
include 'modal/copra/copra_cashadvanceModal.php';
include 'modal/addseller_modal.php';
include 'include/script.php';
?>

<script>
$(function() {
    $('.select_seller').chosen({ search_threshold: 10, width: '100%' });
});
</script>

<?php copra_consume_flashes(); ?>
<?php copra_shell_close(); ?>
