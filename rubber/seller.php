<?php 
   include('include/header.php');
   include "include/navbar.php";

   
  

    
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
                                        data-target="#add_seller">
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
                                    $results  = mysqli_query($con, "SELECT * from rubber_seller"); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Image</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Contact #</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td>
                                                        <nobr> <img
                                                                src="assets/img/avatar.png"
                                                                alt="..." class="img img-fluid" width="65"
                                                               >
                                                        </nobr>
                                                    </td>
                                                    <td> <?php echo $row['name']?> </td>
                                                    <td> <?php echo $row['address']?> </td>
                                                    <td> <?php echo $row['contact']?> </td>
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
</body>

</html>
<!-- Modal -->
<!-- Modal -->
<?php 
include "modal/addseller_modal.php";
?>

<script>

$(document).ready(function() {

    var table = $('#sellerTable').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },

        ],
        lengthChange: false,
        orderCellsTop: true,



    });

});
    </script>