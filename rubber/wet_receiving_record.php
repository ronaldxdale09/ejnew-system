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

                        <h1 class="page-title">
                            <b>
                                <font color="#0C0070">DRY PRICE</font>
                                <font color="#046D56">RECEIVING RECORD </font>
                            </b>
                        </h1>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                data-target="#createNew">CREATE TRANSFER</button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id='inventory-table'>
                                    <thead class="table-dark">
                                        <tr>

                                            <th scope="col">Status</th>
                                            <th scope="col"> ID</th>
                                            <th scope="col">Date Received</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Gross.</th>
                                            <th scope="col">Tare</th>
                                            <th scope="col">Net Cuplump</th>
                                            <th scope="col">Estimated DRC</th>
                                            <th scope="col">Estimated Total Bale Weight</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col">Cash Advance</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Recorded By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                            $sql = "SELECT * FROM rubber_transaction where type ='DRY'";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {

                                    $status='';
                                    if ($row['planta_status'] == 1){
                                        $status='EJN';
                                    }
                                    else {
                                        $status='PLANTA';
                                    }

                                    echo "<tr>";
                                    echo "<td><span class=\"badge " . ($status === 'EJN' ? 'bg-success' : 'bg-warning') . "\">" . $status . "</span></td>";
                                    echo "<td>".$row['id']."</td>";
                                    echo "<td>".$row['date']."</td>";
                                    echo "<td>".$row['seller']."</td>";
                                    echo "<td>".$row['address']."</td>";
                                    echo "<td>".$row['gross']."</td>";
                                    echo "<td>".$row['tare']."</td>";
                                    echo "<td>".$row['net_weight']."</td>";
                                    echo "<td>".$row['assumed_drc']."</td>";
                                    echo "<td>".$row['assumed_baleWeight']."</td>";
                                    echo "<td>".$row['total_amount']."</td>";
                                    echo "<td>".$row['less']."</td>";
                                    echo "<td>".$row['amount_paid']."</td>";
                                    echo "<td>".$row['type']."</td>";
                                    echo "<td>".$row['recorded_by']."</td>";
        
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='23'>No records found</td></tr>";
                            }
                            ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            $(document).ready(function() {
                                var table = $('#inventory-table').DataTable({
                                    "order": [
                                        [1, 'asc']
                                    ],
                                    "pageLength": -1,
                                    "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
                                    "responsive": true,
                                    "buttons": [{
                                            extend: 'excelHtml5',
                                            text: 'Excel',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            text: 'PDF',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'print',
                                            text: 'Print',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        }
                                    ]
                                });
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



<!-- create Table Row -->
<div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> EJN RUBBER | TRANSFER</h5>
            </div>
            <form method='POST' action='function/newWetReceiving.php'>

                <div class="modal-body">

                    <center>
                        <h5> Create New Wet (Cuplumps) Transfer </h5>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Date.</label>
                                    <input type="date" class="form-control" name="date"
                                        value="<?php echo date('Y-m-d'); ?>" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By"
                                    value='JANE'>
                            </div>
                        </div>


                    </center>



                </div>
                <div class="modal-footer">
                    <button type="submit" name='new' class="btn btn-success">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>