<?php
include 'include/header.php';
include 'include/navbar.php';
require_once __DIR__ . '/dashboard/data.php';

$query = 'SELECT * FROM ledger_buying_station';
$result = mysqli_query($con, $query);
$buyingStation = '';
while ($array = mysqli_fetch_array($result)) {
    $buyingStation .= '<option value="' . adm_esc($array['name']) . '">' . adm_esc($array['name']) . '</option>';
}

$topperKpis = ledger_topper_kpis($con, 'maloong');

ledger_shell_open('Maloong Toppers', 'Record maloong topper transactions — kilos, rates, and EJN revenue.', ['Finance', 'Toppers']);
include __DIR__ . '/include/topper-kpis.php';
adm_panel_open('Transactions');
include 'ledgerTab/ejn-maloong.php';
adm_panel_close();
?>
<script src="ledgerTab/js/ejn-maloong.js"></script>
<?php include 'modal/modal_maloong.php'; ?>
<?php ledger_shell_close(); ?>
