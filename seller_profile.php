<?php 
   include('include/header.php');
   include "include/navbar.php";

   if (isset($_GET['view'])) {
    $id = $_GET['view'];
  }

$results = mysqli_query($con, "SELECT * from seller WHERE code='$id'"); 
$row = mysqli_fetch_array($results);
$name = $row['name'];

   //PENDING CONTRACT
   $pendingContract_count = mysqli_query($con,"SELECT * FROM contract_purchase where status='PENDING' OR status='UPDATED' AND seller='$name'");
   $contract=mysqli_num_rows($pendingContract_count);


?>
<link rel='stylesheet' href='../css/seller_profile.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">

        <script type="text/javascript" src="js/seller_profile.js"></script>
        <div class="container">
            <div class="main-body">

                <br>
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="assets/img/avatar.png" alt="Admin"
                                        class="rounded-circle" width="210">
                                    <div class="mt-3">
                                        <h4><?php echo $name?> </h4>
                                        <p class="text-secondary mb-1"><?php echo $row['code']?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h5 class="mb-0">Pending Contract :
                                        <span class="text-secondary"><?php echo $contract ?></span>
                                    </h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h5 class="mb-0">Total Cash Advance :
                                        <span class="text-secondary">₱ <?php echo $row['cash_advance'] ?></span>
                                    </h5>
                                </li>

                            </ul>
                        </div>


                        <div class="card mt-3">
                            <!-- coi -->
                            <canvas id="ca_pie" style="width:90%;max-width:90%; height:60%;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $name?>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['address']?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contact No.</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $row['contact']?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        test@gmail.com
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-info " target="__blank"
                                            href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        CONTRACT
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from contract_purchase WHERE seller='$name' "); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">Date</th>
                                                    <th width="10%">Contact No.</th>
                                                    <th width="15%">Seller</th>
                                                    <th scope="col">Quantity</th>
                                                    <th hidden scope="col">Delivered</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">₱/KG</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['date']?> </th>
                                                    <td> <?php echo $row['contract_no']?> </td>
                                                    <td> <?php echo $row['seller']?> </td>
                                                    <td> <?php echo $row['contract_quantity']?> Kg</td>
                                                    <td hidden> <?php echo $row['delivered']?> </td>
                                                    <td> <?php echo $row['balance']?> Kg</td>
                                                    <td>₱ <?php echo $row['price_kg']?> </td>
                                                    <td>
                                                        <h5><span
                                                                class="badge bg-success"><?php echo $row['status']?></span>
                                                        </h5>
                                                    </td>
                                       
                                                </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        Recent Copra Purchase Transaction
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table" id='seller_copraTransaction'>
                                            <?php
                                    $results  = mysqli_query($con, "SELECT * from transaction_record where seller='$name'  ORDER BY id DESC  "); ?>
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
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
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

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <canvas id="copra_bar" style="width:90%;max-width:90%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>



    <!-- ============================================================== -->
</div>
</div>
</body>

<script>
pie = document.getElementById("ca_pie");

<?php
            $sql = mysqli_query($con,"SELECT SUM(amount) as total FROM copra_cashadvance WHERE seller='$name' and category='copra'");
            $copra_row=mysqli_fetch_array($sql);

            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE seller='$name' and category='ntc'");
            $ntc_row=mysqli_fetch_array($sql);
            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE seller='$name' and category='trucking'");
            $truck_row=mysqli_num_rows($sql);
            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE seller='$name' and category='other'");
            $othr_row=mysqli_num_rows($sql);
        ?>

new Chart(pie, {
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Cash Advance Chart',
            },
        },
    },
    type: 'doughnut', //Declare the chart type 
    data: {
        labels: [
            'Copra',
            'NTC',
            'Trucking',
            'Others',
        ],
        datasets: [{
            label: 'Carts',
            data: [
                <?php echo $copra_row['total'].",".$ntc_row['total'].",".$truck_row['total'].",".$othr_row['total'] ?>
            ],
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

<script>
copra_bar = document.getElementById("copra_bar");
<?php
   $currentMonth = date("m");
   $currentDay = date("d");
   $currentYear = date("Y");
   
   $today = $currentYear . "-" . $currentMonth . "-" . $currentDay;
   
                $purchased_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(net_res) as month_total from transaction_record WHERE year(date)='$currentYear' and seller='$name'  group by month(date) ORDER BY date");        
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
    type: 'bar', //Declare the chart type 
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