<?php 
   include('include/header.php');
   include "include/navbar.php";

  


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM rubber_cashadvance ");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from rubber_seller"); 
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
                                        ₱ <?php echo number_format($row['total']); ?>
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
                                    <h2><?php echo $ca_no; ?> </h2>

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


                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                                data-target="#copraCashAdvance">
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
                                    $results  = mysqli_query($con, "SELECT * from rubber_seller  ORDER BY id ASC"); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th width="15%">Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">WET CA</th>
                                                    <th scope="col">Bales CA</th>
                                                    <th scope="col">Total CA</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['id']?> </th>
                                                    <td> <?php echo $row['name']?> </td>
                                                    <td> <?php echo $row['address']?></td>
                                                    <td>₱ <?php echo number_format($row['cash_advance']) ?> </td>
                                                    <td>₱ <?php echo number_format($row['bales_cash_advance']) ?> </td>
                                                    <td>₱ <?php 
                                                    
                                                    $total_ca = $row['bales_cash_advance'] + $row['cash_advance'];
                                                    
                                                    echo number_format($total_ca) ?> </td>
                                                    <td>
                                                        <a href="seller_profile.php?view=<?php echo $row['id']; ?>"
                                                            class="btn btn-primary ">
                                                            <i class='fa-solid fa-eye'></i></a>
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

            </div>
        </div>
    </div>

</body>

</html> <?php
include('modal/cashadvanceModal.php');
?>
<script type="text/javascript" src="js/copra-ca.js"></script>