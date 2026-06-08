<?php 
   include('include/header.php');
   include "include/navbar.php";

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(net_weight) as month_total 
   from rubber_transaction  where loc='$loc'  group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_wet = mysqli_fetch_array($sql);
   $monthNum  = $sumPurchaced_wet["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);


   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
   from rubber_transaction  where loc='$loc'   group by year(date), month(date) ORDER BY ID DESC");
   $sumAmountPurchased = mysqli_fetch_array($sql);

   /////////////////

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_net_weight) as month_total 
   from bales_transaction  where loc='$loc'   group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_bales = mysqli_fetch_array($sql);
   $monthNum  = $sumPurchaced_bales["month"];
   $dateObj   = DateTime::createFromFormat('!m', $monthNum);
 

   $sql  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(amount_paid) as amount_purchased 
   from bales_transaction   where loc='$loc'  group by year(date), month(date) ORDER BY ID DESC");
   $sumAmountPurchased_bales = mysqli_fetch_array($sql);


   //PENDING CONTRACT
   $sql = mysqli_query($con,"SELECT * FROM rubber_contract where  loc='$loc' AND  status='WET' AND status='PENDING' OR status='UPDATED' ");
   $contract_wet=mysqli_num_rows($sql);

   $sql = mysqli_query($con,"SELECT * FROM rubber_contract where  loc='$loc' AND  status='BALES' AND  status='PENDING' OR status='UPDATED'");
   $contract_bales=mysqli_num_rows($sql);

//    cash advance

   $sql = mysqli_query($con, "SELECT SUM(cash_advance) AS total_ca from rubber_seller where loc='$loc'  "); 
   $ca_wet = mysqli_fetch_array($sql);

   
   $sql = mysqli_query($con, "SELECT SUM(bales_cash_advance) AS total_ca from rubber_seller  where loc='$loc' "); 
   $ca_bales = mysqli_fetch_array($sql);

rubber_shell_open('Dashboard', 'Rubber purchasing overview');
$periodLabel = date('F Y');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<input type="hidden" id="selected-cart" value="">
<?php
rubber_kpi_row([
    ['label' => 'Cuplump Purchased', 'value' => number_format($sumPurchaced_wet['month_total'] ?? 0) . ' kg', 'sub' => $periodLabel, 'variant' => 'green'],
    ['label' => 'Cuplump Amount', 'value' => '₱ ' . number_format($sumAmountPurchased['amount_purchased'] ?? 0), 'sub' => $periodLabel, 'variant' => 'blue'],
    ['label' => 'Bales Purchased', 'value' => number_format($sumPurchaced_bales['month_total'] ?? 0) . ' kg', 'sub' => $periodLabel, 'variant' => 'green'],
    ['label' => 'Bales Amount', 'value' => '₱ ' . number_format($sumAmountPurchased_bales['amount_purchased'] ?? 0), 'sub' => $periodLabel, 'variant' => 'blue'],
]);
rubber_kpi_row([
    ['label' => 'Cuplump Cash Advance', 'value' => '₱ ' . number_format($ca_wet['total_ca'] ?? 0, 2), 'variant' => 'gold'],
    ['label' => 'Cuplump Pending Contracts', 'value' => (string) $contract_wet, 'variant' => 'gold'],
    ['label' => 'Bales Cash Advance', 'value' => '₱ ' . number_format($ca_bales['total_ca'] ?? 0, 2), 'variant' => 'gold'],
    ['label' => 'Bales Pending Contracts', 'value' => (string) $contract_bales, 'variant' => 'gold'],
]);
?>
<div class="row g-2">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5>RUBBER WET TRANSACTION </h5>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='dashboard-wet-table'>
                                            <thead class="table-dark" style='font-size:12px'>
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">Price 1</th>
                                                    <th scope="col">Price 2</th>
                                                    <th scope="col">Net Weight </th>
                                                    <th scope="col">Amount Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="width:100%;max-width:100%; height:100%;">
                                <div class="card-body" style="width:100%;max-width:100%; height:100%;">
                                    <canvas id="wet_line" style="width:100%;max-width:100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5>BALES TRANSACTION </h5>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id='dashboard-bales-table'>
                                            <thead class="table-dark" style='font-size:12px'>
                                                <tr>
                                                    <th scope="col">LOT #</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">Bales</th>
                                                    <th scope="col">Price 1</th>
                                                    <th scope="col">Price 2</th>
                                                    <th scope="col">Net Weight </th>
                                                    <th scope="col">Amount Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="width:100%;max-width:100%; height:100%;">
                                <div class="card-body" style="width:100%;max-width:100%; height:100%;">
                                    <canvas id="bales_bar" style="width:100%;max-width:100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
<script>
wet_line = document.getElementById("wet_line");
bales_bar = document.getElementById("bales_bar");

<?php
   $currentMonth = date("m");
   $currentDay = date("d");
   $currentYear = date("Y");
   
   $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;
   
                $purchased_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_weight) as month_total from rubber_transaction WHERE year(date)='$currentYear' AND loc='$loc'  group by month(date) ORDER BY date");        
                if($purchased_count->num_rows > 0) {
                  foreach($purchased_count as $data) {
                      $month[] = $data['monthname'];
                      $amount[] = $data['month_total'];
                  }
              }
        ?>

new Chart(wet_line, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly WET Rubber Purchased',
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


<?php
   $Bales_currentYear = date("Y");
   $Bales_currentMonth = date("m");
             
            $bales_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(bales_compute) as month_total from bales_transaction WHERE
             year(date)='$Bales_currentYear'   and loc='$loc' group by month(date) ORDER BY date");        
            if($bales_count->num_rows > 0) {
                foreach($bales_count as $b_data) {
                    $month_bales[] = $b_data['monthname'];
                    $bales[] = $b_data['month_total'];
                }
            }
        ?>

new Chart(bales_bar, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Monthly Total Bales Purchased',
            },
        },
    },
    type: 'bar', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($month_bales) ?>, //X-axis data 
        datasets: [{
            label: 'Bales',
            data: <?php echo json_encode($bales) ?>, //Y-axis data 
            backgroundColor: '#781710',
            borderColor: '#781710',
            tension: 0.3,
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-dashboard.js"></script>
<?php rubber_shell_close(); ?>