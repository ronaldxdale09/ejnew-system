<?php

    echo "
    <nav id='navbar'>
        <div id='toggle-nav-btn'>
            <i class='fa-solid fa-ellipsis'></i>
        </div>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN Copra</span>
        </div>";

        if($_SESSION['type'] == 'copra'){
         echo "
         <br>
        <a class='nav-link' href='dashboard.php'>
            <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
        </a>
        <hr style='color:gray'>
        <a class='nav-link' href='Transaction.php'>
            <i class='fa-solid fa-cash-register'></i> <span class='nav-text'>New Purchase</span>
        </a>
        <a class='nav-link' href='transaction_history.php'>
        <i class='fa-solid fa-book'></i> <span class='nav-text'>Purchase Record</span>
        </a>
        <a class='nav-link' href='contract-purchase.php'>
            <i class='fa-solid fa-boxes-stacked'></i> <span class='nav-text'>Purchase Contract</span>
        </a>

        <a class='nav-link' href='copra-ca.php'>
        <i class='fa-solid fa-money'></i> <span class='nav-text'>Cash Advance</span>
        </a>
        
        <hr style='color:gray'>
        
        <a class='nav-link' href='seller.php'>
        <i class='fa-solid fa-user'></i> <span class='nav-text'>Seller</span>
        </a>
            
        ";
        
        }  if($_SESSION['type'] == 'finance'){
        echo "
             <hr style='color:gray'>
        <a class='nav-link' href='ledger-expense.php'>
            <i class='fa-solid fa-money'></i> <span class='nav-text'>Expenses</span>
        </a>

        <a class='nav-link' href='ledger-purchase.php'>
            <i class='fa-solid fa-comment-dollar'></i> <span class='nav-text'>Purchases</span>
        </a>

        <a class='nav-link' href='ledger-cashadvance.php'>
            <i class='fa-solid fa-address-book'></i> <span class='nav-text'>Cash Advance</span>
        </a>
        
        <a class='nav-link' href='ledger-maloong.php'>
        <i class='fa-solid fa-book'></i> <span class='nav-text'>Maloong Toppers</span>
        </a>
        <a class='nav-link' href='ledger-buahan.php'>
        <i class='fa-solid fa-archive'></i> <span class='nav-text'>Buahan Toppers</span>
        </a>
        
        ";
        }
    echo "
    <div class='logout-container'>
        <a class='nav-text' href='function/logout.php'>
            <i class='fa-solid fa-arrow-right-to-bracket'></i>
            <span class='nav-text'>Logout </span>
        </a>
    </div>
    </nav>
    <script src='assets/js/navbar.js'></script>";
?>