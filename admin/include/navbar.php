<nav class="navbar">
    <div class="navbar-container">
        <a href="#" class="logo">EN-System</a>

        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href='dashboard.php' class="nav-link">Dashboard</a></li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Expenses <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="basilan.expense.php" class="dropdown-link">Basilan Expenses</a></li>
                    <li><a href="basilan.expense.report.php" class="dropdown-link">Basilan Report</a></li>
                    <li><a href="zam.expense.php" class="dropdown-link">Zamboanga Expenses</a></li>
                    <li><a href="zam.expense.report.php" class="dropdown-link">Zamboanga Report</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Purchases <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="purchase_report.php" class="dropdown-link">Purchases Report</a></li>
                    <li><a href="dry_receiving_record.php" class="dropdown-link">Dry Receiving</a></li>
                    <li><a href="cuplumps_purchase_record.php" class="dropdown-link">Cuplumps Purchasing</a></li>
                </ul>
            </li>

            <li class="nav-item"><a href="sales_reports.php" class="nav-link">Sales Report</a></li>
            <li class="nav-item"><a href="copra_record.php" class="nav-link">Copra Record</a></li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Rubber Plant <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="plant_basilan_recording.php" class="dropdown-link">Basilan Plant</a></li>
                    <li><a href="plant_kid_recording.php" class="dropdown-link">Kidapawan Plant</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Bales <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="inv_bale.php" class="dropdown-link">Inventory</a></li>
                    <li><a href="bale_record.php" class="dropdown-link">Bale Records</a></li>
                    <li><a href="bale_sale_record.php" class="dropdown-link">Bale Sales</a></li>
                    <li><a href="container_record.php" class="dropdown-link">Container</a></li>
                    <li><a href="bale_shipment_record.php" class="dropdown-link">Shipment</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Cuplump <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="inv_cuplump.php" class="dropdown-link">Field Inventory</a></li>
                    <li><a href="cuplump_sale_record.php" class="dropdown-link">Sales</a></li>
                    <li><a href="cuplump_container_record.php" class="dropdown-link">Container</a></li>
                    <li><a href="cuplump_shipment_record.php" class="dropdown-link">Shipment</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">Coffee <i class="fas fa-chevron-down fa-xs"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="coffee_list.php" class="dropdown-link">Inventory</a></li>
                    <li><a href="coffee_production.php" class="dropdown-link">Production</a></li>
                    <li><a href="coffee_sale_record.php" class="dropdown-link">Sales</a></li>
                </ul>
            </li>

            <li class="nav-item button-item">
                <a href='function/logout.php' class="nav-link logout-btn">
                    <i class='fa-solid fa-arrow-right-to-bracket'></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenu = document.getElementById('mobile-menu');
        const navMenu = document.querySelector('.nav-menu');
        const dropdowns = document.querySelectorAll('.has-dropdown');

        // Toggle Mobile Menu
        mobileMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('is-active');
            navMenu.classList.toggle('active');
        });

        // Mobile Dropdown Toggle
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('a');
            link.addEventListener('click', (e) => {
                // If on mobile (or if we want click-to-toggle behavior)
                if (window.innerWidth <= 960) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileMenu.contains(e.target)) {
                navMenu.classList.remove('active');
                mobileMenu.classList.remove('is-active');
            }
        });
    });
</script>