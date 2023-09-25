<nav class='nav-bar'>
    <ul class="menu">
        <li class="logo"><a href="#">EN-System </a></li>
        <li class="item"><a href='dashboard.php'>Dashboard</a></li>
        <li class="item has-submenu">
            <a tabindex="0">Expenses</a>
            <ul class="submenu">
                <li class="subitem"><a href="basilan.expense.php">Basilan Expenses</a></li>
                <li class="subitem"><a href="basilan.expense.report.php">Basilan Report</a></li>
                <li class="subitem"><a href="zam.expense.php">Zamboanga Expenses</a></li>
                <li class="subitem"><a href="zam.expense.report.php">Zamboanga Report</a></li>
            </ul>
        </li>
        <li class="item"><a href="purchase_report.php">Purchases Report</a></li>
        <li class="item"><a href="sales_reports.php">Sales Report</a></li>
        <li class="item"><a href="copra_record.php">Copra Record</a></li>


        <li class="item has-submenu">
            <a tabindex="0">Bales</a>
            <ul class="submenu">
                <li class="subitem"><a href="inv_bale.php">Inventory</a></li>
                <li class="subitem"><a href="bale_sale_record.php">Bale Sales</a></li>
                <li class="subitem"><a href="container_record.php">Container</a></li>
                <li class="subitem"><a href="bale_shipment_record.php">Shipment</a></li>
            </ul>
        </li>

        <li class="item has-submenu">
            <a tabindex="0">Cuplump</a>
            <ul class="submenu">
                <li class="subitem"><a href="inv_cuplump.php">Inventory</a></li>
                <li class="subitem"><a href="cuplump_sale_record.php">Sales</a></li>
                <li class="subitem"><a href="cuplump_container_record.php">Container</a></li>
                <li class="subitem"><a href="cuplump_shipment_record.php">Shipment</a></li>
            </ul>
        </li>

        <li class="item has-submenu">
            <a tabindex="0">Coffee</a>
            <ul class="submenu">
                <li class="subitem"><a href="coffee_list.php">Inventory</a></li>
                <li class="subitem"><a href="coffee_production.php">Production</a></li>
                <li class="subitem"><a href="coffee_sale_record.php">Sales</a></li>
            </ul>
        </li>


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