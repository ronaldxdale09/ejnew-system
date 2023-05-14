<?php

    echo "
    <nav id='navbar'>
        <div id='toggle-nav-btn'>
            <i class='fa-solid fa-ellipsis'></i>
        </div>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>General Ledger</span>
        </div>";
     if($_SESSION['type'] == 'finance'){
    echo "
             <hr style='color:white'>
        <a class='nav-link' href='dashboard.php'>
             <i class='fa-solid fa-home'></i> <span class='nav-text'>Dashboard</span>
         </a>
         <hr style='color:white'>
        <a class='nav-link' href='ledger-expense.php'>
            <i class='fa-solid fa-money'></i> <span class='nav-text'>Expenses</span>
        </a>


        <a class='nav-link' href='ledger-purchase.php'>
            <i class='fa-solid fa-comment-dollar'></i> <span class='nav-text'>Purchases</span>
        </a>

        <a class='nav-link' href='ledger-ca.php'>
            <i class='fa-solid fa-address-book'></i> <span class='nav-text'>Cash Advance</span>
        </a>
        
        <a class='nav-link' href='ledger-maloong.php'>
        <i class='fa-solid fa-book'></i> <span class='nav-text'>Maloong Toppers</span>
    </a>
    <a class='nav-link' href='ledger-buahan.php'>
    <i class='fa-solid fa-archive'></i> <span class='nav-text'>Buahan Toppers</span>
</a>
<hr style='color:white'>

<a class='nav-link' href='expense_report.php'>
<i class='fa-solid fa-money'></i> <span class='nav-text'>Expense Report</span>
</a>
<a class='nav-link' href='purchase_report.php'>
<i class='fa-solid fa-comment-dollar'></i> <span class='nav-text'>Purchase Report</span>
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