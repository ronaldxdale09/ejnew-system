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

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_maloong  group by year(date), month(date) ORDER BY ID DESC");
   $maloong = mysqli_fetch_array($sql);


   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase  group by year(date), month(date) ORDER BY ID DESC");
   $buahan = mysqli_fetch_array($sql);

   ?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                                    <p class="text-uppercase mb-1 text-muted">Maloong Toppers</p>
                                    <h2><?php echo number_format($maloong['month_total']) ;  ?> </h2>
                                    <div>
                                    <span class="text-muted"><?php echo $monthName; ?>
                                            <?php echo $maloong['year']; ?>
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
                                    <p class="text-uppercase mb-1 text-muted">Buahan Toppers</p>
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
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5> LATEST COPRA TRANSACTION </h5>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-sm "  data-toggle="modal" data-target=".viewTransaction">
                                                VIEW ALL
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                    $record  = mysqli_query($con, "SELECT * from transaction_record ORDER BY id DESC LIMIT 5 "); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">Net Resecada Weight </th>
                                                    <th scope="col">Amount Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['id']?> </th>
                                                    <td> <?php echo $row['date']?> </td>
                                                    <td> <?php echo $row['contract']?> </td>
                                                    <td> <?php echo $row['seller']?> </td>
                                                    <td> <?php echo number_format($row['net_res']);?> Kg </td>
                                                    <td>₱ <?php echo number_format($row['amount_paid']); ?> </td>
                                                </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="copra_bar" style="width:100%;max-width:100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

</html>
<?php 
   include "modal/viewTransactionModal.php";
?>
<script>
copra_bar = document.getElementById("copra_bar");
contract_pie = document.getElementById("contract_pie");
<?php
   $currentMonth = date("m");
   $currentDay = date("d");
   $currentYear = date("Y");
   
   $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;
   
                $purchased_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_res) as month_total from transaction_record WHERE year(date)='$currentYear'  group by month(date) ORDER BY date");        
                if($purchased_count->num_rows > 0) {
                  foreach($purchased_count as $data) {
                      $month[] = $data['monthname'];
                      $amount[] = $data['month_total'];
                  }
              }
        ?>

new Chart(copra_bar, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Copra Purchased Expense',
            },
        },
    },
    type: 'line', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month) ?>, //X-axis data 
        datasets: [{
            label: 'Purchased',
            data: <?php echo json_encode($amount) ?>, //Y-axis data 
            backgroundColor: '#f26c4f',
            borderColor: '#f26c4f',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>