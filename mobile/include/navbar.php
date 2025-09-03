<!-- Mobile Navigation -->
<nav class="mobile-nav">
    <div class="nav-header">
        <div class="logo">
            <i class="fas fa-leaf"></i> EJN Admin
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Side Menu -->
<div class="side-menu" id="sideMenu">
    <div class="side-menu-header">
        <h3>Welcome</h3>
        <p><?php echo htmlspecialchars($name); ?></p>
    </div>
    
    <a href="dashboard.php" class="side-menu-item">
        <i class="fas fa-tachometer-alt"></i>
        Dashboard
    </a>
    
    <a href="reports/sales_reports.php" class="side-menu-item">
        <i class="fas fa-chart-line"></i>
        Sales Reports
    </a>
    
    <a href="reports/purchase_reports.php" class="side-menu-item">
        <i class="fas fa-shopping-cart"></i>
        Purchase Reports
    </a>
    
    <a href="reports/expense_reports.php" class="side-menu-item">
        <i class="fas fa-receipt"></i>
        Expense Reports
    </a>
    
    <a href="reports/inventory_reports.php" class="side-menu-item">
        <i class="fas fa-boxes"></i>
        Inventory Reports
    </a>
    
    <a href="reports/coffee_reports.php" class="side-menu-item">
        <i class="fas fa-coffee"></i>
        Coffee Reports
    </a>
    
    <a href="reports/copra_reports.php" class="side-menu-item">
        <i class="fas fa-seedling"></i>
        Copra Reports
    </a>
    
    <a href="reports/rubber_reports.php" class="side-menu-item">
        <i class="fas fa-tree"></i>
        Rubber Reports
    </a>
    
    <a href="reports/plantation_reports.php" class="side-menu-item">
        <i class="fas fa-leaf"></i>
        Plantation Reports
    </a>
    
    <a href="reports/financial_reports.php" class="side-menu-item">
        <i class="fas fa-calculator"></i>
        Financial Reports
    </a>
    
    <a href="../admin/dashboard.php" class="side-menu-item">
        <i class="fas fa-desktop"></i>
        Desktop Version
    </a>
    
    <a href="../admin/function/logout.php" class="side-menu-item">
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </a>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<script>
function toggleMenu() {
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');
    
    sideMenu.classList.toggle('active');
    overlay.classList.toggle('active');
}

// Close menu when clicking on a menu item
document.querySelectorAll('.side-menu-item').forEach(item => {
    item.addEventListener('click', () => {
        toggleMenu();
    });
});
</script>
