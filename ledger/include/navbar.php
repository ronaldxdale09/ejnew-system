<nav class='nav-bar'>
    <ul class="menu">
        <li class="logo"><a href="#">EN-System </a></li>
        
        <li class="item"><a href='dashboard.php'> Dashboard</a></li>

        <li class="item has-submenu">
            <a tabindex="0"><i class='fa-solid fa-money'></i> Expenses</a>
            <ul class="submenu">
                <li class="subitem"><a href="ledger-expense.php"> Expense</a></li>
                <li class="subitem"><a href="expense_report.php"> Expense Report</a></li>
            </ul>
        </li>

        <?php if (strcasecmp(trim($loc), 'Zamboanga') != 0) : ?>

        <li class="item has-submenu">
            <a tabindex="0"><i class='fa-solid fa-comment-dollar'></i> Purchases</a>
            <ul class="submenu">
                <li class="subitem"><a href="ledger-purchase.php">Purchase Record</a></li>
                <li class="subitem"><a href="purchase_report.php"> Purchase Report</a></li>
            </ul>
        </li>

        <li class="item has-submenu">
            <a tabindex="0"><i class='fa-solid fa-archive'></i> Toppers</a>
            <ul class="submenu">
                <li class="subitem"><a href="ledger-maloong.php">Maloong Toppers</a></li>
                <li class="subitem"><a href="ledger-buahan.php"> Buahan Toppers</a></li>
            </ul>
        </li>

        
        <li class="item"><a href="ledger-ca.php"><i class="fas fa-money-bill-alt"></i> Cash Advance</a></li>
 

        <li class="item has-submenu">
            <a tabindex="0"><i class='fa-solid fa-tree'></i> Coffee</a>
            <ul class="submenu">
                <li class="subitem"><a href="coffee_sale_record.php">Coffee Sale</a></li>
                <li class="subitem"><a href="coffee_list.php"> Product List</a></li>
                <li class="subitem"><a href="#">Sale Report</a></li>
                <li class="subitem"><a href="coffee_customer.php">Manage Customer</a></li>
            </ul>
        </li>

       

       
        <?php endif; ?>
       
        <li class="item"><a href='function/logout.php'><i class='fa-solid fa-arrow-right-to-bracket'></i> Logout</a></li>

        <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
    </ul>
</nav>


<script>
    const toggle = document.querySelector(".toggle");
    const menu = document.querySelector(".menu");
    const items = document.querySelectorAll(".item");

    /* Toggle mobile menu */
    function toggleMenu() {
        if (menu.classList.contains("active")) {
            menu.classList.remove("active");
            toggle.querySelector("a").innerHTML = "<i class='fas fa-bars'></i>";
        } else {
            menu.classList.add("active");
            toggle.querySelector("a").innerHTML = "<i class='fas fa-times'></i>";
        }
    }

    /* Activate Submenu */
    function toggleItem() {
        if (this.classList.contains("submenu-active")) {
            this.classList.remove("submenu-active");
        } else if (menu.querySelector(".submenu-active")) {
            menu.querySelector(".submenu-active").classList.remove("submenu-active");
            this.classList.add("submenu-active");
        } else {
            this.classList.add("submenu-active");
        }
    }

    /* Close Submenu From Anywhere */
    function closeSubmenu(e) {
        if (menu.querySelector(".submenu-active")) {
            let isClickInside = menu
                .querySelector(".submenu-active")
                .contains(e.target);

            if (!isClickInside && menu.querySelector(".submenu-active")) {
                menu.querySelector(".submenu-active").classList.remove("submenu-active");
            }
        }
    }
    /* Event Listeners */
    toggle.addEventListener("click", toggleMenu, false);
    for (let item of items) {
        if (item.querySelector(".submenu")) {
            item.addEventListener("click", toggleItem, false);
        }
        item.addEventListener("keypress", toggleItem, false);
    }
    document.addEventListener("click", closeSubmenu, false);
</script>