<?php 
   include('include/header.php');
   include "include/navbar.php";
?>

<style>
.number-cell {
    text-align: right;
}
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BALES </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW SALE </button>
                            <hr>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT  * FROM bales_sales_record");?>
                                    <thead class="table-dark text-center">
                                        <tr>
                                          <th scope="col">Status</th>
                                            <th scope="col">ID.</th>
                                            <th scope="col">Trans Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Sale Contract</th>
                                            <th scope="col">Buyer Contract</th>
                                            <th scope="col">Contract Quality</th>
                                            <th scope="col">Contract Quantity</th>
                                            <th scope="col">Recorded By</th>
                        
                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td> <?php echo $row['status']?> </td>
                                            <td> <?php echo $row['bales_sales_id']?> </td>
                                            <td> <?php echo $row['transaction_date']?> </td>
                                            <td> <?php echo $row['sale_type']?> </td>
                                            <td> <?php echo $row['sale_contract']?> </td>
                                            <td> <?php echo $row['buyer_contract']?> </td>
                                            <td> <?php echo $row['contract_quality']?> </td>
                                            <td> <?php echo $row['contact_quantity']?> </td>
                                            <td> <?php echo $row['recorded_by']?> </td>
                                


                                        </tr> <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php    include "sales_modal/bales_sales_modal.php";?>

                            <script>
                            var table = $('#recording_table-receiving').DataTable({
                                dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                                order: [
                                    [0, 'desc']
                                ],
                                buttons: [
                                    'excelHtml5',
                                    'pdfHtml5',
                                    'print'
                                ],
                                columnDefs: [{
                                    orderable: false,
                                    targets: -1
                                }],
                                lengthChange: false,
                                orderCellsTop: true,
                                paging: false,
                                info: false,
                            });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>