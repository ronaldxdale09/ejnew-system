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

<nav id='navbar'>
    <div id='toggle-nav-btn'>
        <i class='fa-solid fa-ellipsis'></i>
    </div>
    <div class='nav-title' style='font-weight:bold;'>
        <img src='assets/img/logo.png' alt='Q-cart Logo' width='35' height='35' style='margin-right:5px;'> <span class='nav-text'>General Ledger</span>
    </div>


    <hr style='color:white'>



    <a class='nav-link' href='coffee_product.php'>
        <i class='fa-solid fa-coffee'></i> <span class='nav-text'>Coffee Product</span>
    </a>

    <a class='nav-link' href='coffee_production.php'>
        <i class='fa-solid fa-box'></i> <span class='nav-text'>Coffee Production</span>
    </a>
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



    // On page load, check the localStorage to see if a dropdown should be expanded
    window.onload = function() {
        var expandedDropdown = localStorage.getItem('expandedDropdown');
        if (expandedDropdown) {
            toggleDropdown(expandedDropdown);
        }
    };
</script>