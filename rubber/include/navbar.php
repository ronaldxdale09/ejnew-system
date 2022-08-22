<?php

    echo "
    <nav id='navbar'>
        <div id='toggle-nav-btn'>
            <i class='fa-solid fa-ellipsis'></i>
        </div>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN RUBBER</span>
        </div>";

        if($_SESSION['type'] == 'rubber'){
         echo "
        <hr style='color:gray'>
        <a class='nav-link' href='dashboard.php'>
            <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
        </a>
        <hr style='color:gray'>
        <a class='nav-link' href='wet_rubber.php'>
            <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>WET Rubber</span>
        </a>
        <a class='nav-link' href='bales_rubber.php'>
        <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>Bales Rubber</span>
    </a>
        <a class='nav-link' href='transaction_history.php'>
        <i class='fa-solid fa-book'></i> <span class='nav-text'>Transaction Record</span>
    </a>
        <a class='nav-link' href='seller.php'>
            <i class='fa-solid fa-user'></i> <span class='nav-text'>Seller</span>
        </a>
        <a class='nav-link' href='contract-purchase.php'>
            <i class='fa-solid fa-boxes-stacked'></i> <span class='nav-text'>Purchase Contract</span>
        </a>

        <a class='nav-link' href='cash-advance.php'>
        <i class='fa-solid fa-money'></i> <span class='nav-text'>Cash Advance</span>
    </a>
        ";
        }
    echo "
        <div class='logout-container'>
            <span class='nav-text'></span>
            <a class='nav-link logout' href='function/logout.php'>
                <i class='fa-solid fa-arrow-right-to-bracket'></i>
            </a>
        </div>
    </nav>
    <script src='assets/js/navbar.js'></script>";
?>