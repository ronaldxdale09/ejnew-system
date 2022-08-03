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


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM copra_cashadvance where status='PENDING'");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from seller"); 
    $row = mysqli_fetch_array($results);
   


   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                                    <p class="text-uppercase mb-1 text-muted">Cash Advance</p>
                                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo number_format($row['total']); ?> 
                                    </h2>
                                    
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
                                    <h2>₱ <?php echo $ca_no; ?> </h2>
                                    
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
                                    $results  = mysqli_query($con, "SELECT * from copra_cashadvance  ORDER BY id ASC"); 
                                    
                                    ?> <thead class="table-dark">
                                                        <tr>
                                                            <th width="10%">ID</th>
                                                            <th width="10%">Date</th>
                                                            <th width="15%">Seller</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Amount</th>

                                                          
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                        <th scope="row"> <?php echo $row['id']?> </th>
                                                            <th scope="row"> <?php echo $row['date']?> </th>
                                                            <td> <?php echo $row['seller']?> </td>
                                                            <td> <?php echo $row['category']?></td> 
                                                            <td>₱  <?php echo number_format($row['amount']) ?> </td>
                                                            
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-secondary text-white  btn-sm"> <i
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
                                <canvas id="ca_pie" style="width:100%;max-width:100%; height:100%;"></canvas>
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
<script type="text/javascript" src="js/copra-ca.js"></script>

<script>
pie = document.getElementById("ca_pie");

<?php
            $sql = mysqli_query($con,"SELECT SUM(amount) as total FROM copra_cashadvance WHERE   category='copra'");
            $copra_row=mysqli_fetch_array($sql);

            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE  category='ntc'");
            $ntc_row=mysqli_fetch_array($sql);
            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE category='trucking'");
            $truck_row=mysqli_num_rows($sql);
            $sql = mysqli_query($con,"SELECT SUM(amount) as total  FROM copra_cashadvance WHERE  category='others'");
            $othr_row=mysqli_num_rows($sql);
        ?>

new Chart(pie, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Cash Advance Chart',
                        },
                    },
                },
                type: 'pie', //Declare the chart type 
                data: {
                labels: [
                    'Copra',
                    'NTC',
                    'Trucking',
                    'Other',

                ],
                datasets: [{
                    label:'Carts',
                    data:[<?php echo $copra_row['total'].",".$ntc_row['total'].",".$truck_row['total'].",".$othr_row['total']?>],
                    backgroundColor: [
                        'rgb(0, 153, 51)',
                        'rgb(102, 153, 153)',
                        'rgb(255, 204, 0)',
                        'rgb(153, 0, 0)'
                    ],
                    borderColor: 'black',
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });

</script>