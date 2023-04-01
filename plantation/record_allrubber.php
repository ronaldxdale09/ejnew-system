<?php 
   include('include/header.php');
   include "include/navbar.php";

   ?>
<?php include('modal/modal_rubber_report.php'); ?>

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
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070"> RUBBER </font>
                                <font color="#046D56"> TRANSACTIONS </font>
                            </b>
                        </h2>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <!-- CONTENT -->

                                    <br>
                                    <div class="table-responsive">
                                        <table class="table" id='sellerTable'> <?php
                                           $results  = mysqli_query($con, "SELECT * from planta_recording"); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" hidden>ID</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Lot No.</th>
                                                    <th scope="col">Cost</th>
                                                    <th scope="col">Total Cost</th>
                                                    <th scope="col">Weight</th>
                                                    <th scope="col">Reweight</th>
                                                    <th scope="col">Crumbed Weight</th>
                                                    <th scope="col">No. of Bales</th>
                                                    <th scope="col">Excess</th>
                                                    <th scope="col">Bale Kilo</th>
                                                    <th scope="col">Total Kilo</th>
                                                    <th scope="col">Cost</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>

                                                    <td> <span class="badge bg-success"> <?php echo $row['status']?>
                                                            </spa>
                                                    </td>
                                                    <td hidden> <?php echo $row['purchased_id']?> </td>
                                                    <td> <?php echo $row['supplier']?> </td>
                                                    <td> <?php echo $row['location']?> </td>
                                                    <td> <?php echo $row['lot_num']?> </td>
                                                    <td> <?php echo $row['cost']?> </td>
                                                    <td> <?php echo $row['total_cost']?> </td>
                                                    <td> <?php echo $row['weight']?> </td>
                                                    <td> <?php echo $row['reweight']?> </td>
                                                    <td> <?php echo $row['crumbed_weight']?> </td>
                                                    <td> <?php echo $row['bale_no']?> </td>
                                                    <td> <?php echo $row['bale_excess']?> </td>
                                                    <td> <?php echo $row['bale_kilo']?> </td>
                                                    <td> <?php echo $row['bale_total_kilo']?> </td>
                                                    <td> <?php echo $row['cost_ave']?> </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success text-white btnViewRecord">VIEW
                                                        </button>
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



<script>
       $('.btnViewRecord').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            
            $('#newReceiving').modal('show');


        });

        
</script>