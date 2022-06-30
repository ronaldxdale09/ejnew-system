<?php 
   include('include/header.php');
   include "include/navbar.php";

   $Ex_category = "SELECT * FROM category_expenses ";
   $result = mysqli_query($con, $Ex_category);
   $exCatList='';
   while($arr = mysqli_fetch_array($result))
   {
   $exCatList .= '<option value="'.$arr["category"].'">'.$arr["category"].'</option>';
   }
   
   
   
    //    over all expenses for this year
    $overall= mysqli_query($con, "SELECT SUM(amount) as overall 
    FROM ledger_expenses"); 
    $allexpenses= mysqli_fetch_array($overall);
   //    over all expenses for this year
   $year= mysqli_query($con, "SELECT YEAR(date) as year, SUM(amount) as year_total 
   FROM ledger_expenses 
   GROUP BY YEAR(date) ORDER BY ID DESC"); 
   $yearExpense = mysqli_fetch_array($year);
   
   //    get this month expenses
        // $dt->format('Y-m-d');
        $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount) as month_total 
        from ledger_expenses  group by year(date), month(date) ORDER BY ID DESC");
        $sumExp = mysqli_fetch_array($getMonthTotal);
        $monthNum  = $sumExp["month"];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');


   ?>

<body>

    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>

    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:90%;'>
        <div class="container home-section h-90" style="max-width:95%;">

            <div class="p-5 bg-white rounded shadow mb-5">
                <!-- Rounded tabs -->
                <ul id="myTab" role="tablist"
                    class="nav nav-tabs nav-pills flex-column flex-sm-row text-center  border-5 rounded-nav ">
                    <li class="nav-item flex-sm-fill  ">
                        <a href="ledger.php" role="tab" aria-controls="home" aria-selected="true"
                            class="nav-link border-1" style='color:black; 
                            font-weight: bold;font-size: 20px;'>EXPENSES</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a href="ledger-purchase.php" role="tab" aria-controls="profile" aria-selected="false"
                            class="nav-link border-1" style='color:black; 
                            font-weight: bold;font-size: 20px;'>PURCHASES</a>
                    </li>
                    <li class="nav-item flex-sm-fill active">
                        <a id="contact-tab" href='ledger-maloong.php' data-toggle="tab" role="tab"
                            aria-controls="contact" aria-selected="false" class="nav-link border-1 " style='color:white; 
                            font-weight: bold;font-size: 20px;'>EJN MALOONG TOPPERS</a>
                    </li>
                </ul>
                <br> <br>
                <?php include('ledgerTab/ejn-maloong.php')?>
            </div>
            <!-- ============================================================== -->


        </div>
    </div>
</body>

</html>


<?php
include('modal/modal.php');
include('modal/modalScript.php');
include('include/script.php');
?>