<nav id='navbar'>
    <div id='toggle-nav-btn'>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span
                class='nav-text'>EJN RUBBER</span>
        </div>
    </div>

    <br>

    <a class='nav-link' href='dashboard.php'>
        <i class='fas fa-home'></i> <span class='nav-text'>Home</span>
    </a>

    <a class='nav-link' href='expense_report.php'>
        <i class='fas fa-money'></i> <span class='nav-text'>Expense Report</span>
    </a>

    <a class='nav-link' href='purchase_report.php'>
        <i class='fas fa-cash-register'></i> <span class='nav-text'>Purchase Report</span>
    </a>

    <hr style='color:gray'>


    <!-- First Dropdown -->
    <a class='dropbtn' type="button" id="balesDropdownBtn"
        onclick="toggleDropdown('balesDropdownBtn', 'balesDropdownContent')">
        <i class='fas fa-cube'></i> <span class='nav-text'>Bales</span><i class="fa fa-caret-down"></i>
    </a>
    <div class='dropdown-content' id="balesDropdownContent">
        <a class='nav-link' href='bale_sale_record.php'>
            <i class='fas fa-chart-line'></i> <span class='nav-text'>Bales Sales Record</span>
        </a>
        <a class='nav-link' href='bale_shipment_record.php'>
            <i class='fa-solid fa-ship'></i> <span class='nav-text'>Bale Shipment</span>
        </a>
        <a class='nav-link' href='inv_bale.php'>
            <i class='fas fa-cube'></i> <span class='nav-text'>Bale Inventory</span>
        </a>
    </div>

    <hr style='color:gray'>

    <!-- Second Dropdown -->
    <a class='dropbtn' type="button" id="cuplumpsDropdownBtn"
        onclick="toggleDropdown('cuplumpsDropdownBtn', 'cuplumpsDropdownContent')">
        <i class='fas fa-tree'></i> <span class='nav-text'>Cuplumps</span><i class="fa fa-caret-down"></i>
    </a>
    <div class='dropdown-content' id="cuplumpsDropdownContent">
        <a class='nav-link' href='inv_cuplump.php'>
            <i class='fas fa-tree'></i> <span class='nav-text'>Cuplump Inventory</span>
        </a>
        <a class='nav-link' href='container_record.php'>
            <i class='fas fa-shipping-fast'></i> <span class='nav-text'>Container Record</span>
        </a>
        <a class='nav-link' href='record_allrubber.php'>
            <i class='fas fa-file-alt'></i> <span class='nav-text'>Transaction Record</span>
        </a>
    </div>


    <!-- 
    <a class='nav-link' href='admin_kidapawan_rubber.php'>
        <i class='fas fa-cube'></i> <span class='nav-text'>Kidapawan Rubber</span>
    </a> -->

    <!-- <a class='nav-link'>
        <i class='fas fa-tree'></i> <span class='nav-text'>Copra</span>
    </a>

    <a class='nav-link'>
        <i class='fas fa-coffee'></i> <span class='nav-text'>Coffee</span>
    </a> -->

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

</nav>
<script src='assets/js/navbar.js'></script>


<script>
    // Get all dropdown buttons
    const dropdownButtons = document.querySelectorAll('.dropbtn');

    // Loop through each dropdown button to attach click event
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the associated dropdown content
            const content = this.nextElementSibling;

            // Toggle active class on button
            this.classList.toggle("active");

            // Toggle show/hide dropdown content
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    });
</script>