<?php 
   include('include/header.php');
   include "include/navbar.php";

   $getExpenseMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount) as month_total 
   from ledger_expenses  group by year(date), month(date) ORDER BY ID DESC");
   $sumExpense = mysqli_fetch_array($getExpenseMonthTotal);
   $monthNum  = $sumExpense["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
   $monthName = $dateObj->format('F');

   //PENDING CONTRACT
    $amoutPurchased  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase  group by year(date), month(date) ORDER BY ID DESC");
   $sumAmountPurchased = mysqli_fetch_array($amoutPurchased);

   $sql1  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(ejn_total) as month_total 
   from ledger_maloong  group by year(date), month(date) ORDER BY ID DESC");
   $maloong = mysqli_fetch_array($sql1);
  


   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase  group by year(date), month(date) ORDER BY ID DESC");
   $buahan = mysqli_fetch_array($sql);

   ?>

<body>


    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">EXPENSES</p>
                                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumExpense['month_total']); ?> KG
                                    </h2>
                                    <div>
                                        <span class="text-muted"> <?php echo $monthName; ?>
                                            <?php echo $sumExpense['year']; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">AMOUNT PURCHASED</p>
                                    <h2>₱ <?php echo number_format($sumAmountPurchased['month_total']) ; ?></h2>
                                    <div>
                                        <span class="text-muted"><?php echo $monthName; ?>
                                            <?php echo $sumAmountPurchased['year']; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">EJN Maloong</p>
                                    <h2>₱ <?php echo number_format($maloong['month_total'])?></h2>
                                    <div>
                                        <span class="text-muted">
                                            <?php echo date('F  Y');  ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">EJN Buahan </p>
                                    <h2>₱ <?php echo number_format($buahan['month_total']); ?> </h2>
                                    <div>
                                        <span class="text-muted"><?php echo $monthName; ?>
                                            <?php echo $buahan['year']; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- start first column -->
                            <!-- start expense table -->
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                    <center>
                                            <h4>EXPENSES TODAY</h4>
                                            </center>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='expenses_table'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE DATE(`date`) = CURDATE() ORDER BY id DESC LIMIT 5 "); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">DATE</th>
                                                    <th scope="col">PARTICULARS</th>
                                                    <th scope="col">VOC#</th>
                                                    <th scope="col">CATEGORY</th>
                                                    <th scope="col">AMOUNT</th>

                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['date']?> </td>
                                                    <td> <?php echo $row['particulars']?> </td>
                                                    <td> <?php echo $row['voucher_no']?> </td>
                                                    <td> <?php echo $row['category']?> </td>
                                                    <td>₱ <?php echo number_format($row['amount'])?> </td>

                                                </tr> <?php }
                                 ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end expense table -->
                            <!-- cash advance pie -->
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="ca_pie" style="position: relative; height:30vh; width:10vw">></canvas>
                                </div>
                            </div>
                            <!-- end cash advance -->


                            <!-- end first column -->
                        </div>
                        <div class="col-sm-6">
                            <!--  second columnn-->
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                       <center>
                                            <h4>SUBSCRIPTIONS</h4>
                                            </center>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='expenses_table'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE category='Subscription'
                                    AND  MONTH(date) = MONTH(CURDATE())
                                        AND YEAR(date) = YEAR(CURDATE()) ORDER BY id DESC LIMIT 10 "); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">VOC#</th>
                                                    <th scope="col">NAME</th>
                                                    <th scope="col">Date Last Paid</th>
                                                    <th scope="col">Next Payment</th>
                                                    <th scope="col">Amount</th>

                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['voucher_no']?> </td>
                                                    <td> <?php echo $row['particulars']?> </td>
                                                    <td><h5><span class="badge bg-success"> <?php echo $row['date']?> </span> </h5></td>
                                                    <td> 
                                                    <h5><span class="badge bg-danger"> <?php echo $date = date('Y-m-d', strtotime('+1 month', strtotime($row['date'])));?></span> </h5>    
                                                     </td>
                                                    <td>₱ <?php echo number_format($row['amount'])?> </td>

                                                </tr> <?php }
                                 ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="expenses_bar"
                                        style="position: relative; height:40vh; width:80vw"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                    <center>
                                            <h4>CASH ADVANCE TODAY</h4>
                                            </center>
                                 
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance  WHERE DATE(`date`) = CURDATE() ORDER BY id DESC LIMIT 5"); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Voucher #</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Buying Station</th>
                                                    <th>category</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td> <?php echo $row['id']?> </td>
                                                    <td> <?php echo $row['voucher']?> </td>
                                                    <td> <?php echo $row['date']?> </td>
                                                    <td> <?php echo $row['customer']?> </td>
                                                    <td> <?php echo $row['buying_station']?> </td>
                                                    <td> <?php echo $row['category']?> </td>
                                                    <td> <?php echo $row['amount']?> </td>

                                                </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end second column -->
                        </div>
                    </div>
                    <hr>

</body>

</html>

<script>
expenses_bar = document.getElementById("expenses_bar");

<?php
   $currentMonth = date("m");
   $currentDay = date("d");
   $currentYear = date("Y");
   
   $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;
   
                $expenses_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(amount) as month_total from ledger_expenses WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");        
                if($expenses_count->num_rows > 0) {
                  foreach($expenses_count as $data) {
                      $month[] = $data['monthname'];
                      $amount[] = $data['month_total'];
                  }
              }
        ?>

new Chart(expenses_bar, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Expenses',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month) ?>, //X-axis data 
        datasets: [{
            label: 'Expenses',
            data: <?php echo json_encode($amount) ?>, //Y-axis data 
            backgroundColor: '#474bff',
            borderColor: '#f26c4f',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>


<script>
pie = document.getElementById("ca_pie");

<?php
           $expenses_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(amount) as month_total , buying_station as station from ledger_cashadvance  group by month(date) ORDER BY date");        
           if($expenses_count->num_rows > 0) {
             foreach($expenses_count as $data) {
                $category[] = $data['station'];
                 $month[] = $data['monthname'];
                 $expense[] = $data['month_total'];
             }
         }
        ?>

new Chart(pie, {
    options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Cash Advance Chart',
            },
        },
    },
    type: 'doughnut', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($category) ?>,
        datasets: [{
            data: <?php echo json_encode($expense) ?>,
            backgroundColor: [
                'rgb(0, 153, 51)',
                'rgb(102, 153, 153)',
                'rgb(255, 204, 0)',
                'rgb(255, 0, 0)',
            ],
            borderColor: 'black',
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>