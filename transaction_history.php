<?php 
   include('include/header.php');
   include "include/navbar.php";

   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '
<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM copra_cashadvance where status='PENDING'");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from seller"); 
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

                    <!-- ============================================================== -->
                    <div class="row">


                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                                data-target="#copraCashAdvance">
                                                <i class="fa fa-add" aria-hidden="true"></i> NEW TRANSACTION
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
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                                        Purchased Record
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table" id='transaction_record'>
                                            <?php
                                    $record  = mysqli_query($con, "SELECT * from transaction_record ORDER BY id DESC LIMIT 5 "); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">First Price</th>
                                                    <th scope="col">Second Price</th>
                                                    <th scope="col">Net Weight</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['id']?> </th>
                                                    <td> <?php echo $row['date']?> </td>
                                                    <td> <?php echo $row['contract']?> </td>
                                                    <td> <?php echo $row['seller']?> </td>
                                                    <td>₱ <?php echo number_format($row['first_res'])?> </td>
                                                    <td>₱ <?php echo number_format($row['sec_res'])?> </td>

                                                    <td> <?php 
                                                    
                                                    $total_weight = $row['rese_weight_1'] +  $row['rese_weight_2'];
                                                    
                                                    echo number_format($total_weight);?> Kg </td>


                                                    <td>₱ <?php echo number_format(($row['amount_paid'] )); ?> </td>
                                                    <td> <a href="transaction.php?view=<?php echo $row['invoice']; ?>"
                                                            class="btn btn-dark ">
                                                            <i class='fa-solid fa-eye'></i></a> </td>
                                                </tr> <?php } ?> </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" style="text-align:right">Total:</th>
                                                    <th></th>

                                                </tr>
                                            </tfoot>
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

</html>

<script>
// for date

var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);


        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);


// for date filter


$(document).ready(function() {

    // Create date inputs
    minDate = new DateTime($('#p_min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#p_max'), {
        format: 'YYYY-MM-DD'
    });

    // DataTables initialisation
    var table = $('#transaction_record').DataTable(

        {
            footerCallback: function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i ===
                        'number' ? i : 0;
                };

                // Total over all pages
                var total_paid = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);



                // Update footer
                $(api.column(5).footer()).html('₱ ' + total_paid + ' ( ₱ ' + total_paid + ' total)');
            },
            order: [
                [0, 'desc']
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                },



            ],
            orderCellsTop: true,




        }
    );

    // Refilter the table
    $('#p_min, #p_max').on('change', function() {
        purchase_table.draw();
    });



});
</script>