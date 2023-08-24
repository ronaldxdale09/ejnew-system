<?php

$loc = str_replace(' ', '', $_SESSION['loc']);?>
<nav id='navbar'>
    <div id='toggle-nav-btn'>
        <i class='fa-solid fa-ellipsis'></i>
    </div>
    <div class='nav-title' style='font-weight:bold;'>
        <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'>
        <span class='nav-text'>EJN RUBBER</span>


    </div>

    <!-- <hr style='color:gray'> -->
    <!-- <a class='nav-link' href='dashboard.php'>
        <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
    </a> -->

    <hr style='color:gray'>

    <a class='nav-link' href='dry_receiving_record.php'>
        <i class='fa-solid fa-truck'></i> <span class='nav-text'>DRY Receiving</span>
    </a>

    <?php if (strcasecmp(trim($loc), 'Kidapawan') != 0) : ?>
        <a class='nav-link' href='ejn_rubber_record.php'>
            <i class='fa-solid fa-truck'></i> <span class='nav-text'>EJN Rubber</span>
        </a>
    <?php endif; ?>

    <hr style='color:gray'>

    <a class='nav-link' href='cuplumps_purchase_record.php'>
        <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>Cuplump Purchasing</span>
    </a>

    <a class='nav-link' href='bales_purchase_record.php'>
        <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>Bales Purchasing</span>
    </a>

    <hr style='color:gray'>

    <?php if (strcasecmp(trim($loc), 'Kidapawan') != 0) : ?>

        <a class='nav-link' href='inventory_bale.php'>
            <i class='fa-solid fa-cube'></i> <span class='nav-text'>Bale Inventory</span>
        </a>
        <a class='nav-link' href='inv_cuplump.php'>
            <i class='fa-solid fa-tree'></i> <span class='nav-text'>Cuplump Inventory</span>
        </a>
    <?php endif; ?>



    <a class='nav-link' href='contract-purchase.php'>
        <i class='fa-solid fa-boxes-stacked'></i> <span class='nav-text'>Purchase Contract</span>
    </a>

    <a class='nav-link' href='cash-advance.php'>
        <i class='fa-solid fa-money'></i> <span class='nav-text'>Cash Advance</span>
    </a>

    <a class='nav-link' href='seller.php'>
        <i class='fa-solid fa-user'></i> <span class='nav-text'>Sellers</span>
    </a>


    <div class='logout-container'>
        <span class='nav-text'></span>
        <a class='nav-link logout' href='function/logout.php'>
            <i class='fa-solid fa-arrow-right-to-bracket'></i>
        </a>
    </div>
</nav>
<script src='assets/js/navbar.js'></script>