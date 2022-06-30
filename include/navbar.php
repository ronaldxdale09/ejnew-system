<?php

    echo "
    <nav id='navbar'>
        <div id='toggle-nav-btn'>
            <i class='fa-solid fa-ellipsis'></i>
        </div>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN Copra</span>
        </div>
        <hr style='color:gray'>
        <a class='nav-link' href='staff_index.php'>
            <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
        </a>
        <hr style='color:gray'>
        <a class='nav-link' href='Transaction.php'>
            <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>Transaction</span>
        </a>
        <a class='nav-link' href='seller.php'>
            <i class='fa-solid fa-user'></i> <span class='nav-text'>Seller</span>
        </a>
        <a class='nav-link' href='cash-agreement.php'>
            <i class='fa-solid fa-boxes-stacked'></i> <span class='nav-text'>Cash Agreement</span>
        </a>
        ";
    echo "
    <hr style='color:gray'>
        <a class='nav-link' href='ledger.php'>
            <i class='fa-solid fa-book'></i> <span class='nav-text'>General Ledger</span>
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
