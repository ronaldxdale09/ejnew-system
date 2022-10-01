<?php 
   include('include/header.php');
   include "include/navbar.php";
   //current month
   $currentMonth = date("m");
   $currentYear = date("Y");

   $Ex_category = "SELECT * FROM category_expenses ";
   $result = mysqli_query($con, $Ex_category);
   $exCatList='';
   while($arr = mysqli_fetch_array($result))
   {
   $exCatList .= '

<option value="'.$arr["category"].'">'.$arr["category"].'</option>';
   }

   $sql = mysqli_query($con, "SELECT SUM(amount) AS total from ledger_expenses  WHERE category='freight' AND DATE(`date`) = CURDATE() ORDER BY id DESC  "); 
   $expense_today = mysqli_fetch_array($sql);
   
   
   $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount) as month_total 
   from ledger_expenses WHERE category='freight' AND month(date)='$currentMonth' group by year(date), month(date) ORDER BY ID DESC");
   $expense_month = mysqli_fetch_array($getMonthTotal);

   $monthNum  = $expense_month["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
   $monthName = $dateObj->format('F');


   $getYearTotal  = mysqli_query($con, "SELECT sum(amount) as year_total 
   from ledger_expenses WHERE category='freight' AND year(date)='$currentYear' ");
   $expense_year = mysqli_fetch_array($getYearTotal);
   
   
   ?>
    <!-- Bootstrap -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<body>
    <!-- Rounded tabs -->
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <center>
            <h1>FREIGHT</h1>
        </center>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="p-5 bg-white rounded shadow mb-5">
                <?php include('ledgerTab/freight.php')?>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
</body>

    <script src="ledgerTab/js/expenses.js"></script>
    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</html> <?php
include('modal/modal_freight.php');
?>
<!-- for date filter -->

<div class="modal fade viewExpenseCat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id='transaction_record'>
                        <?php
                                    $record  = mysqli_query($con, "SELECT * from category_expenses ORDER BY id DESC LIMIT 5 "); ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                <th scope="row"> <?php echo $row['id']?> </th>
                                <td> <?php echo $row['category']?> </td>

                            </tr> <?php } ?> </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>