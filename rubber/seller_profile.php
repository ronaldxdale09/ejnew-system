<?php 
   include('include/header.php');
   include "include/navbar.php";

   if (isset($_GET['view'])) {
    $id = $_GET['view'];
  }

$results = mysqli_query($con, "SELECT * from rubber_seller WHERE id='$id'"); 
$row = mysqli_fetch_array($results);
$sellerID = $row['id'];
$name = $row['name'];

   //PENDING CONTRACT
   $pendingContract_count = mysqli_query($con,"SELECT * FROM wet_rubber_contract where loc='$loc' and status='PENDING' OR status='UPDATED' AND seller='$name'");
   $contract=mysqli_num_rows($pendingContract_count);


?>

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<?php
    include('modal/profileModal.php');
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
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $name?> </h4>
                                        <p class="text-secondary mb-1"><?php echo $row['id']?></p>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; width: 100%">
                                    <p class="text-secondary mb-1">Address: </p>
                                    <span><?php echo $row['address']?></span>
                                </div>
                                <div style="display: flex; justify-content: space-between; width: 100%">
                                    <p class="text-secondary mb-1">Contact: </p>
                                    <span><?php echo $row['contact']?></span>
                                </div>

                                <div class="d-flex flex-column align-items-center text-center">
                                    <button type="button" class="btn btn-success text-white" data-bs-toggle="modal"
                                        data-bs-target="#updateProfile" data-bs-id="<?php echo $sellerID ?>"
                                        data-bs-full_name="<?php echo $row['name']?>"
                                        data-bs-address="<?php echo $row['address']?>"
                                        data-bs-contact="<?php echo $row['contact']?>">
                                        <span class="fa fa-edit"></span> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Pending Contract : </h6>
                                    <span class="text-secondary"><?php echo $contract ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Total Cash Advance : </h6>
                                    <span class="text-secondary"><?php echo $row['cash_advance'] ?></span>
                                </li>

                            </ul>
                        </div>
                        <div class="card mt-3">
                            <!-- coi -->
                            <canvas id="ca_pie" style="width:90%;max-width:90%; height:60%;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-12">

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        CONTRACT
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from contract_purchase WHERE seller='$name' and loc='$loc' "); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">Date</th>
                                                    <th width="15%">Contact No.</th>
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
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        Recent Copra Purchase Transaction
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table" id='seller_copraTransaction'>
                                            <?php
                                    $results  = mysqli_query($con, "SELECT * from transaction_record where seller='$name' and loc='$loc' ORDER BY id DESC  "); ?>
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


<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

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