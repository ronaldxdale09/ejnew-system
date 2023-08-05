<nav id='navbar'>

    <div id='toggle-nav-btn'>
        <div class='nav-title' style='font-weight:bold;'>
            <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>EJN RUBBER</span>
        </div>
    </div>
    <div class='nav-text' style='text-align: center;'><?php echo $_SESSION['loc']; ?></div>

    <hr style='color:white'>

    <a class='nav-link' href='dashboard.php'>
        <i class='fa-solid fa-house'></i> <span class='nav-text'>Home</span>
    </a>

    <hr style='color:gray'>

    <a class='nav-link' href='recording.php'>
        <i class='fa-solid fa-gear'></i> <span class='nav-text'>Rubber Processing</span>
    </a>

    <a class='nav-link' href='record_allrubber.php'>
        <i class='fa-solid fa-book'></i> <span class='nav-text'>Transaction Record</span>
    </a>

    <hr style='color:gray'>
    <a class='nav-link' href='inventory_bale.php'>
        <i class='fa-solid fa-cube'></i> <span class='nav-text'>Bale Produced</span>
    </a>
    <a class='nav-link' href='container_record.php'>
        <i class='fa-solid fa-truck'></i> <span class='nav-text'>Container</span>
    </a>

    <div class="logout-container">
        <a class="nav-text logout-button" data-toggle="modal" href="#logoutModal">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
            <span class="nav-text">Logout</span>
        </a>
    </div>

</nav>

<script src='assets/js/navbar.js'></script>
<!-- Logout confirmation modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-sign-out-alt fa-4x mb-3 text-warning" aria-hidden="true"></i>
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <a href="function/logout.php" class="btn btn-outline-primary">Logout</a>
            </div>
        </div>
    </div>
</div>