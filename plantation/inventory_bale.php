<?php
include 'include/header.php';
include 'include/navbar.php';

plantation_shell_open('Bales Record', 'Produced bale inventory and cost breakdown', [$locDisplay ?: 'Plantation']);
?>

<?php adm_panel_open('Bale Produced Record'); ?>
<?php include 'bales_inventory/basilan.inventory.php'; ?>
<?php adm_panel_close(); ?>

<style>
    .bales-column { background-color: rgb(230, 236, 245) !important; font-weight: bold; }
    .remaining-column { background-color: rgb(245, 230, 236) !important; font-weight: bold; }
    .plantation-loading {
        position: fixed;
        inset: 0;
        z-index: 2000;
        background: rgba(15, 23, 42, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<script src="js/plantation-bale-record.js?v=<?php echo filemtime(__DIR__ . '/js/plantation-bale-record.js'); ?>"></script>
<?php plantation_shell_close(); ?>

