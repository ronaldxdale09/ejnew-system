<?php

    echo "
    <nav id='navbar'>
        <div id='toggle-nav-btn'>
            <i class='fa-solid fa-ellipsis'></i>
        </div>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN Copra</span>
        </div>
        <a class='nav-link' href='staff_index.php'>
            <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
        </a>
        <a class='nav-link' href='Transaction.php'>
            <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>Transaction</span>
        </a>
        <a class='nav-link' href='sales.php'>
            <i class='fa-solid fa-coins'></i> <span class='nav-text'>Sales</span>
        </a>
        <a class='nav-link' href='inventory.php'>
            <i class='fa-solid fa-boxes-stacked'></i> <span class='nav-text'>Inventory</span>
        </a>
        ";
    echo "
        <a class='nav-link' href='reg_prod/index.php'>
            <i class='fa-solid fa-boxes-packing'></i> <span class='nav-text'>Register Product</span>
        </a>
        <a class='nav-link' href='store.php'>
            <i class='fa-solid fa-cart-shopping'></i> <span class='nav-text'>Cart Mode</span>
        </a>
        <div class='logout-container'>
            <span class='nav-text'></span>
            <a class='nav-link logout' href='function/logout.php'>
                <i class='fa-solid fa-arrow-right-to-bracket'></i>
            </a>
        </div>
    </nav>
    <script src='assets/js/navbar.js'></script>";
?>
