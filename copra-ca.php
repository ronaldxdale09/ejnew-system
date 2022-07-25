<?php 
   include('include/header.php');
   include "include/navbar.php";

   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '
<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }

   $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(delivered) as month_total 
   from contract_purchase  group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
   $monthNum  = $sumPurchaced_Copra["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
   $monthName = $dateObj->format('F');


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM copra_cashadvance where status='PENDING'");
     $ca_no=mysqli_num_rows($CA_count);


   ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">No. Cash Advance</p>
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
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">No. Cash Advance</p>
                                    <h2><?php echo $ca_no; ?> </h2>
                                    <div>
                                        <span class="text-muted">OVERALL EXPENSES</span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- CONTENT -->
                                            <div class="row">
                                                <div class="col-5">
                                                    <button type="button" class="btn btn-primary text-white"
                                                        data-toggle="modal" data-target="#copraCashAdvance">
                                                        <i class="fa fa-add" aria-hidden="true"></i> NEW CASH ADVANCE
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <h5> Date Filter</h5>
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" id="min" name="min" class="form-control"
                                                        placeholder="From Date" />
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" id="max" name="max" class="form-control"
                                                        placeholder="To Date" />
                                                </div>
                                            </div>
                                            <br>
                                            <h6 class="card-title m-t-40">
                                                <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List
                                                of
                                                Purchase Contract
                                            </h6>


                                            <div class="table-responsive">
                                                <table class="table" id='contractTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from copra_cashadvance"); 
                                    
                                    ?> <thead class="table-dark">
                                                        <tr>

                                                            <th width="10%">Date</th>
                                                            <th width="15%">Seller</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Amount</th>

                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                            <th scope="row"> <?php echo $row['date']?> </th>
                                                            <td> <?php echo $row['seller']?> </td>
                                                            <td> <?php echo $row['category']?></td> 
                                                            <td>₱  <?php echo number_format($row['amount']) ?> </td>
                                                            <td>
                                                                <h5><span
                                                                        class="badge bg-success"><?php echo $row['status']?></span>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-primary text-white  btn-sm"> <i
                                                                        class='fa-solid fa-edit'></i></button>
                                                                <button type="button"
                                                                    class="btn btn-danger text-white  btn-sm">
                                                                    <i class='fa-solid fa-times'></i></button>
                                                            </td>
                                                        </tr> <?php } ?> </tbody>
                                                </table>
                                            </div>
                                            <!-- END CONTENT -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
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
</body>

</html> <?php
include('modal/copra/copra_cashadvanceModal.php');
?> 
<script type="text/javascript" src="assets/js/copra-ca.js"></script>
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