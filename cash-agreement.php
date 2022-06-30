<?php 
   include('include/header.php');
   include "include/navbar.php";

   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }
   

   ?>

<body>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <br> <br> <br>
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newContract">
                                        <i class="fa fa-add" aria-hidden="true"></i>   NEW CONTRACT
                                    </button>
                                    <br>   <br>
                                    <h6 class="card-title m-t-40"><i
                                            class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        Cash Agreement</h6>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'>
                                            <?php
                                    $results  = mysqli_query($con, "SELECT * from cash_agreement"); 
                                    
                                    ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Delivered</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['date']?></th>
                                                    <td><?php echo $row['contract_no']?></td>
                                                    <td><?php echo $row['seller']?></td>
                                                    <td><?php echo $row['contract_quality']?></td>
                                                    <td><?php echo $row['delivered']?></td>
                                                    <td><?php echo $row['balance']?></td>
                                                    <td> <button type="button"
                                                            class="btn btn-success text-white">VIEW</button>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            </tbody>
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
</body>

</html>


<?php
include('modal/contractModal.php');
?>


        <script>
        $('#newContract').on('shown.bs.modal', function() {
            $('.select_seller', this).chosen();
        });
        </script>