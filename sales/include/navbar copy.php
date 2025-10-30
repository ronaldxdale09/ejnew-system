<style>
    /* Dropdown Styles */
    .dropdown {
        position: relative;
        display: block;
    }

    .dropbtn {
        background-color: #1b325f;
        color: black;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .fa-caret-down {
        color: inherit;
    }

    .dropdown-content {
        display: none;
        position: relative;
        background-color: #13264a;
        min-width: 240px;
        z-index: 1;
        color: white;
    }

    .dropdown-content a {
        color: white;
        padding: 15px;
        text-decoration: none;
        display: flex;
    }

    .dropdown-content a:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .link-content {
        display: flex;
    }

    .icon-wrapper {
        margin-right: 6px;
        display: inline-block;
    }
</style>
<?php $loc = str_replace(' ', '', $_SESSION['loc']); ?>
<nav id='navbar'>
    <div id='toggle-nav-btn'>
        <i class='fa-solid fa-ellipsis'></i>
    </div>
    <div class='nav-title' style='font-weight:bold;'>
        <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>General Ledger</span>
    </div>

    <?php if (strcasecmp(trim($loc), 'Zamboanga') != 0) : ?>

        <hr style='color:gray'>


        <a class='nav-link' href='dashboard.php'>
            <i class='fa-solid fa-home'></i> <span class='nav-text'>Dashboard</span>
        </a>


        <hr style='color:white'>

        <div class="dropdown">
            <a class="dropbtn nav-link" id='dropbtnCoffee'>
                <span class="icon-wrapper"><i class='fa-solid fa-book'></i></span>
                Coffee
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-content">
                <a href='coffee_sale_record.php'>
                    <span class="icon-wrapper"><i class='fa-solid fa-book'></i></span> Coffee Sale
                </a>
                <a href='coffee_list.php'>
                    <span class="icon-wrapper"><i class='fa-solid fa-book'></i></span> Product List
                </a>
                <a href='coffee_customer.php'>
                    <span class="icon-wrapper"><i class='fa-solid fa-book'></i></span> Manage Customer
                </a>
                <a href='coffee_sale_report.php' hidden>
                    <span class="icon-wrapper"><i class='fa-solid fa-book'></i></span> Sale Report
                </a>
            </div>
        </div>


    <?php endif; ?>


    <hr style='color:white'>

    <a class='nav-link' href='ledger-expense.php'>
        <i class='fa-solid fa-money'></i> <span class='nav-text'>Expenses</span>
    </a>

    <?php if (strcasecmp(trim($loc), 'Zamboanga') != 0) : ?>
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

    <?php endif; ?>

    <a class='nav-link' href='expense_report.php'>
        <i class='fa-solid fa-money'></i> <span class='nav-text'>Expense Report</span>
    </a>
    <?php if (strcasecmp(trim($loc), 'Zamboanga') != 0) : ?>

        <a class='nav-link' href='purchase_report.php'>
            <i class='fa-solid fa-comment-dollar'></i> <span class='nav-text'>Purchase Report</span>
        </a>

    <?php endif; ?>

    <div class='logout-container'>
        <span class='nav-text'></span>
        <a class='nav-link logout' href='function/logout.php'>
            <i class='fa-solid fa-arrow-right-to-bracket'></i>
        </a>
    </div>
</nav>
<script src='assets/js/navbar.js'></script>

<script>
    // Function to toggle the dropdown
    function toggleDropdown(id) {
        var dropdownContent = document.getElementById(id).nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        // Save the state to localStorage
        localStorage.setItem('expandedDropdown', dropdownContent.style.display === 'block' ? id : '');
    }

    document.getElementById('dropbtnCoffee').addEventListener('click', function() {
        toggleDropdown('dropbtnCoffee');
    });


    // On page load, check the localStorage to see if a dropdown should be expanded
    window.onload = function() {
        var expandedDropdown = localStorage.getItem('expandedDropdown');
        if (expandedDropdown) {
            toggleDropdown(expandedDropdown);
        }
    };
</script>