<?php 
   include('include/header.php');
   include('include/navbar.php');
   
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
   <!-- ============================================================== -->
   <!-- Preloader - style you can find in spinners.css -->
   <!-- ============================================================== -->
   <div class="preloader">
      <div class="lds-ripple">
         <div class="lds-pos"></div>
         <div class="lds-pos"></div>
      </div>
   </div>
   <div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row align-items-center">
         <div class="col-5">
            <h4 class="page-title">General Ledger</h4>
            <div class="d-flex align-items-center">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">General Ledger</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- End -->
      <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
         <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
      <div class="p-5 bg-white rounded shadow mb-5">
         <!-- Rounded tabs -->
         <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-3 rounded-nav">
            <li class="nav-item flex-sm-fill">
               <a id="home-tab" data-toggle="tab" href="ledger-expenses.php" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold ">EXPENSES</a>
            </li>
            <li class="nav-item flex-sm-fill">
               <a id="profile-tab" data-toggle="tab" href="ledger-purchase.php" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold ">PURCHASES</a>
            </li>
            <li class="nav-item flex-sm-fill">
               <a id="contact-tab"  href='ledger-maloong.php' data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">EJN MALOONG TOPPERS</a>
            </li>
         </ul>
         <br> <br>
         <?php include('ledgerTab/expenses.php')?>
      </div>
      <!-- ============================================================== -->
   </div>
   <!-- ============================================================== -->
   <!-- End Container fluid  -->
   <!-- ============================================================== -->
   <!-- ============================================================== -->
   <!-- footer -->
   <?php include('include/footer.php');
      include('include/script.php');
      include('include/ledgerModal.php');?>
   <script src='ledgerTab/expenses.js'></script>
   <!-- Modal -->
   <!-- Button trigger modal -->
   <script>
      $('#addExpense').on('shown.bs.modal', function () {
          $('.ex_category', this).chosen();
      });
   </script>