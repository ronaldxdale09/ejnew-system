<?php
include('include/header.php');
include 'include/navbar.php';
?>

<link rel="stylesheet" href="css/statistic-card.css">

<?php adm_ops_shell_open(); ?>

<?php
adm_ops_tabs_open('baleRecordTabs', [
    ['id' => 'tab-basilan', 'label' => 'Basilan Records', 'icon' => 'book', 'panel' => 'content-1'],
    ['id' => 'tab-kidapawan', 'label' => 'Kidapawan Records', 'icon' => 'book', 'panel' => 'content-2'],
], 'tab-basilan', 'Bales production records by location');

adm_ops_tab_begin('content-1');
include 'bales_inventory/basilan.record.php';
adm_ops_tab_end();

adm_ops_tab_begin('content-2');
include 'bales_inventory/kidapawan.record.php';
adm_ops_tab_end();

adm_ops_tabs_close();
?>

</div>
</body>
</html>
