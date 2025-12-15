<nav class="navbar">
    <?php
    // Ensure $loc is defined to prevent errors
    $loc = $loc ?? $_SESSION['loc'] ?? '';
    ?>
    <div class="navbar-container">
        <a href="dashboard.php" class="logo">EN-System</a>

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
                    <li><a href="ledger-expense.php" class="dropdown-link">Expense Record</a></li>
                    <li><a href="expense_report.php" class="dropdown-link">Expense Report</a></li>
                </ul>
            </li>

            <?php if (strcasecmp(trim($loc), 'Zamboanga') != 0): ?>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Purchases <i class="fas fa-chevron-down fa-xs"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="ledger-purchase.php" class="dropdown-link">Purchase Record</a></li>
                        <li><a href="purchase_report.php" class="dropdown-link">Purchase Report</a></li>
                    </ul>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Toppers <i class="fas fa-chevron-down fa-xs"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="ledger-maloong.php" class="dropdown-link">Maloong Toppers</a></li>
                        <li><a href="ledger-buahan.php" class="dropdown-link">Buahan Toppers</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a href="ledger-ca.php" class="nav-link">Cash Advance</a></li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Coffee <i class="fas fa-chevron-down fa-xs"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="coffee_sale_record.php" class="dropdown-link">Coffee Sale</a></li>
                        <li><a href="coffee_list.php" class="dropdown-link">Product List</a></li>
                        <li><a href="#" class="dropdown-link">Sale Report</a></li>
                        <li><a href="coffee_customer.php" class="dropdown-link">Manage Customer</a></li>
                    </ul>
                </li>

            <?php endif; ?>

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
        if (mobileMenu) {
            mobileMenu.addEventListener('click', () => {
                mobileMenu.classList.toggle('is-active');
                navMenu.classList.toggle('active');
            });
        }

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
            if (navMenu && mobileMenu && !navMenu.contains(e.target) && !mobileMenu.contains(e.target)) {
                navMenu.classList.remove('active');
                mobileMenu.classList.remove('is-active');
            }
        });
    });
</script>