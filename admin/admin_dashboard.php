<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Administrator Menu | EJN </title>
   </head>

   <!-- PHP Code -->
      <!-- copra dashboard -->
      <?php
        include 'include/header.php';
        include 'include/navbar.php';

        $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_res) as month_total 
        from transaction_record  group by year(date), month(date) ORDER BY ID DESC");
        $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
        $monthNum  = $sumPurchaced_Copra["month"];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
       
        //PENDING CONTRACT
        $amoutPurchased  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
        from transaction_record  group by year(date), month(date) ORDER BY ID DESC");
        $sumAmountPurchased = mysqli_fetch_array($amoutPurchased);

        //PENDING CONTRACT
        $pendingContract_count = mysqli_query($con,"SELECT * FROM contract_purchase where status='PENDING' OR status='UPDATED'");
        $contract=mysqli_num_rows($pendingContract_count);

        $results = mysqli_query($con, "SELECT SUM(cash_advance) AS total_ca from seller  "); 
        $total_ca = mysqli_fetch_array($results);


        // user count [copra, finance]
        $sqlcopranumber = "SELECT * from users WHERE type='copra' OR type='Copra'";

        if ($resultcopracount = mysqli_query($con, $sqlcopranumber)) {
            // Return the number of rows in result set
            $copracount = mysqli_num_rows( $resultcopracount );
        }
        //finance
        $sqlfinancenumber = "SELECT * from users WHERE type='finance' OR type='Finance'";

        if ($resultfinancecount = mysqli_query($con, $sqlfinancenumber)) {
            // Return the number of rows in result set
            $financecount = mysqli_num_rows( $resultfinancecount );
        }

        //admin
        $sqladminnumber = "SELECT * from users WHERE type='admin' OR type='Admin'";

        if ($resultadmincount = mysqli_query($con, $sqladminnumber)) {
            // Return the number of rows in result set
            $admincount = mysqli_num_rows( $resultadmincount );
        }
        ?>
<body>

  <!--DASHBOARD OF ALL USER -->
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Dashboard</span>
    </div>

    <main>
     
      <br>
      <h5><i class='bx bx-grid-alt' ></i> Copra's Dashboard</h5>
      <hr>
      <div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel='stylesheet' href='css/statistic-card.css'>
      <input type='hidden' id='selected-cart' value=''>
          <div class="container h-100">
              <div class="page-wrapper">
                  <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card" style="min-height:170px;">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">COPRA PURCHASED</p>
                                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($sumPurchaced_Copra['month_total']); ?> KG
                                    </h2>
                                    <div>
                                        <span class="text-muted"> <?php echo $today = date("F, Y"); ?>
                                            <?php echo $sumPurchaced_Copra['year']; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card" style="min-height:170px">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">AMOUNT PURCHASED</p>
                                    <h2>₱ <?php echo number_format($sumAmountPurchased['amount_purchased']) ; ?></h2>
                                    <div>
                                        <span class="text-muted"><?php echo$today = date("F, Y"); ?>
                                            <?php echo $sumPurchaced_Copra['year']; ?>
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
                            <div class="stat-card" style="min-height:170px">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">Pending Contracts</p>
                                    <h2><?php echo $contract; ?> </h2>
                                   
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card" style="min-height:170px">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">Total Cash Advance</p>
                                    <h2>₱ <?php echo number_format($total_ca['total_ca']); ?> </h2>
                                  
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
                                        <div class="col-md-9">
                                            <h5> LATEST COPRA TRANSACTION </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success btn-sm "  data-toggle="modal" data-target=".viewTransaction">
                                                VIEW ALL
                                            </button>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                    $recordtrans  = mysqli_query($con, "SELECT * from transaction_record ORDER BY id DESC LIMIT 5 "); ?>
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
                                            <tbody> <?php while ($row = mysqli_fetch_array($recordtrans)) { ?> <tr>
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
                </div>
            </div>
          </div>
        <?php 
          include "../modal/viewTransactionModal.php";
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

       
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
        
    </main>
  
  </section>

</body>
</html>
