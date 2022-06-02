<?php 
   include('include/header.php');
   include('include/navbar.php');

   $get = mysqli_query($con, "SELECT  COUNT(*) from seller  "); 
   $sellerCount = mysqli_fetch_array($get);

    $generate= sprintf("%'03d", $sellerCount[0]);
    $today = date("Y");
    $code = $today .'-'. $generate;

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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                               <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modal">
                                NEW SELLER PROFILE
                                </button>
                               <h6 class="card-title m-t-40"><i
                                        class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of Seller</h6>
                                <div class="table-responsive">
                                    <table class="table" id='sellerTable'>
                                          <?php
                                    $results  = mysqli_query($con, "SELECT * from seller"); 
                                    
                                    ?>
                                        <thead>
                                            <tr>
                                                <th scope="col">Code</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Action</th>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <center>
        <div class="form-group">
                  <label class="col-md-12">CODE</label>
                  <div class="col-md-8">
                     <input type="text" value="<?php echo $code; ?>" name='code'
                        class="form-control form-control-line" readonly>
                  </div>
            <br>
           <div class="form-group">
                  <label class="col-md-12">Name</label>
                  <div class="col-md-8">
                     <input type="text" name='name'
                        class="form-control form-control-line" >
                  </div>
        <br>
        <div class="form-group">
                  <label class="col-md-12">Address</label>
                  <div class="col-md-8">
                     <input type="text" name='address'
                        class="form-control form-control-line" >
                  </div>
        <br>
           <div class="form-group">
                  <label class="col-md-12">Cheque</label>
                  <div class="col-md-8">
                     <input type="text" name='cheque'
                        class="form-control form-control-line" >
                  </div>
</center>
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