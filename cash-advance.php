<?php 
   include('include/header.php');
   include('include/navbar.php');

   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }
   



   ?>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">CASH AGREEMENT</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cash Agreenment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
             
                </div>
            </div>

            
        
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <!-- CONTENT -->
                               <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#newContract">
                                NEW CONTRACT
                                </button>
                               <h6 class="card-title m-t-40"><i
                                        class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Pending Cash Agreement</h6>
                                <div class="table-responsive">
                                    <table class="table" id='sellerTable'>
                                          <?php
                                    $results  = mysqli_query($con, "SELECT * from seller"); 
                                    
                                    ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Delivered</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['code']?></th>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['address']?></td>
                                                <td> <button type="button" class="btn btn-success text-white">VIEW</button> </td>
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <?php include('include/footer.php');?>

            <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="newContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NEW SELLER</h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="function/newSeller.php" method="POST">
        <!-- ... START -->
        <div class="form-group">
               <div class="row no-gutters">
                  
                  <div class="col-6 col-md-6">
                     <div class="input-group mb-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Contract</span>
                        </div>
                        <input type="text" style='text-align:right' name='v_contact' id='v_contact' class="form-control" style='background-color:white;border:0px solid #ffffff;' readonly >
                     </div>
                  </div>
                  <!--end  -->
                  <div class="col-6 col-md-6">
                     <div class="input-group mb-1"> 
                        <input type="date" id="date" name="date" required>
                     </div>
                  </div>
                  <!--  end-->
               </div>
            </div>
            <center>
           <div class="form-group">
                  <label class="col-md-12">Seller</label>
                  <div class="col-md-8">
                  <select class='select_seller' name='name' id='name'  >
                           <option disabled="disabled" selected="selected">Select Seller</option>
                           <?php echo $sellerList; ?>
                        </select>
                  </div>
        <br>
        </center>
        <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-5 col-md-12">
                                 <!--  -->
                                 <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Contract Quality</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='net' id='net' class="form-control" >
                                    <div class="input-group-append">
                                       <span class="input-group-text">Kg</span>
                                    </div>
                                 </div>
                                 <!--  -->
                              </div>
                           </div>
                        </div>
      
                        <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-5 col-md-12">
                                 <!--  -->
                                 <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Delivered</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='net' id='net' class="form-control" >
                                    <div class="input-group-append">
                                       <span class="input-group-text">Kg</span>
                                    </div>
                                 </div>
                                 <!--  -->
                              </div>
                           </div>
                        </div>


                        <!--  -->
                        <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-5 col-md-12">
                                 <!--  -->
                                 <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Balanace</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='net' id='net' class="form-control" >
                                    <div class="input-group-append">
                                       <span class="input-group-text">Kg</span>
                                    </div>
                                 </div>
                                 <!--  -->
                              </div>
                           </div>
                        </div>
                        <hr>
        <!-- END -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#sellerTable').DataTable();
    });
    </script>




<script>
    $('#newContract').on('shown.bs.modal', function () {
        $('.select_seller', this).chosen();
    });
</script>
