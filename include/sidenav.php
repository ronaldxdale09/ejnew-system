<?php 
    echo "
    <link rel='stylesheet' href='./css/admin_styles.css'>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <div class='sidebar close'>
      <div class='logo-details'>
        <div class='logo-img'>
          <img src='./assets/img/logo.png'>
        </div>
        <span class='logo_name'>EJN Admin</span>
      </div>
      <ul class='nav-links'>
          <li>
              <a href='./admin_dashboard.php'>
              <i class='bx bx-grid-alt' ></i>
              <span class='link_name'>Dashboard</span>
              </a>
              <ul class='sub-menu blank'>
              <li><a class='link_name' href='./admin_dashboard.php'>Dashboard</a></li>
              </ul>
          </li>
          <li>
              <a href='./admin_users.php'>
              <i class='bx bx-user' ></i>
              <span class='link_name'>Account</span>
              </a>
              <ul class='sub-menu blank'>
              <li><a class='link_name' href='./admin_users.php'>Account</a></li>
              </ul>
          </li>
          <li>
              <div class='iocn-link'>
              <a href='#'>
                  <i class='bx bx-collection' ></i>
                  <span class='link_name'>Copra</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
              </div>
              <ul class='sub-menu'>
              <li><a class='link_name' href='#'>Copra</a></li>
              <li><a href='#'>Seller</a></li>
              <li><a href='#'>Purchase Contract</a></li>
              <li><a href='#'>Cash Advance</a></li>
              </ul>
          </li>
          <li>
              <div class='iocn-link'>
              <a href='#'>
                  <i class='bx bx-book-alt' ></i>
                  <span class='link_name'>Ledger</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
              </div>
              <ul class='sub-menu'>
              <li><a class='link_name' href='#'>Ledger</a></li>
              <li><a href='#'>Expenses</a></li>
              <li><a href='#'>Purchases</a></li>
              <li><a href='#'>Cash Advance</a></li>
              <li><a href='#'>Maloong Toppers</a></li>
              <li><a href='#'>Buahan Toppers</a></li>
              </ul>
          </li>
          
          <li>
              <div class='profile-details'>
              <div class='profile-content'>
                  <img src='./assets/img/avatar7.png'>
              </div>
              <div class='name-job'>
                  <div class='profile_name'>EJN</div>
                  <div class='job'>Administrator</div>
              </div>
              <a href='function/logout.php'>
                  <i class='bx bx-log-in' ></i>
              </a>
              </div>
          </li>
      </ul>
    </div>
  "

?>