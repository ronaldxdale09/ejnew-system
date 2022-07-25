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
<div class='main-content' style='position:relative; height:100%;'>
    <div class="container home-section h-100" style="max-width:95%;">


        <div class="container">
            <div class="main-body">

                <link rel='stylesheet' href='css/statistic-card.css'>

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $row['name']?> </h4>
                                        <p class="text-secondary mb-1"><?php echo $row['code']?></p>

                                    </div>
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
                                    <h6 class="mb-0">Pending Contract : </h6>
                                    <span class="text-secondary"><?php echo $contract ?></span>
                                </li>

                            </ul>
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
                                        Kenneth Valdez
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        (320) 380-4539
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        Bay Area, San Francisco, CA
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

                        


                    </div>
                </div>

            </div>
        </div>



        <!-- ============================================================== -->
    </div>
</div>
</body>