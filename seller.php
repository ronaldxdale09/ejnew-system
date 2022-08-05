<?php 
   include('include/header.php');
   include "include/navbar.php";

   
   $get = mysqli_query($con, "SELECT  COUNT(*) from seller  "); 
   $sellerCount = mysqli_fetch_array($get);

    $generate= sprintf("%'03d", $sellerCount[0]+1);
    $today = date("Y");
    $code = $today .'-'. $generate;

    
   ?>

<body>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <br>
                <br>
                <br>
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
                                        data-target="#modal">
                                        <i class="fa fa-add" aria-hidden="true"></i> NEW SELLER </button>
                                    <br>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        Seller
                                    </h6>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from seller"); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['code']?> </th>
                                                    <td> <?php echo $row['name']?> </td>
                                                    <td> <?php echo $row['address']?> </td>
                                                    <td>
                                                        <a href="seller_profile.php?view=<?php echo $row['code']; ?>"
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
</body>

</html>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NEW SELLER</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
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
                                <input type="text" value="<?php echo $generate; ?>" name='code'
                                    class="form-control form-control-line" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name='name' class="form-control form-control-line">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-8">
                                        <input type="text" name='address' class="form-control form-control-line">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-12">Cheque</label>
                                        <div class="col-md-8">
                                            <input type="text" name='cheque' class="form-control form-control-line">
                                        </div>
                    </center>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>