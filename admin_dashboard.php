<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Administrator Menu | EJN </title>
    <link rel="stylesheet" href="./css/admin_styles.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>

   <!-- PHP Code -->
      <!-- copra dashboard -->
      <?php
        include 'include/header.php';

        $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_res) as month_total 
        from transaction_record  group by year(date), month(date) ORDER BY ID DESC");
        $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
        $monthNum  = $sumPurchaced_Copra["month"];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');

        //PENDING CONTRACT
        $amoutPurchased  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
        from transaction_record  group by year(date), month(date) ORDER BY ID DESC");
        $sumAmountPurchased = mysqli_fetch_array($amoutPurchased);

        //PENDING CONTRACT
        $pendingContract_count = mysqli_query($con,"SELECT * FROM contract_purchase where status='PENDING' OR status='UPDATED'");
        $contract=mysqli_num_rows($pendingContract_count);

        $results = mysqli_query($con, "SELECT SUM(cash_advance) AS total_ca from seller  "); 
        $total_ca = mysqli_fetch_array($results);
        ?>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <div class="logo-img">
        <img src="./assets/img/logo.png" alt="">
      </div>
      <span class="logo_name">EJN Admin</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-user' ></i>
          <span class="link_name">Account</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Account</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Copra</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Copra</a></li>
          <li><a href="#">Transaction</a></li>
          <li><a href="#">Seller</a></li>
          <li><a href="#">Purchase Contract</a></li>
          <li><a href="#">Cash Advance</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Ledger</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Ledger</a></li>
          <li><a href="#">Expenses</a></li>
          <li><a href="#">Purchases</a></li>
          <li><a href="#">Cash Advance</a></li>
          <li><a href="#">Maloong Toppers</a></li>
          <li><a href="#">Buahan Toppers</a></li>
        </ul>
      </li>
      
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="./assets/img/avatar7.png" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">EJN</div>
        <div class="job">Administrator</div>
      </div>
      <a href='function/logout.php'>
        <i class='bx bx-log-in' ></i>
      </a>
    </div>
  </li>
</ul>
  </div>



  <!--DASHBOARD OF ALL USER -->
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Dashboard</span>
    </div>

    <main>
      <h5><i class='bx bx-grid-alt' ></i> Administrator's Dashboard</h5>
      <hr>

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
                                        <span class="text-muted"> <?php echo $monthName; ?>
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
                                        <span class="text-muted"><?php echo $monthName; ?>
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
                                    <div>
                                        <span class="text-muted">OVERALL EXPENSES</span>
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
                            <div class="stat-card" style="min-height:170px">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">Total Cash Advance</p>
                                    <h2>₱ <?php echo number_format($total_ca['total_ca']); ?> </h2>
                                    <div>
                                        <span class="text-muted">OVERALL EXPENSES</span>
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

       <!--======================LEDGER DASHBOARD======================--> 
      <br>
      <h5><i class='bx bx-grid-alt' ></i> Ledger's Dashboard</h5>
      <hr>
      <?php 
      
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
        <div class="container h-100">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card" style="min-height: 180px">
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
                            <div class="stat-card" style="min-height: 180px">
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
                            <div class="stat-card" style="min-height: 180px">
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
                            <div class="stat-card" style="min-height: 180px">
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
                                    <canvas id="expenses_bar"
                                        style="position: relative; height:40vh; width:80vw"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5>EXPENSES TODAY</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                                data-target=".viewTransaction">
                                                VIEW ALL
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='expenses_table'> <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_expenses WHERE DATE(`date`) = CURDATE() ORDER BY id DESC  "); 
                                    
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
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="ca_pie" style="position: relative; height:40vh; width:10vw">></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5>CASH ADVANCE TODAY</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                                data-target=".viewTransaction">
                                                VIEW ALL
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-responsive-lg" id='purchase_table'>
                                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance  WHERE DATE(`date`) = CURDATE() ORDER BY id DESC "); ?>
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
                        </div>
                    </div>
                  </div>
                </div>
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
      
              </div>
    </main>
  
  </section>

  <script src="./js/admin_script.js"></script>

</body>
</html>
