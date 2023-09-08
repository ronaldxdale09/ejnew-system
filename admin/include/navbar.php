<nav id='navbar'>
    <div id='toggle-nav-btn'>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN RUBBER</span>
        </div>
    </div>

    <br>
    <div id="navbar-content">
        <a class='nav-link' href='dashboard.php'>
            <i class='fas fa-home'></i> <span class='nav-text'>Home</span>
        </a>

        <div class="dropdown">
            <a class="dropbtn nav-link" id='dropbtnExpense'>
                <span class="icon-wrapper"><i class='fas fa-money'></i></span>
                <span class="nav-text">Expenses</span>
                <i style='justify-content: right' class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-content">
                <a href='basilan.expense.php'> <span class="icon-wrapper"><i class='fas fa-wallet'></i></span> Basilan Record</a>
                <a href='basilan.expense.report.php'> <span class="icon-wrapper"><i class='fas fa-clipboard'></i></span> Basilan Report</a>
                <a href='zam.expense.php'> <span class="icon-wrapper"><i class='fa-solid fa-ship'></i></span> Zamboanga Record</a>
                <a href='zam.expense.report.php'> <span class="icon-wrapper"><i class='fa-solid fa-ship'></i></span> Zamboanga Report</a>
            </div>

        </div>
        <a class='nav-link' href='copra_record.php'>
            <i class='fas fa-list-alt'></i> <span class='nav-text'>Copra Record</span>
        </a>
        <a class='nav-link' href='purchase_report.php'>
            <i class='fas fa-cash-register'></i> <span class='nav-text'>Purchase Report</span>
        </a>
        <a class='nav-link' href='sales_reports.php'>
            <i class='fa-solid fa-file-alt'></i> <span class='nav-text'>Sales Report</span>
        </a>

        <hr style='color:gray'>

        <div class="dropdown">
            <a class="dropbtn nav-link" id='dropbtnBale'>
                <span class="icon-wrapper"><i class='fas fa-cube'></i></span>
                <span class="nav-text">Bale Record</span>
                <i style='justify-content: right' class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-content">
                <a href='bale_sale_record.php'> <span class="icon-wrapper"><i class='fas fa-chart-line'></i></span> Sales</a>
                <a href='container_record.php'> <span class="icon-wrapper"><i class='fas fa-shipping-fast'></i></span> Container</a>
                <a href='bale_shipment_record.php'> <span class="icon-wrapper"><i class='fa-solid fa-ship'></i></span> Shipment</a>
                <a href='inv_bale.php'><span class="icon-wrapper"><i class='fas fa-cube'></i></span> Inventory</a>
            </div>
        </div>


        <hr style='color:gray'>



        <div class="dropdown">
            <a class="dropbtn nav-link" id='dropbtnCuplump'>
                <span class="icon-wrapper"><i class='fas fa-cube'></i></span>
                <span class="nav-text">Cuplump</span> <i style='justify-content: right' class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-content">
                <a href='cuplump_sale_record.php'> <span class="icon-wrapper"><i class='fas fa-chart-line'></i></span> Sales</a>
                <a href='cuplump_container_record.php'> <span class="icon-wrapper"><i class='fas fa-shipping-fast'></i></span> Container</a>
                <a href='cuplump_shipment_record.php'> <span class="icon-wrapper"><i class='fa-solid fa-ship'></i></span> Shipment</a>
                <a href='inv_cuplump.php'><span class="icon-wrapper"><i class='fas fa-cube'></i></span> Inventory</a>
            </div>
        </div>



        <hr style='color:gray'>

        <a class='nav-link' href='reports.php' hidden>
            <i class='fas fa-file-alt'></i> <span class='nav-text'>Reports</span>
        </a>

        <a class='nav-link' href='admin_users.php'>
            <i class='fas fa-users'></i> <span class='nav-text'>Manage Users</span>
        </a>

        <div class='logout-container'>
            <a class='nav-text' href='function/logout.php'>
                <i class='fa-solid fa-arrow-right-to-bracket'></i>
                <span class='nav-text'>Logout </span>
            </a>
        </div>
    </div>
</nav>

<script>
    // Function to toggle the dropdown
    function toggleDropdown(id) {
        var dropdownContent = document.getElementById(id).nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        // Save the state to localStorage
        localStorage.setItem('expandedDropdown', dropdownContent.style.display === 'block' ? id : '');
    }

    // Event listeners for the dropdown buttons
    document.getElementById('dropbtnBale').addEventListener('click', function() {
        toggleDropdown('dropbtnBale');
    });

    document.getElementById('dropbtnCuplump').addEventListener('click', function() {
        toggleDropdown('dropbtnCuplump');
    });

    document.getElementById('dropbtnExpense').addEventListener('click', function() {
        toggleDropdown('dropbtnExpense');
    });


    // On page load, check the localStorage to see if a dropdown should be expanded
    window.onload = function() {
        var expandedDropdown = localStorage.getItem('expandedDropdown');
        if (expandedDropdown) {
            toggleDropdown(expandedDropdown);
        }
    };
</script>
<script src='assets/js/navbar.js'></script>