<!-- Rounded tabs -->

   <ul id="myTab" role="tablist"
      class="nav nav-tabs nav-pills flex-column flex-sm-row text-center  border-5 rounded-nav ">
      <li  id="expense-tab" class="nav-item flex-sm-fill">
         <a href="ledger.php"
            class="nav-link border-1" style='color:black; 
            font-weight: bold;font-size: 20px;'> <i class="fa fa-money" aria-hidden="true"></i>  EXPENSES</a>
      </li>
      <li id="purchase-tab" class="nav-item flex-sm-fill purchase">
         <a href="ledger-purchase.php"
            class="nav-link border-1" style='color:black; 
            font-weight: bold;font-size: 20px;'> <i class="fa fa-comment-dollar"
            aria-hidden="true"></i>  PURCHASES</a>
      </li>
      <li id="maloong-tab" class="nav-item flex-sm-fill">
         <a  href='ledger-maloong.php'
            aria-controls="contact"  class="nav-link border-1 " style='color:black; 
            font-weight: bold;font-size: 20px;'>EJN MALOONG TOPPERS</a>
      </li>
   </ul>

<script>
   //ledger tab
const activeTab = window.location.pathname;

if (activeTab == '/ejnew-system/ledger.php') {
    tab = document.getElementById("expense-tab");
    tab.classList.add("active");

} else if (activeTab == '/ejnew-system/ledger-purchase.php') {
    tab = document.getElementById("purchase-tab");
    tab.classList.add("active");
} else if (activeTab == '/ejnew-system/ledger-maloong.php') {
    tab = document.getElementById("maloong-tab");
    tab.classList.add("active");
}

</script>